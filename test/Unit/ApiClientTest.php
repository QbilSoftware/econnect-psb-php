<?php

declare(strict_types=1);

namespace EConnect\Psb\Test\Unit;

use EConnect\Psb\Api\HookApi;
use EConnect\Psb\Api\SalesInvoiceApi;
use EConnect\Psb\ApiException;
use EConnect\Psb\Configuration;
use EConnect\Psb\Model\Document;
use EConnect\Psb\Model\Hook;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

/**
 * Exercises the generated API classes end-to-end against a mocked HTTP client.
 */
final class ApiClientTest extends TestCase
{
    private Client $client;
    private Configuration $config;

    protected function setUp(): void
    {
        $this->client = new Client();
        $this->config = (new Configuration())
            ->setHost('https://psb.example.test')
            ->setApiKey('Subscription-Key', 'subscription-key')
            ->setAccessToken('access-token');
    }

    public function testRequestCarriesAuthenticationAndDeserializesResponse(): void
    {
        $this->client->addResponse($this->jsonResponse(200, [[
            'id' => 'hook-1',
            'name' => 'Default',
            'action' => 'https://example.test/hook',
            'createdOn' => '2026-01-02T03:04:05+00:00',
        ]]));

        $hooks = $this->createApi(HookApi::class)->getHookConfigs();

        self::assertCount(1, $hooks);
        self::assertInstanceOf(Hook::class, $hooks[0]);
        self::assertSame('hook-1', $hooks[0]->getId());

        $request = $this->client->getLastRequest();
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://psb.example.test/api/v1/hook', (string) $request->getUri());
        self::assertSame('subscription-key', $request->getHeaderLine('Subscription-Key'));
        self::assertSame('Bearer access-token', $request->getHeaderLine('Authorization'));
        self::assertSame('application/json', $request->getHeaderLine('Accept'));
    }

    public function testPathParametersAreEncodedAndBodyIsSerialized(): void
    {
        $this->client->addResponse($this->jsonResponse(200, [
            'id' => 'hook-1',
            'name' => 'Default',
            'action' => 'https://example.test/hook',
        ]));

        $hook = (new Hook())
            ->setId('hook-1')
            ->setName('Default')
            ->setAction('https://example.test/hook')
            ->setCreatedOn(new \DateTimeImmutable('2026-01-02T03:04:05+00:00'));

        $this->createApi(HookApi::class)->subscribe('NL:KVK:12345678', $hook);

        $request = $this->client->getLastRequest();
        self::assertSame('PUT', $request->getMethod());
        self::assertSame('/api/v1/NL%3AKVK%3A12345678/hook', $request->getUri()->getPath());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame([
            'id' => 'hook-1',
            'name' => 'Default',
            'action' => 'https://example.test/hook',
            'createdOn' => '2026-01-02T03:04:05+00:00',
        ], json_decode((string) $request->getBody(), true, 512, JSON_THROW_ON_ERROR));
    }

    public function testFileUploadSendsMultipartBodyWithBoundary(): void
    {
        $this->client->addResponse($this->jsonResponse(200, ['id' => 'document-1']));

        $file = tempnam(sys_get_temp_dir(), 'psb');
        file_put_contents($file, '<Invoice>UBL</Invoice>');

        try {
            $document = $this->createApi(SalesInvoiceApi::class)->sendSalesInvoice('NL:KVK:12345678', new \SplFileObject($file), null, 'peppol');
        } finally {
            unlink($file);
        }

        self::assertInstanceOf(Document::class, $document);
        self::assertSame('document-1', $document->getId());

        $request = $this->client->getLastRequest();
        self::assertSame('POST', $request->getMethod());
        self::assertSame('channel=peppol', $request->getUri()->getQuery());
        self::assertMatchesRegularExpression('~^multipart/form-data; boundary=(\S+)$~', $request->getHeaderLine('Content-Type'));

        $boundary = substr($request->getHeaderLine('Content-Type'), strlen('multipart/form-data; boundary='));
        $body = (string) $request->getBody();
        self::assertStringStartsWith("--{$boundary}\r\n", $body);
        self::assertStringContainsString('Content-Disposition: form-data; name="file"; filename="' . basename($file) . '"', $body);
        self::assertStringContainsString('<Invoice>UBL</Invoice>', $body);
    }

    public function testErrorResponsesAreConvertedToApiException(): void
    {
        $this->client->addResponse($this->jsonResponse(404, ['title' => 'Not Found']));

        try {
            $this->createApi(HookApi::class)->getHookConfigs();
            self::fail('Expected an ApiException');
        } catch (ApiException $e) {
            self::assertSame(404, $e->getCode());
            self::assertSame('[404] Error connecting to the API (https://psb.example.test/api/v1/hook)', $e->getMessage());
            self::assertSame('{"title":"Not Found"}', $e->getResponseBody());
        }
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    private function createApi(string $class): object
    {
        $factory = new HttpFactory();

        return new $class($this->client, $this->config, $this->client, $factory, $factory, $factory);
    }

    private function jsonResponse(int $status, mixed $body): Response
    {
        return new Response($status, ['Content-Type' => 'application/json'], json_encode($body, JSON_THROW_ON_ERROR));
    }
}

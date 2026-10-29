<?php

declare(strict_types=1);

namespace EConnect\Psb\Test\Unit;

use EConnect\Psb\Api\MeApi;
use EConnect\Psb\ApiException;
use EConnect\Psb\Configuration;
use EConnect\Psb\Model\User;
use EConnect\Psb\OidcAuthenticator;
use GuzzleHttp\Psr7\HttpFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Clock\NativeClock;
use Symfony\Component\HttpClient\HttplugClient;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\HttpClient\Response\MockResponse;

/**
 * Runs the SDK on top of Symfony HttpClient, the PSR-18 / HTTPlug implementation used by Symfony applications.
 */
final class SymfonyHttpClientTest extends TestCase
{
    /** @var list<array{string, string, array<string, mixed>}> */
    private array $requests = [];

    public function testAuthenticatesAndCallsApiThroughSymfonyHttpClient(): void
    {
        $httpClient = $this->createHttpClient([
            new MockResponse('{"token_endpoint":"https://identity.example.test/connect/token"}'),
            new MockResponse('{"access_token":"access-token","expires_in":3600}'),
            new MockResponse('{"name":"jane"}'),
        ]);

        $factory = new HttpFactory();
        $psr18Client = new Psr18Client($httpClient, $factory, $factory);
        $config = (new Configuration())
            ->setHost('https://psb.example.test')
            ->setUsername('jane')
            ->setPassword('s3cr3t')
            ->setApiKey('Subscription-Key', 'subscription-key');

        (new OidcAuthenticator($psr18Client, $factory, $factory, new NativeClock(), $config))
            ->authenticate('client-id', 'client-secret');

        $user = (new MeApi($psr18Client, $config, new HttplugClient($httpClient, $factory, $factory), $factory, $factory, $factory))
            ->getUser();

        self::assertInstanceOf(User::class, $user);
        self::assertSame('jane', $user->getName());

        [, $url, $options] = $this->requests[2];
        self::assertSame('https://psb.example.test/api/v1/me', $url);
        self::assertContains('Authorization: Bearer access-token', $options['headers']);
        self::assertContains('Subscription-Key: subscription-key', $options['headers']);
    }

    public function testAsyncRequestsResolveThroughHttplugClient(): void
    {
        $httpClient = $this->createHttpClient([
            new MockResponse('{"name":"jane"}'),
            new MockResponse('{"title":"Unauthorized"}', ['http_code' => 401]),
        ]);

        $factory = new HttpFactory();
        $api = new MeApi(new Psr18Client($httpClient, $factory, $factory), new Configuration(), new HttplugClient($httpClient, $factory, $factory), $factory, $factory, $factory);

        $user = $api->getUserAsync()->wait();

        self::assertInstanceOf(User::class, $user);
        self::assertSame('jane', $user->getName());

        $this->expectException(ApiException::class);
        $this->expectExceptionCode(401);

        $api->getUserAsync()->wait();
    }

    /**
     * @param list<MockResponse> $responses
     */
    private function createHttpClient(array $responses): MockHttpClient
    {
        return new MockHttpClient(function (string $method, string $url, array $options) use (&$responses): MockResponse {
            $this->requests[] = [$method, $url, $options];

            return array_shift($responses);
        });
    }
}

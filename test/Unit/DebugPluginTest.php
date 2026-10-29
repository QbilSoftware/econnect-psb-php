<?php

declare(strict_types=1);

namespace EConnect\Psb\Test\Unit;

use EConnect\Psb\DebugPlugin;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Http\Client\Exception\NetworkException;
use Http\Client\Promise\HttpFulfilledPromise;
use Http\Client\Promise\HttpRejectedPromise;
use PHPUnit\Framework\TestCase;

final class DebugPluginTest extends TestCase
{
    /** @var resource */
    private $output;

    protected function setUp(): void
    {
        $this->output = fopen('php://memory', 'w+b');
    }

    protected function tearDown(): void
    {
        fclose($this->output);
    }

    public function testLogsSuccessfulResponses(): void
    {
        $request = new Request('GET', 'https://psb.example.test/api/v1/me');

        (new DebugPlugin($this->output))
            ->handleRequest($request, static fn () => new HttpFulfilledPromise(new Response(200)), static fn () => null)
            ->wait();

        self::assertSame("<GET /api/v1/me HTTP/1.1> 200\n", $this->readOutput());
    }

    public function testLogsFailedRequests(): void
    {
        $request = new Request('GET', 'https://psb.example.test/api/v1/me');
        $exception = new NetworkException('Connection refused', $request);

        $promise = (new DebugPlugin($this->output))
            ->handleRequest($request, static fn () => new HttpRejectedPromise($exception), static fn () => null);

        try {
            $promise->wait();
            self::fail('Expected the exception to be rethrown');
        } catch (NetworkException $e) {
            self::assertSame($exception, $e);
        }

        self::assertSame("<GET /api/v1/me HTTP/1.1> 0 Connection refused\n", $this->readOutput());
    }

    private function readOutput(): string
    {
        rewind($this->output);

        return stream_get_contents($this->output);
    }
}

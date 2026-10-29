<?php

declare(strict_types=1);

namespace EConnect\Psb\Test\Unit;

use EConnect\Psb\ApiException;
use EConnect\Psb\Configuration;
use EConnect\Psb\OidcAuthenticator;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Response;
use Http\Client\Exception\NetworkException;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Clock\MockClock;

final class OidcAuthenticatorTest extends TestCase
{
    private Client $client;
    private MockClock $clock;
    private Configuration $config;
    private OidcAuthenticator $authenticator;

    protected function setUp(): void
    {
        $this->client = new Client();
        $this->clock = new MockClock('2026-01-01 12:00:00');
        $this->config = (new Configuration())
            ->setHost('https://psb.example.test')
            ->setUsername('jane')
            ->setPassword('s3cr3t');

        $factory = new HttpFactory();
        $this->authenticator = new OidcAuthenticator($this->client, $factory, $factory, $this->clock, $this->config);
    }

    public function testAuthenticateFetchesTokenUsingDiscoveredEndpoint(): void
    {
        $this->queueSuccessfulLogin('token-1');

        self::assertSame('token-1', $this->authenticator->authenticate('client-id', 'client-secret'));
        self::assertSame('token-1', $this->config->getAccessToken());

        [$discoveryRequest, $tokenRequest] = $this->client->getRequests();

        self::assertSame('GET', $discoveryRequest->getMethod());
        self::assertSame('https://identity.example.test/.well-known/openid-configuration', (string) $discoveryRequest->getUri());

        self::assertSame('POST', $tokenRequest->getMethod());
        self::assertSame('https://identity.example.test/connect/token', (string) $tokenRequest->getUri());
        self::assertSame('application/x-www-form-urlencoded', $tokenRequest->getHeaderLine('Content-Type'));

        parse_str((string) $tokenRequest->getBody(), $form);
        self::assertSame([
            'grant_type' => 'password',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'username' => 'jane',
            'password' => 's3cr3t',
            'scope' => 'ap',
        ], $form);
    }

    public function testAuthenticateIgnoresTrailingSlashInHost(): void
    {
        $this->config->setHost('https://psb.example.test/');
        $this->queueSuccessfulLogin('token-1');

        $this->authenticator->authenticate('client-id', 'client-secret');

        self::assertSame(
            'https://identity.example.test/.well-known/openid-configuration',
            (string) $this->client->getRequests()[0]->getUri()
        );
    }

    public function testAuthenticateReusesTokenUntilShortlyBeforeExpiry(): void
    {
        $this->queueSuccessfulLogin('token-1', 3600);
        $this->queueSuccessfulLogin('token-2', 3600);

        $this->authenticator->authenticate('client-id', 'client-secret');

        $this->clock->sleep(3600 - 61);
        self::assertSame('token-1', $this->authenticator->authenticate('client-id', 'client-secret'));
        self::assertCount(2, $this->client->getRequests());

        // Within the leeway window the token is renewed instead of being sent while about to expire.
        $this->clock->sleep(1);
        self::assertSame('token-2', $this->authenticator->authenticate('client-id', 'client-secret'));
        self::assertCount(4, $this->client->getRequests());
    }

    public function testAuthenticateReportsOAuthErrorDescription(): void
    {
        $this->client->addResponse($this->jsonResponse(200, ['token_endpoint' => 'https://identity.example.test/connect/token']));
        $this->client->addResponse($this->jsonResponse(400, ['error' => 'invalid_grant', 'error_description' => 'invalid_username_or_password']));

        try {
            $this->authenticator->authenticate('client-id', 'client-secret');
            self::fail('Expected an ApiException');
        } catch (ApiException $e) {
            self::assertSame('OIDC login failed: [400] invalid_username_or_password', $e->getMessage());
            self::assertSame(400, $e->getCode());
            self::assertStringContainsString('invalid_grant', (string) $e->getResponseBody());
        }

        self::assertSame('', $this->config->getAccessToken());
    }

    public function testAuthenticateWrapsNonJsonErrorResponse(): void
    {
        $this->client->addResponse(new Response(502, ['Content-Type' => 'text/html'], '<html>Bad Gateway</html>'));

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('OpenID discovery failed: [502] Bad Gateway');

        $this->authenticator->authenticate('client-id', 'client-secret');
    }

    public function testAuthenticateFailsWhenTokenEndpointIsMissing(): void
    {
        $this->client->addResponse($this->jsonResponse(200, ['issuer' => 'https://identity.example.test']));

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Missing token_endpoint in OpenID configuration.');

        $this->authenticator->authenticate('client-id', 'client-secret');
    }

    public function testAuthenticateFailsWhenTokenResponseHasNoExpiry(): void
    {
        $this->client->addResponse($this->jsonResponse(200, ['token_endpoint' => 'https://identity.example.test/connect/token']));
        $this->client->addResponse($this->jsonResponse(200, ['access_token' => 'token-1']));

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('OIDC login failed: missing access token or expiry.');

        $this->authenticator->authenticate('client-id', 'client-secret');
    }

    public function testAuthenticateWrapsTransportErrors(): void
    {
        $factory = new HttpFactory();
        $this->client->addException(new NetworkException('Connection refused', $factory->createRequest('GET', 'https://identity.example.test')));

        try {
            $this->authenticator->authenticate('client-id', 'client-secret');
            self::fail('Expected an ApiException');
        } catch (ApiException $e) {
            self::assertSame('[0] Connection refused', $e->getMessage());
            self::assertInstanceOf(NetworkException::class, $e->getPrevious());
        }
    }

    private function queueSuccessfulLogin(string $token, int $expiresIn = 3600): void
    {
        $this->client->addResponse($this->jsonResponse(200, ['token_endpoint' => 'https://identity.example.test/connect/token']));
        $this->client->addResponse($this->jsonResponse(200, [
            'access_token' => $token,
            'expires_in' => $expiresIn,
            'token_type' => 'Bearer',
        ]));
    }

    /**
     * @param array<string, mixed> $body
     */
    private function jsonResponse(int $status, array $body): Response
    {
        return new Response($status, ['Content-Type' => 'application/json'], json_encode($body, JSON_THROW_ON_ERROR));
    }
}

<?php

declare(strict_types=1);

namespace EConnect\Psb;

use Psr\Clock\ClockInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class OidcAuthenticator
{
    /**
     * Seconds before the reported expiry at which a token is renewed, so that
     * requests in flight don't reach the API with an expired token.
     */
    private const EXPIRY_LEEWAY = 60;

    private \DateTimeImmutable $validUntil;

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory,
        private ClockInterface $clock,
        private Configuration $config,
    ) {}

    public function authenticate(string $clientId, string $clientSecret): string
    {
        if (isset($this->validUntil) && $this->validUntil > $this->clock->now()) {
            return $this->config->getAccessToken();
        }

        $identityUrl = rtrim(str_replace('psb', 'identity', $this->config->getHost()), '/');
        $discoveryUrl = "{$identityUrl}/.well-known/openid-configuration";

        // 1. Fetch OpenID Configuration
        $discoveryRequest = $this
            ->requestFactory
            ->createRequest('GET', $discoveryUrl);

        $discoveryResponse = $this->send($discoveryRequest);
        $metadata = $this->decode($discoveryRequest, $discoveryResponse, 'OpenID discovery failed');

        $tokenEndpoint = $metadata['token_endpoint'] ?? null;

        if (!is_string($tokenEndpoint) || $tokenEndpoint === '') {
            throw new ApiException(
                'Missing token_endpoint in OpenID configuration.',
                $discoveryRequest,
                $discoveryResponse
            );
        }

        // 2. Request Token using ROPC
        $formBody = http_build_query([
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'username' => $this->config->getUsername(),
            'password' => $this->config->getPassword(),
            'scope' => 'ap',
        ]);

        $tokenRequest = $this
            ->requestFactory
            ->createRequest('POST', $tokenEndpoint)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withBody($this->streamFactory->createStream($formBody));

        $tokenResponse = $this->send($tokenRequest);
        $tokenData = $this->decode($tokenRequest, $tokenResponse, 'OIDC login failed');

        if (empty($tokenData['access_token']) || !is_string($tokenData['access_token']) || !is_numeric($tokenData['expires_in'] ?? null)) {
            throw new ApiException(
                'OIDC login failed: missing access token or expiry.',
                $tokenRequest,
                $tokenResponse
            );
        }

        // 3. Store token
        $lifetime = max(0, (int) $tokenData['expires_in'] - self::EXPIRY_LEEWAY);
        $this->validUntil = $this->clock->now()->add(new \DateInterval("PT{$lifetime}S"));
        $this->config->setAccessToken($tokenData['access_token']);

        return $this->config->getAccessToken();
    }

    private function send(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new ApiException("[{$e->getCode()}] {$e->getMessage()}", $request, null, $e);
        }
    }

    /**
     * @return array<mixed>
     */
    private function decode(RequestInterface $request, ResponseInterface $response, string $error): array
    {
        $statusCode = $response->getStatusCode();
        $data = json_decode((string) $response->getBody(), true);

        if ($statusCode < 200 || $statusCode > 299) {
            // OAuth 2.0 error responses describe the failure in `error_description` / `error` (RFC 6749, section 5.2)
            $reason = $data['error_description'] ?? $data['error'] ?? null;

            throw new ApiException(
                sprintf('%s: [%d] %s', $error, $statusCode, is_string($reason) ? $reason : $response->getReasonPhrase()),
                $request,
                $response
            );
        }

        if (!is_array($data)) {
            throw new ApiException("{$error}: response is not a JSON object.", $request, $response);
        }

        return $data;
    }
}

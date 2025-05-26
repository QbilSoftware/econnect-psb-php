<?php

declare(strict_types=1);

namespace EConnect\Psb;

use Psr\Clock\ClockInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class OidcAuthenticator
{
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

        $identityUrl = str_replace('psb', 'identity', $this->config->getHost());
        $discoveryUrl = "{$identityUrl}/.well-known/openid-configuration";

        // 1. Fetch OpenID Configuration
        $discoveryRequest = $this
            ->requestFactory
            ->createRequest('GET', $discoveryUrl);

        $discoveryResponse = $this->httpClient->sendRequest($discoveryRequest);
        $metadata = json_decode((string) $discoveryResponse->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $tokenEndpoint = $metadata['token_endpoint'] ?? null;

        if (!$tokenEndpoint) {
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

        $tokenResponse = $this->httpClient->sendRequest($tokenRequest);
        $tokenData = json_decode((string) $tokenResponse->getBody(), true, 512, JSON_THROW_ON_ERROR);

        if (empty($tokenData['access_token']) || empty($tokenData['expires_in'])) {
            throw new ApiException(
                'OIDC login failed: missing access token or expiry.',
                $tokenRequest,
                $tokenResponse
            );
        }

        // 3. Store token
        $this->validUntil = $this->clock->now()->add(new \DateInterval("PT{$tokenData['expires_in']}S"));
        $this->config->setAccessToken($tokenData['access_token']);

        return $this->config->getAccessToken();
    }
}

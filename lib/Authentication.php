<?php

declare(strict_types=1);

namespace EConnect\Psb;

use Jumbojett\OpenIDConnectClient;
use Psr\Clock\ClockInterface;
use Symfony\Component\Clock\NativeClock;

class Authentication
{
    private ?\DateTimeImmutable $validUntil = null;

    public function __construct(
        private readonly Configuration $config,
        private readonly ClockInterface $clock = new NativeClock(),
    ) {
    }

    public function login(string $clientId, string $clientSecret): void
    {
        $identityUrl = str_replace("psb", "identity", $this->config->getHost());

        $oidc = new OpenIDConnectClient(
            $identityUrl,
            $clientId,
            $clientSecret,
        );

        $oidc->addScope(["ap"]);

        if ($this->validUntil !== null && $this->validUntil < $this->clock->now()) {
            return;
        }

        $oidc->addAuthParam(['username' =>  $this->config->getUsername()]);
        $oidc->addAuthParam(['password' =>  $this->config->getPassword()]);

        $loginResponse = $oidc->requestResourceOwnerToken(true);

        if (empty($loginResponse->expires_in)) {
            throw new \Exception('PSB login failed.');
        }

        $this->validUntil = $this->clock->now()
            ->add(new \DateInterval("PT{$loginResponse->expires_in}S"));

        $this->config->setAccessToken($loginResponse->access_token);
    }
}
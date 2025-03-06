<?php

declare(strict_types=1);

namespace EConnect\Psb;

use Jumbojett\OpenIDConnectClient;
use Psr\Clock\ClockInterface;
use Symfony\Component\Clock\NativeClock;

class Authentication
{
    private ?\DateTimeImmutable $validUntil = null;

    private ?string $token = null;

    public function __construct(
        private readonly Configuration $config,
        private readonly ClockInterface $clock = new NativeClock(),
    ) {
    }

    public function login(string $clientId, string $clientSecret)
    {
        $identityUrl = str_replace("psb", "identity", $this->config->getHost());

        $oidc = new OpenIDConnectClient(
            $identityUrl,
            $clientId,
            $clientSecret,
        );

        $oidc->addScope(["ap"]);

        if ($this->validUntil !== null && $this->validUntil < $this->clock->now()) {
            return $this->token;
        }

        $oidc->addAuthParam(['username' =>  $this->config->getUsername()]);
        $oidc->addAuthParam(['password' =>  $this->config->getPassword()]);

        $loginResponse = $oidc->requestResourceOwnerToken(true);

        if (empty($loginResponse->expires_in)) {
            throw new \Exception('PSB login failed.');
        }

        $date = new \DateTime();
        $date->add(new \DateInterval('PT' . $loginResponse->expires_in . 'S'));

        $this->validTill = $date;
        $this->token = $loginResponse->access_token;

        $this->config->setAccessToken($this->token);

        return $this->token;
    }
}
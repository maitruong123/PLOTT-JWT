<?php
namespace Plott\JWT\Token;

use Plott\JWT\Builder as BuilderInterface;
use Firebase\JWT\JWT;

final class Builder implements BuilderInterface
{
    /** @var array<string, mixed> */
    private $headers = ['typ' => 'JWT', 'alg' => null];

    /** @var array<string, mixed> */
    private $claims = [];

    public function __construct(){}

    public function permittedFor($audiences)
    {
        $configured = $this->claims[RegisteredClaims::AUDIENCE] ? $this->claims[RegisteredClaims::AUDIENCE] : [];
        $toAppend   = array_diff($audiences, $configured);

        return $this->setClaim(RegisteredClaims::AUDIENCE, array_merge($configured, $toAppend));
    }

    public function expiresAt($expiration)
    {
        return $this->setClaim(RegisteredClaims::EXPIRATION_TIME, $expiration);
    }

    public function identifiedBy($id)
    {
        return $this->setClaim(RegisteredClaims::ID, $id);
    }

    public function issuedAt($issuedAt)
    {
        return $this->setClaim(RegisteredClaims::ISSUED_AT, $issuedAt);
    }

    public function issuedBy($issuer)
    {
        return $this->setClaim(RegisteredClaims::ISSUER, $issuer);
    }

    public function canOnlyBeUsedAfter($notBefore)
    {
        return $this->setClaim(RegisteredClaims::NOT_BEFORE, $notBefore);
    }

    public function relatedTo($subject)
    {
        return $this->setClaim(RegisteredClaims::SUBJECT, $subject);
    }

    /** @inheritdoc */
    public function withHeader($name, $value)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /** @inheritdoc */
    public function withClaim($name, $value)
    {
        if (in_array($name, RegisteredClaims::ALL, true)) {
            throw new Exception('');
        }

        return $this->setClaim($name, $value);
    }

    /** @param mixed $value */
    private function setClaim($name, $value)
    {
        $this->claims[$name] = $value;

        return $this;
    }

    /**
     * @param array<string, mixed> $items
     *
     * @throws CannotEncodeContent When data cannot be converted to JSON.
     */

    public function getToken()
    {
        $key = "hello";
        $jwt = JWT::encode($this->claims, $key);
        return $jwt;
    }
}

<?php

namespace Plott\JWT;

interface Builder
{
    /**
     * Appends new items to audience
     */
    public function permittedFor($audiences);

    /**
     * Configures the expiration time
     */
    public function expiresAt($expiration);

    /**
     * Configures the token id
     */
    public function identifiedBy($id);

    /**
     * Configures the time that the token was issued
     */
    public function issuedAt($issuedAt);

    /**
     * Configures the issuer
     */
    public function issuedBy($issuer);

    /**
     * Configures the time before which the token cannot be accepted
     */
    public function canOnlyBeUsedAfter($notBefore);

    /**
     * Configures the subject
     */
    public function relatedTo($subject);

    /**
     * Configures a header item
     *
     * @param mixed $value
     */
    public function withHeader($name, $value);

    /**
     * Configures a claim item
     *
     * @param mixed $value
     *
     * @throws RegisteredClaimGiven When trying to set a registered claim.
     */
    public function withClaim($name, $value);

    /**
     * Returns a signed token to be used
     *
     * @throws CannotEncodeContent When data cannot be converted to JSON.
     * @throws CannotSignPayload   When payload signing fails.
     * @throws InvalidKeyProvided  When issue key is invalid/incompatible.
     * @throws ConversionFailed    When signature could not be converted.
     */
    public function getToken();
}

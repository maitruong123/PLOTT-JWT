<?php
namespace Plott\JWT;
require "vendor/autoload.php";
use Plott\JWT\Configuration;

$token = Configuration::builder()
            ->issuedBy('http://example.com') //iss
            ->permittedFor(['http://example.com']) //aud
            ->issuedAt(time()) // iat
            ->canOnlyBeUsedAfter(time()) //nbf
            ->getToken();

print_r($token);


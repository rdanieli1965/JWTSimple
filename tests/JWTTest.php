<?php

use JWTM\JWTMBuilder;

use const JWTM\HS256;

include "./vendor/autoload.php";

$jwtm = new JWTMBuilder;

$jwtm->setEncrypt('HS384')
    ->setSecretKey("a")
    ->addClaim("teste", "abcd")
    ->addClaim("teste1", "abcd")
    ->addClaim("teste2", "abcd")
    ->addClaim("teste3", "abcd");

echo $jwtm->encrypt();




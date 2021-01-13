<?php

include "./vendor/autoload.php";

use JWTM\JWTMBuilder;

$jwtm = new JWTMBuilder;

$jwtm->setEncrypt('HS384')
    ->setSecretKey("as")
    ->addClaim("teste", "abcd")
    ->addClaim("teste1", "abcd")
    ->addClaim("teste2", "abcd")
    ->addClaim("teste3", "abcd");

echo $jwtm->encrypt();




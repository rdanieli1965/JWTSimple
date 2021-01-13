<?php

namespace JWTM\Encryption;

use JWTM\Interfaces\Encryption;
use JWTM\Utils;

class HS384 implements Encryption
{

    public static function encrypt(string $data, string $key): string
    {
        return hash_hmac('sha384', $data, $key);
    }

}

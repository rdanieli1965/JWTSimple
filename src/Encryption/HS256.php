<?php

namespace JWTM\Encryption;

use JWTM\Interfaces\Encryption;
use JWTM\Utils;

class HS256 implements Encryption
{

    public static function encrypt(string $data, string $key): string
    {
        return hash_hmac("sha256", $data, $key);
    }

}

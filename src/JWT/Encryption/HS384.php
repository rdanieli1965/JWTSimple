<?php

namespace JWTM\Encryption;

use JWTM\Interfaces\Encryption;

class HS384 implements Encryption
{

    public function encrypt(string $data, string $key): string
    {
        $sign = hash_hmac('sha384', $data, $key);
        echo $sign . PHP_EOL;
        return base64_encode($sign);
    }

    public function validEncrypt(string $data, string $to_compare, string $key): bool
    {
        $sign = $this->encrypt($data, $key);
        if (strcmp($sign, $to_compare)) {
            return false;
        }

        return true;
    }

}

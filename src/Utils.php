<?php

namespace JWTM;

class Utils 
{
    public static function baseEncode(string $str): string
    {
        $base = base64_encode($str);
        return rtrim(strtr($base, '+/', '-_'), '=');
    }
    
    public static function baseDecode(string $str): string
    {
        $m_size = strlen($str) % 4;
        if ($m_size) {
            $len = 4 - $m_size;
            $str .= str_repeat('=', $len);
        }
        return base64_decode(strtr($str, '-_', '+/'));
    }

    public static function validEncrypt(string $sign, string $to_compare): bool
    {
        if (strcmp($sign, $to_compare)) {
            return false;
        }

        return true;
    }

}



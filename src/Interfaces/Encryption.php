<?php
namespace JWTM\Interfaces;


interface Encryption
{
    public static function encrypt(string $data, string $key): string;

}
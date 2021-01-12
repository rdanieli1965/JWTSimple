<?php
namespace JWTM\Interfaces;


interface Encryption
{
    public function encrypt(string $data, string $key): string;

    public function validEncrypt(string $data, string $to_compare, string $key): bool;
}
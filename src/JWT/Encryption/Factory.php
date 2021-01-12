<?php
namespace JWTM\Encryption;

use Exception;
use JWTM\Interfaces\Encryption;

class Factory
{
    public static function createEncryption(string $enc): Encryption
    {
        $class = "JWTM\\Encryption\\$enc";
        if(!class_exists($class)){
            throw new Exception("Invalid Class $enc");
        }
        
        return new $class();

    }
}

<?php
namespace JWTM;

use Exception;
use JWTM\Encryption\Factory;
use JWTM\Encryption\HS256;

class JWTMBuilder
{
    /**
     * @var array
     */
    private $header;

    /**
     * @var array
     */
    private $payload;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var string
     */
    private $secret_key;

    /**
     * @var Encryption
     */
    private $encode_pattern;

    public function __construct()
    {
        
        $this->header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        $this->payload = [];
        $this->signature = '';
        $this->secret_key = '';
        $this->setEncrypt('HS256');
    }

    public function setEncrypt(string $encrypt_pattern): self
    {
        $this->header['alg'] = $encrypt_pattern;
        $this->encode_pattern = Factory::createEncryption($encrypt_pattern);
        
        return $this;

    }

    public function addClaim(string $key, string $info): self
    {
        if (empty($key)) {
            throw new \Exception("Invalid Claim key");
        }

        $this->payload[$key] = $info;

        return $this;
    }

    public function removeClaim(string $key): self
    {
        if (in_array($key, $this->payload)) {
            unset($this->payload[$key]);
        }
        
        return $this;
    }

    public function addHeader(string $key, string $info): self
    {
        if (empty($key)) {
            throw new \Exception("Invalid Header key");
        }

        $this->header[$key] = $info;

        return $this;
    }

    public function removeHeader(string $key): self
    {
        if (in_array($key, $this->header)) {
            unset($this->header[$key]);
        }
        
        return $this;
    }

    public function setSecretKey(string $key): self
    {
        $this->secret_key = $key;
        
        return $this;
    }

    public function encrypt(): string
    {

        if(empty($this->encode_pattern)){
            throw new Exception("Invalid Encode");
        }

        $data = $this->encodeHeader() . "." . $this->encodePayload();

        if(empty($this->signature))
        {
            $this->signature = $this->genSignature($data);
        }

        return $data . "." . $this->signature;
    }

    private function encodeHeader(): string
    {
        $header = json_encode($this->header);
        return str_replace("=","",base64_encode($header));
    }
    
    private function encodePayload(): string
    {
        $payload = json_encode($this->payload);
        return str_replace("=","",base64_encode($payload));
    }

    private function genSignature(string $data): string
    {
        $pre_gen = $this->encode_pattern->encrypt($data, $this->secret_key);
        return str_replace("=","",$pre_gen);
    }
    
}

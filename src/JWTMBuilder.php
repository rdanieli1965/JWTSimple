<?php
namespace JWTM;

use JWTM\OBjects\Header;
use JWTM\OBjects\Payload;
use JWTM\OBjects\Signature;

class JWTMBuilder
{
    /**
     * @var Header
     */
    private $header;

    /**
     * @var Payload
     */
    private $payload;

    /**
     * @var Signature
     */
    private $signature;

    public function __construct()
    {
        $this->header = new Header;
        $this->payload = new Payload;
        $this->signature = new Signature($this->header, $this->payload);
        $this->secret_key = '';
    }

    public function setEncrypt(string $encrypt_pattern): self
    {
        $this->header->addHeader('alg', $encrypt_pattern);
        
        return $this;
    }

    public function addClaim(string $key, string $info): self
    {
        $this->payload->addPayload($key, $info);

        return $this;
    }

    public function removeClaim(string $key): self
    {
        $this->payload->removePayload($key);
        return $this;
    }

    public function addHeader(string $key, string $info): self
    {
        $this->header->addHeader($key,$info);

        return $this;
    }

    public function removeHeader(string $key): self
    {
        $this->header->removeHeader($key);   
        return $this;
    }

    public function setSecretKey(string $key): self
    {
        $this->signature->setSecretKey($key);
        return $this;
    }

    public function encrypt(): string
    {
        $header_encode = $this->header->encryptHeader();
        $payload_encode = $this->payload->encryptPayload();
        $signature_encode = $this->signature->getSignature();

        return "$header_encode.$payload_encode.$signature_encode";
    }

}

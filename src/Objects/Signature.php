<?php
namespace JWTM\OBjects;

use JWTM\Encryption\Factory;
use JWTM\OBjects\Header;
use JWTM\OBjects\Payload;
use JWTM\Utils;

class Signature
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
     * @var string
     */
    private $secret_key;

    /**
     * @var string
     */
    private $signature;

    public function __construct(Header $header, Payload $payload)
    {
        $this->header = $header;
        $this->payload = $payload;
    }

    public function setSecretKey(string $key): self
    {
        $this->secret_key = $key;

        return $this;
    }

    public function getSignature(): string
    {
        if (is_null($this->signature) || empty($this->signature)) {
            $this->encryptSign();
        }
        return $this->signature;
    }

    private function encryptSign(): void
    {
        $alg = Factory::createEncryption($this->header->getHeader('alg'));

        $hp_encrypt = $this->header->encryptHeader() . "." . $this->payload->encryptPayload();
        $encrypted = $alg::encrypt($hp_encrypt, $this->secret_key);
        $this->signature = Utils::baseEncode($encrypted);
    }
}

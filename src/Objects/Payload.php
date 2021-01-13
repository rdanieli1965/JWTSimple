<?php
namespace JWTM\OBjects;

use Exception;
use JWTM\Utils;

class Payload{

    /**
     * @var array
     */
    private $payload;
    

    public function addPayload(string $key, string $value): self
    {
        if(empty($key)){
            throw new Exception("Invalid Payload Key - Empty Given");
        }
        $this->payload[$key] = $value;

        return $this;
    }

    public function removePayload(string $key): self
    {
        if (in_array($key, $this->payload)) {
            unset($this->payload[$key]);
        }
        
        return $this;
    }

    public function encryptPayload(): string
    {
        $in_json = json_encode($this->payload);

        return Utils::baseEncode($in_json);

    }
}
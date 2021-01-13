<?php
namespace JWTM\OBjects;

use Exception;
use JWTM\Utils;

class Header{

    /**
     * @var array
     */
    private $headers;
    
    public function __construct(string $alg_type = null)
    {
        $this->addHeader('typ', 'JWT');
        $this->addHeader('typ', $alg_type || 'HS256');
        
    }

    public function addHeader(string $key, string $value): self
    {
        if(empty($key)){
            throw new Exception("Invalid Header Key - Empty Given");
        }
        $this->headers[$key] = $value;

        return $this;
    }

    public function getHeader(string $key): string
    {
        if (isset($this->headers[$key])) {
            return $this->headers[$key];
        }
        return '';
    }

    public function setHeader(array $headers): self
    {
        foreach($headers as $key => $header)
        {
            $this->addHeader($key, $header);
        }
        return $this;
    }

    public function removeHeader(string $key): self
    {
        if (in_array($key, $this->headers)) {
            unset($this->headers[$key]);
        }
        
        return $this;
    }

    public function encryptHeader(): string
    {
        $in_json = json_encode($this->headers);

        return Utils::baseEncode($in_json);

    }

    public static function getHeaderByEncode(string $encode_header): Header
    {
        $header = new Header;
        
        $json_header = json_decode(Utils::baseDecode($encode_header) ,true);
        
        $header->setHeader($json_header);

        return $header;

    }

    
}
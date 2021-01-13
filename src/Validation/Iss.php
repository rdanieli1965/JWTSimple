<?php


use JWTM\Interfaces\PayloadValidation;

class Iss implements PayloadValidation
{

    /**
     * @var array|string
     */
    private $issues;

    /**
     * @var string
     */
    private $iss;


    public function __construct(mixed $issues, string $iss)
    {
        $this->iss = $iss;
        $this->issues = $issues;
    }


    public function check() : void
    {
        if(is_array($this->issues) && !in_array($this->iss, $this->issues))
            
        
        return true;
    }
}
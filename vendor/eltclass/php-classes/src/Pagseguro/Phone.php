<?php

namespace EltClass\Pagseguro;

class Phone {
    private $areaCode;
    private $number;

    public function __construct(int $areaCode, int $number)
    {
        if($areaCode < 11 || !$areaCode || $areaCode >99)
        {
            throw new Exception('Digite um DDD Valido.'); 
        }

        if(strlen($number) < 8 || !$number || strlen($number) >9)
        {
            throw new Exception('Digite um DDD Valido.'); 
        }

        $this->areaCode = $areaCode;
        $this->number = $number;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $fone = $dom->createElement('phone');
        $fone = $dom->appendChild($fone);

        $areaCode = $dom->createElement('areaCode', $this->areaCode);
        $areaCode = $fone->appendChild($areaCode);

        $number = $dom->createElement('number', $this->number);
        $number = $fone->appendChild($number);

        return $fone;
    }
}
<?php

namespace EltClass\Pagseguro;

class Document {
    private $type;
    private $value;

    const CPF = '';

    public function __Construct(string $type, string $value)
    {
        if(!$value)
        {
            throw new Exception("Informe o valor do Documento"); 
        }

        switch ($type) {
            case Document::CPF:
                if(!Document::isValidCPF($value)){
                    throw new Exception("Informe numero de CPF Valido"); 
                }
                break;
        }

        $this->type = $type;
        $this->value = $value;
    }

    function isValidCPF($number):boolean
    {
        $number = preg_replace('/[^0-9]/', '', (string) $number);
    
        if (strlen($number) != 11)
            return false;
    
        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--)
            $sum += $number{$i} * $j;
        $rest = $sum % 11;
        if ($number{9} != ($rest < 2 ? 0 : 11 - $rest))
            return false;
    
        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--)
            $sum += $number{$i} * $j;
        $rest = $sum % 11;
    
        return ($number{10} == ($rest < 2 ? 0 : 11 - $rest));
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $Document = $dom->createElement('document');
        $Document = $dom->appendChild($Document);

        $type = $dom->createElement('type', $this->type);
        $type = $Document->appendChild($type);

        $value = $dom->createElement('value', $this->value);
        $value = $Document->appendChild($value);

        return $Document;
    }
}
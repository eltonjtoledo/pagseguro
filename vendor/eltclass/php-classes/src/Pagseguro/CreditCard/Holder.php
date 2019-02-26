<?php

namespace EltClass\Pagseguro\CreditCard;

    // use \Exception;
    // use \DOMDocument;
    // use \DOMElement;

class Holder{
    private $name;
    private $document;
    private $birthDate;
    private $phone;

    public function __construct(string $name, Document $document, 
    $birthDate, Phone $phone)
    {
        if(!$name || !$birthDate)
        {
            throw new Exception("ERRO: Informe Nome e data de aniversario do titular do cartão "); 
        }

        $this->name = $name;
        $this->document = $document;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
    }
    
    public function getDOMElement():DOMElement
    {
        $dom = new DOMDocument();
        $holder = $dom->createElement('holder');
        $holder = $dom->appendChild($holder);

        $name = $dom->createElement('name', $this->name);
        $name = $holder->appendChild($name);

        $documents = $dom->createElement('amount', $this->documents);
        $documents = $holder->appendChild($documents);

        $cpf = $this->documents->getDOMElement();
        $cpf = $dom->importNode($cpf, true);
        $cpf = $documents->appendChild($cpf);

        $birthDate = $dom->createElement('birthDate', $this->birthDate->format("d/m/Y"));
        $birthDate = $holder->appendChild($birthDate);

        $phone = $this->phone->getDOMElement();
        $phone = $dom->importNode($phone, true);
        $phone = $holder->appendChild($phone);
        
        return $holder;
    }
}
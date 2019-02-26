<?php

namespace EltClass\Pagseguro;

use Exception;
use DOMDocument;
use DOMElement;


class Sender {
    private $name;
    private $email;
    private $phone;
    private $documents;
    private $hash;

    public function __construct(string $name, string $email,Phone $phone,Document $documents, $hash)
    {
        if(!$name || !$hash)
        {
            throw new Exception("ERRO: Preencha todos os dados requisitados");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Exception("ERRO: Informe um E-Mail Valido");
        }

        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->documents = $documents;
        $this->hash = $hash;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $sender = $dom->createElement('sender');
        $sender = $dom->appendChild($sender);

        $name = $dom->createElement('name', $this->name);
        $name = $sender->appendChild($name);

        $email = $dom->createElement('email', $this->email);
        $email = $sender->appendChild($email);

        $phone = $this->phone->getDOMElement();
        $phone = $dom->importNode($phone, true);
        $phone = $sender->appendChild($phone);

        $documents = $dom->createElement('amount', $this->documents);
        $documents = $sender->appendChild($documents);

        $cpf = $this->documents->getDOMElement();
        $cpf = $dom->importNode($cpf, true);
        $cpf = $documents->appendChild($cpf);

        $hash = $dom->createElement('hash', $this->hash);
        $hash = $sender->appendChild($hash);
        
        return $sender;
    }
}
<?php

namespace EltClass\Pagseguro;

class Payment {
    private $Mode = 'default';
    private $method = 'creditCard';
    private $sender;
    private $currency = 'BRL';
    private $notificationURL = 'https://sualoja.com.br/notificacao';
    private $items = [];
    private $extraAmount = 0;
    private $reference = "";
    private $shipping;
    private $creditCard;

    public function __construct(Sender $sender, string $reference, Shipping $shipping,
    float $extraAmount = 0)
    {
        $this->sender = $sender;
        $this->reference = $reference;
        $this->shipping = $shipping;
        $this->extraAmount = $extraAmount;
    }

    public function getDOMDocument():DOMDocument
    {
        $dom = new DOMDocument("1.0", "ISO-8859-1");

        return $dom;
    }
}
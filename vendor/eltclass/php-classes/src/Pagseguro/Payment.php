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
}
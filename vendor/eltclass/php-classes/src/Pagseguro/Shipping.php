<?php

namespace EltClass\Pagseguro;

class Shipping {
    const PAC = 1;
    const SEDEX0 = 2;
    const OTHER = 3;
    
    private $shippingAddressRequired;
    private $address;
    private $type;
    private $cost;

    public function __construct(bool $shippingAddressRequired = true, Address $address,
     int $type, float $cost)
    {
       if($type < 1 || $type > 3)
       {
            throw new Exception("ERRO: Informe um tipo de de frete valido");
       }

       $this->shippingAddressRequired = $shippingAddressRequired;
       $this->address = $address;
       $this->type = $type;
       $this->cost = $cost;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $shipping = $dom->createElement('shipping');
        $shipping = $dom->appendChild($shipping);

        $address = $this->address->getDOMElement();
        $address = $dom->importNode($address, true);
        $address = $shipping->appendChild($address);

        $type = $dom->createElement('type', $this->type);
        $type = $shipping->appendChild($type);

        $cost = $dom->createElement('cost', number_format($this->cost, 2, ".",""));
        $cost = $shipping->appendChild($cost);
        
        return $shipping;
    }
} 
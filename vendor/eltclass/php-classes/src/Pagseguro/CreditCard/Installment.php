<?php

namespace \EltClass\Pagseguro\CreditCard;

class Installment{
    private $quantity;
    private $value;
    private $noInterestInstallmentQuantity;

    public function __construct(int $quantity, string $value, string $noInterestInstallmentQuantity)
    {
       if(!$quantity || !$value || !$noInterestInstallmentQuantity)
       {
            throw new Exception("ERRO: Para proseguir informe quantidade, value, noInterestInstallmentQuantity");  
       }

       $this->quantity = $quantity;
       $this->value = $value;
       $this->noInterestInstallmentQuantity = $noInterestInstallmentQuantity;

    }
    
    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $installment = $dom->createElement('installment');
        $installment = $dom->appendChild($installment);

        $quantity = $dom->createElement('quantity', $this->quantity);
        $quantity = $installment->appendChild($quantity);

        $value = $dom->createElement('value', $this->value);
        $value = $installment->appendChild($value);

        $noInterestInstallmentQuantity = $dom->createElement('noInterestInstallmentQuantity', $this->noInterestInstallmentQuantity);
        $noInterestInstallmentQuantity = $installment->appendChild($noInterestInstallmentQuantity);
        
        return $installment;
    }
}
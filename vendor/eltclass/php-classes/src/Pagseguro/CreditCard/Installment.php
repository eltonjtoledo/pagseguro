<?php

namespace \EltClass\Pagseguro\CreditCard;

class Installment{
    private $quantity;
    private $value;
    private $noInterestInstallmentQuantity;

    public function __construct(int $quantity, string $value)
    {
       if(!$quantity || !$value)
       {
            throw new Exception("ERRO: Para proseguir informe quantidade, value, noInterestInstallmentQuantity");  
       }

       if($quantity <=0 || $quantity > config::MAX_INSTALLMENT)
       {
           throw new Exception("ERRO: Quantidade de Parcelas Invalida!");
       }

       if($value <=0)
       {
           throw new Exception("ERRO: Valor de Pacelas Invalido");
           
       }

       $this->quantity = $quantity;
       $this->value = $value;
       $this->noInterestInstallmentQuantity = config::MAX_INSTALLMENT_NO_INTEREST;

    }
    
    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $installment = $dom->createElement('installment');
        $installment = $dom->appendChild($installment);

        $quantity = $dom->createElement('quantity', $this->quantity);
        $quantity = $installment->appendChild($quantity);

        $value = $dom->createElement('value', number_format($this->value,2,'.',''));
        $value = $installment->appendChild($value);

        $noInterestInstallmentQuantity = $dom->createElement('noInterestInstallmentQuantity', $this->noInterestInstallmentQuantity);
        $noInterestInstallmentQuantity = $installment->appendChild($noInterestInstallmentQuantity);
        
        return $installment;
    }
}
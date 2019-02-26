<?php

namespace EltClass\Pagseguro;

class Item {
    private $id;
    private $description;
    private $quantity;
    private $amount;

    public function __construct(int $id, string $description, 
    int $quantity, float $amount)
    {
        if(empty($id) || empty($description) || empty($quantity) || empty($amount))
        {
            throw new Exception("ERRO: Você deve Preencher todos os parametros requisitados");
        }

        if($quantity < 1)
        {
            throw new Exception("ERRO: Quantidade invalida de Items");
        }
        
        $this->id = $id;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $item = $dom->createElement('item');
        $item = $dom->appendChild($item);

        $id = $dom->createElement('id', $this->id);
        $id = $item->appendChild($id);

        $description = $dom->createElement('description', $this->description);
        $description = $item->appendChild($description);

        $quantity = $dom->createElement('quantity', $this->quantity);
        $quantity = $item->appendChild($quantity);

        $amount = $dom->createElement('amount', number_format($this->amount,2, '.',''));
        $amount = $item->appendChild($amount);

        return $item;
    }
}
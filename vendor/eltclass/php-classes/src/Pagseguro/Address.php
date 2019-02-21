<?php

namespace EltClass\Pagseguro;

class Address {

    private $street;
    private $number;
    private $complement;
    private $district;
    private $city;
    private $state;
    private $country;
    private $postalCode;

    public function __construct(string $street, int $number, string $complement, string $district,
     string $city, string $state, string $country, string $postalCode)
    {
        
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->postalCode = $postalCode;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();
        $address = $dom->createElement('address');
        $address = $dom->appendChild($address);

        $street = $dom->createElement('street', $this->street);
        $street = $address->appendChild($street);

        $number = $dom->createElement('number', $this->number);
        $number = $address->appendChild($number);

        $complement = $dom->createElement('complement', $this->complement);
        $complement = $address->appendChild($complement);

        $district = $dom->createElement('district', $this->district);
        $district = $address->appendChild($district);

        $city = $dom->createElement('city', $this->city);
        $city = $address->appendChild($city);

        $state = $dom->createElement('state', $this->state);
        $state = $address->appendChild($state);

        $country = $dom->createElement('country', $this->country);
        $country = $address->appendChild($country);

        $postalCode = $dom->createElement('postalCode', $this->postalCode);
        $postalCode = $address->appendChild($postalCode);

        return $address;
    }
}
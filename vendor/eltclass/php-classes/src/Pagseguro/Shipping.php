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
}
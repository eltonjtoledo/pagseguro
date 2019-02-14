<?php

namespace EltClass\Pagseguro;

use \GuzzleHttp\Cliente;

class Transporter{

    public static function createSession()
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->request('POST', Config::getUrlSession(). "?". 
        http_build_query(Config::getAtentication()), [
            'verify' => false
        ]);
       $xml = simplexml_load_string($res->getBody()->getContents());

       return((string)$xml->id);
    }
}
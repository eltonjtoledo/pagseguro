<?php

namespace EltClass\Pagseguro;

class Config
{

    const SANDBOX = true;
    const SANDBOX_EMAIL = "eltonjtoledo@gmail.com";
    const SANDBOX_TOKEN = "EB8A29FB91964714A6F9B30B494D739E";
    const SANDBOX_SESIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
    const SANDBOX_URL_JS = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

    const PRODUCTION_EMAIL = "eltonjtoledo@gmail.com";
    const PRODUCTION_TOKEN = "";
    const PRODUCTION_SESIONS = "https://ws.pagseguro.uol.com.br/v2/sessions";
    const PRODUCTION_URL_JS = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

    const MAX_INSTALLMENT_NO_INTEREST = 6;
    const MAX_INSTALLMENT = 10;

    public static function getAtentication() : array
    {
        if (Config::SANDBOX === true) {
            return [
                "email" => Config::SANDBOX_EMAIL,
                "token" => Config::SANDBOX_TOKEN
            ];
        } else {
            return [
                "email" => Config::PRODUCTION_EMAIL,
                "token" => Config::PRODUCTION_TOKEN
            ];
        }
    }

    public static function getUrlSession() : string
    {
        return (Config::SANDBOX === true ? Config::SANDBOX_SESIONS : Config::PRODUCTION_SESIONS);
    }

    public static function getUrlJS() : string
    {
        return (Config::SANDBOX === true ? Config::SANDBOX_URL_JS : Config::PRODUCTION_URL_JS);
    }
}
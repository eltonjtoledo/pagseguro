<?php 

use \EltClass\Page;
use \EltClass\Model\User;
use \EltClass\Model\Order;

use \EltClass\Pagseguro\Config;
use \EltClass\Pagseguro\Transporter;

$app->get('/payment', function(){
    $order = new order();
    $order->getFromSession();
    $years = [];
    for($y = date('Y'); $y < date('Y') + 14; $y++)
    {
        array_push($years, $y);
    } 
    // echo '<pre>';
    //     print_r($_SESSION);
    // echo '</pre>';
    $page = new Page();
    $page->setTpl('payment', [
        "order" => $order->getValues(),
        "msgError" => $order->getError(),
        "years" => $years,
        "pagseguro" => [
            "urlJS" => Config::getUrlJS(),
            "id" => Transporter::createSession(),
            "maxInstallmentNoInterest" => Config::MAX_INSTALLMENT_NO_INTEREST,
            "maxInstallment" => Config::MAX_INSTALLMENT
        ]
    ]);

    exit;
});


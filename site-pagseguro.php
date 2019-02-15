<?php 

use \EltClass\Page;
use \EltClass\Model\User;
use \EltClass\Model\Order;

use \EltClass\Pagseguro\Config;
use \EltClass\Pagseguro\Transporter;

$app->post('/payment/credit', function () {
    User::verifyLogin();
    
    $order = new Order();
    $order->getFromSession();

    $address = $order->getAddress();
    $cart = $order->getCart();
    
        print_r($order->getValues());
        print_r($address->getValues());
        print_r($cart->getValues());
});

$app->get('/payment', function () {
    $order = new order();
    $order->getFromSession();
    $years = [];
    for ($y = date('Y'); $y < date('Y') + 14; $y++) {
        array_push($years, $y);
    }

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

    // echo '<pre>';
    //     print_r($_SESSION);
    // echo '</pre>';
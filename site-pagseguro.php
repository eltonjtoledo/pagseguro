<?php 

use \EltClass\Page;
use \EltClass\Model\User;
use \EltClass\Model\Order;

use \EltClass\Pagseguro\Config;
use \EltClass\Pagseguro\Transporter;
use \EltClass\Pagseguro\Document;
use \EltClass\Pagseguro\Phone;
use \EltClass\Pagseguro\Address;
use \EltClass\Pagseguro\Sender;


$app->post('/payment/credit', function () {
    // print_r($_POST['hash']);
    User::verifyLogin(false);
    
    $order = new Order();
    $order->getFromSession();

    $address = $order->getAddress();
    $cart = $order->getCart();

    

    $birthDate = $_POST['birth'];

    $cpf = new Document(Document::CPF, $_POST['cpf']);
    $phone = new Phone(11,948552699);
    $addressObj = new Address($address->getdesaddress(),$address->getdesnumber(),$address->getdescomplement(),$address->getdesdistrict(),$address->getdescity(),$address->getdesstate(),$address->getdescountry(),$address->getdeszipcode());
    // $sender = new Sender($order->getdesperson(),$order->getdesemail(), $phone, $cpf,$_POST['']);
    
    $dom = new DOMDocument();
    $teste = $addressObj->getDOMElement();
    $testNode = $dom->importNode($teste, true);
    $dom->appendChild($testNode);

    echo $dom->saveXML();
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
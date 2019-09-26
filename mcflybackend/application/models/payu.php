<?php
  
  
  namespace PayU;

use PayU\Api\Response\PaymentResponse;
use PayU\Merchant\Credentials;
use PayU\Transaction\Card\CreditCard;
use PayU\Transaction\Client\Address;
use PayU\Transaction\Client\Buyer;
use PayU\Transaction\Client\Payer;
use PayU\Transaction\Country;
use PayU\Transaction\Currency;
use PayU\Transaction\Order\Amount;
use PayU\Transaction\Order\Order;
use PayU\Transaction\PaymentMethod;
use PayU\Transaction\Transaction;

require '../../vendor/autoload.php';
  // importing the libraries 

 const MERCHANT_ID = '123456';
 $credentials = null;
// creating a credentials instance
//$credentials = Credentials::factory('myKey','myLogin');
$credentials = Credentials::factory('676k86ks53la6tni6clgd30jf6','403ba744e9827f3',PayU::ENV_SANDBOX);

// creating a new PayU client instance
$payU = PayU::factory(PayU::LANGUAGE_ENGLISH);

// configuring the client
$payU->setCredentials($credentials);
$payU->setMerchantId(MERCHANT_ID);
$payU->setNotifyUrl('http://foo.bar/notifications/payu');

//$transaction = new Transaction();
// ... configuring the transaction object

$address = new Address();
        $address->setStreet('St. Foo')
                ->setNumber(123)
                ->setComplement('FOO')
                ->setNeighborhood('Bar Neighborhood')
                ->setCity('Foo City')
                ->setState('Bar State')
                ->setCountry(Country::BRAZIL)
                ->setPhone('55313131');
                
$buyer = new Buyer();
        $buyer->setName('Foo')
              ->setId(123)
              ->setPhone('55313131')
              ->setDni('123123')
              ->setCnpj('123123123')
              ->setEmail('foo@bar.com')
              ->setAddress($address);



$order = new Order();
        $order->setAccountId('500719')
              ->setReferenceCode('001002')
              ->setDescription('Foo order')
              ->setBuyer($buyer)
              ->setShippingAddress($address);

        $amount = new Amount(Amount::VALUE,100.00,Currency::BRAZIL);
        $order->addAmount($amount);
        
$expected = 'APPROVED'; 
       
$card = new CreditCard();
        $card->setName($expected)
             ->setNumber('4444333322221111')
             ->setCvv(123)
             ->setExpirationDate('2021/01');
        
$payer = new Payer();
$payer->setId(123)
      ->setName('Foo')
      ->setEmail('foo@bar.com')
      ->setDni('123123')
      ->setPhone('55313131')
      ->setAddress($address);





$transaction = new Transaction();
$transaction->setOrder($order)
            ->setPayer($payer)
            ->setCreditCard($card)
            ->setInstallments(1)
            ->setType(Transaction::AUTHORIZATION)
            ->setPaymentMethod(PaymentMethod::VISA)
            ->setCountry(Country::BRAZIL)
            ->setSessionId('fooSession')
            ->setIpAddress('127.0.0.1')
            ->setCookie('fooCookie')
            ->setUserAgent('Mozilla');

        

// performing the transaction
$response = $payU->doPayment($transaction);

print_r($response);

// check if the payment was approved
if ($response->isApproved()) {
    
    echo "isApproved";
}

// getting order status
$response = $payU->getOrderById('orderId');

// getting the response payload
$data = $response->getPayload();

print_r($data);  
  
?>

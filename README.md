# Omnipay: Gvp

**Gvp (Garanti, Denizbank, TEB, ING, Şekerbank, TFKB sanal pos) gateway for Omnipay payment processing library**


<!-- TODO: Update the tags when the library is published -->
[![Latest Stable Version](https://poser.pugx.org/okyayaykut/omnipay-gvp/v/stable)](https://packagist.org/packages/okyayaykut/omnipay-gvp) 
[![Total Downloads](https://poser.pugx.org/okyayaykut/omnipay-gvp/downloads)](https://packagist.org/packages/okyayaykut/omnipay-gvp) 
[![Latest Unstable Version](https://poser.pugx.org/okyayaykut/omnipay-gvp/v/unstable)](https://packagist.org/packages/okyayaykut/omnipay-gvp) 
[![License](https://poser.pugx.org/okyayaykut/omnipay-gvp/license)](https://packagist.org/packages/okyayaykut/omnipay-gvp)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Gvp (Turkish Payment Gateways) support for Omnipay.


Gvp (Garanti, Denizbank, TEB, ING, Şekerbank, TFKB) sanal pos hizmeti için omnipay kütüphanesi.

## Installation

    composer require okyayaykut/omnipay-gvp


## Basic Usage

The following gateways are provided by this package:

* Gvp
    - Garanti
    - Denizbank 
    - TEB 
    - ING 
    - Şekerbank 
    - TFKB 

Gateway Methods

* authorize($options) - authorize an amount on the customer's card
* capture($options) - capture an amount you have previously authorized
* purchase($options) - authorize and immediately capture an amount on the customer's card
* refund($options) - refund an already processed transaction
* void($options) - generally can only be called up to 24 hours after submitting a transaction

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Unit Tests

PHPUnit is a programmer-oriented testing framework for PHP. It is an instance of the xUnit architecture for unit testing frameworks.

## Sample App

        <?php defined('BASEPATH') OR exit('No direct script access allowed');

        use Omnipay\Omnipay;

        class GvpTest extends CI_Controller {

            public function index() {
                $gateway = Omnipay::create('Gvp');

                $gateway->setMerchantId("7000679");
                $gateway->setTerminalId("30691297");

                $gateway->setUserName("PROVAUT");
                $gateway->setPassword("123qweASD");

                $gateway->setRefundUserName("PROVRFN");
                $gateway->setRefundPassword("123qweASD");

                $gateway->setTestMode(TRUE);

                $options = [
                    'number'        => '4824894728063019',
                    'expiryMonth'   => '06',
                    'expiryYear'    => '2017',
                    'cvv'           => '959'
                ];

                $response = $gateway->purchase(
                [
                    //'installment'  => '2', # Taksit
                    //'multiplepoint' => 1, // Set money points (Maxi puan gir)
                    //'extrapoint'   => 150, // Set money points (Maxi puan gir)
                    'amount'        => 100.00,
                    'orderid'       => '',
                    'card'          => $options
                ]
                )->send();

                $response = $gateway->authorize(
                [
                    'orderid'       => 'asd2',
                    'transactionId' => '111111111111',
                    'amount'        => 10.00,
                    'card'          => $options
                ]
                )->send();
        //
                $response = $gateway->capture(
                [
                    'transactionId' => '111111111111',
                    'amount'        => 1.00,
                    'currency'      => 'TRY',
                    'card'          => $options
                ]
                )->send();

                $response = $gateway->refund(
                [
                    'transactionId' => '111111111111',
                    'amount'        => 1.00,
                    'currency'      => 'TRY',
                    'card'          => $options
                ]
                )->send();

                $response = $gateway->void(
                [
                    'transactionId' => '111111111111',
                    'authcode'      => '123123',
                    'amount'        => 1.00,
                    'currency'      => 'TRY',
                    'card'          => $options
                ]
                )->send();

                if ($response->isSuccessful()) {
                    //echo $response->getTransactionReference();
                    echo $response->getMessage();
                } else {
                    echo $response->getError();
                }

                // Debug
                //var_dump($response);

            }

        }


## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project, or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/okyayaykut/omnipay-gvp/issues),
or better yet, fork the library and submit a pull request.

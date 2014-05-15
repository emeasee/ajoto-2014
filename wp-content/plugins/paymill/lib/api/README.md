PAYMILL-PHP
===========

[![Build Status](https://travis-ci.org/paymill/paymill-php.png)](https://travis-ci.org/paymill/paymill-php)
[![Latest Stable Version](https://poser.pugx.org/paymill/paymill/v/stable.png)](https://packagist.org/packages/paymill/paymill)
[![Total Downloads](https://poser.pugx.org/paymill/paymill/downloads.png)](https://packagist.org/packages/paymill/paymill)

How to test
-----------
There are different credit card numbers, frontend and backend error codes, which can be used for testing.
For more information, please read our testing reference.
https://www.paymill.com/en-gb/documentation-3/reference/testing/


Getting started with PAYMILL
----------------------------
If you don't already use Composer, then you probably should read the installation guide http://getcomposer.org/download/.

Please include this library via Composer in your composer.json and execute **composer update** to refresh the autoload.php.

```json
{
    "require": {
        "paymill/paymill": "v3.0.0"
    }
}
```

If you don't want to use composer, paymill-php library provides its own **autoload** script. You have to include the autoload script in all files, in which you are going to use the PAYMILL library.

Lets say you have two files, which are going to use the PAYMILL lib. First one is located in the project root, the other one is in the app folder. You have downloaded the PAYMILL library in your project root folder under the name **paymill-php**.

To load the PAYMILL library from the file, which is located in *your project root folder*, you need to **require** PAYMILL's **autoload** script like this:

```php
  require './paymill-php/autoload.php';
```

To load the PAYMILL library from the file, which is located in *the app folder*, you need to **require** PAYMILL's **autoload** script like this:

```php
  require '../paymill-php/autoload.php';
```

1.  Instantiate the request class with the following parameters:
    $apiKey: First parameter is always your private API (test) Key

    ```php
        $request = new Paymill\Request($apiKey);
    ```
2.  Instantiate the model class with the parameters described in the API-reference:
    ```php
        $payment = new Paymill\Models\Request\Payment();
        $payment->setToken("098f6bcd4621d373cade4e832627b4f6");
    ```
3.  Use your desired function:

    ```php
        $response  = $request->create($payment);
        $paymentId = $response->getId();
    ```

    It recommend to wrap it into a "try/catch" to handle exceptions like this:
    ```php
        try{
            $response  = $request->create($payment);
            $paymentId = $response->getId();
        }catch(PaymillException $e){
            //Do something with the error informations below
            $e->getResponseCode();
            $e->getStatusCode();
            $e->getErrorMessage();
        }
    ```

Receiving Response
--------------

This section shows diffrent ways how to receive a response.
The followings examples show how to get the Id for a transaction.

1. The default response is one of the response-models.
```php
    $response  = $request->create($payment);
    $response->getId();
```

2. getLastResponse() returns the unconverted response from the API.
```php
    $request->create($payment);
    $response = $request->getLastResponse();
    $response['body']['data']['id'];
```

3. getJSONObject returns the response as stdClass-Object.
```php
    $request->create($payment);
    $response = $request->getJSONObject();
    $response->data->id;
```

Documentation
--------------

For further information, please refer to our official PHP library reference: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/index.html

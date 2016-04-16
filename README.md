# Billy PHP SDK
[![Build Status](https://travis-ci.org/lsolesen/billy-php-sdk.svg?branch=master)](https://travis-ci.org/lsolesen/billy-php-sdk) [![Code Coverage](https://scrutinizer-ci.com/g/lsolesen/billy-php-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/lsolesen/billy-php-sdk/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lsolesen/billy-php-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lsolesen/billy-php-sdk/?branch=master) [![Latest Stable Version](https://poser.pugx.org/lsolesen/billy-php-sdk/v/stable)](https://packagist.org/packages/lsolesen/billy-php-sdk) [![Total Downloads](https://poser.pugx.org/lsolesen/billy-php-sdk/downloads)](https://packagist.org/packages/lsolesen/billy-php-sdk) [![License](https://poser.pugx.org/lsolesen/billy-php-sdk/license)](https://packagist.org/packages/lsolesen/billy-php-sdk)

PHP SDK for [Billy API](https://billy.dk/api) version 2 only from the Danish accounting program [Billy](http://www.billy.dk/).

## Getting started

Before doing anything you should register yourself with Billy and get access credentials.

## Installation

### Composer

Simply add a dependency on lsolesen/billy-php-sdk to your project's `composer.json` file if you use Composer to manage the dependencies of your project. Here is a minimal example of a composer.json file that just defines a dependency on Billy PHP SDK 2.1:

{
    "require": {
        "lsolesen/billy-php-sdk": "2.1.*"
    }
}

After running `composer install`, you can take advantage of Composer's autoloader in `vendor/autoload.php`.

## Usage

### Create a new client

First you should create a client instance that is authorized with `api_key` or provided by Billy.

```php5
<?php
use Billy\Client\Client as Billy_Client;
use Billy\Client\Request as Billy_Request;

try {
    $request = new Billy_Request($api_key);
    $client = new Billy_Client($request);
} catch (Exception $e) {
    //...
}
?>
```

### Create and update contact

```php5
<?php
use Billy\Contacts\ContactRepository;

try {
    // @todo: This will probably end up becoming an object of its own.
    $persons = array(
        array(
            'name' => $name,
            'email' => $email,
        )
    );
    $contact = new Contact();
    $contact
        ->setName($name)
        ->set('phone', $phone)
        ->setCountryID($address['country'])
        ->set('street', $address['thoroughfare'])
        ->set('cityText', $address['locality'])
        ->set('stateText', $address['administrative_area'])
        ->set('zipcodeText', $address['postal_code'])
        ->set('contactNo', $profile_id)
        ->set('contactPersons', $persons);

    $repository = new ContactRepository($request);
    $created_contact = $repository->create($contact);

    $contact = $repository->getSingle($created_contact->getID());
    $contact
        ->setName($new_name);
    $repository->update($contact);
} catch (Exception $e) {
    //...
}
?>
```

### Create and update product

```php5
<?php
use Billy\Products\ProductsRepository;

try {
    $prices = array();
    $prices[] = array(
        'currencyId' => 'DKK',
        'unitPrice' => '20.25',
    );
    $product = new Product();
    $product
        ->setAccount($billy_state_account_id)
        ->setProductNo($product_id)
        ->setSalesTaxRuleset($billy_vat_model_id)
        ->set('prices', $prices);

    $repository = new ProductRepository($request);
    $created_product = $repository->create($product);

    $product = $repository->getSingle($created_product->getID());
    $product
        ->setName($new_name);
    $repository->update($product);
} catch (Exception $e) {
    //...
}
?>
```
### Create an invoice

```php5
<?php
use Billy\Invoices\InvoicesRepository;

try {
    $invoice_line = new InvoiceLine();
    $invoice_line->setProductID($product->getID())
        ->setQuantity(4)
        ->set('priority', $priority)
        ->setDescription('My description')
        ->setUnitPrice(20.25);

    $new_invoice = new Billy_Invoice();
    $new_invoice->setType('invoice')
        ->setContactID($contact->getID())
        ->setContactMessage($contact_message)
        ->setEntryDate($entry_date)
        ->setPaymentTermsDays(8)
        ->setCurrencyID('DKK')
        ->set('lines', $invoice_line->toArray(););

    $created_invoice = $repository->create($new_invoice);
    $billy_invoice_id = $created_invoice->getID();
} catch (Exception $e) {
    //...
}
?>
```

# Billy's Billing PHP SDK
[![Build Status](https://travis-ci.org/lsolesen/billysbilling.svg?branch=master)](https://travis-ci.org/lsolesen/billysbilling) [![Coverage Status](https://coveralls.io/repos/lsolesen/billysbilling/badge.svg)](https://coveralls.io/r/lsolesen/billysbilling) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lsolesen/billysbilling/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lsolesen/billysbilling/?branch=master) [![Latest Stable Version](https://poser.pugx.org/lsolesen/billysbilling/v/stable)](https://packagist.org/packages/lsolesen/billysbilling) [![Total Downloads](https://poser.pugx.org/lsolesen/billysbilling/downloads)](https://packagist.org/packages/lsolesen/billysbilling) [![License](https://poser.pugx.org/lsolesen/billysbilling/license)](https://packagist.org/packages/lsolesen/billysbilling)

PHP SDK for [Billy's Billing API](https://billysbilling.com/api) version 2 only from the Danish accounting program [Billy's Billing](http://www.billysbilling.dk/).

## Getting started

Before doing anything you should register yourself with Billy's Billing and get access credentials. 

### Create a new client

First you should create a client instance that is authorized with `api_key` or provided by BillysBilling. 

```php5
<?php
    use BillysBilling\Client\Client as Billy_Client;
    use BillysBilling\Client\Request as Billy_Request;

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
    use BillysBilling\Contacts\ContactRepository;

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
    use BillysBilling\Products\ProductsRepository;

    try {
        $prices = array();
        $prices[] = array(
            'currencyId' => 'DKK',
            'unitPrice' => '20.25',
        );
        $product = new Product();
        $product
            ->setAccount($billysbilling_state_account_id)
            ->setProductNo($product_id)
            ->setSalesTaxRuleset($billysbilling_vat_model_id)
            // Should this be ID or SKU?
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
    use BillysBilling\Invoices\InvoicesRepository;

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
        $billysbilling_invoice_id = $created_invoice->getID();
    } catch (Exception $e) {
        //...
    }
?>
```

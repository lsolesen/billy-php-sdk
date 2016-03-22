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
        $client = new Billy_Client(new Billy_Request($api_key));
    } catch (Exception $e) {
        //...
    }
?>
```

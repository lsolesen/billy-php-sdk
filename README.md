# Billy's Billing PHP SDK [![Build Status](https://travis-ci.org/lsolesen/billysbilling.svg?branch=master)](https://travis-ci.org/lsolesen/billysbilling)

PHP SDK for [Billy's Billing API](https://billysbilling.com/api) version 2 only from the Danish accounting program [Billy's Billing](http://www.billysbilling.dk/).

**Note:** This SDK only works with API v2. We have a new SDK in the works for v2. See also [v1 PHP-SDK](https://github.com/billysbilling/billysbilling-php).
```

## Examples

The API for this PHP-SDK is still in development. Use with care. Please see the test files in the tests directory at the moment.

    <?php
    $request = new Billy_Request("054280dbff08bf095fd08683dce80aed");
    $client = new Billy_Client($request);

    $result = $client->get("/organization");
    $organization_id = $result->getBody()->organization->id;

    $response = $client->post("/contacts", array(
      "contact" => array(
        "organizaionID" => $organization_id,
        "name" => "Billy",
        "countryId" => "DK",
        "phone" => "12345678"
      )
    ));

    echo $response->getBody()->contacts[0]->id;
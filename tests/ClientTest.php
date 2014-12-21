<?php

namespace BillysBilling\Tests;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Client\Billy_Request;

/**
 * Class ClientTest
 *
 * @package BillysBilling
 *
 * @covers Billy_Request, Billy_Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';
    protected $contactId;
    protected $organizationId;

    function getClient($key)
    {
        $request = new Billy_Request($key);
        return new Billy_Client($request);
    }

    function testConstructor()
    {
        $invalid_api_key = 'invalid';
        $client = $this->getClient($invalid_api_key);
        $this->assertTrue(is_object($client));
    }

    function getOrganisation()
    {
        $client = $this->getClient($this->api_key);
        $res = $client->get("/organization");
        if (!$res->isSuccess()) {
            echo "Something went wrong:\n\n";
            print_r($res->getBody());
            exit;
        }
        return $this->organizationId = $res->getBody()->organization->id;
    }

    function addContact($organisation_id)
    {
        $client = $this->getClient($this->api_key);
        $res = $client->post("/contacts", array(
          'contact' => array(
            'organizationId' => $organisation_id,
            'name' => "Arnold",
            'countryId' => "DK"
          )
        ));
        if (!$res->isSuccess()) {
            echo "Something went wrong:\n\n";
            print_r($res->getBody());
            exit;
        }

        return $this->contactId = $res->getBody()->contacts[0]->id;
    }

    function getContact($contact_id)
    {
        $client = $this->getClient($this->api_key);
        //Get the contact again
        $res = $client->get("/contacts/" . $this->contactId);
        if (!$res->isSuccess()) {
            echo "Something went wrong:\n\n";
            print_r($res->getBody());
            exit;
        }
        return $res->getBody();
    }

    function testGet()
    {
        $organisation_id = $this->getOrganisation();
        $contact_id = $this->addContact($organisation_id);
        $result = $this->getContact($contact_id);

        $this->assertEquals($result->contact->name, 'Arnold');
        $this->assertEquals($result->contact->organizationId,
          'ROcPwhmSQ9STgSrOQw1OoQ');
    }
}
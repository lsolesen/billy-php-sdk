<?php

namespace BillysBilling\Tests;

use BillysBilling\Client\Client;
use BillysBilling\Client\Request;

/**
 * Class ClientTest
 *
 * @package BillysBilling
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';
    protected $contactId;
    protected $organizationId;

    public function getClient($key)
    {
        $request = new Request($key);
        return new Client($request);
    }

    public function testConstructor()
    {
        $invalid_api_key = 'invalid';
        $client = $this->getClient($invalid_api_key);
        $this->assertTrue(is_object($client));
    }

    public function getOrganisation()
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

    public function addContact($organisation_id)
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

    public function getContact($contact_id)
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

    public function testGet()
    {
        $organisation_id = $this->getOrganisation();
        $contact_id = $this->addContact($organisation_id);
        $result = $this->getContact($contact_id);

        $this->assertEquals($result->contact->name, 'Arnold');
        $this->assertEquals(
            $result->contact->organizationId,
            'ROcPwhmSQ9STgSrOQw1OoQ'
        );
    }
}

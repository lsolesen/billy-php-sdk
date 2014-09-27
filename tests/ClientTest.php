<?php
require_once dirname(__FILE__) . '/../src/Billy/Client.php';

class ClientTest extends PHPUnit_Framework_TestCase {

  protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';
  protected $contactId;
  protected $organizationId;

  function getClient($key) {
    $request = new Billy_Request($key);
    return new Billy_Client($request);
  }

  function testConstructor() {
    $invalid_api_key = 'invalid';
    $client = $this->getClient($invalid_api_key);
    $this->assertTrue(is_object($client));
  }

  function testGet() {
    $client = $this->getClient($this->api_key);
    $res = $client->get("/organization");
    if ($res->status !== 200) {
      echo "Something went wrong:\n\n";
      print_r($res->body);
      exit;
    }
    //print_r($res->body);
    $this->organizationId = $res->body->organization->id;

    //Create a contact
    $client = $this->getClient($this->api_key);
    $res = $client->post("/contacts", array(
      'contact' => array(
        'organizationId' => $this->organizationId,
        'name' => "Arnold",
        'countryId' => "DK"
      )
    ));
    if ($res->status !== 200) {
      echo "Something went wrong:\n\n";
      print_r($res->body);
      exit;
    }
    $this->contactId = $res->body->contacts[0]->id;

    $client = $this->getClient($this->api_key);
    //Get the contact again
    $res = $client->get("/contacts/" . $this->contactId);
    if ($res->status !== 200) {
      echo "Something went wrong:\n\n";
      print_r($res->body);
      exit;
    }
    //print_r($res->body);
  }

}
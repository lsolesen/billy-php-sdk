<?php

namespace BillysBilling\Tests;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Organization\Billy_Organization;

class OrganizationTest extends \PHPUnit_Framework_TestCase {

  protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

  /**
   * @var Billy_Organization
   */
  protected $organizationObject;

  public function __construct() {
    $request = new Billy_Request($this->api_key);
    $client = new Billy_Client($request);
    $this->organizationObject = new Billy_Organization($client);
  }

  public function testGetOrganization() {
    /*
    // Assert an object was returned.
    $this->assertTrue(is_object($this->organizationObject->getAll()));
    // Verify we can return properties
    $this->assertNotEmpty($this->organizationObject->get('name'));
    */
  }



}
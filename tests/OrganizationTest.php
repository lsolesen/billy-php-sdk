<?php

namespace Billy\Tests;

use Billy\Client\Client;
use Billy\Client\Request;
use Billy\Organization\Organization;

class OrganizationTest extends \PHPUnit_Framework_TestCase
{

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Organization
     */
    protected $organizationObject;

    public function __construct()
    {
        $request = new Request($this->api_key);
        $client = new Client($request);
        $this->organizationObject = new Organization($client);
    }

    public function testGetOrganization()
    {
      /*
      // Assert an object was returned.
      $this->assertTrue(is_object($this->organizationObject->getAll()));
      // Verify we can return properties
      $this->assertNotEmpty($this->organizationObject->get('name'));
      */
    }
}

<?php

namespace BillysBilling\Tests;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Contacts\Billy_Contact;
use BillysBilling\Contacts\Billy_ContactRepository;

class ContactRepositoryListTest extends \PHPUnit_Framework_TestCase {
  protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';
  protected $testContactID;
  /**
   * @var Billy_Contact;
   */
  protected $testContact;

  /**
   * @var Billy_ContactRepository
   */
  protected $contactRepository;

  public function __construct() {
    $request = new Billy_Request($this->api_key);
    $client = new Billy_Client($request);
    $this->contactRepository = new Billy_ContactRepository($client);
  }

  public function testGetContacts() {
    $contacts = $this->contactRepository->listContacts();
    // Get first contact for further testing.
    $contact = reset($contacts);
    $this->testContactID = $contact->get('id');
  }

  public function testGetContact() {
    $contact = $this->contactRepository->getContact($this->testContactID);
    $this->testContact = $contact;
  }
}
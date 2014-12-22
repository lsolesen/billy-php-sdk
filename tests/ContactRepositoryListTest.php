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
    $this->assertNotEmpty($contacts);
  }

  public function testCreateContact() {
    $new_contact = new Billy_Contact();
    $new_contact->setName('Billy McBillster');
    $new_contact->setCountryID('DK');
    $new_contact->set('phone', '555-555-5555');

    $this->testContactID = $this->contactRepository->createContact($new_contact);
    $this->assertNotEmpty($this->testContactID, 'Contact created returned an ID');
  }

  public function testGetContact() {
    $contact = $this->contactRepository->getContact($this->testContactID);
    $this->assertNotEmpty($contact, 'Contact retrieved was not empty.');
    $this->assertEquals($contact->getName(), 'Billy McBillster', 'Retrieved contact name matches.');
    $this->assertEquals($contact->getCountryID(), 'DK', 'Retrieved contact country ID matches.');
    $this->testContact = $contact;
  }

  public function testUpdateContact() {
    $this->testContact->set('fax', '555-444-3333');
    $this->contactRepository->updateContact($this->testContact);
    $contact = $this->contactRepository->getContact($this->testContact->getID());
    $this->assertEquals('555-444-3333', $contact->get('fax'));

  }

  public function testDeleteContact() {
    $this->contactRepository->deleteContact($this->testContact->getID());
  }
}
<?php

namespace BillysBilling\Tests;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Contacts\Billy_Contact;
use BillysBilling\Contacts\Billy_ContactRepository;
use BillysBilling\Exception\Billy_Exception;

class ContactRepositoryListTest extends \PHPUnit_Framework_TestCase
{
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
        $this->request = new Billy_Request($this->api_key);
    }

    public function testContactRepositoryConstruct() {
        // Ensure that the ContactRepository can be initiated.
        $repository = new Billy_ContactRepository($this->request);

        $this->assertNotNull(
            $repository,
            'Able to initiate account group repository'
        );

        return $this->contactRepository = $repository;
    }

    public function testGetContacts()
    {
        $repository = $this->testContactRepositoryConstruct();
        $contacts = $repository->getAll();
        $this->assertNotEmpty($contacts);
        return $contacts;
    }

    public function testGetContact()
    {
        $contacts = $this->testGetContacts();
        /** @var Billy_Contact $firstContact */
        $firstContact = reset($contacts);

        $repository = $this->testContactRepositoryConstruct();
        $contact = $repository->getSingle($firstContact->getID());
        $this->assertNotEmpty($contact, 'Contact retrieved was not empty.');
        $this->assertEquals(
            $contact->getName(),
            'Arnold',
            'Retrieved contact name matches.'
        );

        $this->assertEquals(
            $contact->getCountryID(),
            'DK',
            'Retrieved contact country ID matches.'
        );
        $this->testContact = $contact;
    }

    public function createContact()
    {
        $new_contact = new Billy_Contact();
        $new_contact->setName('Billy McBillster');
        $new_contact->setCountryID('DK');
        $new_contact->set('phone', '555-555-5555');

        $repository = $this->testContactRepositoryConstruct();
        $new_contact = $repository->create($new_contact);
        $this->testContactID = $new_contact->getID();

        $this->assertNotEmpty(
            $this->testContactID,
            'Contact created returned an ID'
        );

        return $new_contact;
    }

    public function updateContact($contact)
    {
        if ($contact instanceof Billy_Contact) {

            $contact->set('fax', '555-444-3333');

            $repository = $this->testContactRepositoryConstruct();
            $repository->update($contact);
            $updated_contact = $repository->getSingle($contact->getID());
            $this->assertEquals('555-444-3333', $updated_contact->get('fax'));

        } else {
            $this->fail('Test contact not defined');
        }
    }

    public function deleteContact($contact)
    {
        $repository = $this->testContactRepositoryConstruct();

        if ($contact instanceof Billy_Contact) {
            $repository->delete($contact->getID());
        } else {
            $this->fail('Test contact not defined');
        }

        try {
            $test_deleted = $repository->getSingle($contact->getID());
            $this->fail('Failed to delete contact');
        } catch (Billy_Exception $e) {
            $this->assertEquals(
                'No `contact` record with id `' . $contact->getID() . '` was found.',
                $e->getMessage()
            );
        }
    }

    public function testRepositoryOperations()
    {
        $contact = $this->createContact();
        $this->updateContact($contact);
        $this->deleteContact($contact);
    }
}
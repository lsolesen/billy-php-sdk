<?php

namespace Billy\Tests;

use Billy\Client\Client;
use Billy\Client\Request;
use Billy\Contacts\Contact;
use Billy\Contacts\ContactRepository;
use Billy\Exception\BillyException;

class ContactRepositoryListTest extends \PHPUnit_Framework_TestCase
{
    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';
    protected $testContactID;
    /**
     * @var Contact;
     */
    protected $testContact;

    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    public function __construct()
    {
        $this->request = new Request($this->api_key);
    }

    public function testContactRepositoryConstruct()
    {
        // Ensure that the ContactRepository can be initiated.
        $repository = new ContactRepository($this->request);

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
        /** @var Contact $firstContact */
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

    protected function createContact()
    {
        $new_contact = new Contact();
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

    protected function updateContact($contact)
    {
        if ($contact instanceof Contact) {
            $contact->set('fax', '555-444-3333');

            $repository = $this->testContactRepositoryConstruct();
            $repository->update($contact);
            $updated_contact = $repository->getSingle($contact->getID());
            $this->assertEquals('555-444-3333', $updated_contact->get('fax'));
        } else {
            $this->fail('Test contact not defined');
        }
    }

    protected function deleteContact($contact)
    {
        $repository = $this->testContactRepositoryConstruct();

        if ($contact instanceof Contact) {
            $repository->delete($contact->getID());
        } else {
            $this->fail('Test contact not defined');
        }

        try {
            $test_deleted = $repository->getSingle($contact->getID());
            $this->fail('Failed to delete contact');
        } catch (BillyException $e) {
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

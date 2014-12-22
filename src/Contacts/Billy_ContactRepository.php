<?php
/**
 * BillysBilling
 *
 * PHP version 5
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/billysbilling
 */

namespace BillysBilling\Contacts;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Exception\Billy_Exception;

class Billy_ContactRepository {

  /**
   * @var Billy_Client;
   */
  protected $client;

  /**
   * Initiates repository with an API client.
   *
   * @param Billy_Client $client
   */
  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Lists contacts.
   *
   * @param string $search
   * @param bool $exact
   *
   * @return Billy_Contact[]
   * @throws Billy_Exception
   */
  public function listContacts($search = null, $exact = false) {
    $queryString = '/contacts';

    // Determine the query parameters.
    if ($search && !$exact) {
      $queryString .= '?q=' . urlencode($search);
    }
    elseif ($search && $exact) {
      $queryString .= '?externalId=' . urlencode($search);
    }

    $response = $this->client->get($queryString);
    if ($response->isSuccess()) {
      $contacts = array();
      foreach($response->getBody()->contacts as $key => $data) {
        $contacts[$data->id] = new Billy_Contact($data);
      }
    }
    else {
      throw new Billy_Exception('Unable to retrieve contacts list.');
    }

    return $contacts;
  }

  /**
   * @param string $contactID
   *
   * @return Billy_Contact
   * @throws Billy_Exception
   */
  public function getContact($contactID) {
    $response = $this->client->get('/contacts/' . $contactID);
    if ($response->isSuccess()) {
      return new Billy_Contact($response->getBody()->contact);
    }
    else {
      throw new Billy_Exception($response->getBody()->errorMessage, $response->getBody()->helpURL);
    }
  }

  /**
   * @param Billy_Contact $contact
   *
   * @return mixed The contact's ID
   * @throws Billy_Exception
   * @throws \Exception
   */
  public function createContact($contact) {
    // API requires at least name and country ID.
    try {
      $name = $contact->getName();
      $countryID = $contact->getCountryID();
      if (!$name || !$countryID) {
        throw new Billy_Exception('Name and country ID are required for new contacts', 'https://dev.billysbilling.dk/api/v1/contacts/create');
      }
    }
    catch (Billy_Exception $e) {
      throw $e;
    }

    $contactData = array('contact' => $contact->toArray());
    $response = $this->client->post('/contacts', $contactData);
    if ($response->isSuccess()) {
      return $response->getBody()->contacts[0]->id;
    }
    else {
     throw new Billy_Exception('There was an error creating the contact.');
    }
  }

  /**
   * @param Billy_Contact $contact
   */
  public function updateContact($contact) {
    $contactData = array('contact' => $contact->toArray());
    $response = $this->client->put('/contacts/' . $contact->getID(), $contactData);
    if ($response->isSuccess()) {
      return $response->getBody()->contacts[0]->id;
    }
    else {
      throw new Billy_Exception('There was an error creating the contact.');
    }
  }

  /**
   * @param string $contactID
   * @return \stdClass[] Archived or Deleted accounts.
   * @throws Billy_Exception
   */
  public function deleteContact($contactID) {
    $response = $this->client->delete('/contacts/' . $contactID);
    if ($response->isSuccess()) {
      // Returns group of deleted or archived contacts.
      return $response->getBody();
    }
    else {
      throw new Billy_Exception($response->getBody()->errorMessage, $response->getBody()->helpURL);
    }
  }
}
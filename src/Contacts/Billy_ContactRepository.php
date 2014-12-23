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

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_ContactRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_ContactRepository extends Billy_EntityRepository
{

    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/contacts';
        $this->recordKey = 'contact';
        $this->recordKeyPlural = 'contacts';
        $this->request = $request;
    }

    /**
     * Lists contacts.
     *
     * @return Billy_Contact[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $contacts = array();
        foreach ($response as $key => $contact) {
            $contacts[$contact->id] = new Billy_Contact($contact);
        }
        return $contacts;
    }

    /**
     * Returns a contact
     *
     * @param string $id API ID
     *
     * @return Billy_Contact
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_Contact($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_Contact $object API Entity object
     *
     * @return Billy_Contact
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_Contact($response->{$this->recordKeyPlural}[0]);
    }
}
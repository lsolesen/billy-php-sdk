<?php
/**
 * Billy
 *
 * PHP version 5
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   MIT Open Source License https://opensource.org/licenses/MIT
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/Billy
 */

namespace Billy\Contacts;

use Billy\EntityRepository;
use Billy\Client\Request;
use Billy\Exception\Exception;

/**
 * Class ContactRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class ContactRepository extends EntityRepository
{

    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
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
     * @return Contact[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $contacts = array();
        foreach ($response as $key => $contact) {
            $contacts[$contact->id] = new Contact($contact);
        }
        return $contacts;
    }

    /**
     * Returns a contact
     *
     * @param string $id API ID
     *
     * @return Contact
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Contact($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Contact $object API Entity object
     *
     * @return Contact
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Contact($response->{$this->recordKeyPlural}[0]);
    }
}

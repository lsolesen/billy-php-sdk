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
 * @license   MIT Open Source License https://opensource.org/licenses/MIT
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/billysbilling
 */

namespace BillysBilling\Accounts;

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_AccountsRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Billy_AccountsRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/accounts';
        $this->recordKey = 'account';
        $this->recordKeyPlural = 'accounts';
        $this->request = $request;
    }

    /**
     * Returns all accounts.
     *
     * @return Billy_Account[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $accounts = array();
        foreach ($response as $key => $account) {
            $accounts[$account->id] = new Billy_Account($account);
        }
        return $accounts;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_Account
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_Account($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_Account $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_Account($response->{$this->recordKeyPlural}[0]);
    }
}

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

use BillysBilling\EntityRepository;
use BillysBilling\Client\Request;
use BillysBilling\Exception\Exception;

/**
 * Class AccountsRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class AccountsRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
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
     * @return Account[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $accounts = array();
        foreach ($response as $key => $account) {
            $accounts[$account->id] = new Account($account);
        }
        return $accounts;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Account
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Account($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Account $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Account($response->{$this->recordKeyPlural}[0]);
    }
}

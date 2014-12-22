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

namespace BillysBilling\Accounts;

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_AccountGroupsRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_AccountGroupsRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/accountGroups';
        $this->recordKey = 'accountGroup';
        $this->recordKeyPlural = 'accountGroups';
        $this->request = $request;
    }

    /**
     * Returns all account groups.
     *
     * @return Billy_AccountGroup[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $groups = array();
        foreach ($response as $key => $group) {
            $groups[$group->id] = new Billy_AccountGroup($group);
        }
        return $groups;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_AccountGroup
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_AccountGroup($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_AccountGroup $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        // @todo: This returns a reportLayouts object as well...what to do?
        return new Billy_AccountGroup($response->{$this->recordKeyPlural}[0]);
    }
}
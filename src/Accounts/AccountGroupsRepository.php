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

namespace Billy\Accounts;

use Billy\EntityRepository;
use Billy\Client\Request;
use Billy\Exception\Exception;

/**
 * Class AccountGroupsRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class AccountGroupsRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
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
     * @return AccountGroup[]
     * @throws Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $groups = array();
        foreach ($response as $key => $group) {
            $groups[$group->id] = new AccountGroup($group);
        }
        return $groups;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return AccountGroup
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new AccountGroup($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param AccountGroup $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        // @todo: This returns a reportLayouts object as well...what to do?
        return new AccountGroup($response->{$this->recordKeyPlural}[0]);
    }
}

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
 * Class AccountNaturesRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class AccountNaturesRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/accountNatures';
        $this->recordKey = 'accountNature';
        $this->recordKeyPlural = 'accountNatures';
        $this->request = $request;
    }

    /**
     * Returns all account Natures.
     *
     * @return AccountNature[]
     * @throws Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $natures = array();
        foreach ($response as $key => $group) {
            $natures[$group->id] = new AccountGroup($group);
        }
        return $natures;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return AccountNature
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new AccountNature($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param AccountNature $object API Entity object
     *
     * @return AccountNature
     */
    public function create($object)
    {
        $response = parent::create($object);
        // @todo: This returns a reportLayouts object as well...what to do?
        return new AccountNature($response->{$this->recordKeyPlural}[0]);
    }
}

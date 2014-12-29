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

use BillysBilling\Billy_Entity;
use BillysBilling\Organization\Billy_Organization;

/**
 * Class Billy_AccountGroup
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_AccountGroup extends Billy_Entity
{

    /**
     * Required properties to create an account group.
     * @return array
     */
    public function requiredProperties()
    {
        return array(
          'organization',
          'nature',
          'name',
        );
    }

    /**
     * Returns AccountGroup organization ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getOrganization()
    {
        // @todo: This should return an organization entity object.
        return $this->get('organizationId');
    }

    /**
     * Sets the Organization ID for the AccountGroup
     *
     * @param string $organizationID API ID
     *
     * @return $this
     */
    public function setOrganization($organizationID)
    {
        return $this->set('organizationId', $organizationID);
    }

    public function getNature() {
        // @todo: This should return a loaded Billy_AccountNature.
        return $this->get('nature');
    }

    public function setNature($natureID) {
        return $this->set('nature', $natureID);
    }

    public function getName() {
        return $this->get('name');
    }

    public function setName($string) {
        return $this->set('name', $string);
    }

    public function getDescription() {
        return $this->get('description');
    }

    public function setDescription($string) {
        return $this->set('description', $string);
    }

}
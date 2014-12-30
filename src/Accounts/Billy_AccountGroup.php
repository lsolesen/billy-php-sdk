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
     * @note: Marked as immutable by the API.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getOrganization()
    {
        return $this->get('organizationId');
    }

    /**
     * Returns the nature ID of the account group.
     *
     * @note: Marked as immutable by API.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getNature() 
    {
        return $this->get('natureId');
    }

    /**
     * Returns the account group's name
     *
     * @return mixed
     * @throws \Exception
     */
    public function getName() 
    {
        return $this->get('name');
    }

    /**
     * Set the account group's name.
     *
     * @param string $string Group name
     *
     * @return $this
     */
    public function setName($string) 
    {
        return $this->set('name', $string);
    }

    /**
     * Returns the account group's description.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDescription() 
    {
        return $this->get('description');
    }

    /**
     * Sets the account group's description.
     *
     * @param string $string Group description
     *
     * @return $this
     */
    public function setDescription($string) 
    {
        return $this->set('description', $string);
    }

}
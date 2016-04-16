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

use Billy\Entity;

/**
 * Class Contact
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Contact extends Entity
{

    /**
     * Required properties to create a Contact.
     * @return array
     */
    public function requiredProperties()
    {
        return array(
          'name',
          'countryId',
        );
    }

    /**
     * Returns the contact's name
     *
     * @return mixed
     * @throws \Exception
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Sets the contact's name.
     *
     * @param string $string Contact name
     *
     * @return $this
     */
    public function setName($string)
    {
        return $this->set('name', $string);
    }

    /**
     * Returns the contact's country ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCountryID()
    {
        return $this->get('countryId');
    }

    /**
     * Sets the contact's country ID.
     *
     * @param string $string Country ID
     *
     * @return $this
     */
    public function setCountryID($string)
    {
        return $this->set('countryId', $string);
    }
}

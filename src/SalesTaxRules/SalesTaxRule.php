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

namespace BillysBilling\SalesTaxRules;

use BillysBilling\Entity;

/**
 * Class SalesTaxRule
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class SalesTaxRule extends Entity
{
    /**
     * Returns the sale tax rule's ruleset ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getRuleset()
    {
        return $this->get('rulesetId');
    }

    /**
     * Sets the ruleset ID the sales tax rule belongs to.
     *
     * @param string $apiID Ruleset API ID
     *
     * @return $this
     */
    public function setRuleset($apiID)
    {
        return $this->set('rulesetId', $apiID);
    }

    /**
     * Returns the country ID the rule belongs to.
     * @return mixed
     * @throws \Exception
     */
    public function getCountry()
    {
        return $this->get('countryId');
    }

    /**
     * Sets the country ID for the rule.
     *
     * @param string $string Country ID
     *
     * @return $this
     */
    public function setCountry($string)
    {
        return $this->set('country', $string);
    }

    /**
     * Returns the state ID from the sales tax rule.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getState()
    {
        return $this->get('stateId');
    }

    /**
     * Sets the state ID for the sales tax rule.
     *
     * @param string $string State ID
     *
     * @return $this
     */
    public function setState($string)
    {
        return $this->set('stateId', $string);
    }

    /**
     * Returns the country group ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCountryGroup()
    {
        return $this->get('countryGroupId');
    }

    /**
     * Sets the sales tax rule's country group ID.
     *
     * @param string $apiID API ID
     *
     * @return $this
     */
    public function setCountryGroup($apiID)
    {
        return $this->set('countryGroup', $apiID);
    }

    /**
     * Returns the sales tax rule's contact type.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getContactType()
    {
        return $this->get('contactType');
    }

    /**
     * Sets the sales tax rule's contact type.
     *
     * @param string $enum Contact type
     *
     * @return $this
     */
    public function setContactType($enum)
    {
        return $this->set('contactType', $enum);
    }

    /**
     * Returns the sales tax rule's tax rate ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTaxRate()
    {
        return $this->get('taxRateId');
    }

    /**
     * Set the tax rate rule's tax rate ID.
     *
     * @param string $apiID Tax rate API ID
     *
     * @return $this
     */
    public function setTaxRate($apiID)
    {
        return $this->set('taxRateId', $apiID);
    }

    /**
     * Get the sales tax rule's priority.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getPriority()
    {
        return $this->get('priority');
    }

    /**
     * Set the sales tax rule's priority.
     *
     * @param int $int Priority
     *
     * @return $this
     */
    public function setPriority($int)
    {
        return $this->set('priority', (int) $int);
    }
}

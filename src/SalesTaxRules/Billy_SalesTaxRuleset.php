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

namespace BillysBilling\SalesTaxRules;

use BillysBilling\Billy_Entity;

/**
 * Class Billy_AccountNature
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_SalesTaxRuleset extends Billy_Entity
{
    /**
     * Returns the organization ID
     *
     * @note: Marked as immutable by the API.
     *
     * @return string
     * @throws \Exception
     */
    public function getOrganization()
    {
        return $this->get('organizationId');
    }

    /**
     * Returns the name for the sales tax ruleset.
     *
     * @return string
     * @throws \Exception
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Sets the sales tax ruleset's name.
     *
     * @param string $string Name to set
     *
     * @return $this
     */
    public function setName($string)
    {
        return $this->set('name', $string);
    }

    /**
     * Returns the sales tax ruleset's abbreviation.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAbbreviation()
    {
        return $this->get('abbreviation');
    }

    /**
     * Sets the sales tax ruleset's abbreviation.
     *
     * @param string $string abbreviation
     *
     * @return $this
     */
    public function setAbbreviation($string)
    {
        return $this->set('abbreviation', $string);
    }

    /**
     * Returns the sales tax ruleset's description
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * Sets the sales tax rulesets's description
     *
     * @param string $string Description
     *
     * @return $this
     */
    public function setDescription($string)
    {
        return $this->set('description', $string);
    }

    /**
     * Returns the ruleset's fallback tax rate ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getFallbackTaxRateID()
    {
        return $this->get('fallbackTaxRateId');
    }

    /**
     * Returns if this sales tax ruleset was predefined.
     *
     * @return mixed
     * @throws \Exception
     */
    public function isPredefined()
    {
        return $this->get('isPredefined');
    }
}

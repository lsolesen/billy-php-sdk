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
class Billy_SalesTaxRule extends Billy_Entity
{
    public function getRuleset() {
        // @todo: Should this return Billy_SalesTaxRulset.
        return $this->get('ruleset');
    }

    public function setRuleset($apiID) {
        return $this->set('ruleset', $apiID);
    }

    public function getCountry() {
        return $this->get('country');
    }

    public function setCountry($string) {
        return $this->set('country', $string);
    }

    public function getState() {
        return $this->get('state');
    }

    public function setState($string) {
        return $this->set('state', $string);
    }

    public function getCountryGroup() {
        return $this->get('countryGroup');
    }

    public function setCountryGroup($apiID) {
        return $this->get('countryGroup', $apiID);
    }

    public function getContactType() {
        return $this->get('contactType');
    }

    public function setContactType($enum) {
        return $this->set('contactType', $enum);
    }

    public function getTaxRate() {
        return $this->get('taxRate');
    }

    public function setTaxRate($apiID) {
        return $this->set('taxRate', $apiID);
    }

    public function getPriority() {
        return $this->get('priority');
    }

    public function setPriority($int) {
        return $this->set('priority', (int) $int);
    }
}
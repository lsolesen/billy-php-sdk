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
    public function getOrganization() {
        // @todo: This should return an organization entity object.
        return $this->get('organization');
    }

    public function setOrganization($apiID) {
        return $this->set('organization', $apiID);
    }

    public function getName() {
        return $this->get('name');
    }

    public function setName($string) {
        return $this->set('name', $string);
    }

    public function getAbbreviation() {
        return $this->get('abbreviation');
    }

    public function setAbbreviation($enum) {
        return $this->set('abbreviation', $enum);
    }
}
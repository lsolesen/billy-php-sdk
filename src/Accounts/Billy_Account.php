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
 * Class Billy_Account
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Account extends Billy_Entity
{

    /**
     * Required properties to create an account.
     * @return array
     */
    public function requiredProperties()
    {
        return array(
          'organization',
          'group',
        );
    }

    public function getOrganization() {
        // @todo: This should return an organization entity object.
        return $this->get('organization');
    }

    public function setOrganization(Billy_Organization $organization) {
        return $this->set('organization', $organization->get('id'));
    }

    public function getName() {
        return $this->get('name');
    }

    public function setName($string) {
        return $this->set('name', $string);
    }

    public function getAccountNo() {
        return $this->get('accountNo');
    }

    public function setAccountNo($int) {
        return $this->set('accountNo', $int);
    }

    public function getDescription() {
        return $this->get('description');
    }

    public function setDescription($string) {
        return $this->set('description', $string);
    }

    public function getGroup() {
        // @todo: This should return a loaded Billy_AccountGroup.
        return $this->get('group');
    }

    public function setGroup(Billy_AccountGroup $group) {
        return $this->set('group', $group->getID());
    }

    public function getNature() {
        // @todo: This should return a loaded Billy_AccountNature.
        return $this->get('nature');
    }

    public function setNature(Billy_AccountNature $nature) {
        return $this->set('nature', $nature->getID());
    }

    public function getSystemRole() {
        return $this->get('systemRole');
    }

    public function setSystemRole($enum) {
        return $this->set('systemRole', $enum);
    }

    // @todo: currency belongs-to, need entity object handler
    // @todo: taxRate belongs-to, need entity object handler

    public function isPaymentEnabled() {
        return (bool) $this->get('isPaymentEnabled');
    }

    public function setPaymentsEnabled($bool) {
        return $this->set('isPaymentEnabled', (bool) $bool);
    }

    public function isBankAccount() {
        return (bool) $this->get('isBankAccount');
    }

    public function setIsBankAccount($bool) {
        return $this->set('isBankAccount', (bool) $bool);
    }

    public function isArchived() {
        return (bool) $this->get('isArchived');
    }

    public function setIsArchived($bool) {
        return $this->set('isArchived', (bool) $bool);
    }

    public function getBankName() {
        return $this->get('bankName');
    }

    public function getBankRoutingNo() {
        return $this->get('bankRoutingNo');
    }

    public function getBankAccountNo() {
        return $this->get('bankAccountNo');
    }

    public function getBankSwift() {
        return $this->get('bankSwift');
    }

    public function getBankIBan() {
        return $this->get('bankIban');
    }

    public function getCommentAssociations() {
        return $this->get('commentAssociations');
    }
}
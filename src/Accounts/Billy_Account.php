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

    /**
     * Returns the Organization API ID the account belongs to.
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
     * Returns the name for the account.
     *
     * @return string
     * @throws \Exception
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Sets the account's name.
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
     * Returns the account number
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAccountNo()
    {
        return $this->get('accountNo');
    }

    /**
     * Sets the account's number
     *
     * @param int $int Account number
     *
     * @return $this
     */
    public function setAccountNo($int)
    {
        return $this->set('accountNo', $int);
    }

    /**
     * Returns the account's description
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * Sets the account's description
     *
     * @param string $string Account description
     *
     * @return $this
     */
    public function setDescription($string)
    {
        return $this->set('description', $string);
    }

    /**
     * Returns the group ID this account belongs to
     *
     * @return mixed
     * @throws \Exception
     */
    public function getGroup()
    {
        return $this->get('groupId');
    }

    /**
     * Sets an account's group ID.
     *
     * @param string $apiID Group ID
     *
     * @return $this
     */
    public function setGroup($apiID)
    {
        return $this->set('groupId', $apiID);
    }

    /**
     * Returns the nature ID the account belongs to.
     *
     * @note: Marked as immutable by API, defaults to "unknown."
     *
     * @return mixed
     * @throws \Exception
     */
    public function getNature()
    {
        return $this->get('natureId');
    }

    /**
     * Return the account's system role.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getSystemRole()
    {
        return $this->get('systemRole');
    }

    /**
     * Set the system role for the account
     *
     * @param array $enum System roles
     *
     * @return $this
     */
    public function setSystemRole($enum)
    {
        return $this->set('systemRole', $enum);
    }

    /**
     * Returns the currency ID used by the account
     *
     * @note: Marked as immutable by the API/
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCurrency()
    {
        return $this->get('currencyId');
    }

    /**
     * Returns the account's tax rate ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTaxRateID()
    {
        return $this->get('taxRateId');
    }

    /**
     * Sets the account's tax rate ID
     *
     * @param string $apiID Tax rate ID
     *
     * @return $this
     */
    public function setTaxRateID($apiID)
    {
        return $this->set('taxRateId', $apiID);
    }

    /**
     * Returns boolean on payments enabled.
     *
     * @return bool
     * @throws \Exception
     */
    public function isPaymentEnabled()
    {
        return (bool) $this->get('isPaymentEnabled');
    }

    /**
     * Returns boolean if account is a bank account.
     *
     * @return bool
     * @throws \Exception
     */
    public function isBankAccount()
    {
        return (bool) $this->get('isBankAccount');
    }

    /**
     * Returns boolean is account is archived.
     *
     * Items which cannot be deleted, for information integrity, become marked
     * instead as archived.
     *
     * @return bool
     * @throws \Exception
     */
    public function isArchived()
    {
        return (bool) $this->get('isArchived');
    }

    /**
     * Returns the bank name of the account
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBankName()
    {
        return $this->get('bankName');
    }

    /**
     * Returns the bank routing number of the account
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBankRoutingNo()
    {
        return $this->get('bankRoutingNo');
    }

    /**
     * Returns the bank account number of the account
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBankAccountNo()
    {
        return $this->get('bankAccountNo');
    }

    /**
     * Returns the bank SWIFT codes
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBankSwift()
    {
        return $this->get('bankSwift');
    }

    /**
     * Returns the bank IBAN codes
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBankIBan()
    {
        return $this->get('bankIban');
    }
}

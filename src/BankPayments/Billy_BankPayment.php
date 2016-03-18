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

namespace BillysBilling\BankPayments;

use BillysBilling\Billy_Entity;

/**
 * Class Billy_BankPayment
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_BankPayment extends Billy_Entity
{

    /**
     * Returns the bank payment's entry date.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getEntryDate()
    {
        return $this->get('entryDate');
    }

    /**
     * Sets the bank payment's date time.
     *
     * @param \DateTime $dateTime Date time object
     *
     * @return $this
     */
    public function setEntryDate(\DateTime $dateTime)
    {
        return $this->set('entryDate', $dateTime->format('Y-m-d'));
    }

    /**
     * Returns the Contact API ID the payment is associated with.
     * @return mixed
     * @throws \Exception
     */
    public function getContactID()
    {
        return $this->get('contactId');
    }

    /**
     * Sets the contact ID this invoice belongs to.
     *
     * @param string $apiID The contact ID
     *
     * @return $this
     */
    public function setContactID($apiID)
    {
        return $this->set('contactId', $apiID);
    }
}

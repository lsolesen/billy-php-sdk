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

namespace Billy\BankPayments;

use Billy\Entity;

/**
 * Class BankPayment
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class BankPayment extends Entity
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

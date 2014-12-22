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

namespace BillysBilling\Payments;

use BillysBilling\Billy_Entity;

/**
 * Class Billy_Payment
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Payment extends Billy_Entity
{

    /**
     * Properties required for creation.
     * @return array
     */
    public function requiredProperties()
    {
        return array(
          'paidDate',
          'accountId',
          'amount',
          'invoiceIds',
        );
    }

    /**
     * Payment paid date.
     *
     * @todo: Should this have option to return unix timestamp vs raw format?
     *
     * @return mixed
     * @throws \Exception
     */
    public function getPaidDate()
    {
        return $this->get('paidDate');
    }

    /**
     * Set payment date
     * @param string $timestamp Unix timestamp of payment.
     * @return $this
     */
    public function setPaidDate($timestamp)
    {
        return $this->set('paidDate', date('o-m-d', $timestamp));
    }

    /**
     * Get the account ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAccountID()
    {
        return $this->get('accountId');
    }

    /**
     * Set the account ID.
     *
     * @param string $string Account ID
     *
     * @return $this
     */
    public function setAccountID($string)
    {
        return $this->set('accountId', $string);
    }

    /**
     * Returns payment amount.
     *
     * @return float
     * @throws \Exception
     */
    public function getAmount()
    {
        return (float) $this->get('amount');
    }

    /**
     * Sets the payment amount
     *
     * @param mixed $float Payment amount
     *
     * @return $this
     * @throws \Exception
     */
    public function setAmount($float)
    {
        if (is_numeric($float)) {
            return $this->set('amount', (float) $float);
        } else {
            throw new \Exception('Payment amounts must be numeric');
        }
    }

    /**
     * Returns the invoice IDs
     *
     * @return array|mixed
     * @throws \Exception
     */
    public function getInvoiceIDs()
    {
        $invoiceIDs = $this->get('invoiceIds');
        return empty($invoiceIDs) ? $invoiceIDs : array();
    }

    /**
     * Set invoice IDs
     *
     * @param string[] $invoiceIDs Array of invoice IDs
     *
     * @return $this
     * @throws \Exception
     */
    public function setInvoiceIDs($invoiceIDs)
    {
        if (is_array($invoiceIDs)) {
            return $this->set('invoiceIds', $invoiceIDs);
        } else {
            throw new \Exception('Invoice IDs must be an array of IDs');
        }
    }
}
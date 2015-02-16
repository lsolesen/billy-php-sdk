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

namespace BillysBilling\Invoices;

use BillysBilling\Billy_Entity;

/**
 * Class Billy_InvoiceLine
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_InvoiceLine extends Billy_Entity
{
    /**
     * Return the invoice line's invoice ID
     *
     * @return mixed
     * @throws \Exception
     */
    function getInvoiceID()
    {
        return $this->get('invoiceId');
    }

    /**
     * Return the invoice line's product ID
     *
     * @return mixed
     * @throws \Exception
     */
    function getProductID()
    {
        return $this->get('productId');
    }

    /**
     * Set Product ID
     *
     * @param string $apiID API ID
     *
     * @return $this
     */
    function setProductID($apiID)
    {
        return $this->set('productId', $apiID);
    }

    /**
     * Return the line item's description.
     *
     * @return mixed
     * @throws \Exception
     */
    function getDescription()
    {
        return $this->get('description');
    }

    /**
     * Set the line item's description.
     *
     * @param string $string Description
     *
     * @return $this
     */
    function setDescription($string)
    {
        return $this->set('description', $string);
    }

    /**
     * Return the line item's quantity.
     *
     * @return mixed
     * @throws \Exception
     */
    function getQuantity()
    {
        return $this->get('quantity');
    }

    /**
     * Set the line item's quantity.
     *
     * @param int $quantity Quantity
     *
     * @return $this
     */
    function setQuantity($quantity = 1)
    {
        return $this->set('quantity', $quantity);
    }

    /**
     * Return the unit price.
     *
     * @return mixed
     * @throws \Exception
     */
    function getUnitPrice()
    {
        return $this->get('unitPrice');
    }

    /**
     * Set Unit Price
     *
     * @param float $float Price
     *
     * @return $this
     */
    function setUnitPrice($float)
    {
        return $this->set('unitPrice', $float);
    }

    /**
     * Return the line item's amount.
     *
     * @return mixed
     * @throws \Exception
     */
    function getAmount()
    {
        return $this->get('amount');
    }

    /**
     * Return the line item's tax.
     *
     * @return mixed
     * @throws \Exception
     */
    function getTax()
    {
        return $this->get('tax');
    }

    /**
     * Return the line item's tax rate.
     *
     * @return mixed
     * @throws \Exception
     */
    function getTaxRate()
    {
        return $this->get('taxRateId');
    }

    /**
     * Returns the line item's priority.
     *
     * @return int
     * @throws \Exception
     */
    function getPriority()
    {
        return $this->get('priority');
    }

    /**
     * Sets the line item's priority.
     *
     * @param int $int Priority
     *
     * @return $this
     */
    function setPriority($int)
    {
        return $this->set('priority', $int);
    }
}

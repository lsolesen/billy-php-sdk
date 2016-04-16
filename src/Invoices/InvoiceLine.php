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

namespace Billy\Invoices;

use Billy\Entity;

/**
 * Class InvoiceLine
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class InvoiceLine extends Entity
{
    /**
     * Return the invoice line's invoice ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getInvoiceID()
    {
        return $this->get('invoiceId');
    }

    /**
     * Return the invoice line's product ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getProductID()
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
    public function setProductID($apiID)
    {
        return $this->set('productId', $apiID);
    }

    /**
     * Return the line item's description.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDescription()
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
    public function setDescription($string)
    {
        return $this->set('description', $string);
    }

    /**
     * Return the line item's quantity.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getQuantity()
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
    public function setQuantity($quantity = 1)
    {
        return $this->set('quantity', $quantity);
    }

    /**
     * Return the unit price.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getUnitPrice()
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
    public function setUnitPrice($float)
    {
        return $this->set('unitPrice', $float);
    }

    /**
     * Return the line item's amount.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAmount()
    {
        return $this->get('amount');
    }

    /**
     * Return the line item's tax.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTax()
    {
        return $this->get('tax');
    }

    /**
     * Return the line item's tax rate.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTaxRate()
    {
        return $this->get('taxRateId');
    }

    /**
     * Returns the line item's priority.
     *
     * @return int
     * @throws \Exception
     */
    public function getPriority()
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
    public function setPriority($int)
    {
        return $this->set('priority', $int);
    }
}

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
    function getInvoiceID()
    {
        return $this->get('invoiceId');
    }

    function getProductID()
    {
        return $this->get('productId');
    }

    /**
     * @param $apiID
     *
     * @return $this
     */
    function setProductID($apiID)
    {
        return $this->set('productId', $apiID);
    }

    function getDescription()
    {
        return $this->get('description');
    }

    function setDescription($string)
    {
        return $this->set('description', $string);
    }

    function getQuantity()
    {
        return $this->get('quantity');
    }

    function setQuantity($quantity = 1)
    {
        return $this->set('quantity', $quantity);
    }

    function getUnitPrice()
    {
        return $this->get('unitPrice');
    }

    /**
     * @param $float
     *
     * @return $this
     */
    function setUnitPrice($float)
    {
        return $this->set('unitPrice', $float);
    }

    function getAmount()
    {
        return $this->get('amount');
    }

    function getTax()
    {
        return $this->get('tax');
    }

    function getTaxRate()
    {
        return $this->get('taxRateId');
    }
}

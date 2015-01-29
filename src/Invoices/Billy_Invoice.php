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
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_Invoice
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Invoice extends Billy_Entity
{
    const SENT_STATE_UNSENT = 'unsent';
    const SENT_STATE_PRINTED = 'printed';
    const SENT_STATE_SENT = 'sent';
    const SENT_STATE_OPENED = 'opened';
    const SENT_STATE_VIEWED = 'viewed';

    public function __construct($entity = null)
    {
        parent::__construct($entity);
        if ($entity === null)
        {
            $this->entity->state = 'draft';
        }
    }

    /**
     * Returns the organization ID
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

    public function getType()
    {
        return $this->get('type');
    }

    public function setType($type)
    {
        return $this->set('type', $type);
    }

    public function getCreatedTime()
    {
        return $this->get('createdTime');
    }

    public function getApprovedTime()
    {
        return $this->get('approvedTime');
    }

    public function getContactID()
    {
        return $this->get('contactId');
    }

    public function setContactID($apiID)
    {
        return $this->set('contactId', $apiID);
    }

    public function getAttContactID()
    {
        return $this->get('attContactPersonId');
    }

    public function setAttContactID($apiID)
    {
        return $this->set('attContactPersonId', $apiID);
    }

    public function getEntryDate()
    {
        return $this->get('entryDate');
    }

    public function setEntryDate(\DateTime $dateTime)
    {
        return $this->set('entryDate', $dateTime->format('Y-m-d'));
    }

    public function getPaymentTermsMode()
    {
        return $this->get('paymentTermsMode');
    }

    /**
     * @param $mode
     *
     * @return $this
     */
    public function setPaymentTermsMode($mode)
    {
        return $this->set('paymentTermsMode', $mode);
    }

    public function getPaymentTermsDays()
    {
        return $this->get('paymentTermsDays');
    }

    public function setPaymentTermsDays($days)
    {
        return $this->set('paymentTermsDays', $days);
    }

    public function getState()
    {
        return $this->get('state');
    }

    public function setApproved()
    {
        // Invoices can only move from draft -> approved.
        return $this->set('state', 'approved');
    }

    public function isApproved()
    {
        return ($this->getState() == 'approved');
    }

    public function getSentState()
    {
        return $this->get('sentState');
    }

    public function setSentState($const)
    {
        return $this->set('sentState', $const);
    }

    public function getInvoiceNo()
    {
        return $this->get('invoiceNo');
    }

    public function setInvoiceNo($no)
    {
        if ($this->getInvoiceNo()) {
            throw new Billy_Exception('Cannot change an existing invoice number');
        }
        return $this->set('invoiceNo', $no);
    }

    public function getTaxMode()
    {
        return $this->get('taxMode');
    }

    public function setTaxMode($taxMode)
    {
        return $this->set('taxMode', $taxMode);
    }

    public function getAmount()
    {
        return $this->get('amount');
    }

    public function getTax()
    {
        return $this->get('tax');
    }

    public function getCurrencyID()
    {
        return $this->get('currencyId');
    }

    public function setCurrencyID($apiID)
    {
        return $this->set('currencyId', $apiID);
    }

    public function getBalance()
    {
        return $this->get('balance');
    }

    public function isPaid()
    {
        return $this->get('isPaid');
    }

    public function getCreditedInvoice()
    {
        return $this->get('creditedInvoiceId');
    }

    public function getContactMessage()
    {
        return $this->get('contactMessage');
    }

    public function setContactMessage($message)
    {
        return $this->set('contactMessage', $message);
    }

    public function getLineDescription()
    {
        return $this->get('lineDescription');
    }

    public function getDownloadURL()
    {
        return $this->get('downloadUrl');
    }

    /**
     * @param Billy_InvoiceLine[] $invoiceLines
     *
     * @return $this
     * @throws \BillysBilling\Exception\Billy_Exception
     */
    public function setLines($invoiceLines)
    {
        if ($this->isApproved())
        {
            throw new Billy_Exception('Cannot add lines to an approved invoice');
        }

        $toArray = array();
        foreach ($invoiceLines as $key => $invoiceLine)
        {
            $toArray[$key] = $invoiceLine->toArray();
        }

        return $this->set('lines', $toArray);
    }

    public function getDueDate()
    {
        return $this->get('dueDate');
    }
}

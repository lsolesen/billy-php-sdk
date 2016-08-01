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
use Billy\Exception\BillyException;

/**
 * Class Invoice
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Invoice extends Entity
{
    const STATE_DRAFT = 'draft';
    const STATE_APPROVED = 'approved';
    const STATE_VOIDED = 'voided';

    const SENT_STATE_UNSENT = 'unsent';
    const SENT_STATE_PRINTED = 'printed';
    const SENT_STATE_SENT = 'sent';
    const SENT_STATE_OPENED = 'opened';
    const SENT_STATE_VIEWED = 'viewed';

    /**
     * Constructor
     *
     * @param object $entity Entity
     */
    public function __construct($entity = null)
    {
        parent::__construct($entity);
        if ($entity === null) {
            $this->entity->state = self::STATE_DRAFT;
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

    /**
     * Returns the invoice type.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getType()
    {
        return $this->get('type');
    }

    /**
     * Set the invoice type.
     *
     * @param string $type Type
     *
     * @return $this
     */
    public function setType($type)
    {
        return $this->set('type', $type);
    }

    /**
     * Return the time the invoice was created.
     *
     * @return \DateTime
     * @throws \Exception
     */
    public function getCreatedTime()
    {
        return new \DateTime($this->get('createdTime'));
    }

    /**
     * Returns when the invoice was approved.
     *
     * @return \DateTime
     * @throws \Exception
     */
    public function getApprovedTime()
    {
        return new \DateTime($this->get('approvedTime'));
    }

    /**
     * Returns the Invoice contact ID
     *
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
     * @param string $apiID Contact ID
     *
     * @return $this
     */
    public function setContactID($apiID)
    {
        return $this->set('contactId', $apiID);
    }

    /**
     * Get the attention contact Id
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAttContactID()
    {
        return $this->get('attContactPersonId');
    }

    /**
     * Set the attention contact contact ID
     *
     * @param string $apiID Api ID
     *
     * @return $this
     */
    public function setAttContactID($apiID)
    {
        return $this->set('attContactPersonId', $apiID);
    }

    /**
     * Returns the entry date
     *
     * @return \DateTime
     * @throws \Exception
     */
    public function getEntryDate()
    {
        return new \DateTime($this->get('entryDate'));
    }

    /**
     * Set the invoice entry date
     *
     * @param \DateTime $dateTime Date
     *
     * @return $this
     */
    public function setEntryDate(\DateTime $dateTime)
    {
        return $this->set('entryDate', $dateTime->format('Y-m-d'));
    }

    /**
     * Return the payment terms
     *
     * @return mixed
     * @throws \Exception
     */
    public function getPaymentTermsMode()
    {
        return $this->get('paymentTermsMode');
    }

    /**
     * Set the payment terms mode.
     *
     * @param string $mode Mode
     *
     * @return $this
     */
    public function setPaymentTermsMode($mode)
    {
        return $this->set('paymentTermsMode', $mode);
    }

    /**
     * Return the payment term days.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getPaymentTermsDays()
    {
        return $this->get('paymentTermsDays');
    }

    /**
     * Set the payment term days.
     *
     * @param int $days Days
     *
     * @return $this
     */
    public function setPaymentTermsDays($days)
    {
        return $this->set('paymentTermsDays', $days);
    }

    /**
     * Get the current invoice state.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getState()
    {
        return $this->get('state');
    }

    /**
     * Mark the invoice as approved.
     *
     * @return $this
     */
    public function setApproved()
    {
        // Invoices can only move from draft -> approved.
        return $this->set('state', self::STATE_APPROVED);
    }

    /**
     * Return if the invoice was approved.
     *
     * @return bool
     */
    public function isApproved()
    {
        return ($this->getState() == self::STATE_APPROVED);
    }

    /**
     * Return the sent state.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getSentState()
    {
        return $this->get('sentState');
    }

    /**
     * Set the sent state.
     *
     * @param string $const State
     *
     * @return $this
     */
    public function setSentState($const)
    {
        return $this->set('sentState', $const);
    }

    /**
     * Return the invoice number.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getInvoiceNo()
    {
        return $this->get('invoiceNo');
    }

    /**
     * Set the invoice number.
     *
     * @param string $no Invoice number
     *
     * @return $this
     */
    public function setInvoiceNo($no)
    {
        return $this->set('invoiceNo', $no);
    }

    /**
     * Return the invoice's tax mode.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTaxMode()
    {
        return $this->get('taxMode');
    }

    /**
     * Set the invoice tax mode.
     *
     * @param string $taxMode Mode
     *
     * @return $this
     */
    public function setTaxMode($taxMode)
    {
        return $this->set('taxMode', $taxMode);
    }

    /**
     * Get the invoice total amount.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAmount()
    {
        return $this->get('amount');
    }

    /**
     * Get the invoice's tax.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTax()
    {
        return $this->get('tax');
    }

    /**
     * Get the invoice's currency ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCurrencyID()
    {
        return $this->get('currencyId');
    }

    /**
     * Set the invoice currency ID
     *
     * @param string $apiID Currency ID
     *
     * @return $this
     */
    public function setCurrencyID($apiID)
    {
        return $this->set('currencyId', $apiID);
    }

    /**
     * Returns the invoice's balance.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getBalance()
    {
        return $this->get('balance');
    }

    /**
     * Return if this invoice has been paid or not.
     *
     * @return mixed
     * @throws \Exception
     */
    public function isPaid()
    {
        return $this->get('isPaid');
    }

    /**
     * Return the credited invoice ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCreditedInvoice()
    {
        return $this->get('creditedInvoiceId');
    }

    /**
     * Return the contact message.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getContactMessage()
    {
        return $this->get('contactMessage');
    }

    /**
     * Sets message for invoice.
     *
     * @param string $message Message
     *
     * @return $this
     */
    public function setContactMessage($message)
    {
        return $this->set('contactMessage', $message);
    }

    /**
     * Returns line description.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getLineDescription()
    {
        return $this->get('lineDescription');
    }

    /**
     * Returns public PDF download URL.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDownloadURL()
    {
        return $this->get('downloadUrl');
    }

    /**
     * Sets the invoice line items.
     *
     * @param InvoiceLine[] $invoiceLines An array of InvoiceLine objects
     *
     * @return $this
     * @throws \Billy\Exception\BillyException
     */
    public function setLines($invoiceLines)
    {
        if ($this->isApproved()) {
            throw new BillyException('Cannot add lines to an approved invoice');
        }

        $toArray = array();
        foreach ($invoiceLines as $key => $invoiceLine) {
            $toArray[$key] = $invoiceLine->toArray();
        }

        return $this->set('lines', $toArray);
    }

    /**
     * Returns the invoice's due date.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDueDate()
    {
        return $this->get('dueDate');
    }

    /**
     * Gets order number.
     *
     * @param integer $order_number Order number
     *
     * @return mixed
     * @throws \Exception
     */
    public function getOrderNumber()
    {
        return $this->get('orderNo');
    }

    /**
     * Sets order number.
     *
     * @param integer $order_number Order number
     *
     * @return $this
     */
    public function setOrderNumber($order_number)
    {
        return $this->set('orderNo', $order_number);
    }
}

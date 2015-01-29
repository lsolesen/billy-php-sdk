<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 12/29/14
 * Time: 3:43 PM
 */

namespace BillysBilling\Tests\Invoices;

use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;
use BillysBilling\Invoices\Billy_Invoice;
use BillysBilling\Invoices\Billy_InvoicesRepository;
use BillysBilling\Invoices\Billy_InvoiceLine;

class InvoicesRepositoryTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Billy_Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Billy_Invoice[]
     */
    protected $invoices;
    /**
     * @var Billy_InvoicesRepository
     */
    protected $invoicesRepository;

    public function __construct() {
        $this->request = new Billy_Request($this->api_key);
    }

    public function testInvoiceRepositoryConstruct() {
        // Ensure that the AccountGroupsRepository can be initiated.
        $repository = new Billy_InvoicesRepository($this->request);

        $this->assertNotNull($repository, 'Able to initiate invoices repository');

        return $this->invoicesRepository = $repository;
    }

    public function testCreateInvoice() {
        $invoiceStub = new Billy_Invoice();
        $invoiceStub
          ->setEntryDate(new \DateTime('now', new \DateTimeZone('UTC')))
          ->setPaymentTermsMode('net')
          ->setPaymentTermsDays(7)
          ->setContactID('d33H9E5QQcCJtcqCsI40NQ');

        $testLine = new Billy_InvoiceLine();
        $testLine->setProductID('1simCQJJSLuasLdWiyxUKg')
            ->setUnitPrice(10);

        $invoiceStub->setLines(array($testLine));

        $invoicesRepository = $this->testInvoiceRepositoryConstruct();
        /** @var Billy_Invoice $createdInvoice */
        $createdInvoice = $invoicesRepository->create($invoiceStub);

        try {
            $createdInvoice->getCreatedTime();
            $createdInvoice->getDueDate();
        }
        catch (Billy_Exception $e)
        {
            $this->fail('Failed to generate invoice');
        }

    }

    public function testInvoicesRepositoryGetAll() {

        $repository = $this->testInvoiceRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Group repository returned results');

        return $this->invoices = $results;
    }

    public function testInvoiceRepositoryGetSingle() {
        /** @var Billy_Invoice $firstContact */
        $invoices = $this->testInvoicesRepositoryGetAll();
        $firstInvoice = end($invoices);

        $invoicesRepository = $this->testInvoiceRepositoryConstruct();
        $invoice = $invoicesRepository->getSingle($firstInvoice->getID());
        $this->assertNotEmpty($invoice);
        $this->assertNotEmpty($invoice->getDueDate());
        return $invoice;
    }
}

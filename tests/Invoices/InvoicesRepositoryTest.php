<?php

namespace BillysBilling\Tests\Invoices;

use BillysBilling\Client\Request;
use BillysBilling\Exception\Exception;
use BillysBilling\Invoices\Invoice;
use BillysBilling\Invoices\InvoicesRepository;
use BillysBilling\Invoices\InvoiceLine;

class InvoicesRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Invoice[]
     */
    protected $invoices;
    /**
     * @var InvoicesRepository
     */
    protected $invoicesRepository;

    public function __construct()
    {
        $this->request = new Request($this->api_key);
    }

    public function testInvoiceRepositoryConstruct()
    {
        // Ensure that the AccountGroupsRepository can be initiated.
        $repository = new InvoicesRepository($this->request);

        $this->assertNotNull($repository, 'Able to initiate invoices repository');

        return $this->invoicesRepository = $repository;
    }

    public function testCreateInvoice()
    {
        $invoiceStub = new Invoice();
        $invoiceStub
          ->setEntryDate(new \DateTime('now', new \DateTimeZone('UTC')))
          ->setPaymentTermsMode('net')
          ->setPaymentTermsDays(7)
          ->setContactID('d33H9E5QQcCJtcqCsI40NQ');

        $testLine = new InvoiceLine();
        $testLine->setProductID('1simCQJJSLuasLdWiyxUKg')
            ->setUnitPrice(10);

        $invoiceStub->setLines(array($testLine));

        $invoicesRepository = $this->testInvoiceRepositoryConstruct();
        /** @var Invoice $createdInvoice */
        $createdInvoice = $invoicesRepository->create($invoiceStub);

        try {
            $createdInvoice->getCreatedTime();
            $createdInvoice->getDueDate();
        } catch (BillyException $e) {
            $this->fail('Failed to generate invoice');
        }

    }

    public function testInvoicesRepositoryGetAll()
    {

        $repository = $this->testInvoiceRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Group repository returned results');

        return $this->invoices = $results;
    }

    public function testInvoiceRepositoryGetSingle()
    {
        /** @var Invoice $firstContact */
        $invoices = $this->testInvoicesRepositoryGetAll();
        $firstInvoice = end($invoices);

        $invoicesRepository = $this->testInvoiceRepositoryConstruct();
        $invoice = $invoicesRepository->getSingle($firstInvoice->getID());
        $this->assertNotEmpty($invoice);
        $this->assertNotEmpty($invoice->getDueDate());
        return $invoice;
    }
}

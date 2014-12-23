<?php

namespace BillysBilling\Tests\SalesTaxRules;

use BillysBilling\Client\Billy_Request;
use BillysBilling\SalesTaxRules\Billy_SalesTaxRuleset;
use BillysBilling\SalesTaxRules\Billy_SalesTaxRulesetsRepository;

class SalesTaxRulesetTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Billy_Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Billy_SalesTaxRuleset[]
     */
    protected $salesTaxRuleset;
    /**
     * @var Billy_SalesTaxRulesetsRepository
     */
    protected $salesTaxRulesetRepository;

    public function __construct() {
        $this->request = new Billy_Request($this->api_key);
    }

    public function testSalesTaxRulesetsRepositoryConstruct() {
        $repository = new Billy_SalesTaxRulesetsRepository($this->request);
        $this->assertNotNull($repository, 'Sales Tax Ruleset Repository created');
        return $this->salesTaxRulesetRepository = $repository;
    }

    public function testSalesTaxRulesetGetAll() {

        $repository = $this->testSalesTaxRulesetsRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Sales tax ruleset returned results');

        return $this->salesTaxRuleset = $results;

    }

    public function testSalesTaxRulesGetSingle() {
        $salesTaxRulesets = $this->testSalesTaxRulesetGetAll();
        /** @var Billy_SalesTaxRuleset $firstRuleset */
        $firstRuleset = reset($salesTaxRulesets);

        $repository = $this->testSalesTaxRulesetsRepositoryConstruct();
        $ruleset = $repository->getSingle($firstRuleset->getID());
        $this->assertEquals('Momsfrit', $ruleset->getName());
    }
}
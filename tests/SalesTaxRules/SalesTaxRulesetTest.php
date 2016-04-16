<?php

namespace Billy\Tests\SalesTaxRules;

use Billy\Client\Request;
use Billy\SalesTaxRules\SalesTaxRulesetsRepository;

class SalesTaxRulesetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var SalesTaxRuleset[]
     */
    protected $salesTaxRuleset;
    /**
     * @var SalesTaxRulesetsRepository
     */
    protected $salesTaxRulesetRepository;

    public function __construct()
    {
        $this->request = new Request($this->api_key);
    }

    public function testSalesTaxRulesetsRepositoryConstruct()
    {
        $repository = new SalesTaxRulesetsRepository($this->request);
        $this->assertNotNull($repository, 'Sales Tax Ruleset Repository created');
        return $this->salesTaxRulesetRepository = $repository;
    }

    public function testSalesTaxRulesetGetAll()
    {

        $repository = $this->testSalesTaxRulesetsRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Sales tax ruleset returned results');

        return $this->salesTaxRuleset = $results;

    }

    public function testSalesTaxRulesGetSingle()
    {
        $salesTaxRulesets = $this->testSalesTaxRulesetGetAll();
        /** @var SalesTaxRuleset $firstRuleset */
        $firstRuleset = reset($salesTaxRulesets);

        $repository = $this->testSalesTaxRulesetsRepositoryConstruct();
        $ruleset = $repository->getSingle($firstRuleset->getID());
        $this->assertEquals('Momsfrit', $ruleset->getName());
    }
}

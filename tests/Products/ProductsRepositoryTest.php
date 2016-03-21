<?php

namespace BillysBilling\Tests\Products;

use BillysBilling\Client\Request;
use BillysBilling\Exception\BillyException;
use BillysBilling\Products\Product;
use BillysBilling\Products\ProductsRepository;

class ProductsRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Product[]
     */
    protected $products;
    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    public function __construct()
    {
        $this->request = new Request($this->api_key);
    }

    public function testProuctsRepositoryConstruct()
    {
        // Ensure that the AccountGroupsRepository can be initiated.
        $repository = new ProductsRepository($this->request);

        $this->assertNotNull($repository, 'Able to initiate products repository');

        return $this->productsRepository = $repository;
    }

    public function testCreateProduct()
    {
        $testProductNo = 'test:' . mt_rand(1, 9999999);
        $productStub = new Product();
        $productStub
          ->setName('Test Product Creation')
          ->setProductNo($testProductNo)
          ->setSalesTaxRuleset('62klekuNSviJYK2MEgQGFA')
          ->set('prices', array(array('currencyId' => 'DKK', 'unitPrice' => '100')));

        $productsRepository = $this->testProuctsRepositoryConstruct();
        /** @var Product $createdProduct */
        $createdProduct = $productsRepository->create($productStub);

        $this->assertEquals('Test Product Creation', $createdProduct->getName());
        $this->assertEquals($testProductNo, $createdProduct->getProductNo());
        return $createdProduct;
    }

    public function testProductsRepositoryGetAll()
    {

        $repository = $this->testProuctsRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Group repository returned results');

        return $this->products = $results;
    }

    public function testProductsRepositoryGetSingle()
    {
        /** @var Product $firstContact */
        $products = $this->testProductsRepositoryGetAll();
        $firstProduct = end($products);

        $productsRepository = $this->testProuctsRepositoryConstruct();
        $product = $productsRepository->getSingle($firstProduct->getID());
        $this->assertNotEmpty($product);
        $this->assertNotEmpty($product->getName());
        return $product;
    }

    public function testDeleteProduct()
    {
        $product = $this->testCreateProduct();

        $productsRepository = $this->testProuctsRepositoryConstruct();
        $productsRepository->delete($product->getID());

        try {
            $test_deleted = $productsRepository->getSingle($product->getID());
            $this->fail('Failed to delete product');
        } catch (BillyException $e) {
            $this->assertEquals(
                'No `product` record with id `' . $product->getID() . '` was found.',
                $e->getMessage()
            );
        }
    }
}

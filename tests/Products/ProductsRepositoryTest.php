<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 12/29/14
 * Time: 3:43 PM
 */

namespace BillysBilling\Tests\Products;

use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;
use BillysBilling\Products\Billy_Product;
use BillysBilling\Products\Billy_ProductsRepository;

class ProductsRepositoryTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Billy_Request.
     */
    protected $request;

    protected $api_key = '2603a3bf205f88d1fe6df7fb26c4ce91eea74fe4';

    /**
     * @var Billy_Product[]
     */
    protected $products;
    /**
     * @var Billy_ProductsRepository
     */
    protected $productsRepository;

    public function __construct() {
        $this->request = new Billy_Request($this->api_key);
    }

    public function testProuctsRepositoryConstruct() {
        // Ensure that the AccountGroupsRepository can be initiated.
        $repository = new Billy_ProductsRepository($this->request);

        $this->assertNotNull($repository, 'Able to initiate products repository');

        return $this->productsRepository = $repository;
    }

    public function testCreateProduct() {
        $productStub = new Billy_Product();
        $productStub
          ->setName('Test Product Creation')
          ->setProductNo('12345');

        $productsRepository = $this->testProuctsRepositoryConstruct();
        /** @var Billy_Product $createdProduct */
        $createdProduct = $productsRepository->create($productStub);

        $this->assertEquals('Test Product Creation', $createdProduct->getName());
        $this->assertEquals('12345', $createdProduct->getProductNo());
    }

    public function testProductsRepositoryGetAll() {

        $repository = $this->testProuctsRepositoryConstruct();
        $results = $repository->getAll();
        $this->assertNotEmpty($results, 'Group repository returned results');

        return $this->products = $results;
    }

    public function testProductsRepositoryGetSingle() {
        /** @var Billy_Product $firstContact */
        $products = $this->testProductsRepositoryGetAll();
        $firstProduct = end($products);

        $productsRepository = $this->testProuctsRepositoryConstruct();
        $product = $productsRepository->getSingle($firstProduct->getID());
        $this->assertNotEmpty($product);
        $this->assertNotEmpty($product->getName());
        return $product;
    }

    public function testDeleteProduct() {
        $product = $this->testProductsRepositoryGetSingle();

        $productsRepository = $this->testProuctsRepositoryConstruct();
        $productsRepository->delete($product->getID());

        try {
            $test_deleted = $productsRepository->getSingle($product->getID());
            $this->fail('Failed to delete product');
        } catch (Billy_Exception $e) {
            $this->assertEquals(
              'No `product` record with id `' . $product->getID() . '` was found.',
              $e->getMessage()
            );
        }
    }
}

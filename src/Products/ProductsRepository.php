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

namespace Billy\Products;

use Billy\EntityRepository;
use Billy\Client\Request;

/**
 * Class ProductsRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class ProductsRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/products';
        $this->recordKey = 'product';
        $this->recordKeyPlural = 'products';
        $this->request = $request;
    }

    /**
     * Returns all account groups.
     *
     * @return Product[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $products = array();
        foreach ($response as $key => $product) {
            $products[$product->id] = new Product($product);
        }
        return $products;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Product
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Product($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Product $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Product($response->{$this->recordKeyPlural}[0]);
    }
}

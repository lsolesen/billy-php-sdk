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

namespace BillysBilling\Products;

use BillysBilling\Billy_Entity;

/**
 * Class Billy_Product
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Product extends Billy_Entity
{
    /**
     * Properties required for creation.
     * @return array
     */
    public function requiredProperties()
    {
        return array(
          'name',
        );
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
     * Returns the name for the product.
     *
     * @return string
     * @throws \Exception
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Sets the product's name.
     *
     * @param string $string Name to set
     *
     * @return $this
     */
    public function setName($string)
    {
        return $this->set('name', $string);
    }

    /**
     * Returns the product's description
     *
     * @return mixed
     * @throws \Exception
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * Sets the product's description
     *
     * @param string $string Product description
     *
     * @return $this
     */
    public function setDescription($string)
    {
        return $this->set('description', $string);
    }

    /**
     * Returns the account sales of the product should be coded to.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAccount()
    {
        return $this->get('accountId');
    }

    /**
     * Sets the account sales of the product should be coded to.
     *
     * @param string $apiID API ID
     *
     * @return $this
     */
    public function setAccount($apiID)
    {
        return $this->set('accountId', $apiID);
    }

    /**
     * Returns the product number.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getProductNo() 
    {
        return $this->get('productNo');
    }

    /**
     * Set the product number
     *
     * @param string $string Product number
     *
     * @return $this
     */
    public function setProductNo($string)
    {
        return $this->set('productNo', $string);
    }

    /**
     * Returns the product's supplier number.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getSuppliersProductNo()
    {
        return $this->get('suppliersProductNo');
    }

    /**
     * Set the product's supplier number.
     *
     * @param string $string Supplier number
     *
     * @return $this
     */
    public function setSuppliersProductNo($string)
    {
        return $this->set('suppliersProductNo', $string);
    }

    /**
     * Returns the product's Sales Tax Ruleset ID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getSalesTaxRuleset()
    {
        return $this->get('salesTaxRuleset');
    }

    /**
     * Set the product's Sales Tax Ruleset ID
     *
     * @param string $apiID Sales Tax Ruleset API ID
     *
     * @return $this
     */
    public function setSalesTaxRuleset($apiID)
    {
        return $this->set('salesTaxRuleset', $apiID);
    }

    /**
     * Return if the product has been archived.
     *
     * @return bool
     * @throws \Exception
     */
    public function isArchived() 
    {
        return (bool) $this->get('isArchived');
    }

    /**
     * Return the product's image ID.
     *
     * @note: Not documented yet in v2 API
     *
     * @return mixed
     * @throws \Exception
     */
    public function getImageID()
    {
        return $this->get('imageId');
    }

    // @todo: Implement a method to change image ID (or upload?)

    /**
     * Returns the product's image URL
     *
     * @note: Not documented yet in v2 API
     *
     * @return mixed
     * @throws \Exception
     */
    public function getImageURL()
    {
        return $this->get('imageUrl');
    }

    // @todo: API v2 docs specify "prices", but not yet returning.
}
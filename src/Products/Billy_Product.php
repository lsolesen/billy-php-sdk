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
     * @return $this
     * @throws \Exception
     */
    public function getOrganization()
    {
        // @todo: This should return an organization entity object.
        return $this->get('organization');
    }

    /**
     * @param $apiID
     * @return $this
     */
    public function setOrganization($apiID)
    {
        return $this->set('organization', $apiID);
    }

    public function getName()
    {
        return $this->get('name');
    }

    public function setName($string)
    {
        return $this->set('name', $string);
    }

    public function getAccount()
    {
        return $this->get('account');
    }

    public function setAccount($apiID)
    {
        return $this->set('account', $apiID);
    }

    public function getProductNo() {
        return $this->get('productNo');
    }

    /**
     * @param $string
     * @return $this
     */
    public function setProductNo($string)
    {
        return $this->set('productNo', $string);
    }

    public function getSuppliersProductNo()
    {
        return $this->get('suppliersProductNo');
    }

    public function setSuppliersProductNo($string)
    {
        return $this->set('suppliersProductNo', $string);
    }

    public function getSalesTaxRuleset()
    {
        return $this->get('salesTaxRuleset');
    }

    public function setSalesTaxRuleset($apiID)
    {
        return $this->set('salesTaxRuleset', $apiID);
    }

    public function isArchived() {
        return (bool) $this->get('isArchived');
    }

    public function getPrices()
    {
        return $this->get('prices');
    }

    public function setPrices($apiIDArray) {
        return $this->set('prices', $apiIDArray);
    }
}
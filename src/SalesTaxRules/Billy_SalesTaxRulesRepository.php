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

namespace BillysBilling\SalesTaxRules;

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_SalesTaxRulesRepository
 *
 * @todo: Rules are to be queries by a ruleset ID
 *         "You need to filter the list by `rulesetId`, i.e. by using
 *        `GET /salesTaxRules?rulesetId=123`."
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_SalesTaxRulesRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/salesTaxRules';
        $this->recordKey = 'salesTaxRule';
        $this->recordKeyPlural = 'salesTaxRules';
        $this->request = $request;
    }

    /**
     * Returns all account tax rules for a rule set.
     *
     * @todo: should should require a ?rulesetId=API_ID parameter.
     *
     * @return Billy_SalesTaxRule[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $taxRules = array();
        foreach ($response as $key => $taxRule) {
            $taxRules[$taxRule->id] = new Billy_SalesTaxRule($taxRule);
        }
        return $taxRules;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_SalesTaxRule
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_SalesTaxRule($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_SalesTaxRule $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_SalesTaxRule($response->{$this->recordKeyPlural}[0]);
    }
}
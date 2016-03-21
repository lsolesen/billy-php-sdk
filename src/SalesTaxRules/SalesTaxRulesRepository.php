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
 * @license   MIT Open Source License https://opensource.org/licenses/MIT
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/billysbilling
 */

namespace BillysBilling\SalesTaxRules;

use BillysBilling\EntityRepository;
use BillysBilling\Client\Request;
use BillysBilling\Exception\Exception;

/**
 * Class SalesTaxRulesRepository
 *
 * @todo: Rules are to be queries by a ruleset ID
 *         "You need to filter the list by `rulesetId`, i.e. by using
 *        `GET /salesTaxRules?rulesetId=123`."
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class SalesTaxRulesRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
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
     * @return SalesTaxRule[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $taxRules = array();
        foreach ($response as $key => $taxRule) {
            $taxRules[$taxRule->id] = new SalesTaxRule($taxRule);
        }
        return $taxRules;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return SalesTaxRule
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new SalesTaxRule($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param SalesTaxRule $object API Entity object
     *
     * @return SalesTaxRule
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new SalesTaxRule($response->{$this->recordKeyPlural}[0]);
    }
}

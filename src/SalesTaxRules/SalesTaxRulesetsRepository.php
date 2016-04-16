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

namespace Billy\SalesTaxRules;

use Billy\EntityRepository;
use Billy\Client\Request;
use Billy\Exception\Exception;

/**
 * Class SalesTaxRulesetsRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class SalesTaxRulesetsRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/salesTaxRulesets';
        $this->recordKey = 'salesTaxRuleset';
        $this->recordKeyPlural = 'salesTaxRulesets';
        $this->request = $request;
    }

    /**
     * Returns all account Natures.
     *
     * @return SalesTaxRuleset[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $natures = array();
        foreach ($response as $key => $ruleset) {
            $natures[$ruleset->id] = new SalesTaxRuleset($ruleset);
        }
        return $natures;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return SalesTaxRuleset
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new SalesTaxRuleset($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param SalesTaxRuleset $object API Entity object
     *
     * @return SalesTaxRuleset
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new SalesTaxRuleset($response->{$this->recordKeyPlural}[0]);
    }
}

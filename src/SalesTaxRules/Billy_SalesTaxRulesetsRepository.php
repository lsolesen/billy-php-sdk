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
 * Class Billy_AccountNaturesRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_SalesTaxRulesetsRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
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
     * @return Billy_SalesTaxRuleset[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $natures = array();
        foreach ($response as $key => $ruleset) {
            $natures[$ruleset->id] = new Billy_SalesTaxRuleset($ruleset);
        }
        return $natures;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_SalesTaxRuleset
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_SalesTaxRuleset($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_SalesTaxRuleset $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_SalesTaxRuleset($response->{$this->recordKeyPlural}[0]);
    }
}

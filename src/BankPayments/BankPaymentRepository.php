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

namespace Billy\BankPayments;

use Billy\EntityRepository;
use Billy\Client\Request;

/**
 * Class BankPaymentRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class BankPaymentRepository extends EntityRepository
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
     * @return BankPayment[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $payments = array();
        foreach ($response as $key => $payment) {
            $payments[$payment->id] = new BankPayment($payment);
        }
        return $payments;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return BankPayment
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new BankPayment($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param BankPayment $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new BankPayment($response->{$this->recordKeyPlural}[0]);
    }
}

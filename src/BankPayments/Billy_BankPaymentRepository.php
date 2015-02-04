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

namespace BillysBilling\BankPayments;

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_BankPaymentRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_BankPaymentRepository extends Billy_EntityRepository
{

    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
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
     * @return Billy_BankPayment[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $payments = array();
        foreach ($response as $key => $payment) {
            $payments[$payment->id] = new Billy_BankPayment($payment);
        }
        return $payments;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_BankPayment
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_BankPayment($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_BankPayment $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_BankPayment($response->{$this->recordKeyPlural}[0]);
    }
}
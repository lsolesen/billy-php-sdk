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

namespace BillysBilling\Payments;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_PaymentRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_PaymentRepository
{

    /**
     * API Client
     * @var Billy_Client;
     */
    protected $client;

    /**
     * Initiates repository with an API client.
     *
     * @param Billy_Client $client API Client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Lists payments.
     *
     * @return Billy_Payment[]
     * @throws Billy_Exception
     */
    public function listPayments()
    {
        $response = $this->client->get('/payments');
        if ($response->isSuccess()) {
            $payments = array();
            foreach ($response->getBody()->payments as $key => $data) {
                $payments[$data->id] = new Billy_Payment($data);
            }
        } else {
            throw new Billy_Exception('Unable to retrieve payments list.');
        }

        return $payments;
    }

    /**
     * Returns a payment entity from API.
     *
     * @param string $paymentID Payment ID
     *
     * @return Billy_Payment
     * @throws Billy_Exception
     */
    public function getPayment($paymentID)
    {
        $response = $this->client->get('/payments/' . $paymentID);
        if ($response->isSuccess()) {
            return new Billy_Payment($response->getBody());
        } else {
            throw new Billy_Exception(
                $response->getBody()->errorMessage,
                $response->getBody()->helpURL
            );
        }
    }

    /**
     * Creates a payment from a payment entity object.
     *
     * @param Billy_Payment $payment Payment entity
     *
     * @return mixed The payment's ID
     * @throws Billy_Exception
     * @throws \Exception
     */
    public function createPayment($payment)
    {
        try {
            $payment->validate();
        } catch (Billy_Exception $e) {
            throw new Billy_Exception(
                'Name and country ID are required for new contacts',
                'https://dev.billysbilling.dk/api/v1/contacts/create'
            );
        }

        $response = $this->client->post('/payments', $payment->toArray());
        if ($response->isSuccess()) {
            return $response->getBody()->id;
        } else {
            throw new Billy_Exception('There was an error creating the payment.');
        }
    }
}
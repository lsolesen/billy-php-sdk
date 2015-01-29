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

namespace BillysBilling\Invoices;

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_ProductsRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_InvoicesRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/invoices';
        $this->recordKey = 'invoice';
        $this->recordKeyPlural = 'invoices';
        $this->request = $request;
    }

    /**
     * Returns all account groups.
     *
     * @return Billy_Invoice[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $invoices = array();
        foreach ($response as $key => $invoice) {
            $invoices[$invoice->id] = new Billy_Invoice($invoice);
        }
        return $invoices;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_Invoice
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_Invoice($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_Invoice $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_Invoice($response->{$this->recordKeyPlural}[0]);
    }
}

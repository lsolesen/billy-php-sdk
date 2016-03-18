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
class Billy_InvoiceLinesRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/invoiceLines';
        $this->recordKey = 'invoiceLine';
        $this->recordKeyPlural = 'invoiceLines';
        $this->request = $request;
    }

    /**
     * Returns all account groups.
     *
     * @param integer $invoiceId Invoice ID
     *
     * @return Billy_InvoiceLine[]
     * @throws Billy_Exception
     */
    public function getAll($invoiceId)
    {
        $this->url = $this->url . '?invoiceId=' . $invoiceId;
        $response = parent::getAll();
        $invoiceLines = array();
        foreach ($response as $key => $invoiceLine) {
            $invoiceLines[$invoiceLine->id] = new Billy_InvoiceLine($invoiceLine);
        }
        return $invoiceLines;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_InvoiceLine
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_InvoiceLine($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_InvoiceLine $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_InvoiceLine($response->{$this->recordKeyPlural}[0]);
    }
}

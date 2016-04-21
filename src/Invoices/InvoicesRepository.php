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

namespace Billy\Invoices;

use Billy\EntityRepository;
use Billy\Client\Request;

/**
 * Class InvoicesRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class InvoicesRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
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
     * @return Invoice[]
     * @throws BillyException
     */
    public function getAll()
    {
        $response = parent::getAll();
        $invoices = array();
        foreach ($response as $key => $invoice) {
            $invoices[$invoice->id] = new Invoice($invoice);
        }
        return $invoices;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Invoice
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Invoice($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Invoice $object API Entity object
     *
     * @return Invoice
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Invoice($response->{$this->recordKeyPlural}[0]);
    }
}

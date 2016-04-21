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
 * Class InvoiceLinesRepository
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class InvoiceLinesRepository extends EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Request $request Request object
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
     * @return InvoiceLine[]
     * @throws BillyException
     */
    public function getAll($invoiceId)
    {
        $this->url = $this->url . '?invoiceId=' . $invoiceId;
        $response = parent::getAll();
        $invoiceLines = array();
        foreach ($response as $key => $invoiceLine) {
            $invoiceLines[$invoiceLine->id] = new InvoiceLine($invoiceLine);
        }
        return $invoiceLines;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return InvoiceLine
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new InvoiceLine($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param InvoiceLine $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new InvoiceLine($response->{$this->recordKeyPlural}[0]);
    }
}

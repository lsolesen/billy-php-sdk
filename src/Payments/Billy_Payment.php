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

use BillysBilling\Billy_Entity;

class Billy_Payment extends Billy_Entity {

  public function requiredProperties() {
    return array(
      'paidDate',
      'accountId',
      'amount',
      'invoiceIds',
    );
  }

  public function getPaidDate() {
    return $this->get('paidDate');
  }
  public function setPaidDate($timestamp) {
    return $this->set('paidDate', date('o-m-d', $timestamp));
  }

  public function getAccountID() {
    return $this->get('accountId');
  }
  public function setAccountID($string) {
    return $this->set('accountId', $string);
  }

  /**
   * @return float
   * @throws \Exception
   */
  public function getAmount() {
    return (float) $this->get('amount');
  }

  /**
   * @param int $float
   * @return $this
   * @throws \Exception
   */
  public function setAmount($float) {
    if (is_numeric($float)) {
      return $this->set('amount', (float) $float);
    }
    else {
      throw new \Exception('Payment amounts must be numeric');
    }
  }

  public function getInvoiceIDs() {
    $invoiceIDs = $this->get('invoiceIds');
    return empty($invoiceIDs) ? $invoiceIDs : array();
  }

  /**
   * @param string[] $invoiceIDs
   * @return $this
   * @throws \Exception
   */
  public function setInvoiceIDs($invoiceIDs) {
    if (is_array($invoiceIDs)) {
      return $this->set('invoiceIds', $invoiceIDs);
    }
    else {
      throw new \Exception('Invoice IDs must be an array of IDs');
    }
  }
}
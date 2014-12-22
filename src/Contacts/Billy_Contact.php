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

namespace BillysBilling\Contacts;

class Billy_Contact {
  /**
   * @var \stdClass
   */
  protected $contact;

  public function __construct($contact = null) {
    if ($contact) {
      $this->contact = $contact;
    }
    else {
      $this->contact = new \stdClass();
    }

    return $this;
  }

  public function get($property) {
    if (!isset($this->contact->{$property})) {
      throw new \Exception('Unknown contact API property');
    }

    return $this->contact->{$property};
  }

  public function set($property, $value) {
    $this->contact->{$property} = $value;

    return $this;
  }
}
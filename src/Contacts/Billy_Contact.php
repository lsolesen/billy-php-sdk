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

use BillysBilling\Billy_Entity;

class Billy_Contact extends Billy_Entity {

  public function requiredProperties() {
    return array(
      'name',
      'countryId',
    );
  }

  public function getID() {
    return $this->get('id');
  }

  public function getName() {
    return $this->get('name');
  }

  public function setName($string) {
    return $this->set('name', $string);
  }

  public function getCountryID() {
    return $this->get('countryId');
  }

  public function setCountryID($string) {
    return $this->set('countryId', $string);
  }
}
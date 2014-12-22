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

namespace BillysBilling;

class Billy_Entity {

  /**
   * Object this instance represents.
   * @var \stdClass
   */
  protected $entity;

  public function __construct($entity = null) {
    $this->entity = ($entity) ? $entity : new \stdClass();
    return $this;
  }

  /**
   * Required properties for creation.
   *
   * Intended to be extended by subclasses to aid in validation during creation
   * calls for the API.
   *
   * @return array
   */
  public function requiredProperties() {
    return array();
  }

  /**
   * Validates an entity has required properties.
   *
   * @return bool
   */
  public function validate() {
    $requiredProperties = $this->requiredProperties();
    foreach ($requiredProperties as $property) {
      try {
        // If the value has not yet been set, we'll throw an exception.
        $value = $this->get($property);

        if(empty($value)) {
          throw new \Exception('Required property ' . $property . ' is empty.');
        }
      }
      catch (\Exception $e) {
        return false;
      }
    }

    return true;
  }

  public function toArray() {
    return (array) $this->entity;
  }

  public function get($property) {
    if (!isset($this->entity->{$property})) {
      throw new \Exception('Unknown API entity property');
    }

    return $this->entity->{$property};
  }

  public function set($property, $value) {
    $this->entity->{$property} = $value;

    return $this;
  }

  public function getID() {
    return $this->get('id');
  }
}
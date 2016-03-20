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
 * @license   MIT Open Source License https://opensource.org/licenses/MIT
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/billysbilling
 */

namespace BillysBilling;

/**
 * Class Billy_Entity
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Billy_Entity
{

    /**
     * Object this instance represents.
     * @var \stdClass
     */
    protected $entity;

    /**
     * Initiates an API Entity instance.
     *
     * Consumes an entity returned from the API, or initiates a new empty entity.
     *
     * @param null $entity API Entity
     */
    public function __construct($entity = null)
    {
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
    public function requiredProperties()
    {
        return array();
    }

    /**
     * Validates an entity has required properties.
     *
     * @return bool
     */
    public function validate()
    {
        $requiredProperties = $this->requiredProperties();
        foreach ($requiredProperties as $property) {
            try {
                // If the value has not yet been set, we'll throw an exception.
                $value = $this->get($property);

                if (empty($value)) {
                    throw new \Exception("Required property $property is empty.");
                }
            } catch (\Exception $e) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns the object as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return (array) $this->entity;
    }

    /**
     * Returns a property from the entity.
     *
     * @param string $property Property
     *
     * @return mixed
     * @throws \Exception
     */
    public function get($property)
    {
        if (!isset($this->entity->{$property})) {
            throw new \Exception('Unknown API entity property: ' . $property);
        }

        return $this->entity->{$property};
    }

    /**
     * Sets a property.
     *
     * @param string $property Property name
     * @param mixed  $value    Property value
     *
     * @return $this
     */
    public function set($property, $value)
    {
        $this->entity->{$property} = $value;

        return $this;
    }

    /**
     * Returns the entity's API ID.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getID()
    {
        return $this->get('id');
    }
}

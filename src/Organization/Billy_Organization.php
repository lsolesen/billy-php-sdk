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

namespace BillysBilling\Organization;

use BillysBilling\Client\Billy_Client;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_Organization
 *
 * @todo: Convert to Billy_Entity
 * @link: https://billysbilling.com/api#v2organizations
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Billy_Organization
{

    /**
     * Returned data about the organization.
     *
     * @var \stdClass
     */
    protected $organization;

    /**
     * Initiates organization object
     *
     * @param Billy_Client $client BillysBilling API Client
     *
     * @throws Billy_Exception
     */
    public function __construct($client)
    {
        $response = $client->get('/organization');
        if ($response->isSuccess()) {
            $this->organization = $response->getBody()->organization;
        } else {
            throw new Billy_Exception(
                'Unable to retrieve organization information.'
            );
        }
    }

    /**
     * Returns specific property from organization.
     *
     * @param string $property Get a property
     *
     * @return mixed
     * @throws \Exception
     */
    public function get($property)
    {
        if (!isset($this->organization->{$property})) {
            throw new \Exception('Unknown organization API property');
        }

        return $this->organization->{$property};
    }

    /**
     * Returns organization object returned from API.
     *
     * @return \stdClass
     */
    public function getAll()
    {
        return $this->organization;
    }
}

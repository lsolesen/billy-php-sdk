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

use BillysBilling\Client\Client;
use BillysBilling\Exception\Exception;

/**
 * Class Organization
 *
 * @todo: Convert to Entity
 * @link: https://billysbilling.com/api#v2organizations
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Organization
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
     * @param Client $client BillysBilling API Client
     *
     * @throws Exception
     */
    public function __construct($client)
    {
        $response = $client->get('/organization');
        if ($response->isSuccess()) {
            $this->organization = $response->getBody()->organization;
        } else {
            throw new BillyException(
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

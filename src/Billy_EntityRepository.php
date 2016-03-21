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

use BillysBilling\Client\Billy_Client;
use BillysBilling\Client\Billy_Response;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_AccountsRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Billy_EntityRepository extends Billy_Client
{
    /**
     * API Endpoint URL
     *
     * @var string
     */
    protected $url;

    /**
     * The record key to contain root object.
     *
     * @var string
     */
    protected $recordKey;

    /**
     * The plural record key to contain root object.
     *
     * @var string
     */
    protected $recordKeyPlural;
    /**
     * Returns all items for an object endpoint.
     *
     * @return object
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = $this->get($this->url);
        $this->validateResponse($response);

        return $response->getBody()->{$this->recordKeyPlural};
    }

    /**
     * Returns a single item for an object endpoint
     *
     * @param string $apiID API ID
     *
     * @return mixed
     * @throws \BillysBilling\Exception\Billy_Exception
     */
    public function getSingle($apiID)
    {
        $response = $this->get($this->url . '/' . $apiID);
        $this->validateResponse($response);

        return $response->getBody()->{$this->recordKey};
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_Entity $object API Entity object
     *
     * @return mixed
     * @throws \Exception
     */
    public function create($object)
    {
        if ($object->validate()) {
            $data = array($this->recordKey => $object->toArray());
            $response = $this->post($this->url, $data);
            $this->validateResponse($response);

            return $response->getBody();
        } else {
            // @todo: Better exception.
            throw new \Exception('API Entity did not have required properties');
        }
    }

    /**
     * Updates an item through an object endpoint.
     *
     * @param Billy_Entity $object API Entity object
     *
     * @return mixed
     * @throws \Exception
     */
    public function update($object)
    {
        if ($object->validate()) {
            $data = array($this->recordKey => $object->toArray());
            $response = $this->put($this->url . '/' . $object->getID(), $data);
            $this->validateResponse($response);

            return $response->getBody();
        } else {
            // @todo: Better exception.
            throw new \Exception('API Entity did not have required properties');
        }
    }

    /**
     * Deletes a single item for an object endpoint
     *
     * @param string $apiID API ID
     *
     * @return mixed
     * @throws \BillysBilling\Exception\Billy_Exception
     */
    public function delete($apiID)
    {
        $response = parent::delete($this->url. '?ids[]=' . $apiID);
        $this->validateResponse($response);
        return $response->getBody();
    }

    /**
     * Throws an exception on API request error.
     *
     * @param \stdClass $body Object of response body
     *
     * @return $this
     * @throws \BillysBilling\Exception\Billy_Exception
     */
    protected function throwAPIException($body)
    {
        throw new Billy_Exception(
            $body->errorMessage,
            $body->helpURL
        );
    }

    /**
     * Validates a returned response
     *
     * @param Billy_Response $response API Response
     *
     * @return $this
     * @throws Billy_Exception
     */
    protected function validateResponse($response)
    {
        if (!$response->isSuccess()) {
            $this->throwAPIException($response->getBody());
        }
    }
}

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

namespace BillysBilling\Client;

use BillysBilling\Exception\Billy_Exception;

/**
 * BillysBilling: response.
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Response
{
    protected $status;
    protected $body;

    /**
     * Construct a Billy Request with an API key and an API version.
     *
     * @param array $info Info about the response
     * @param array $body Body of the response
     */
    public function __construct($info, $body)
    {
        $this->info = $info;
        $this->body = $body;
    }

    /**
     * Get the response body
     *
     * @return object stdClass
     */
    public function getBody()
    {
        return $this->interpretResponse($this->body);
    }

    /**
     * Get the status code
     *
     * @return object stdClass
     */
    public function isSuccess()
    {
        return ($this->info['http_code'] === 200);
    }

    /**
     * Takes a raw JSON response and decodes it. If an error is met,
     * throw an exception. Else return array.
     *
     * @param string $rawResponse JSON encoded array
     *
     * @return array Response from Billy API, e.g. id and success
     * or invoice object
     * @throws Billy_Exception Error, Help URL and response
     */
    protected function interpretResponse($rawResponse)
    {
        $response = json_decode($rawResponse);
        if (!$response->meta->success) {
            throw new Billy_Exception(
                $response->errorMessage,
                $response->helpUrl
            );
        }

        return $response;
    }
}
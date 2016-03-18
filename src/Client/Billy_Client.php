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

/**
 * BillysBilling: client.
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Client
{
    /**
     * Request object.
     *
     * @var Billy_Request
     */
    protected $request;

    /**
     * Construct a Billy Client with an API key and optionally an API version.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get method
     *
     * @param string $url Url on the REST service
     *
     * @return Billy_Response
     */
    public function get($url)
    {
        return $this->request->call('GET', $url);
    }

    /**
     * Get method
     *
     * @param string $url  Url on the REST service
     * @param array  $body Parameters for the request
     *
     * @return Billy_Response
     */
    public function post($url, $body)
    {
        return $this->request->call('POST', $url, $body);
    }

    /**
     * Put method
     *
     * @param string $url  Url on the REST service
     * @param array  $body Parameters for the request
     *
     * @return Billy_Response
     */
    public function put($url, $body)
    {
        return $this->request->call('PUT', $url, $body);
    }

    /**
     * Delete method
     *
     * @param string $url Url on the REST service
     *
     * @return Billy_Response
     */
    public function delete($url)
    {
        return $this->request->call('DELETE', $url);
    }
}

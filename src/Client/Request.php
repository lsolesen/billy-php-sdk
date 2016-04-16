<?php
/**
 * Billy
 *
 * PHP version 5
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   MIT Open Source License https://opensource.org/licenses/MIT
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/Billy
 */

namespace Billy\Client;

/**
 * Billy: request.
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Request
{

    protected $accessToken;

    /**
     * Construct a Billy Request with an API key and an API version.
     *
     * @param string $accessToken Access token from Billy
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Run a custom request on Billy API on a specific address
     * with possible parameters and receive a response array as
     * return.
     *
     * @param string $method Either GET, POST, PUT or DELETE
     * @param string $url    Sub-address to call, e.g. invoices or invoices/ID
     * @param array  $body   Parameters to be sent to Billy API
     *
     * @return \stdClass Response from Billy API
     */
    public function call($method, $url, $body = null)
    {
        $headers = array("X-Access-Token: " . $this->accessToken);
        $c = curl_init("https://api.billysbilling.com/v2" . $url);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        if ($body) {
            curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
            $headers[] = "Content-Type: application/json";
        }
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
        $res = curl_exec($c);
        $info = curl_getinfo($c);

        return new Response($info, $res);
    }
}

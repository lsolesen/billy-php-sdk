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

/**
 * BillysBilling: Mocked out request.
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_FakeRequest
{
    protected $accessToken;
    protected $outputFile = 'request.txt';

    /**
     * Construct a Billy Request with an API key and an API version.
     *
     * @param string $accessToken Access token from Billy
     */
    function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Run a fake custom request.
     *
     * @param string $method  Either GET, POST, PUT or DELETE
     * @param string $address Sub-address to call, e.g. invoices or invoices/ID
     * @param array  $params  Parameters to be sent to Billy API
     *
     * @return StdClass Response from Billy API
     */
    public function call($method, $address, $params = null)
    {
        $call = array(
            "mode" => $method,
            "address" => $address
        );
        if ($params) {
            $call["params"] = $params;
        }

        $handle = fopen($this->outputFile, "a");
        fwrite($handle, json_encode($call) . "\n");
        fclose($handle);

        $response = new StdClass();
        if ($method == "POST") {
            $response->id = "12345-ABCDEFGHIJKLMNOP";
            $response->success = true;
        } else {
            $addressParts = explode("?", $address);
            $type = $addressParts[0];
            $response->$type = array();
            $response->status = 200;
        }
        return $response;
    }
}

/**
 * BillysBilling: request.
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Request
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
     * @return StdClass Response from Billy API
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
        $body = json_decode($res);
        $info = curl_getinfo($c);

        return new Billy_Response($info, $res);
    }
}

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
            throw new Billy_Exception($response->error, $response->helpUrl);
        }

        return $response;
    }
}

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
    protected $request;

    /**
     * Construct a Billy Client with an API key and optionally an API version.
     *
     * @param object $request Request object
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
     * @return array
     */
    function get($url)
    {
        return $this->request->call('GET', $url);
    }

    /**
     * Get method
     *
     * @param string $url  Url on the REST service
     * @param array  $body Parameters for the request
     *
     * @return array
     */
    function post($url, $body)
    {
        return $this->request->call('POST', $url, $body);
    }
}

/**
 * BillysBilling: exception.
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_Exception extends Exception
{

}
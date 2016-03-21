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

namespace BillysBilling\Exception;

/**
 * Class BillyException
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class BillyException extends \Exception
{
    /**
     * Service help URL in reference to error.
     * @var string
     */
    protected $helpUrl;

    /**
     * JSON Object involved in the error.
     * @var array
     */
    protected $json;

    /**
     * Construct the exception.
     *
     * @param string $message Message returned by API for error.
     * @param string $url     API Help URL
     * @param array  $json    JSON involved in error.
     */
    public function __construct($message = null, $url = null, $json = null)
    {
        parent::__construct($message);
        $this->helpUrl = $url;
        $this->json = $json;
    }

    /**
     * Returns the help URL.
     *
     * @return string
     */
    public function getHelpUrl()
    {
        return $this->helpUrl;
    }

    /**
     * Returns JSON from the error.
     *
     * @return null
     */
    public function getJSON()
    {
        return $this->json;
    }
}

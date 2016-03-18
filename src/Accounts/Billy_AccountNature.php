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

namespace BillysBilling\Accounts;

use BillysBilling\Billy_Entity;

/**
 * Class Billy_AccountNature
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://github.com/lsolesen/billysbilling
 */
class Billy_AccountNature extends Billy_Entity
{
    /**
     * Returns the account nature's report type.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getReportType()
    {
        return $this->get('reportType');
    }

    /**
     * Sets the account nature's report type
     *
     * @param string $enum Report type
     *
     * @return $this
     *
     * @todo: What are allow enum values? incomeStatement, balanceSheet
     */
    public function setReportType($enum)
    {
        return $this->set('reportType', $enum);
    }

    /**
     * Return the account nature's name.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * Sets the name for the account nature
     *
     * @param string $string Account nature's name
     *
     * @return $this
     */
    public function setName($string)
    {
        return $this->set('name', $string);
    }

    /**
     * Returns the account natures normal balance.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getNormalBalance()
    {
        return $this->get('normalBalance');
    }

    /**
     * Sets the account nature's balance type.
     *
     * @param string $enum Balance type
     *
     * @return $this
     *
     * @todo: What are proper enum values, debit and credit only?
     */
    public function setNormalBalance($enum)
    {
        return $this->set('normalBalance', $enum);
    }
}

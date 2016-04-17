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

namespace Billy\Accounts;

use Billy\Entity;

/**
 * Class AccountNature
 *
 * @category  Billy
 * @package   Billy
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class AccountNature extends Entity
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

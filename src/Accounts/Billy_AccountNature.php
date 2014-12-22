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
    public function getReportType() {
        return $this->get('reportType');
    }

    public function setReportType($enum) {
        return $this->set('reportType', $enum);
    }

    public function getName() {
        return $this->get('name');
    }

    public function setName($string) {
        return $this->set('name', $string);
    }

    public function getNormalBalance() {
        return $this->get('normalBalance');
    }

    public function setNormalBalance($enum) {
        return $this->set('normalBalance', $enum);
    }
}
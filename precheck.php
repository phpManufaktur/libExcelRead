<?php

/**
 * libExcelRead
 *
 * @author Ralf Hertsch (ralf.hertsch@phpmanufaktur.de)
 * @link http://phpmanufaktur.de
 * @copyright 2011
 * @license GNU GPL (http://www.gnu.org/licenses/gpl.html)
 * @version $Id: precheck.php 32 2011-12-12 08:52:50Z phpmanufaktur $
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('WB_PATH')) {
    if (defined('LEPTON_VERSION'))
        include (WB_PATH . '/framework/class.secure.php');
} else {
    $oneback = "../";
    $root = $oneback;
    $level = 1;
    while (($level < 10) && (!file_exists($root . '/framework/class.secure.php'))) {
        $root .= $oneback;
        $level += 1;
    }
    if (file_exists($root . '/framework/class.secure.php')) {
        include ($root . '/framework/class.secure.php');
    } else {
        trigger_error(
                sprintf("[ <b>%s</b> ] Can't include class.secure.php!", 
                        $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
    }
}
// end include class.secure.php

// Checking Requirements

$PRECHECK['WB_VERSION'] = array('VERSION' => '2.8', 'OPERATOR' => '>=');
$PRECHECK['PHP_VERSION'] = array('VERSION' => '5.2.0', 'OPERATOR' => '>=');

global $database;
// check for UTF-8 charset
$charset = 'utf-8';
$sql = "SELECT `value` FROM `" . TABLE_PREFIX .
         "settings` WHERE `name`='default_charset'";
        $result = $database->query($sql);
        if ($result) {
            $data = $result->fetchRow(MYSQL_ASSOC);
            $charset = $data['value'];
        }
        $PRECHECK['CUSTOM_CHECKS'] = array(
                'Default Charset' => array('REQUIRED' => 'utf-8', 
                        'ACTUAL' => $charset, 'STATUS' => ($charset === 'utf-8')));
        
        ?>
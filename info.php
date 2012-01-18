<?php

/**
 * libExcelRead
 *
 * @author Ralf Hertsch (ralf.hertsch@phpmanufaktur.de)
 * @link http://phpmanufaktur.de
 * @copyright 2011
 * @license GNU GPL (http://www.gnu.org/licenses/gpl.html)
 * @version $Id: info.php 29 2011-11-30 08:46:19Z phpmanufaktur $
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

$module_directory = 'lib_excel_read';
$module_name = 'libExcelRead';
$module_function = 'library';
$module_version = '0.10';
$module_status = 'Stable';
$module_platform = '2.8';
$module_author = 'Ralf Hertsch, Berlin (Germany)';
$module_license = 'GNU General Public License';
$module_description = 'Read Excel files';
$module_home = 'http://phpmanufaktur.de/libExcelRead';
$module_guid = '6CEF36B2-D973-4EFF-A094-6A325985DF9E';

?>
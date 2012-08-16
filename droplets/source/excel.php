<?php

/**
 * libExcelRead
 *
 * @author Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @link http://phpmanufaktur.de
 * @copyright 2011 - 2012
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

require_once WB_PATH.'/modules/lib_excel_read/BiffWorkbook/CompoundDocument.inc.php';
require_once WB_PATH.'/modules/lib_excel_read/BiffWorkbook/BiffWorkbook.inc.php';

// the file parameter is always needed!
if (!isset($file))
  return 'Please use the parameter "file" to specify the xls file to load from /MEDIA directory!';

if (!file_exists(WB_PATH.MEDIA_DIRECTORY.'/'.$file))
  return 'The file '.MEDIA_DIRECTORY.'/'.$file.' does not exists!';

// the class used for the table
$xls_class = (isset($class)) ? $class : 'excel';
// use first row as header
$xls_header = (isset($header) && (strtolower($header) == 'false')) ? false : true;
// show only a specified excel sheet
$xls_sheet = (isset($sheet)) ? intval($sheet) : 0;
// show the excel sheet name as title
$xls_title = (isset($title) && (strtolower($title) == 'true')) ? true : false;

setlocale(LC_ALL, 'de_DE');

$doc = new CompoundDocument('utf-8');
$xls_file = file_get_contents(WB_PATH.MEDIA_DIRECTORY.'/'.$file);
$doc->parse($xls_file);
$xls = new BiffWorkbook($doc);
$xls->parse();

$table = '<div class="'.$xls_class.'">';
$i = 0;
foreach ($xls->sheets as $sheetName => $sheet) {
  $i++;
  if (($xls_sheet > 0) && ($i != $xls_sheet)) continue;
  if ($sheet->rows() > 0) {
    if ($xls_title)
      $table .= "<h2>$sheetName</h2>";
    $table .= "<table class=\"$xls_class\">\n";
  }
  $flip = 'flip';
  for ($row = 0; $row < $sheet->rows(); $row++) {
    $flip = ($flip == 'flop') ? 'flip' : 'flop';
    $table .= (($row == 0) && $xls_header) ? "  <tr class=\"$xls_class\">\n" : "  <tr class=\"$xls_class $flip\">\n";
    for ($col = 0; $col < $sheet->cols(); $col++) {
      if (!isset($sheet->cells[$row][$col])) {
        $table .= (($row == 0) && $xls_header) ? '    <th class="' : '    <td class="';
        $table .= $xls_class.' cell_'.sprintf('%02d', $col+1).'">';
        $table .= (($row == 0) && $xls_header) ? "</th>\n" : "</td>\n";
        continue;
      }
      $cell = $sheet->cells[$row][$col];
      $table .= (($row == 0) && $xls_header) ? '    <th ' : '    <td ';
      $table .= 'class="'.$xls_class.' cell_'.sprintf('%02d', $col+1).'" rowspan="' .
          $cell->rowspan . '" colspan="' . $cell->colspan . '">';
      $table .= is_null($cell->value) ? '&nbsp;' : utf8_encode($cell->value);
      $table .= (($row == 0) && $xls_header) ? "</th>\n" : "</td>\n";
    }
    $table .= "  </tr>\n";
  }
  if ($sheet->rows() > 0)
    $table .= "</table>\n";
}
$table .= '</div>';
return $table;
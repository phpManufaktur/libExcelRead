### libExcelRead

libExcelRead is an implementation of the BiffWorkbook library to read Excel files for the Content Management Systems [WebsiteBaker] [1] or [LEPTON CMS] [2].

#### Requirements

* minimum PHP 5.2.x
* using [WebsiteBaker] [1] _or_ using [LEPTON CMS] [2]

#### Installation

* download the actual [libExcelRead] [3] installation archive
* in CMS backend select the file from "Add-ons" -> "Modules" -> "Install module"

#### First Steps

libExcelRead installs the droplet `excel`.

To show the content of an Excel table as HTML table place the droplet at the desired place in a WYSIWYG section. Use the parameter `file` to specify the Excel file to read. The Excel file must be place in /MEDIA directory of your installation:

    [[excel?file=xyz.xls]]

and save the WYSIWYG section, that's all.

The Excel droplet will output a `<div>` container and a formatted HTML table:

    <div class="excel">
      <table class="excel">
        <tr class="excel">
          <th class="excel cell_01" rowspan="1" colspan="1">Head 01</th>
          <th class="excel cell_02" rowspan="1" colspan="1">Head 02</th>
          <th class="excel cell_03" rowspan="1" colspan="1">Head 03</th>
        </tr>
        <tr class="excel flip">
          <td class="excel cell_01" rowspan="1" colspan="1">Cell 01</td>
          <td class="excel cell_02" rowspan="1" colspan="1">Cell 02</td>
          <td class="excel cell_03" rowspan="1" colspan="1">Cell 03</td>
        </tr>
        <tr class="excel flop">
          <td class="excel cell_01" rowspan="1" colspan="1">Cell 01</td>
          <td class="excel cell_02" rowspan="1" colspan="1">Cell 02</td>
          <td class="excel cell_03" rowspan="1" colspan="1">Cell 03</td>
        </tr>
      </table>
    </div>

Each row and cell gets classes so you can use the CSS file of your template to format the table:

    table.excel {
      width: 99%;
      table-layout: fixed;
      border-collapse: collapse;
    }
    th.excel {
      text-align: left;
      font-size: 11px;
      font-weight: bold;
      color: #fff;
      background-color: navy;
    }
    td.excel {
      text-align: left;
      font-size: 10px;
    }
    td.excel.cell_02 {
      text-align: right;
    }
    tr.excel.flip {
      color: #000;
      background-color: yellow;
    }
    tr.excel.flop {
      color: #000;
      background-color: transparent;
    }

The `excel` droplet has some more parameters:

`class` - specify an other class than the default `excel`.

`header` - by default the droplet uses the first row of the Excel table as headline. If you set `header=false` the first line will be formatted as an normal row.

`sheet` - by default shows all sheets of the Excel table. If you wish to show a single sheet you can select it with this parameter, so `sheet=2` will show the second sheet.

`title` - if you wish to show the sheet title as `<h2>` formatted title above the table use `title=true`

`auto_url` - set to `true` will create regular http links <a href="...">...</a> from www.xyz.de or http://... text fragments

`target` - `target=blank` will add the attribute target="_blank" to `auto_url` created links.

`columns` - add positive column numbers separated by comma to show only the specified columns, i.e. `columns=3,5` or use negative column numbers to exclude them, i.e. `columns=-2,-4` will not show columns 2 and 4.

    [[excel?file=test/xyz.xls&class=my_excel_table&sheet=2&header=false]]

will show the Excel table `xyz.xls` from the /MEDIA subdirectory `test`, uses the class `my_excel_table` instead of `excel`, select the second sheet and does not display a headline in the table.

Please visit the [phpManufaktur] [4] to get more informations about **libExcelRead** and join the [Addons Support Group] [5].

[1]: http://websitebaker2.org "WebsiteBaker Content Management System"
[2]: http://lepton-cms.org "LEPTON CMS"
[3]: https://addons.phpmanufaktur.de/download.php?file=libExcelRead
[4]: https://addons.phpmanufaktur.de/de/name/libexcelread.php
[5]: https://phpmanufaktur.de/support

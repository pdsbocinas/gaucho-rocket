
<?php


require_once 'vendor\autoload.php';
//require 'application\view\micuenta\components\view_factura.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
// Define the Header/Footer before writing anything so they appear on the first page
$mpdf->SetHTMLHeader('
<div style="text-align: right; font-weight: bold;">
    My document
</div>');
$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">My document</td>
    </tr>
</table>');


$mpdf->WriteHTML(include('application\view\micuenta\components\view_factura.php')); 
//$mpdf->WriteHTML(include('application\view\micuenta\components\view_factura.php'));
// Output a PDF file directly to the browser
$mpdf->Output();



?>
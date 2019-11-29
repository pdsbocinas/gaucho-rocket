<div class="container">
  <?php
 
$tablaConTitulo="esta es la factura";
?>
<?php
ob_start();
require('core\helpers\fpdf\html_table.php');
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($tablaConTitulo);
$archivo=$pdf->Output('F', 'resources/pdfGenerados/12.pdf'); 
ob_end_flush();

?>
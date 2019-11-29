<div class="container">
  <?php
    foreach ($data as $fila) {
    $tabla.="<table border='1' bordercolor='666633' ><tr><td colspan='2' width='200' height='30'>{$fila['tipo_de_cabina']}</td><td width='200' height='30'>{$fila['cantidad']}</td></tr></table>";
    }
$tablaConTitulo="<table border='1' bordercolor='666633' ><td colspan='2' width='200' height='30'>TIPO DE CABINA</td><td width='200' height='30'>CANTIDAD</td><br></table>".$tabla;
?>
<?php
ob_start();
require('core\helpers\fpdf\html_table.php');
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($tablaConTitulo);
$pdf->Output();
ob_end_flush();
?>
<div class="container">
  <?php
    foreach ($data as $fila) {
      echo "
        <ul>
          <li><h1>{$fila['total']}</h1></li>
        <ul>
      ";
      $tabla="
      <table border='1'table bordercolor='666633' >
      <tr>
          <td colspan='2' width='200' height='30'>Total Vendido por Mes</td><td width='200' height='30'>{$fila['total']}</td>
      </tr>
    </table>
      ";
    }
  ?>
</div>
<?php
ob_start();
require_once($this->path->getPage("fpdf", "html_table.php"));
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($tabla);
$pdf->Output();
ob_end_flush();
?>
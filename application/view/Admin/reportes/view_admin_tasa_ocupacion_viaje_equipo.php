<div class="container">
  <?php
    foreach ($data as $fila) {
      $valor=number_format(((int)$fila['cantidad']/(int)$fila['totalEquipo'])*100,2);
      $tabla.="<table border='1' bordercolor='666633' ><tr><td colspan='2' width='120' height='30'>{$fila['vuelo_id']}</td><td width='100' height='30'>{$fila['cantidad']}</td><td width='100' height='30'>{$fila['avion_id']}</td><td width='140' height='30'>{$fila['totalEquipo']}</td><td width='180' height='30'>$valor %</td></tr></table>";
    }
    $tablaConTitulo="<h1>TASA DE OCUPACION POR VIAJE Y EQUIPO</h1><br><br><table border='1' bordercolor='666633' ><td colspan='2' width='120' height='30'>ID DE VUELO</td><td width='100' height='30'>CANTIDAD</td><td width='100' height='30'>EQUIPO</td><td width='140' height='30'>TOTAL EQUIPO</td><td width='180' height='30'>TASA OCUPACION</td><br></table>".$tabla;
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
</div>
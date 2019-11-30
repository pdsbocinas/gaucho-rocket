<?php
require_once($this->path->getPage("fpdf", "fpdf.php"));

class PDF extends FPDF {

  function Header() {
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(50,10,'Gaucho Rocket',1,0,'C');
    // Salto de línea
    $this->Ln(20);
  }

  function Footer() {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

<?php
require_once($this->path->getPage("fpdf", "fpdf.php"));

class PDF extends FPDF {

  function Header() {
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(50,10,'Gaucho Rocket',1,0,'C');
    $this->Ln(20);
  }

  function Footer() {
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

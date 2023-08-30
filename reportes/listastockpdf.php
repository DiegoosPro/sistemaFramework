<?php

date_default_timezone_set("America/Bogota");
require_once('../lib/FPDF/fpdf.php');


class PDF extends FPDF
{
// Cabecera de pÃ¡gina
    var $angulo = 0;

    function Header()
    {
        // Logo
        $this->Image('../img/logo.png', 20, 8, 20);
        $this->Image('../img/logo.png', 170, 8, 25);
        // Arial bold 15
        $this->SetFont('Times', 'B', 14);
        // Movernos a la derecha
        $this->SetX(40);
        // TÃ­tulo
        $uno="TEXTO 1";
        $dos="TEXTO 2";
        $tres="TEXTO 3";
        $cuatro="TEXTO 4";
        $cinco="TEXTO 5";

        $this->Cell(130, 10, iconv('UTF-8', 'windows-1252', 'U.E. ' . $uno), 0, 0, 'C');
        $this->Ln(5);
        $this->SetFont('Times', '', 12);
        $this->SetX(40);
        $this->Cell(130, 10, iconv('UTF-8', 'windows-1252', 'Código AMIE : ' . $dos), 0, 0, 'C');
        $this->Ln(5);

        $this->SetFont('Times', '', 9);
        $this->Ln(5);
        $this->SetX(45);
        $this->Cell(130, 10, iconv('UTF-8', 'windows-1252', $tres.', '.$cuatro), 0, 0, 'C');
        $this->Ln(4);

        $this->SetX(45);
        $this->Cell(130, 10, $uno." - ".$cinco."   Telf: 062630616 / 062630663 / 062630847", 0, 0, 'C');

        $this->SetLineWidth(1.5);
        $this->SetDrawColor(10,25,150);

        $this->Line(45, 25, 195, 25);
        $this->Line(45, 25, 45, 35);

        $this->SetLineWidth(0.5);
        $this->SetDrawColor(100,100,200);
        $this->Line(47, 27, 195, 27);
        $this->Line(47, 27, 47,34);
        $this->Ln(10);


    }

// Pie de pÃ¡gina
    function Footer()
    {
        // PosiciÃ³n: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Times', 'I', 8);
        // NÃºmero de pÃ¡gina
        //  $this->Cell(170, 8, iconv('UTF-8', 'windows-1252', 'Impreso : ') . date('d-m-Y') . ' ' . date("G:i"), 0, 0, "R");
        // $this->Ln(1);
        // $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Pág ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
        $this->Cell(170, 10, iconv('UTF-8', 'windows-1252', 'SISGAPRO - Asecompu.net - 0999458787 '), 0, 0, 'R');
    }

    function Girar($angulo = 0, $x = -1, $y = -1)
    {
        if ($x == -1) $x = $this->x;

        if ($y == -1) $y = $this->y;

        if ($this->angulo != 0) $this->_out('Q');

        $this->angulo = $angulo;
        if ($angulo != 0) {
            $angulo *= M_PI / 180;
            $c = cos($angulo);
            $s = sin($angulo);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;

            $this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }
}


$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetMargins(20, 10, 30);

$pdf->SetLineWidth(0.1);

$bandera = false; //Para alternar el relleno
$pdf->SetFont('Times', '', 10);
$nombrearchivo = "mireporte.pdf";



$pdf->Output($nombrearchivo, "I");
?>
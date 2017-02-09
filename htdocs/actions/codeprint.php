<?php

function decode_str($string)
{
    return iconv('UTF-8', 'windows-1252', $string);
}
if ($evote->verifyUser($_SESSION['user'], 0)) {
    require '../fpdf/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $count = 0;
    $instr_per_page = 4;
    $instructions = decode_str(file_get_contents(__DIR__.'/../data/code_instr.txt'));

    $logoH = 27;

    foreach ($codes as $c) {
        ++$count;
        $pdf->SetFont('Arial', 'B', 16);
        $title = decode_str('AIR EUROPA TANGO CHAMPIONS 2017');
        $pdf->Ln();
        $pdf->Cell(190, 6, $title);
        $pdf->Ln();
        $pdf->Image(__DIR__.'/../data/aireuropa.png',132,$logoH);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Multicell(190, 4, $instructions);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(215, 215, 215);
        $pdf->Multicell(190, 8, decode_str('Your secret vote code to use in myvote.com is: ' . $c), 0, 'C', true);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetFillColor(215, 215, 215);
        //$pdf->Multicell(190, 1, "", 0, 'C', true);
        //$pdf->Ln(4);
        if ($count % $instr_per_page == 0) {
            $logoH = 35;
            $pdf->AddPage();
        } else {
            $logoH = $logoH + 66;
        }
    }
    $pdf->Output();
} else {
    echo 'Some problem with the session';
}

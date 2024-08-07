<?php

use App\Services\PDF;

$titulo = 'Relatório Sintético de Clientes';
$emp = $company->company_name;
$cid = $company->city;
$est = $company->state;



$pdf = new PDF($titulo, '', '', $emp, $cid, $est);
$pdf->setTitle($titulo);
$pdf->AddPage();
//Header
//Colors, line width and bold font
$pdf->SetFillColor(52, 58, 64);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('dejavusans', 'B', 7);
$pdf->Cell(15, 7, 'Código', 'LTB', 0, 'C', 1);
$pdf->Cell(30, 7, 'CPF / CNPJ', 'LTB', 0, 'C', 1);
$pdf->Cell(53, 7, 'Nome', 'LTB', 0, 'C', 1);
$pdf->Cell(23, 7, 'A Receber', 1, 0, 'C', 1);
$pdf->Cell(23, 7, 'Total', 1, 0, 'C', 1);
$pdf->Cell(23, 7, 'Liquidados', 1, 0, 'C', 1);
$pdf->Cell(23, 7, 'Total', 1, 1, 'C', 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('dejavusans', '', 7);

foreach ($customres as $item) {
    $pdf->Cell(15, 7, $item->id, 'LTB', 0, 'C', 0);
    $pdf->Cell(30, 7, Helper::formatDocument($item->person->document), 'LTB', 0, 'C', 0);
    $pdf->Cell(53, 7, $item->person->name, 'LTB', 0, 'L', 0);
    $pdf->Cell(23, 7, $item->open_transaction_count, 1, 0, 'C', 0);
    $pdf->Cell(23, 7, Helper::formatBrazilianNumber($item->open_transaction_sum), 1, 0, 'C', 0);
    $pdf->Cell(23, 7, $item->close_transaction_count, 1, 0, 'C', 0);
    $pdf->Cell(23, 7, Helper::formatBrazilianNumber($item->close_transaction_sum), 1, 1, 'C', 0);

}
ob_clean();
return $pdf->Output("clients.pdf", 'S');

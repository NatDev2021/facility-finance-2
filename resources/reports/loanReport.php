<?php

use App\Services\PDF;

$titulo = 'Relatório de Contratos';
$emp = $company->company_name;
$cid = $company->city;
$est = $company->state;



$pdf = new PDF($titulo, '', '', $emp, $cid, $est, 'L');
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
$pdf->Cell(85, 7, 'Cliente', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'Valor', 'LTB', 0, 'C', 1);
$pdf->Cell(15, 7, 'Parcelas', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'V.Parcela', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'V.Total', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'Taxa %', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'Juros', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'Comissão %', 'LTB', 0, 'C', 1);
$pdf->Cell(20, 7, 'V.Comissão', 'LTB', 0, 'C', 1);
$pdf->Cell(24, 7, 'Data', 1, 1, 'C', 1);


$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('dejavusans', '', 7);

foreach ($loans as $item) {
    $pdf->Cell(15, 7, $item->id, 'LTB', 0, 'C', 0);
    $pdf->Cell(85, 7, $item->customer, 'LTB', 0, 'L', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->loan_amount), 'LTB', 0, 'R', 0);
    $pdf->Cell(15, 7, $item->installments, 'LTB', 0, 'C', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->installment_amount), 'LTB', 0, 'R', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->financed_amount), 'LTB', 0, 'R', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->interest_rate), 'LTB', 0, 'R', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->interest_amount), 'LTB', 0, 'R', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->commission_rate), 'LTB', 0, 'R', 0);
    $pdf->Cell(20, 7, Helper::formatBrazilianNumber($item->commission_amount), 'LTB', 0, 'R', 0);
    $pdf->Cell(24, 7, date('d/m/Y', strtotime($item->created_at)), 1, 1, 'C', 0);
}
ob_clean();
return $pdf->Output("contratos.pdf", 'S');

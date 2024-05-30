<?php

use App\Services\PDF;

$titulo = 'Relatório Financeiro';
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
$pdf->Cell(35, 7, 'Tipo', 'LTB', 0, 'C', 1);
$pdf->Cell(90, 7, 'Descrição', 'LTB', 0, 'C', 1);
$pdf->Cell(25, 7, 'Valor', 'LTB', 0, 'C', 1);
$pdf->Cell(25, 7, 'Data', 1, 1, 'C', 1);

$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('dejavusans', '', 7);

$totIncome = 0;
$totExpense = 0;
foreach ($finances as $item) {
    $pdf->Cell(15, 7, $item->id, 'LTB', 0, 'C', 0);
    $pdf->Cell(35, 7, $item->type == 'e' ? 'Saída' : 'Entrada', 'LTB', 0, 'C', 0);
    $pdf->Cell(90, 7, $item->description, 'LTB', 0, 'C', 0);
    $pdf->Cell(25, 7,  Helper::formatBrazilianNumber($item->value_amount), 'LTB', 0, 'R', 0);
    $pdf->Cell(25, 7,  date('d/m/Y', strtotime($item->created_at)), 1, 1, 'C', 0);
    $item->type == 'e' ? $totExpense += $item->value_amount  : $totIncome += $item->value_amount;
}
$pdf->ln();

$pdf->SetFillColor(52, 58, 64);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('dejavusans', 'B', 7);
$pdf->Cell(190, 7, 'Total', 'LTB', 1, 'L', 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->Cell(31.66, 7, 'Entrada', 'LTB', 0, 'L', 0);
$pdf->Cell(31.66, 7, 'R$ ' . Helper::formatBrazilianNumber($totIncome), 'TB', 0, 'R', 0);
$pdf->Cell(31.66, 7, 'Saída', 'LTB', 0, 'L', 0);
$pdf->Cell(31.66, 7, 'R$ ' . Helper::formatBrazilianNumber($totExpense), 'TB', 0, 'R', 0);
$pdf->Cell(31.66, 7, 'Balanço', 'LTB', 0, 'L', 0);
$pdf->Cell(31.66, 7, 'R$ ' . Helper::formatBrazilianNumber(($totIncome - $totExpense)), 'RTB', 1, 'R', 0);
ob_clean();
return $pdf->Output("raletorio_financeiro.pdf", 'S');

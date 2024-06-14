<?php

use App\Services\PDF;
use App\Helpers\{Helper};

$titulo = 'Relatório de Contas a ' . ($type == 'p' ? 'Pagar' : 'Receber');
$emp = $company->company_name;
$cid = $company->city;
$est = $company->state;



$pdf = new PDF($titulo, '', '', $emp, $cid, $est, 'L');
$pdf->setTitle($titulo);
$pdf->AddPage();
//Header
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->SetFillColor(52, 58, 64);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(25, 5, "Vencimento", 1, 0, 'C', 1);
$pdf->Cell(55, 5, 'Descrição', 1, 0, 'C', 1);
$pdf->Cell(57, 5, $type == 'p' ? 'Fornecedor' : 'Cliente', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'Status', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'Conta Débito', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'Conta Crédito', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'Data de Cadastro', 1, 0, 'C', 1);
$pdf->Cell(18, 5, 'Valor', 1, 1, 'C', 1);

$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('dejavusans', '', 8);

$totAmount = 0;

// Adiciona os dados dos usuários
foreach ($transactions as $item) {

    if (!empty($item->pay_date)) {
        $status = 'Pago';
    } else {
        if ($item->date_diff_payment > 0) {
            $status = 'Vence em ' . $item['date_diff_payment'] . ' dias.';
        } else if ($item->date_diff_payment < 0) {
            $status = 'Venceu há ' . abs($item['date_diff_payment']) . ' dias.';
        } else {
            $status = 'Vence Hoje.';
        }
    }

    $totAmount +=  $item->amount;
    $pdf->Cell(25, 5, date('d/m/Y', strtotime($item->due_date ?? '')), 1, 0, 'C');
    $pdf->Cell(55, 5,  $item->description, 1, 0, 'C');
    $pdf->Cell(57, 5, $item->customer_provider, 1, 0, 'C');
    $pdf->Cell(35, 5, $status, 1, 0, 'C');
    $pdf->Cell(25, 5, $item->debit_account, 1, 0, 'C');
    $pdf->Cell(25, 5, $item->credit_account, 1, 0, 'C');
    $pdf->Cell(35, 5, date('d/m/Y', strtotime($item->due_date ?? '')), 1, 0, 'C');
    $pdf->Cell(18, 5,  Helper::formatBrazilianNumber($item->amount), 1, 1, 'R');
}

$pdf->ln(10);
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->SetFillColor(52, 58, 64);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(35, 5, 'Total', 'LBT', 0, 'L', 1);
$pdf->Cell(220, 5, '', 'BT', 0, 'C', 1);
$pdf->Cell(20, 5, Helper::formatBrazilianNumber($totAmount), 'BTR', 1, 'R', 1);
ob_clean();
return $pdf->Output('relatorio_contas_a_' . ($type == 'p' ? 'pagar' : 'teceber') . '.pdf', 'D');

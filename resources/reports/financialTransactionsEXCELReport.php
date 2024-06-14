<?php

use App\Helpers\{Helper};
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Cria uma nova instância do Excel
$objPHPExcel = new Spreadsheet();


// Adiciona dados ao Excel
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();
$sheet->setCellValue('A1', "Vencimento");
$sheet->setCellValue('B1', 'Descrição');
$sheet->setCellValue('C1', $type == 'p' ? 'Fornecedor' : 'Cliente');
$sheet->setCellValue('D1', 'Status');
$sheet->setCellValue('E1', 'Conta de Débito');
$sheet->setCellValue('F1', 'Conta de Crédito');
$sheet->setCellValue('G1', 'Data de Cadastro');
$sheet->setCellValue('H1', 'Valor');


$objPHPExcel->getActiveSheet()
    ->getStyle('A1:H1')
    ->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => array('rgb' => 'FFFFFF'),
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => array('rgb' => '212529'), // Cor de fundo
        ]
    ]);
$totAmount = 0;

// Adiciona os dados dos usuários
$row = 2; // Começando da linha 2, depois dos títulos
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
    $sheet->setCellValue('A' . $row, date('d/m/Y', strtotime($item->due_date ?? '')));
    $sheet->setCellValue('B' . $row, $item->description);
    $sheet->setCellValue('C' . $row, $item->customer_provider);
    $sheet->setCellValue('D' . $row, $status);
    $sheet->setCellValue('E' . $row, $item->debit_account . ' - ' . $item->debit_account_name);
    $sheet->setCellValue('F' . $row, $item->credit_account . ' - ' . $item->credit_account_name);
    $sheet->setCellValue('G' . $row,  date('d/m/Y', strtotime($item->due_date ?? '')));
    $sheet->setCellValue('H' . $row, Helper::formatBrazilianNumber($item->amount));

    $row++;
}


// Total

$sheet->setCellValue('A' . ($row + 3), 'Total');
$sheet->setCellValue('H' . ($row + 3), Helper::formatBrazilianNumber($totAmount));

$objPHPExcel->getActiveSheet()
    ->getStyle('A' . ($row + 3) . ':' . 'H' . ($row + 3))
    ->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => array('rgb' => 'FFFFFF'),
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => array('rgb' => '212529'), // Cor de fundo
        ]
    ]);




// Define o nome do arquivo
$filename = 'relatorio_contas_a_' . ($type == 'p' ? 'pagar' : 'receber') . '.xlsx';

// // Configura a saída
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Escreve o arquivo Excel no buffer de saída
$writer = new Xlsx($objPHPExcel);
$writer->save('php://output');

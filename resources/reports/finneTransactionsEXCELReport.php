<?php

use App\Helpers\{Helper};
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

// Cria uma nova instância do Excel
$objPHPExcel = new Spreadsheet();


// Adiciona dados ao Excel
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();
$sheet->setCellValue('A1', "CONTA_DEBITO");
$sheet->setCellValue('B1', 'CONTA_CREDITO');
$sheet->setCellValue('C1', 'DATA');
$sheet->setCellValue('D1', 'VALOR');
$sheet->setCellValue('E1', 'COMPLEMENTO');

$row = 2; // Começando da linha 2, depois dos títulos

foreach ($transactions as $item) {

    $sheet->setCellValue('A' . $row, $item['debit_account']);
    $sheet->setCellValue('B' . $row, $item['credit_account']);
    $sheet->setCellValue('C' . $row, date('d/m/Y', strtotime($item['pay_date'] ?? '')));
    $sheet->setCellValue('D' . $row, Helper::formatBrazilianNumber($item['amount']));
    $sheet->setCellValue('E' . $row, $item['description'] . ' - ' . $item['customer_provider'] . ' - ' . ($item['type'] == 'r' ? 'Liquidação' : 'Provisão'));
    $row++;
}



// Define o nome do arquivo
$filename = 'finne_integracao.csv';

// // Configura a saída
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');

// Escreve o arquivo Excel no buffer de saída
$writer = new Csv($objPHPExcel);
$writer->setDelimiter(';');
$writer->save('php://output');

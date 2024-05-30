<?php
use App\Helpers\Helper;


if (!function_exists('reports')) {
    function reports($reportName, $data = [])
    {
        // Diretório onde os relatórios estão armazenados
        $reportsDirectory = resource_path('reports');

        // Verifica se o arquivo do relatório existe
        $reportPath = $reportsDirectory . '/' . $reportName . '.php';
        if (!file_exists($reportPath)) {
            // Reporta que o arquivo não foi encontrado
            throw new \Exception("O relatório $reportName não foi encontrado.");
        }

        foreach($data as $key => $item){
            $$key = $item; 
        }

        $report = include $reportPath; // Inclui o arquivo do relatório

        return $report;
    }
}

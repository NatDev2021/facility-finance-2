<?php

namespace App\Http\Controllers\AccountingFinancial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AccountingFinancial;
use App\Helpers\Helper;

class ImportAccountingFinancialController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }


    protected function importAccounting()
    {
        return view('accounting_financial.import_accounting');
    }

    protected function saveImportFile()
    {
        $file = $this->request->file('input_file');
        if (empty($file)) {
            return response([
                'status' => 'error',
                'message' => 'Nenhum arquivo enviado.'
            ], 400);
        }
        $extension = $file->getClientOriginalExtension();
        if ($extension !== 'CSV') {
            return response([
                'status' => 'error',
                'message' => 'Formato do arquivo deve ser csv.'
            ], 400);
        }

        $handle = fopen($file->getPathname(), "r");
        $header = fgetcsv($handle, 1000, ";");
        $rowsArray = array();

        while ($rows = fgetcsv($handle, 1000, ";")) {
            $row = array_combine($header, $rows);

            $month = substr($row['DT_INI_VIGEN'], -2);
            $year = substr($row['DT_INI_VIGEN'], 0, -2);
            $row['DT_INI_VIGEN'] = date($year . '-' . $month . '-' . '01');

            $lastDay = 'NULL';
            if (!empty($row['DT_FIM_VIGEN'])) {
                $month = substr($row['DT_FIM_VIGEN'], -2);
                $year = substr($row['DT_FIM_VIGEN'], 0, -2);
                $lastDay = "'" . date($year . '-' . $month . '-' . 't') . "'";
            }
            $rowsArray[$row['COD_CONTA']] = [
                'account' => $row['COD_CONTA'],
                'description' => $row['NATUREZA'],
                'name' => $row['NOME_CONTA'],
                'start_duration_date' => $row['DT_INI_VIGEN'],
                'end_duration_date' => $lastDay,
            ];
        }

        return response([
            'status' => 'success',
            'message' => 'Arquivo lido com sucesso',
            'data' =>
            $rowsArray
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use App\Services\FinneIntegrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Models\FinancialTransactions;
use App\Helpers\{Helper};
use Illuminate\Support\Facades\DB;

class FinneController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }


    public function getTransaction()
    {
        $data = $this->request->all();
        $transaction = (new FinneIntegrationService())->getTransaction($data);
        return $transaction;
    }

    public function exportTransactions()
    {
        $data = $this->request->post();
        $finneService = new FinneIntegrationService();

        $transaction = $finneService->getTransaction(['id_transaction' => $data['id_transaction']]);
        $payload = [];

        foreach ($transaction as $row) {
            $payload[] = [
                "transaction_date" => $row['pay_date'],
                "debit_account" => $row['debit_account'],
                "credit_account" => $row['credit_account'],
                "amount" => $row['amount'],
                "detailing" => $row['description'] . ' - ' . $row['customer_provider'] . ' - ' . ($row['type'] == 'r' ? 'Liquidação' : 'Provisão'),
                "id_source" => 3
            ];
        }

        $response = $finneService->sendTransactions($payload);
        $dataResponse = $response->json();
        print_r($dataResponse);
        die;
    }
}

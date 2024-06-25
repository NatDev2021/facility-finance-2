<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
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
        $accountsPayable = [];
        $accountsReceivable = [];

        switch ($data['type']) {
            case 0:
                $accountsPayable = $this->getAccountsPayable($data);
                $accountsReceivable = $this->getAccountsReceivable($data);
                break;
            case 'p':
                $accountsPayable = $this->getAccountsPayable($data);
                break;
            case 'r':
                $accountsReceivable = $this->getAccountsReceivable($data);
                break;
        }

      print_r($accountsPayable);
    }

    private function getAccountsPayable(array $data)
    {
        $query = $this->buildQuery($data, 'provider', 'provider_id', 'p');

        return $this->finalizeQuery($query, $data, 'p');
    }

    private function getAccountsReceivable(array $data)
    {
        $query = $this->buildQuery($data, 'customer', 'customer_id', 'r');

        return $this->finalizeQuery($query, $data, 'r');
    }

    private function buildQuery(array $data, $entity, $entityIdField, $type)
    {
        $query = FinancialTransactions::select(
            'financial_transactions.id',
            'person.name as ' . $entity,
            'financial_transactions.due_date',
            'financial_transactions.pay_date',
            DB::raw('DATEDIFF(financial_transactions.due_date, NOW()) as date_diff_payment'),
            'financial_transactions.description',
            'financial_transactions.amount'
        )
            ->join($entity, 'financial_transactions.customer_provider_id', '=', $entity . '.id')
            ->join('person', $entity . '.person_id', '=', 'person.id');

        if (!empty($data['description'])) {
            $query->where('financial_transactions.description', 'like', '%' . $data['description'] . '%');
        }

        if (!empty($data[$entityIdField]) && $data[$entityIdField] != 0) {
            $query->where('financial_transactions.customer_provider_id', '=', $data[$entityIdField]);
        }

        if (!empty($data['payment_method_id']) && $data['payment_method_id'] != 0) {
            $query->where('financial_transactions.payment_method_id', '=', $data['payment_method_id']);
        }

        if (!empty($data['due_date'])) {
            list($startDate, $endDate) = explode(' - ', $data['due_date']);
            $query->whereBetween('financial_transactions.due_date', [Helper::convertToAmericanDate($startDate), Helper::convertToAmericanDate($endDate)]);
        }

        if (!empty($data['credit_account']) && $data['credit_account'] != 0) {
            $query->where('financial_transactions.credit_account_id', '=', $data['credit_account']);
        }

        if (!empty($data['debit_account']) && $data['debit_account'] != 0) {
            $query->where('financial_transactions.debit_account_id', '=', $data['debit_account']);
        }

        if (!empty($data['amount'])) {
            $query->where('financial_transactions.amount', '=', Helper::removeMoneyMask($data['amount']));
        }

        return $query;
    }

    private function finalizeQuery($query, $data, $type)
    {
        if (!empty($data['status']) && $data['status'] != 0) {
            $statusConditions = $this->getStatusConditions($data['status']);
            $query->where($statusConditions);
        }

        $results = $query->where('type', '=', $type)
            ->orderBy('financial_transactions.id', 'desc')
            ->get();

        return $this->formatResults($results);
    }

    private function getStatusConditions($status)
    {
        switch ($status) {
            case 'p':
                return ['financial_transactions.pay_date', '!=', null];
            case 'o':
                return [
                    ['financial_transactions.pay_date', '=', null],
                    ['financial_transactions.due_date', '>=', date('Y-m-d')]
                ];
            case 'd':
                return [
                    ['financial_transactions.pay_date', '=', null],
                    ['financial_transactions.due_date', '<', date('Y-m-d')]
                ];
            case 't':
                return [
                    ['financial_transactions.pay_date', '=', null],
                    ['financial_transactions.due_date', '=', date('Y-m-d')]
                ];
        }
        return [];
    }

    private function formatResults($results)
    {
        foreach ($results as &$item) {
            if (!empty($item['pay_date'])) {
                $item['status'] = ['message' => 'Pago', 'color' => '#a8f0cb'];
            } else {
                $dateDiff = $item['date_diff_payment'];
                if ($dateDiff > 0) {
                    $item['status'] = ['message' => 'Vence em ' . $dateDiff . ' dias.', 'color' => '#a8f0cb'];
                } elseif ($dateDiff < 0) {
                    $item['status'] = ['message' => 'Venceu há ' . abs($dateDiff) . ' dias.', 'color' => '#f0a8a8'];
                } else {
                    $item['status'] = ['message' => 'Vence Hoje.', 'color' => '#eff0a8'];
                }
            }
        }

        return $results;
    }
}

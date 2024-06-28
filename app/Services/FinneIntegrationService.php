<?php

namespace App\Services;

use App\Models\FinancialTransactions;
use App\Helpers\{Helper};
use Illuminate\Support\Facades\Http;

class FinneIntegrationService
{

    private string $urlFinneCont;
    private string $tokenFinneCont;
    public function __construct()
    {

        $this->urlFinneCont = env('FINNECONT_URL');
        $this->tokenFinneCont = env('FINNECONT_TOKEN');
    }

    public function getTransaction(array $data)
    {
        $accountsPayable = [];
        $accountsReceivable = [];

        if (empty($data['type'])) {
            $accountsPayable = $this->getAccountsPayable($data);
            $accountsReceivable = $this->getAccountsReceivable($data);
        }

        if (!empty($data['type']) && $data['type'] == 'p') {
            $accountsPayable = $this->getAccountsPayable($data);
        }

        if (!empty($data['type']) && $data['type'] == 'r') {
            $accountsPayable = $this->getAccountsReceivable($data);
        }

        $transaction = array_merge($accountsPayable, $accountsReceivable);
        return $transaction;
    }

    private function getAccountsPayable(array $data)
    {
        $query = $this->buildQuery($data, 'provider');

        return $this->finalizeQuery($query, $data, 'p');
    }

    private function getAccountsReceivable(array $data)
    {
        $query = $this->buildQuery($data, 'customer');

        return $this->finalizeQuery($query, $data, 'r');
    }

    private function buildQuery(array $data, $entity)
    {
        $query = FinancialTransactions::select(
            'financial_transactions.id',
            'person.name as customer_provider',
            'financial_transactions.due_date',
            'financial_transactions.pay_date',
            'financial_transactions.description',
            'financial_transactions.amount',
            'financial_transactions.type',
            'debit_account.account as debit_account',
            'credit_account.account as credit_account'
        )->join($entity, 'financial_transactions.customer_provider_id', '=', $entity . '.id')
            ->join('person', $entity . '.person_id', '=', 'person.id')
            ->join('accounting_financial as credit_account', 'financial_transactions.credit_account_id', '=', 'credit_account.id')
            ->join('accounting_financial as debit_account', 'financial_transactions.debit_account_id', '=', 'debit_account.id');


        if (!empty($data['person']) && $data['person'] != 0) {
            $query->where('person.id', '=', $data['person']);
        }

        if (!empty($data['due_date'])) {
            list($startDate, $endDate) = explode(' - ', $data['due_date']);
            $query->whereBetween('financial_transactions.due_date', [Helper::convertToAmericanDate($startDate), Helper::convertToAmericanDate($endDate)]);
        }

        if (!empty($data['id_transaction'])) {
            $query->whereIn('financial_transactions.id', $data['id_transaction']);
        }

        return $query;
    }

    private function finalizeQuery($query, $data, $type)
    {

        $results = $query->where('type', '=', $type)
            ->where('pay_date', '!=', null)
            ->orderBy('financial_transactions.id', 'desc')
            ->get()->toArray();

        return $results;
    }

    public function sendTransactions($payload)
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->tokenFinneCont

        ])->post($this->urlFinneCont . '/external_integration/create/journal_entries', $payload);

        return $response;
    }
}

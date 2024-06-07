<?php

namespace App\Http\Controllers\FinancialTransactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\{Helper, DateHelper};
use App\Models\AccountingFinancial;
use App\Models\CompanyPaymentAccounts;
use App\Models\FinancialTransactions;
use App\Models\Provider;

class AccountsPayableController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }


    public function formAccountsPayable()
    {
        $providers = Provider::with('person')->get();
        $accountFinancial = AccountingFinancial::where('end_duration_date', '=', '0000-00-00')
            ->orWhere('end_duration_date', '>', date('Y-m-d'))->get();
        $disbursementAccounts = CompanyPaymentAccounts::get();
        return view('accounts_payable.accounts_payableForm', [
            'providers' =>  $providers,
            'accountFinancial' => $accountFinancial,
            'disbursementAccounts' =>  $disbursementAccounts
        ]);
    }

    public function editAccountsPayable($id)
    {

        $financialTransaction = FinancialTransactions::find($id);
        $providers = Provider::with('person')->get();
        $accountFinancial = AccountingFinancial::where('end_duration_date', '=', '0000-00-00')
            ->orWhere('end_duration_date', '>', date('Y-m-d'))->get();
        $disbursementAccounts = CompanyPaymentAccounts::get();

        return view('accounts_payable.accounts_payableForm', [
            'financialTransaction' => $financialTransaction,
            'providers' =>  $providers,
            'accountFinancial' => $accountFinancial,
            'disbursementAccounts' =>  $disbursementAccounts
        ]);
    }

    public function saveAccountsPayable()
    {
        $data = $this->request->post();

        if (empty($data['id_financial_transactions'])) {
            $this->createAccountsPayable($data);
        } else {
            $this->updateAccountsPayable($data);
        }

        return redirect('/accounts_payable');
    }


    private function createAccountsPayable(array|string|null $data)
    {

        $value = Helper::removeMoneyMask($data['value'] ?? 0);
        $addition = Helper::removeMoneyMask($data['addition'] ?? 0);
        $discount = Helper::removeMoneyMask($data['discount'] ?? 0);
        $amount = ($value + $addition - $discount);


        $arrayData = [
            'description' => $data['description'] ?? '',
            'register_date' => Helper::convertToAmericanDate($data['register_date'] ?? null),
            'due_date' => Helper::convertToAmericanDate($data['due_date'] ?? null),
            'pay_date' => Helper::convertToAmericanDate($data['pay_date'] ?? null),
            'value' => $value,
            'addition' =>  $addition,
            'discount' => $discount,
            'amount' => $amount,
            'customer_provider_id' => $data['provider_id'],
            'credit_account_id' => $data['credit_account'],
            'debit_account_id' => $data['debit_account'],
            'type' => 'p',
            'observation' => $data['observation'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ];
        FinancialTransactions::create($arrayData);
        if (!empty($data['enable_frequency']) && $data['frequency_number'] > 0) {

            $data['pay_date'] = null;
            $dateDue = Helper::convertToAmericanDate($data['due_date'] ?? null);
            $dateReference = $dateDue;
            for ($i = 1; $i <= $data['frequency_number']; $i++) {
                $newDate =  $this->getNewDate($dateReference, $data['frequency'], $dateDue, $dateReference);
                $arrayData['due_date'] = $newDate;
                FinancialTransactions::create($arrayData);
                $dateReference = $newDate;
            }
        }
        toast('Conta criada.', 'success');
        return true;
    }

    private function getNewDate($dateReference, $frequency, $firstDueDate, $oldDate)
    {
        return DateHelper::dueDate($dateReference, $frequency, $firstDueDate, $oldDate);
    }
}

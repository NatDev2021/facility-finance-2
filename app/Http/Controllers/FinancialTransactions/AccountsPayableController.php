<?php

namespace App\Http\Controllers\FinancialTransactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
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
        $this->createValidator($data)->validate();
        $idAccount = FinancialTransactions::create([
            'description' => $data['description'] ?? '',
            'name' => $data['name'] ?? '',
            'account' => $data['account'] ?? '',
            'end_duration_date' => Helper::convertToAmericanDate($data['end_duration_date'] ?? ''),
            'start_duration_date' => Helper::convertToAmericanDate($data['start_duration_date'] ?? ''),
            "id_user_ins" => $this->request->user()->id,

        ])->id;
        toast('Conta criada.', 'success');
        return $idAccount;
    }
}

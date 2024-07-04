<?php

namespace App\Http\Controllers;

use App\Models\{AccountingFinancial, Banks, Customer, Person,   Status, User,   Company, CompanyBanksAccounts, FinancialTransactions, Loans, Provider, PaymentMethod};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use App\Helpers\{Helper};

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {

       

        return view('dashboard');
    }

    public function person()
    {

        $data = $this->request->get('search');
        $person = Person::with(['phone' => function ($query) {
            $query->where('primary', '=', true);
        }]);

        if (!empty($data)) {
            $person = $person->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
        }

        $persons = $person->paginate(10);

        return view('person.person', [
            'person' =>  $persons,
            'search' => $data
        ]);
    }

    public function users()
    {
        $data = $this->request->get('search');
        $user = new User();
        if (!empty($data)) {
            $user = $user->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
        }
        $users = $user->paginate(10);

        return view('user.users', [
            'users' => $users,
            'search' => $data
        ]);
    }

    public function customer()
    {
        $data = $this->request->get('search');
        $customer = Customer::with('person')->whereHas('person', function ($query) use ($data) {
            if (!empty($data)) {
                $query->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
            }
        })->paginate(10);

        return view('customer.customer', [
            'customer' => $customer,
            'search' => $data
        ]);
    }

    public function provider()
    {
        $data = $this->request->get('search');
        $provider = Provider::with('person')->whereHas('person', function ($query) use ($data) {
            if (!empty($data)) {
                $query->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
            }
        })->paginate(10);

        return view('provider.provider', [
            'provider' => $provider,
            'search' => $data
        ]);
    }

    public function accountingFinancial()
    {
        $data = $this->request->get('search');
        $accountingFinancial = new AccountingFinancial();

        if (!empty($data)) {
            $accountingFinancial = $accountingFinancial->where('name', 'like', '%' . $data . '%')->orWhere('account', 'like', $data . '%');
        }

        $accountingFinancial = $accountingFinancial->paginate(15);
        return view('accounting_financial.accounting_financial', [
            'accountingFinancial' => $accountingFinancial,
            'search' => $data

        ]);
    }

    public function accountsPayable()
    {


        $providers = Provider::with('person')->get();
        $accountFinancial = AccountingFinancial::get();
        $paymentMethod = PaymentMethod::get();

        $accountsPayable = FinancialTransactions::select('financial_transactions.id',  'person.name as provider', 'financial_transactions.due_date', 'financial_transactions.pay_date',  DB::raw('DATEDIFF(financial_transactions.due_date, NOW()) as date_diff_payment'), 'financial_transactions.description', 'financial_transactions.amount')
            ->join('provider', 'financial_transactions.customer_provider_id', '=', 'provider.id')
            ->join('person', 'provider.person_id', '=', 'person.id');


        if (!empty($_GET['description'])) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.description', 'like',  '%' . $_GET['description'] . '%');
        }

        if (!empty($_GET['provider_id']) && $_GET['provider_id'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.customer_provider_id', '=',  $_GET['provider_id']);
        }

        if (!empty($_GET['payment_method_id']) && $_GET['payment_method_id'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.payment_method_id', '=',  $_GET['payment_method_id']);
        }

        if (!empty($_GET['due_date'])) {
            // Use explode para separar as duas datas
            $dates = explode(' - ', $_GET['due_date']);

            // Armazene as datas em variáveis separadas
            $startDate = Helper::convertToAmericanDate($dates[0]);
            $endDate = Helper::convertToAmericanDate($dates[1]);
            $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '>=',  $startDate);
            $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '<=',  $endDate);
        }

        if (!empty($_GET['credit_account']) && $_GET['credit_account'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.credit_account_id', '=',  $_GET['credit_account']);
        }

        if (!empty($_GET['debit_account']) && $_GET['debit_account'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.debit_account_id', '=',  $_GET['debit_account']);
        }

        if (!empty($_GET['amount'])) {
            $amount = Helper::removeMoneyMask($_GET['amount']);

            $accountsPayable =  $accountsPayable->where('financial_transactions.amount', '=', $amount);
        }


        if (!empty($_GET['status']) && $_GET['status'] != 0) {

            if ($_GET['status'] == 'p') {
                $accountsPayable =  $accountsPayable->where('financial_transactions.pay_date', '!=',  null);
            }

            if ($_GET['status'] == 'o') {
                $accountsPayable =  $accountsPayable->where('financial_transactions.pay_date', '=',  null);
                $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '>=',  date('Y-m-d'));
            }

            if ($_GET['status'] == 'd') {
                $accountsPayable =  $accountsPayable->where('financial_transactions.pay_date', '=',  null);
                $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '<',  date('Y-m-d'));
            }

            if ($_GET['status'] == 't') {
                $accountsPayable =  $accountsPayable->where('financial_transactions.pay_date', '=',  null);
                $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '=',  date('Y-m-d'));
            }
        }


        $accountsPayable =  $accountsPayable->where('type', '=', 'p')
            ->orderBy('financial_transactions.id', 'desc')
            ->paginate(15);

        foreach ($accountsPayable as &$item) {
            if (!empty($item['pay_date'])) {
                $item['status'] = [
                    'message' => 'Pago',
                    'color' => '#a8f0cb'
                ];
            } else {
                if ($item['date_diff_payment'] > 0) {
                    $item['status'] = [
                        'message' => 'Vence em ' . $item['date_diff_payment'] . ' dias.',
                        'color' => '#a8c0f0'
                    ];
                } else if ($item['date_diff_payment'] < 0) {
                    $item['status'] = [
                        'message' => 'Venceu há ' . abs($item['date_diff_payment']) . ' dias.',
                        'color' => '#f0a8a8'
                    ];
                } else {
                    $item['status'] = [
                        'message' => 'Vence Hoje.',
                        'color' => '#eff0a8;
                        '
                    ];
                }
            }
        }


        return view('accounts_payable.accounts_payable', [
            'accountsPayable' => $accountsPayable,
            'providers' => $providers,
            'accountFinancial' => $accountFinancial,
            'paymentMethod' => $paymentMethod,
            'search' => $_GET
        ]);
    }

    public function accountsReceivable()
    {


        $customers = Customer::with('person')->get();
        $accountFinancial = AccountingFinancial::get();
        $paymentMethod = PaymentMethod::get();

        $accountsReceivable = FinancialTransactions::select('financial_transactions.id',  'person.name as customer', 'financial_transactions.due_date', 'financial_transactions.pay_date',  DB::raw('DATEDIFF(financial_transactions.due_date, NOW()) as date_diff_payment'), 'financial_transactions.description', 'financial_transactions.amount')
            ->join('customer', 'financial_transactions.customer_provider_id', '=', 'customer.id')
            ->join('person', 'customer.person_id', '=', 'person.id');


        if (!empty($_GET['description'])) {
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.description', 'like',  '%' . $_GET['description'] . '%');
        }

        if (!empty($_GET['customer_id']) && $_GET['customer_id'] != 0) {
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.customer_provider_id', '=',  $_GET['customer_id']);
        }

        if (!empty($_GET['due_date'])) {
            // Use explode para separar as duas datas
            $dates = explode(' - ', $_GET['due_date']);

            // Armazene as datas em variáveis separadas
            $startDate = Helper::convertToAmericanDate($dates[0]);
            $endDate = Helper::convertToAmericanDate($dates[1]);
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.due_date', '>=',  $startDate);
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.due_date', '<=',  $endDate);
        }

        if (!empty($_GET['credit_account']) && $_GET['credit_account'] != 0) {
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.credit_account_id', '=',  $_GET['credit_account']);
        }

        if (!empty($_GET['payment_method_id']) && $_GET['payment_method_id'] != 0) {
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.payment_method_id', '=',  $_GET['payment_method_id']);
        }

        if (!empty($_GET['debit_account']) && $_GET['debit_account'] != 0) {
            $accountsReceivable =  $accountsReceivable->where('financial_transactions.debit_account_id', '=',  $_GET['debit_account']);
        }

        if (!empty($_GET['amount'])) {
            $amount = Helper::removeMoneyMask($_GET['amount']);

            $accountsReceivable =  $accountsReceivable->where('financial_transactions.amount', '=', $amount);
        }


        if (!empty($_GET['status']) && $_GET['status'] != 0) {

            if ($_GET['status'] == 'p') {
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.pay_date', '!=',  null);
            }

            if ($_GET['status'] == 'o') {
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.pay_date', '=',  null);
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.due_date', '>=',  date('Y-m-d'));
            }

            if ($_GET['status'] == 'd') {
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.pay_date', '=',  null);
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.due_date', '<',  date('Y-m-d'));
            }


            if ($_GET['status'] == 't') {
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.pay_date', '=',  null);
                $accountsReceivable =  $accountsReceivable->where('financial_transactions.due_date', '=',  date('Y-m-d'));
            }
        }


        $accountsReceivable =  $accountsReceivable->where('type', '=', 'r')
            ->orderBy('financial_transactions.id', 'desc')
            ->paginate(15);

        foreach ($accountsReceivable as &$item) {
            if (!empty($item['pay_date'])) {
                $item['status'] = [
                    'message' => 'Pago',
                    'color' => '#a8f0cb'
                ];
            } else {
                if ($item['date_diff_payment'] > 0) {
                    $item['status'] = [
                        'message' => 'Vence em ' . $item['date_diff_payment'] . ' dias.',
                        'color' => '#a8c0f0'
                    ];
                } else if ($item['date_diff_payment'] < 0) {
                    $item['status'] = [
                        'message' => 'Venceu há ' . abs($item['date_diff_payment']) . ' dias.',
                        'color' => '#f0a8a8'
                    ];
                } else {
                    $item['status'] = [
                        'message' => 'Vence Hoje.',
                        'color' => '#eff0a8;
                        '
                    ];
                }
            }
        }


        return view('accounts_receivable.accounts_receivable', [
            'accountsReceivable' => $accountsReceivable,
            'customers' => $customers,
            'accountFinancial' => $accountFinancial,
            'paymentMethod' => $paymentMethod,
            'search' => $_GET
        ]);
    }

    public function banksAccounts()
    {
        $banksAccounts = CompanyBanksAccounts::with('bank')->paginate(15);
        $banks = Banks::get();
        return view('banks_accounts.banks_accounts', [
            'banksAccounts' => $banksAccounts,
            'banks' => $banks
        ]);
    }

    public function company()
    {
        $company = Company::find(1);

        return view('company.company', [
            'company' => $company,
        ]);
    }

    public function customerReport()
    {

        $countCustomer = Customer::all()->count();
        $customers = Customer::with('person')->get();

        return view('reports.customerReport', [
            'countCustomer' => $countCustomer,
            'customers' => $customers
        ]);
    }

    public function providerReport()
    {

        $countProvider = Provider::all()->count();
        $providers = Provider::with('person')->get();

        return view('reports.providerReport', [
            'countProvider' => $countProvider,
            'providers' => $providers
        ]);
    }

    public function finneIntegration()
    {
        $person = Person::select('person.*')->join('customer', 'person.id', '=', 'customer.person_id', 'left')
            ->join('provider', 'person.id', '=', 'provider.person_id', 'left')
            ->where('customer.id', '!=', null)
            ->orWhere('provider.id', '!=', null)
            ->groupBy('person.id')
            ->get();
 
        return view('integration.finne.finne', [
            'person' => $person
        ]);
    }
}

<?php

namespace App\Http\Controllers\FinancialTransactions;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransactionsFiles;
use Illuminate\Http\Request;
use App\Helpers\{Helper, DateHelper};
use App\Models\AccountingFinancial;
use App\Models\CompanyBanksAccounts;
use App\Models\FinancialTransactions;
use App\Models\Customer;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Services\BanksAccountsStatementService;


class AccountsReceivableController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }


    public function formAccountsReceivable()
    {
        $customers = Customer::with('person')->get();
        $accountFinancial = AccountingFinancial::where('end_duration_date', '=', '0000-00-00')->orWhere('end_duration_date', '>', date('Y-m-d'))->get();
        $disbursementAccounts = CompanyBanksAccounts::with('bank')->get();

        return view('accounts_receivable.accounts_receivableForm', [
            'customers' =>  $customers,
            'accountFinancial' => $accountFinancial,
            'disbursementAccounts' =>  $disbursementAccounts
        ]);
    }

    public function editAccountsReceivable($id)
    {

        $financialTransaction = FinancialTransactions::find($id);
        $transactionFiles = FinancialTransactionsFiles::where('transaction_id', '=', $id)->paginate(4);
        $customers = Customer::with('person')->get();
        $accountFinancial = AccountingFinancial::where('end_duration_date', '=', '0000-00-00')
            ->orWhere('end_duration_date', '>', date('Y-m-d'))->get();
        $disbursementAccounts = CompanyBanksAccounts::get();

        return view('accounts_receivable.accounts_receivableForm', [
            'financialTransaction' => $financialTransaction,
            'transactionFiles' =>  $transactionFiles,
            'customers' =>  $customers,
            'accountFinancial' => $accountFinancial,
            'disbursementAccounts' =>  $disbursementAccounts
        ]);
    }



    public function saveAccountsReceivable()
    {
        $data = $this->request->post();

        if (empty($data['id_financial_transactions'])) {
            $idAccount =  $this->createAccountsReceivable($data);
        } else {
            $idAccount =  $this->updateAccountsReceivable($data);
        }

        return redirect('accounts_receivable/edit/' . $idAccount);
    }


    private function createAccountsReceivable(array|string|null $data)
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
            'customer_provider_id' => $data['customer_id'],
            'credit_account_id' => $data['credit_account'],
            'debit_account_id' => $data['debit_account'],
            'disbursement_account_id' => $data['disbursement_account_id'],
            'type' => 'r',
            'observation' => $data['observation'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ];
        $idAccount =   FinancialTransactions::create($arrayData)->id;
        if (!empty($data['enable_frequency']) && $data['frequency_number'] > 0) {

            $data['pay_date'] = null;
            $dateDue = Helper::convertToAmericanDate($data['due_date'] ?? null);
            $dateReference = $dateDue;
            for ($i = 1; $i <= $data['frequency_number']; $i++) {
                $newDate =  DateHelper::dueDate($dateReference, $data['frequency'], $dateDue, $dateReference);
                $arrayData['due_date'] = $newDate;
                FinancialTransactions::create($arrayData);
                $dateReference = $newDate;
            }
        }


        if (!empty($data['pay_date'])) {
            $idAccountDisbursement = $data['disbursement_account_id'];
            $description = $data['description'];
            $registerDate = Helper::convertToAmericanDate($data['register_date'] ?? null);
            $idUserIns =  $this->request->user()->id;
            (new BanksAccountsStatementService())->insertStatement($idAccountDisbursement, $description, $amount, $registerDate, 'd', $idUserIns, $idAccount);
        }

        toast('Conta criada.', 'success');
        return $idAccount;
    }


    private function updateAccountsReceivable(array|string|null $data)
    {
        $account = FinancialTransactions::find($data['id_financial_transactions']);

        if (!empty($account['pay_date'])) {
            toast('Contas pagas não podem ser alteradas.', 'error');
            return $data['id_financial_transactions'];
        }

        $value = Helper::removeMoneyMask($data['value'] ?? 0);
        $addition = Helper::removeMoneyMask($data['addition'] ?? 0);
        $discount = Helper::removeMoneyMask($data['discount'] ?? 0);
        $amount = ($value + $addition - $discount);
        $account->update([
            'description' => $data['description'] ?? '',
            'register_date' => Helper::convertToAmericanDate($data['register_date'] ?? null),
            'due_date' => Helper::convertToAmericanDate($data['due_date'] ?? null),
            'pay_date' => Helper::convertToAmericanDate($data['pay_date'] ?? null),
            'value' => $value,
            'addition' =>  $addition,
            'discount' => $discount,
            'amount' => $amount,
            'customer_provider_id' => $data['customer_id'],
            'credit_account_id' => $data['credit_account'],
            'debit_account_id' => $data['debit_account'],
            'disbursement_account_id' => $data['disbursement_account_id'],
        ]);

        $file = $this->request->file('input_file');


        if (!empty($file)) {
            $this->saveFiles($data['id_financial_transactions'], $file);
        }

        if (!empty($data['pay_date'])) {
            $idAccountDisbursement = $data['disbursement_account_id'];
            $description = $data['description'];
            $registerDate = Helper::convertToAmericanDate($data['register_date'] ?? null);
            $idUserIns =  $this->request->user()->id;
            (new BanksAccountsStatementService())->insertStatement($idAccountDisbursement, $description, $amount, $registerDate, 'd', $idUserIns, $data['id_financial_transactions']);
        }

        toast('Conta atualizada.', 'success');
        return $data['id_financial_transactions'];
    }


    private function saveFiles($idTransaction, $files)
    {

        foreach ($files as $file) {

            $path =   Storage::disk('local')->put($idTransaction . '/' . $file->getClientOriginalName(), $file);

            FinancialTransactionsFiles::create([
                'transaction_id' => $idTransaction,
                'file_name' => $file->getClientOriginalName(),
                'file_size' =>  $file->getSize(),
                'mime_type' =>  $file->getMimeType(),
                'path' =>  $path,
                "id_user_ins" => $this->request->user()->id,
            ]);
        }
    }
    public function downloadFile($idFile)
    {
        $file = FinancialTransactionsFiles::find($idFile);
        return Storage::download($file['path'], $file['file_name']);
    }
    public function deleteFile($idFile)
    {
        $file = FinancialTransactionsFiles::find($idFile);
        $idTransaction = $file['transaction_id'];
        $file->delete();
        toast('Docmento excluido.', 'success');
        return redirect('accounts_receivable/edit/' . $idTransaction);
    }


    public function exportAccountsReceivablePDF()
    {
        $data = $this->request->all();
        $accountsPayable = $this->searchAccountsReceivable($data);
        $company = Company::find(1);

        return reports('financialTransactionsPDFReport', [
            'transactions' => $accountsPayable,
            'company' => $company,
            'type' => 'r'
        ]);
    }

    public function exportAccountsReceivableEXCEL()
    {

        $data = $this->request->all();
        $accountsPayable = $this->searchAccountsReceivable($data);
        $company = Company::find(1);

        return reports('financialTransactionsEXCELReport', [
            'transactions' => $accountsPayable,
            'company' => $company,
            'type' => 'r'
        ]);
    }


    private function searchAccountsReceivable(array $data)
    {
        $accountsPayable = FinancialTransactions::select(
            'financial_transactions.id',
            'person.name as customer_provider',
            'financial_transactions.due_date',
            'financial_transactions.pay_date',
            DB::raw('DATEDIFF(financial_transactions.due_date, NOW()) as date_diff_payment'),
            'financial_transactions.description',
            'financial_transactions.amount',
            'financial_transactions.register_date',
            'debit_account.account as debit_account',
            'debit_account.name as debit_account_name',
            'credit_account.account as credit_account',
            'credit_account.name as credit_account_name'

        )
            ->join('customer', 'financial_transactions.customer_provider_id', '=', 'customer.id')
            ->join('person', 'customer.person_id', '=', 'person.id')
            ->join('accounting_financial as debit_account', 'financial_transactions.debit_account_id', '=', 'debit_account.id')
            ->join('accounting_financial as credit_account', 'financial_transactions.credit_account_id', '=', 'credit_account.id');


        if (!empty($data['description'])) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.description', 'like',  '%' . $data['description'] . '%');
        }

        if (!empty($data['provider_id']) && $data['provider_id'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.customer_provider_id', '=',  $data['provider_id']);
        }

        if (!empty($data['due_date'])) {
            // Use explode para separar as duas datas
            $dates = explode(' - ', $data['due_date']);

            // Armazene as datas em variáveis separadas
            $startDate = Helper::convertToAmericanDate($dates[0]);
            $endDate = Helper::convertToAmericanDate($dates[1]);
            $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '>=',  $startDate);
            $accountsPayable =  $accountsPayable->where('financial_transactions.due_date', '<=',  $endDate);
        }

        if (!empty($data['credit_account']) && $data['credit_account'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.credit_account_id', '=',  $data['credit_account']);
        }

        if (!empty($data['debit_account']) && $data['debit_account'] != 0) {
            $accountsPayable =  $accountsPayable->where('financial_transactions.debit_account_id', '=',  $data['debit_account']);
        }

        if (!empty($data['amount'])) {
            $amount = Helper::removeMoneyMask($data['amount']);

            $accountsPayable =  $accountsPayable->where('financial_transactions.amount', '=', $amount);
        }



        return  $accountsPayable->where('type', '=', 'r')
            ->orderBy('financial_transactions.id', 'desc')
            ->get();
    }
}

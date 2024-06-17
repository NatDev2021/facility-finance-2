<?php

namespace App\Http\Controllers\BanksAccounts;

use App\Http\Controllers\Controller;
use App\Models\CompanyPaymentAccounts;
use Illuminate\Http\Request;
use Alert;
use App\Models\Banks;
use Helper;

class BanksAccountsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }




    public function formBanksAccounts()
    {
        $banks = Banks::get();

        return view('banks_accounts.banks_accountsForm', [
            'banks' => $banks

        ]);
    }

    public function saveBanksAccounts()
    {
        $data = $this->request->post();

        if (empty($data['id_banks_accounts'])) {
            $this->createBanksAccounts($data);
        } else {
            $this->updateBanksAccounts($data);
        }

        return redirect('/banks_accounts');
    }

    private function createBanksAccounts(array|string|null $data)
    {
        $idAccount = CompanyPaymentAccounts::create([
            'description' => $data['description'] ?? '',
            'company_id' => 1,
            'bank_id' => $data['bank_id'] ?? '',
            'agency' => $data['agency'] ?? '',
            'account' => $data['account'] ?? '',
            'account_dig' => $data['account_dig'] ?? '',
            'pix_key' => $data['pix_key'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ])->id;
        toast('Conta criada.', 'success');
        return $idAccount;
    }

    private function updateBanksAccounts(array|string|null $data)
    {
        $account = CompanyPaymentAccounts::find($data['id_banks_accounts']);
        $account->update([
            'description' => $data['description'] ?? '',
            'bank_id' => $data['bank_id'] ?? '',
            'agency' => $data['agency'] ?? '',
            'account' => $data['account'] ?? '',
            'account_dig' => $data['account_dig'] ?? '',
            'pix_key' => $data['pix_key'] ?? '',
        ]);
        toast('Conta atualizada.', 'success');
        return $data['id_banks_accounts'];
    }

    public function deleteBanksAccounts($id)
    {

        $account = CompanyPaymentAccounts::with(['financialTransaction'])->find($id);


        if (!empty($account->financialTransaction)) {

            alert()->error('Ops!', 'Contas vinculadas a pagamentos/recebimentos não podem ser excluidas.');
            return redirect('/banks_accounts');
        }

        $account->delete();
        toast('Conta excluida.', 'success');
        return redirect('/banks_accounts');
    }


    protected function getBanksAccounts($id)
    {
        return CompanyPaymentAccounts::find($id);
    }
}

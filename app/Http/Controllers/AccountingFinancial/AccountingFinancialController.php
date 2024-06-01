<?php

namespace App\Http\Controllers\AccountingFinancial;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AccountingFinancial;
use App\Helpers\Helper;

class AccountingFinancialController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveAccountingFinancial()
    {
        $data = $this->request->post();

        if (empty($data['id_accounting_financial'])) {
            $this->createAccountingFinancial($data);
        } else {
            $this->updateAccountingFinancial($data);
        }

        return redirect('/accounting_financial');
    }

    private function createAccountingFinancial(array|string|null $data)
    {
        $this->createValidator($data)->validate();
        $idAccount = AccountingFinancial::create([
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

    private function updateAccountingFinancial(array|string|null $data)
    {
        $account = AccountingFinancial::find($data['id_accounting_financial']);
        $account->update([
            'description' => $data['description'] ?? '',
            'name' => $data['name'] ?? '',
            'account' => $data['account'] ?? '',
            'end_duration_date' => Helper::convertToAmericanDate($data['end_duration_date'] ?? ''),
            'start_duration_date' => Helper::convertToAmericanDate($data['start_duration_date'] ?? ''),
        ]);
        toast('Conta atualizada.', 'success');
        return $data['id_accounting_financial'];
    }

    public function deleteAccountingFinancial($id)
    {

        $status = Status::with(['initialStatus', 'finalStatus', 'loans'])->find($id);

        //TODO: Alterar validação por não estar performatica.

        if (!empty($status->initialStatus[0]) || !empty($status->finalStatus[0]) ||  !empty($status->loans[0])) {

            alert()->error('Ops!', 'Status vinculados a produtos/contratos não podem ser excluidos.');
            return redirect('/status');
        }

        $status->delete();
        toast('Status excluido.', 'success');
        return redirect('/status');
    }

    private function createValidator(array|string|null $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string',],
            'account' => ['required', 'string',],
        ]);
    }

    protected function getAccountingFinancial($id)
    {
        return AccountingFinancial::find($id);
    }
}

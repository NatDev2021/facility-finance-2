<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;

class StatusController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveStatus()
    {
        $data = $this->request->post();

        if (empty($data['id_status'])) {
            $this->createStatus($data);
        } else {
            $this->updateStatus($data);
        }

        return redirect('/status');
    }

    private function createStatus(array|string|null $data)
    {
        $this->createValidator($data)->validate();
        $idStatus = Status::create([
            'description' => $data['description'] ?? '',
            'color' => $data['color'] ?? '',
            'actived' => $data['actived'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ])->id;
        toast('Status criado.', 'success');
        return $idStatus;
    }

    private function updateStatus(array|string|null $data)
    {
        $status = Status::find($data['id_status']);
        $status->update([
            'description' => $data['description'] ?? '',
            'color' => $data['color'] ?? '',
            'actived' => $data['actived'] ?? '',
        ]);
        toast('Status atualizado.', 'success');
        return $data['id_status'];
    }

    public function deleteStatus($id)
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
            'description' => ['required', 'string', 'min:1', 'max:50'],
            'color' => ['required', 'string', 'min:1', 'max:20'],
            'actived' => ['required'],
        ]);
    }

    protected function getStatus($id)
    {
        return Status::find($id);
    }
}

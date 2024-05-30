<?php

namespace App\Http\Controllers\FinancialMovement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;
use App\Helpers\Helper;
use App\Models\FinancialMovement;
use Illuminate\Support\Facades\Date;

class FinancialMovementController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveMovement()
    {
        $data = $this->request->post();

        if (empty($data['movement_id'])) {
            $this->createMovement($data);
        } else {
            $this->updateMovement($data);
        }

        return redirect('/financial_movement');
    }

    private function createMovement(array $data)
    {
        $idMovement = FinancialMovement::create([
            'description' => $data['description'] ?? '',
            'date' => Helper::convertToAmericanDate($data['date'] ?? ''),
            'value_amount' => Helper::removeMoneyMask($data['value_amount'] ?? 0),
            'note' => $data['note'] ?? '',
            'type' => $data['type'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ])->id;
        toast('Movimento criado.', 'success');
        return $idMovement;
    }

    private function updateMovement(array $data)
    {
        $movement = FinancialMovement::find($data['movement_id']);
        $movement->update([
            'description' => $data['description'] ?? '',
            'date' => Helper::convertToAmericanDate($data['date'] ?? ''),
            'value_amount' => Helper::removeMoneyMask($data['value_amount'] ?? 0),
            'note' => $data['note'] ?? '',
            'type' => $data['type'] ?? '',
        ]);
        toast('Movimento atualizado.', 'success');
        return $data['movement_id'];
    }

    public function deleteMovement($id)
    {
        $movement = FinancialMovement::find($id);
        $movement->delete();
        toast('Movimento excluído.', 'success');
        return redirect('/financial_movement');

    }
    protected function getMovement($id = null)
    {
        $movement = new FinancialMovement();

        if (!empty($id)) {
            return  $movement->find($id);
        }
        return  $movement->get();
    }
}

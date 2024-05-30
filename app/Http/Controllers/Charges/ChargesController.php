<?php

namespace App\Http\Controllers\Charges;

use App\Http\Controllers\Controller;
use App\Models\Charges;

class ChargesController extends Controller
{
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveCharge()
    {
        $data = $this->request->post();
        if (empty($data['id_charge'])) {
            $this->createCharge($data);
        } else {
            $this->updateCharge($data);
        }

        return redirect('/charges');
    }

    private function createCharge(array|string|null $data)
    {
        // $this->createValidator($data)->validate();
        $idCharge = Charges::create([
            'description' => $data['description'] ?? '',
            'type' => $data['type'] ?? '',
            'actived' => $data['actived'] ?? '',
            "id_user_ins" => $this->request->user()->id,
        ])->id;

        toast('Tarifa criada.','success');
        return $idCharge;

    }

    private function updateCharge(array|string|null $data)
    {
        $charge = Charges::find($data['id_charge']);
        $charge->update([
            'description' =>  $data['description'] ?? '',
            'type' => $data['type'] ?? '',
            'actived' => $data['actived'] ?? '',
        ]);
        toast('Tarifa atualizada.','success');
        return $data['id_charge'];
    }

    public function deleteCharge($id){
        $charge = Charges::find($id);
        $charge->delete();
        toast('Tarifa excluida.', 'success');
        return redirect('/charges');
    }

    protected function getCharge($id)
    {
        return Charges::find($id);

    }
}

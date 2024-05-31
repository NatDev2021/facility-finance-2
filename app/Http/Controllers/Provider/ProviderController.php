<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Person;
use App\Models\Provider;
use Illuminate\Http\Request;
use Helper;

class ProviderController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function formProvider()
    {
        $person = Person::select('person.*')
            ->leftJoin('provider', 'provider.person_id', '=', 'person.id')
            ->where('provider.person_id', null)
            ->get();

        return view('provider.providerForm', ['person' => $person]);
    }

    public function saveProvider()
    {

        $data = $this->request->post();

        if (empty($data['id_provider'])) {
            $this->createProvider($data);
        } else {
            $this->updateProvider($data);
        }

        return redirect('/provider');
    }

    private function createProvider(array|string|null $data)
    {

        $idProvider = Provider::create([
            'person_id' => $data['select_person'],
            "id_user_ins" => $this->request->user()->id,

        ]);


        toast('Fornecedor criado.', 'success');
        return $idProvider;
    }

    private function updateProvider(array|string|null $data)
    {
        $provider = Provider::find($data['id_provider']);

        toast('Fornecedor atualizado.', 'success');
        return $data['id_provider'];
    }

    public function editProvider($id)
    {

        $provider = Provider::with('person')->find($id);

        return view('provider.providerForm', [
            'provider' => $provider,
            'person' => [$provider->person]
        ]);
    }

    public function getProvider($id = null)
    {
        $provider = Provider::with(['person', 'personAddress']);

        if (!empty($id)) {
            return  $provider->find($id);
        }
        return  $provider->get();
    }
}

<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\PersonPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Helper;

class PersonController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function formPerson(string $type, $person = null)
    {

        $formView = $type == 'pj' ? 'person.forms.personPjForm' : 'person.forms.personPfForm';
        return view('person.personForm', [
            'form_view' => $formView,
            'person' => $person

        ]);
    }


    public function savePerson()
    {

        $data = $this->request->post();

        if (empty($data['id_person'])) {
            $this->createPerson($data);
        } else {
            $this->updatePerson($data);
        }

        return redirect('/person');
    }

    public function savePersonCustomerProvider()
    {
        $data = $this->request->post();
        if (empty($data['id_person'])) {
            $idPerson = $this->createPerson($data);
        } else {
            $idPerson = $this->updatePerson($data);
        }

        $person = Person::where('id', $idPerson)->get();

        return view('customer.customerForm', ['person' => $person]);
    }

    private function updatePerson($data)
    {

        $this->UpdateValidator($data)->validate();

        $person = Person::find($data['id_person']);

        $person->update([
            'document' => Helper::removeMask($data['document'] ?? ''),
            'name' => $data['name'] ?? '',
            'date_birthday' => $data['date_birthday'] ?? '',
            'email' => $data['email'] ?? '',
            'representative' => $data['representative'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ]);

        $address = PersonAddress::find($data['id_address']);
        $address->update([
            "person_id" => $data['id_person'],
            "zip_code" =>  Helper::removeMask($data['zip_code'] ?? ''),
            "state" => $data['state'] ?? '',
            "city" => $data['city'] ?? '',
            "street_address" => $data['street_address'] ?? '',
            "address_number" => $data['address_number'] ?? '',
            "complement" => $data['complement'] ?? '',
            "neighborhood" => $data['neighborhood'] ?? '',
        ]);

        $phone = PersonPhone::find($data['id_phone']);
        $phone->update([
            "person_id" => $data['id_person'],
            "phone" => Helper::removeMask($data['phone'] ?? ''),
        ]);

        toast('Pessoa atualizada.', 'success');
        return $data['id_person'];
    }

    private function createPerson($data)
    {

        $this->createValidator($data)->validate();

        $idPerson = Person::create([
            'document' => Helper::removeMask($data['document'] ?? ''),
            'name' => $data['name'] ?? '',
            'date_birthday' => $data['date_birthday'] ?? '',
            'email' => $data['email'] ?? '',
            'representative' => $data['representative'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ])->id;

        PersonAddress::create([
            "person_id" => $idPerson,
            "zip_code" => Helper::removeMask($data['zip_code'] ?? ''),
            "state" => $data['state'] ?? '',
            "city" => $data['city'] ?? '',
            "street_address" => $data['street_address'] ?? '',
            "address_number" => $data['address_number'] ?? '',
            "complement" => $data['complement'] ?? '',
            "neighborhood" => $data['neighborhood'] ?? '',
            "id_user_ins" => $this->request->user()->id,
            "primary" => true
        ]);

        PersonPhone::create([
            "person_id" => $idPerson,
            "phone" => Helper::removeMask($data['phone'] ?? ''),
            "id_user_ins" => $this->request->user()->id,
            "primary" => true

        ]);

        toast('Pessoa criada.', 'success');
        return $idPerson;
    }

    public function editPerson($id)
    {

        $person = Person::with(
            [
                'phone' => function ($query) {
                    $query->where('primary', '=', true);
                },
                'address' => function ($query) {
                    $query->where('primary', '=', true);
                }
            ]
        )->find($id);

        $personType = strlen($person->document);

        $formView = $personType == 14 ? 'pj' : 'pf';

        return $this->formPerson($formView, $person);
    }

    protected function UpdateValidator(array $data)
    {
        return Validator::make($data, [
            'document' => ['required', 'string', 'min:11', 'max:18'],
            'name' => ['required', 'string', 'max:255'],
        ]);
    }


    protected function createValidator(array $data)
    {
        return Validator::make($data, [
            'document' => ['required', 'string', 'min:11', 'max:18'],
            'name' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function getPerson($id = null)
    {
        $person = Person::with(
            [
                'phone' => function ($query) {
                    $query->where('primary', '=', true);
                },
                'address' => function ($query) {
                    $query->where('primary', '=', true);
                }
            ]
        );

        if (!empty($id)) {
            return  $person->find($id);
        }
        return  $person->get();
    }


    public function getPersonByDocument($document)
    {
        return Person::with(
            [
                'phone' => function ($query) {
                    $query->where('primary', '=', true);
                },
                'address' => function ($query) {
                    $query->where('primary', '=', true);
                }
            ]
        )->where('document', '=', $document)->first();
    }
}

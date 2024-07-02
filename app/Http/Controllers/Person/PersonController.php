<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Banks;
use App\Models\Customer;
use App\Models\Person;
use App\Models\PersonAddress;
use App\Models\PersonBanksAccounts;
use App\Models\PersonPhone;
use App\Models\Provider;
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
        $banks = Banks::get();

        return view('person.personForm', [
            'form_view' => $formView,
            'person' => $person,
            'banks' => $banks,


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

        if (isset($data['customer_check'])) {
            $idCustomer = Customer::create([
                'person_id' => $idPerson,
                "id_user_ins" => $this->request->user()->id,

            ]);
        }

        if (isset($data['provider_check'])) {
            $idProvider = Provider::create([
                'person_id' => $idPerson,
                "id_user_ins" => $this->request->user()->id,

            ]);
        }

        return redirect('/person');
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
            "phone" => Helper::removeMask($data['phone'] ?? ''),
        ]);


        $banksAccount = PersonBanksAccounts::find($data['id_banks_accounts']);
        $banksAccount->update([
            'description' => $data['description'] ?? '',
            'bank_id' => $data['bank_id'] ?? '',
            'agency' => $data['agency'] ?? '',
            'account' => $data['account'] ?? '',
            'account_dig' => $data['account_dig'] ?? '',
            'pix_key' => $data['pix_key'] ?? '',
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

        PersonBanksAccounts::create([
            "person_id" => $idPerson,
            'description' => $data['description'] ?? '',
            'bank_id' => $data['bank_id'] ?? '',
            'agency' => $data['agency'] ?? '',
            'account' => $data['account'] ?? '',
            'account_dig' => $data['account_dig'] ?? '',
            'pix_key' => $data['pix_key'] ?? '',
            "id_user_ins" => $this->request->user()->id,
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
                },
                'banksAccount'
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

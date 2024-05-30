<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Loans;
use App\Models\Person;
use Illuminate\Http\Request;
use Helper;

class CustomerController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function formCustomer()
    {
        $person = Person::select('person.*')
            ->leftJoin('customer', 'customer.person_id', '=', 'person.id')
            ->where('customer.person_id', null)
            ->get();

        return view('customer.customerForm', ['person' => $person]);
    }

    public function saveCustomer()
    {

        $data = $this->request->post();

        if (empty($data['id_customer'])) {
            $this->createCustomer($data);
        } else {
            $this->updateCustomer($data);
        }

        return redirect('/customer');
    }

    private function createCustomer(array|string|null $data)
    {

        $idCustomer = Customer::create([
            'person_id' => $data['select_person'],
            "id_user_ins" => $this->request->user()->id,

        ]);


        toast('Cliente criado.', 'success');
        return $idCustomer;
    }

    private function updateCustomer(array|string|null $data)
    {
        $customer = Customer::find($data['id_customer']);

        toast('Cliente atualizado.', 'success');
        return $data['id_customer'];
    }

    public function editCustomer($id)
    {

        $customer = Customer::with('person')->find($id);
        $loans = $loans = Loans::select('loans.id', 'person.name as customer', 'loans.loan_amount', 'loans.installments', 'status.description as status', 'status.color as status_color')
            ->join('customer', 'loans.customer_id', '=', 'customer.id')
            ->join('person', 'customer.person_id', '=', 'person.id')
            ->join('status', 'loans.status_id', '=', 'status.id')
            ->where('customer.id', '=', $id)
            ->orderBy('loans.id', 'desc')
            ->paginate(5);
        return view('customer.customerForm', [
            'customer' => $customer,
            'loans' => $loans,
            'person' => [$customer->person]
        ]);
    }

    public function getCustomer($id = null)
    {
        $customer = Customer::with(['person', 'personAddress']);

        if (!empty($id)) {
            return  $customer->find($id);
        }
        return  $customer->get();
    }
}

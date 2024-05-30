<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Alert;
use Helper;
class CompanyController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveCompany()
    {
        $data = $this->request->post();

        if (empty($data['id_company'])) {
            $this->createCompany($data);
        } else {
            $this->updateCompany($data);
        }

        return redirect('/company');
    }

    private function createCompany(array|string|null $data)
    {
        $idCompany = Company::create([
            'document' => Helper::removeMask($data['document'] ?? ''),
            'company_name' => $data['company_name'] ?? '',
            'business_name' => $data['business_name'] ?? '',
            'phone' => $data['phone'] ?? '',
            'zip_code' => Helper::removeMask($data['zip_code'] ?? ''),
            'country' => $data['country'] ?? '',
            'state' => $data['state'] ?? '',
            'city' => $data['city'] ?? '',
            "street_address" => $data['street_address'] ?? '',
            "address_number" => $data['address_number'] ?? '',
            "complement" => $data['complement'] ?? '',
            "neighborhood" => $data['neighborhood'] ?? '',
            "id_user_ins" => $this->request->user()->id,

        ])->id;
        toast('Empresa criada.', 'success');
        return $idCompany;
    }

    private function updateCompany(array|string|null $data)
    {
        $company = Company::find($data['id_company']);
        $company->update([
            'document' => Helper::removeMask($data['document'] ?? ''),
            'company_name' => $data['company_name'] ?? '',
            'business_name' => $data['business_name'] ?? '',
            'phone' => $data['phone'] ?? '',
            'zip_code' => Helper::removeMask($data['zip_code'] ?? ''),
            'country' => $data['country'] ?? '',
            'state' => $data['state'] ?? '',
            'city' => $data['city'] ?? '',
            "street_address" => $data['street_address'] ?? '',
            "address_number" => $data['address_number'] ?? '',
            "complement" => $data['complement'] ?? '',
            "neighborhood" => $data['neighborhood'] ?? '',
        ]);
        toast('Empresa atualizada.', 'success');
        return $data['id_company'];
    }


    protected function getCompany($id)
    {
        return Company::find($id);
    }
}

<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Alert;
use App\Models\Company;
use App\Models\Customer;
use DateTime;

class CustomerReportsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function customerReport()
    {
        $data = $this->request->post();

        if ($data['type'] ==  'a') {

            return $this->analyticalReport($data);
        }

        if ($data['type'] ==  's') {
            return $this->summaryReport($data);
        }
    }

    private function analyticalReport(array $data)
    {
    }

    private function summaryReport(array $data)
    {
        $customerModel = Customer::select('customer.*', DB::raw('COUNT(loans.id) as loans_count'))
            ->join('loans', 'customer.id', '=', 'loans.customer_id')
            ->groupBy('customer.id')
            ->with('person');

        $customers =   empty($data['customer']) ? $customerModel->get() : $customerModel->find($data['customer']);

        $company = Company::find(1);
        $report = reports('customerReport', [
            'customres' => $customers,
            'company' => $company
        ]);
        return ['report' => base64_encode($report)];
    }
}

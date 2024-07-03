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

class CustomerReportController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function customerReport()
    {
        $data = $this->request->post();

        if ($data['report_type'] ==  'a') {

            return $this->analyticalReport($data);
        }

        if ($data['report_type'] ==  's') {
            return $this->summaryReport($data);
        }
    }

    private function analyticalReport(array $data)
    {
    }

    private function summaryReport(array $data)
    {
        $customerModel = Customer::select(
            'customer.*',
            DB::raw('COUNT(open_transaction.id) as open_transaction_count'),
            DB::raw('SUM(IFNULL(open_transaction.value,0)) as open_transaction_sum'),
            DB::raw('COUNT(close_transaction.id) as close_transaction_count'),
            DB::raw('SUM(IFNULL(close_transaction.amount,0)) as close_transaction_sum'),
        )
            ->leftJoin('financial_transactions as open_transaction', function ($join) {
                $join->on('customer.id', '=', 'open_transaction.customer_provider_id');
                $join->where('open_transaction.type', '=', 'r');
                $join->whereNull('open_transaction.pay_date');
            }, 'left')
            ->leftJoin('financial_transactions as close_transaction',  function ($join) {
                $join->on('customer.id', '=', 'close_transaction.customer_provider_id');
                $join->where('close_transaction.type', '=', 'r');
                $join->whereNotNull('close_transaction.pay_date');
            }, 'left')
            ->groupBy('customer.id')
            ->with('person');

        $customers =   empty($data['customer']) ? $customerModel->get() : $customerModel->find($data['customer']);

        $company = Company::find(1);
        $report = reports('summaryCustomerReport', [
            'customres' => $customers,
            'company' => $company
        ]);
        return ['report' => base64_encode($report)];
    }
}

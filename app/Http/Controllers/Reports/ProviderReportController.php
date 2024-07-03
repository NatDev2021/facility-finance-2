<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Alert;
use App\Models\Company;
use App\Models\Provider;
use DateTime;

class ProviderReportController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function providerReport()
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
        $providerModel = Provider::select(
            'provider.*',
            DB::raw('COUNT(open_transaction.id) as open_transaction_count'),
            DB::raw('SUM(IFNULL(open_transaction.value,0)) as open_transaction_sum'),
            DB::raw('COUNT(close_transaction.id) as close_transaction_count'),
            DB::raw('SUM(IFNULL(close_transaction.amount,0)) as close_transaction_sum'),
        )
            ->leftJoin('financial_transactions as open_transaction', function ($join) {
                $join->on('provider.id', '=', 'open_transaction.customer_provider_id');
                $join->where('open_transaction.type', '=', 'p');
                $join->whereNull('open_transaction.pay_date');
            }, 'left')
            ->leftJoin('financial_transactions as close_transaction',  function ($join) {
                $join->on('provider.id', '=', 'close_transaction.customer_provider_id');
                $join->where('close_transaction.type', '=', 'p');
                $join->whereNotNull('close_transaction.pay_date');
            }, 'left')
            ->groupBy('provider.id')
            ->with('person');

        $providers =   empty($data['provider']) ? $providerModel->get() : $providerModel->find($data['provider']);

        $company = Company::find(1);
        $report = reports('summaryProviderReport', [
            'providers' => $providers,
            'company' => $company
        ]);
        return ['report' => base64_encode($report)];
    }
}

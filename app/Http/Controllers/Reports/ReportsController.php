<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Alert;
use App\Models\Company;
use App\Models\Customer;
use App\Models\FinancialMovement;
use App\Models\Loans;
use DateTime;

class ReportsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function customerReport()
    {
        $data = $this->request->post();
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

    public function loanReport()
    {
        $data = $this->request->post();
        $loans = Loans::select('loans.*', 'person.name as customer', 'status.description as status')
            ->join('customer', 'loans.customer_id', '=', 'customer.id')
            ->join('person', 'customer.person_id', '=', 'person.id')
            ->join('status', 'loans.status_id', '=', 'status.id');

        if (!empty($data['customer'])) {
            $loans = $loans->whereIn('loans.customer_id', $data['customer']);
        }
        if (!empty($data['status'])) {
            $loans = $loans->whereIn('loans.status_id', $data['status']);
        }

        if (!empty($data['date'])) {


            // Divide a string em duas partes com base no hífen e espaços
            $dates = explode(" - ", $data['date']);

            // Formatação da primeira data (01/02/2024) no padrão americano (YYYY-MM-DD)
            $startDate = DateTime::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');

            // Formatação da segunda data (22/02/2024) no padrão americano (YYYY-MM-DD)
            $endDate = DateTime::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');

            $loans = $loans->where(DB::raw('DATE(loans.created_at)'), '>=', $startDate);
            $loans = $loans->where(DB::raw('DATE(loans.created_at)'), '<=', $endDate);
        }
        $loans->orderBy('loans.id');

        $company = Company::find(1);
        $report = reports('loanReport', [
            'loans' => $loans->get(),
            'company' => $company
        ]);
        return ['report' => base64_encode($report)];
    }

    public function financialReport()
    {
        $data = $this->request->post();

        $finances = new FinancialMovement();

        if (!empty($data['type'])) {
            $finances = $finances->whereIn('type', $data['type']);
        }

        if (!empty($data['date'])) {


            // Divide a string em duas partes com base no hífen e espaços
            $dates = explode(" - ", $data['date']);

            // Formatação da primeira data (01/02/2024) no padrão americano (YYYY-MM-DD)
            $startDate = DateTime::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');

            // Formatação da segunda data (22/02/2024) no padrão americano (YYYY-MM-DD)
            $endDate = DateTime::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');

            $finances = $finances->where(DB::raw('DATE(created_at)'), '>=', $startDate);
            $finances = $finances->where(DB::raw('DATE(created_at)'), '<=', $endDate);
        }
        $finances->orderBy('id');
        $company = Company::find(1);

        $report = reports('financialReport', [
            'finances' => $finances->get(),
            'company' => $company
        ]);
        return ['report' => base64_encode($report)];
    }
}

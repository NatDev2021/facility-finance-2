<?php

namespace App\Http\Controllers;

use App\Models\{Customer, Person,   Status, User,   Company, FinancialMovement, Loans, Provider};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Helper;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        // $this->authorize('is_admin');

        $loans = Loans::where('disbursement_date', '!=', null)->whereMonth('created_at', date('m'))->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'));
        $countLoans = $loans->count();
        $sumLoans = $loans->sum('financed_amount');

        $lastLoans = Loans::select('loans.id', 'person.name as customer', 'loans.loan_amount', 'loans.installments', 'status.description as status', 'status.color as status_color')
            ->join('customer', 'loans.customer_id', '=', 'customer.id')
            ->join('person', 'customer.person_id', '=', 'person.id')
            ->join('status', 'loans.status_id', '=', 'status.id')
            ->orderByDesc('id')->paginate(5);

        $statuses = Status::select('status.description', 'status.color')
            ->selectRaw('COUNT(DISTINCT loans.id) as loans')
            ->join('loans', 'status.id', '=', 'loans.status_id')
            ->groupBy('status.id')
            ->get();

        $incomeMovement = FinancialMovement::where('type', '=', 'i')->whereMonth('date', date('m'))->groupBy(DB::raw('YEAR(date), MONTH(date)'));
        $countIncome = $incomeMovement->count();
        $sumIncome = $incomeMovement->sum('value_amount');
        $expenseMovement = FinancialMovement::where('type', '=', 'e')->whereMonth('date', date('m'))->groupBy(DB::raw('YEAR(date), MONTH(date)'));
        $countExpense = $expenseMovement->count();
        $sumExpense = $expenseMovement->sum('value_amount');
        $balanceMovement = Helper::numberFormat($sumIncome - $sumExpense);

        $monthlyIncome = array_fill(0, 12, 0);
        $monthlyExpense = array_fill(0, 12, 0);

        $anualBalance = FinancialMovement::select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(CASE WHEN type = "i" THEN value_amount ELSE 0 END) as total_income'),
            DB::raw('SUM(CASE WHEN type = "e" THEN value_amount ELSE 0 END) as total_expense')

        )
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw('YEAR(date), MONTH(date)'))
            ->get();

        foreach ($anualBalance as $item) {
            $month = $item->month - 1; // Ajuste do índice do mês (1 a 12 para 0 a 11)
            $monthlyIncome[$month] = $item->total_income;
            $monthlyExpense[$month] = $item->total_expense;
        }

        return view('dashboard', [
            'countLoans' => $countLoans,
            'sumLoans' => $sumLoans,
            'loans' => $lastLoans,
            'statuses' => $statuses,
            'countIncome' => $countIncome,
            'sumIncome' => $sumIncome,
            'countExpense' => $countExpense,
            'sumExpense' => $sumExpense,
            'balanceMovement' => $balanceMovement,
            'monthlyIncome' => $monthlyIncome,
            'monthlyExpense' => $monthlyExpense
        ]);
    }

    public function person()
    {

        $data = $this->request->get('search');
        $person = Person::with(['phone' => function ($query) {
            $query->where('primary', '=', true);
        }]);

        if (!empty($data)) {
            $person = $person->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
        }

        $persons = $person->paginate(10);

        return view('person.person', [
            'person' =>  $persons,
            'search' => $data
        ]);
    }

    public function users()
    {
        $data = $this->request->get('search');
        $user = new User();
        if (!empty($data)) {
            $user = $user->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
        }
        $users = $user->paginate(10);

        return view('user.users', [
            'users' => $users,
            'search' => $data
        ]);
    }

    public function customer()
    {
        $data = $this->request->get('search');
        $customer = Customer::with('person')->whereHas('person', function ($query) use ($data) {
            if (!empty($data)) {
                $query->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
            }
        })->paginate(10);

        return view('customer.customer', [
            'customer' => $customer,
            'search' => $data
        ]);
    }

    public function provider()
    {
        $data = $this->request->get('search');
        $provider = Provider::with('person')->whereHas('person', function ($query) use ($data) {
            if (!empty($data)) {
                $query->where('name', 'like', '%' . $data . '%')->orWhere('document', 'like', $data . '%');
            }
        })->paginate(10);

        return view('provider.provider', [
            'provider' => $provider,
            'search' => $data
        ]);
    }

    public function status()
    {
        $status = Status::paginate(15);
        return view('status.status', ['status' => $status]);
    }


    public function company()
    {
        $company = Company::find(1);

        return view('company.company', [
            'company' => $company,
        ]);
    }

    public function customerReport()
    {

        $countCustomer = Customer::all()->count();
        $customers = Customer::with('person')->get();

        return view('reports.customerReport', [
            'countCustomer' => $countCustomer,
            'customers' => $customers
        ]);
    }
}

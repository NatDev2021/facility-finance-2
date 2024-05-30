<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Person;
use App\Models\Products;
use App\Services\Calculator;
use Helper;

class SimulateLoansController extends Controller
{
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function simulateForm($data = [])
    {
        return view('loans.simulateForm', [
            'products' => $data['products'] ?? [],
            'loanAmount' => $data['loanAmount'] ?? ''
        ]);
    }

    public function preSimulate()
    {

        $loanAmount = $this->request->get('loan_amount');
        $productsModel = new Products();
        $products = $productsModel::with(['parametrizations' => function ($query) {
            $query->where('actived', '=', true);
        }])->where('actived', '=', true)->get();
        $calculatorService = new Calculator();
        $result = [];
        foreach ($products as &$item) {


            $productSimulate = [
                "id" => $item->id,
                "description" => $item->description,
                "icon" => $item->icon
            ];


            $simulate = [];
            foreach ($item->parametrizations as $itemParametrizations) {

                $calculatorService->setData([
                    'loan_amount' =>  Helper::removeMoneyMask($loanAmount),
                    'interest_rate' => $itemParametrizations['interest_rate'],
                    'comission_rate' => $itemParametrizations['comission_rate'],
                    'installments' => $itemParametrizations['installments'],
                ])->calculate();
                $simulate[] = $calculatorService->getResults();
            }
            if (!empty($simulate)) {
                $productSimulate['simulate'] = $simulate;
                $result[] = $productSimulate;
            }
        }

        return $this->simulateForm(
            [
                'products' => $result,
                'loanAmount' => Helper::removeMoneyMask($loanAmount)
            ]
        );
    }


    public function formLoan()
    {
        $requestData = $this->request->input();

        $simulate = [];
        $products = [];
        $products = $this->fetchProducts();
        if (!empty($requestData)) {

            if (!empty($products)) {
                $product = $this->filterProduct($products, $requestData);
                $parametrization = $this->getProductParametrization($product, $requestData);
                $simulate = $this->simulateLoan([
                    'loan_amount' => $requestData['loan_amount'],
                    'interest_rate' => $parametrization['interest_rate'],
                    'comission_rate' => $parametrization['commission_rate'],
                    'installments' => $requestData['installment'],
                ]);

                $simulate['product'] = $product;
            }
        }

        $customers = Customer::with('person')->get();


        return view('loans.loansForm', [
            'loan' => $simulate,
            'customers' => $customers,
            'products' => $products,
        ]);
    }

    private function fetchProducts()
    {
        $productsModel = new Products();
        return $productsModel::with('parametrizations')->where('actived', '=', true)->get();
    }

    private function filterProduct($products, $requestData)
    {
        $idProduct = $requestData['id_product'];

        $product = array_filter($products->toArray(), function ($item) use ($idProduct) {
            return $item['id'] == $idProduct;
        });

        return reset($product);
    }

    private function getProductParametrization($products, $requestData)
    {
        $installment = $requestData['installment'];

        $parametrization = array_filter($products['parametrizations'], function ($item) use ($installment) {
            return $item['installments'] == $installment;
        });

        return reset($parametrization);
    }

    private function simulateLoan(array $data): array
    {
        $calculatorService = new Calculator();

        return $calculatorService->setData($data)->calculate()->getResults();
    }


    public function getSilmulate()
    {
        $requestData = $this->request->input();

        $productsModel = new Products();
        $simulate = [];
        if (!empty($requestData)) {

            $product = $productsModel::with('parametrizations')->where('actived', '=', true)->find($requestData['id_product'])->toArray();
            $parametrization = $this->getProductParametrization($product, $requestData);
            $simulate = $this->simulateLoan([
                'loan_amount' => Helper::removeMoneyMask($requestData['loan_amount'] ?? 0),
                'financed_amount' => Helper::removeMoneyMask($requestData['financed_amount'] ?? 0),
                'interest_rate' => Helper::removeMoneyMask($requestData['interest_rate'] ?? $parametrization['interest_rate']),
                'comission_rate' => $parametrization['commission_rate'],
                'installments' => $requestData['installment'],
            ]);
        }

        return $simulate;
    }
}

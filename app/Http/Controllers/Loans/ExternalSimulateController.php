<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Services\Calculator;
use Illuminate\Http\Response;

use Helper;

class ExternalSimulateController extends Controller
{

    private Response $response;

    public function __construct(\Illuminate\Http\Request $request)
    {
        parent::__construct($request);
    }


    public function siteSimulate()
    {
        $dataResponse = $this->request->post();
        $productsModel = new Products();

        $products = $productsModel::with(['parametrizations' => function ($query) {
            $query->where('actived', '=', true);
        }])->where('actived', '=', true)->first();

        $calculatorService = new Calculator();


        $simulate = [];
        foreach ($products->parametrizations as $itemParametrizations) {

            $calculatorService->setData([
                'loan_amount' =>  Helper::removeMoneyMask($dataResponse['loan_amount']),
                'interest_rate' => $itemParametrizations['interest_rate'],
                'comission_rate' => $itemParametrizations['comission_rate'],
                'installments' => $itemParametrizations['installments'],
            ])->calculate();
            $simulate[] = $calculatorService->getResults();
        }

        echo json_encode([
            'message' => 'Simulação realizada com sucesso',
            'data' =>  $simulate
        ]);
        die;
    }
}

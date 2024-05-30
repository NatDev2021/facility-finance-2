<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Charges;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use App\Models\ProductsParametrization;
use App\Models\ProductsParametrizationCharges;
use App\Models\Status;
use Helper;

class ConfigProductsController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function configProducts($id)
    {

        $products = Products::with(['documents', 'parametrizations'])->find($id);
        $charges = Charges::get();
        $documents = Documents::get();
        $status = Status::get();

        foreach ($documents as &$item) {

            foreach ($products->documents as $row) {

                if ($item->id == $row->document_id) {
                    $item['checked'] = 'checked';
                }
            }
        }


        return view('products.configProducts', [
            'products' => $products,
            'charges' => $charges,
            'documents' => $documents,
            'status' => $status
        ]);
    }

    public function saveParametrization()
    {
        $data = $this->request->post();


        if (empty($data['parametrization_id'])) {
            $this->createParametrization($data);
        } else {
            $this->updateParametrization($data);
        }

        return redirect('/products/config/' . $data['product_id']);
    }

    private function createParametrization(array $data)
    {
        $idParametrization = ProductsParametrization::create([
            'description' => $data['description'] ?? '',
            'product_id' => $data['product_id'] ?? '',
            'interest_rate' => Helper::removeMoneyMask($data['rate'] ?? ''),
            'commission_rate' => Helper::removeMoneyMask($data['commission'] ?? ''),
            'installments' => $data['installments'] ?? '',
            "id_user_ins" => $this->request->user()->id,
            'actived' => $data['actived'],

        ])->id;

        $this->updateParamtrizationCharges($idParametrization, $data);


        toast('Parametrização criada.', 'success');

        return $idParametrization;
    }

    private function updateParametrization(array $data)
    {
        $parametrization = ProductsParametrization::find($data['parametrization_id']);

        $parametrization->update([
            'actived' => $data['actived'] ?? null,
            'description' => $data['description'] ?? '',
            'interest_rate' => Helper::removeMoneyMask($data['rate'] ?? ''),
            'commission_rate' => Helper::removeMoneyMask($data['commission'] ?? ''),
            'installments' => $data['installments'] ?? '',

        ]);

        toast('Parametrização atualizada.', 'success');
        return $data['parametrization_id'];
    }

    private function updateParamtrizationCharges(int $idParametrization, array $data)
    {
        $chargeParametrization = new ProductsParametrizationCharges();
        $chargeParametrization::where('parametrization_id', $idParametrization)->delete();

        if (!empty($data['charges'])) {

            foreach ($data['charges'] as $row) {

                $chargeParametrization::create([
                    'id_user_ins' => $this->request->user()->id,
                    'parametrization_id' => $idParametrization,
                    'charge_id' => $row
                ]);
            }
        }

        return true;
    }




    protected function getParametrization($id)
    {
        return ProductsParametrization::with(['charges'])->find($id);
    }
}

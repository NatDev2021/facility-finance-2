<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\{Products, ProductsDocuments};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveProducts()
    {
        $data = $this->request->post();

        if (empty($data['product_id'])) {
            $this->createProducts($data);
        } else {
            $this->updateProducts($data);
        }

        return redirect('/products');
    }

    private function createProducts(array|string|null $data)
    {
        $this->createValidator($data)->validate();
        $idProduct = Products::create([
            'description' => $data['description'] ?? null,
            'icon' => $data['icon'] ?? null,
            'actived' => $data['actived'] ?? null,
            'initial_status_id' => $data['initial_status_id'],
            'final_status_id' => $data['final_status_id'],
            "id_user_ins" => $this->request->user()->id,


        ])->id;

        $this->updateParamtrizationDocuments($idProduct, $data);


        toast('Produto criado.', 'success');
        return $idProduct;
    }

    private function updateProducts(array|string|null $data)
    {
        $product = Products::find($data['product_id']);

        $product->update([
            'description' => $data['description'] ?? null,
            'icon' => $data['icon'] ?? null,
            'actived' => $data['actived'] ?? null,
            'initial_status_id' => $data['initial_status_id'],
            'final_status_id' => $data['final_status_id']
        ]);
        $this->updateParamtrizationDocuments($data['product_id'], $data);

        toast('Produto atualizado.', 'success');
        return $data['product_id'];
    }

    private function createValidator(array|string|null $data)
    {
        return Validator::make($data, [
            'description' => ['required', 'string', 'min:1', 'max:50'],
            'icon' => ['required', 'string', 'min:1', 'max:50'],
            'actived' => ['required'],
        ]);
    }

    public function deleteProducts($id)
    {

        // TODO: Validar exclusao

        $product = Products::find($id);
        $product->delete();
        toast('Produto excluido.', 'success');
        return redirect('/products');
    }

    protected function getProducts($id)
    {
        return Products::with('parametrizations')->find($id);
    }

    private function updateParamtrizationDocuments(int $idProduct, array $data)
    {
        $documentParametrization = new ProductsDocuments();
        $documentParametrization::where('product_id', $idProduct)->delete();

        if (!empty($data['documents'])) {

            foreach ($data['documents'] as $row) {

                $documentParametrization::create([
                    'id_user_ins' => $this->request->user()->id,
                    'product_id' => $idProduct,
                    'document_id' => $row
                ]);
            }
        }

        return true;
    }

    protected function getParametrization($idProduct, $installment)
    {
        return Products::with(['parametrizations' => function ($query) use ($installment) {
            $query->where('installments', '=', $installment);
        }])->find($idProduct);
    }
}

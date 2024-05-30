<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\FinancialMovement;
use App\Models\LoansFiles;
use App\Models\Person;
use App\Models\Products;
use App\Models\Loans;
use App\Models\Signatures;
use App\Models\Status;
use App\Services\Calculator;
use App\Services\ZapSign;
use TCPDF;
use Helper;
use Illuminate\Support\Facades\Storage;

class LoansController extends Controller
{
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }


    public function saveLoan()
    {
        $data = $this->request->post();

        if (empty($data['id_loan'])) {
            $idLoan =  $this->createLoan($data);
        } else {
            $idLoan = $this->updateLoan($data);
        }

        return redirect('/loans/detail/' . $idLoan);
    }

    public function createLoan($requestData)
    {

        $productsModel = new Products();
        $simulate = [];
        $product = $productsModel::with('parametrizations')->where('actived', '=', true)->find($requestData['id_product'])->toArray();
        $parametrization = $this->getProductParametrization($product, $requestData['installments']);
        $simulate = $this->simulateLoan([
            'loan_amount' => Helper::removeMoneyMask($requestData['loan_amount'] ?? 0),
            'financed_amount' => Helper::removeMoneyMask($requestData['financed_amount'] ?? 0),
            'interest_rate' => Helper::removeMoneyMask($requestData['interest_rate'] ?? $parametrization['interest_rate']),
            'comission_rate' => $parametrization['commission_rate'] ?? 0,
            'installments' => $requestData['installments'],
        ]);


        $idContract = Loans::create([
            'loan_amount' =>  $simulate['loan_amount'],
            'installments' => $simulate['installments'],
            'installment_amount' => $simulate['installment_amount'],
            'interest_rate' => $simulate['interest_rate'],
            'interest_rate_month' => $simulate['interest_rate_month'],
            'interest_amount' => $simulate['interest_amount'],
            'commission_rate' => $simulate['commission_rate'],
            'commission_amount' => $simulate['commission_amount'],
            'financed_amount' => $simulate['financed_amount'],
            'status_id' => $product['initial_status_id'],
            'customer_id' => $requestData['select_customer'],
            'parametrization_id' => $parametrization['id'],
            "id_user_ins" => $this->request->user()->id,
        ])->id;

        toast('Contrato criado.', 'success');
        return  $idContract;
    }

    public function updateLoan($requestData)
    {

        $productsModel = new Products();
        $simulate = [];
        $product = $productsModel::with('parametrizations')->where('actived', '=', true)->find($requestData['id_product'])->toArray();
        $parametrization = $this->getProductParametrization($product, $requestData['installments']);
        $simulate = $this->simulateLoan([
            'loan_amount' => Helper::removeMoneyMask($requestData['loan_amount'] ?? 0),
            'financed_amount' => Helper::removeMoneyMask($requestData['financed_amount'] ?? 0),
            'interest_rate' => Helper::removeMoneyMask($requestData['interest_rate'] ?? $parametrization['interest_rate']),
            'comission_rate' => $parametrization['commission_rate'] ?? 0,
            'installments' => $requestData['installments'],
        ]);

        $loan = Loans::find($requestData['id_loan']);

        $arrayUpdate = [
            'loan_amount' =>  $simulate['loan_amount'],
            'installments' => $simulate['installments'],
            'installment_amount' => $simulate['installment_amount'],
            'interest_rate' => $simulate['interest_rate'],
            'interest_rate_month' => $simulate['interest_rate_month'],
            'interest_amount' => $simulate['interest_amount'],
            'commission_rate' => $simulate['commission_rate'],
            'commission_amount' => $simulate['commission_amount'],
            'financed_amount' => $simulate['financed_amount'],
            'customer_id' => $requestData['select_customer'],
            'status_id' => $requestData['status_id'],
            'parametrization_id' => $parametrization['id'],
            'note' => $requestData['note'],
            'cardholder' => empty($requestData['select_holder']) ? null : $requestData['select_holder'],
            "id_user_ins" => $this->request->user()->id,
        ];

        if (empty($loan['disbursement_date']) && $requestData['status_id'] == $product['final_status_id']) {

            $arrayUpdate['disbursement_date'] = date('Y-m-d');

            FinancialMovement::create([
                'description' =>  'Comissão referente ao contrato Nº ' . $requestData['id_loan'],
                'date' => date('Y-m-d'),
                'value_amount' => $simulate['commission_amount'],
                'note' => 'Entrada de comoissão referente ao contrato Nº ' . $requestData['id_loan'] . '. Base de cálculo: ' . Helper::formatBrazilianNumber($simulate['commission_rate']) . '% de R$' . Helper::formatBrazilianNumber($simulate['interest_amount']),
                'type' => 'i',
                "id_user_ins" => $this->request->user()->id,
            ]);
        }

        $loan->update($arrayUpdate);

        $file = $this->request->file('input_document');

        if (!empty($file)) {
            $this->saveFiles($requestData['id_loan'], $file);
        }

        toast('Contrato atualizado.', 'success');
        return  $requestData['id_loan'];
    }

    private function getProductParametrization($products, $installments)
    {

        $parametrization = array_filter($products['parametrizations'], function ($item) use ($installments) {
            return $item['installments'] == $installments;
        });
        return reset($parametrization);
    }

    private function simulateLoan(array $data): array
    {
        $calculatorService = new Calculator();

        return $calculatorService->setData($data)->calculate()->getResults();
    }


    public function detailLoan($idLoan)
    {

        $loan = Loans::with(['userInsert', 'holder', 'holderAddress', 'signature'])->find($idLoan);
        $customer = Customer::with(['person', 'personAddress'])->find($loan['customer_id']);
        $customers = Customer::with('person')->get();
        $persons = Person::get();
        $products = Products::with('parametrizations')->where('actived', '=', true)->get();
        $status = Status::where('actived', '=', true)->get();
        $files = LoansFiles::where('loan_id', '=', $idLoan)->get();
        $productLoan = $this->filterProduct($products, $loan['parametrization_id']);
        $loan['product'] = $productLoan;
        $company = Company::find(1);


        $signatues = json_decode(json_encode($loan['signature']), true);
        $signedStatus = false;
        $signed = array_filter($signatues, function ($item) {
            if ($item['status'] == 'signed') {
                return $item;
            }
        });

        $signed = end($signed); // Ultimo arquivo assinado.

        if (empty($signed)) { //Arquivo ainda não assinado.
            $contractView = view('pdf.contract', [
                'customer' => $customer,
                'loan' => $loan,
                'company' => $company
            ]);

            $contract = $this->generateContract($contractView);
        } else if (!empty($signed['path'])) { //Arquivo assinado e salvo.

            $contract = Storage::get($signed['path']);
            $signedStatus = true;
        } else {
            $signedStatus = true;
            $contract = $this->downloadSignedContract($signed);
        }

        return view('loans.loansDetail', [
            'products' => $products,
            'persons' => $persons,
            'loan' =>  $loan,
            'customer' => $customer,
            'customers' => $customers,
            'status' =>  $status,
            'contract' => base64_encode($contract ?? 'Arquivo Indisponível'),
            'signedstatus' => $signedStatus,
            'files' => $files
        ]);
    }
    private function filterProduct($products, $idParametrization)
    {


        $product = array_filter($products->toArray(), function ($item) use ($idParametrization) {

            foreach ($item['parametrizations'] as $row) {

                if ($row['id'] == $idParametrization) {
                    return $item;
                }
            }
        });

        return reset($product);
    }

    public function generateContract($html)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('Contrato de Empréstimo');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('helvetica', '', 9);

        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        ob_clean();
        return $pdf->Output("contrato.pdf", 'S');
    }

    private function saveFiles($idLoan, $files)
    {

        foreach ($files as $file) {

            $path =   Storage::disk('local')->put($idLoan . '/' . $file->getClientOriginalName(), $file);

            LoansFiles::create([
                'loan_id' => $idLoan,
                'file_name' => $file->getClientOriginalName(),
                'file_size' =>  $file->getSize(),
                'mime_type' =>  $file->getMimeType(),
                'path' =>  $path,
                "id_user_ins" => $this->request->user()->id,
            ]);
        }
    }
    public function downloadFile($idFile)
    {
        $file = LoansFiles::find($idFile);
        return Storage::download($file['path'], $file['file_name']);
    }

    public function downloadSignedContract($signed)
    {
        $signatureService = new ZapSign();
        $contract = $signatureService->documentDetail($signed['token']);
        $file = file_get_contents($contract['signed_file']);
        $fileName = $signed['token'] . '.pdf';
        $path =   Storage::disk('local')->put($signed['external_id'] . '/' .  $fileName, $file);
        $signed['path'] = $signed['external_id'] . '/' .  $fileName;
        $signed['file_name'] = $fileName;
        $signature = Signatures::find($signed['id']);
        $signature->update($signed);
        return $file;
    }
}

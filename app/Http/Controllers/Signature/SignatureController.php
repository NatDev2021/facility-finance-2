<?php

namespace App\Http\Controllers\Signature;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Loans;
use App\Models\Notifications;
use App\Models\Signatures;
use App\Services\ZapSign;
use Illuminate\Http\Request;
use TCPDF;
use Helper;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function send()
    {
        $data = $this->request->post();
        $loan = Loans::with(['holder', 'holderAddress'])->find($data['id_loan']);
        $customer = Customer::with(['person', 'personAddress', 'personPhone'])->find($loan['customer_id']);

        if (!Helper::validateEmail($customer['person']['email'])) {
            return [
                'status' => 'error',
                'message' => 'Cliente não possui e-mail válido.'
            ];
        }

        $company = Company::find(1);

        $contractView = view('pdf.contract', [
            'customer' => $customer,
            'loan' => $loan,
            'company' => $company
        ]);


        $contract = $this->generateContract($contractView);
        $dateLimit = new \DateTime(date('Y-m-d'));
        $dateLimit->add(new \DateInterval('P1D'));

        $payload = [
            'name' => 'Contrato de Empréstimo',
            'base64_pdf' => base64_encode($contract),
            'brand_logo' => url('img/authLogo.png'),
            'brand_name' => $company['business_name'],
            'external_id' => $loan['id'],
            'folder_path' => '/' . $company['document'] . '/',
            'created_by' => env('ZAPSING_USER'),
            'date_limit_to_sign' => $dateLimit->format('Y-m-d'),
            'signers' => [
                [
                    'external_id' => $customer['id'],
                    'auth_mode'  => 'assinaturaTela',
                    'name' => $customer['person']['name'],
                    'email' => $customer['person']['email'],
                    'cpf' => $customer['person']['document'],
                    'send_automatic_email' =>  true,
                    'phone_country' => 55,
                    'phone_number' => $customer['personPhone']['phone']
                ]
            ]

        ];


        $signService = new ZapSign();
        $response =  $signService->sendDocument($payload);



        if ($response->failed()) {
            return [
                'status' => 'error',
                'message' => 'Erro ao solicitar assinatura'
            ];
        }

        $dataResponse = $response->json();

        Signatures::create([
            'external_id' => $dataResponse['external_id'],
            'token' => $dataResponse['token'],
            'name' => $dataResponse['name'],
            'folder_path' => $dataResponse['folder_path'],
            'status' => $dataResponse['status'],
            'original_file' => $dataResponse['original_file'],
            'signed_file' => $dataResponse['signed_file'],
            'created_by' => $dataResponse['created_by']['email']
        ]);

        return [
            'status' => 'success',
            'message' => 'Assinatura solicitada com sucesso.'
        ];
    }

    public function webhook()
    {
        $dataResponse = $this->request->post();

        if (!empty($dataResponse['token'])) {

            $fileName = $dataResponse['token'] . '.pdf';
            $file = file_get_contents($dataResponse['signed_file']);
            $path =   Storage::disk('local')->put($dataResponse['external_id'] . '/' .  $fileName, $file);

            Signatures::create([
                'external_id' => $dataResponse['external_id'],
                'token' => $dataResponse['token'],
                'name' => $dataResponse['name'],
                'folder_path' => $dataResponse['folder_path'],
                'status' => $dataResponse['status'],
                'file_name' => $fileName,
                'path' =>  $dataResponse['external_id'] . '/' .  $fileName,
                'created_by' => $dataResponse['created_by']['email']
            ]);

            if ($dataResponse['status'] == 'signed') {

                $data = [
                    'title' => 'Documento Assinado',
                    'message' => $dataResponse['signers'][0]['name'] . ' finalizou a assinatura do contrato Nº ' . $dataResponse['external_id']
                ];

                Notifications::create($data);
                event(new PostCreated([
                    'icon' => 'info',
                    ...$data
                ]));
            }
        }

        return response('ok');
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
}

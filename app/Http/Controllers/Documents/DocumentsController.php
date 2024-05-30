<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use League\CommonMark\Node\Block\Document;

class DocumentsController extends Controller
{

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }

    public function saveDocument()
    {
        $data = $this->request->post();
        if (empty($data['id_document'])) {
            $this->ceateDocument($data);
        } else {
            $this->updateDocument($data);
        }

        return redirect('/documents');
    }

    private function ceateDocument(array|string|null $data)
    {
        // $this->createValidator($data)->validate();
        $idDocument = Documents::create([
            'description' => $data['description'] ?? '',
            'actived' => $data['actived'] ?? '',
            "id_user_ins" => $this->request->user()->id,
        ])->id;

        toast('Documento criado.', 'success');
        return $idDocument;

    }

    private function updateDocument(array|string|null $data)
    {
        $document = Documents::find($data['id_document']);
        $document->update([
            'description' => $data['description'] ?? '',
            'actived' => $data['actived'] ?? '',
        ]);

        toast('Documento atualizado.', 'success');
        return $data['id_document'];
    }

    public function deleteDocuments($id)
    {

        // TODO: Validar exclusao

        $document = Documents::find($id);
        $document->delete();
        toast('Documento excluido.', 'success');
        return redirect('/documents');
    }

    protected function getDocuments($id)
    {
        return Documents::find($id);

    }
}

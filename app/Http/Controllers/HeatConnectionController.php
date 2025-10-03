<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\HeatConnection;
use App\Services\DocumentTypeService;

class HeatConnectionController extends Controller
{
    protected $model = HeatConnection::class;

    public function index(DocumentTypeService $documentTypeService) {

        $documentType = DocumentType::where('model', $this->model)->first();
        $documentListInfo = $documentTypeService->getDocumentListInfo($this->model, $documentType);

        return view('heat_connection.index',
                [
                    'areas' => $documentListInfo['all'],
                    "state"=>$documentListInfo['stages'],
                    'document_type' => $documentType
                ]);
    }


    public function edit($id) {
        $item = $this->model::findOrFail($id);
        $documentType = DocumentType::where('model', $this->model)->first();
        return view('water_connection.edit', ['item' => $item, 'document_type' => $documentType]);
    }

    public function create() {
        $documentType = DocumentType::where('model', $this->model)->first();
        return view('water_connection.create', ['document_type' => $documentType]);
    }
}

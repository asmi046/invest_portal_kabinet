<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandLeaseApplication;
use App\Services\DocumentTypeService;
use App\Models\DocumentType;

class LandLeaseApplicationController extends Controller
{
    protected $model = LandLeaseApplication::class;

    public function index(DocumentTypeService $documentTypeService) {

        $documentType = DocumentType::where('model', $this->model)->first();
        $documentListInfo = $documentTypeService->getDocumentListInfo($this->model, $documentType);

        return view('land_lease_application.index',
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

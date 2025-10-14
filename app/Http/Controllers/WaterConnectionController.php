<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\WaterConnection;
use App\Services\DocumentTypeService;
use App\Http\Requests\WaterConnection\WaterConnectionSignRequest;
use App\Http\Requests\WaterConnection\WaterConnectionDraftRequest;

class WaterConnectionController extends Controller
{
    protected $model = WaterConnection::class;
    protected $draftRequest = WaterConnectionDraftRequest::class;
    protected $signRequest = WaterConnectionSignRequest::class;
    protected string $viewFolder = 'water_connection';
    protected $documentType;

    public function __construct()
    {
        $this->documentType = DocumentType::where('model', $this->model)->first();
    }

    public function index(DocumentTypeService $documentTypeService) {

        $documentListInfo = $documentTypeService->getDocumentListInfo($this->model, $this->documentType);
        return view($this->viewFolder . '.index',
                [
                    'elements' => $documentListInfo['all'],
                    "state"=>$documentListInfo['stages'],
                    'document_type' => $this->documentType
                ]);
    }

    public function edit($id) {
        $item = $this->model::findOrFail($id);
        return view($this->viewFolder . '.edit', ['item' => $item, 'document_type' => $this->documentType]);
    }

    public function create() {
        return view($this->viewFolder . '.create', ['document_type' => $this->documentType]);
    }


    public function print($id) {
        $element = $this->model::where('id', $id)->first();
        return response()->download($element->print());
    }

    public function delete(DocumentTypeService $documentTypeService, $id) {
        $documentTypeService->deleteDocument($this->model, $id);
        return redirect($this->documentType->index_url)->with('deleted', "Запись была успешно удалена");
    }

    public function save(DocumentTypeService $documentTypeService, Request $request) {

        $id = $request->input('id');
        $att_delete = $request->input('att_delete');
        if ($att_delete)
        {
            $at = Attachment::where('id', $att_delete)->first();
            $at->delete();
            return redirect()->back()->with('form_message', "Вложение удалено");
        }

        switch ($request->input('action')) {

            case 'create_draft':
                $data = $documentTypeService->createDraft($this->model, $this->draftRequest, $request, $request->all());
                return redirect($this->documentType->index_url.'/edit/'.$data->id)->with('form_message', "Черновик сохранен");
            break;

            case 'save_draft':
                $data = $documentTypeService->saveDraft($this->model, $this->draftRequest, $request, $request->all(), $id);
                return redirect()->back()->with('form_message', "Черновик сохранен");
            break;

            case 'check_draft':
                $data = $documentTypeService->checkDraft($this->model, $this->signRequest, $request, $request->all(), $request->input('id'));
                return redirect($this->documentType->index_url.'/edit/'.$id)->with('form_message', "Черновик проверен");
            break;

        }


    }

}

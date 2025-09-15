<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoskeyRegistry;
use App\Services\PrintServices;
use App\Services\GoskeyRegistryService;

class GoskeySignController extends Controller
{
    public function sign_fl(Request $request)
    {
        $documentUrl = PrintServices::save($request->model, $request->documentId);

        $att_files = get_attachment_list_before_sign($request->model, $request->documentId,$documentUrl);

        $goskeyRegistryService = new GoskeyRegistryService();
        $rez = $goskeyRegistryService->createProcedure(
            main_files: $att_files,
            document_type: $request->model,
            document_id: $request->documentId,
            user_id: auth()->user()->id
        );

        if ($rez['error']) {
            abort(500, $rez['error_message'] . " " . $rez['error_code']);
        } else {
            $request->model::find($request->documentId)->update(['editable' => false]);
            return response()->json([
                'status' => 'success',
                'message' => 'Документ успешно отправлен на подписание',
                'data' => $rez
            ]);
        }
    }

    public function sign_ul(Request $request)
    {
        $documentUrl = PrintServices::save($request->model, $request->documentId);

        $att_files = get_attachment_list_before_sign($request->model, $request->documentId, $documentUrl);

        $goskeyRegistryService = new GoskeyRegistryService();
        $rez = $goskeyRegistryService->createProcedure(
            main_files: $att_files,
            document_type: $request->model,
            document_id: $request->documentId,
            user_id: auth()->user()->id,
            ul: true
        );

        if ($rez['error']) {
            abort(500, $rez['error_message'] . " " . $rez['error_code']);
        } else {
            $request->model::find($request->documentId)->update(['editable' => false]);
            return response()->json([
                'status' => 'success',
                'message' => 'Документ успешно отправлен на подписание',
                'data' => $rez
            ]);
        }
    }

    public function get_sign_state(Request $request)
    {
        return GoskeyRegistry::where('message_id', $request->message_id)->firstOrFail();
    }

    public function download($filename)
    {
        $path = storage_path('app/' . $filename);
        if (!file_exists($path)) abort(404);
        return response()->file($path);
    }

    public function ukep_info()
    {
        return view('ukep-info');
    }

    public function ukep_info_ul()
    {
        return view('ukep-info-ul');
    }


}

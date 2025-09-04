<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrintServices;
use App\Services\GoskeyRegistryService;

class GoskeySignController extends Controller
{
    public function sign_fl(Request $request)
    {
        $documentUrl = PrintServices::save($request->model, $request->documentId);

        $goskeyRegistryService = new GoskeyRegistryService();
        $rez = $goskeyRegistryService->createProcedure(
            main_files: [
                $documentUrl
            ],
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
        abort(403, "Доступ к функции запрещен");
    }
}

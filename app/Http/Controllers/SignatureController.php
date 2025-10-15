<?php

namespace App\Http\Controllers;

use App\Models\AreaGet;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\SignedDocument;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function signe($file_id) {
        $file = SignedDocument::where('id', $file_id)->first();
        if (!$file) abort(404);
        $document_type = DocumentType::where('model', $file->inner_document_type)->first();
        return view("signe-local", ['file' => $file, 'document_type' => $document_type]);
    }


    protected function chenge_status(int $model_id, string $document_type) {
        $status = ['state' => "Подписан и отправлен"];
        $model_t = config('documents')[$document_type]['model'];
        $model = new $model_t();
        $model->where('id', $model_id)->update($status);

        // switch ($document_type) {
        //     case 'Заявление на предоставление земельного участка':
        //         AreaGet::where('id', $model_id)->update($status);
        //     break;
        // }
    }

    protected function chenge_document_status(int $model_id, string $document_type) {
        $model = new $document_type();
        $model->where('id', $model_id)->update([
            'editable' => false,
        ]);
    }

    public function load_signed_file(Request $request) {
        $signe_id = $request->input('signe_id');
        $signe = SignedDocument::where('id', $signe_id)->first();

        $sig_file = str_replace([".pdf", ".docx"], "", $signe->file).".sig";

        // file_put_contents(public_path($signe->storage_patch."/".$sig_file), file_get_contents($request->file('signature')));
        Storage::disk('local')->put($signe->storage_patch . '/' . basename($sig_file), file_get_contents($request->file('signature')));
        $signe->fill(['signature' => $sig_file]);
        $signe->save();

        // $this->chenge_status($signe->document_id, $signe->inner_document_type);
        $this->chenge_document_status($signe->document_id, $signe->inner_document_type);

        return $sig_file;
    }

    public function download($filename)
    {
        $path = storage_path('app/' . $filename);
        if (!file_exists($path)) abort(404);
        return response()->file($path);
    }
}

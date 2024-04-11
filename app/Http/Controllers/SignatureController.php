<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SignedDocument;
use App\Models\AreaGet;

class SignatureController extends Controller
{
    public function signe($file_id) {
        $file = SignedDocument::where('id', $file_id)->first();
        if (!$file) abort(404);

        return view("signe", ['file' => $file]);
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

    public function load_signed_file(Request $request) {
        $signe_id = $request->input('signe_id');
        $signe = SignedDocument::where('id', $signe_id)->first();

        $sig_file = $signe->file.".sig";

        file_put_contents(public_path($signe->storage_patch."/".$sig_file), file_get_contents($request->file('signature')));
        $signe->fill(['signature' => $sig_file]);
        $signe->save();

        $this->chenge_status($signe->document_id, $signe->inner_document_type);

        return $sig_file;
    }
}

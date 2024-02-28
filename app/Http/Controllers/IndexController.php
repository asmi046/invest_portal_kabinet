<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CreateDocServices;
use App\Models\UploadDocument;

class IndexController extends Controller
{
    public function index() {
        return view('index');
    }
    public function myProject() {
        return view('myProject');
    }
    public function applicationСatalog() {
        return view('applicationСatalog');
    }

    public function statement() {
        return view('statement');
    }

    public function signe($file_id) {
        $file = UploadDocument::where('id', $file_id)->first();
        if (!$file) abort(404);

        return view("signe", ['file' => $file]);
    }

    public function test(CreateDocServices $document) {
        $options = [
            'organization' => '777org!!!!'
        ];

        $fn = $document->create_tmp_document(
            public_path('documents_template/gos_support_template.docx'),
            $options,
            11,
            "Тип1",
            "Имя документа"
        );


        return response()->download($fn);
    }

}

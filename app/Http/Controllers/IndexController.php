<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CreateDocServices;

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

    public function test(CreateDocServices $document) {
        $options = [
            'organization' => '777org!!!!'
        ];

        $fn = $document->create_tmp_document(
            public_path('documents_template/gos_support_template.docx'),
            $options
        );


        return response()->download($fn);
    }

}

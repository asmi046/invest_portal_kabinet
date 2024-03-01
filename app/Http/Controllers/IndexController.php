<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvestDocument;
use App\Models\UploadDocument;
use App\Services\CreateDocServices;

class IndexController extends Controller
{
    public function index() {
        $all_docs = InvestDocument::all();
        $docs_struct = [];
        foreach ($all_docs as $item){
            $docs_struct[$item->subtype][] = $item;
        }
        return view('index', ['docs' => $docs_struct]);
    }

}

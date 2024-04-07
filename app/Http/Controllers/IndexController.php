<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Support;
use Illuminate\Http\Request;
use App\Models\InvestDocument;
use App\Models\SignedDocument;
use App\Models\UploadDocument;
use App\Models\TechnicalConnects;
use App\Services\CreateDocServices;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {
        $all_docs = InvestDocument::all();
        $docs_struct = [];
        foreach ($all_docs as $item){
            $docs_struct[$item->subtype][] = $item;
        }

        $last_project = Project::where("user_id", Auth::user()["id"] )->orderBy('created_at',"DESC")->first();
        $last_ts = TechnicalConnects::where("user_id", Auth::user()["id"] )->orderBy('created_at',"DESC")->first();
        $last_support = Support::where("user_id", Auth::user()["id"] )->orderBy('created_at',"DESC")->first();

        return view('index', [
            'docs' => $docs_struct,
            'last_project' => $last_project ,
            'last_ts' => $last_ts,
            'last_support' => $last_support
        ]);
    }

    public function signe($file_id) {
        $file = SignedDocument::where('id', $file_id)->first();
        if (!$file) abort(404);

        return view("signe", ['file' => $file]);
    }

    public function load_signed_file(Request $request) {
        $signe_id = $request->input('signe_id');
        $signe = SignedDocument::where('id', $signe_id)->first();

        $sig_file = $signe->storage_patch."/".$signe->file.".sig";

        file_put_contents(public_path($sig_file), file_get_contents($request->file('signature')));
        $signe->fill(['signature' => $sig_file]);
        $signe->save();

        return $sig_file;
    }


}

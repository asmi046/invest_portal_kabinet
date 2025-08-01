<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Support;
use Illuminate\Http\Request;
use App\Models\InvestDocument;

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


    public function to_local(Request $request) {
        $full_url = $request->fullUrl();
        $rezUrl = str_replace('https://investlk.rkursk.ru/to_local','http://127.0.0.1:8000/esia_get_auth_info', $full_url);
        return redirect($rezUrl);
    }

}

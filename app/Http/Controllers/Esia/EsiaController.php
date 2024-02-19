<?php

namespace App\Http\Controllers\Esia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\EsiaServices;

class EsiaController extends Controller
{
    public function esia_get_auth_lnk() {

        $esia = new EsiaServices();
        // dd($esia->getAuthLink());
        return view('test', ['lnk' => $esia->getAuthLink()]);
    }

    public function esia_get_token(Request $request) {

        $esia = new EsiaServices();

        $code = $request->input('code');
        $state = $request->input('state');

        $esia->getToken($code, $state);

    }

    public function esia_callbac() {
        return "";
    }
}

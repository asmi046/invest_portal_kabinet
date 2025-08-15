<?php

namespace App\Http\Controllers\Esia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\EsiaServices;
use App\Models\User;

class EsiaController extends Controller
{
    public function esia_error(Request $request) {
        return view('auth.esia-error');
    }

    public function esia_get_auth_info(Request $request) {

        try
        {
            $esia = new EsiaServices();

            $code = $request->input('code');
            $state = $request->input('state');

            $esia->getToken($code, $state);

            $person_info = $esia->get_person();
            $contact_info = $esia->get_contact();


            $user = User::updateOrCreate(
                ['email' => $contact_info["EML"]],
                [
                    'name' => $person_info->firstName,
                    'lastname' => $person_info->lastName,
                    'fathername' => $person_info->middleName,
                    'snils' => $person_info->snils,
                    'oid'  => $esia->oid,
                    'reg_type' => 'esia',
                    'email' => $contact_info["EML"],
                    'phone' => $contact_info["MBT"],
                    'password' => bcrypt($person_info->rIdDoc),
                    'email_verified_at' => date("Y-m-d H:i:s"),
                ]
            );

            auth('web')->login($user);
            return redirect()->route('home');
        }
        catch(\Throwable $ex)
        {
            $message = $ex->getMessage();
            return redirect()->route('esia_error')->withErrors([
                'esia_error' => $message,
                'error' => $request->input('error'),
                'error_description' => $request->input('error_description'),
                'state' => $request->input('state'),
            ]);
        }


    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;

use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\PassRecMail;

use App\Services\EsiaServices;

class AuthController extends Controller
{
    public function show_login_form() {
        $esia = new EsiaServices();
        return view('auth.login', ['esia_lnk' => $esia->getAuthLink()]);
    }

    public function show_register_form() {
        $esia = new EsiaServices();
        return view('auth.register', ['esia_lnk' => $esia->getAuthLink()]);
    }

    public function welcom() {
        return view('auth.welcom');
    }

    public function show_passrec_form(Request $request) {
        return view('auth.password-recovery', ['confirm' => $request->get('confirm')]);
    }

    public function logout() {
        auth('web')->logout();
        return redirect(route('home'));
    }

    public function pass_req(Request $request) {
        $data = $request->validate([
            "email" => ['required', 'string', 'email', 'exists:users']
        ]);

        $user = User::where('email', $data['email'])->first();

        $new_password = uniqid();
        $user->password = bcrypt($new_password);
        $user->save();

        Mail::to($user)->send(new PassRecMail($new_password, $user->email, $user->name." ".$user->lastname));
        return redirect()->back()->with('pass_req', "Новый пароль отправлен на e-mail указанный при регистрации аккаунта");
    }

    public function login(LoginFormRequest $request) {
        $user_data = $request->validated();


        if(auth('web')->attempt($user_data)) {
            return redirect(route('home'));
        }

        return redirect(route('login'))->withErrors(['email'=>'Неверный логин или пароль']);
    }



    public function save_user_data(Request $request) {
        $user_data = $request->validate([

        ]);

        $user = User::where('id', auth()->user()->id)->first()->update([
            'name' => $user_data['name'],
            'email' => $user_data['email'],
        ]);


        return redirect(route('cabinet.home'));
    }

    public function register(RegisterFormRequest $request) {
        $user_data = $request->validated();

        $user = User::create(
            [
                'name' => $user_data['name'],
                'lastname' => $user_data['lastname'],
                'fathername' => $user_data['fathername'],
                'email' => $user_data['email'],
                'phone' => $user_data['phone'],
                'password' => bcrypt($user_data['password']),
            ]
        );

        if ($user) {
            event(new Registered($user));
            auth('web')->login($user);
            return redirect(route('verification.notice'));
        }

        return redirect(route('home'));
    }


}

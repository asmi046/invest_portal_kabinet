<?php

namespace App\Http\Controllers\UserData;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserData\UserDataFormRequest;
use App\Http\Requests\UserData\UserPasswordFormRequest;

class UserDataController extends Controller
{
    public function index() {
        $user = User::where('id', auth()->user()->id)->first();
        return view('user-data', ['user' => $user]);
    }

    public function save_user_data(UserDataFormRequest $request) {

        $data = $request->validated();

        $user = User::where('id', auth()->user()->id)->first();

        $file = $request->file('ul_attorney');
        if ($file) {
            $path = $file->storeAs("users/{$user->id}/attorney", $file->getClientOriginalName(), 'public');
            $data['ul_attorney'] = $path;
        }

        if ($request->input('attorney_delete')) {
            $data['ul_attorney'] = null;
        }

        $user->forceFill($data);
        $user->save();

        return redirect()->route('user-data')->with(['success_user_data' => 'Данные пользователя сохранены']);
    }

    public function chenge_user_password(UserPasswordFormRequest $request) {
        $data = $request->validated();
        $user = User::where('id', auth()->user()->id)->first();

        $user->forceFill($data);
        $user->save();

        return redirect()->route('user-data')->with(['success_user_pass' => 'Пароль успешно изменен']);
    }



}

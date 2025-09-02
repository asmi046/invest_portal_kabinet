<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoskeySignController extends Controller
{
    public function sign_fl(Request $request)
    {

    }

    public function sign_ul(Request $request)
    {
        abort(403, "Доступ к функции запрещен");
    }
}

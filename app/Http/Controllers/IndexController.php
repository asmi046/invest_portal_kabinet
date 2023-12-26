<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        return view('index');
    }
    public function auth() {
        return view('auth');
    }
    public function registration() {
        return view('registration');
    }
    public function passwordRecovery() {
        return view('passwordRecovery');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

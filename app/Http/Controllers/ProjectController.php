<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return view('all-projects');
    }

    public function status() {
        return view('project-statement');
    }

    public function create() {

    }

    public function edit($id) {

    }
}

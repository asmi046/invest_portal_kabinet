<?php

namespace App\Http\Controllers;

use App\Models\Algorithm;
use Illuminate\Http\Request;

class AlgorithmController extends Controller
{
    public function index() {

        $algorithm = Algorithm::all();
        $struct_algoritms = [];
        foreach ($algorithm as $item) {
            $struct_algoritms[$item->subtype][$item->group][] = $item;
        }

        // dd($struct_algoritms);
        return view('information.algoritm-info', ["algorithms" => $struct_algoritms]);
    }
}

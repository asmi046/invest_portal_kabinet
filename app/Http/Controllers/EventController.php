<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CreateDocServices;
use App\Models\UploadDocument;

class EventController extends Controller
{
    public function index() {
        return view('events');
    }

}

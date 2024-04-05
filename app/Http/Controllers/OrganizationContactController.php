<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationContact;

class OrganizationContactController extends Controller
{
    public function index() {
        $organization = OrganizationContact::all();
        return view('tc.org_list-tc', ['organization' => $organization]);
    }
}

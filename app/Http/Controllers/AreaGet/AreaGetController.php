<?php

namespace App\Http\Controllers\AreaGet;

use App\Models\AreaGet;
use Illuminate\Http\Request;
use App\Services\CreateDocServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AreaGetController extends Controller
{
    public function index() {

        $all = AreaGet::where("user_id", Auth::user()["id"] )->paginate(15);
        $to_stat = AreaGet::where("user_id", Auth::user()["id"] )->get();

        $state = config('documents')['area_get']['statuses_counter'];
        $state["Всего"] = $to_stat->count();

        foreach ($to_stat as $item) {
            $state[$item->state] += 1;
        }

        return view('area_get.all-area_get', ['areas' => $all, "state"=>$state]);
    }

    public function status(int $id) {
        $project = AreaGet::where('id', $id)->first();

        if($project == null) abort('404');

        $statuses = config('documents')['area_get']['statuses'];

        return view('area_get.statement-area_get', ['project' => $project, "statuses"=>$statuses, "time" => 10]);
    }

    public function create() {
        return view('area_get.create-area_get');
    }

    public function edit($id) {
        $ag = AreaGet::where('id', $id)->first();

        if (!$ag) abort('404');

        // dd($ag->signature);

        return view('area_get.edit-area_get', ['item' => $ag]);
    }

    public function print(CreateDocServices $document, int $id) {

        $area_get = AreaGet::where('id', $id)->first();

        $options = $area_get->getOriginal();

        $options['dey'] = date('d');
        $options['month'] = get_month(date('m'));
        $options['year'] = date('Y');

        $fn = $document->create_tmp_document(
            public_path('documents_template/area_get.docx'),
            $options,
            $id,
            'area_get',
            "Заявление на предоставление участка: ".$area_get->object_name
        );

        return response()->download($fn["url"]);
    }

    public function signe(CreateDocServices $document, int $id) {

        $area_get = AreaGet::where('id', $id)->first();

        $options = $area_get->getOriginal();
        $options['dey'] = date('d');
        $options['month'] = get_month(date('m'));
        $options['year'] = date('Y');


        $fn = $document->create_signed_document(
            public_path('documents_template/area_get.docx'),
            $options,
            $id,
            'area_get',
        );

        return redirect()->route("signe", $fn['file_id']);
    }
}

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
        $state = [
            "Всего" => $to_stat->count(),
            "Черновик" => 0,
            "Отправлен" => 0,
            "В обработке" => 0,
            "Предоставлен ответ" => 0
        ];
        foreach ($to_stat as $item) {
            $state[$item->state] += 1;
        }

        return view('area_get.all-area_get', ['areas' => $all, "state"=>$state]);
    }

    public function status(int $id) {
        $project = AreaGet::where('id', $id)->first();

        if($project == null) abort('404');

        $statuses = [
            "Черновик",
            "Отправлен",
            "В обработке",
            "Предоставлен ответ"
        ];

        return view('area_get.statement-area_get', ['project' => $project, "statuses"=>$statuses, "time" => 10]);
    }

    public function create() {
        return view('area_get.create-area_get');
    }

    public function edit($id) {
        $ag = AreaGet::where('id', $id)->first();

        if (!$ag) abort('404');

        return view('area_get.edit-area_get', ['item' => $ag]);
    }

    public function print(CreateDocServices $document, int $id) {

        $area_get = AreaGet::where('id', $id)->first();

        $options = $area_get->getOriginal();

        $options['dey'] = date('d');
        $options['month'] = date('m');
        $options['year'] = date('Y');

        $fn = $document->create_tmp_document(
            public_path('documents_template/area_get.docx'),
            $options,
            $id,
            "Заявление на предоставление земельного участка",
            "Заявление на предоставление участка: ".$area_get->object_name
        );

        return response()->download($fn["url"]);
    }

    public function signe(CreateDocServices $document, int $id) {

        $area_get = AreaGet::where('id', $id)->first();

        $options = $area_get->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/area_get.docx'),
            $options,
            $id,
            "Заявление на предоставление земельного участка",
            "Заявление на предоставление участка: ".$area_get->object_name,
            "to_signe"
        );

        return redirect()->route("signe", $fn['file_id']);
    }
}

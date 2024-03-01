<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TechnicalConnects;
use App\Services\CreateDocServices;
use Illuminate\Support\Facades\Auth;

class TechnicalConnectController extends Controller
{
    public function index() {
        $all = TechnicalConnects::where("user_id", Auth::user()["id"] )->paginate(15);
        $to_stat = TechnicalConnects::where("user_id", Auth::user()["id"] )->get();
        $state = [
            "Всего" => $to_stat->count(),
            "Черновик" => 0,
            "В обработке" => 0,
            "Предоставлен ответ" => 0
        ];
        foreach ($to_stat as $item) {
            $state[$item->state] += 1;
        }

        return view('tc.all-tc', ['tc' => $all, "state"=>$state]);
    }

    public function status(int $id) {
        $tc = TechnicalConnects::where('id', $id)->first();

        if($tc == null) abort('404');

        $statuses = [
            "Черновик",
            "Отправлен",
            "В обработке",
            "Предоставлен ответ"
        ];

        return view('tc.statement-tc', ['tc' => $tc, "statuses"=>$statuses, "time" => 10]);
    }

    public function create() {
        return view('tc.create-tc');
    }

    public function edit($id) {
        return view('tc.edit-tc');
    }

    public function algoritm() {
        return view('tc.algoritm-tc');
    }

    public function org_list() {
        return view('tc.org_list-tc');
    }

    public function print(CreateDocServices $document, int $id) {

        $tc = TechnicalConnects::where('id', $id)->first();

        $options = $project->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/invest_project_template.docx'),
            $options,
            $id,
            "Заявка на технологическое подключение",
            $tc->name
        );

        return response()->download($fn["url"]);
    }

    public function signe(CreateDocServices $document, int $id) {

        $tc = TechnicalConnects::where('id', $id)->first();

        $options = $project->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/invest_project_template.docx'),
            $options,
            $id,
            "Заявка на технологическое подключение",
            $tc->name,
            "to_signe"
        );

        return redirect()->route("signe", $fn['file_id']);
    }
}

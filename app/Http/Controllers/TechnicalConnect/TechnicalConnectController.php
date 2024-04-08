<?php

namespace App\Http\Controllers\TechnicalConnect;

use Illuminate\Http\Request;

use App\Models\TechnicalConnects;
use App\Services\CreateDocServices;
use App\Http\Controllers\Controller;
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
        $tc = TechnicalConnects::where('id', $id)->first();

        if (!$tc) abort('404');

        return view('tc.edit-tc', ['item' => $tc]);
    }

    public function print(CreateDocServices $document, int $id) {

        $tc = TechnicalConnects::where('id', $id)->first();

        $options = $tc->getOriginal();
        $options['dey'] = date('d');
        $options['month'] = get_month(date('m'));
        $options['year'] = date('Y');

        $fn = $document->create_tmp_document(
            public_path('documents_template/tc_150.docx'),
            $options,
            $id,
            "Заявка на технологическое подключение",
            $tc->name
        );

        return response()->download($fn["url"]);
    }

    public function signe(CreateDocServices $document, int $id) {

        $tc = TechnicalConnects::where('id', $id)->first();

        $options = $tc->getOriginal();
        $options['dey'] = date('d');
        $options['month'] = get_month(date('m'));
        $options['year'] = date('Y');

        $fn = $document->create_tmp_document(
            public_path('documents_template/tc_150.docx'),
            $options,
            $id,
            "Заявка на технологическое подключение",
            $tc->name,
            "to_signe"
        );

        return redirect()->route("signe", $fn['file_id']);
    }
}

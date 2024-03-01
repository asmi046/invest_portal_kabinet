<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Support;
use App\Services\CreateDocServices;
use Illuminate\Support\Facades\Auth;

class GossSupportController extends Controller
{
    public function index() {
        $all = Support::where("user_id", Auth::user()["id"] )->paginate(15);
        $to_stat = Support::where("user_id", Auth::user()["id"] )->get();
        $state = [
            "Всего" => $to_stat->count(),
            "Черновик" => 0,
            "Отправлен",
            "В обработке" => 0,
            "Предоставлен ответ" => 0
        ];
        foreach ($to_stat as $item) {
            $state[$item->state] += 1;
        }

        return view('support.all-support', ['supports' => $all, "state"=>$state]);
    }

    public function status(int $id) {
        $support = Support::where('id', $id)->first();

        if($support == null) abort('404');

        $statuses = [
            "Черновик",
            "Отправлен",
            "В обработке",
            "Предоставлен ответ"
        ];

        return view('support.statement-support', ['support' => $support, "statuses"=>$statuses, "time" => 10]);
    }

    public function create() {
        return view('support.create-support');
    }

    public function select() {
        return view('support.select-support');
    }

    public function edit($id) {
        return view('support.edit-support');
    }

    public function print(CreateDocServices $document, int $id) {

        $support = Support::where('id', $id)->first();

        $options = $support->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/gos_support_template.docx'),
            $options,
            $id,
            "Заявление на государственную поддержку",
            $support->name
        );

        return response()->download($fn["url"]);
    }

    public function signe(CreateDocServices $document, int $id) {

        $support = Support::where('id', $id)->first();

        $options = $support->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/gos_support_template.docx'),
            $options,
            $id,
            "Заявление на государственную поддержку",
            $support->name,
            "to_signe"
        );

        return redirect()->route("signe", $fn['file_id']);
    }
}

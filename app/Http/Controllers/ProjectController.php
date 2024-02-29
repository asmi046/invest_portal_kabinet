<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\CreateDocServices;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index() {
        $all = Project::where("user_id", Auth::user()["id"] )->paginate(15);
        $to_stat = Project::where("user_id", Auth::user()["id"] )->get();
        $state = [
            "Всего" => $to_stat->count(),
            "Черновик" => 0,
            "В обработке" => 0,
            "Предоставлен ответ" => 0
        ];
        foreach ($to_stat as $item) {
            $state[$item->state] += 1;
        }

        return view('projects.all-project', ['projects' => $all, "state"=>$state]);
    }

    public function status() {
        return view('projects.statement-project');
    }

    public function create() {
        return view('projects.create-project');
    }

    public function edit($id) {
        return view('projects.edit-project');
    }

    public function print(CreateDocServices $document, int $id) {

        $project = Project::where('id', $id)->first();

        $options = $project->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/invest_project_template.docx'),
            $options,
            $id,
            "Инвестиционный проект",
            $project->name
        );

        return response()->download($fn["url"]);
    }

    public function signe(CreateDocServices $document, int $id) {

        $project = Project::where('id', $id)->first();

        $options = $project->getOriginal();

        $fn = $document->create_tmp_document(
            public_path('documents_template/invest_project_template.docx'),
            $options,
            $id,
            "Инвестиционный проект",
            $project->name,
            "to_signe"
        );

        return redirect()->route("signe", $fn['file_id']);
    }
}

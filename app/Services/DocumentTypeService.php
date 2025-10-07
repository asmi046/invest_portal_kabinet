<?php
namespace App\Services;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentTypeService
{
    protected function getStagesList(string $model, DocumentType $documentType): array
    {
        $stagesList = [];

        foreach ($documentType->stages as $stage) {
            $stagesList[$stage->name] = 0;
        }
        return $stagesList;
    }

    public function getDocumentListInfo(string $model, DocumentType $documentType): array
    {
        $all = $model::where("user_id", Auth::user()["id"] )->paginate(15);
        $to_stat = $model::where("user_id", Auth::user()["id"] )->get();

        $stages = $this->getStagesList($model, $documentType);
        $stages["Всего"] = $to_stat->count();

        foreach ($to_stat as $item) {
            $stages[$item->state] += 1;
        }

        return ['all' => $all, 'stages' => $stages];
    }

    public function deleteDocument($model, $id)
    {
        $item = $model::where('id', $id)->first();
        $item->attachment()->delete();
        $item->delete();
    }

    public function createDraft(string $model, array $data)
    {
        $data["user_id"] = auth()->user()->id;
        $data["state"] = "Черновик";

        return $model::create($data);
    }

    public function saveDraft(string $model, string $request_model, Request $request, array $data, int $id)
    {
        $d_request = new $request_model();
        $request->validate($d_request->rules(), $d_request->messages());

        $data["user_id"] = auth()->user()->id;
        $data["state"] = "Черновик";
        $data["validated"] = false;


        $item = $model::where('id', $id)->first();
        if(!$item) abort('404');

        $item->update($data);

        $attachment = new AttachmentCreateServices();

        if ($request->hasFile('attachment'))
        $files = $attachment->create_attachment(
            $request->file('attachment'),
            $model,
            $item->id
        );
    }

    public function checkDraft(string $model, string $request_model, array $data, int $id)
    {
        $d_request = new $request_model();
        $data = $request->validate($d_request->rules(), $d_request->messages());

        $data["user_id"] = auth()->user()->id;
        $data["state"] = "Черновик";
        $data["validated"] = false;


        $item = $model::where('id', $id)->first();
        if(!$item) abort('404');

        $item->update([
            'validated' => true,
        ]);
    }
}

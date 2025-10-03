<?php
namespace App\Services;

use App\Models\DocumentType;
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
}

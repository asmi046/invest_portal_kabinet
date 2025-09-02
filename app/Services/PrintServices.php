<?php
namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PrintServices
{
    /**
     * @param string $modelClass Класс модели (например, 'App\\Models\\AreaGet')
     * @param int $modelId ID экземпляра модели
     * @return bool
     * @throws \Exception
     */
    public static function save(string $modelClass, int $modelId): string
    {
        if (!class_exists($modelClass)) {
            throw new \Exception("Модель {$modelClass} не найдена");
        }

        $model = $modelClass::find($modelId);
        if (!$model) {
            throw new \Exception("Экземпляр модели с ID {$modelId} не найден");
        }

        if (!method_exists($model, 'print')) {
            throw new \Exception("У модели {$modelClass} отсутствует метод print");
        }

        return $model->print();
    }
}

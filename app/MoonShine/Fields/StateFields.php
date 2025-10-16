<?php

namespace App\MoonShine\Fields;

use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;


class StateFields
{
    public static function make(): array
    {
        return [
            Switcher::make('Проверен', 'validated'),
            Switcher::make('Можно редактировать', 'editable'),
            Select::make('Статус документа', 'state')
                ->options([
                    'Черновик' => 'Черновик',
                    'На рассмотрении' => 'На рассмотрении',
                    'Требуется доработка' => 'Требуется доработка',
                    'Утвержден порядок контроля и приемки' => 'Утвержден порядок контроля и приемки'
            ])
            ->default('Черновик'),
        ];
    }
}

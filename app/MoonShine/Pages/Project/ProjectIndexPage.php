<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Project;

use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class ProjectIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            Text::make("Наименование", 'name'),
            Text::make("Пользователь", 'user.name'),
            Select::make("Статус", 'state')->options([
                'В обработке' => 'В обработке',
                'Отправлен' => 'Отправлен',
                'Предоставлен ответ' => 'Предоставлен ответ',
                'Отправлен' => 'Отправлен',
                'Черновик' => 'Черновик',
            ]),
        ];
    }

    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\AreaGet;

use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Phone;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class AreaGetIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            ID::make(),
            Text::make("Пользователь", 'User.name', fn($item) => $item->user->name." ".$item->user->lastname ." ". $item->user->fathername),
            Text::make("Заявитель", "name"),
            Text::make("Организация", "organization"),
            Phone::make("Телефон", "phone"),
            Text::make("Участок", "object_name"),
            Text::make("Тип участка", "object_type"),
            Text::make("Статус", "state"),
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

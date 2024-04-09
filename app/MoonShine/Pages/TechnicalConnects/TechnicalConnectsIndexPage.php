<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TechnicalConnects;

use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Pages\Crud\IndexPage;

class TechnicalConnectsIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            Text::make("Пользователь", 'User.name', fn($item) => $item->user->name." ".$item->user->lastname ." ". $item->user->fathername),
            Text::make("Заявитель", "name"),
            Text::make("Организация", "organization"),
            Phone::make("Телефон", "phone"),

            Text::make("Мощьность прис. устройств", "pover_pris_devices"),
            Text::make("Устройства", "ustroistvo"),

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

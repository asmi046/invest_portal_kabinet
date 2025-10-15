<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TechnicalConnects;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Preview;
use MoonShine\Laravel\Pages\Crud\IndexPage;

class TechnicalConnectsIndexPage extends IndexPage
{
    public function fields(): array
    {
        return [
            // Text::make("Пользователь", 'User.name', fn($item) => $item->user->name." ".$item->user->lastname ." ". $item->user->fathername),
            Text::make("Заявитель", "name"),
            Text::make("Организация", "organization"),
            Phone::make("Телефон", "phone"),

            Text::make("Мощность прис. устройств", "pover_pris_devices"),
            Text::make("Устройства", "ustroistvo"),


            Preview::make("Проверено корпорацией развитие", "corporation_check")->boolean(),
            Preview::make("Проверено ресурсной организацией", "resource_check")->boolean(),
            Preview::make("Статус", "state")->badge(
                function ($state, Field $field) {
                    if ($state === "Черновик") return 'gray';
                    if ($state === "Отправлен") return 'yellow';
                    if ($state === "В обработке") return 'blue';
                    if ($state === "Предоставлен ответ") return 'green';
                })
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

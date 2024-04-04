<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\AreaGet;

use MoonShine\Fields\Date;
use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Select;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Decorations\LineBreak;

class AreaGetFormPage extends FormPage
{
    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make('Пользователь оформивший заявление', [
                        Text::make("Фамилия", 'User.lastname')->disabled(),
                        Text::make("Имя", 'User.name')->disabled(),
                        Text::make("Отчество", 'User.fathername')->disabled(),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Block::make('Данные заявителя', [
                        Text::make("Заявитель", "name"),
                        Text::make("Организация", "organization"),
                        Text::make("Должность", "dolgnost"),
                        Phone::make("Телефон", "phone"),
                    ]),
                ])->columnSpan(6)
            ]),

            LineBreak::make(),

            Grid::make([
                Column::make([
                    Block::make('Данные Участка', [
                        Text::make("Участок", "object_name"),
                        Text::make("Тип участка", "object_type"),
                    ])
                ])->columnSpan(6),

                Column::make([
                    Block::make('Заявление', [
                        Date::make('Создано', 'created_at')->disabled()->withTime()->format('d.m.Y'),
                        Select::make('Статус', 'state')
                        ->options([
                            "Черновик" => "Черновик",
                            "Отправлен" => "Отправлен",
                            "В обработке" => "В обработке",
                            "Предоставлен ответ" => "Предоставлен ответ"
                        ])
                    ])
                ])->columnSpan(6)
            ])




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

<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\AreaGet;

use MoonShine\UI\Fields\Url;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\LineBreak;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use App\MoonShine\Resources\AttachmentResource;
use App\MoonShine\Resources\SignedDocumentResource;

class AreaGetFormPage extends FormPage
{
    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Box::make('Пользователь оформивший заявление', [
                        Text::make("Фамилия", 'User.lastname')->disabled(),
                        Text::make("Имя", 'User.name')->disabled(),
                        Text::make("Отчество", 'User.fathername')->disabled(),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Box::make('Данные заявителя', [
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
                    Box::make('Данные Участка', [
                        Text::make("Участок", "object_name"),
                        Text::make("Тип участка", "object_type"),
                    ])
                ])->columnSpan(6),

                Column::make([
                    Box::make('Заявление', [
                        Date::make('Создано', 'created_at')->disabled()->withTime()->format('d.m.Y'),

                    ])
                ])->columnSpan(6)
            ]),

            LineBreak::make(),

            Box::make('Официальный ответ', [
                Select::make('Статус', 'state')
                        ->options([
                            "Черновик" => "Черновик",
                            "Отправлен" => "Отправлен",
                            "Подписан и отправлен" => "Подписан и отправлен",
                            "В обработке" => "В обработке",
                            "Предоставлен ответ" => "Предоставлен ответ"
                        ]),
                TinyMce::make('Напишите сообщение полльзователю', 'report')
            ]),

            LineBreak::make(),


            HasMany::make("Вложения", "attachment", resource: AttachmentResource::class),
            HasOne::make("Подпись", "signature", resource: SignedDocumentResource::class)



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

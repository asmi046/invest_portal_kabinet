<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\AreaGet;

use MoonShine\UI\Fields\Url;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Text;
use App\Models\GoskeyRegistry;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use App\MoonShine\Fields\StateFields;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Layout\Box;
use App\MoonShine\Fields\RelationFields;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\LineBreak;
use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;

class AreaGetFormPage extends FormPage
{
    public function fields(): array
    {
        return [
            Box::make('Основные данные', [
            Select::make('Тип документа', 'document_type')
                        ->options([
                            1 => 'Заявление на выделение земельного участка',
                        ])
                    ->default(1)
                    ->disabled(),
                    ...StateFields::make(),
            ]),


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


            ...RelationFields::make(),




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

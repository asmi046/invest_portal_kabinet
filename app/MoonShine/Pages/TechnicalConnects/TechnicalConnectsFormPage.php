<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TechnicalConnects;

use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Phone;
use MoonShine\Decorations\Grid;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\Decorations\Column;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Decorations\LineBreak;
use App\MoonShine\Fields\StateFields;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Tabs\Tab;
use App\MoonShine\Fields\RelationFields;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Laravel\Pages\Crud\FormPage;
use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;

class TechnicalConnectsFormPage extends FormPage
{
    public function fields(): array
    {
        return [



            Tabs::make([
                Tab::make('Основные данные', [

                    Select::make('Тип документа', 'document_type')
                        ->options([
                            3 => 'Заявление на технологическое присоединение к электрическим сетям',
                        ])
                    ->default(3)
                    ->disabled(),
                    ...StateFields::make(),
                ]),
                Tab::make('Данные заявителя', [
                    Text::make("Заявитель", "name")->required(),
                    Text::make("Организация", "organization")->required(),
                    Text::make("Должность", "dolgnost")->required(),
                    Text::make("Адрес", "adress")->required(),
                    Phone::make("Телефон", "phone")->required(),
                    Text::make("Вид экономической деятельности", "okved")->required(),
                ]),

                Tab::make('Описание проекта', [
                    Text::make("Наименование проекта", "project_name"),
                    Text::make("Кадастровый номер", "cadastr_number"),
                    Text::make("Координаты объекта", "geo"),
                    Text::make("Место нахождения объекта", "object_place_name"),

                    Select::make('Категория надежности', 'safety_category')
                    ->options([
                        "Первая" => "Первая",
                        "Вторая" => "Вторая",
                        "Третья" => "Третья",

                    ])->required(),
                    Number::make("Количество точек подключения", "point_count")->required(),

                    Text::make("Основание для присоединения", "osnovanie")->required(),
                ]),



                Tab::make('Устройства и мощности', [
                    Text::make("Наименование энергопринимающих устройств", "ustroistvo")->required(),
                    Text::make("Место нахождения энергопринимающих устройств", "raspologeie")->required(),


                        Flex::make([
                            Text::make("Максимальная мощность энергопринимающих устройств", "pover_prin_devices")->required(),
                            Text::make("При напряжении", "napr_prin_devices")->required(),
                        ]),

                        Flex::make([
                            Text::make("Максимальная мощность присоединяемых энергопринимающих устройств", "pover_pris_devices")->required(),
                            Text::make("При напряжении", "napr_pris_devices")->required(),
                        ]),

                        Flex::make([
                            Text::make("Максимальная мощность ранее присоединенных в данной точке", "pover_pris_r_devices"),
                            Text::make("При напряжении", "napr_pris_r_devices"),
                        ]),

                ]),

                Tab::make('Проверка и статусы', [
                    Switcher::make('Проверено АО «Корпорацией развития Курской области»', 'corporation_check')->disabled(fn() => auth()->user()->moonshine_user_role_id == 3),
                    Switcher::make('Проверено «Россети - Центр» - «Курскэнерго»', 'resource_check'),
                    Select::make('Статус', 'state')
                    ->options([
                        "Черновик" => "Черновик",
                        "Отправлен" => "Отправлен",
                        "В обработке" => "В обработке",
                        "Предоставлен ответ" => "Предоставлен ответ"
                    ])->disabled(fn() => auth()->user()->moonshine_user_role_id == 3),
                    TinyMce::make('Официальный ответ', 'report')
                ]),

                Tab::make('Пользователь в системе', [
                    Text::make("Фамилия", 'User.lastname')->disabled(),
                    Text::make("Имя", 'User.name')->disabled(),
                    Text::make("Отчество", 'User.fathername')->disabled(),
                ]),

                Tab::make('Прикрепленные файлы', [
                    File::make('План расположения энергопринимающих устройств', 'plan_raspologenia')
                        ->dir('tc_doc')->disk('public'),

                    File::make('Документ подтверждающий право собственности на объект или иное предусмотренное законом основание', 'pravo_sobstv')
                        ->dir('tc_doc')->disk('public'),

                    File::make('Перечень и мощьность энерго принимающих устройств присоединенных к устройствам противоаварийной автоматики', 'perechen')
                        ->dir('tc_doc')->disk('public'),
                ]),
            ]),

            // Block::make('Этапы строительства', [
            //     Json::make('Описание этапы строительства', 'etaps')->fields([
            //         Position::make(),
            //         Text::make('Этап (очередь) строительства', 'et'),
            //         Text::make('Планируемый срок проектирования энергопринимающих устройств (месяц, год)', 'pproject'),
            //         Text::make('Планируемый срок введения энергопринимающих устройств в эксплуатацию (месяц, год)', 'pexpl'),
            //         Text::make('Максимальная мощность энергопринимающих устройств (кВт)', 'maxp'),
            //         Text::make('Категория надежности энергопринимающих устройств', 'cat'),
            //     ])
            // ]),



                Textarea::make('Описание вложений', 'prilogenie'),
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

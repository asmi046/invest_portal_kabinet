<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TechnicalConnects;

use MoonShine\Fields\File;
use MoonShine\Fields\Json;

use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Tab;
use MoonShine\Fields\Position;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Textarea;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Relationships\HasMany;
use App\MoonShine\Resources\AttachmentResource;
use App\MoonShine\Resources\SignedDocumentResource;

class TechnicalConnectsFormPage extends FormPage
{
    public function fields(): array
    {
        return [

            Tabs::make([
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

                    Block::make('Показатели мощности', [
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
                    TinyMce::make('Официальный ответ', 'report')->when(fn() => auth()->user()->moonshine_user_role_id == 3)
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


            Block::make('Приложения к заявлению', [
                Textarea::make('Описание вложений', 'prilogenie'),
                HasMany::make("Вложения", "attachment", resource: new AttachmentResource()),
            ])

            // HasOne::make("Подпись", "signature", resource: new SignedDocumentResource())
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

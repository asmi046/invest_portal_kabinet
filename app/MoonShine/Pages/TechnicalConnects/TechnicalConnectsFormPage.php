<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\TechnicalConnects;

use MoonShine\Fields\Json;
use MoonShine\Fields\Text;

use MoonShine\Fields\Phone;
use MoonShine\Fields\Select;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Position;
use MoonShine\Fields\Textarea;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
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
            Grid::make([
                Column::make([
                    Block::make('Пользователь оформивший заявление', [
                        Text::make("Фамилия", 'User.lastname')->disabled(),
                        Text::make("Имя", 'User.name')->disabled(),
                        Text::make("Отчество", 'User.fathername')->disabled(),
                    ]),

                    Block::make('Паспортные данные заявителя', [
                        Text::make("Серия паспорта", 'pasport_seria'),
                        Text::make("Номер паспорта", 'pasport_number'),
                        Text::make("Кем выдан паспорт", 'pasport_vidan'),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Block::make('Данные заявителя', [
                        Text::make("Заявитель", "name"),
                        Text::make("Организация", "organization"),
                        Text::make("Должность", "dolgnost"),
                        Text::make("Адрес", "adress"),
                        Phone::make("Телефон", "phone"),
                        Text::make("Вид экономической деятельности", "okved"),
                    ]),
                ])->columnSpan(6)
            ]),

            LineBreak::make(),

            Grid::make([
                Column::make([
                    Block::make('Основные данные по заявлению', [
                        Text::make("Основание для присоединения", "osnovanie"),
                        Text::make("Гарантирующий поставщик", "gen_postavhik"),
                        Text::make("Порядок расчета и условия рассрочки внесения платы", "rashet_plati"),
                        Textarea::make('Описание вложений', 'prilogenie'),
                    ]),


                ])->columnSpan(6),

                Column::make([
                    Block::make('Устройство', [
                        Text::make("Наименование энергопринимающих устройств", "ustroistvo"),
                        Text::make("Место нахождения энергопринимающих устройств", "raspologeie"),
                    ]),
                    LineBreak::make(),

                ])->columnSpan(6)
            ]),

            LineBreak::make(),

            Block::make('Показатели мощьности', [
                Flex::make([
                    Text::make("Максимальная мощность энергопринимающих устройств", "pover_prin_devices"),
                    Text::make("При напряжении", "napr_prin_devices"),
                ]),

                Flex::make([
                    Text::make("Максимальная мощность присоединяемых энергопринимающих устройств", "pover_pris_devices"),
                    Text::make("При напряжении", "napr_pris_devices"),
                ]),

                Flex::make([
                    Text::make("Максимальная мощность ранее присоединенных в данной точке", "pover_pris_r_devices"),
                    Text::make("При напряжении", "napr_pris_r_devices"),
                ]),
            ]),

            Block::make('Этапы строительства', [
                Json::make('Описание этапы строительства', 'report')->fields([
                    Position::make(),
                    Text::make('Этап (очередь) строительства', 'et'),
                    Text::make('Планируемый срок проектирования энергопринимающих устройств (месяц, год)', 'pproject'),
                    Text::make('Планируемый срок введения энергопринимающих устройств в эксплуатацию (месяц, год)', 'pexpl'),
                    Text::make('Максимальная мощность энергопринимающих устройств (кВт)', 'maxp'),
                    Text::make('Категория надежности энергопринимающих устройств', 'cat'),
                ])
            ]),

            Block::make('Официальный ответ', [
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


            HasMany::make("Вложения", "attachment", resource: new AttachmentResource()),

            HasOne::make("Подпись", "signature", resource: new SignedDocumentResource())
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

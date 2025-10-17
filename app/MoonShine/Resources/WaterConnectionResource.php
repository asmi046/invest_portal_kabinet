<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;


use MoonShine\UI\Fields\ID;

use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
use App\Models\WaterConnection;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Laravel\Enums\Action;
use App\MoonShine\Fields\StateFields;
use MoonShine\UI\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use App\MoonShine\Fields\RelationFields;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Traits\FiltersByUserRole;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use Illuminate\Contracts\Database\Eloquent\Builder;


/**
 * @extends ModelResource<WaterConnection>
 */
class WaterConnectionResource extends ModelResource
{

    use FiltersByUserRole;

    protected string $model = WaterConnection::class;

    protected string $title = 'Заявление на техническое присоединение к объектам водоснабжения и водоотведения';

    protected string $column = 'id';

    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::VIEW, Action::DELETE, Action::CREATE);
    }



    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Заявитель', 'applicant_name'),
            Text::make('Объект', 'object_name'),
            Text::make('Статус', 'state'),
        ];
    }


    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Tabs::make([
                Tab::make('Основные данные', [

                    Select::make('Тип документа', 'document_type')
                        ->options([
                            10 => 'Заявление на техническое присоединение к объектам водоснабжения и водоотведения',
                        ])
                    ->default(10)
                    ->disabled(),
                    ...StateFields::make(),

                    Text::make('Поставщик услуг', 'supplier_org'),
                ]),
                Tab::make('Данные заявителя', [
                    Text::make('Заявитель', 'applicant_name'),
                    Text::make('Адрес', 'address'),
                    Phone::make('Телефон', 'phone'),
                    Email::make('Email', 'email'),
                ]),
                Tab::make('Объект', [
                    Text::make('Наименование объекта', 'object_name'),
                    Text::make('Адрес объекта', 'object_address'),
                    Textarea::make('Описание объекта', 'object_description'),
                ]),
                Tab::make('Нагрузка на водоснабжение', [
                    Number::make('Общая нагрузка на водоснабжение, м3/сут', 'payload_all_snab')->step(0.01),
                    Number::make('Нагрузка на хозяйственные нужды на водоснабжение, м3/сут', 'payload_hoz_snab')->step(0.01),
                    Number::make('Нагрузка на производственные нужды на водоснабжение, м3/сут', 'payload_prom_snab')->step(0.01),
                    Number::make('Нагрузка на пожарные нужды на водоснабжение, л/сек', 'payload_fire_snab')->step(0.01),
                ]),
                Tab::make('Нагрузка на водоотведение', [
                    Number::make('Общая нагрузка на водоотведение, м3/час', 'payload_all_ot')->step(0.01),
                    Number::make('Нагрузка на хозяйственные нужды на водоотведение, м3/час', 'payload_hoz_ot')->step(0.01),
                    Number::make('Нагрузка на производственные нужды , м3/час', 'payload_prom_ot')->step(0.01),
                    Number::make('Нагрузка на пожарные нужды на водоотведение, л/сек', 'payload_fire_ot')->step(0.01),
                ]),
            ]),

            ...RelationFields::make(),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [];
    }

    /**
     * @param WaterConnection $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            // Организация/заявитель (основные сведения)
            'supplier_org' => ['required', 'string', 'max:256'],
            'applicant_name' => ['required', 'string', 'max:256'],
            'address' => ['required', 'string', 'max:256'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],

            // Заявление
            'object_name' => ['required', 'string', 'max:256'],
            'object_address' => ['required', 'string', 'max:256'],
            'object_description' => ['required', 'string'],

            // Нагрузки (все обязательные числовые поля)
            'payload_all_snab' => ['required', 'numeric', 'min:0'],
            'payload_all_ot' => ['required', 'numeric', 'min:0'],
            'payload_hoz_snab' => ['required', 'numeric', 'min:0'],
            'payload_hoz_ot' => ['required', 'numeric', 'min:0'],
            'payload_prom_snab' => ['required', 'numeric', 'min:0'],
            'payload_prom_ot' => ['required', 'numeric', 'min:0'],
            'payload_fire_snab' => ['required', 'numeric', 'min:0'],
            'payload_fire_ot' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function filters(): iterable
    {
        return [
            Text::make('Объект', 'object_name'),
            Text::make('Заявитель', 'applicant_name'),
            Phone::make('Телефон', 'phone'),
            Text::make('Статус', 'state'),
        ];
    }
}

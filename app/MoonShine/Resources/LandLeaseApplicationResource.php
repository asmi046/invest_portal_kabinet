<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\Support\ListOf;

use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Laravel\Enums\Action;
use App\Models\LandLeaseApplication;
use MoonShine\UI\Filters\TextFilter;
use App\MoonShine\Fields\StateFields;
use MoonShine\UI\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use App\MoonShine\Fields\RelationFields;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;

/**
 * @extends ModelResource<LandLeaseApplication>
 */
class LandLeaseApplicationResource extends ModelResource
{
    protected string $model = LandLeaseApplication::class;

    protected string $title = 'Заявление на приобретение земельного участка, находящегося в государственной собственности';

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
            Text::make('Кадастровый номер земельного участка', 'land_cadastral_number'),
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
                            5 => 'Заявление на приобретение земельного участка в аренду',
                        ])
                    ->default(5)
                    ->disabled(),
                    Text::make('Организация', 'supplier_org'),
                    ...StateFields::make(),
                ]),

                Tab::make('Данные заявителя', [
                    Text::make('Заявитель', 'applicant_name'),
                    Text::make('ОГРН / ОГРНИП', 'applicant_ogrn'),
                    Text::make('ИНН', 'applicant_inn'),
                    Text::make('Адрес заявителя', 'applicant_address'),
                ]),

                Tab::make('Представитель', [
                    Text::make('ФИО представителя', 'person'),
                    Text::make('Наименование и реквизиты документа, подтверждающего полномочия представителя заявителя', 'person_dover'),
                ]),

                Tab::make('Контактные данные', [
                    Phone::make('Телефон', 'phone'),
                    Email::make('Email', 'email'),
                    Text::make('Почтовый адрес', 'post_address'),
                ]),

                Tab::make('Земельный участок', [
                    Text::make('Кадастровый номер земельного участка', 'land_cadastral_number'),
                    Number::make('Площадь земельного участка (кв.м)', 'area')->step(0.01),
                    Text::make('Срок аренды земельного участка', 'lease_term'),
                    Text::make('Ориентиры земельного участка', 'landmarks'),
                    Textarea::make('Цель использования земельного участка', 'purpose'),
                ]),

                Tab::make('Основания и реквизиты', [
                    Textarea::make('Основание предоставления земельного участка без проведения торгов', 'basis'),
                    Text::make('Реквизиты решения о предварительном согласовании предоставления земельного участка', 'req_dock'),
                    Text::make('Реквизиты решения об утверждении документа территориального планирования и (или) проекта планировки территории', 'req_dock_plan'),
                    Text::make('Реквизиты решения об изъятии земельного участка для государственных или муниципальных нужд', 'req_dock_iz'),
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

    protected function filters(): iterable
    {
        return [
            Text::make('Кадастровый номер земельного участка', 'land_cadastral_number'),
            Text::make('Ориентиры земельного участка', 'landmarks'),
        ];
    }

    /**
     * @param LandLeaseApplication $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'phone' => ['required', 'string', 'max:20'],
            'post_address' => ['required', 'string', 'max:500'],
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'area' => ['required', 'numeric', 'gt:0'],
            'lease_term' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string'],
            'basis' => ['required', 'string'],
        ];
    }
}

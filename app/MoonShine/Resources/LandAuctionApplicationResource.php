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
use MoonShine\UI\Filters\TextFilter;
use App\MoonShine\Fields\StateFields;
use MoonShine\UI\Components\Tabs\Tab;
use App\Models\LandAuctionApplication;
use Illuminate\Database\Eloquent\Model;
use MoonShine\UI\Components\Layout\Box;
use App\MoonShine\Fields\RelationFields;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Components\ActionButton;
use App\MoonShine\Traits\FiltersByUserRole;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;

/**
 * @extends ModelResource<LandAuctionApplication>
 */
class LandAuctionApplicationResource extends ModelResource
{
    use FiltersByUserRole;

    protected string $model = LandAuctionApplication::class;

    protected string $title = 'Заявление о проведении аукциона по продаже земельного участка';

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
                            6 => 'Заявление о проведении аукциона по продаже земельного участка',
                        ])
                    ->default(6)
                    ->disabled(),
                    ...StateFields::make(),
                    Text::make('Организация', 'supplier_org'),
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
                    Text::make('Ориентиры земельного участка', 'landmarks'),
                    Number::make('Площадь земельного участка (кв.м)', 'area')->step(0.01),
                    Textarea::make('Цель использования земельного участка', 'purpose'),
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
            Text::make('Заявитель', 'applicant_name'),
            Text::make('Кадастровый номер земельного участка', 'land_cadastral_number'),
            Text::make('Цель использования земельного участка', 'purpose'),
        ];
    }

    /**
     * @param LandAuctionApplication $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'supplier_org' => ['nullable', 'string', 'max:255'],
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'phone' => ['required', 'string', 'max:20'],
            'post_address' => ['required', 'string', 'max:500'],
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'area' => ['required', 'numeric', 'gt:0'],
            'purpose' => ['required', 'string'],
        ];
    }
}

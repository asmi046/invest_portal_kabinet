<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\Support\ListOf;

use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use App\Models\ConstructionPermit;
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
use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;

/**
 * @extends ModelResource<ConstructionPermit>
 */
class ConstructionPermitResource extends ModelResource
{
    use FiltersByUserRole;

    protected string $model = ConstructionPermit::class;

    protected string $title = 'Получить разрешение на строительство в рамках реализации инвестиционного проекта';

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
            Textarea::make('Наименование объекта', 'object_name'),
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
                            7 => 'Получить разрешение на строительство',
                        ])
                    ->default(7)
                    ->disabled(),
                    ...StateFields::make(),

                    Text::make('Организация', 'supplier_org'),
                ]),

                Tab::make('Сведения о физическом лице', [
                    Text::make('Заявитель', 'applicant_name'),
                    Text::make('Паспортные данные', 'applicant_passport_data'),
                    Text::make('ОГРН / ОГРНИП', 'applicant_ogrn'),
                    Text::make('ИНН', 'applicant_inn'),
                ]),

                Tab::make('Сведения о юр. лице', [
                    Text::make('Заявитель (ЮЛ)', 'applicant_company_name'),
                    Text::make('Паспортные данные (ЮЛ)', 'applicant_company_passport_data'),
                    Text::make('ОГРН / ОГРНИП (ЮЛ)', 'applicant_company_ogrn'),
                    Text::make('ИНН (ЮЛ)', 'applicant_company_inn'),
                ]),

                Tab::make('Сведения о представителе', [
                    Text::make('Заявитель (Представитель)', 'applicant_predst_name'),
                    Text::make('Паспортные данные (Представитель)', 'applicant_predst_passport_data'),
                    Text::make('ОГРН / ОГРНИП (Представитель)', 'applicant_predst_ogrn'),
                    Text::make('ИНН (Представитель)', 'applicant_predst_inn'),
                    Text::make('Доверенность', 'rep_doc_issued_at'),
                ]),

                Tab::make('Сведения об объекте', [
                    Textarea::make('Наименование объекта', 'object_name'),
                    Text::make('Кадастровый номер объекта', 'object_cadastral_number'),
                ]),

                Tab::make('Сведения о земельном участке', [
                    Text::make('Кадастровый номер земельного участка', 'land_cadastral_number'),
                    Text::make('Реквизиты утвержденного проекта межевания территории', 'land_docs'),
                ]),

                Tab::make('Строительство объекта на основании документов', [
                    Text::make('Наименование документа', 'doc_name'),
                    Text::make('Номер документа', 'doc_number'),
                    Date::make('Дата документа', 'doc_date'),
                ]),

                Tab::make('Контактные данные', [
                    Phone::make('Телефон', 'phone'),
                    Email::make('Email', 'email'),
                    Textarea::make('Описание вложений', 'attention_details'),
                ]),

                Tab::make('Результат предоставления услуги', [
                    Select::make('Способ предоставления результата', 'send_result_type')
                        ->options([
                            'Направить на ГосУслуги' => 'Направить на ГосУслуги',
                            'Предоставление в коммитете или МФЦ' => 'Предоставление в коммитете или МФЦ',
                        ]),
                    Text::make('Предоставление в коммитете или МФЦ', 'send_mfc_adress'),
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
            Textarea::make('Наименование объекта', 'object_name'),
            Text::make('Заявитель', 'applicant_name'),
            Text::make('Кадастровый номер объекта', 'object_cadastral_number'),
            Phone::make('Телефон', 'phone'),
        ];
    }

    /**
     * @param ConstructionPermit $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            // Организация
            'supplier_org' => ['nullable', 'string', 'max:255'],

            // Сведения о физическом лице
            'applicant_name' => ['required_without_all:applicant_company_name', 'nullable', 'string', 'max:256'],
            'applicant_passport_data' => ['required_without_all:applicant_company_name', 'nullable', 'string', 'max:556'],
            'applicant_ogrn' => ['required_without_all:applicant_company_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_inn' => ['required_without_all:applicant_company_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],

            // Сведения о юр. лице
            'applicant_company_name' => ['required_without_all:applicant_name', 'nullable', 'string', 'max:256'],
            'applicant_company_passport_data' => ['required_without_all:applicant_name', 'nullable', 'string', 'max:556'],
            'applicant_company_ogrn' => ['required_without_all:applicant_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_company_inn' => ['required_without_all:applicant_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],


            // Сведения о представителе
            'applicant_predst_name' => ['nullable', 'string', 'max:256'],
            'applicant_predst_passport_data' => ['nullable', 'string', 'max:556'],
            'applicant_predst_ogrn' => ['nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_predst_inn' => ['nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'rep_doc_issued_at' => ['nullable', 'date'],

            // Сведения об объекте
            'object_name' => ['required', 'string'],
            'object_cadastral_number' => ['required', 'string', 'max:256'],

            // Сведения о земельном участке
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'land_docs' => ['required', 'string'],

            // Строительство объекта на основании документов
            'doc_name' => ['required', 'string', 'max:556'],
            'doc_number' => ['nullable', 'string', 'max:256'],
            'doc_date' => ['nullable', 'date'],

            // Контактные данные
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'attention_details' => ['nullable', 'string'],

            // Результат предоставления услуги
            'send_result_type' => ['nullable', 'string', 'max:550'],
            'send_mfc_adress' => ['nullable', 'string', 'max:550'],
        ];
    }
}

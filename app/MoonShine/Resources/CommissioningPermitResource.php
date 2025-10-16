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
use App\Models\CommissioningPermit;
use MoonShine\Laravel\Enums\Action;
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
 * @extends ModelResource<CommissioningPermit>
 */
class CommissioningPermitResource extends ModelResource
{
    protected string $model = CommissioningPermit::class;

    protected string $title = 'Заявление о выдаче разрешения на ввод объекта в эксплуатацию';

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
            Text::make('Наименование заявителя', 'applicant_name'),
            Textarea::make('Наименование объекта капитального строительства (этапа)в соответствии с проектной документацией', 'object_name'),
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
                            11 => 'Заявление о выдаче разрешения на ввод объекта в эксплуатацию',
                        ])
                    ->default(11)
                    ->disabled(),
                    ...StateFields::make(),
                    Text::make('Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти', 'supplier_org'),

                ]),

                Tab::make('Сведения о заявителе', [
                    Select::make('Тип заявителя', 'applicant_type')
                        ->options([
                            'Физическое лицо' => 'Физическое лицо',
                            'Юридическое лицо' => 'Юридическое лицо',
                        ]),
                    Text::make('Наименование заявителя', 'applicant_name'),
                    Text::make('ОГРН / ОГРНИП', 'applicant_ogrn'),
                    Text::make('ИНН', 'applicant_inn'),
                    Text::make('Паспортные данные', 'applicant_passport_data'),
                ]),

                Tab::make('Сведения об объекте', [
                    Textarea::make('Наименование объекта капитального строительства (этапа)в соответствии с проектной документацией', 'object_name'),
                    Textarea::make('Адрес (местоположение) объекта', 'object_address'),
                    Text::make('Кадастровый номер земельного участка', 'land_cadastral_number'),
                ]),

                Tab::make('Разрешение на строительство', [
                    Text::make('Орган выдачи разрешения', 'permit_authority'),
                    Text::make('Номер разрешения', 'permit_number'),
                    Date::make('Дата выдачи разрешения', 'permit_date'),
                ]),

                Tab::make('Ранее выданные разрешения', [
                    Text::make('Орган выдачи ранее выданного разрешения', 'previous_permit_authority'),
                    Text::make('Номер ранее выданного разрешения', 'previous_permit_number'),
                    Date::make('Дата выдачи ранее выданного разрешения', 'previous_permit_date'),
                ]),

                Tab::make('Ввод объекта на основании документов', [
                    Text::make('Наименование документа', 'doc_name'),
                    Text::make('Номер документа', 'doc_number'),
                    Date::make('Дата документа', 'doc_date'),
                ]),

                Tab::make('Контактные данные', [
                    Phone::make('Телефон', 'phone'),
                    Email::make('Email', 'email'),
                ]),

                Tab::make('Результат предоставления услуги', [
                    Select::make('Способ предоставления результата', 'send_result_type')
                        ->options([
                            'Направить на ГосУслуги' => 'Направить на ГосУслуги',
                            'Предоставление в коммитете или МФЦ' => 'Предоставление в коммитете или МФЦ',
                            'Отправить на почтовый адрес' => 'Отправить на почтовый адрес',
                        ]),
                    Text::make('Предоставление в коммитете или МФЦ', 'send_mfc_adress'),
                    Text::make('Отправить на почтовый адрес', 'send_post_adress'),
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
            Text::make('Наименование объекта капитального строительства (этапа)в соответствии с проектной документацией', 'object_name'),
            Text::make('Наименование заявителя', 'applicant_name'),
        ];
    }

    /**
     * @param CommissioningPermit $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'document_type' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'applicant_type' => ['required', 'string', 'max:256'],
            'send_result_type' => ['required', 'string', 'max:550'],

            // Дополнительные правила для необязательных полей
            'supplier_org' => ['nullable', 'string', 'max:500'],
            'applicant_name' => ['nullable', 'string', 'max:256'],
            'applicant_ogrn' => ['nullable', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['nullable', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_passport_data' => ['nullable', 'string', 'max:556'],
            'object_name' => ['nullable', 'string'],
            'object_address' => ['nullable', 'string'],
            'land_cadastral_number' => ['nullable', 'string', 'max:256'],
            'permit_authority' => ['nullable', 'string', 'max:256'],
            'permit_number' => ['nullable', 'string', 'max:256'],
            'permit_date' => ['nullable', 'date'],
            'previous_permit_authority' => ['nullable', 'string', 'max:256'],
            'previous_permit_number' => ['nullable', 'string', 'max:256'],
            'previous_permit_date' => ['nullable', 'date'],
            'doc_name' => ['nullable', 'string', 'max:556'],
            'doc_number' => ['nullable', 'string', 'max:256'],
            'doc_date' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'send_mfc_adress' => ['nullable', 'string', 'max:550'],
            'send_post_adress' => ['nullable', 'string', 'max:550'],
        ];
    }
}

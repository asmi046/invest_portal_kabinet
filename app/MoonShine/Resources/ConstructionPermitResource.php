<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConstructionPermit;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;
use App\MoonShine\Resources\AttachmentResource;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Support\ListOf;
use MoonShine\Laravel\Enums\Action;

/**
 * @extends ModelResource<ConstructionPermit>
 */
class ConstructionPermitResource extends ModelResource
{
    protected string $model = ConstructionPermit::class;

    protected string $title = 'Получить разрешение на строительство в рамках реализации инвестиционного проекта';

    protected string $column = 'id';

    protected function activeActions(): ListOf
    {
        return parent::activeActions()->except(Action::VIEW);
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
                    Text::make('Организация', 'supplier_org'),
                    Select::make('Статус документа', 'state')
                        ->options([
                            'Черновик' => 'Черновик',
                            'Отправлен' => 'Отправлен',
                            'В обработке' => 'В обработке',
                            'Предоставлен ответ' => 'Предоставлен ответ'
                        ]),
                    Switcher::make('Проверен', 'validated'),
                    Switcher::make('Можно редактировать', 'editable'),
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

            HasMany::make("Вложения", "attachment", resource: AttachmentResource::class),
            MorphMany::make(
                'Подпись (Госключ)',
                'goskeyRegistries',
                resource: GoskeyRegistryResource::class
            ),
            HasOne::make("Подпись (плагин)", "signature", resource: SignedDocumentResource::class)
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
            'document_type' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'send_result_type' => ['required', 'string', 'max:550'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use App\Models\GasConnection;

use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
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
use App\MoonShine\Resources\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use App\MoonShine\Resources\GoskeyRegistryResource;
use App\MoonShine\Resources\SignedDocumentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;

/**
 * @extends ModelResource<GasConnection>
 */
class GasConnectionResource extends ModelResource
{
    use FiltersByUserRole;

    protected string $model = GasConnection::class;

    protected string $title = 'Заявление на техническое присоединение к объектам газораспределения';

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
            Text::make('Наименование объекта', 'object_name'),
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
                            8 => 'Заявление на техническое присоединение к объектам газораспределения',
                        ])
                    ->default(8)
                    ->disabled(),
                    ...StateFields::make(),
                ]),

                Tab::make('Данные заявителя', [
                    Text::make('Заявитель', 'applicant_name'),
                    Text::make('ОГРН / ОГРНИП', 'applicant_ogrn'),
                    Date::make('ОГРН / ОГРНИП (дата регистрации)', 'applicant_ogrn_data'),
                    Text::make('Адрес заявителя', 'applicant_address'),
                    Text::make('Паспортные данные', 'applicant_passport_data'),
                    Text::make('Способы обмена информацией', 'applicant_connect_variants'),
                    Phone::make('Телефон', 'phone'),
                    Email::make('Email', 'email'),
                ]),

                Tab::make('Объект и земельный участок', [
                    Text::make('Основание для подключения к газораспределительной сети', 'reason'),
                    Text::make('Наименование объекта', 'object_name'),
                    Text::make('Адрес (местоположение) объекта', 'object_address'),
                    Text::make('Реквизиты утвержденного проекта межевания территории либо сведения о наличии схемы расположения земельного участка', 'land_docs'),
                ]),

                Tab::make('Необходимость дополнительных работ', [
                    Switcher::make('Необходимость дополнительных работ', 'need_any_works'),
                    Switcher::make('Необходимость проектирования', 'need_design'),
                    Switcher::make('Необходимость установки оборудования', 'need_equipment_installation'),
                    Switcher::make('Необходимость либо реконструкции внутреннего газопровода', 'need_pipeline_construction'),
                    Switcher::make('Необходимость установки прибора учета газа', 'need_meter_installation'),
                    Switcher::make('Необходимость поставки прибора учета газа', 'need_meter_supply'),
                    Switcher::make('Необходимость по поставке газоиспользующего оборудования', 'need_equipment_supply'),
                ]),

                Tab::make('Параметры потребления газа', [
                    Number::make('Величина максимального часового расхода газа (мощности)', 'gas_flow_total')->step(0.01),
                    Number::make('Величина максимального часового расхода газа (мощности) подключаемого газоиспользующего оборудования', 'gas_flow_new')->step(0.01),
                    Number::make('Величина максимального часового расхода газа (мощности) подключенного газоиспользующего оборудования', 'gas_flow_existing')->step(0.01),
                    Date::make('Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства', 'planned_date'),
                ]),

                Tab::make('Точки подключения', [
                    Number::make('Точка подключения', 'connection_point'),
                    Date::make('Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства, в том числе по этапам и очередям (месяц, год)', 'connection_planned_date'),
                    Number::make('Итоговая величина максимального часового расхода газа', 'connection_flow_total')->step(0.01),
                    Number::make('Величина максимального расхода газа ', 'connection_flow_new')->step(0.01),
                    Number::make('Величина максимального часового расхода газа', 'connection_flow_existing')->step(0.01),
                ]),

                Tab::make('Дополнительная информация', [
                    Text::make('Характеристика потребления газа (вид экономической деятельности заявителя - юридического лица или индивидуального предпринимателя) ', 'consumption_type'),
                    Text::make('Номер ранее выданных технических условий', 'previous_tech_number'),
                    Date::make('Дата ранее выданных технических условий', 'previous_tech_date'),
                    Textarea::make('Дополнительная информация', 'additional_info'),
                    Text::make('Способ уведомления о подключении', 'notification_method'),
                    Textarea::make('Описание вложений', 'attention_details'),
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
            Text::make('Наименование объекта', 'object_name'),
            Text::make('Заявитель', 'applicant_name'),
            Phone::make('Телефон', 'phone'),
        ];
    }

    /**
     * @param GasConnection $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_ogrn_data' => ['required', 'date'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'applicant_passport_data' => ['required', 'string', 'max:556'],
            'phone' => ['required', 'string', 'max:20'],
            'object_name' => ['required', 'string', 'max:500'],
            'object_address' => ['required', 'string', 'max:500'],
            'gas_flow_total' => ['required', 'numeric', 'gt:0'],
            'gas_flow_new' => ['required', 'numeric', 'gt:0'],
            'gas_flow_existing' => ['required', 'numeric', 'gt:0'],
            'planned_date' => ['required', 'date'],
            'connection_point' => ['required', 'integer'],
            'connection_planned_date' => ['required', 'date'],
            'connection_flow_total' => ['required', 'numeric', 'gt:0'],
            'connection_flow_new' => ['required', 'numeric', 'gt:0'],
            'connection_flow_existing' => ['required', 'numeric', 'gt:0'],
        ];
    }
}

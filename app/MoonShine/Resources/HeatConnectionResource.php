<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\UI\Fields\ID;
use MoonShine\Support\ListOf;

use MoonShine\UI\Fields\Text;
use App\Models\HeatConnection;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Switcher;
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
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;

/**
 * @extends ModelResource<HeatConnection>
 */
class HeatConnectionResource extends ModelResource
{
    use FiltersByUserRole;

    protected string $model = HeatConnection::class;

    protected string $title = 'Заявление на техническое присоединение к объектам теплоснабжения';

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
                            9 => 'Заявление на техническое присоединение к объектам теплоснабжения',
                        ])
                    ->default(9)
                    ->disabled(),
                    ...StateFields::make(),
                    Text::make('Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти', 'supplier_org'),
                ]),
                Tab::make('Данные заявителя', [
                    Text::make('Наименование заявителя', 'applicant_name'),
                    Text::make('Юридический адрес заявителя', 'applicant_address_ur'),
                    Text::make('Почтовый адрес заявителя', 'applicant_address_post'),
                    Phone::make('Телефон заявителя', 'applicant_phone'),
                    Text::make('Наименование банка заявителя', 'applicant_bank_name'),
                    Text::make('Расчетный счет банка заявителя', 'applicant_bank_rs'),
                    Text::make('Корреспондентский счет банка заявителя', 'applicant_bank_ks'),
                    Text::make('БИК банка заявителя', 'applicant_bank_bik'),
                    Text::make('ОГРН / ОГРНИП', 'applicant_ogrn'),
                    Text::make('ИНН', 'applicant_inn_kpp'),
                ]),
                Tab::make('Объект', [
                    Text::make('Наименование объекта', 'object_name'),
                    Text::make('Адрес (местоположение) объекта', 'object_address'),
                ]),
                Tab::make('Тепловая нагрузка - Всего', [
                    Number::make('Тепловая нагрузка, Гкал/ч всего часовая — максимальная', 'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч всего часовая — минимальная', 'teplovaya_nagruzka_vsego_chasovaya_minimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч всего среднечасовая — максимальная', 'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч всего среднечасовая — минимальная', 'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — всего расчетный', 'raskhod_teplonositelya_vsego_rashetnyi')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — всего среднечасовой', 'raskhod_teplonositelya_vsego_srednechasovoy')->step(0.01),
                ]),
                Tab::make('Тепловая нагрузка - Отопление', [
                    Number::make('Тепловая нагрузка, Гкал/ч отопление часовая — максимальная', 'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч отопление часовая — минимальная', 'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч отопление среднечасовая — максимальная', 'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч отопление среднечасовая — минимальная', 'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — отопление расчетный', 'raskhod_teplonositelya_otoplenie_rashetnyi')->step(0.01),
                    Number::make('Расход теплоnositelya, т/ч — отопление среднечасовой', 'raskhod_teplonositelya_otoplenie_srednechasovoy')->step(0.01),
                ]),
                Tab::make('Тепловая нагрузка - Вентиляция', [
                    Number::make('Тепловая нагрузка, Гкал/ч вентиляция часовая — максимальная', 'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч вентиляция часовая — минимальная', 'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — максимальная', 'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — минимальная', 'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — вентиляция расчетный', 'raskhod_teplonositelya_ventilyatsia_rashetnyi')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — вентиляция среднечасовой', 'raskhod_teplonositelya_ventilyatsia_srednechasovoy')->step(0.01),
                ]),
                Tab::make('Тепловая нагрузка - Горячее водоснабжение', [
                    Number::make('Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — максимальная', 'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — минимальная', 'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — максимальная', 'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya')->step(0.01),
                    Number::make('Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — минимальная', 'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — горячее водоснабжение расчетный', 'raskhod_teplonositelya_gorvoda_rashetnyi')->step(0.01),
                    Number::make('Расход теплоносителя, т/ч — горячее водоснабжение среднечасовой', 'raskhod_teplonositelya_gorvoda_srednechasovoy')->step(0.01),
                ]),
                Tab::make('Параметры теплоносителя', [
                    Number::make('Давление теплоносителя, м вод. ст', 'heat_pressure')->step(0.01),
                    Number::make('Температура теплоносителя, °C', 'heat_temperature')->step(0.01),
                    Switcher::make('Наличие узла учета тепловой энергии и теплоносителя', 'has_meter_control'),
                    Text::make('Режим потребления (постоянный, переменный)', 'consumption_mode'),
                    Text::make('Категория надежности', 'reliability_category'),
                    Switcher::make('Наличие собственной источника тепловой энергии', 'has_own_source'),
                    Number::make('Год ввода в эксплуатацию', 'commissioning_year'),
                    Text::make('Информация о виде разрешенного использования земельного участка', 'land_usage_info'),
                    Text::make('Информация о предельных параметрах разрешённого строительства', 'construction_limits'),
                ]),
                Tab::make('Приложения', [
                    Number::make('Количество приложенных листов', 'attachments_list'),
                    Number::make('Количество экземпляров', 'attachments_ekz'),
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
     * @param HeatConnection $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            // Организация
            'supplier_org' => ['required', 'string', 'max:500'],

            // Данные заявителя
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_address_ur' => ['required', 'string', 'max:256'],
            'applicant_address_post' => ['required', 'string', 'max:256'],
            'applicant_phone' => ['nullable', 'string', 'max:256'],
            'applicant_bank_name' => ['nullable', 'string', 'max:256'],
            'applicant_bank_rs' => ['nullable', 'string', 'max:256'],
            'applicant_bank_ks' => ['nullable', 'string', 'max:256'],
            'applicant_bank_bik' => ['nullable', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_inn_kpp' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],

            // Объект
            'object_name' => ['required', 'string'],
            'object_address' => ['required', 'string'],

            // Тепловая нагрузка - Всего
            'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_vsego_chasovaya_minimalnaya' => ['numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_vsego_rashetnyi' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_vsego_srednechasovoy' => [ 'numeric', 'min:0', 'max:99999999.99'],

            // Тепловая нагрузка - Отопление
            'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_otoplenie_rashetnyi' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_otoplenie_srednechasovoy' => [ 'numeric', 'min:0', 'max:99999999.99'],

            // Тепловая нагрузка - Вентиляция
            'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_ventilyatsia_rashetnyi' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_ventilyatsia_srednechasovoy' => [ 'numeric', 'min:0', 'max:99999999.99'],

            // Тепловая нагрузка - Горячее водоснабжение
            'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_gorvoda_rashetnyi' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'raskhod_teplonositelya_gorvoda_srednechasovoy' => [ 'numeric', 'min:0', 'max:99999999.99'],

            // Параметры теплоносителя
            'heat_pressure' => [ 'numeric', 'min:0', 'max:99999999.99'],
            'heat_temperature' => [ 'numeric', 'min:-999.99', 'max:999.99'],
            'has_meter_control' => ['nullable', 'boolean'],
            'consumption_mode' => ['nullable', 'string', 'max:20'],
            'reliability_category' => ['required', 'string', 'max:50'],
            'has_own_source' => ['nullable', 'boolean'],
            'commissioning_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'land_usage_info' => ['nullable', 'string', 'max:256'],
            'construction_limits' => ['nullable', 'string', 'max:256'],

            // Приложения
            'attachments_list' => ['nullable', 'integer', 'min:0'],
            'attachments_ekz' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function filters(): iterable
    {
        return [
            Text::make('Наименование объекта', 'object_name'),
            Text::make('Заявитель', 'applicant_name'),
        ];
    }
}

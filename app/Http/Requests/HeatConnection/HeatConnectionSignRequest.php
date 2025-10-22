<?php

namespace App\Http\Requests\HeatConnection;

use Illuminate\Foundation\Http\FormRequest;

class HeatConnectionSignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Организация
            'supplier_org.required' => 'Поле "Организация" обязательно для заполнения.',
            'supplier_org.string' => 'Поле "Организация" должно быть строкой.',
            'supplier_org.max' => 'Поле "Организация" не должно превышать :max символов.',

            // Данные заявителя
            'applicant_name.required' => 'Поле "Наименование заявителя" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать :max символов.',

            'applicant_address_ur.required' => 'Поле "Юридический адрес" обязательно для заполнения.',
            'applicant_address_ur.string' => 'Поле "Юридический адрес" должно быть строкой.',
            'applicant_address_ur.max' => 'Поле "Юридический адрес" не должно превышать :max символов.',

            'applicant_address_post.required' => 'Поле "Почтовый адрес" обязательно для заполнения.',
            'applicant_address_post.string' => 'Поле "Почтовый адрес" должно быть строкой.',
            'applicant_address_post.max' => 'Поле "Почтовый адрес" не должно превышать :max символов.',

            'applicant_phone.string' => 'Поле "Телефон заявителя" должно быть строкой.',
            'applicant_phone.max' => 'Поле "Телефон заявителя" не должно превышать :max символов.',

            'applicant_bank_name.string' => 'Поле "Наименование банка" должно быть строкой.',
            'applicant_bank_name.max' => 'Поле "Наименование банка" не должно превышать :max символов.',

            'applicant_bank_rs.string' => 'Поле "Расчетный счет" должно быть строкой.',
            'applicant_bank_rs.max' => 'Поле "Расчетный счет" не должно превышать :max символов.',

            'applicant_bank_ks.string' => 'Поле "Корреспондентский счет" должно быть строкой.',
            'applicant_bank_ks.max' => 'Поле "Корреспондентский счет" не должно превышать :max символов.',

            'applicant_bank_bik.string' => 'Поле "БИК банка" должно быть строкой.',
            'applicant_bank_bik.max' => 'Поле "БИК банка" не должно превышать :max символов.',

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП" не должно превышать :max символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП" должно содержать только цифры.',

            'applicant_inn_kpp.required' => 'Поле "ИНН" обязательно для заполнения.',
            'applicant_inn_kpp.string' => 'Поле "ИНН" должно быть строкой.',
            'applicant_inn_kpp.max' => 'Поле "ИНН" не должно превышать :max символов.',
            'applicant_inn_kpp.regex' => 'Поле "ИНН" должно содержать только цифры.',

            // Объект
            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения.',
            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой.',
            'object_address.required' => 'Поле "Адрес объекта" обязательно для заполнения.',
            'object_address.string' => 'Поле "Адрес объекта" должно быть строкой.',

            // Тепловая нагрузка - общие сообщения
            '*.numeric' => 'Поле должно быть числом.',
            '*.min' => 'Поле не может быть отрицательным.',
            '*.max' => 'Значение поля слишком большое.',

            // Параметры теплоносителя
            'heat_pressure.numeric' => 'Поле "Давление теплоносителя" должно быть числом.',
            'heat_pressure.min' => 'Поле "Давление теплоносителя" не может быть отрицательным.',
            'heat_pressure.max' => 'Поле "Давление теплоносителя" слишком большое.',

            'heat_temperature.numeric' => 'Поле "Температура теплоносителя" должно быть числом.',
            'heat_temperature.min' => 'Поле "Температура теплоносителя" не может быть меньше :min.',
            'heat_temperature.max' => 'Поле "Температура теплоносителя" не может быть больше :max.',

            'has_meter_control.boolean' => 'Поле "Наличие узла учета" должно быть логическим значением.',

            'consumption_mode.string' => 'Поле "Режим потребления" должно быть строкой.',
            'consumption_mode.max' => 'Поле "Режим потребления" не должно превышать :max символов.',

            'reliability_category.required' => 'Поле "Категория надежности" обязательно для заполнения.',
            'reliability_category.string' => 'Поле "Категория надежности" должно быть строкой.',
            'reliability_category.max' => 'Поле "Категория надежности" не должно превышать :max символов.',

            'has_own_source.boolean' => 'Поле "Наличие собственного источника" должно быть логическим значением.',

            'commissioning_year.integer' => 'Поле "Год ввода в эксплуатацию" должно быть целым числом.',
            'commissioning_year.min' => 'Поле "Год ввода в эксплуатацию" не может быть меньше :min.',
            'commissioning_year.max' => 'Поле "Год ввода в эксплуатацию" не может быть больше :max.',

            'land_usage_info.string' => 'Поле "Информация о виде разрешенного использования" должно быть строкой.',
            'land_usage_info.max' => 'Поле "Информация о виде разрешенного использования" не должно превышать :max символов.',

            'construction_limits.string' => 'Поле "Информация о предельных параметрах" должно быть строкой.',
            'construction_limits.max' => 'Поле "Информация о предельных параметрах" не должно превышать :max символов.',

            // Приложения
            'attachments_list.integer' => 'Поле "Количество листов" должно быть целым числом.',
            'attachments_list.min' => 'Поле "Количество листов" не может быть отрицательным.',

            'attachments_ekz.integer' => 'Поле "Количество экземпляров" должно быть целым числом.',
            'attachments_ekz.min' => 'Поле "Количество экземпляров" не может быть отрицательным.',
        ];
    }
}

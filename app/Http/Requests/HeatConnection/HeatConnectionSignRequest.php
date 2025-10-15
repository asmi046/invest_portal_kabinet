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
            'supplier_org' => ['required', 'string', 'max:500'],
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_address_ur' => ['required', 'string', 'max:256'],
            'applicant_address_post' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_inn_kpp' => ['required', 'string', 'max:256'],
            'object_name' => ['required', 'string'],
            'object_address' => ['required', 'string'],

            // Тепловая нагрузка - ВСЕГО
            'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_vsego_chasovaya_minimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya' => ['required', 'numeric'],
            'raskhod_teplonositelya_vsego_rashetnyi' => ['required', 'numeric'],
            'raskhod_teplonositelya_vsego_srednechasovoy' => ['required', 'numeric'],

            // Тепловая нагрузка - ОТОПЛЕНИЕ
            'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya' => ['required', 'numeric'],
            'raskhod_teplonositelya_otoplenie_rashetnyi' => ['required', 'numeric'],
            'raskhod_teplonositelya_otoplenie_srednechasovoy' => ['required', 'numeric'],

            // Тепловая нагрузка - ВЕНТИЛЯЦИЯ
            'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya' => ['required', 'numeric'],
            'raskhod_teplonositelya_ventilyatsia_rashetnyi' => ['required', 'numeric'],
            'raskhod_teplonositelya_ventilyatsia_srednechasovoy' => ['required', 'numeric'],

            // Тепловая нагрузка - ГОРЯЧЕЕ ВОДОСНАБЖЕНИЕ
            'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya' => ['required', 'numeric'],
            'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya' => ['required', 'numeric'],
            'raskhod_teplonositelya_gorvoda_rashetnyi' => ['required', 'numeric'],
            'raskhod_teplonositelya_gorvoda_srednechasovoy' => ['required', 'numeric'],

            // Параметры теплоносителя
            'heat_pressure' => ['required', 'numeric'],
            'heat_temperature' => ['required', 'numeric'],
            'consumption_mode' => ['required', 'string', 'max:20'],
            'reliability_category' => ['required', 'string', 'max:50'],
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
            'supplier_org.required' => 'Поле "Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти" обязательно для заполнения.',
            'supplier_org.string' => 'Поле "Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти" должно быть строкой.',
            'supplier_org.max' => 'Поле "Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти" не должно превышать 500 символов.',

            'applicant_name.required' => 'Поле "Наименование заявителя" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать 256 символов.',

            'applicant_address_ur.required' => 'Поле "Юридический адрес заявителя" обязательно для заполнения.',
            'applicant_address_ur.string' => 'Поле "Юридический адрес заявителя" должно быть строкой.',
            'applicant_address_ur.max' => 'Поле "Юридический адрес заявителя" не должно превышать 256 символов.',

            'applicant_address_post.required' => 'Поле "Почтовый адрес заявителя" обязательно для заполнения.',
            'applicant_address_post.string' => 'Поле "Почтовый адрес заявителя" должно быть строкой.',
            'applicant_address_post.max' => 'Поле "Почтовый адрес заявителя" не должно превышать 256 символов.',

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП" не должно превышать 256 символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП" должно содержать только цифры.',

            'applicant_inn_kpp.required' => 'Поле "ИНН" обязательно для заполнения.',
            'applicant_inn_kpp.string' => 'Поле "ИНН" должно быть строкой.',
            'applicant_inn_kpp.max' => 'Поле "ИНН" не должно превышать 256 символов.',

            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения.',
            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой.',

            'object_address.required' => 'Поле "Адрес (местоположение) объекта" обязательно для заполнения.',
            'object_address.string' => 'Поле "Адрес (местоположение) объекта" должно быть строкой.',

            // Тепловая нагрузка - ВСЕГО
            'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч всего часовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_vsego_chasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч всего часовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_vsego_chasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч всего часовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_vsego_chasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч всего часовая — минимальная" должно быть числом.',

            'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч всего среднечасовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч всего среднечасовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч всего среднечасовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч всего среднечасовая — минимальная" должно быть числом.',

            'raskhod_teplonositelya_vsego_rashetnyi.required' => 'Поле "Расход теплоносителя, т/ч — всего расчетный" обязательно для заполнения.',
            'raskhod_teplonositelya_vsego_rashetnyi.numeric' => 'Поле "Расход теплоносителя, т/ч — всего расчетный" должно быть числом.',

            'raskhod_teplonositelya_vsego_srednechasovoy.required' => 'Поле "Расход теплоносителя, т/ч — всего среднечасовой" обязательно для заполнения.',
            'raskhod_teplonositelya_vsego_srednechasovoy.numeric' => 'Поле "Расход теплоносителя, т/ч — всего среднечасовой" должно быть числом.',

            // Тепловая нагрузка - ОТОПЛЕНИЕ
            'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч отопление часовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч отопление часовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч отопление часовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч отопление часовая — минимальная" должно быть числом.',

            'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч отопление среднечасовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч отопление среднечасовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч отопление среднечасовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч отопление среднечасовая — минимальная" должно быть числом.',

            'raskhod_teplonositelya_otoplenie_rashetnyi.required' => 'Поле "Расход теплоносителя, т/ч — отопление расчетный" обязательно для заполнения.',
            'raskhod_teplonositelya_otoplenie_rashetnyi.numeric' => 'Поле "Расход теплоносителя, т/ч — отопление расчетный" должно быть числом.',

            'raskhod_teplonositelya_otoplenie_srednechasovoy.required' => 'Поле "Расход теплоносителя, т/ч — отопление среднечасовой" обязательно для заполнения.',
            'raskhod_teplonositelya_otoplenie_srednechasovoy.numeric' => 'Поле "Расход теплоносителя, т/ч — отопление среднечасовой" должно быть числом.',

            // Тепловая нагрузка - ВЕНТИЛЯЦИЯ
            'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция часовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция часовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция часовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция часовая — минимальная" должно быть числом.',

            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — минимальная" должно быть числом.',

            'raskhod_teplonositelya_ventilyatsia_rashetnyi.required' => 'Поле "Расход теплоносителя, т/ч — вентиляция расчетный" обязательно для заполнения.',
            'raskhod_teplonositelya_ventilyatsia_rashetnyi.numeric' => 'Поле "Расход теплоносителя, т/ч — вентиляция расчетный" должно быть числом.',

            'raskhod_teplonositelya_ventilyatsia_srednechasovoy.required' => 'Поле "Расход теплоносителя, т/ч — вентиляция среднечасовой" обязательно для заполнения.',
            'raskhod_teplonositelya_ventilyatsia_srednechasovoy.numeric' => 'Поле "Расход теплоносителя, т/ч — вентиляция среднечасовой" должно быть числом.',

            // Тепловая нагрузка - ГОРЯЧЕЕ ВОДОСНАБЖЕНИЕ
            'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — минимальная" должно быть числом.',

            'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — максимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — максимальная" должно быть числом.',

            'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya.required' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — минимальная" обязательно для заполнения.',
            'teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya.numeric' => 'Поле "Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — минимальная" должно быть числом.',

            'raskhod_teplonositelya_gorvoda_rashetnyi.required' => 'Поле "Расход теплоносителя, т/ч — горячее водоснабжение расчетный" обязательно для заполнения.',
            'raskhod_teplonositelya_gorvoda_rashetnyi.numeric' => 'Поле "Расход теплоносителя, т/ч — горячее водоснабжение расчетный" должно быть числом.',

            'raskhod_teplonositelya_gorvoda_srednechasovoy.required' => 'Поле "Расход теплоносителя, т/ч — горячее водоснабжение среднечасовой" обязательно для заполнения.',
            'raskhod_teplonositelya_gorvoda_srednechasovoy.numeric' => 'Поле "Расход теплоносителя, т/ч — горячее водоснабжение среднечасовой" должно быть числом.',

            // Параметры теплоносителя
            'heat_pressure.required' => 'Поле "Давление теплоносителя, м вод. ст" обязательно для заполнения.',
            'heat_pressure.numeric' => 'Поле "Давление теплоносителя, м вод. ст" должно быть числом.',

            'heat_temperature.required' => 'Поле "Температура теплоносителя, °C" обязательно для заполнения.',
            'heat_temperature.numeric' => 'Поле "Температура теплоносителя, °C" должно быть числом.',

            'consumption_mode.required' => 'Поле "Режим потребления" обязательно для заполнения.',
            'consumption_mode.string' => 'Поле "Режим потребления" должно быть строкой.',
            'consumption_mode.max' => 'Поле "Режим потребления" не должно превышать 20 символов.',

            'reliability_category.required' => 'Поле "Категория надежности" обязательно для заполнения.',
            'reliability_category.string' => 'Поле "Категория надежности" должно быть строкой.',
            'reliability_category.max' => 'Поле "Категория надежности" не должно превышать 50 символов.',
        ];
    }
}

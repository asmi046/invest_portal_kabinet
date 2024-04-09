<?php

namespace App\Http\Requests\Tc;

use Illuminate\Foundation\Http\FormRequest;

class TcSigneRequest extends FormRequest
{
 /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Поле "ФИО" должно быть заполнено',
            'dolgnost.required' => 'Поле "Должность" должно быть заполнено',

            "phone.required" => 'Поле "Телефон" должно быть заполнено',
            "organization.required" => 'Поле "Организация" должно быть заполнено',
            "egrul.required" => 'Поле "ЕГРЮЛ/ЕГРИП заявителя" должно быть заполнено',
            "adress.required" => 'Поле "Адрес заявителя" должно быть заполнено',
            "okved.required" => 'Поле "Вид экономической деятельности" должно быть заполнено',

            "pasport_seria.required" => 'Поле "Серия" должно быть заполнено',
            "pasport_number.required" => 'Поле "Номер" должно быть заполнено',
            "pasport_vidan.required" => 'Поле "Выдан" должно быть заполнено',

            "osnovanie.required" => 'Поле "Основание для присоединения" должно быть заполнено',
            "ustroistvo.required" => 'Поле "Наименование энергопринимающих устройств" должно быть заполнено',
            "raspologeie.required" => 'Поле "Место нахождения энергопринимающих устройств" должно быть заполнено',

            "pover_prin_devices.required" => 'Полея в разделе "Максимальная мощность присоединяемых энергопринимающих устройств" должно быть заполнено',
            "napr_prin_devices.required" => 'Полея в разделе "Максимальная мощность присоединяемых энергопринимающих устройств" должно быть заполнено',
            "pover_pris_devices.required" => 'Поле "Максимальная мощность ранее присоединенных в данной точке" должно быть заполнено',
            "napr_pris_devices.required" => 'Поле "Максимальная мощность ранее присоединенных в данной точке" должно быть заполнено',

            "rashet_plati.required" => 'Поле "Порядок расчета и условия рассрочки внесения платы" должно быть заполнено',
            "gen_postavhik.required" => 'Поле "Гарантирующий поставщик" должно быть заполнено',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required', 'string'],
            "dolgnost" => ['required', 'string'],
            "phone" => ['required', 'string'],
            "organization" => ['required', 'string'],
            "egrul" => ['required', 'string'],
            "adress" => ['required', 'string'],
            "okved" => ['required', 'string'],

            "pasport_seria" => ['required', 'string'],
            "pasport_number" => ['required', 'string'],
            "pasport_vidan" => ['required', 'string'],

            "osnovanie" => ['required', 'string'],
            "ustroistvo" => ['required', 'string'],
            "raspologeie" => ['required', 'string'],

            "pover_prin_devices"=> ['required', 'string'],
            "napr_prin_devices" => ['required', 'string'],
            "pover_pris_devices"=> ['required', 'string'],
            "napr_pris_devices" => ['required', 'string'],
            "pover_pris_r_devices" => [],
            "napr_pris_r_devices" => [],
            "rashet_plati" => ['required', 'string'],
            "gen_postavhik" => ['required', 'string'],
            "prilogenie" => [],
        ];
    }
}

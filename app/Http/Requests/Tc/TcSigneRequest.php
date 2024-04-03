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

            "phone" => 'Поле "Телефон" должно быть заполнено',
            "organization" => 'Поле "Организация" должно быть заполнено',
            "egrul" => 'Поле "ЕГРЮЛ/ЕГРИП заявителя" должно быть заполнено',
            "adress" => 'Поле "Адрес заявителя" должно быть заполнено',

            "pasport_seria" => 'Поле "Серия" должно быть заполнено',
            "pasport_number" => 'Поле "Номер" должно быть заполнено',
            "pasport_vidan" => 'Поле "Выдан" должно быть заполнено',

            "osnovanie" => 'Поле "Основание для присоединения" должно быть заполнено',
            "ustroistvo" => 'Поле "Наименование энергопринимающих устройств" должно быть заполнено',
            "raspologeie" => 'Поле "Место нахождения энергопринимающих устройств" должно быть заполнено',

            "pover_prin_devices" => 'Полея в разделе "Максимальная мощность присоединяемых энергопринимающих устройств" должно быть заполнено',
            "napr_prin_devices" => 'Полея в разделе "Максимальная мощность присоединяемых энергопринимающих устройств" должно быть заполнено',
            "pover_pris_devices" => 'Поле "Максимальная мощность ранее присоединенных в данной точке" должно быть заполнено',
            "napr_pris_devices" => 'Поле "Максимальная мощность ранее присоединенных в данной точке" должно быть заполнено',

            "rashet_plati" => 'Поле "Порядок расчета и условия рассрочки внесения платы" должно быть заполнено',
            "gen_postavhik" => 'Поле "Гарантирующий поставщик" должно быть заполнено',
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

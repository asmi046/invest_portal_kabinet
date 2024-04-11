<?php

namespace App\Http\Requests\Tc;

use Illuminate\Foundation\Http\FormRequest;

class TcDraftRequest extends FormRequest
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
            'name.required' => 'Для сохраниения черновика поле "ФИО" должно быть заполнено',
            'pover_pris_devices.required' => 'Для сохраниения черновика поле "Максимальная мощность энергопринимающих устройств" должно быть заполнено',
            'pover_pris_devices.integer' => 'Поле "Максимальная мощность энергопринимающих устройств" должно быть целым числом',
            'gen_postavhik.required' => 'Для сохраниения черновика поле "Генеральный поставщик" должно быть заполнено',
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
            "dolgnost" => [],
            "phone" => [],
            "organization" => [],
            "egrul" => [],
            "adress" => [],
            "okved" => [],

            "pasport_seria" => [],
            "pasport_number" => [],
            "pasport_vidan" => [],

            "osnovanie" => [],
            "ustroistvo" => [],
            "raspologeie" => [],

            "pover_prin_devices"=> [],
            "napr_prin_devices" => [],
            "pover_pris_devices"=> ['required', 'integer'],
            "napr_pris_devices" => [],
            "pover_pris_r_devices" => [],
            "napr_pris_r_devices" => [],
            "rashet_plati" => [],
            "gen_postavhik" => ['required', 'string'],
            "prilogenie" => [],
        ];
    }
}

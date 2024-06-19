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
            'phone.required' => 'Для сохраниения черновика поле "Телефон" должно быть заполнено',
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
            "phone" => ['required', 'string'],
            "organization" => [],
            "egrul" => [],
            "adress" => [],
            "okved" => [],

            "project_name" => [],
            "cadastr_number" => [],
            "geo" => [],
            "object_place_name" => [],

            "safety_category" => [],
            "point_count" => [],
            "corporation_check" => [],
            "resource_check" => [],

            "osnovanie" => [],
            "ustroistvo" => [],
            "raspologeie" => [],

            "pover_prin_devices"=> [],
            "napr_prin_devices" => [],
            "pover_pris_devices"=> ['required', 'integer'],
            "napr_pris_devices" => [],
            "pover_pris_r_devices" => [],
            "napr_pris_r_devices" => [],

            "prilogenie" => [],
        ];
    }
}

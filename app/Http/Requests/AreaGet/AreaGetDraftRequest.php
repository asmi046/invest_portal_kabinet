<?php

namespace App\Http\Requests\AreaGet;

use Illuminate\Foundation\Http\FormRequest;

class AreaGetDraftRequest extends FormRequest
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
            'object_name.required' => 'Для сохраниения черновика поле "Наименование объекта" должно быть заполнено',
            'object_type.required' => 'Для сохраниения черновика поле "Тип объекта" должно быть заполнено',
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
            "object_name" => ['required', 'string'],
            "object_type" => ['required', 'string'],
            "prilogenie_list_count" => [],
        ];
    }
}

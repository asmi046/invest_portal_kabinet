<?php

namespace App\Http\Requests\AreaGet;

use Illuminate\Foundation\Http\FormRequest;

class AreaGetSigneRequest extends FormRequest
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
            'object_name.required' => 'Поле "Наименование объекта" должно быть заполнено',
            'object_type.required' => 'Поле "Тип объекта" должно быть заполнено',
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
            "object_name" => ['required', 'string'],
            "object_type" => ['required', 'string'],
            "prilogenie_list_count" => [],
        ];
    }
}

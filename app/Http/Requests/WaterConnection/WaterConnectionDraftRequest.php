<?php

namespace App\Http\Requests\WaterConnection;

use Illuminate\Foundation\Http\FormRequest;

class WaterConnectionDraftRequest extends FormRequest
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
            'name.required' => 'Для сохраниения черновика поле "Организация или Ф.И.О. заявителя" должно быть заполнено',
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
            'applicant_name' => ['required', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests\GasConnection;

use Illuminate\Foundation\Http\FormRequest;

class GasConnectionDraftRequest extends FormRequest
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
            'applicant_name' => ['required', 'string', 'max:256'],
            'object_name' => ['required', 'string', 'max:500'],
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
            'applicant_name.required' => 'Поле "Заявитель" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Заявитель" должно быть строкой.',
            'applicant_name.max' => 'Поле "Заявитель" не должно превышать 256 символов.',


            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения.',
            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой.',
            'object_name.max' => 'Поле "Наименование объекта" не должно превышать 500 символов.',
        ];
    }
}

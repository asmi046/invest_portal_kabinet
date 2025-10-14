<?php

namespace App\Http\Requests\LandLeaseApplication;

use Illuminate\Foundation\Http\FormRequest;

class LandLeaseApplicationSignRequest extends FormRequest
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
            'applicant_ogrn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'phone' => ['required', 'string', 'max:20'],
            'post_address' => ['required', 'string', 'max:500'],
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'area' => ['required', 'numeric', 'gt:0'],
            'lease_term' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string'],
            'basis' => ['required', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'applicant_name.required' => 'Поле "Наименование заявителя" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать 256 символов.',

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП заявителя" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП заявителя" должно быть строкой.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП заявителя" должно содержать только цифры.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП заявителя" не должно превышать 256 символов.',

            'applicant_inn.required' => 'Поле "ИНН заявителя" обязательно для заполнения.',
            'applicant_inn.string' => 'Поле "ИНН заявителя" должно быть строкой.',
            'applicant_inn.regex' => 'Поле "ИНН заявителя" должно содержать только цифры.',
            'applicant_inn.max' => 'Поле "ИНН заявителя" не должно превышать 256 символов.',

            'applicant_address.required' => 'Поле "Адрес заявителя" обязательно для заполнения.',
            'applicant_address.string' => 'Поле "Адрес заявителя" должно быть строкой.',
            'applicant_address.max' => 'Поле "Адрес заявителя" не должно превышать 256 символов.',

            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.max' => 'Поле "Телефон" не должно превышать 20 символов.',

            'post_address.required' => 'Поле "Почтовый адрес" обязательно для заполнения.',
            'post_address.string' => 'Поле "Почтовый адрес" должно быть строкой.',
            'post_address.max' => 'Поле "Почтовый адрес" не должно превышать 500 символов.',

            'land_cadastral_number.required' => 'Поле "Кадастровый номер земельного участка" обязательно для заполнения.',
            'land_cadastral_number.string' => 'Поле "Кадастровый номер земельного участка" должно быть строкой.',
            'land_cadastral_number.max' => 'Поле "Кадастровый номер земельного участка" не должно превышать 256 символов.',

            'area.required' => 'Поле "Площадь земельного участка" обязательно для заполнения.',
            'area.numeric' => 'Поле "Площадь земельного участка" должно быть числом.',
            'area.gt' => 'Поле "Площадь земельного участка" должно быть больше нуля.',

            'lease_term.required' => 'Поле "Срок аренды земельного участка" обязательно для заполнения.',
            'lease_term.string' => 'Поле "Срок аренды земельного участка" должно быть строкой.',
            'lease_term.max' => 'Поле "Срок аренды земельного участка" не должно превышать 255 символов.',

            'purpose.required' => 'Поле "Цель использования земельного участка" обязательно для заполнения.',
            'purpose.string' => 'Поле "Цель использования земельного участка" должно быть строкой.',

            'basis.required' => 'Поле "Основание предоставления земельного участка без проведения торгов" обязательно для заполнения.',
            'basis.string' => 'Поле "Основание предоставления земельного участка без проведения торгов" должно быть строкой.',
        ];
    }
}

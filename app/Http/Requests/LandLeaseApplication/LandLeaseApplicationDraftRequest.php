<?php

namespace App\Http\Requests\LandLeaseApplication;

use Illuminate\Foundation\Http\FormRequest;

class LandLeaseApplicationDraftRequest extends FormRequest
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
            'applicant_name' => ['nullable', 'string', 'max:256'],
            'applicant_ogrn' => ['nullable', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['nullable', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_address' => ['nullable', 'string', 'max:256'],
            'phone' => ['nullable', 'string', 'max:20'],
            'post_address' => ['nullable', 'string', 'max:500'],
            'land_cadastral_number' => ['nullable', 'string', 'max:256'],
            'area' => ['nullable', 'numeric', 'gt:0'],
            'lease_term' => ['nullable', 'string', 'max:255'],
            'purpose' => ['nullable', 'string'],
            'basis' => ['nullable', 'string'],
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
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать 256 символов.',

            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП заявителя" должно быть строкой.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП заявителя" должно содержать только цифры.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП заявителя" не должно превышать 256 символов.',

            'applicant_inn.string' => 'Поле "ИНН заявителя" должно быть строкой.',
            'applicant_inn.regex' => 'Поле "ИНН заявителя" должно содержать только цифры.',
            'applicant_inn.max' => 'Поле "ИНН заявителя" не должно превышать 256 символов.',

            'applicant_address.string' => 'Поле "Адрес заявителя" должно быть строкой.',
            'applicant_address.max' => 'Поле "Адрес заявителя" не должно превышать 256 символов.',

            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.max' => 'Поле "Телефон" не должно превышать 20 символов.',

            'post_address.string' => 'Поле "Почтовый адрес" должно быть строкой.',
            'post_address.max' => 'Поле "Почтовый адрес" не должно превышать 500 символов.',

            'land_cadastral_number.string' => 'Поле "Кадастровый номер земельного участка" должно быть строкой.',
            'land_cadastral_number.max' => 'Поле "Кадастровый номер земельного участка" не должно превышать 256 символов.',

            'area.numeric' => 'Поле "Площадь земельного участка" должно быть числом.',
            'area.gt' => 'Поле "Площадь земельного участка" должно быть больше нуля.',

            'lease_term.string' => 'Поле "Срок аренды земельного участка" должно быть строкой.',
            'lease_term.max' => 'Поле "Срок аренды земельного участка" не должно превышать 255 символов.',

            'purpose.string' => 'Поле "Цель использования земельного участка" должно быть строкой.',

            'basis.string' => 'Поле "Основание предоставления земельного участка без проведения торгов" должно быть строкой.',
        ];
    }
}

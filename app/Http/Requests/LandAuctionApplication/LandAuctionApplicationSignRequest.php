<?php

namespace App\Http\Requests\LandAuctionApplication;

use Illuminate\Foundation\Http\FormRequest;

class LandAuctionApplicationSignRequest extends FormRequest
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
            'supplier_org' => ['nullable', 'string', 'max:255'],
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'phone' => ['required', 'string', 'max:20'],
            'post_address' => ['required', 'string', 'max:500'],
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'area' => ['required', 'numeric', 'gt:0'],
            'purpose' => ['required', 'string'],
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
            'supplier_org.string' => 'Поле "Организация в которую подается заявление" должно быть строкой.',
            'supplier_org.max' => 'Поле "Организация в которую подается заявление" не должно превышать 255 символов.',

            'applicant_name.required' => 'Поле "Заявитель" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Заявитель" должно быть строкой.',
            'applicant_name.max' => 'Поле "Заявитель" не должно превышать 256 символов.',

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП" должно быть строкой.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП" должно содержать только цифры.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП" не должно превышать 256 символов.',

            'applicant_inn.required' => 'Поле "ИНН" обязательно для заполнения.',
            'applicant_inn.string' => 'Поле "ИНН" должно быть строкой.',
            'applicant_inn.regex' => 'Поле "ИНН" должно содержать только цифры.',
            'applicant_inn.max' => 'Поле "ИНН" не должно превышать 256 символов.',

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

            'purpose.required' => 'Поле "Цель использования земельного участка" обязательно для заполнения.',
            'purpose.string' => 'Поле "Цель использования земельного участка" должно быть строкой.',
        ];
    }
}

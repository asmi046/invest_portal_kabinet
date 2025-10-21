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


            // Необязательные поля с валидацией
            'supplier_org' => ['required', 'string', 'max:255'],

            // Данные заявителя
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_inn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_address' => ['required', 'string', 'max:256'],

            // Представитель
            'person' => ['nullable', 'string', 'max:256'],
            'person_dover' => ['nullable', 'string', 'max:256'],

            // Контактные данные
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'post_address' => ['required', 'string', 'max:500'],

            // Данные о земельном участке
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'landmarks' => ['nullable', 'string', 'max:556'],
            'area' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],
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
            // Организация
            'supplier_org.required' => 'Поле "Организация" обязательно для заполнения.',
            'supplier_org.string' => 'Поле "Организация" должно быть строкой.',
            'supplier_org.max' => 'Поле "Организация" не должно превышать :max символов.',

            // Данные заявителя
            'applicant_name.required' => 'Поле "Заявитель" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Заявитель" должно быть строкой.',
            'applicant_name.max' => 'Поле "Заявитель" не должно превышать :max символов.',

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП" не должно превышать :max символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП" должно содержать только цифры.',

            'applicant_inn.required' => 'Поле "ИНН" обязательно для заполнения.',
            'applicant_inn.string' => 'Поле "ИНН" должно быть строкой.',
            'applicant_inn.max' => 'Поле "ИНН" не должно превышать :max символов.',
            'applicant_inn.regex' => 'Поле "ИНН" должно содержать только цифры.',

            'applicant_address.required' => 'Поле "Адрес заявителя" обязательно для заполнения.',
            'applicant_address.string' => 'Поле "Адрес заявителя" должно быть строкой.',
            'applicant_address.max' => 'Поле "Адрес заявителя" не должно превышать :max символов.',

            // Представитель
            'person.string' => 'Поле "ФИО представителя" должно быть строкой.',
            'person.max' => 'Поле "ФИО представителя" не должно превышать :max символов.',

            'person_dover.string' => 'Поле "Документ, подтверждающий полномочия представителя" должно быть строкой.',
            'person_dover.max' => 'Поле "Документ, подтверждающий полномочия представителя" не должно превышать :max символов.',

            // Контактные данные
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.max' => 'Поле "Телефон" не должно превышать :max символов.',

            'email.email' => 'Поле "Email" должно быть корректным адресом электронной почты.',
            'email.max' => 'Поле "Email" не должно превышать :max символов.',

            'post_address.required' => 'Поле "Почтовый адрес" обязательно для заполнения.',
            'post_address.string' => 'Поле "Почтовый адрес" должно быть строкой.',
            'post_address.max' => 'Поле "Почтовый адрес" не должно превышать :max символов.',

            // Данные о земельном участке
            'land_cadastral_number.required' => 'Поле "Кадастровый номер земельного участка" обязательно для заполнения.',
            'land_cadastral_number.string' => 'Поле "Кадастровый номер земельного участка" должно быть строкой.',
            'land_cadastral_number.max' => 'Поле "Кадастровый номер земельного участка" не должно превышать :max символов.',

            'landmarks.string' => 'Поле "Ориентиры земельного участка" должно быть строкой.',
            'landmarks.max' => 'Поле "Ориентиры земельного участка" не должно превышать :max символов.',

            'area.required' => 'Поле "Площадь земельного участка" обязательно для заполнения.',
            'area.numeric' => 'Поле "Площадь земельного участка" должно быть числом.',
            'area.min' => 'Поле "Площадь земельного участка" должно быть не меньше 0.',
            'area.max' => 'Поле "Площадь земельного участка" должно быть не больше 99999999.99.',

            'purpose.required' => 'Поле "Цель использования земельного участка" обязательно для заполнения.',
            'purpose.string' => 'Поле "Цель использования земельного участка" должно быть строкой.',
        ];
    }
}

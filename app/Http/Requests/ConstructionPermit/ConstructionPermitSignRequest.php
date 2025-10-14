<?php

namespace App\Http\Requests\ConstructionPermit;

use Illuminate\Foundation\Http\FormRequest;

class ConstructionPermitSignRequest extends FormRequest
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
            'supplier_org' => ['required', 'string', 'max:255'],
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_inn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_passport_data' => ['required', 'string', 'max:556'],
            'applicant_company_name' => ['required', 'string', 'max:256'],
            'applicant_company_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_company_inn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_company_passport_data' => ['required', 'string', 'max:556'],
            'object_name' => ['required', 'string'],
            'object_cadastral_number' => ['required', 'string', 'max:20'],
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'land_docs' => ['required', 'string', 'max:256'],
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
            'supplier_org.required' => 'Поле "Организация в которую подается заявление" обязательно для заполнения.',
            'supplier_org.string' => 'Поле "Организация в которую подается заявление" должно быть строкой.',
            'supplier_org.max' => 'Поле "Организация в которую подается заявление" не должно превышать 255 символов.',

            'applicant_name.required' => 'Поле "Наименование заявителя" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать 256 символов.',

            'applicant_ogrn.required' => 'Поле "ОГРНИП заявителя" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРНИП заявителя" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРНИП заявителя" не должно превышать 256 символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРНИП заявителя" должно содержать только цифры.',

            'applicant_inn.required' => 'Поле "ИНН заявителя" обязательно для заполнения.',
            'applicant_inn.string' => 'Поле "ИНН заявителя" должно быть строкой.',
            'applicant_inn.max' => 'Поле "ИНН заявителя" не должно превышать 256 символов.',
            'applicant_inn.regex' => 'Поле "ИНН заявителя" должно содержать только цифры.',

            'applicant_passport_data.required' => 'Поле "Паспортные данные заявителя" обязательно для заполнения.',
            'applicant_passport_data.string' => 'Поле "Паспортные данные заявителя" должно быть строкой.',
            'applicant_passport_data.max' => 'Поле "Паспортные данные заявителя" не должно превышать 556 символов.',

            'applicant_company_name.required' => 'Поле "Наименование компании" обязательно для заполнения.',
            'applicant_company_name.string' => 'Поле "Наименование компании" должно быть строкой.',
            'applicant_company_name.max' => 'Поле "Наименование компании" не должно превышать 256 символов.',

            'applicant_company_ogrn.required' => 'Поле "ОГРН заявителя" обязательно для заполнения.',
            'applicant_company_ogrn.string' => 'Поле "ОГРН заявителя" должно быть строкой.',
            'applicant_company_ogrn.max' => 'Поле "ОГРН заявителя" не должно превышать 256 символов.',
            'applicant_company_ogrn.regex' => 'Поле "ОГРН заявителя" должно содержать только цифры.',

            'applicant_company_inn.required' => 'Поле "ИНН заявителя" обязательно для заполнения.',
            'applicant_company_inn.string' => 'Поле "ИНН заявителя" должно быть строкой.',
            'applicant_company_inn.max' => 'Поле "ИНН заявителя" не должно превышать 256 символов.',
            'applicant_company_inn.regex' => 'Поле "ИНН заявителя" должно содержать только цифры.',

            'applicant_company_passport_data.required' => 'Поле "Паспортные данные руководителя" обязательно для заполнения.',
            'applicant_company_passport_data.string' => 'Поле "Паспортные данные руководителя" должно быть строкой.',
            'applicant_company_passport_data.max' => 'Поле "Паспортные данные руководителя" не должно превышать 556 символов.',

            'object_name.required' => 'Поле "Наименование объекта капитального строительства" обязательно для заполнения.',
            'object_name.string' => 'Поле "Наименование объекта капитального строительства" должно быть строкой.',

            'object_cadastral_number.required' => 'Поле "Кадастровый номер объекта" обязательно для заполнения.',
            'object_cadastral_number.string' => 'Поле "Кадастровый номер объекта" должно быть строкой.',
            'object_cadastral_number.max' => 'Поле "Кадастровый номер объекта" не должно превышать 20 символов.',

            'land_cadastral_number.required' => 'Поле "Кадастровый номер земельного участка" обязательно для заполнения.',
            'land_cadastral_number.string' => 'Поле "Кадастровый номер земельного участка" должно быть строкой.',
            'land_cadastral_number.max' => 'Поле "Кадастровый номер земельного участка" не должно превышать 256 символов.',

            'land_docs.required' => 'Поле "Реквизиты утвержденного проекта межевания территории" обязательно для заполнения.',
            'land_docs.string' => 'Поле "Реквизиты утвержденного проекта межевания территории" должно быть строкой.',
            'land_docs.max' => 'Поле "Реквизиты утвержденного проекта межевания территории" не должно превышать 256 символов.',
        ];
    }
}

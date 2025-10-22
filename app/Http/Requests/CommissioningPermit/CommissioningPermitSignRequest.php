<?php

namespace App\Http\Requests\CommissioningPermit;

use Illuminate\Foundation\Http\FormRequest;

class CommissioningPermitSignRequest extends FormRequest
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
            'applicant_type' => ['required', 'string', 'max:256'],
            'send_result_type' => ['required', 'string', 'max:550'],

            // Дополнительные правила для необязательных полей
            'supplier_org' => ['required', 'string', 'max:500'],
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_inn' => ['required', 'string', 'regex:/^\d+$/', 'max:256'],
            'applicant_passport_data' => ['required', 'string', 'max:556'],
            'object_name' => ['required', 'string'],
            'object_address' => ['required', 'string'],
            'land_cadastral_number' => ['nullable', 'string', 'max:256'],
            'permit_authority' => ['nullable', 'string', 'max:256'],
            'permit_number' => ['nullable', 'string', 'max:256'],
            'permit_date' => ['nullable', 'date'],
            'previous_permit_authority' => ['nullable', 'string', 'max:256'],
            'previous_permit_number' => ['nullable', 'string', 'max:256'],
            'previous_permit_date' => ['nullable', 'date'],
            'doc_name' => ['nullable', 'string', 'max:556'],
            'doc_number' => ['nullable', 'string', 'max:256'],
            'doc_date' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'send_mfc_adress' => ['nullable', 'string', 'max:550'],
            'send_post_adress' => ['nullable', 'string', 'max:550'],
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
            'document_type.required' => 'Поле "Тип документа" обязательно для заполнения',
            'document_type.string' => 'Поле "Тип документа" должно быть строкой',
            'document_type.max' => 'Поле "Тип документа" не должно превышать :max символов',

            'state.required' => 'Поле "Статус документа" обязательно для заполнения',
            'state.string' => 'Поле "Статус документа" должно быть строкой',
            'state.max' => 'Поле "Статус документа" не должно превышать :max символов',

            'applicant_type.required' => 'Поле "Тип заявителя" обязательно для заполнения',
            'applicant_type.string' => 'Поле "Тип заявителя" должно быть строкой',
            'applicant_type.max' => 'Поле "Тип заявителя" не должно превышать :max символов',

            'send_result_type.required' => 'Поле "Вид отправки результата оказания услуги" обязательно для заполнения',
            'send_result_type.string' => 'Поле "Вид отправки результата оказания услуги" должно быть строкой',
            'send_result_type.max' => 'Поле "Вид отправки результата оказания услуги" не должно превышать :max символов',

            'supplier_org.required' => 'Поле "Наименование уполномоченного органа" обязательно для заполнения',
            'supplier_org.string' => 'Поле "Наименование уполномоченного органа" должно быть строкой',
            'supplier_org.max' => 'Поле "Наименование уполномоченного органа" не должно превышать :max символов',

            'applicant_name.required' => 'Поле "Наименование заявителя" обязательно для заполнения',
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать :max символов',

            'applicant_ogrn.required' => 'Поле "ОГРН заявителя" обязательно для заполнения',
            'applicant_ogrn.string' => 'Поле "ОГРН заявителя" должно быть строкой',
            'applicant_ogrn.regex' => 'Поле "ОГРН заявителя" должно содержать только цифры',
            'applicant_ogrn.max' => 'Поле "ОГРН заявителя" не должно превышать :max символов',

            'applicant_inn.required' => 'Поле "ИНН заявителя" обязательно для заполнения',
            'applicant_inn.string' => 'Поле "ИНН заявителя" должно быть строкой',
            'applicant_inn.regex' => 'Поле "ИНН заявителя" должно содержать только цифры',
            'applicant_inn.max' => 'Поле "ИНН заявителя" не должно превышать :max символов',

            'applicant_passport_data.required' => 'Поле "Паспортные данные" обязательно для заполнения',
            'applicant_passport_data.string' => 'Поле "Паспортные данные" должно быть строкой',
            'applicant_passport_data.max' => 'Поле "Паспортные данные" не должно превышать :max символов',

            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой',
            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения',


            'object_address.string' => 'Поле "Адрес объекта" должно быть строкой',
            'object_address.required' => 'Поле "Адрес объекта" обязательно для заполнения',

            'land_cadastral_number.string' => 'Поле "Кадастровый номер" должно быть строкой',
            'land_cadastral_number.max' => 'Поле "Кадастровый номер" не должно превышать :max символов',

            'permit_authority.string' => 'Поле "Наименование органа, выдавшего разрешение" должно быть строкой',
            'permit_authority.max' => 'Поле "Наименование органа" не должно превышать :max символов',

            'permit_number.string' => 'Поле "Номер документа" должно быть строкой',
            'permit_number.max' => 'Поле "Номер документа" не должно превышать :max символов',

            'permit_date.date' => 'Поле "Дата выдачи разрешения" должно быть корректной датой',

            'previous_permit_authority.string' => 'Поле "Наименование органа" должно быть строкой',
            'previous_permit_authority.max' => 'Поле "Наименование органа" не должно превышать :max символов',

            'previous_permit_number.string' => 'Поле "Номер документа" должно быть строкой',
            'previous_permit_number.max' => 'Поле "Номер документа" не должно превышать :max символов',

            'previous_permit_date.date' => 'Поле "Дата выдачи разрешения" должно быть корректной датой',

            'doc_name.string' => 'Поле "Наименование документа" должно быть строкой',
            'doc_name.max' => 'Поле "Наименование документа" не должно превышать :max символов',

            'doc_number.string' => 'Поле "Номер документа" должно быть строкой',
            'doc_number.max' => 'Поле "Номер документа" не должно превышать :max символов',

            'doc_date.date' => 'Поле "Дата выдачи документа" должно быть корректной датой',

            'phone.string' => 'Поле "Телефон" должно быть строкой',
            'phone.max' => 'Поле "Телефон" не должно превышать :max символов',

            'email.email' => 'Поле "Email" должно быть корректным адресом электронной почты',
            'email.max' => 'Поле "Email" не должно превышать :max символов',

            'send_mfc_adress.string' => 'Поле "Адрес МФЦ" должно быть строкой',
            'send_mfc_adress.max' => 'Поле "Адрес МФЦ" не должно превышать :max символов',

            'send_post_adress.string' => 'Поле "Почтовый адрес" должно быть строкой',
            'send_post_adress.max' => 'Поле "Почтовый адрес" не должно превышать :max символов',
        ];
    }
}

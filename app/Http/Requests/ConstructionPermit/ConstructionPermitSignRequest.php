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
            // Организация
            'supplier_org' => ['nullable', 'string', 'max:255'],

            // Сведения о физическом лице
            'applicant_name' => ['required_without_all:applicant_company_name', 'nullable', 'string', 'max:256'],
            'applicant_passport_data' => ['required_with:applicant_name', 'nullable', 'string', 'max:256'],
            'applicant_ogrn' => ['required_with:applicant_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_inn' => ['required_with:applicant_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],

            // Сведения о юр. лице
            'applicant_company_name' => ['required_without_all:applicant_name', 'nullable', 'string', 'max:256'],
            'applicant_company_passport_data' => ['required_with:applicant_company_name', 'nullable', 'string', 'max:256'],
            'applicant_company_ogrn' => ['required_with:applicant_company_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_company_inn' => ['required_with:applicant_company_name', 'nullable', 'string', 'max:256', 'regex:/^\d+$/'],


            // Сведения о представителе
            'applicant_predst_name' => ['nullable', 'string', 'max:256'],
            'applicant_predst_passport_data' => ['nullable', 'string', 'max:556'],
            'applicant_predst_ogrn' => ['nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_predst_inn' => ['nullable', 'string', 'max:256', 'regex:/^\d+$/'],
            'rep_doc_issued_at' => ['nullable', 'date'],

            // Сведения об объекте
            'object_name' => ['required', 'string'],
            'object_cadastral_number' => ['required', 'string', 'max:256'],

            // Сведения о земельном участке
            'land_cadastral_number' => ['required', 'string', 'max:256'],
            'land_docs' => ['required', 'string'],

            // Строительство объекта на основании документов
            'doc_name' => ['required', 'string', 'max:556'],
            'doc_number' => ['nullable', 'string', 'max:256'],
            'doc_date' => ['nullable', 'date'],

            // Контактные данные
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'attention_details' => ['nullable', 'string'],

            // Результат предоставления услуги
            'send_result_type' => ['nullable', 'string', 'max:550'],
            'send_mfc_adress' => ['nullable', 'string', 'max:550'],
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
            // Организация
            'supplier_org.string' => 'Поле "Организация" должно быть строкой.',
            'supplier_org.max' => 'Поле "Организация" не должно превышать :max символов.',

            // Сведения о физическом лице
            'applicant_name.required_without_all' => 'Поле "Наименование заявителя (физ. лицо)" обязательно для заполнения, если не заполнено поле "Наименование заявителя (юр. лицо)".',
            'applicant_name.string' => 'Поле "Наименование заявителя (физ. лицо)" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя (физ. лицо)" не должно превышать :max символов.',

            'applicant_passport_data.required_without_all' => 'Поле "Паспортные данные заявителя (физ. лицо)" обязательно для заполнения, если не заполнено поле "Паспортные данные заявителя (юр. лицо)".',
            'applicant_passport_data.string' => 'Поле "Паспортные данные заявителя" должно быть строкой.',
            'applicant_passport_data.max' => 'Поле "Паспортные данные заявителя" не должно превышать :max символов.',

            'applicant_ogrn.required_without_all' => 'Поле "ОГРН / ОГРНИП заявителя (физ. лицо)" обязательно для заполнения, если не заполнено поле "ОГРН / ОГРНИП заявителя (юр. лицо)".',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП заявителя" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП заявителя" не должно превышать :max символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП заявителя" должно содержать только цифры.',

            'applicant_inn.required_without_all' => 'Поле "ИНН заявителя (физ. лицо)" обязательно для заполнения, если не заполнено поле "ИНН заявителя (юр. лицо)".',
            'applicant_inn.string' => 'Поле "ИНН заявителя" должно быть строкой.',
            'applicant_inn.max' => 'Поле "ИНН заявителя" не должно превышать :max символов.',
            'applicant_inn.regex' => 'Поле "ИНН заявителя" должно содержать только цифры.',

            // Сведения о юр. лице
            'applicant_company_name.required_without_all' => 'Поле "Наименование заявителя (физ. лицо)" обязательно для заполнения, если не заполнено поле "Наименование заявителя (юр. лицо)".',
            'applicant_company_name.string' => 'Поле "Наименование заявителя (юр. лицо)" должно быть строкой.',
            'applicant_company_name.max' => 'Поле "Наименование заявителя (юр. лицо)" не должно превышать :max символов.',

            'applicant_company_passport_data.required_without_all' => 'Поле "Паспортные данные заявителя (физ. лицо)" обязательно для заполнения, если не заполнено поле "Паспортные данные заявителя (юр. лицо)".',
            'applicant_company_passport_data.string' => 'Поле "Паспортные данные юр. лица" должно быть строкой.',
            'applicant_company_passport_data.max' => 'Поле "Паспортные данные юр. лица" не должно превышать :max символов.',

            'applicant_company_ogrn.required_without_all' => 'Поле "ОГРН / ОГРНИП юр. лица" обязательно для заполнения, если не заполнено поле "ОГРН / ОГРНИП заявителя (физ. лицо)".',
            'applicant_company_ogrn.string' => 'Поле "ОГРН / ОГРНИП юр. лица" должно быть строкой.',
            'applicant_company_ogrn.max' => 'Поле "ОГРН / ОГРНИП юр. лица" не должно превышать :max символов.',
            'applicant_company_ogrn.regex' => 'Поле "ОГРН / ОГРНИП юр. лица" должно содержать только цифры.',

            'applicant_company_inn.required_without_all' => 'Поле "ИНН юр. лица" обязательно для заполнения, если не заполнено поле "ИНН заявителя (физ. лицо)".',
            'applicant_company_inn.string' => 'Поле "ИНН юр. лица" должно быть строкой.',
            'applicant_company_inn.max' => 'Поле "ИНН юр. лица" не должно превышать :max символов.',
            'applicant_company_inn.regex' => 'Поле "ИНН юр. лица" должно содержать только цифры.',

            // Сведения о представителе
            'applicant_predst_name.string' => 'Поле "ФИО представителя" должно быть строкой.',
            'applicant_predst_name.max' => 'Поле "ФИО представителя" не должно превышать :max символов.',

            'applicant_predst_passport_data.string' => 'Поле "Паспортные данные представителя" должно быть строкой.',
            'applicant_predst_passport_data.max' => 'Поле "Паспортные данные представителя" не должно превышать :max символов.',

            'applicant_predst_ogrn.string' => 'Поле "ОГРН / ОГРНИП представителя" должно быть строкой.',
            'applicant_predst_ogrn.max' => 'Поле "ОГРН / ОГРНИП представителя" не должно превышать :max символов.',
            'applicant_predst_ogrn.regex' => 'Поле "ОГРН / ОГРНИП представителя" должно содержать только цифры.',

            'applicant_predst_inn.string' => 'Поле "ИНН представителя" должно быть строкой.',
            'applicant_predst_inn.max' => 'Поле "ИНН представителя" не должно превышать :max символов.',
            'applicant_predst_inn.regex' => 'Поле "ИНН представителя" должно содержать только цифры.',

            'rep_doc_issued_at.date' => 'Поле "Дата выдачи документа представителя" должно быть датой.',

            // Сведения об объекте
            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой.',
            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения.',


            'object_cadastral_number.required' => 'Поле "Кадастровый номер объекта" обязательно для заполнения.',
            'object_cadastral_number.string' => 'Поле "Кадастровый номер объекта" должно быть строкой.',
            'object_cadastral_number.max' => 'Поле "Кадастровый номер объекта" не должно превышать :max символов.',


            // Сведения о земельном участке
            'land_cadastral_number.required' => 'Поле "Кадастровый номер земельного участка" обязательно для заполнения.',
            'land_cadastral_number.string' => 'Поле "Кадастровый номер земельного участка" должно быть строкой.',
            'land_cadastral_number.max' => 'Поле "Кадастровый номер земельного участка" не должно превышать :max символов.',

            'land_docs.string' => 'Поле "Документы на земельный участок" должно быть строкой.',
            'land_docs.max' => 'Поле "Документы на земельный участок" не должно превышать :max символов.',
            'land_docs.required' => 'Поле "Документы на земельный участок" обязательно для заполнения.',

            // Строительство объекта
            'doc_name.string' => 'Поле "Наименование документа" должно быть строкой.',
            'doc_name.max' => 'Поле "Наименование документа" не должно превышать :max символов.',




            'doc_number.string' => 'Поле "Номер документа" должно быть строкой.',
            'doc_number.max' => 'Поле "Номер документа" не должно превышать :max символов.',

            'doc_date.date' => 'Поле "Дата документа" должно быть датой.',

            // Контактные данные
            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.max' => 'Поле "Телефон" не должно превышать :max символов.',

            'email.email' => 'Поле "Email" должно быть корректным адресом электронной почты.',
            'email.max' => 'Поле "Email" не должно превышать :max символов.',

            'attention_details.string' => 'Поле "Дополнительная информация" должно быть строкой.',

            // Результат предоставления услуги
            'send_result_type.string' => 'Поле "Вид отправки результата" должно быть строкой.',
            'send_result_type.max' => 'Поле "Вид отправки результата" не должно превышать :max символов.',

            'send_mfc_adress.string' => 'Поле "Адрес МФЦ" должно быть строкой.',
            'send_mfc_adress.max' => 'Поле "Адрес МФЦ" не должно превышать :max символов.',
        ];
    }
}

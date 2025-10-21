<?php

namespace App\Http\Requests\GasConnection;

use Illuminate\Foundation\Http\FormRequest;

class GasConnectionSignRequest extends FormRequest
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
            // Данные заявителя
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_ogrn_data' => ['required', 'date'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'applicant_passport_data' => ['required', 'string', 'max:556'],
            'applicant_connect_variants' => ['nullable', 'string', 'max:556'],

            // Контактные данные
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],

            // Земельный участок
            'land_docs' => ['nullable', 'string', 'max:256'],

            // Общие данные
            'reason' => ['nullable', 'string', 'max:256'],
            'object_name' => ['required', 'string', 'max:500'],
            'object_address' => ['required', 'string', 'max:500'],

            // Необходимость дополнительных работ (boolean)
            'need_any_works' => ['nullable', 'boolean'],
            'need_design' => ['nullable', 'boolean'],
            'need_equipment_installation' => ['nullable', 'boolean'],
            'need_pipeline_construction' => ['nullable', 'boolean'],
            'need_meter_installation' => ['nullable', 'boolean'],
            'need_meter_supply' => ['nullable', 'boolean'],
            'need_equipment_supply' => ['nullable', 'boolean'],

            // Параметры потребления газа
            'gas_flow_total' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],
            'gas_flow_new' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],
            'gas_flow_existing' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],
            'planned_date' => ['required', 'date'],

            // Точки подключения
            'connection_point' => ['required', 'integer', 'min:1'],
            'connection_planned_date' => ['required', 'date'],
            'connection_flow_total' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],
            'connection_flow_new' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],
            'connection_flow_existing' => ['required', 'numeric', 'min:0.1', 'max:99999999.99'],

            // Характеристика потребления
            'consumption_type' => ['nullable', 'string', 'max:256'],

            // Ранее выданные тех. условия
            'previous_tech_number' => ['nullable', 'string', 'max:256'],
            'previous_tech_date' => ['nullable', 'date'],

            // Дополнительная информация
            'additional_info' => ['nullable', 'string'],
            'notification_method' => ['nullable', 'string', 'max:256'],
            'attention_details' => ['nullable', 'string'],
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
            // Данные заявителя
            'applicant_name.required' => 'Поле "Заявитель" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Заявитель" должно быть строкой.',
            'applicant_name.max' => 'Поле "Заявитель" не должно превышать :max символов.',

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП" не должно превышать :max символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП" должно содержать только цифры.',

            'applicant_ogrn_data.required' => 'Поле "Дата регистрации ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn_data.date' => 'Поле "Дата регистрации ОГРН / ОГРНИП" должно быть датой.',

            'applicant_address.required' => 'Поле "Адрес заявителя" обязательно для заполнения.',
            'applicant_address.string' => 'Поле "Адрес заявителя" должно быть строкой.',
            'applicant_address.max' => 'Поле "Адрес заявителя" не должно превышать :max символов.',

            'applicant_passport_data.required' => 'Поле "Паспортные данные" обязательно для заполнения.',
            'applicant_passport_data.string' => 'Поле "Паспортные данные" должно быть строкой.',
            'applicant_passport_data.max' => 'Поле "Паспортные данные" не должно превышать :max символов.',

            'applicant_connect_variants.string' => 'Поле "Способы обмена информацией" должно быть строкой.',
            'applicant_connect_variants.max' => 'Поле "Способы обмена информацией" не должно превышать :max символов.',

            // Контактные данные
            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.max' => 'Поле "Телефон" не должно превышать :max символов.',

            'email.email' => 'Поле "Email" должно быть корректным адресом электронной почты.',
            'email.max' => 'Поле "Email" не должно превышать :max символов.',

            // Земельный участок
            'land_docs.string' => 'Поле "Реквизиты проекта межевания" должно быть строкой.',
            'land_docs.max' => 'Поле "Реквизиты проекта межевания" не должно превышать :max символов.',

            // Общие данные
            'reason.string' => 'Поле "Основание для подключения" должно быть строкой.',
            'reason.max' => 'Поле "Основание для подключения" не должно превышать :max символов.',

            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения.',
            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой.',
            'object_name.max' => 'Поле "Наименование объекта" не должно превышать :max символов.',

            'object_address.required' => 'Поле "Адрес объекта" обязательно для заполнения.',
            'object_address.string' => 'Поле "Адрес объекта" должно быть строкой.',
            'object_address.max' => 'Поле "Адрес объекта" не должно превышать :max символов.',

            // Необходимость работ
            'need_any_works.boolean' => 'Поле "Необходимость дополнительных работ" должно быть логическим значением.',
            'need_design.boolean' => 'Поле "Необходимость проектирования" должно быть логическим значением.',
            'need_equipment_installation.boolean' => 'Поле "Необходимость установки оборудования" должно быть логическим значением.',
            'need_pipeline_construction.boolean' => 'Поле "Необходимость реконструкции газопровода" должно быть логическим значением.',
            'need_meter_installation.boolean' => 'Поле "Необходимость установки прибора учета" должно быть логическим значением.',
            'need_meter_supply.boolean' => 'Поле "Необходимость поставки прибора учета" должно быть логическим значением.',
            'need_equipment_supply.boolean' => 'Поле "Необходимость поставки газоиспользующего оборудования" должно быть логическим значением.',

            // Параметры потребления газа
            'gas_flow_total.required' => 'Поле "Величина максимального часового расхода газа (общая)" обязательно для заполнения.',
            'gas_flow_total.numeric' => 'Поле "Величина максимального часового расхода газа (общая)" должно быть числом.',
            'gas_flow_total.min' => 'Поле "Величина максимального часового расхода газа (общая)" не может быть меньше 0.1.',
            'gas_flow_total.max' => 'Поле "Величина максимального часового расхода газа (общая)" слишком большое.',

            'gas_flow_new.required' => 'Поле "Расход газа подключаемого оборудования" обязательно для заполнения.',
            'gas_flow_new.numeric' => 'Поле "Расход газа подключаемого оборудования" должно быть числом.',
            'gas_flow_new.min' => 'Поле "Расход газа подключаемого оборудования" не может быть меньше 0.1.',
            'gas_flow_new.max' => 'Поле "Расход газа подключаемого оборудования" слишком большое.',

            'gas_flow_existing.required' => 'Поле "Расход газа подключенного оборудования" обязательно для заполнения.',
            'gas_flow_existing.numeric' => 'Поле "Расход газа подключенного оборудования" должно быть числом.',
            'gas_flow_existing.min' => 'Поле "Расход газа подключенного оборудования" не может быть меньше 0.1.',
            'gas_flow_existing.max' => 'Поле "Расход газа подключенного оборудования" слишком большое.',

            'planned_date.required' => 'Поле "Планируемый срок ввода в эксплуатацию" обязательно для заполнения.',
            'planned_date.date' => 'Поле "Планируемый срок ввода в эксплуатацию" должно быть датой.',

            // Точки подключения
            'connection_point.required' => 'Поле "Точка подключения" обязательно для заполнения.',
            'connection_point.integer' => 'Поле "Точка подключения" должно быть целым числом.',
            'connection_point.min' => 'Поле "Точка подключения" должно быть не менее :min.',

            'connection_planned_date.required' => 'Поле "Планируемый срок (точка подключения)" обязательно для заполнения.',
            'connection_planned_date.date' => 'Поле "Планируемый срок (точка подключения)" должно быть датой.',

            'connection_flow_total.required' => 'Поле "Итоговая величина расхода газа" обязательно для заполнения.',
            'connection_flow_total.numeric' => 'Поле "Итоговая величина расхода газа" должно быть числом.',
            'connection_flow_total.min' => 'Поле "Итоговая величина расхода газа" не может быть отрицательным.',
            'connection_flow_total.max' => 'Поле "Итоговая величина расхода газа" слишком большое.',

            'connection_flow_new.required' => 'Поле "Величина максимального расхода газа (новое)" обязательно для заполнения.',
            'connection_flow_new.numeric' => 'Поле "Величина максимального расхода газа (новое)" должно быть числом.',
            'connection_flow_new.min' => 'Поле "Величина максимального расхода газа (новое)" не может быть отрицательным.',
            'connection_flow_new.max' => 'Поле "Величина максимального расхода газа (новое)" слишком большое.',

            'connection_flow_existing.required' => 'Поле "Величина максимального расхода газа (существующее)" обязательно для заполнения.',
            'connection_flow_existing.numeric' => 'Поле "Величина максимального расхода газа (существующее)" должно быть числом.',
            'connection_flow_existing.min' => 'Поле "Величина максимального расхода газа (существующее)" не может быть отрицательным.',
            'connection_flow_existing.max' => 'Поле "Величина максимального расхода газа (существующее)" слишком большое.',

            // Характеристика потребления
            'consumption_type.string' => 'Поле "Характеристика потребления газа" должно быть строкой.',
            'consumption_type.max' => 'Поле "Характеристика потребления газа" не должно превышать :max символов.',

            // Ранее выданные тех. условия
            'previous_tech_number.string' => 'Поле "Номер ранее выданных технических условий" должно быть строкой.',
            'previous_tech_number.max' => 'Поле "Номер ранее выданных технических условий" не должно превышать :max символов.',

            'previous_tech_date.date' => 'Поле "Дата ранее выданных технических условий" должно быть датой.',

            // Дополнительная информация
            'additional_info.string' => 'Поле "Дополнительная информация" должно быть строкой.',

            'notification_method.string' => 'Поле "Способ уведомления о подключении" должно быть строкой.',
            'notification_method.max' => 'Поле "Способ уведомления о подключении" не должно превышать :max символов.',

            'attention_details.string' => 'Поле "Описание вложений" должно быть строкой.',
        ];
    }
}

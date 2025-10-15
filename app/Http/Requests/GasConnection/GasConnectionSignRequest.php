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
            'applicant_name' => ['required', 'string', 'max:256'],
            'applicant_ogrn' => ['required', 'string', 'max:256', 'regex:/^\d+$/'],
            'applicant_ogrn_data' => ['required', 'date'],
            'applicant_address' => ['required', 'string', 'max:256'],
            'applicant_passport_data' => ['required', 'string', 'max:556'],
            'phone' => ['required', 'string', 'max:20'],
            'object_name' => ['required', 'string', 'max:500'],
            'object_address' => ['required', 'string', 'max:500'],
            'gas_flow_total' => ['required', 'numeric', 'gt:0'],
            'gas_flow_new' => ['required', 'numeric', 'gt:0'],
            'gas_flow_existing' => ['required', 'numeric', 'gt:0'],
            'planned_date' => ['required', 'date'],
            'connection_point' => ['required', 'integer'],
            'connection_planned_date' => ['required', 'date'],
            'connection_flow_total' => ['required', 'numeric', 'gt:0'],
            'connection_flow_new' => ['required', 'numeric', 'gt:0'],
            'connection_flow_existing' => ['required', 'numeric', 'gt:0'],
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

            'applicant_ogrn.required' => 'Поле "ОГРН / ОГРНИП" обязательно для заполнения.',
            'applicant_ogrn.string' => 'Поле "ОГРН / ОГРНИП" должно быть строкой.',
            'applicant_ogrn.max' => 'Поле "ОГРН / ОГРНИП" не должно превышать 256 символов.',
            'applicant_ogrn.regex' => 'Поле "ОГРН / ОГРНИП" должно содержать только цифры.',

            'applicant_ogrn_data.required' => 'Поле "ОГРН / ОГРНИП (дата регистрации)" обязательно для заполнения.',
            'applicant_ogrn_data.date' => 'Поле "ОГРН / ОГРНИП (дата регистрации)" должно быть датой.',

            'applicant_address.required' => 'Поле "Адрес заявителя" обязательно для заполнения.',
            'applicant_address.string' => 'Поле "Адрес заявителя" должно быть строкой.',
            'applicant_address.max' => 'Поле "Адрес заявителя" не должно превышать 256 символов.',

            'applicant_passport_data.required' => 'Поле "Паспортные данные" обязательно для заполнения.',
            'applicant_passport_data.string' => 'Поле "Паспортные данные" должно быть строкой.',
            'applicant_passport_data.max' => 'Поле "Паспортные данные" не должно превышать 556 символов.',

            'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone.string' => 'Поле "Телефон" должно быть строкой.',
            'phone.max' => 'Поле "Телефон" не должно превышать 20 символов.',

            'object_name.required' => 'Поле "Наименование объекта" обязательно для заполнения.',
            'object_name.string' => 'Поле "Наименование объекта" должно быть строкой.',
            'object_name.max' => 'Поле "Наименование объекта" не должно превышать 500 символов.',

            'object_address.required' => 'Поле "Адрес (местоположение) объекта" обязательно для заполнения.',
            'object_address.string' => 'Поле "Адрес (местоположение) объекта" должно быть строкой.',
            'object_address.max' => 'Поле "Адрес (местоположение) объекта" не должно превышать 500 символов.',

            'gas_flow_total.required' => 'Поле "Величина максимального часового расхода газа (мощности)" обязательно для заполнения.',
            'gas_flow_total.numeric' => 'Поле "Величина максимального часового расхода газа (мощности)" должно быть числом.',
            'gas_flow_total.gt' => 'Поле "Величина максимального часового расхода газа (мощности)" должно быть больше нуля.',

            'gas_flow_new.required' => 'Поле "Величина максимального часового расхода газа (мощности) подключаемого газоиспользующего оборудования" обязательно для заполнения.',
            'gas_flow_new.numeric' => 'Поле "Величина максимального часового расхода газа (мощности) подключаемого газоиспользующего оборудования" должно быть числом.',
            'gas_flow_new.gt' => 'Поле "Величина максимального часового расхода газа (мощности) подключаемого газоиспользующего оборудования" должно быть больше нуля.',

            'gas_flow_existing.required' => 'Поле "Величина максимального часового расхода газа (мощности) подключенного газоиспользующего оборудования" обязательно для заполнения.',
            'gas_flow_existing.numeric' => 'Поле "Величина максимального часового расхода газа (мощности) подключенного газоиспользующего оборудования" должно быть числом.',
            'gas_flow_existing.gt' => 'Поле "Величина максимального часового расхода газа (мощности) подключенного газоиспользующего оборудования" должно быть больше нуля.',

            'planned_date.required' => 'Поле "Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства" обязательно для заполнения.',
            'planned_date.date' => 'Поле "Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства" должно быть датой.',

            'connection_point.required' => 'Поле "Точка подключения" обязательно для заполнения.',
            'connection_point.integer' => 'Поле "Точка подключения" должно быть целым числом.',

            'connection_planned_date.required' => 'Поле "Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства, в том числе по этапам и очередям (месяц, год)" обязательно для заполнения.',
            'connection_planned_date.date' => 'Поле "Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства, в том числе по этапам и очередям (месяц, год)" должно быть датой.',

            'connection_flow_total.required' => 'Поле "Итоговая величина максимального часового расхода газа" обязательно для заполнения.',
            'connection_flow_total.numeric' => 'Поле "Итоговая величина максимального часового расхода газа" должно быть числом.',
            'connection_flow_total.gt' => 'Поле "Итоговая величина максимального часового расхода газа" должно быть больше нуля.',

            'connection_flow_new.required' => 'Поле "Величина максимального расхода газа" обязательно для заполнения.',
            'connection_flow_new.numeric' => 'Поле "Величина максимального расхода газа" должно быть числом.',
            'connection_flow_new.gt' => 'Поле "Величина максимального расхода газа" должно быть больше нуля.',

            'connection_flow_existing.required' => 'Поле "Величина максимального часового расхода газа" обязательно для заполнения.',
            'connection_flow_existing.numeric' => 'Поле "Величина максимального часового расхода газа" должно быть числом.',
            'connection_flow_existing.gt' => 'Поле "Величина максимального часового расхода газа" должно быть больше нуля.',
        ];
    }
}

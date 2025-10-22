<?php

namespace App\Http\Requests\WaterConnection;

use Illuminate\Foundation\Http\FormRequest;

class WaterConnectionDraftRequest extends FormRequest
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
            // Организация/заявитель (основные сведения)
            'supplier_org' => ['nullable', 'string', 'max:256'],
            'applicant_name' => ['nullable', 'string', 'max:256'],
            'address' => ['nullable', 'string', 'max:256'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],

            // Заявление
            'object_name' => ['nullable', 'string', 'max:256'],
            'object_address' => ['nullable', 'string', 'max:256'],
            'object_description' => ['nullable', 'string'],

            // Нагрузки (все обязательные числовые поля)
            'payload_all_snab' => [ 'numeric', 'min:0'],
            'payload_all_ot' => [ 'numeric', 'min:0'],
            'payload_hoz_snab' => [ 'numeric', 'min:0'],
            'payload_hoz_ot' => [ 'numeric', 'min:0'],
            'payload_prom_snab' => [ 'numeric', 'min:0'],
            'payload_prom_ot' => [ 'numeric', 'min:0'],
            'payload_fire_snab' => [ 'numeric', 'min:0'],
            'payload_fire_ot' => [ 'numeric', 'min:0'],
        ];
    }


    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'supplier_org.nullable' => 'Поле "Организация/поставщик" обязательно для заполнения',
            'supplier_org.max' => 'Поле "Организация/поставщик" не должно превышать 256 символов',

            'applicant_name.nullable' => 'Поле "ФИО заявителя" обязательно для заполнения',
            'applicant_name.max' => 'Поле "ФИО заявителя" не должно превышать 256 символов',

            'address.nullable' => 'Поле "Адрес" обязательно для заполнения',
            'address.max' => 'Поле "Адрес" не должно превышать 256 символов',

            'phone.nullable' => 'Поле "Телефон" обязательно для заполнения',
            'phone.max' => 'Поле "Телефон" не должно превышать 20 символов',

            'email.nullable' => 'Поле "Email" обязательно для заполнения',
            'email.email' => 'Поле "Email" должно содержать корректный адрес электронной почты',
            'email.max' => 'Поле "Email" не должно превышать 100 символов',

            'object_name.nullable' => 'Поле "Название объекта" обязательно для заполнения',
            'object_name.max' => 'Поле "Название объекта" не должно превышать 256 символов',

            'object_address.nullable' => 'Поле "Адрес объекта" обязательно для заполнения',
            'object_address.max' => 'Поле "Адрес объекта" не должно превышать 256 символов',

            'object_description.nullable' => 'Поле "Описание объекта" обязательно для заполнения',

            'payload_all_snab.nullable' => 'Поле "Общая нагрузка на водоснабжение" обязательно для заполнения',
            'payload_all_snab.numeric' => 'Поле "Общая нагрузка на водоснабжение" должно быть числом',
            'payload_all_snab.min' => 'Поле "Общая нагрузка на водоснабжение" должно быть больше или равно 0',

            'payload_all_ot.nullable' => 'Поле "Общая нагрузка на водоотведение" обязательно для заполнения',
            'payload_all_ot.numeric' => 'Поле "Общая нагрузка на водоотведение" должно быть числом',
            'payload_all_ot.min' => 'Поле "Общая нагрузка на водоотведение" должно быть больше или равно 0',

            'payload_hoz_snab.nullable' => 'Поле "Нагрузка на хозяйственные нужды (водоснабжение)" обязательно для заполнения',
            'payload_hoz_snab.numeric' => 'Поле "Нагрузка на хозяйственные нужды (водоснабжение)" должно быть числом',
            'payload_hoz_snab.min' => 'Поле "Нагрузка на хозяйственные нужды (водоснабжение)" должно быть больше или равно 0',

            'payload_hoz_ot.nullable' => 'Поле "Нагрузка на хозяйственные нужды (водоотведение)" обязательно для заполнения',
            'payload_hoz_ot.numeric' => 'Поле "Нагрузка на хозяйственные нужды (водоотведение)" должно быть числом',
            'payload_hoz_ot.min' => 'Поле "Нагрузка на хозяйственные нужды (водоотведение)" должно быть больше или равно 0',

            'payload_prom_snab.nullable' => 'Поле "Нагрузка на производственные нужды (водоснабжение)" обязательно для заполнения',
            'payload_prom_snab.numeric' => 'Поле "Нагрузка на производственные нужды (водоснабжение)" должно быть числом',
            'payload_prom_snab.min' => 'Поле "Нагрузка на производственные нужды (водоснабжение)" должно быть больше или равно 0',

            'payload_prom_ot.nullable' => 'Поле "Нагрузка на производственные нужды (водоотведение)" обязательно для заполнения',
            'payload_prom_ot.numeric' => 'Поле "Нагрузка на производственные нужды (водоотведение)" должно быть числом',
            'payload_prom_ot.min' => 'Поле "Нагрузка на производственные нужды (водоотведение)" должно быть больше или равно 0',

            'payload_fire_snab.nullable' => 'Поле "Нагрузка на пожарные нужды (водоснабжение)" обязательно для заполнения',
            'payload_fire_snab.numeric' => 'Поле "Нагрузка на пожарные нужды (водоснабжение)" должно быть числом',
            'payload_fire_snab.min' => 'Поле "Нагрузка на пожарные нужды (водоснабжение)" должно быть больше или равно 0',

            'payload_fire_ot.nullable' => 'Поле "Нагрузка на пожарные нужды (водоотведение)" обязательно для заполнения',
            'payload_fire_ot.numeric' => 'Поле "Нагрузка на пожарные нужды (водоотведение)" должно быть числом',
            'payload_fire_ot.min' => 'Поле "Нагрузка на пожарные нужды (водоотведение)" должно быть больше или равно 0',
        ];
    }


}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Поле Email должно быть заполнено',
            'email.email' => 'Введенная строка не является адресом электронной почты',
            'email.exists' => 'Не верный логин или пароль',
            'password.required' => 'Поле Пароль должно быть заполнено',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'exists:users,email'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name.required' => 'Поле Имя должно быть заполнено',
            'phone.required' => 'Поле Телефон должно быть заполнено',
            'email.required' => 'Поле Email должно быть заполнено',
            'email.unique' => 'Пользователь с таким Email уже зарегистрирован',
            'password.required' => 'Поле Пароль должно быть заполнено',
            'password.confirmed' => 'Парольи не совпадают',
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
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => ['required','confirmed'],
        ];
    }
}

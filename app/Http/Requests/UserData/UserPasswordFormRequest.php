<?php

namespace App\Http\Requests\UserData;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordFormRequest extends FormRequest
{

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */

     public function messages()
     {
         return [
             'password.required' => 'Поле "Пароль" должно быть заполнено',
             'password.min' => 'Поле "Пароль" должно быть минимум 2 символа',
             'password.confirmed' => 'Поле "Пароль" должно быть подтверждено',
         ];
     }

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
            "password" => [ 'required', 'min:2', 'confirmed' ]
        ];
    }
}

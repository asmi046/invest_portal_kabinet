<?php

namespace App\Http\Requests\LandAuctionApplication;

use Illuminate\Foundation\Http\FormRequest;

class LandAuctionApplicationDraftRequest extends FormRequest
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
            'area' => ['required', 'numeric', 'gt:0'],

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
            'applicant_name.required' => 'Поле "Наименование заявителя" обязательно для заполнения.',
            'applicant_name.string' => 'Поле "Наименование заявителя" должно быть строкой.',
            'applicant_name.max' => 'Поле "Наименование заявителя" не должно превышать 256 символов.',


            'area.required' => 'Поле "Площадь земельного участка" обязательно для заполнения.',
            'area.numeric' => 'Поле "Площадь земельного участка" должно быть числом.',
            'area.gt' => 'Поле "Площадь земельного участка" должно быть больше нуля.',

        ];
    }
}

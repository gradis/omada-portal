<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'firstName' => 'required|string',
            'secondName' => 'required|string',
            'middleName' => 'nullable|string',
            'number' => 'required|integer|unique:users,number',
            'password' => 'required|min:8',
            'user_group' => 'required|integer',
            'haveAccess' => 'boolean',
        ];
    }

    public function messages(): array {
        return [
            'password.required' => 'Введите пароль!',
            'number.unique' => 'Такой номер пропуска уже записан в базу данных!'
        ];
    }
}

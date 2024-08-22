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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Это поле обязательно для заполнения',
            'email.email' => 'Некорректная почта',
            'email.unique' => 'Такая почта уже занята',
            'password.required' => 'Это поле обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее 8 символов',
            'password.regex' => 'Пароль должен содержать хотя бы одну букву и цифру',
            'password_confirmation.required' => 'Это поле обязательно для заполнения',
            'password_confirmation.same' => 'Пароли не совпадают',];
    }
}

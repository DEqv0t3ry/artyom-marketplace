<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'email',
                Rule::unique('users')->ignore($this->user),],
            'password' => 'nullable|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Пользователь с таким email уже существует',
            'email.email' => 'Некорректный email',
            'password.min' => 'Пароль должен содержать не менее 8 символов',
            'password.regex' => 'Пароль должен содержать буквы и цифры',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone' => [new PhoneRule],
            'count' => 'required|min:1|max:100000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.max' => 'Имя должно быть не более 100 символов',
            'email.required' => 'Поле "E-mail" обязательно для заполнения',
            'email.email' => 'Неверный формат E-mail',
            'email.max' => 'E-mail должен быть не более 100 символов',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения',
            'count.required' => 'Поле "Количество" обязательно для заполнения',
            'count.min' => 'Количество должно быть больше 0',
            'count.max' => 'Количество должно быть не более 100000',
        ];
    }
}

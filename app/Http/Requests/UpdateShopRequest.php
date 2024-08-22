<?php

namespace App\Http\Requests;

use App\Rules\ExistInnRule;
use App\Rules\InnRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
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
            'name' => 'max:200',
            'inn' => [new InnRule, new ExistInnRule],
            'address' => 'min:20',
            'phone' => 'max:100',
            'logo' => 'image|mimes:jpg,jpeg,webp|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'Поле "Наименование продавца" не может быть больше 200 символов',
            'address.min' => 'Поле "Адрес" должно содержать не менее 20 символов',
            'phone.max' => 'Поле "Телефон" не может быть больше 100 символов',
            'logo.image' => 'Логотип должен быть изображением',
            'logo.mimes' => 'Логотип должен быть в формате jpg, jpeg или webp',
            'logo.max' => 'Логотип не может быть больше 2 МБ',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'min:3|max:100',
            'price' => 'numeric|min:1',
            'short_description' => 'max:100',
            'main_description' => 'max:10000',
            'unit_id' => '',
            'photo' => 'image|mimes:jpg,jpeg,webp|max:2048',
            'images.*' => 'image|mimes:jpg,jpeg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Поле "Название" должно содержать не менее 3 символов',
            'name.max' => 'Поле "Название" не может быть больше 100 символов',
            'price.numeric' => 'Поле "Цена" должно содержать только цифры',
            'price.min' => 'Поле "Цена" должно быть больше 0',
            'short_description.max' => 'Поле "Краткое описание" не может быть больше 100 символов',
            'main_description.max' => 'Поле "Описание" не может быть больше 10000 символов',
            'photo.image' => 'Фотография-анонс должна быть изображением',
            'photo.mimes' => 'Фотография-анонс должна быть в формате jpg, jpeg или png',
            'photo.max' => 'Фотография-анонс не может быть больше 2 мегабайт',
            'images.*.image' => 'Фотографии должны быть изображениями',
            'images.*.mimes' => 'Фотографии должны быть в формате jpg, jpeg или png',
            'images.*.max' => 'Фотографии не могут быть больше 2 мегабайт',
        ];
    }
}

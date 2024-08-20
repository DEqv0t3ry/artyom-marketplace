<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;
use MoveMoveIo\DaData\Facades\DaDataCompany;

class InnRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/\d{10}/', $value)) {
            $fail('Неверный формат ИНН');
        }
        if(!isset($value) || empty($value)) {
            $fail('ИНН не может быть пустым');
        }
        if (!DaDataCompany::id($value, 1, null, BranchType::MAIN, CompanyType::LEGAL)['suggestions']) {
            $fail('ИНН не найден в базе');
        }
    }
}

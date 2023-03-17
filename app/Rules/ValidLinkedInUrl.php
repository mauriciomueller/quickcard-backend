<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidLinkedInUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = '/^https:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9_-]+$/';
        if (!preg_match($pattern, $value)) {
            $fail('Your LinkedIn URL is invalid.');
        }
    }
}

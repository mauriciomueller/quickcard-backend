<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidGitHubUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = '/^https:\/\/(www\.)?github\.com\/[a-zA-Z0-9_-]+$/';
        if (!preg_match($pattern, $value)) {
            $fail('Your GitHub URL is invalid.');
        }
    }


}

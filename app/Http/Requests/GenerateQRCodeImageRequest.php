<?php

namespace App\Http\Requests;


use App\Rules\ValidGitHubUrl;
use App\Rules\ValidLinkedInUrl;

class GenerateQRCodeImageRequest extends CustomFormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:50',
            'linkedInUrl' => ['required', 'url', new ValidLinkedInUrl(), 'max:150'],
            'gitHubUrl' => ['required', 'url', new ValidGitHubUrl(), 'max:150'],
        ];
    }
}

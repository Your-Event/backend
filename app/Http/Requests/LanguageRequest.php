<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for query parameters.
     *
     * @return array<string, array|string>
     */
    public function rules(): array
    {
        return [
            'lang' => ['sometimes', 'string', 'in:hy,en,ru'],
        ];
    }
}

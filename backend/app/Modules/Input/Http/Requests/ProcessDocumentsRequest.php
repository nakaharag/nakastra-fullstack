<?php

namespace App\Modules\Input\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

use Illuminate\Validation\Rules\File;

class ProcessDocumentsRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'document' => ['required', File::types(['csv'])->max('512mb')]
        ];
    }

    protected function failedValidation($validator)
    {
        throw ValidationException::withMessages([
            'message' => $validator->messages()->first(),
        ]);
    }
}

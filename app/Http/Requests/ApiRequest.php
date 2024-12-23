<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dateFrom' => 'required|date_format:Y-m-d',
            'dateTo' => 'required|date_format:Y-m-d',
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'dateFrom.required' => 'The start date is required.',
            'dateTo.required' => 'The end date is required.',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'page' => $this->page ?? 1,
            'limit' => $this->limit ?? 500,
        ]);
    }
}

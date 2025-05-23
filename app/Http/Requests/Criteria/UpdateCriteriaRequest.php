<?php

namespace App\Http\Requests\Criteria;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCriteriaRequest extends FormRequest
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
            'criteria_type' => 'nullable|in:Rapi,Resik,Rawat,Rajin,Ringkas',
            'criteria_name' => 'nullable|string|max:255',
            'location_id' => 'nullable|exists:locations,id',
        ];
    }
}

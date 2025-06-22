<?php

namespace App\Http\Requests\Inspection;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInspectionRequest extends FormRequest
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
            'worker_id' => ['nullable', 'exists:users,id'],
            'pic_id' => ['nullable', 'exists:users,id'],
            'criteria_id' => ['nullable', 'exists:criterias,id'],
            'finding_paths' => ['nullable', 'array'],
            'finding_paths.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'findings_description' => ['nullable', 'string'],
            'inspection_location' => ['nullable', 'string'],
            'is_valid_entry' => ['nullable', 'boolean'],
            'memo_id' => ['nullable', 'exists:documents,id'],
            'value' => ['nullable', 'string'],
            'suitability' => ['nullable', 'boolean'],
            'checkup_date' => ['nullable', 'date'],
            'action_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'action_description' => ['nullable', 'string'],
        ];
    }
}

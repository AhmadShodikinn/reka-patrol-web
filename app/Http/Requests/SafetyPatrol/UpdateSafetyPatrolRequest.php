<?php

namespace App\Http\Requests\SafetyPatrol;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSafetyPatrolRequest extends FormRequest
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
            'findings_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'findings_description' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],
            'category' => ['nullable', 'in:UC,CA'],
            'risk' => ['nullable', 'string'],
            'checkup_date' => ['nullable', 'date'],
            'action_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'action_description' => ['nullable', 'string'],
        ];
    }
}

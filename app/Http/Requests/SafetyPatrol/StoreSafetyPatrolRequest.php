<?php

namespace App\Http\Requests\SafetyPatrol;

use Illuminate\Foundation\Http\FormRequest;

class StoreSafetyPatrolRequest extends FormRequest
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
            'finding_paths' => ['required', 'array'],
            'finding_paths.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'findings_description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'category' => ['required', 'in:Unsafe Condition,Unsafe Action'],
            'memo_id' => ['nullable', 'exists:documents,id'],
            'risk' => ['required', 'string'],
            'checkup_date' => ['required', 'date'],
            'action_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'action_description' => ['nullable', 'string'],
        ];
    }
}

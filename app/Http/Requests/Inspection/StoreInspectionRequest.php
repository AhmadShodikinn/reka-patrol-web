<?php

namespace App\Http\Requests\Inspection;

use App\Models\Inspection;
use Illuminate\Foundation\Http\FormRequest;

class StoreInspectionRequest extends FormRequest
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
            'criteria_id' => ['required', 'exists:criterias,id'],
            'finding_paths' => ['required', 'array'],
            'finding_paths.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'findings_description' => ['required', 'string'],
            'inspection_location' => ['required', 'string'],
            'value' => ['required', 'string'],
            'suitability' => ['required', 'boolean'],
            'checkup_date' => ['required', 'date'],
            'action_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'action_description' => ['nullable', 'string'],
        ];
    }
    
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $criteriaInMonth = Inspection::where('criteria_id', $this->criteria_id)
                ->whereMonth('created_at', now()->month)
                ->first();
            
            if ($criteriaInMonth) {
                $validator->errors()->add('criteria_id', 'You already input this criteria in the current month.');
            }
        });
    }
}

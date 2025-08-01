<?php

namespace App\Http\Requests\Escort;

use Illuminate\Foundation\Http\FormRequest;

class StorePinupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pinup_profile_id' => 'required',
            'pinup_week' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'pinup_profile_id.required' => 'Profile field is required.',
            'pinup_week.required' => 'Next available field is required.',
        ];
    }
}

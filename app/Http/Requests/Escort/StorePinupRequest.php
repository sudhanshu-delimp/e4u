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
        $rules =  [
            'pinup_profile_id' => 'required',
            'pinup_week' => 'required',
        ];
        // If user doesn't have a default pinup image, require it
        if (!$this->user()?->defaultPinupImage) {
            $rules['pinup_image'] = ['required', 'image', 'max:2048'];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'pinup_profile_id.required' => 'Profile field is required.',
            'pinup_week.required' => 'Next available field is required.',
            'pinup_image.required' => 'To list a Pin Up, you must have uploaded your Pin Up image.  See Media.',
        ];
    }
}

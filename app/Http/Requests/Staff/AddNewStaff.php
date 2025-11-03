<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class AddNewStaff extends FormRequest
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
    public function rules()
    {
        return [
            'name'   => 'bail|required|string|max:100',
            'address' => 'bail|required|string|max:255',
            'phone'           => 'bail|required|min:10|max:14|unique:users,phone',
            'email'           => 'bail|required|email|max:100|email:rfc,filter|unique:users,email',
            'genders'  => 'bail|required|in:1,2,3,4,6',
            'kin_name'   => 'bail|required|string|max:100',
            'kin_relationship'   => 'bail|required|string|max:100',
            'kin_mobile'   => 'required||min:10|max:14',
            'kin_email'   => 'nullable|email:rfc,filter|max:100',
        ];
    }

    public function messages()
    {
        return [
            'state_id.required'  => 'please select your territory.',
            'state_id.exists'  => 'please select your territory.',
            'genders.required'  => 'The gender field is required.',
            'email.required'  => 'The private email field is required.',
            'kin_name.required'  => 'The kin of name field is required.',
            'kin_relationship.required'  => 'The kin of relationship field is required.',
            'kin_mobile.required'  => 'The kin of mobile field is required.',
            'kin_email.required'  => 'The kin of email field is required.',
            'kin_email.email'  => 'The kin of email must be a valid email address',
            
        ];
    }
}

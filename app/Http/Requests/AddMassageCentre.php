<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMassageCentre extends FormRequest
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

        $centerId = $this->center_id;
        return
        [
            'join_date' => $centerId ? 'nullable|date_format:d-m-Y' : 'required|date_format:d-m-Y',
            'name'              => 'required|string|max:255',
            'entity_name'       => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email,' . $centerId,

            'business_address'  => 'required|string|max:255',
            'business_number'   => 'required|digits_between:10,15',

            'phone' => 'required|min:10|max:14|unique:users,phone,' . $centerId,

            'contact_type'      => 'nullable|array',
            'contact_type.*'    => 'in:1,2,3,4',

            'password' => [
                $centerId ? 'nullable' : 'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],

            'confirm_password' => [
                $centerId ? 'nullable' : 'required',
                'same:password'
            ],
       ];
    }


    public function messages()
    {
        return [
            'join_date.required'        => 'Join date is required.',
            'join_date.date_format'     => 'Join date format should be DD-MM-YYYY.',

            'name.required'             => 'Name is required.',
            'entity_name.required'      => 'Entity name is required.',

            'email.required'            => 'Email is required.',
            'email.email'               => 'Enter a valid email address.',
            'email.unique'              => 'This email already exists.',

            'business_address.required' => 'Business address is required.',

            'business_number.required'  => 'Business number is required.',
            'business_number.digits_between' => 'Business number must be between 10 to 15 digits.',

            'phone.required'            => 'Phone number is required.',
            'phone.unique'              => 'This phone number already exists.',
            'phone.min'                 => 'Phone number must be at least 10 digits.',
            'phone.max'                 => 'Phone number must not exceed 14 digits.',

            'contact_type.*.in'         => 'Invalid contact type selected.',

            'password.required'         => 'Password is required.',
            'password.min'              => 'Password must be at least 8 characters.',
            'password.regex'            => 'Password must contain uppercase, lowercase, number and special character.',

            'confirm_password.required' => 'Confirm password is required.',
            'confirm_password.same'     => 'Confirm password does not match.',
        ];
    }

}

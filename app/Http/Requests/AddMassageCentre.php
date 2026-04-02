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
       return [
            'join_date'         => 'required|date_format:d-m-Y',
            'name'              => 'required|string|max:255',
            'entity_name'       => 'required|string|max:255',
            'email'             => 'required|email|max:255|unique:users,email',
            'business_address'  => 'required|string|max:255',
            'business_number'   => 'required|digits_between:10,15',
            'phone'             => 'required|min:10|max:14|unique:users,phone',
            'contact_type'   => 'nullable|array',
            'contact_type.*' => 'in:1,2,3,4',
           
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'display name is required',
            'business_number.required'  => 'business number field is required.',
            'business_address.required'  => 'address is required.',
            'phone.required'  => 'mobile number is required.',
           
        ];
    }

}

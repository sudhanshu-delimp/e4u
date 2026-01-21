<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddNewOperator extends FormRequest
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
    public function rules(Request $request)
    {
        $userId = null;
        if (isset($request->user_id)) {
            $userId = $request->user_id;
        }

        return [
            'company_name' => 'bail|required|string|max:100',
            'business_name' => 'bail|required|string|max:100',
            'abn' => 'required|digits:11',
            'business_address' => 'bail|required|string|max:255',
            'business_number' => "bail|required|min:10|max:14",
            'point_of_contact' => 'bail|required|string|max:100', // Point of contact
            'phone' => "bail|required|min:10|max:14|unique:users,phone,{$userId}", //Mobile
            'email' => "bail|required|email|max:100|email:rfc,filter|unique:users,email,{$userId}",
            'state_id' => 'required',
            'contact_type' => 'required',
            'agreement_date' => 'bail|required|date|date_format:d-m-Y',
            'date_appointed' => 'nullable|date|date_format:d-m-Y',
            'term' => 'required|string|max:255',
            //'fee' => 'required|integer',
            'fee' => 'required|',
            'commission_advertising_percent' => 'bail|required|integer|between:1,100',
            'commission_massage_centre_percent' => 'bail|required|integer|between:1,100',
        ];
    }

    public function messages()
    {
        return [
            'contact_type.required' => 'The method of Contact field is required.',
            'phone.required' => 'The phone number field is required.',
            'point_of_contact.required' => 'The point of contact field is required.',
            'state_id.required' => 'please select your territory.',
            'state_id.exists' => 'please select your territory.',
            'commission_advertising_percent.required' => 'The advertising commission field is required.',
            'commission_massage_centre_percent.required' => 'The massage centre commission field is required.',
            'commission_advertising_percent.integer ' => 'The advertising commission must be an integer.',
            'commission_massage_centre_percent.integer' => 'The massage centre commission must be an integer.',
            'commission_advertising_percent.between' => 'The advertising commission must be between 1 and 100.',
            'commission_massage_centre_percent.between' => 'The massage centre commission must be between 1 and 100.',
        ];
    }
}

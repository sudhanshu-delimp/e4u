<?php

namespace App\Http\Requests\Operator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            //'company_name' => 'bail|required|string|max:100',
            'company_name' => ['bail', 'required', 'string', 'max:100', Rule::unique('users', 'name')->where('type', 7)->ignore($userId)],
            'business_name' => 'bail|required|string|max:100',
            'abn' => 'required|digits:11',
            'business_address' => 'bail|required|string|max:255',
            'business_number' => "bail|required|min:10|max:14",
            'point_of_contact' => 'bail|required|string|max:100', // Point of contact
            //'phone' => "bail|required|min:10|max:14|unique:users,phone,{$userId}", //Mobile
            'phone' => "bail|required|min:10|max:14", //Mobile
            //'email' => "bail|required|email|max:100|email:rfc,filter|unique:users,email,{$userId}",
            'email' => "bail|required|email|max:100|email:rfc,filter",
            //'state_id' => 'required',
            'country_id' => 'required',
            'contact_type' => 'required',
            'agreement_date' => 'bail|required|date|date_format:d-m-Y',
            'date_appointed' => 'nullable|date|date_format:d-m-Y',
            'term' => 'required|string|max:255',
            //'fee' => 'required|integer',
            'fee' => 'required',
            //'commission_advertising_percent' => 'bail|required|integer|between:1,100',
            //'commission_massage_centre_percent' => 'bail|required|integer|between:1,100',
            'advertising_commission_type' => 'required',
            'massge_centre_commission_type' => 'required',
            'agreement_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'commission_advertising_percent' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->advertising_commission_type === 'percent' && $value > 100) {
                        $fail('The advertising commission percentage cannot be greater than 100 if the amount type is Percent.');
                    }
                },
            ],

            'commission_massage_centre_percent' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->commission_registration_type === 'percent' && $value > 100) {
                        $fail('The registration commission percentage cannot be greater than 100 if the amount type is Percent.');
                    }
                },
            ],
        
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('abn')) {
            $this->merge([
                'abn' => preg_replace('/\D/', '', $this->input('abn')),
            ]);
        }

        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/\D/', '', $this->input('phone')),
            ]);
        }
    }

    

    public function messages()
    {
        return [
            'contact_type.required' => 'The method of Contact field is required.',
            'phone.required' => 'The mobile number field is required.',
            'point_of_contact.required' => 'The point of contact field is required.',
            'country_id.required' => 'please select your territory.',
            'country_id.exists' => 'please select your territory.',
            'state_id.required' => 'please select your territory.',
            'state_id.exists' => 'please select your territory.',
            'commission_advertising_percent.required' => 'The advertising commission field is required.',
            'commission_massage_centre_percent.required' => 'The massage centre commission field is required.',
            'commission_advertising_percent.integer ' => 'The advertising commission must be an integer.',
            'commission_massage_centre_percent.integer' => 'The massage centre commission must be an integer.',
            'commission_advertising_percent.between' => 'The advertising commission must be between 1 and 100.',
            'commission_massage_centre_percent.between' => 'The massage centre commission must be between 1 and 100.',
            'agreement_file.required' => 'Please upload a file.',
            'agreement_file.file' => 'The agreement file must be a valid file.',
            'agreement_file.mimes' => 'Only PDF, JPG, JPEG, and PNG files are allowed.',
            'agreement_file.max' => 'The file size must not exceed 5MB.',
            'advertising_commission_type.required'  => 'Amount type field is required.',
            'massge_centre_commission_type.required'  => 'Amount type field is required.',
        ];
    }
}

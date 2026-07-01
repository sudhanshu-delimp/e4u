<?php

namespace App\Http\Requests\Agent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddNewAgent extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'business_number' => str_replace(' ', '', $this->business_number),
        ]);
        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/\D/', '', $this->input('phone')),
            ]);
        }
   }


    public function rules(Request $request)
    {
        $agentId = $this->user_id ?? '';

        return [
            'business_name'   => 'required|string|max:255',
            'business_number' => 'digits_between:10,15|unique:users,business_number,' . $agentId,
            'contact_person'  => 'required|string|max:255',
            'phone'           => 'required|min:10|max:14|unique:users,phone,' . $agentId,
            'email'           => 'required|email|max:255|unique:users,email,' . $agentId,
            'email2'          => 'required|email|max:255|unique:users,email2,' . $agentId,
            'state_id'        => 'required|exists:states,id',
            'agreement_date'  => 'required|date',
            'commission_advertising_type'  => 'required',
            'commission_registration_type'  => 'required',
            'commission_advertising_percent' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->commission_advertising_type === 'percent' && $value > 100) {
                        $fail('The advertising commission percentage cannot be greater than 100.');
                    }
                },
            ],

            'commission_registration_amount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->commission_registration_type === 'percent' && $value > 100) {
                        $fail('The registration commission percentage cannot be greater than 100.');
                    }
                },
            ],
            //'abn' => 'nullable|digits_between:10,20',
            'abn' => 'required|digits:11',
        ];
    }


    public function messages()
    {
        return [
            'state_id.required'  => 'Please select your territory.',
            'state_id.exists'  => 'Please select your territory.',
            'email2.required'  => 'The e4u email field is required.',
            'email2.unique'  => 'The e4u email has already been taken.',
            'commission_advertising_type.required'  => 'Amount type field is required.',
            'commission_registration_type.required'  => 'Amount type field is required.',
            'commission_advertising_percent.required'  => 'The advertising commission field is required.',
            'commission_registration_amount.required'  => 'The registration commission field is required.',
            'abn.digits' => 'The ABN must contain only digits (0-9) and 11 digits long.',

            'commission_advertising_percent.numeric'  => 'The advertising commission must be a number.',
            'commission_registration_amount.numeminric'  => 'The registration commission must be a number.',
            'commission_advertising_percent.min'  => 'The advertising commission must be at least 0.',
            'commission_registration_amount.min'  => 'The registration commission must be at least 0.',
            'abn.digits_between' => 'The ABN must contain only digits (0-9) and be between 10 and 20 digits long.'
        ];
    }
}

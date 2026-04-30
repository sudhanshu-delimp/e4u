<?php

namespace App\Http\Requests\Shareholding;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
//use Illuminate\Validation\Rule;

class AddNewShareholding extends FormRequest
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
            'shareholder_id' => 'required',
            'member_id' => 'required',
            'date_of_entry' => 'required',
            'member_type' => 'required',
            'threshold' => 'required',
            'number_of_shares' => 'required',
            'shareholding' => 'required',
            'held_on_trust' => 'required',

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
        if ($this->has('key_contact_phone')) {
            $this->merge([
                'key_contact_phone' => array_map(function ($value) {
                    return preg_replace('/\D/', '', $value); // remove spaces, symbols
                }, $this->input('key_contact_phone'))
            ]);
        }
    }

    public function messages()
    {
        return [
            'business_name.required' => 'The shareholder name field is required.',
            'business_name.max' => 'The Shareholder name must not be greater than 100 characters.',
            'business_address.required' => 'The address field is required.',
            'contact_person.required' => 'The primary contact name field is required.',
            'contact_type.required' => 'The method of Contact field is required.',
            'phone.required' => 'The primary mobile number field is required.',
            'email.required' => 'The primary email address field is required.',
            'phone.*.min' => 'The primary mobile number field minimum 10 digits.',
            'phone.*.max' => 'The primary mobile number field minimum 14 digits.',
            'point_of_contact.required' => 'The point of contact field is required.',
            'key_contact_name.*.required' => 'The key contact name field is required.',
            'key_contact_phone.*.required' => 'The key contact mobile number field is required.',
            'key_contact_phone.*.digits' => 'The key contact mobile number field must be 10 digits.',
            'key_contact_email.*.required' => 'The key contact email field is required.',
            'key_contact_email.*.email' => 'The key contact email must be a valid email address.',
        ];
    }
}

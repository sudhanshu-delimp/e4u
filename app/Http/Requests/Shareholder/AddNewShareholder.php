<?php

namespace App\Http\Requests\Shareholder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
//use Illuminate\Validation\Rule;

class AddNewShareholder extends FormRequest
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
            'contact_person' => 'bail|required|string|max:100',
            'business_name' => 'bail|required|string|max:100',
            'business_address' => 'bail|required|string|max:255',
            'phone' => "bail|required|min:10|max:14|unique:users,phone,{$userId}", //Mobile
            'email' => "bail|required|email|max:50|email:rfc,filter|unique:users,email,{$userId}",
            'contact_type' => 'required',
            'key_contact_name.*' => 'sometimes|required|string|max:100',
            'key_contact_phone.*'  => 'sometimes|required|digits:10',
            'key_contact_email.*'  => 'sometimes|required|email:rfc,filter',
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
            'contact_person.required' => 'The shareholder name field is required.',
            'business_name.max' => 'The business name must not be greater than 100 characters.',
            'contact_type.required' => 'The method of Contact field is required.',
            'phone.required' => 'The mobile number field is required.',
            'phone.*.min' => 'The mobile number field minimum 10 digits.',
            'phone.*.max' => 'The mobile number field minimum 14 digits.',
            'point_of_contact.required' => 'The point of contact field is required.',
            'key_contact_name.*.required' => 'The contact name field is required.',
            'key_contact_phone.*.required' => 'The contact mobile number field is required.',
            'key_contact_phone.*.digits' => 'The contact mobile number field must be 10 digits.',
            'key_contact_email.*.required' => 'The contact email field is required.',
            'key_contact_email.*.email' => 'The contact email must be a valid email address.',

        ];
    }
}

<?php

namespace App\Http\Requests\Agent;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'business_name'   => 'required|string|max:255',
            'business_number' => 'required|digits_between:10,15',
            'contact_person'  => 'required|string|max:255',
            'phone'           => 'required|min:10|max:14|unique:users,phone',
            'email'           => 'required|email|max:255|unique:users,email',
            'state_id'        => 'required|exists:states,id',
            'agreement_date'  => 'required|date',
            'abn'  =>   'nullable|digits_between:10,20',
        ];
    }

    public function messages()
    {
        return [
            'state_id.required'  => 'please select your territory.',
            'state_id.exists'  => 'please select your territory.',
        ];
    }
}

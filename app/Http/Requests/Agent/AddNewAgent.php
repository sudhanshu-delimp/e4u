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
            'business_number' => 'required|string|max:255',
            'contact_person'  => 'required|string|max:255',
            'phone'           => 'required|email|max:255|unique:users,phone',
            'email'           => 'required|email|max:255|unique:users,email',
            'state_id'        => 'required|integer|exists:states,id',
            'agreement_date'  => 'required|date',
        ];
    }
}

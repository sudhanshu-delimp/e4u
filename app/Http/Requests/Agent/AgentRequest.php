<?php

namespace App\Http\Requests\Agent;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
            'ref_number' => ['nullable', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'contact_by_email' => ['nullable', 'boolean'],
            'contact_by_mobile' => ['nullable', 'boolean'],
            'comments' => ['nullable', 'string', 'max:300'],
            'status' => ['nullable', 'integer', 'in:0,1,2'],
        ];
    }
}

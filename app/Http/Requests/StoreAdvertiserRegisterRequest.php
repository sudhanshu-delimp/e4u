<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertiserRegisterRequest extends FormRequest
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
            'agent_id' => [
            'nullable',
            Rule::exists('users', 'member_id')
                ->where(function ($query) {
                    $query->where('status', '1')
                          ->where('type', '5');
                }),
        ],
            'phone' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'type' => 'required|in:3,4,5',
        ];
    }

    public function messages()
{
    return [
        'agent_id.exists' => 'This agent id is invalid or not active',
    ];
}
}

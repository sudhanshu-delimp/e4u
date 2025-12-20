<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
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
    public function rules(Request $request)
    {
        return [
            'agent_id' => [
            'bail',
            'nullable',
            Rule::exists('users', 'member_id')
                ->where(function ($query) use($request){
                    $query->where('status', '1')
                        ->where('state_id', $request->state_id)
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
        'agent_id.exists' => 'This agent ID is invalid, inactive, or not in the selected location',
    ];
}
}

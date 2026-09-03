<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisaMigrationRequest extends FormRequest
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
  public function rules(): array
  {
    return [
      'contact_pref' => ['required', 'array', 'min:1'],
      'contact_pref.*' => ['required', 'in:email,mobile'],

      'first_name' => ['required', 'string', 'max:100'],
      'last_name' => ['required', 'string', 'max:100'],

      'email' => ['required', 'email', 'max:255'],
      // 'term_condition' => ['required', 'accepted'],
      'mobile' => [
        'required',
        'string',
        'max:20',
      ],

      'passport_country' => [
        'required',
        'string',
        'max:100',
      ],

      'advice_area' => [
        'required',
        'in:visa,visa_education',
      ],

      'visa_enquiry_type' => [
        'required',
        'in:020,601,651,500,485,417,462',
      ],

      'comments' => [
        'nullable',
        'string',
        'max:2000',
      ],
    ];
  }

  public function messages(): array
  {
    return [
      'contact_pref.required' => 'Please select at least one contact preference.',
      'first_name.required' => 'First name is required.',
      'last_name.required' => 'Last name is required.',
      'email.required' => 'Email address is required.',
      'email.email' => 'Please enter a valid email address.',
      'mobile.required' => 'Mobile number is required.',
      'passport_country.required' => 'Passport country of issue is required.',
      'advice_area.required' => 'Please select an area of advice.',
      'visa_enquiry_type.required' => 'Please select a visa enquiry type.',
    ];
  }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailHostingRequest extends FormRequest
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


      'email' => ['required', 'email', 'max:255'],
      'first_name' => ['required', 'max:255'],
      'last_name' => ['required', 'max:255'],
      'term_condition' => ['required', 'accepted'],
      'auth' => ['required', 'accepted'],
      'period_required' => ['required', 'numeric'],
      'mobile' => ['required', 'string', 'max:20',],
      'comments' => ['nullable',   'string', 'max:2000',],
      
      'monthly_fee',
      'total_subscription_cost',
      'gst_rate',
      'total_gst',
      'currency',
      'start_date',
      'end_date',
      'next_payment_date',
      'payment_gateway',
      'gateway_customer_id',
      'payment_method_id',
      'request_status',
      'subscription_status',
      'auto_renew',
    ];
  }

  public function messages(): array
  {
    return [
      'contact_pref.required' => 'Please select at least one contact preference.',
      'email.required' => 'Email address is required.',
      'email.email' => 'Please enter a valid email address.',
      'mobile.required' => 'Mobile number is required.',
      'term_condition.required' => 'Please accept the terms and conditions.',
      'auth.required' => 'Please accept the payment authorization terms to proceed with the payment.',
    ];
  }
}

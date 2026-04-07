<?php

namespace App\Http\Requests\MassageProfile;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseListingRequest extends FormRequest
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
            'rate' => 'required|numeric|min:0',
            'total_rate' => 'required|numeric|min:0',
            'no_of_days' => 'required|integer|min:1',
            'total_fee' => 'required|numeric|min:0',
            'listing_start_date' => 'required|date',
            'listing_end_date' => 'required|date|after_or_equal:listing_start_date',
            'membership_id' => 'required|integer',
            'massage_profile_id' => 'required|integer',

        ];
    }

    public function messages()
    {
        return [
            'no_of_days.required' => 'No of days is required',
            'total_fee.required' => 'Total fee is required',
            'listing_start_date.required' => 'Start date is required',
            'listing_end_date.after_or_equal' => 'End date must be after or equal to start date',
            'membership_id.required' => 'Membership is required',
            'massage_centre_id.required' => 'Massage centre is required',
        ];
    }

}

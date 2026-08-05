@php
$tourDetail = $tourDetail ?? null;
@endphp
@if(empty($tourDetail))
<div class="modal fade upload-modal" id="tour_summary" tabindex="-1" role="dialog" aria-labelledby="tour_summary" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/travel.png') }}" class="custompopicon">
                    <span class="text-white">Tour Summary</span>                        
                    </h5>
                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <tr>
                            <th style="color: #0C223D; font-weight:600; border-top:1px solid #e3e6f0;">Tour start date</th>
                            <td class="location_count">{{!empty($tourDetail)?$tourDetail->start_date:''}}</td>
                            <th style="color: #0C223D; font-weight:600; border-top:1px solid #e3e6f0">Tour end date</th>
                            <td class="location_current">{{!empty($tourDetail)?$tourDetail->end_date:''}}</td>
                        </tr>
                            <tr>
                            <th style="color: #0C223D; font-weight:600; border-top:1px solid #e3e6f0;">Locations</th>
                            <td class="location_count">{{!empty($tourDetail)?$tourDetail->locations->count():''}}</td>
                            @if(!empty($tourDetail) && $tourDetail->current_location)
                                <th style="color: #0C223D; font-weight:600; border-top:1px solid #e3e6f0; background-color: #e3e6f0">Current Location</th>
                                <td class="location_current" style="background-color: #e3e6f0">{{!empty($tourDetail)?$tourDetail->current_location->state->name:''}}</td>
                                @else  
                                <td colspan="2"></td>
                            @endif
                        </tr>
                        <tr>
                            <th style="color: #0C223D; font-weight:600;">Fees</th>
                            <td class="current_fees">{{formatCurrency(!empty($tourDetail) ? $tourDetail->tourPurchase()->sum('paid_rate') : 0.00, 'AU$ ')}}</td>
                            <td class="" style="background-color: #e3e6f0" colspan="2">
                                <span style="color: #0C223D; font-weight:600;">Start Date: </span> <span>{{!empty($tourDetail)?$tourDetail->current_location->start_date->format('d-m-Y'):''}}</span>
                                &nbsp;&nbsp;
                                <span style="color: #0C223D; font-weight:600;">End Date: </span> <span>{{!empty($tourDetail)?$tourDetail->current_location->end_date->format('d-m-Y'):''}}</span>
                            </td>
                        </tr>
                        @if(!empty($tourDetail) && $tourDetail->current_location) 
                        <tr>
                            <th style="color: #0C223D; font-weight:600;">Current Profiles</th>
                            <td class="current_profile" colspan="3">
                                <div class="d-flex justify-content-start gap-20 align-items-center flex-wrap">
                                    @php
                                        $profiles = $tourDetail->current_location->profiles;
                                    @endphp
                                    @foreach ($profiles as $profile)
                                      <div class="profile_shape summary_tooltip">
                                        <div class="icons">
                                            <img src="{{$profile->escort->DefaultImage}}" class="custompopicon">
                                        </div>
                                         <span class="list_profile_name">{{$profile->escort->name}}</span> 
                                         <span class="details">{{$profile->escort->membership_type}}</span>
                                      </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr> 
                        @endif
                    </table>
                    <hr style="background-color: #0C223D" class="mt-3">
                    <div class="note">
                        <p class="font-weight-bold">Notes:</p>
                        <ol>
                            <li>If you cancel your Tour, any remaining Fees paid will be credited back to
                                you. Cancellation is immediate.</li>
                            <li>You can reactivate this Tour by going to the Tours group in the menu.</li>
                        </ol>
                    </div>
                </div>
                @if(empty($tourDetail))
            </div>
        </div>
    </div>
</div>
@endif
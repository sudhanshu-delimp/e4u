<style>
    .eachListing {
        background: white;
        border-radius: 10%;
        padding: 20px;
        border: 5px double grey;
    }
</style>
<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12">
        <div class="member-id">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{ auth()->user()->member_id}}</span>
        </div>
    </div>
    @php
    $membership = [1 => "Platinum", 2=>"Gold", 3=>"Silver", 4=>"Free"];
    function calculateFee($plan, $days) {
        $dis_rate = 0;
        if($plan == 1 ) {
            $actual_rate = 8;
            if($days <= 21) {
                $rate = 8;
            } else {
                $rate = 7.5;
                $dis_rate = 0.5;
            }

        } else if($plan == 2) {
            $actual_rate = 6;
            if($days <= 21) {
                $rate = 6;
            } else {
                $rate = 5.7;
                $dis_rate = 0.3;
            }
        } else if($plan == 3) {
            $actual_rate = 4;
            if($days <= 21) {
                $rate = 4;
            } else {
                $rate = 3.8;
                $dis_rate = 0.2;
            }
        } else {
            //return redirect()->route('escort.setting.profile',$id);
            $actual_rate = 0;
            $rate = 0;
            $dis_rate = 0;
        }

        if($days !== null && $days <= 21) {
            //$rate = $days*30/days;
            $total_rate = $days*$rate;
            $total_dis = 0;

        } else {
            $days_21 = 21*$actual_rate;
            $above_day = $days - 21;
            $total_rate = ($above_day*$rate + $days_21);
            $total_dis = $above_day*$dis_rate;
        }

        return [$total_dis, $total_rate];
    }

    $totalAmount = 0;
    @endphp
    <div class="about_me_drop_down_info ">
        <div class="padding_20_all_side payment_form_bg">
            <div class="row margin_zero_for_row">
                <div class="col-lg-12 col-md-12 col-12 mb-2">
                    <div class="paymnt_summery mb-3 summary-bg">
{{--                        <input type="hidden" id="profile_id" value="{{$escort->id}}">--}}
                        <h4 class="mb-4">Summary</h4>
                        <hr>
{{--                        <p>--}}
{{--                            <span class="bold_text">Profile Name:</span><label id="pro_name_tab"> {{ $escort->profile_name}} </label>--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <span class="bold_text">Location:</span><label id="location_tab">{{ $escort->city ? $escort->city->name : ''}}</label>--}}
{{--                        </p>--}}

                    </div>
                </div>
                <div class="row col-sm-12 ml-2">
                    @foreach($data as $idx => $listing)
                        <div class="col-sm-4 mb-1 eachListing">
                            @php
                            if(!empty(($listing['start_date'])))
                                $daysDiff = Carbon\Carbon::parse($listing['end_date'])->diffInDays(Carbon\Carbon::parse($listing['start_date']));
                                list($discount, $rate) = calculateFee($listing['membership'], $daysDiff);
                                $totalAmount += $rate;
                                $totalAmount -= $discount;
                            @endphp
                            <p style="text-align: center; text-decoration: underline;"><b>Listing {{$idx+1}}</b></p>
                            <p>
                                <span class="bold_text">Stage Name:</span><label>{{ $listing['escort_id'] ? $escorts[$listing['escort_id']] : ''}}</label>
                            </p>
                            <p>
                                <span class="bold_text">Start Date:</span><label>{{ $listing['start_date'] ? date('d-M-Y',strtotime($listing['start_date'])) : ''}}</label>
                            </p>
                            <p>
                                <span class="bold_text" id="">Duration:</span><label id="duration_tab">
                                    {{$daysDiff}} Days
                                </label>
                            </p>
                            <p>
                                <span class="bold_text" id="">Membership Type: {{$membership[$listing['membership']]}}</span><label id="plan"></label>
                            </p>
                            <p>
                                <span class="bold_text" id="">Discounts:</span><label id=""> ${{number_format($discount, 2)}}</label>
                            </p>
                            <p>
                                <span class="bold_text" id="">Fees: ${{number_format($rate, 2)}}</span><label id="fee_tab"></label>
                            </p>
                        </div>
                    @endforeach
                        <div class="col-sm-12 mt-4 pl-2">
                            <div class="total_amount">
                                <p> <span class="bold_text h5">Total: ${{number_format($totalAmount, 2)}}</span>
                                    <input name="total_fee" type="hidden" value="{{$totalAmount}}"/>
{{--                                    <textarea name="checkout" hidden="hidden">{{$checkoutData}}</textarea>--}}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 text-right"><button type="submit" class="mt-1 save_profile_btn" id="escort-form-submit-btn">Pay</button></div>

                </div>
                {{-- <div class="col-lg-6 col-md-6 col-12">
                    <div class="summary-bg">
                        <h4 class="mb-4">Payment</h4>
                        <hr>
                        <div class="form-group">
                            <label for="">Name on Card
                            <span style="color:red">*</span>
                            </label>
                            <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text">
                            <label class="payment_card_colors" for="">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="">Card Number
                            <span style="color:red">*</span>
                            </label>
                            <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">Expiry
                            <span style="color:red">*</span>
                            </label>
                            <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text" placeholder="Month/Year">
                        </div>
                        <div class="form-group">
                            <label for="">CSV
                            <span style="color:red">*</span>
                            </label>
                            <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

</div>

<style>
    .eachListing {
        background: white;
        border-radius: 10%;
        padding: 20px;
        border: 5px double grey;
    }
</style>
<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
    
    @php
    $membership = [1 => "Platinum", 2=>"Gold", 3=>"Silver", 4=>"Free"]; 
    function calculateChargeFee($plan, $days) {
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
                    <div class="paymnt_summery mb-3 summary-bg d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Summary</h4>
                        <div class="member-id">
                            <span class="pr-2 "><i class="fa fa-user"></i></span>
                            <span>Member ID: {{ auth()->user()->member_id}}</span>
                        </div>
                    </div>
                </div>    
                <div class="col-md-12">
                    <div class="listing-table-wrapper table-responsive">
                        <table class="listing-summary-table table table-bordered">
                            <thead class="bg-first">
                                <tr>
                                    <th>Listing</th>
                                    <th>Stage Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Membership Type</th>
                                    <th>Rate</th>
                                    <th>Full Fee</th>
                                    <th>Discount</th>
                                    <th>Discounted Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $idx => $listing)
                                    @php
                                        if(!empty(($listing['start_date'])))
                                            $daysDiff = Carbon\Carbon::parse($listing['end_date'])->diffInDays(Carbon\Carbon::parse($listing['start_date']));
                                            list($discount, $rate) = calculateChargeFee($listing['membership'], $daysDiff);
                                            $fullFee = $rate + $discount;
                                            $totalAmount += $rate;
                                        @endphp
                                    <tr>
                                        <td>{{ $idx+1 }}</td>
                                        <td>{{ $listing['escort_id'] ? $escorts[$listing['escort_id']] : ''}}</td>
                                        <td>{{ $listing['start_date'] ? date('d-m-Y',strtotime($listing['start_date'])) : ''}}</td>
                                        <td>{{ $listing['end_date'] ? date('d-m-Y',strtotime($listing['end_date'])) : ''}}</td>
                                        <td>{{ $daysDiff }}</td>
                                        <td>{{ $membership[$listing['membership']] }}</td>
                                        <td><span class="mr-2">$</span>  {{ number_format($discount > 0 ? ($fullFee / $daysDiff) : ($rate / $daysDiff), 2) }}</td>
                                        <td><span class="mr-2">$</span>  {{ number_format($fullFee, 2) }}</td>
                                        <td><span class="mr-2">$</span>  {{ number_format($discount, 2) }}</td>
                                        <td><span class="mr-2">$</span>  {{ number_format($rate, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="border-0"></td>
                                    <td  style="text-align:right;"><b>Total Fees:</b></td>
                                    <td><b><span class="mr-2">$</span> {{ number_format($totalAmount, 2) }}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="text-right mt-3">
                        <button type="submit" class="save_profile_btn mr-0" id="escort-form-submit-btn">Pay</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>

</div>

<style>
    .eachListing {
        background: white;
        border-radius: 10%;
        padding: 20px;
        border: 5px double grey;
    }
</style>
@php

$loginAccount = auth()->user();
@endphp
<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
    @php
    $membership = [1 => "Platinum", 2=>"Gold", 3=>"Silver", 4=>"Free"];
    $totalAmount = 0;
    @endphp
    <div class="about_me_drop_down_info ">
        <div class="padding_20_all_side payment_form_bg">
            <div class="row margin_zero_for_row">
                <div class="col-lg-12 col-md-12 col-12 mb-2">
                    <div class="paymnt_summery mb-3 summary-bg d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Transaction Summary</h4>
                        <div class="member-id">
                            <span class="pr-2 "><i class="fa fa-user"></i></span>
                            <span>Member ID: {{$loginAccount->member_id}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="listing-table-wrapper table-responsive">
                        <table class="listing-summary-table table table-bordered">
                            <thead class="bg-first">
                                <tr>
                                    <th class="text-center">Listing</th>
                                    <th class="text-center">Stage Name</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">End Date</th>
                                    <th class="text-center">Days</th>
                                    <th class="text-center">Membership Type</th>
                                    <th class="text-center">Rate</th>
                                    <th class="text-center">Full Fee</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Discounted Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $idx => $listing)
                                @php
                                if(!empty(($listing['start_date'])))
                                $daysDiff = Carbon\Carbon::parse($listing['end_date'])->diffInDays(Carbon\Carbon::parse($listing['start_date']))+1;
                                list($discount, $rate) = calculateTotalFee($listing['membership'], $daysDiff, $loginAccount);
                                $fullFee = $rate + $discount;
                                $totalAmount += $rate;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $idx+1 }}</td>
                                    <td class="text-center">{{ $listing['escort_id'] ? $escorts[$listing['escort_id']] : ''}}</td>
                                    <td class="text-center">{{ $listing['start_date'] ? date('d-m-Y',strtotime($listing['start_date'])) : ''}}</td>
                                    <td class="text-center">{{ $listing['end_date'] ? date('d-m-Y',strtotime($listing['end_date'])) : ''}}</td>
                                    <td class="text-center">{{ $daysDiff }}</td>
                                    <td class="text-center">{{ $membership[$listing['membership']] }}</td>
                                    <td class="text-center"><span class="mr-2">AU$</span> {{ number_format($discount > 0 ? ($fullFee / $daysDiff) : ($rate / $daysDiff), 2) }}</td>
                                    <td class="text-center"><span class="mr-2">AU$</span> {{ number_format($fullFee, 2) }}</td>
                                    <td class="text-center"><span class="mr-2">AU$</span> {{ number_format($discount, 2) }}</td>
                                    <td class="text-center"><span class="mr-2">AU$</span> {{ number_format($rate, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="border-0"></td>
                                    <td class="text-center"><b>Total Fees:</b></td>
                                    <td class="text-center listing_total_fees"><b><span class="mr-2">AU$</span> {{ number_format($totalAmount, 2) }}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-right mt-3">
                        <a class="btn-success-modal text-white" href="#" data-toggle="modal" data-target="#process-payment-modal" data-backdrop="static" data-keyboard="false" name="action" value="listing">Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
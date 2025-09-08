<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
    
    <div class="about_me_drop_down_info ">
        <div class="padding_20_all_side payment_form_bg">
            <div class="row margin_zero_for_row">
                <div class="col-lg-12 col-md-12 col-12 mb-2">
                    <div class="paymnt_summery mb-3 summary-bg d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Summary</h4>
                        <div class="member-id">
                            <span class="pr-2 "><i class="fa fa-user"></i></span>
                            <span>Member ID: E60104</span>
                        </div>
                    </div>
                </div>    
                <div class="col-md-12">
                    <div class="listing-table-wrapper table-responsive">
                        <table class="listing-summary-table table table-bordered">
                            <thead class="bg-first">
                                <tr>
                                    <th>Profile Name</th>
                                    <th>Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Daily Rate</th>
                                    <th>Fee</th>
                                    <th>Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <td>{{ $escort->profile_name}}</td>
                                        <td>{{ $escort->city ? $escort->city->name : ''}}</td>
                                        <td>{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}</td>
                                        <td> @if(!empty(($escort->start_date)))
                                            {{ ( Carbon\Carbon::parse($escort->end_date)->diffInDays(Carbon\Carbon::parse($escort->start_date)))}}
                                            @endif </td>
                                        <td>1</td>
                                        <td><span class="mr-2">$</span>  8.00</td>
                                        <td><span class="mr-2">$</span>  8.00</td>
                                        <td><span class="mr-2">$</span>  0.00</td>
                                    </tr>
                                                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="border-0"></td>
                                    <td style="text-align:right;"><b>Total Fees:</b></td>
                                    <td><b><span class="mr-2">$</span> 8.00</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    {{-- <div class="text-right mt-3">
                        <button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Pay</button>
                    </div> --}}
                </div>                
            </div>
        </div>
    </div>
    <!-- check out btns -->
    <div class="tab_btm_btns_preview_and_next">
        <div class="row pt-3 pb-3">
            <div class="col-lg-9 col-md-12 col-sm-12 col-12 a_text_white_hover previous_bt_center_in_sm margin_for_check_out">
                <a href="#available" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">
                <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Previous Step</a>
                {{-- <a href="#" class="nex_sterp_btn btn_width_hundred">Save Profile</a> --}}
                <button type="submit" id="submitForm" class=" btn_width_hundred save_profile_btn">Save Profile</button>
                <a href="#" class="save_profile_btn">Preview Profile</a>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 text-center a_text_white_hover previous_bt_center_in_sm">
                <!-- <a href="#" class="save_profile_btn">Preview</a> -->
                @if(request()->segment(2) != "create-profile")
                <a href="#" class="nex_sterp_btn btn-block" id="poli_payment">Checkout&nbsp;&nbsp;
                <i class="fas fa-arrow-right"></i>
                
                </a>
                @endif
            </div>
            
        </div>
    </div>
    <div id="iframeContainer1" style="display: none; width: 100%; background-color: #000; height: 100%; opacity: 0.4; position: absolute; top: 0px; z-index: 100;">
    </div>
    <div id="iframeContainer" style="display: none; margin: 20px auto 100px; padding: 0px; width: 25%; max-width: 25%; height: 50%; min-height: 500px; max-height: 50%; overflow: hidden;position: fixed;right: 12%;top: 20%;z-index: 105;">
        <iframe src="" style="height:inherit;width:100%;margin:0;padding:0;min-height: 500px;" name="poliframe" id="poliframe"></iframe>
    </div>
    <!-- check out btns --> 
</div>
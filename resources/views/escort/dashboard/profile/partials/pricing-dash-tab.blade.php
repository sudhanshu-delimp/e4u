<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12">
        <div class="member-id">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{$loginAccount->member_id}}</span>&nbsp;&nbsp;<span>{{$editMode?"Profile: $escort->profile_name":""}}</span>
        </div>
    </div>
    <div class="about_me_drop_down_info ">
        <div class="padding_20_all_side payment_form_bg">
            <div class="row margin_zero_for_row">
                <div class="col-lg-12 col-md-12 col-12 mb-2">
                    <div class="paymnt_summery mb-3 summary-bg">
                        <input type="hidden" id="profile_id" value="{{$escort->id}}">
                        <h4 class="mb-4">Summary</h4>
                        <hr>
                        <p>
                            <span class="bold_text">Profile Name:</span><label id="pro_name_tab"> {{ $escort->profile_name}} </label>
                        </p>
                        <p>
                            <span class="bold_text">Location:</span><label id="location_tab">{{ $escort->city ? $escort->city->name : ''}}</label>
                        </p>
                        <p>
                            <span class="bold_text">Start Date:</span><label id="start_date_tab">{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}</label>
                        </p>
                        <p>
                            <span class="bold_text" id="">Duration:</span><label id="duration_tab">
                                @if(!empty(($escort->start_date)))
                                {{ ( Carbon\Carbon::parse($escort->end_date)->diffInDays(Carbon\Carbon::parse($escort->start_date)))}}
                                @endif

                            </label>
                        </p>
                        <p>
                            <span class="bold_text" id="">Membership Type:</span><label id="plan"></label>
                        </p> 
                        {{-- <p>
                            <span class="bold_text" id="">Daily rate:</span><label id="rate_tab"></label>
                        </p> --}}
                        <p>
                            <span class="bold_text" id="">Fees:</span><label id="fee_tab"></label>
                        </p>
                        <div class="mt-4 pl-2">
                        <p>
                            <span class="bold_text" id="">Discounts:</span><label id="dis_tab"></label>
                        </p>
                        
                        <div class="total_amount">
                            <p> <span class="bold_text h5">Total:</span>
                                <label id="total_rate" class="h5"></label>
                                <label id="paid_rate" class="h5"></label>
                            </p>
                        </div>
                        </div>
                    </div>
                    
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
   
    <!-- check out btns -->
    <div class="tab_btm_btns_preview_and_next">
        <div class="row pt-3 pb-3">
            <div class="col-lg-9 col-md-12 col-sm-12 col-12 a_text_white_hover previous_bt_center_in_sm margin_for_check_out">
                <a href="#available" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">
                <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
                {{-- <a href="#" class="nex_sterp_btn btn_width_hundred" style="background: #192A3E;">Save Profile</a> --}}

                <button type="submit" id="submitForm" class=" btn_width_hundred save_profile_btn">Save Profile</button>
                <a href="{{ route('profile.description',$escort->id ? $escort->id : '')}}" class="save_profile_btn">Preview Profile</a>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 text-center a_text_white_hover previous_bt_center_in_sm">
                <!-- <a href="#" class="save_profile_btn">Preview</a> -->
                @if(request()->segment(2) == null)
                <a href="#" class="nex_sterp_btn btn-block" id="poli_payment">Checkout&nbsp;&nbsp;
                    <i class="fas fa-arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
    <!-- check out btns -->
</div>
@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5">
        <h1>PinUp Checkout</h1>
        <form id="my_escort_profile" action="{{ route('escort.payment')}}" method="post" enctype="multipart/form-data">
            @csrf
{{--            <input type="hidden" name="user_startDate" id="user_startDate" value="{{ date('Y-m-d',strtotime(auth()->user()->created_at)) }}">--}}
            <div>
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
                        $price = $pricing->price;

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
                                <?php
//                                dd($escorts);
                                ?>
                                <div class="row col-sm-12 ml-2">
                                    @foreach($checkoutData as $idx => $listing)
                                        <div class="col-sm-4 mb-1 eachListing">
                                            <p style="text-align: center; text-decoration: underline;"><b>Listing {{$idx+1}}</b></p>
                                            <p>
                                                <span class="bold_text" id="">State:</span><label id=""> {{config('escorts.profile.states')[$listing['state_id']]['stateName']}}</label>
                                            </p>
                                            <p>
                                                <span class="bold_text" id="">Profile:</span><label id=""> {{ $escorts->pluck('NameWithProfileName', 'id')->toArray()[$listing['escort_id']] }}</label>
                                            </p>
                                            <p>
                                                <span class="bold_text">Start Date:</span><label>{{ date('d-M-Y',strtotime($listing['week_start'])) }}</label>
                                            </p>
                                            <p>
                                                <span class="bold_text" id="">Fees: ${{number_format($price, 2)}}</span><label id="fee_tab"></label>
                                            </p>
                                        </div>
                                        @php
                                            $totalAmount += $price;
                                        @endphp
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
            </div>
        </form>
    </div>

@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript">

    </script>
@endpush


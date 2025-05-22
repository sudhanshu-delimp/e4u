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
                <path
                    d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z"
                    fill="#C2CFE0" />
            </svg>
            <span>Escort ID: {{ auth()->user()->member_id }}</span>
        </div>
    </div>

    <div class="about_me_drop_down_info ">
        <div class="padding_20_all_side payment_form_bg">
            <div class="row margin_zero_for_row">
                <div class="col-lg-12 col-md-12 col-12 mb-2">
                    <div class="paymnt_summery mb-3 summary-bg">
                        <h4 class="mb-4">Order Summary</h4>
                        <hr>

                    </div>
                </div>
                {{-- <form action="{{route('mobile-order-sim-payment')}}" method="post" enctype="multipart/form-data">
                    @csrf --}}
                    <div class="row col-sm-12 ml-2">
                        {{-- @foreach ($data as $details) --}}
                        <div class="col-sm-4 mb-1 eachListing">

                            <span class="bold_text">
                                Name: </span><label> {{ $data['name'] }}</label>
                            </p>
                            <p>
                                <span class="bold_text">
                                    Date: </span><label>
                                    {{ $data['date'] ? date('d-m-Y', strtotime($data['date'])) : '' }}</label>
                            </p>
                            <p>
                                <span class="bold_text" id="">Period:
                                    </span><label id="fee_tab">{{ $data['period_required'] }} Months</label>
                            </p>
                            <p>
                                <span class="bold_text" id="">Fees:
                                    </span><label id="fee_tab">${{ number_format($data['fees'], 2) }} {{ $data['perioid_text']}}</label>
                            </p>
                        </div>
                        {{-- @endforeach --}}
                        <div class="col-sm-12 mt-4 pl-2">
                            <div class="total_amount">
                                <p> <span class="bold_text h5">Total: ${{ number_format($data['fees'], 2) }}</span>
                                    <input name="total_fee" type="hidden" value="{{ $data['total'] }}" />
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <input type="hidden" name="concierge_mobile_sim_id" value="{{$data['concierge_mobile_sim_id']}}">
                            <button type="submit" class="mt-1 save_profile_btn"
                                >Pay</button>
                            </div>

                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

</div>

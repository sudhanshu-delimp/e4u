<style>
    .tooltip-inner {
        border: 1px solid #FF3C5F !important;
    }
    .bs-tooltip-auto[x-placement^=top] .arrow::before, .bs-tooltip-top .arrow::before {
        border-top-color: #FF3C5F;
    }
</style>
<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">


    <div class="about_me_drop_down_info ">
        <div class=" fill_profile_headings_global custom--social-head">
            <h2>Rates</h2>
            <span class="custom--help"><b>Help?</b></span>
        </div>
        <div class="custom-note-section">
            <div class="card" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                    <ol class=" mb-0">
                    <li>By completing these settings, the information set out under My Rates will by default appear in your Profile creator.</li>
                    <li>You can over ride these settings when creating a Profile, provided you have enabled the <a href="/escort-dashboard/update-account" class="custom_links_design">feature</a> (see My Account - Profile & Tour options).</li>
                    <li>Rates set for Socialising are hourly.</li>
                    <li>If the value is $0 then the public display in the Profile is N/A</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="padding_20_all_side pb-0 custom-blow-wide">
            <form id='storeRate' action="{{ route('escort.settings.rate') }}" method="Post">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates">
                        <div class="rate_first_row row">
                            <div class="col-3">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}" data-toggle="tooltip" data-html="true" data-placement="top" title="Massage rates" data-boundary="window">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/incalls.png')}}" data-toggle="tooltip" data-html="true" data-placement="top" title="Incall rates" data-boundary="window">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/outcall.png')}}" data-toggle="tooltip" data-html="true" data-placement="top" title="Outcall rates" data-boundary="window">
                            </div>
                        </div>
                        @foreach($durations as $duration)
                        <div class="rate_first_row">
                            <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                            <div class="form-group row">
                                <label class="col-3" for="exampleFormControlSelect1">{{ $duration->name}}:</label>
                                @if($duration->name == 'Blow & Go')
                                    <div class="col-3">
                                    <input min="0" placeholder="0" type="hidden" id="massage_price" name="massage_price[]" value="0">
                                        <div class="form-group" style="color: #ff3c5f;font-size: 14px;">Not available</div>
                                    </div>
                                @else
                                    <div class="col-3">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <span>$</span>
                                            <input min="0" placeholder="0" type="number"
                                                class="form-control form-control-sm select_tag_remove_box_sadow"
                                                id="massage_price" name="massage_price[]"
                                                value="{{ $escort->durationRate($duration->id, 'massage_price') }}"
                                                step=10 max=9999>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0" placeholder="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="{{ $escort->durationRate($duration->id, 'incall_price') }}" step=10 max=9999>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0" placeholder="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="{{ $escort->durationRate($duration->id, 'outcall_price') }}" step=10 max=9999>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-sm-12">
                        <div class=" fill_profile_headings_global custom--social-head">
                            <h2>Deposit</h2>
                        </div>
                        <!-- Incall -->
                        <div class="form-group d-flex justify-content-start gap-20  align-items-baseline flex-wrap pt-3">
                            <label style="width:100px">Incall :</label>

                            <label>
                                <input type="radio" name="incall_deposit" value="no" checked onclick="toggleDeposit('incall', false)"> No
                            </label>

                            <label>
                                <input type="radio" name="incall_deposit" value="yes" onclick="toggleDeposit('incall', true)"> Yes
                            </label>

                          
                            
                            <span id="incall_input" style="display:none;">
                                <div class="d-flex justify-content-start gap-10 align-items-center">
                                <span>$</span>
                               <input type="number" class="form-control" placeholder="0" onblur="saveDeposit('incall', this.value)" style="padding-right: 0px !important; width:78px; height:31px">
                                </div>
                            </span>
                        </div>

                        <!-- Outcall -->
                        <div class="form-group d-flex justify-content-start gap-20 align-items-baseline flex-wrap">
                            <label style="width:100px">Outcall: </label>

                            <label>
                                <input type="radio" name="outcall_deposit" value="no" checked onclick="toggleDeposit('outcall', false)"> No
                            </label>

                            <label>
                                <input type="radio" name="outcall_deposit" value="yes" onclick="toggleDeposit('outcall', true)"> Yes
                            </label>
                            <span id="outcall_input" style="display:none;">
                                <div class="d-flex justify-content-start gap-10 align-items-center">
                                <span>$</span>
                                <input type="number" class="form-control" placeholder="0" onblur="saveDeposit('outcall', this.value)" style="padding-right: 0px !important; width:78px; height:31px">
                                </div>
                            </span>
                        </div>

                        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="store_rate" type="submit" class="save_profile_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    function toggleDeposit(type, show) {
        document.getElementById(type + '_input').style.display = show ? 'block' : 'none';
    }


    </script>
@endpush

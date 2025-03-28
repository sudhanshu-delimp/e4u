<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
   
    
    <div class="about_me_drop_down_info ">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
            <h2>Rates</h2>
        </div>
        <div class="padding_20_all_side">
            <form id='storeRate' action="{{ route('center.settings.rate') }}" method="Post">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates">
                        <div class="rate_first_row row">
                            <div class="col-3">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}">
                            </div>
                        </div>
                        @foreach($durations->whereIn('id',[2,3,4]) as $duration)
                        <div class="rate_first_row">
                            <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                            <div class="form-group row">
                                <label class="col-3" for="exampleFormControlSelect1">{{ $duration->name}}:</label>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0"  type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="massage_price" name="massage_price[]" value="{{ $massage_profile->durationRate($duration->id, 'massage_price') }}" step=10 max=200>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0"  type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="{{ $massage_profile->durationRate($duration->id, 'incall_price') }}" step=10 max=200>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0"  type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="{{ $massage_profile->durationRate($duration->id, 'outcall_price') }}" step=10 max=200>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="store_rate" type="submit" class="save_profile_btn">Save Rates</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
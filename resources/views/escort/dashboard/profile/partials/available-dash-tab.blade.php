<div class="tab-pane fade pt-2" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="about_me_drop_down_info profile-sec">
        {{--
        <div class="fill_profile_headings_global">
            <h2>My Availability</h2>
        </div>
        --}}
        <div class="padding_20_all_side my-availability-mon container">
            {{-- <form class="my-availability-mon-sun" id="myability" action="{{ route('escort.store.availability', [$escort->id])}}" method="Post">
                @csrf --}}



            @php
                $days = config('escorts.days.capitalize');
                $shortDays = config('escorts.days.short_form');
            @endphp
            @foreach ($days as $day => $cDay)
                <div class="">
                    <div class="row parent-row col-sm-12 mb-4 mb-xl-2">
                        <div class="col-xl-1 col-lg-12">
                            <label class="col-0" for="exampleFormControlSelect1">{{ $cDay }}:
                            </label>
                            <input type="hidden" value="{{ $day }}">
                        </div>
                            <div class="row col-xl-4 col-lg-5 col-md-12 ml-xl-4">
                            <div class="col-lg-5 col-md-5">
                                <div class="service_rate_dolor_symbol form-group" @disabled(true)>
                                    <select
                                        class="form-control form-control-sm select_tag_remove_box_sadow {{ $day }} p-0"
                                        name="{{ $shortDays[$day] }}_from" id="{{ $shortDays[$day] }}from"
                                        data-parsley-gt="#{{ $shortDays[$day] }}_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $escort->availabilityCheck($day, 'from') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $escort->availabilityCheck($day, 'from') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select
                                        class="form-control form-control-sm select_tag_remove_box_sadow {{ $day }} p-0"
                                        id="" name="{{ $shortDays[$day] }}_time_from">
                                        <option value="" selected>--</option>
                                        <option value="AM"
                                            {{ 'AM' == $escort->availabilityCheckAMorPM($day, 'from') ? 'selected' : '' }}>
                                            AM</option>
                                        <option value="PM"
                                            {{ 'PM' == $escort->availabilityCheckAMorPM($day, 'from') ? 'selected' : '' }}>
                                            PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 p-md-0" style="text-align: center;">
                                <span class="text-muted font-13">To</span>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="service_rate_dolor_symbol form-group">
                                    <select
                                        class="form-control form-control-sm select_tag_remove_box_sadow {{ $day }} p-0"
                                        name="{{ $shortDays[$day] }}_to" id="{{ $shortDays[$day] }}_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $escort->availabilityCheck($day, 'to') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $escort->availabilityCheck($day, 'to') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select
                                        class="form-control form-control-sm select_tag_remove_box_sadow {{ $day }} p-0"
                                        id="" name="{{ $shortDays[$day] }}_time_to">
                                        <option value="" selected>--</option>
                                        <option value="AM"
                                            {{ 'AM' == $escort->availabilityToA($day, 'to') ? 'selected' : '' }}>AM
                                        </option>
                                        <option value="PM"
                                            {{ 'PM' == $escort->availabilityToA($day, 'to') ? 'selected' : '' }}>PM
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-xl-6 col-lg-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $day }}" type="radio"
                                    name="availability_time[{{ $day }}]" id="{{ $day }}_til_ate"
                                    value="til_ate" data-parsley-multiple="covidreport"
                                    @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'til_ate' ? 'checked' : '' }} @endif>
                                <label class="form-check-label" for="{{ $day }}_til_ate">... Til late</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $day }}" type="radio"
                                    name="availability_time[{{ $day }}]" id="{{ $day }}_unavailable"
                                    value="unavailable" data-parsley-multiple="covidreport"
                                    @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'unavailable' ? 'checked' : '' }} @endif>
                                <label class="form-check-label"
                                    for="{{ $day }}_unavailable">Unavailable</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $day }}" type="radio"
                                    name="availability_time[{{ $day }}]" id="{{ $day }}_appointment"
                                    value="By Appointment" data-parsley-multiple="covidreport"
                                    @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'By Appointment' ? 'checked' : '' }} @endif>
                                <label class="form-check-label" for="{{ $day }}_appointment">By
                                    Appointment</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $day }}" type="radio"
                                    name="availability_time[{{ $day }}]"
                                    id="{{ $day }}_avail_24_hours" value="Available 24 hours"
                                    data-parsley-multiple="covidreport"
                                    @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'Available 24 hours' ? 'checked' : '' }} @endif>
                                <label class="form-check-label" for="{{ $day }}_avail_24_hours">Available 24
                                    hours</label>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="resetdays-icon">
                                <input type="button" value="Reset" class="resetdays" data-day="{{ $day }}"
                                    id="reset{{ $cDay }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="tab_btm_btns_preview_and_next">
                <div class="row pt-3 pb-3">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 a_text_white_hover previous_bt_center_in_sm">
                        <a class="nex_sterp_btn btn_width_hundred" id="profile-tab" data-toggle="tab" href="#services"
                            role="tab" aria-controls="home" aria-selected="true">
                            <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
                    </div>
                    <div
                        class="col-lg-8 col-md-8 col-sm-8 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
                        <a href="{{ route('profile.description', $escort->id ? $escort->id : '') }}"
                            class="save_profile_btn">Preview</a>
                        <button id="show_draft-2" name="save" type="submit" class="nex_sterp_btn"
                            {{-- style="display:none" --}}>
                            Save Profile
                        </button>
                        {{--                <button id="show_draft-3" name="save and pay"  type="submit" class="nex_sterp_btn" --}}{{-- style="display:none" --}}{{-- >Save and Pay</button> --}}
                        {{-- <a href="#pricing" class="nex_sterp_btn hideDraft" id="pricing-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a> --}}
                        {{--                <button id="show_draft"  type="submit" class="save_profile_btn" style="display:none">Save as draft</button> --}}
                    </div>
                </div>
            </div>
        </div>

<div class="tab-pane fade pt-2" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="about_me_drop_down_info profile-sec">

        <div class="fill_profile_headings_global">
            <h2>My Availability </h2>
        </div>

        <div class="padding_20_all_side my-availability-mon container-fluid">
            @if (request()->segment(2) == 'profile' && request()->segment(3))
                <form class="my-availability-mon-sun" id="myability"
                    action="{{ route('escort.store.availability', [$escort->id]) }}" method="Post">
                    @csrf
            @endif


            @php
                $days = config('escorts.days.capitalize');
                $shortDays = config('escorts.days.short_form');
            @endphp
            @foreach ($days as $day => $cDay)
                {{-- new view --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-10 my-3 parent-row">
                    <div style="width:100px;">
                        <label class="col-0" for="exampleFormControlSelect1">{{ $cDay }}:
                        </label>
                        <input type="hidden" value="{{ $day }}">
                    </div>
                    {{-- end  --}}
                    <div class="service_rate_dolor_symbol form-group mb-0" @disabled(true)>
                        <select
                            class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date {{ $day }} p-0 {{ $editMode || $existAvailability ? 'change_default' : '' }}"
                            name="{{ $shortDays[$day] }}_from" id="{{ $shortDays[$day] }}from"
                            data-parsley-gt="#{{ $shortDays[$day] }}_to" day_key_from="{{ $shortDays[$day] }}">
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
                            class="form-control form-control-sm select_tag_remove_box_sadow {{ $day }} p-0 {{ $editMode || $existAvailability ? 'change_default' : '' }}"
                            id="{{ $shortDays[$day] }}fromtime" name="{{ $shortDays[$day] }}_time_from"
                            day_key_from="{{ $shortDays[$day] }}">
                            <option value="" selected>--</option>
                            <option value="AM"
                                {{ 'AM' == $escort->availabilityCheckAMorPM($day, 'from') ? 'selected' : '' }}>
                                AM</option>
                            <option value="PM"
                                {{ 'PM' == $escort->availabilityCheckAMorPM($day, 'from') ? 'selected' : '' }}>
                                PM</option>
                        </select>
                    </div>
                    {{-- end --}}
                    <div class=" p-md-0" style="text-align: center;">
                        <span class="text-muted font-13">To</span>
                    </div>
                    {{-- end --}}
                    <div class="service_rate_dolor_symbol form-group mb-0">
                        <select
                            class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date {{ $day }} p-0 {{ $editMode || $existAvailability ? 'change_default' : '' }}"
                            name="{{ $shortDays[$day] }}_to" id="{{ $shortDays[$day] }}_to"
                            day_key_to="{{ $shortDays[$day] }}">
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
                            class="form-control form-control-sm select_tag_remove_box_sadow {{ $day }} p-0 {{ $editMode || $existAvailability ? 'change_default' : '' }}"
                            id="{{ $shortDays[$day] }}_time_to" name="{{ $shortDays[$day] }}_time_to"
                            day_key_to="{{ $shortDays[$day] }}">
                            <option value="" selected>--</option>
                            <option value="AM"
                                {{ 'AM' == $escort->availabilityToA($day, 'to') ? 'selected' : '' }}>AM
                            </option>
                            <option value="PM"
                                {{ 'PM' == $escort->availabilityToA($day, 'to') ? 'selected' : '' }}>PM
                            </option>
                        </select>
                    </div>
                    {{-- end --}}
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input {{ $day }}" type="radio"
                                name="availability_time[{{ $day }}]" id="{{ $day }}_til_ate"
                                value="til_ate" data-parsley-multiple="covidreport"
                                @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'til_ate' ? 'checked' : '' }} @endif
                                availability_time_key="{{ $shortDays[$day] }}">
                            <label class="form-check-label" for="{{ $day }}_til_ate">... Til late</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input {{ $day }}" type="radio"
                                name="availability_time[{{ $day }}]" id="{{ $day }}_appointment"
                                value="By Appointment" data-parsley-multiple="covidreport"
                                @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'By Appointment' ? 'checked' : '' }} @endif
                                availability_time_key="{{ $shortDays[$day] }}">
                            <label class="form-check-label" for="{{ $day }}_appointment">By
                                Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input {{ $day }}" type="radio"
                                name="availability_time[{{ $day }}]" id="{{ $day }}_avail_24_hours"
                                value="Available 24 hours" data-parsley-multiple="covidreport"
                                @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'Available 24 hours' ? 'checked' : '' }} @endif>
                            <label class="form-check-label" for="{{ $day }}_avail_24_hours">Available 24
                                hours</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input {{ $day }}" type="radio"
                                name="availability_time[{{ $day }}]" id="{{ $day }}_unavailable"
                                value="unavailable" data-parsley-multiple="covidreport"
                                @if (!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'unavailable' ? 'checked' : '' }} @endif
                                availability_time_key="{{ $shortDays[$day] }}">
                            <label class="form-check-label" for="{{ $day }}_unavailable">Unavailable</label>
                        </div>
                    </div>
                    {{-- end --}}
                    <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="{{ $day }}"
                            id="reset{{ $cDay }}">
                    </div>
                </div>
                {{-- end --}}
            @endforeach

            @if (request()->segment(2) == 'profile' && request()->segment(3))
                <div class="row pt-3">
                    <div class="col-md-12 text-right" style="padding-right: 1.8rem;">

                        <button id="my_abilities" type="submit" class="save_profile_btn who_am_i">Update</button>

                    </div>
                </div>
                </form>
            @endif
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next">
        <div class="row pt-3 pb-3">
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a class="nex_sterp_btn btn_width_hundred" id="profile-tab" data-toggle="tab" href="#services"
                    role="tab" aria-controls="home" aria-selected="true">
                    <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
                @if (request()->segment(2) == 'profile')
                    <a data-toggle="modal" data-id="{{ $escort->id }}" data-target="#view-listing"
                        class="save_profile_btn preview-profile" href="#">Preview</a>
                @endif

                @if (request()->segment(2) == 'create-profile')
                    <button id="show_draft-2" name="save" type="submit" class="nex_sterp_btn"
                        >
                        Save Profile
                    </button>
                @endif
               
                {{-- <a href="#playmates" class="nex_sterp_btn hideDraft" id="playmates-tab" data-toggle="tab" role="tab" aria-controls="playmates" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a> --}}
            </div>
        </div>
    </div>
    
</div>

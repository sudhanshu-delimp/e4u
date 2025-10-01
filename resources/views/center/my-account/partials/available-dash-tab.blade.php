<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="about_me_drop_down_info ">
        <div class="fill_profile_headings_global col-md-12 p-0  custom--social-head">
            <h2>Our Open Times</h2>
            <span class="custom--help"><b>Help?</b></span>
        </div>
        <div class="custom-note-section">
            <div class="card" style="">
                <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                    <ol class=" mb-0">
                        <li>By completing these settings, the information set out under our Open Times will by
                            default appear in your Profile creator.</li>
                                        <li>Leave the time blank if you are unavailable. Select ‘By Appointment’ as an alternative to a particular time period.</li>
                                        <li>You can over ride these
                                            settings when creating a Profile, provided you have enabled the <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">feature</a>.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="padding_20_all_side pb-0 my-availability-mon">
            <form class="my-availability-mon-sun" id="myability" action="{{ route('center.settings.availability')}}" method="Post">
                @csrf
               
                <div class="row">
                    <div class="col-12">
                        <div class="padding_20_all_side my-availability-mon">
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="monday">Monday:
                                    </label>
                                    <input type="hidden" value="monday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input monday" type="radio"
                                            name="availability_time[monday]" id="monday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="monday_til_ate">... Til late</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input monday" type="radio"
                                            name="availability_time[monday]" id="monday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="monday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input monday" type="radio"
                                            name="availability_time[monday]" id="monday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="monday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="monday"
                                        id="resetMonday">
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="tuesday">Tuesday:
                                    </label>
                                    <input type="hidden" value="tuesday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tuesday" type="radio"
                                            name="availability_time[tuesday]" id="tuesday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="tuesday_til_ate">... Til late</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tuesday" type="radio"
                                            name="availability_time[tuesday]" id="tuesday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="tuesday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tuesday" type="radio"
                                            name="availability_time[tuesday]" id="tuesday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="tuesday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="tuesday"
                                        id="resetTuesday">
                                </div>
                            </div>
            
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="wednesday">Wednesday:
            
                                    </label>
                                    <input type="hidden" value="wednesday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input wednesday" type="radio"
                                            name="availability_time[wednesday]" id="wednesday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="wednesday_til_ate">... Til late</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input wednesday" type="radio"
                                            name="availability_time[wednesday]" id="wednesday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="wednesday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input wednesday" type="radio"
                                            name="availability_time[wednesday]" id="wednesday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="wednesday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="wednesday"
                                        id="resetWednesday">
                                </div>
                            </div>
            
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="thursday">Thursday:
                                    </label>
                                    <input type="hidden" value="thursday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input thursday" type="radio"
                                            name="availability_time[thursday]" id="thursday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="thursday_til_ate">... Til late</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input thursday" type="radio"
                                            name="availability_time[thursday]" id="thursday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="thursday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input thursday" type="radio"
                                            name="availability_time[thursday]" id="thursday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="thursday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="thursday"
                                        id="resetThursday">
                                </div>
                            </div>
            
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="friday">Friday:
                                    </label>
                                    <input type="hidden" value="friday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input friday" type="radio"
                                            name="availability_time[friday]" id="friday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="friday_til_ate">... Til late</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input friday" type="radio"
                                            name="availability_time[friday]" id="friday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="friday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input friday" type="radio"
                                            name="availability_time[friday]" id="friday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="friday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="friday"
                                        id="resetFriday">
                                </div>
                            </div>
            
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="saturday">Saturday:
                                    </label>
                                    <input type="hidden" value="saturday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow Saturday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input saturday" type="radio"
                                            name="availability_time[saturday]" id="saturday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="saturday_til_ate">... Til late</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input saturday" type="radio"
                                            name="availability_time[saturday]" id="saturday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="saturday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input saturday" type="radio"
                                            name="availability_time[saturday]" id="saturday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="saturday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="saturday"
                                        id="resetSaturday">
                                </div>
                            </div>
            
                            <div class="d-flex align-items-center justify-content-start flex-wrap gap-20 my-3 parent-row">
                                <div style="width:100px;">
                                    <label class="col-0 label" for="sunday">Sunday:
                                    </label>
                                    <input type="hidden" value="sunday">
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0"
                                    @disabled(true)="">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                        <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class=" p-md-0" style="text-align: center;">
                                    <span class="text-muted font-13">To</span>
                                </div>
            
                                <div class="service_rate_dolor_symbol form-group mb-0">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="mon_hh_to" id="mon_hh_to">
                                    <option value="" selected>H:M</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i . ':00' }}"
                                                {{ sprintf('%02d', $i) . ':00' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:00</option>
                                            <option value="{{ $i . ':30' }}"
                                                {{ sprintf('%02d', $i) . ':30' == $massage_profile->availabilityToHour('saturday') ? 'selected' : '' }}>
                                                {{ sprintf('%02d', $i) }}:30</option>
                                        @endfor
                                    </select>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="mon_time_from">
                                        <option value="" selected >--</option>
                                        <option value="AM" {{( "AM"== $massage_profile->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                                        <option vlaue="PM" {{( "PM"== $massage_profile->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
                                    </select>
                                </div>
            
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input sunday" type="radio"
                                            name="availability_time[sunday]" id="sunday_til_ate" value="til_ate"
                                            data-parsley-multiple="covidreport" availability_time_key="mon">
                                        <label class="form-check-label" for="sunday_til_ate">... Til late</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input sunday" type="radio"
                                            name="availability_time[sunday]" id="sunday_avail_24_hours"
                                            value="Available 24 hours" data-parsley-multiple="covidreport">
                                        <label class="form-check-label" for="sunday_avail_24_hours">Open 24 Hours</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input sunday" type="radio"
                                            name="availability_time[sunday]" id="sunday_Closed"
                                            value="Closed" data-parsley-multiple="covidreport"
                                            checked="" availability_time_key="mon">
                                        <label class="form-check-label"
                                            for="sunday_Closed">Closed</label>
                                    </div>
                                </div>
            
                                <div class="resetdays-icon">
                                    <input type="button" value="Reset" class="resetdays" data-day="sunday"
                                        id="resetSunday">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12 text-right">
                        <button id="my_abilities" type="submit" class="save_profile_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
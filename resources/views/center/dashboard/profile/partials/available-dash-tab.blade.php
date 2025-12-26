<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12">
        <div class="member-id pl-0 pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
            </svg>
            <span>Member ID: M60218:001</span>
        </div>
     </div>
    <div class="about_me_drop_down_info profile-sec p-4 ">
        
        <div class="fill_profile_headings_global">
            <h2>Our Open Time</h2>
        </div>
       

        <div class="about-me-box-one-name stage_name">
            </div>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
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
                                 availability_time_key="mon">
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
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
                                 availability_time_key="mon">
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
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
                                 availability_time_key="mon">
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
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
                                 availability_time_key="mon">
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
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
                                 availability_time_key="mon">
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
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
                                 availability_time_key="mon">
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
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
                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:00</option>
                                <option value="{{ $i . ':30' }}"
                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('saturday') ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}:30</option>
                            @endfor
                        </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="mon_time_from">
                            <option value="" selected >--</option>
                            <option value="AM" {{( "AM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
                        </select>
                    </div>

                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input sunday" type="radio"
                                name="availability_time[sunday]" id="sunday_til_ate" value="til_ate"
                                 availability_time_key="mon">
                            <label class="form-check-label" for="sunday_til_ate">... Til late</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input sunday" type="radio"
                                name="availability_time[sunday]" id="sunday_avail_24_hours"
                                value="Available 24 hours" >
                            <label class="form-check-label" for="sunday_avail_24_hours">Open 24 Hours</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input sunday" type="radio"
                                name="availability_time[sunday]" id="sunday_Closed"
                                value="Closed" 
                                 availability_time_key="mon">
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
    <div class="tab_btm_btns_preview_and_next py-3">
        <div class="row pt-3 pb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a class="prev_step_btn btn_width_hundred"  id="profile-tab" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
               
                <a class="nex_sterp_btn" id="massuers-tab" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="massuers" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
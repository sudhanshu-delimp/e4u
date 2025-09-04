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
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 monday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">
                                        
                                        <label class="col-0 pr-5 label" for="exampleFormControlSelect1">Monday:</label>
                                        <input type="hidden" value="monday">
                                    </div>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group" @disabled(true)>
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
                                        <span>:</span>
                                        {{-- <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="mon_mm_from" name="mon_mm_from">
                                            <option value="" selected >MM</option>
                                            @for($i=0; $i
                                            <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('monday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                        </select> --}}
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_to" id="mon_hh_to">
                                            {{-- <option value="" selected >HH</option>
                                            @for($i=1; $i
                                            <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('monday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor --}}
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
                                        <span>:</span>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_to">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('monday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('monday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input monday" type="radio" name="availability_time[monday]" id="monday" value="closed" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['monday'])) {{ $escort->availability->availability_time['monday'] == 'closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1"> Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input monday" type="radio" name="availability_time[monday]" id="monday" value="By Appointment"  data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['monday'])) {{ $escort->availability->availability_time['monday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input monday" type="radio" name="availability_time[monday]" id="monday" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['monday']))  {{ $escort->availability->availability_time['monday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="monday" id="resetMonday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 tuesday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">                                            
                                        <label class="col-0 pr-5 label" for="exampleFormControlSelect1">Tuesday:</label>
                                        <input type="hidden" value="tuesday">
                                    </div>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_from" id="tue_hh_from">
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
                                        <span>:</span>
                                        </select>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_from">
                                            <option value="" selected disable>--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_to" id="tue_hh_to">
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
                                        <span>:</span>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_to">
                                            <option value="" selected disable>--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('tuesday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('tuesday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tuesday" type="radio" name="availability_time[tuesday]" id="tuesday" value="closed" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['tuesday']))  {{ $escort->availability->availability_time['tuesday'] == 'closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tuesday" type="radio" name="availability_time[tuesday]" id="tuesday" value="By Appointment" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['tuesday']))  {{ $escort->availability->availability_time['tuesday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tuesday" type="radio" name="availability_time[tuesday]" id="tuesday" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['tuesday']))  {{ $escort->availability->availability_time['tuesday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="tuesday" id="resetTuesday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 wednesday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">                                            
                                        <label class="col-0 pr-4 label" for="exampleFormControlSelect1">Wednesday:</label>
                                        <input type="hidden" value="wednesday">
                                    </div>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_from" id="wed_hh_from">
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
                                        <span>:</span>
                                        </select>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_from">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_to" id="wed_hh_to">
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
                                        <span>:</span>
                                        </select>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_to">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('wednesday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('wednesday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input wednesday" type="radio" name="availability_time[wednesday]" id="wednesday" value="closed" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['wednesday'])) {{ $escort->availability->availability_time['wednesday'] =='closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input wednesday" type="radio" name="availability_time[wednesday]" id="wednesday" value="By Appointment" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['wednesday'])) {{ $escort->availability->availability_time['wednesday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input wednesday" type="radio" name="availability_time[wednesday]" id="wednesday" value="Available 24 hours" data-parsley-multiple="covidreport"  @if(!empty($escort->availability->availability_time['wednesday'])) {{ $escort->availability->availability_time['wednesday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="wednesday" id="resetWednesday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 thursday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">                                            
                                        <label class="col-0 label" for="exampleFormControlSelect1">Thursday:</label>
                                        <input type="hidden" value="thursday">
                                    </div>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_from" id="thu_hh_from">
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
                                        <span>:</span>
                                        </select>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_from">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_to" id="thu_hh_to">
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
                                        <span>:</span>
                                        </select>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_to">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('thursday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('thursday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input thursday" type="radio" name="availability_time[thursday]" id="thursday" value="closed" data-parsley-multiple="covidreport"  @if(!empty($escort->availability->availability_time['thursday'])) {{ $escort->availability->availability_time['thursday'] =='closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input thursday" type="radio" name="availability_time[thursday]" id="thursday" value="By Appointment" data-parsley-multiple="covidreport"  @if(!empty($escort->availability->availability_time['thursday'])) {{ $escort->availability->availability_time['thursday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input thursday" type="radio" name="availability_time[thursday]" id="thursday" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['thursday'])) {{ $escort->availability->availability_time['thursday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="thursday" id="resetThursday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 friday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">                                            
                                        <label class="col-0 label" for="exampleFormControlSelect1">Friday:</label>
                                        <input type="hidden" value="friday">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_from" id="fri_hh_from">
                                            <option value="" selected>H:M</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i . ':00' }}"
                                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('friday') ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}:00</option>
                                                <option value="{{ $i . ':30' }}"
                                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('friday') ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}:30</option>
                                            @endfor
                                        </select>
                                        <span>:</span>
                                        
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_from">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_to" id="fri_hh_to">
                                            <option value="" selected>H:M</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i . ':00' }}"
                                                    {{ sprintf('%02d', $i) . ':00' == $escort->availabilityToHour('friday') ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}:00</option>
                                                <option value="{{ $i . ':30' }}"
                                                    {{ sprintf('%02d', $i) . ':30' == $escort->availabilityToHour('friday') ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}:30</option>
                                            @endfor
                                        </select>
                                        <span>:</span>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_to">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('friday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('friday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input friday" type="radio" name="availability_time[friday]" id="friday" value="closed" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['friday'])) {{ $escort->availability->availability_time['friday'] =='closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input friday" type="radio" name="availability_time[friday]" id="friday" value="By Appointment" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['friday'])) {{ $escort->availability->availability_time['friday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input friday" type="radio" name="availability_time[friday]" id="friday" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['friday'])) {{ $escort->availability->availability_time['friday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="friday" id="resetFriday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 saturday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">
                                        
                                <label class="col-0 label" for="exampleFormControlSelect1">Saturday:</label>
                                <input type="hidden" value="saturday">
                                    </div>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_from" id="sat_hh_from">
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
                                        <span>:</span>
                                        
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_from">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_to" id="sat_hh_to">
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
                                        <span>:</span>
                                        
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_to">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('saturday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('saturday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input saturday" type="radio" name="availability_time[saturday]" id="saturday" value="closed" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['saturday'])) {{ $escort->availability->availability_time['saturday'] =='closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input saturday" type="radio" name="availability_time[saturday]" id="saturday" value="By Appointment" data-parsley-multiple="covidreport"@if(!empty($escort->availability->availability_time['saturday'])) {{ $escort->availability->availability_time['saturday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input saturday" type="radio" name="availability_time[saturday]" id="saturday" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['saturday'])) {{ $escort->availability->availability_time['saturday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="saturday" id="resetSaturday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        
                        <div class="col-12 sunday">
                            <div class="row">
                                <div class="col-2 pl-2">
                                    <div class="form-check form-check-inline">
                                        
                                <label class="col-0 label" for="exampleFormControlSelect1">Sunday:</label>
                                <input type="hidden" value="sunday">
                                    </div>
                                    
                                </div>
                                <div class="col-2">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_from" id="">
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
                                        <span>:</span>
                                        </select>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_time_from">
                                            <option value="" selected >--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-0 pr-3">
                                    <span>to</span>
                                </div>
                                <div class="col-2 p-0">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_to" id="">
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
                                        <span>:</span>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="sun_time_to" name="sun_time_to">
                                            <option value="">--</option>
                                            <option value="AM" {{( "AM"== $escort->availabilityToA('sunday')) ? "selected" : ''}}>AM</option>
                                            <option vlaue="PM" {{( "PM"== $escort->availabilityToA('sunday')) ? "selected" : ''}}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input sunday" type="radio" name="availability_time[sunday]" id="sunday" value="closed" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['sunday'])) {{ $escort->availability->availability_time['sunday'] =='closed' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Closed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input sunday" type="radio" name="availability_time[sunday]" id="sunday" value="By Appointment" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['sunday'])) {{ $escort->availability->availability_time['sunday'] == 'By Appointment' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input sunday" type="radio" name="availability_time[sunday]" id="sunday" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time['sunday'])) {{ $escort->availability->availability_time['sunday'] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="resetdays-icon">
                                        <input type="button" value="Reset" class="resetdays" data-day="sunday" id="resetSunday">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next py-3">
        <div class="row pt-3 pb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a class="nex_sterp_btn btn_width_hundred"id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-arrow-left"></i>Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
               
                <a class=" nex_sterp_btn" id="massuers-tab" data-toggle="tab" href="#massuers" role="tab" aria-controls="massuers" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
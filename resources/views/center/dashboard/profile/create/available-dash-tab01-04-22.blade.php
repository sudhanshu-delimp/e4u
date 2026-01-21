<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12">
        <div class="member-id">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{$escort->user->member_id}}</span>
        </div>
    </div>
    <div class="about_me_drop_down_info ">
        <div class="fill_profile_headings_global">
            <h2>My Availability</h2>
        </div>
        <div class="padding_20_all_side my-availability-mon">
            <form class="my-availability-mon-sun" id="myability" action="{{ route('escort.store.availability', [$escort->id])}}" method="Post">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Monday:</label>
                            <input type="hidden" value="monday">
                            <div class="col-10 monday">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                                <option value="" selected>HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i }}" {{($i== $escort->availabilityFromHour('monday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="mon_mm_from" name="mon_mm_from">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('monday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_to" id="mon_hh_to">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('monday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_mm_to" id="mon_mm_to">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('monday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_to">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('monday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('monday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Tuesday:</label>
                            <input type="hidden" value="tuesday">
                            <div class="col-10 tuesday">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_from" id="tue_hh_from">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityFromHour('tuesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="tue_mm_from" name="tue_mm_from">
                                                <option value="" selected >MM</option>
                                                <option value="00">00</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('tuesday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_from">
                                                <option value="" selected disable>--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_to" id="tue_hh_to">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('tuesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_mm_to" id="tue_mm_to">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('tuesday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_to">
                                                <option value="" selected disable>--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('tuesday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('tuesday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Wednesday:</label>
                            <input type="hidden" value="wednesday">
                            <div class="col-10 wednesday">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_from" id="wed_hh_from">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityFromHour('wednesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="wed_mm_from" name="wed_mm_from">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('wednesday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_from">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_to" id="wed_hh_to">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('wednesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_mm_to" id="wed_mm_to">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('wednesday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_to">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('wednesday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('wednesday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Thursday:</label>
                            <input type="hidden" value="thursday">
                            <div class="col-10 thursday">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_from" id="thu_hh_from">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityFromHour('thursday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="thu_mm_from" name="thu_mm_from">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('thursday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_from">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_to" id="thu_hh_to">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('thursday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_mm_to" id="thu_mm_to">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('thursday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_to">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('thursday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('thursday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Friday:</label>
                            <input type="hidden" value="friday">
                            <div class="col-10 friday">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_from" id="fri_hh_from">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityFromHour('friday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="fri_mm_from" name="fri_mm_from">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('friday')) ? "selected" : ""}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_from">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_to" id="fri_hh_to">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('friday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_mm_to" id="fri_mm_to">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('friday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_to">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('friday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('friday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Saturday:</label>
                            <input type="hidden" value="saturday">
                            <div class="col-10 saturday">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_from" id="sat_hh_from">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityFromHour('saturday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="sat_mm_from" name="sat_mm_from">
                                                <option value="">MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('saturday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_from">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_to" id="sat_hh_to">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('saturday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_mm_to" id="sat_mm_to">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('saturday')) ? "selected" : ''}}> {{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_to">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('saturday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('saturday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                    <div class="col-8">
                        <div class="form-group row">
                            <label class="col-2" for="exampleFormControlSelect1">Sunday:</label>
                            <input type="hidden" value="sunday">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_from" id="">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityFromHour('sunday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_mm_from">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityFromMinute('sunday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_time_from">
                                                <option value="" selected >--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="service_rate_dolor_symbol form-group">
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_to" id="">
                                                <option value="" selected >HH</option>
                                                @for($i=1; $i
                                                <=12;$i++) <option vlaue="{{ $i}}" {{($i== $escort->availabilityToHour('sunday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                            </select>
                                            <span>:</span>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_mm_to" id="">
                                                <option value="" selected >MM</option>
                                                @for($i=0; $i
                                                <=6;$i++) <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}" {{((($i==6 )?$i*10-1 : sprintf( '%02d',$i*10))== $escort->availabilityToMinute('sunday')) ? "selected" : ''}}> {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>@endfor
                                            </select>
                                            <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="sun_time_to" name="sun_time_to">
                                                <option value="">--</option>
                                                <option value="AM" {{( "AM"== $escort->availabilityToA('sunday')) ? "selected" : ''}}>AM</option>
                                                <option vlaue="PM" {{( "PM"== $escort->availabilityToA('sunday')) ? "selected" : ''}}>PM</option>
                                            </select>
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
                <div class="row pt-3">
                    <div class="col-8 text-right">
                        <button id="my_abilities" type="submit" class="save_profile_btn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next">
        <div class="row pt-3 pb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 previous_bt_center_in_sm a_text_white_hover">
                <a class="nex_sterp_btn" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">
                <i class="fas fa-arrow-left"></i>Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 previous_bt_center_in_sm text-right a_text_white_hover">
                <a href="{{ route('profile.description',$escort->id)}}" class="save_profile_btn">Preview</a>
                <a href="#pricing" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
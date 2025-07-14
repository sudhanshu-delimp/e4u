<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="fill_profile_headings_global custom--social-head">
        <h2>My Availability</h2>
        <span class="custom--help"><b>Help?</b></span>
    </div>
    <div class="custom-note-section">
        <div class="card" style="">
            <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                <ol class=" mb-0">
                    <li>By completing these settings, the information set out under My Available Times will by default appear in your Profile creator.</li>
                    <li>Leave the time blank if you are unavailable. Select 'By Appointment' as an alternative to a particular time period.</li>
                    <li>You can over ride these settings when creating a Profile, provided you have enabled the <a href="/escort-dashboard/update-account" class="custom_links_design">feature</a> (see My Account - Profile &amp; Tour options).</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="about_me_drop_down_info p-0">
        <div class="padding_20_all_side pb-0 my-availability-mon">
            <form class="my-availability-mon-sun" id="myability" action="{{ route('escort.settings.availability')}}" method="Post">
                @csrf
                @php
                $days = config('escorts.days.capitalize');
                $shortDays = config('escorts.days.short_form');
                @endphp

                @foreach($days as $day => $cDay)

                    {{-- new view --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-10 my-3 parent-row">
                        <div style="width:100px;">
                            <label for="exampleFormControlSelect1">{{$cDay}}:
                            </label>
                            <input type="hidden" value="{{$day}}">
                        </div>
                        {{-- end --}}
                        <div class="service_rate_dolor_symbol form-group mb-0" data-parsley-gt="#{{$shortDays[$day]}}_to" @disabled(true)>
                            <select class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date {{$day}} p-0"
                                    name="{{$shortDays[$day]}}_from" id="{{$shortDays[$day]}}from" >
                                <option value="" selected>H:M</option>
                                @for($i=1; $i <=12;$i++)
                                    <option value="{{ $i.':00' }}" {{(sprintf("%02d", $i).':00'== $escort->availabilityCheck($day, 'from')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}:00</option>
                                    <option value="{{ $i.':30' }}" {{(sprintf("%02d", $i).':30'== $escort->availabilityCheck($day, 'from')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}:30</option>
                                @endfor
                            </select>
                            <select class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date {{$day}} p-0"
                                    id="" name="{{$shortDays[$day]}}_time_from">
                                <option value="" selected>--</option>
                                <option value="AM" {{( "AM"== $escort->availabilityCheckAMorPM($day, 'from')) ? "selected" : ''}}>AM</option>
                                <option value="PM" {{( "PM"== $escort->availabilityCheckAMorPM($day, 'from')) ? "selected" : ''}}>PM</option>
                            </select>
                        </div>
                        {{-- end --}}
                        <div class="p-md-0" style="text-align: center;">
                            <span class="text-muted font-13">To</span>
                        </div>
                        {{-- end --}}
                        <div class="service_rate_dolor_symbol form-group mb-0">
                            <select class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date {{$day}} p-0"
                                    name="{{$shortDays[$day]}}_to" id="{{$shortDays[$day]}}_to">
                                <option value="" selected>H:M</option>
                                @for($i=1; $i <=12;$i++)
                                    <option value="{{ $i.':00' }}" {{(sprintf("%02d", $i).':00'== $escort->availabilityCheck($day, 'to')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}:00</option>
                                    <option value="{{ $i.':30' }}" {{(sprintf("%02d", $i).':30'== $escort->availabilityCheck($day, 'to')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}:30</option>
                                @endfor
                            </select>
                            <select class="form-control form-control-sm select_tag_remove_box_sadow custom-serve-date {{$day}} p-0" id="" name="{{$shortDays[$day]}}_time_to">
                                <option value="" selected >--</option>
                                <option value="AM" {{( "AM"== $escort->availabilityToA($day, 'to')) ? "selected" : ''}}>AM</option>
                                <option value="PM" {{( "PM"== $escort->availabilityToA($day, 'to')) ? "selected" : ''}}>PM</option>
                            </select>
                        </div>
                        {{-- end --}}
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{$day}}" type="radio" name="availability_time[{{$day}}]"
                                        id="{{$day}}_til_ate" value="til_ate"
                                        data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'til_ate' ? 'checked' : ''}} @endif>
                                <label class="form-check-label" for="{{$day}}_til_ate">... Til late</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{$day}}" type="radio" name="availability_time[{{$day}}]" id="{{$day}}_appointment" value="By Appointment"  data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'By Appointment' ? 'checked' : ''}} @endif>
                                <label class="form-check-label" for="{{$day}}_appointment">By Appointment</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{$day}}" type="radio" name="availability_time[{{$day}}]" id="{{$day}}_avail_24_hours" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time[$day]))  {{ $escort->availability->availability_time[$day] == 'Available 24 hours' ? 'checked' : ''}} @endif>
                                <label class="form-check-label" for="{{$day}}_avail_24_hours">Available 24 hours</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{$day}}" type="radio" name="availability_time[{{$day}}]"
                                        id="{{$day}}_unavailable" value="unavailable"
                                        data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'unavailable' ? 'checked' : ''}} @endif>
                                <label class="form-check-label" for="{{$day}}_unavailable">Unavailable</label>
                            </div>
                        </div>
                        {{-- end --}}
                        <div class="resetdays-icon">
                            <input type="button" value="Reset" class="resetdays" data-day="{{$day}}"
                                    id="reset{{$cDay}}">
                        </div>
                        {{-- end --}}
                
                    </div> 
                    {{-- end view--}}

                @endforeach

                <div class="row pt-3">
                    <div class="col-12 text-right">
                        <button id="my_abilities" type="submit" class="save_profile_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

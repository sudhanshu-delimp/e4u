<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    
           
            <form class="my-availability-mon-sun common-form" id="myability" action="{{ route('escort.settings.availability')}}" method="Post">
             <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M7 1C6.44772 1 6 1.44772 6 2V3H5C3.34315 3 2 4.34315 2 6V20C2 21.6569 3.34315 23 5 23H13.101C12.5151 22.4259 12.0297 21.7496 11.6736 21H5C4.44772 21 4 20.5523 4 20V11H20V11.2899C20.7224 11.5049 21.396 11.8334 22 12.2547V6C22 4.34315 20.6569 3 19 3H18V2C18 1.44772 17.5523 1 17 1C16.4477 1 16 1.44772 16 2V3H8V2C8 1.44772 7.55228 1 7 1ZM16 6V5H8V6C8 6.55228 7.55228 7 7 7C6.44772 7 6 6.55228 6 6V5H5C4.44772 5 4 5.44772 4 6V9H20V6C20 5.44772 19.5523 5 19 5H18V6C18 6.55228 17.5523 7 17 7C16.4477 7 16 6.55228 16 6Z" fill="#ff3c5f"></path> <path d="M17 16C17 15.4477 17.4477 15 18 15C18.5523 15 19 15.4477 19 16V17.703L19.8801 18.583C20.2706 18.9736 20.2706 19.6067 19.8801 19.9973C19.4896 20.3878 18.8564 20.3878 18.4659 19.9973L17.2929 18.8243C17.0828 18.6142 16.9857 18.3338 17.0017 18.0588C17.0006 18.0393 17 18.0197 17 18V16Z" fill="#ff3c5f"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18C24 21.3137 21.3137 24 18 24C14.6863 24 12 21.3137 12 18C12 14.6863 14.6863 12 18 12C21.3137 12 24 14.6863 24 18ZM13.9819 18C13.9819 20.2191 15.7809 22.0181 18 22.0181C20.2191 22.0181 22.0181 20.2191 22.0181 18C22.0181 15.7809 20.2191 13.9819 18 13.9819C15.7809 13.9819 13.9819 15.7809 13.9819 18Z" fill="#ff3c5f"></path> </g></svg>
                        </div>
                        <div class="card-heading">
                            <h2>My Availability <span class="custom--help"><b>Help?</b></span></h2>
                        </div>
                    </div>

                    <div class="custom-note-section">
                        <div class="card">
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
                </div>
                <div class="col-lg-12">
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
                                name="{{$shortDays[$day]}}_from" id="{{$shortDays[$day]}}from">
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
                                <option value="" selected>--</option>
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
                                <input class="form-check-input {{$day}}" type="radio" name="availability_time[{{$day}}]" id="{{$day}}_appointment" value="By Appointment" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'By Appointment' ? 'checked' : ''}} @endif>
                                <label class="form-check-label" for="{{$day}}_appointment">By Appointment</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{$day}}" type="radio" name="availability_time[{{$day}}]" id="{{$day}}_avail_24_hours" value="Available 24 hours" data-parsley-multiple="covidreport" @if(!empty($escort->availability->availability_time[$day])) {{ $escort->availability->availability_time[$day] == 'Available 24 hours' ? 'checked' : ''}} @endif>
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
                </div>
            </div>    
               

                <div class="row pt-3">
                    <div class="col-lg-12 common-footer text-right">
                        <button id="my_abilities" type="submit" class="save_profile_btn common-save-btn">Save</button>
                    </div>
                </div>
            </form>
   </div>
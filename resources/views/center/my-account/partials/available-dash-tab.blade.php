<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    
           
        
            <form id="myProfileAvailibilityForms" class="common-form" name="myProfileAvailibilityForms" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">                                                
                    <div class="row inner-row">
                        <div class="col-lg-12">
                            <div class="card-top">
                                <div class="card-icon">
                                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M7 1C6.44772 1 6 1.44772 6 2V3H5C3.34315 3 2 4.34315 2 6V20C2 21.6569 3.34315 23 5 23H13.101C12.5151 22.4259 12.0297 21.7496 11.6736 21H5C4.44772 21 4 20.5523 4 20V11H20V11.2899C20.7224 11.5049 21.396 11.8334 22 12.2547V6C22 4.34315 20.6569 3 19 3H18V2C18 1.44772 17.5523 1 17 1C16.4477 1 16 1.44772 16 2V3H8V2C8 1.44772 7.55228 1 7 1ZM16 6V5H8V6C8 6.55228 7.55228 7 7 7C6.44772 7 6 6.55228 6 6V5H5C4.44772 5 4 5.44772 4 6V9H20V6C20 5.44772 19.5523 5 19 5H18V6C18 6.55228 17.5523 7 17 7C16.4477 7 16 6.55228 16 6Z" fill="#ff3c5f"></path> <path d="M17 16C17 15.4477 17.4477 15 18 15C18.5523 15 19 15.4477 19 16V17.703L19.8801 18.583C20.2706 18.9736 20.2706 19.6067 19.8801 19.9973C19.4896 20.3878 18.8564 20.3878 18.4659 19.9973L17.2929 18.8243C17.0828 18.6142 16.9857 18.3338 17.0017 18.0588C17.0006 18.0393 17 18.0197 17 18V16Z" fill="#ff3c5f"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18C24 21.3137 21.3137 24 18 24C14.6863 24 12 21.3137 12 18C12 14.6863 14.6863 12 18 12C21.3137 12 24 14.6863 24 18ZM13.9819 18C13.9819 20.2191 15.7809 22.0181 18 22.0181C20.2191 22.0181 22.0181 20.2191 22.0181 18C22.0181 15.7809 20.2191 13.9819 18 13.9819C15.7809 13.9819 13.9819 15.7809 13.9819 18Z" fill="#ff3c5f"></path> </g></svg>
                                </div>
                                <div class="card-heading">
                                    <h2>Open Times <span class="custom--help"><b>Help?</b></span></h2>
                                </div>
                            </div>
                            <div class="custom-note-section">
                                <div class="card">
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
                        </div>
                        <div class="col-lg-12">
                                <div class="padding_20_all_side my-availability-mon profile_time_availibility">
                                        @php 
                                            $days = [ 'monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 'saturday' => 'Saturday', 'sunday' => 'Sunday', ]; 


                                            function splitTime($time) {
                                                if (!$time) return [null, null];
                                                return explode(' ', $time);
                                            }

                                        @endphp 
                                        
                                        
                                        @foreach ($days as $dayKey => $dayLabel)

                                        @php
                                            $dayData = $availability[$dayKey] ?? [];

                                            $status = $dayData['status'] ?? '';

                                            [$fromTime, $fromAmPm] = splitTime($dayData['from'] ?? null);
                                            [$toTime, $toAmPm]     = splitTime($dayData['to'] ?? null);

                                            $isTilLate = $status === 'til_late';
                                            $is24Hours = $status === '24_hours';
                                            $isClosed  = $status === 'closed';
                                            $isCustom  = $status === 'custom';

                                            $disableFrom = $isClosed || $is24Hours;
                                            $disableTo   = $isClosed || $is24Hours || $isTilLate;
                                        @endphp

                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-10 my-3 parent-row" data-day="{{ $dayKey }}">

                                        <label style="width:100px;"><strong>{{ $dayLabel }}:</strong></label>

                                        {{-- FROM --}}
                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                        <select name="time[{{ $dayKey }}][hh_from]" class="form-control" {{ $disableFrom ? 'disabled' : '' }}>
                                            <option value="">H:M</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @foreach (['00','30'] as $m)
                                                    @php $val = sprintf('%02d:%s', $i, $m); @endphp
                                                    <option value="{{ $val }}" {{ $fromTime === $val ? 'selected' : '' }}>
                                                        {{ $val }}
                                                    </option>
                                                @endforeach
                                            @endfor
                                        </select>

                                        <select name="time[{{ $dayKey }}][ampm_from]" class="form-control" {{ $disableFrom ? 'disabled' : '' }}>
                                            <option value="">--</option>
                                            <option value="AM" {{ $fromAmPm === 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM" {{ $fromAmPm === 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                        </div>
                                        <span class="mx-2">To</span>

                                        {{-- TO --}}
                                        <div class="service_rate_dolor_symbol form-group mb-0">
                                        <select name="time[{{ $dayKey }}][hh_to]" class="form-control" {{ $disableTo ? 'disabled' : '' }}>
                                            <option value="">H:M</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                @foreach (['00','30'] as $m)
                                                    @php $val = sprintf('%02d:%s', $i, $m); @endphp
                                                    <option value="{{ $val }}" {{ $toTime === $val ? 'selected' : '' }}>
                                                        {{ $val }}
                                                    </option>
                                                @endforeach
                                            @endfor
                                        </select>

                                        <select name="time[{{ $dayKey }}][ampm_to]" class="form-control" {{ $disableTo ? 'disabled' : '' }}>
                                            <option value="">--</option>
                                            <option value="AM" {{ $toAmPm === 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM" {{ $toAmPm === 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                        </div>
                                         <input type="hidden" name="availability_time[{{ $dayKey }}]" value="custom">
                                         
                                        {{-- STATUS --}}
                                        <label class="ms-3">
                                            <input type="radio"
                                                name="availability_time[{{ $dayKey }}]"
                                                value="til_late"
                                                {{ $isTilLate ? 'checked' : '' }}>
                                            Til late
                                        </label>

                                        <label class="ms-2" style="display: none;">
                                            <input type="radio"
                                                name="availability_time[{{ $dayKey }}]"
                                                value="24_hours"
                                                {{ $is24Hours ? 'checked' : '' }}>
                                            Open 24 Hours
                                        </label>

                                        <label class="ms-2"> 
                                            <input type="radio"
                                                name="availability_time[{{ $dayKey }}]"
                                                value="closed"
                                                {{ $isClosed ? 'checked' : '' }}>
                                            Closed
                                        </label>

                                        <div class="resetdays-icon"> <input type="button" value="Reset" class="resetdays" data-day="sunday" id="resetSunday"> </div>


                                    </div>
                                    @endforeach

                                </div>

                        </div>
                        

                        <div class="col-md-12 text-right common-footer">
                            <input type="hidden" name="type" id="type" value="availibility">
                            <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                            <input type="hidden" name="profile_time_avail_update" id="profile_time_avail_update" value="profile_time_avail_update">
                            <button id="read-more" type="submit" class="save_profile_btn common-save-btn">Update</button>
                        </div>
                    </div>
        </form> 


       
</div>


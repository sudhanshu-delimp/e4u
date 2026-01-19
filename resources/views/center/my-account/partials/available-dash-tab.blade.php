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
           
        
            <form id="myProfileAvailibilityForms" name="myProfileAvailibilityForms" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">                                                
                    <div class="row">
                        <div class="col-12">
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

                                            $status = $dayData['status'] ?? 'closed';

                                            [$fromTime, $fromAmPm] = splitTime($dayData['from'] ?? null);
                                            [$toTime, $toAmPm]     = splitTime($dayData['to'] ?? null);

                                            $isTilLate = $status === 'til_late';
                                            $is24Hours = $status === '24_hours';
                                            $isClosed  = $status === 'closed';
                                            $isCustom  = $status === 'custom';

                                            $disableFrom = $isClosed || $is24Hours;
                                            $disableTo   = $isClosed || $is24Hours || $isTilLate;
                                        @endphp

                                    <div class="d-flex align-items-center flex-wrap gap-20 my-3 parent-row" data-day="{{ $dayKey }}">

                                        <label style="width:100px;"><strong>{{ $dayLabel }}:</strong></label>

                                        {{-- FROM --}}
                                        <select name="time[{{ $dayKey }}][hh_from]" {{ $disableFrom ? 'disabled' : '' }}>
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

                                        <select name="time[{{ $dayKey }}][ampm_from]" {{ $disableFrom ? 'disabled' : '' }}>
                                            <option value="">--</option>
                                            <option value="AM" {{ $fromAmPm === 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM" {{ $fromAmPm === 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>

                                        <span class="mx-2">To</span>

                                        {{-- TO --}}
                                        <select name="time[{{ $dayKey }}][hh_to]" {{ $disableTo ? 'disabled' : '' }}>
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

                                        <select name="time[{{ $dayKey }}][ampm_to]" {{ $disableTo ? 'disabled' : '' }}>
                                            <option value="">--</option>
                                            <option value="AM" {{ $toAmPm === 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM" {{ $toAmPm === 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>

                                         <input type="hidden" name="availability_time[{{ $dayKey }}]" value="custom">
                                         
                                        {{-- STATUS --}}
                                        <label class="ms-3">
                                            <input type="radio"
                                                name="availability_time[{{ $dayKey }}]"
                                                value="til_late"
                                                {{ $isTilLate ? 'checked' : '' }}>
                                            Til late
                                        </label>

                                        <label class="ms-2">
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


                                <div class="">
                                        <div class="col-md-12 text-right">
                                            <input type="hidden" name="type" id="type" value="availibility">
                                            <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                                            <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                        </div>
                                </div>

                        </div>
                    </div>
        </form> 


        </div>
    </div>
</div>


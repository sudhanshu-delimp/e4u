<div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
    <div class="col-lg-12">
        <div class="member-id pl-0 pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
            </svg>
            <span>Member ID: M60218:001</span>
        </div>
     </div>



   


  <div class="about_me_drop_down_info profile-sec p-4">
        

    <div class="about-me-box-one-name stage_name">Our Open Time</div>
    <div class="padding_20_all_side my-availability-mon">
           
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
                                            <input type="hidden" name="massage_id" id="massage_id" value="{{$escort->id}}">
                                            <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                        </div>
                                </div>

                        </div>
                    </div>
        </form> 
              
    </div>
    </div>


    
    <div class="tab_btm_btns_preview_and_next py-3">
        <div class="row pt-3 pb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a class="prev_step_btn btn_width_hundred"  id="profile-tab-prev" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
               
                <a class="nex_sterp_btn" id="massuers-tab-next" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="massuers" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
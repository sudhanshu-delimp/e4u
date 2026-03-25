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

        @php

        $days = [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ];

       
        function generateTimes($start, $end, $selected = '', $minTime = null) {

            $startTime = strtotime($start);
            $endTime   = strtotime($end);

            
            if ($end == '12:00 AM') {
                $endTime = strtotime('tomorrow 12:00 AM');
            }

            // fallback safety
            if ($endTime <= $startTime) {
                $endTime = strtotime('+1 day', $endTime);
            }

            $output = '';

            for ($time = $startTime; $time <= $endTime; $time += 1800) {

                $formatted = date('h:i A', $time);

                // skip invalid TO values
                if ($minTime && strtotime($formatted) <= strtotime($minTime)) {
                    continue;
                }

                $selectedAttr = ($formatted == $selected) ? 'selected' : '';
                $output .= "<option value=\"$formatted\" $selectedAttr>$formatted</option>";
            }

            return $output;
        }
        @endphp

        <div class="padding_20_all_side my-availability-mon">
           
       
                <div class="row"  id="my-avail-time">
                    <div class="col-12">
                        <div class="padding_20_all_side my-availability-mon profile_time_availibility">

                                     @foreach ($days as $dayKey => $dayLabel)

                                            @php
                                                $dayData = $availability[$dayKey] ?? [];

                                                $status = $dayData['status'] ?? 'custom';
                                                $from   = $dayData['from'] ?? '';
                                                $to     = $dayData['to'] ?? '';

                                                $disabled = ($status == 'closed') ? 'disabled' : '';

                                                // 🔹 DEFAULT full day
                                                $fromStart = '12:00 AM';
                                                $fromEnd   = '12:00 AM';

                                                $toStart   = '12:00 AM';
                                                $toEnd     = '12:00 AM';

                                                // 🔹 TILL LATE
                                            if ($status == 'til_late' && $from) {

                                                $fromStart = $from;
                                                $fromEnd   = '11:30 PM';

                                                $toStart = date('h:i A', strtotime($from . ' +30 minutes'));
                                                $toEnd   = '12:00 AM'; // must be this
                                            }

                                                // 🔹 CUSTOM
                                                if ($status == 'custom' && $from && $to) {

                                                    $fromStart = $from;
                                                    $fromEnd   = date('h:i A', strtotime($to . ' -30 minutes'));

                                                    $toStart   = date('h:i A', strtotime($from . ' +30 minutes'));
                                                    $toEnd     = $to;
                                                }

                                            @endphp



                                        <div class="d-flex align-items-center flex-wrap gap-20 my-3 parent-row">

                                                <label style="width:100px;"><strong>{{ $dayLabel }}:</strong></label>
                                                <!-- FROM -->
                                                <select name="time[{{ $dayKey }}][hh_from]"
                                                        class="time-field hh_from from"
                                                        {{ $disabled }}>

                                                    <option value="">Select</option>

                                                    {!! generateTimes($fromStart, $fromEnd, $from) !!}

                                                </select>

                                                <span class="mx-2">To</span>

                                                <!-- TO -->
                                                <select name="time[{{ $dayKey }}][hh_to]"
                                                        class="time-field hh_to to"
                                                        {{ $disabled }}>

                                                    <option value="">Select</option>

                                                @if($status == 'til_late')
                                                    {!! generateTimes($toStart, $toEnd, $to, $from) !!}
                                                    <option value="12:00 AM" {{ $to == '12:00 AM' ? 'selected' : '' }}>12:00 AM</option>
                                                @else
                                                    {!! generateTimes($toStart, $toEnd, $to, $from) !!}
                                                @endif

                                                </select>

                                                <!-- STATUS -->
                                                <label class="ms-3" style="display: none;">
                                                <input type="radio" name="availability_time[{{ $dayKey }}]"
                                                    value="custom" {{ $status=='custom'?'checked':'' }} {{ $disabled }}> Custom
                                                </label>

                                                <label class="ms-2">
                                                <input type="radio" name="availability_time[{{ $dayKey }}]"
                                                    value="til_late" {{ $status=='til_late'?'checked':'' }} {{ $disabled }}> Til Late
                                                </label>

                                                <label class="ms-2">
                                                <input type="radio" name="availability_time[{{ $dayKey }}]"
                                                    value="closed" {{ $status=='closed'?'checked':'' }}> Closed
                                                </label>

                                                @if($status!='closed')
                                                <div class="resetdays-icon">
                                                        <input type="button" value="Reset" class="resetdays"> 
                                                </div>
                                                @endif

                                        </div>

                            
                            @endforeach

                        </div>
                    </div>
                </div>
            

              
           
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
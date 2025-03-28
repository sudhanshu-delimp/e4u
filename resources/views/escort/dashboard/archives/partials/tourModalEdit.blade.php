<div class='card'>
    <div class='card-header'> <a class='card-link' data-toggle='collapse' href='#my_play_mates' aria-expanded='true' style='font-size: 1rem;'>Location {{$key +1}}<span style='color:red'>*</span></a> </div>
    <div id='my_play_mates' class='collapse show ' data-parent='#accordion' style=''>
        <div class='card-body border-0 p-0 mt-4'>
            <div class='form-group'>
                    <select class='custom-select addMore_Location' id='addLocation_{{$key +1}}' name='stateId[]' required data-parsley-required-message=" Please select Location" data-parsley-errors-container="#loc_{{$key +1}}">
                        <option value='' selected=''>Select Location</option>
                        
                        @foreach(config('escorts.profile.states') as $keyVal => $state)
                        <option value="{{$keyVal}}" {{$tour_location->location_id == $keyVal ? 'selected' : ''}}>{{$state['stateName']}}</option>
                        @endforeach
                    </select>
            </div><span id='loc_{{$key +1}}'></span>
            <div class='form-inline pt-2' style=''>
                <div class='form-group mb-2'>
                    <label for='staticEmail2' class='sr-only'>Assign Profile</label> 
                    <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Assign Profile <span style='color:red'>*</span></label>
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12' style=''>
                        <div class='form-group' style=''>
                            {{-- akhReset' id='inputGroupSelect01' --}}
                            <select class='custom-select addAssign_{{$key +1}}' id='assignProfile_{{$tour_location->location_id}}' style='width: 180px;' name='escortId[]' required data-parsley-required-message=" Please select Profile" data-parsley-errors-container="#assign_profile_{{$key +1}}">
                                <option value='' selected=''>-Assign Profile-</option>
                                @foreach($escorts as $escort)
                                <option value='{{$escort->id}}' {{$tour_location->profile_id == $escort->id ? 'selected' : ''}}>{{$escort->profile_name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" value="{{$tour_location->profile_id}}/ {{$escort->id}}">
                        </div>
                    </div>
                </div><span id="assign_profile_{{$key +1}}"></span>
            </div>
            {{-- {{ dd($find_tour->location) }} --}}
            <div class='form-inline' style=''>
                <div class='form-group mb-2'>
                    <label for='staticEmail2' class='sr-only'>Start Date</label>
                    <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Start Date: <span style='color:red'>*</span></label>
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12'>
                        <div class='service_rate_dolor_symbol form-group'>
                            <input type="date" name="start_date[]" class="akhReset" id="startDate_{{$key +1}}" min="{{ date('Y-m-d')}}" value="{{ Carbon\Carbon::parse($tour_location->start_date)->format('Y-m-d') }}" required data-parsley-required-message=" Please select Start Date">
                            
                        </div>
                    </div>
                </div><span id='sdate_{{$key +1}}'></span>
                <div class='form-group mb-2 w-100' style=''>
                        <label for='staticEmail2' class='sr-only'>to</label>
                        <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>To</label>
                </div>
                <div class='form-inline' style=''>
                    <div class='form-group mb-2'>
                        <label for='staticEmail2' class='sr-only'>End Date:</label>
                        <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>End Date: <span style='color:red'>*</span></label>
                    </div>
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12'>
                        <div class='service_rate_dolor_symbol form-group'>
                            <input type="date" name="end_date[]" class="akhReset"  id="endDate_{{$key +1}}" value='{{ Carbon\Carbon::parse($tour_location->end_date)->format('Y-m-d') }}' required data-parsley-required-message=" Please select End Date">
                           
                        </div>
                    </div>
                </div><span id="edate_{{$key +1}}"></span>
            </div>
            
            <div class='form-inline pt-2' style=''>
                <div class='form-group mb-2'>
                   <label for='staticEmail2' class='sr-only'>Tour Plan</label> 
                   <label class='form-control-plaintext' id='staticEmail2'>Tour Plan <span style='color:red'>*</span></label> 
                </div>
                <div class='form-group mb-2'>
                   <div class='col-12' style=''>
                      <div class='form-group' style=''>
                         <select class='custom-select addplan_{{$key +1}}' id='tourPlan_{{$key +1}}' style='width: 188px;' name='tour_plan[]' required data-parsley-required-message=" Please select Plan">
                            <option value='' selected=''>-Select Plan-</option>
                            <option value="1" {{($tour_location->tour_plan == 1) ? 'selected' : ''}}>Platinum</option>
                            <option value="2" {{($tour_location->tour_plan == 2) ? 'selected' : ''}}>Gold</option>
                            <option value="3" {{($tour_location->tour_plan == 3) ? 'selected' : ''}}>Silver</option>
                            <option value="4" {{($tour_location->tour_plan == 4) ? 'selected' : ''}}>Free</option>
                            {{-- @foreach($user_names as $escort)
                            <option value='{{$escort->id}}'>{{$escort->profile_name}}</option>
                            @endforeach --}}
                         </select>
                      </div>
                   </div>
                </div>
                
             </div>
        </div>
    </div>
</div>

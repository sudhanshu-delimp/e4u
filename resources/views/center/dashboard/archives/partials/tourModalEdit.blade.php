<div class='card'>
    <div class='card-header'> <a class='card-link' data-toggle='collapse' href='#my_play_mates' aria-expanded='true' style='font-size: 1rem;'>Location {{$key +1}}<span style='color:red'>*</span></a> </div>
    <div id='my_play_mates' class='collapse show' data-parent='#accordion' style=''>
        <div class='card-body border-0 p-0 mt-4'>
            <div class='form-group'>
                    <select class='custom-select' id='inputGroupSelect01' name='cityId[]' required data-parsley-required-message=" Please select Location" data-parsley-errors-container="#loc_{{$key +1}}">
                        <option value='' selected=''>Select Location</option>
                        
                        @foreach(config('escorts.profile.cities') as $cityId => $city)
                        <option value="{{$cityId}}" {{$tour_location->location_id == $cityId ? 'selected' : ''}}>{{$city}}</option>
                        @endforeach
                    </select>
            </div><span id='loc_{{$key +1}}'></span>
            {{-- {{ dd($find_tour->location) }} --}}
            <div class='form-inline' style=''>
                <div class='form-group mb-2'>
                    <label for='staticEmail2' class='sr-only'>Start Date</label>
                    <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Start Date: <span style='color:red'>*</span></label>
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12'>
                        <div class='service_rate_dolor_symbol form-group'>
                            <input type="date" name="start_date[]" class="akhReset" id="start_date_{{$key +1}}" value="{{ Carbon\Carbon::parse($tour_location->start_date)->format('Y-m-d') }}" required data-parsley-required-message=" Please select Start Date" data-parsley-errors-container="#sdate_{{$key +1}}">
                            
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
                            <input type="date" name="end_date[]" class="akhReset"  id="end_date_{{$key +1}}" value='{{ Carbon\Carbon::parse($tour_location->end_date)->format('Y-m-d') }}' required data-parsley-errors-container="#edate_{{$key +1}}" data-parsley-required-message=" Please select End Date">
                           
                        </div>
                    </div>
                </div><span id="edate_{{$key +1}}"></span>
            </div>
            <div class='form-inline pt-2' style=''>
                <div class='form-group mb-2'>
                    <label for='staticEmail2' class='sr-only'>Assign Profile</label> 
                    <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Assign Profile <span style='color:red'>*</span></label>
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12' style=''>
                        <div class='form-group' style=''>
                            <select class='custom-select akhReset' id='inputGroupSelect01' style='width: 180px;' name='escortId[]' required data-parsley-required-message=" Please select Profile" data-parsley-errors-container="#assign_profile_{{$key +1}}">
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
            
        </div>
    </div>
</div>

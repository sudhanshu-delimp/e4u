<div class='card'>
    <div class='card-header'> <a class='card-link' data-toggle='collapse' href='#my_play_mates' aria-expanded='true' style='font-size: 1rem;'>Location 1 <span style='color:red'>*</span></a> </div>
    <div id='my_play_mates' class='collapse show' data-parent='#accordion' style=''>
        <div class='card-body border-0 p-0 mt-4'>
            <div class='form-group'>
                    <select class='custom-select' id='inputGroupSelect01' name='cityId[]' required data-parsley-required-message=" Please select Location" data-parsley-errors-container="#loc_1" data-parsley-trigger='change focusout' data-parsley-class-handler ='#email-group' >
                       
                        <option value='' selected=''>Select Location</option>
                        
                        {{-- @foreach(config('escorts.profile.states') as $key => $value)
                        
                            @foreach($value['cities'] as $cityId => $city)
                            <option value="{{$cityId}}">{{$city['cityName']}}</option>
                            @endforeach
                        @endforeach --}}
                        @foreach(config('escorts.profile.cities') as $cityId => $city)
                        
                            
                            <option value="{{$cityId}}">{{$city}}</option>
                            
                        @endforeach
                    </select>
            </div> <span id='loc_1'></span>
            <div class='form-inline' style=''>
                <div class='form-group mb-2'>
                    <label for='staticEmail2' class='sr-only'>Start Date</label>
                    <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Start Date: <span style='color:red'>*</span></label> 
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12'>
                        <div class='service_rate_dolor_symbol form-group'>
                            <input type="date" name="start_date[]" class="akhReset" id="start_date_1" required data-parsley-required-message=" Please select Start Date" data-parsley-errors-container="#sdate_1">
                            
                        </div>
                        
                    </div>
                </div><span id='sdate_1'></span>
                <div class='form-group mb-2 w-100' style=''>
                        <label for='staticEmail2' class='sr-only'>to</label>
                        <label class='form-control-plaintext' id='staticEmail2' style='width: 90px;'>To</label>  
                    
                </div>
            </div>
                <div class='form-inline' style=''>
                    <div class='form-group mb-2'>
                        <label for='staticEmail2' class='sr-only'>End Date</label>
                        <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>End Date: <span style='color:red'>*</span></label> 
                    </div>
                <div class='form-group mb-2'>
                    <div class='col-12'>
                        <div class='service_rate_dolor_symbol form-group'>
                            <input type="date" name="end_date[]" class="akhReset" id="end_date_1" required data-parsley-errors-container="#edate_1" data-parsley-required-message=" Please select End Date">
                           
                        </div>
                        
                    </div>
                </div><span id="edate_1"></span>
            </div>
            <div class='form-inline pt-2' style=''>
                <div class='form-group mb-2'>
                    <label for='staticEmail2' class='sr-only'>Assign Profile</label> 
                    <label class='form-control-plaintext' id='staticEmail2'>Assign Profile <span style='color:red'>*</span></label> 
                   
                </div>
                <div class='form-group mb-2'>
                    <div class='col-12' style=''>
                        <div class='form-group' style=''>
                            <select class='custom-select' id='inputGroupSelect01' style='width: 188px;' name='escortId[]' required data-parsley-required-message=" Please select Profile" data-parsley-errors-container="#assign_profile_1">

                                <option value='' selected=''>-Assign Profile-</option>
                                @foreach($escorts as $escort)
                                <option value='{{$escort->id}}'>{{$escort->profile_name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div><span id="assign_profile_1"></span>
            </div>
            
        </div>
    </div>
</div>
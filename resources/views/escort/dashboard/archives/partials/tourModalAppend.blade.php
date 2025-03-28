"<div class='card'>"+
"    <div class='card-header'>"+
"        <a class='card-link' data-toggle='collapse' href='#my_play_mates' aria-expanded='true' style='font-size: 1rem;'>Location "+row_count+" <span style='color:red'>*</span></a>"+
"    </div>"+
"    <div id='my_play_mates' class='collapse show' data-parent='#accordion' style=''>"+
"        <div class='card-body border-0 p-0 mt-4'>"+
"            <div class='form-group'>"+
"                <select class='custom-select addMore_Location' id='addLocation_"+row_count+"' required name='stateId[]' data-parsley-errors-container='#loc_"+row_count+"' data-parsley-required-message='Please select Location'>"+
"                    <option value='' selected=''>Select Location"+
"                    </option>"+
                    @foreach(config('escorts.profile.states') as $key => $state)
"                        <option value='{{$key}}' @if(!in_array($key, $escorts->pluck('state_id')->toArray()))  disabled style='background-color:#76767687' @endif>{{$state['stateName']}}</option>"+
                    @endforeach
"                </select>"+
"            </div>"+
"            <span id='loc_"+row_count+"'></span>"+
"            <div class='form-inline pt-2' style=''>"+
"                <div class='form-group mb-2'>"+
"                    <label for='staticEmail2' class='sr-only'>Assign Profile</label>"+
"                    <label class='form-control-plaintext' id='staticEmail2' style='width: 130px;'>Assign Profile <span style='color:red'>*</span></label></div>"+
"                <div class='form-group mb-2'>"+
"                    <div class='col-12' style=''>"+
"                        <div class='form-group' style=''>"+
"                            <select class='custom-select addAssign_"+row_count+"' id='assignProfile_' style='width: 188px;' name='escortId[]' required data-parsley-required-message='Please select Profile' disabled data-parsley-errors-container='#assign_profile_"+row_count+"'>"+
"                                <option value='' selected=''>-Assign Profile-</option>"+
                                @foreach($user_names as $escort)
"                                    <option value='{{$escort->id}}'>{{$escort->profile_name}}</option>"+
                                @endforeach
"                            </select></div>"+
"                    </div>"+
"                </div>"+
"                <span id='assign_profile_"+row_count+"'></span></div>"+
"            <div class='form-inline' style=''>"+
"                <div class='form-group mb-2'><label for='staticEmail2' class='sr-only'>Start Date</label> <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Start Date: <span style='color:red'>*</span></label></div><div class='form-group mb-2 ml-3 pl-1'>"+
"                    <div class='col-12'>"+
"                        <div class='service_rate_dolor_symbol form-group'>"+
"                            <input type='text' class='akhReset' name='start_date[]' id='startDate_"+row_count+"' required data-parsley-required-message='Please select Start Date'>"+
"                        </div>"+
"                    </div>"+
"                </div>"+
"                <span id='sdate_"+row_count+"'></span>"+
"                <div class='form-group mb-2 w-100' style=''><label for='staticEmail2' class='sr-only'> to</label>"+
"                    <label class='form-control-plaintext' id='staticEmail2' style='width: 90px;'>To</label></div>"+
"            </div>"+
"            <div class='form-inline' style=''>"+
"                <div class='form-group mb-2'><label for='staticEmail2' class='sr-only'> End Date</label>"+
"                    <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>End Date: <span style='color:red'>*</span></label>"+
"                </div>"+
"                <div class='form-group mb-2 ml-3 pl-1'>"+
"                    <div class='col-12'>"+
"                        <div class='service_rate_dolor_symbol form-group'>"+
"                            <input type='text' name='end_date[]' class='akhReset' id='endDate_"+row_count+"' required data-parsley-required-message='Please select End Date'>"+
"                        </div>"+
"                    </div>"+
"                </div>"+
"                <span id='edate_"+row_count+"'></span></div>"+
"            <div class='form-inline pt-2' style=''>"+
"                <div class='form-group mb-2'><label for='staticEmail2' class='sr-only'>Tour Plan</label>"+
"                    <label class='form-control-plaintext' id='staticEmail2'>Tour Plan <span style='color:red'>*</span></label></div>"+
"                <div class='form-group mb-2'>"+
"                    <div class='col-12' style=''>"+
"                        <div class='form-group pl-3' style=''>"+
"                            <select class='custom-select addplan_"+row_count+" ml-4' id='tourPlan_"+row_count+"' style='width: 188px;' name='tour_plan[]' required data-parsley-required-message='Please select Plan'>"+
"                                <option value='' selected=''>-Select Plan-</option>"+
"                                <option value='1'>Platinum</option>"+
"                                <option value='2'>Gold</option>"+
"                                <option value='3'>Silver</option>"+
"                                <option value='4'>Free</option>"+
"                            </select></div>"+
"                    </div>"+
"                </div>"+
"            </div>"+
"        </div>"+
"    </div>"+
"</div>"

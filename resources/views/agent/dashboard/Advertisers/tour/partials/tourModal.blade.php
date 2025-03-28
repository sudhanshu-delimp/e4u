<style type="text/css">
   .akhReset {
    width: 188px;
}
</style>
<div class='card'>
   <div class='card-header'> <a class='card-link' data-toggle='collapse' href='#my_play_mates' aria-expanded='true' style='font-size: 1rem;'>Location 1 <span style='color:red'>*</span></a> </div>
   <div id='my_play_mates' class='collapse show' data-parent='#accordion' style=''>
      <div class='card-body border-0 p-0 mt-4'>
         <div class='form-group'>
            {{-- {{ dd($escorts->cities->name) }} --}}
            <select class='custom-select addMore_Location' id='addLocation_1' name='stateId[]' required data-parsley-required-message=" Please select Location" data-parsley-errors-container="#loc_1" data-parsley-trigger='change focusout' data-parsley-class-handler ='#email-group' >
               <option value='' selected=''>Select Location</option>
               
               {{-- @foreach($escorts as $state)
                  <option data-name="{{ $state->name }}" value="{{$state->state_id}}">{{ $state->state->name }}</option>
               @endforeach --}}
              
              
               @foreach(config('escorts.profile.states') as $key => $state)
               <option value="{{$key}}"  @if(!in_array($key, $escorts->pluck('state_id')->toArray()))  disabled style="background-color:#76767687"@endif>{{$state['stateName']}}</option>
               @endforeach
            </select>
         </div>
         <span id='loc_1'></span>
         <div class='form-inline pt-2' style=''>
            <div class='form-group mb-2'>
               <label for='staticEmail2' class='sr-only'>Assign Profile</label> 
               <label class='form-control-plaintext' id='staticEmail2'>Assign Profile <span style='color:red'>*</span></label> 
            </div>
            <div class='form-group mb-2'>
               <div class='col-12' style=''>
                  <div class='form-group' style=''>
                     <select class='custom-select addAssign_1' id='assignProfile_' style='width: 188px;' name='escortId[]' required data-parsley-required-message=" Please select Profile" data-parsley-errors-container="#assign_profile_1">
                        <option value='' selected=''>-Assign Profile-</option>
                        {{-- @foreach($user_names as $escort)
                        <option value='{{$escort->id}}'>{{$escort->profile_name}}</option>
                        @endforeach --}}
                     </select>
                  </div>
               </div>
            </div>
            <span id="assign_profile_1"></span>
         </div>
         <div class='form-inline' style=''>
            <div class='form-group mb-2'>
               <label for='staticEmail2' class='sr-only'>Start Date</label>
               <label class='form-control-plaintext' id='staticEmail2' style='width: 110px;'>Start Date: <span style='color:red'>*</span></label> 
            </div>
            <div class='form-group mb-2'>
               <div class='col-12 pl-4'>
                  <div class='service_rate_dolor_symbol form-group'>
                     <input type="date" name="start_date[]" class="akhReset" id="startDate_1" required data-parsley-required-message=" Please select Start Date" min="{{ date('Y-m-d')}}" >
                     {{-- data-parsley-errors-container="#sdate_1" --}}
                  </div>
               </div>
            </div>
            <span id='sdate_1'></span>
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
               <div class='col-12 pl-4'>
                  <div class='service_rate_dolor_symbol form-group'>
                     <input type="date" name="end_date[]" class="akhReset" id="endDate_1" required  data-parsley-required-message=" Please select End Date">
                     {{-- data-parsley-errors-container="#edate_1" --}}
                  </div>
               </div>
            </div>
            <span id="edate_1"></span>
         </div>
         <div class='form-inline pt-2' style=''>
            <div class='form-group mb-2'>
               <label for='staticEmail2' class='sr-only'>Tour Plan</label> 
               <label class='form-control-plaintext' id='staticEmail2'>Tour Plan <span style='color:red'>*</span></label> 
            </div>
            <div class='form-group mb-2'>
               <div class='col-12 pl-4' style=''>
                  <div class='form-group' style=''>
                     <select class='custom-select addplan_1 ml-4' id='tourPlan_' style='width: 186px;' name='tour_plan[]' required data-parsley-required-message=" Please select Plan">
                        <option value='' selected=''>-Select Plan-</option>
                        <option value="1" >Platinum</option>
                        <option value="2">Gold</option>
                        <option value="3" >Silver</option>
                        <option value="4">Free</option>
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
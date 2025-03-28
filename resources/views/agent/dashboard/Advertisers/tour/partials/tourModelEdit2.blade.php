{{-- {{ Carbon\Carbon::parse($tour_location->end_date)->format('Y-m-d') }}
{{ date('Y-m-d') }} --}}



<div class='card' id="card_{{$key +1}}">
    <div class='card-header'> 
        <a class='card-link collapsed' data-toggle='collapse' href='#my_play_mates' aria-expanded='true' style='font-size: 1rem;'>Location <label class="location_mini_count" id="num_{{$key +1}}">{{ $key +1}}</label> <span style='color:red'>*</span>
        </a>
        @if($key +1 != 1)
            <i class="fa fa-fw fa-trash removeEditModel" id="{{ $key +1}}" style="float: right;"></i>
        @endif
    </div>
    {{-- tid-{{ $tourLocation[$key] }}</br> --}}
    {{-- {{ dd($escorts) }} --}}
    <div class="collapse show" data-parent="#accordion" id="new_tour" >
        <div class='card-body border-0 p-0 mt-4'>
            <div class='form-group'>
                <select class='custom-select addMore_Location' {{$class_disabled}} id='addLocation_{{ $key +1 }}' required  name='stateId[]' data-parsley-errors-container='#loc_{{ $key +1 }}'  data-parsley-required-message='Please select Location'>
                    <option value='' selected=''>Select Location</option>
                        @foreach(config('escorts.profile.states') as $keyVal => $state)
                        <option value="{{$keyVal}}" {{$tour_location->location_id == $keyVal ? 'selected style= "background-color:#76767687"' : ''}}
                            @if(!in_array($keyVal, $escorts->pluck('state_id')->toArray()))  disabled style='background-color:#76767687' @endif
                            @if($key > 0)
                                @if($keyVal == $tourLocation[$key-1])  disabled style='background-color:#76767687' @endif
                            @endif
                        >
                            

                            {{$state['stateName']}}</option>
                        @endforeach

                    {{-- @foreach(config('escorts.profile.states') as $key => $state)<option value='{{$key}}'  @if(!in_array($key, $escorts->pluck('state_id')->toArray()))  disabled style='background-color:#76767687' @endif>{{$state['stateName']}}</option> @endforeach --}}
                </select>
            </div>
            
            
            <span id='loc_{{ $key +1 }}'></span>
            <div class='row mt-4 mb-3'>
                <div class='col-3 pr-0'> <label class='pt-1'>Assign Profile <span style='color:red'>*</span></label> </div>
                <div class='col-9 pl-0' >
                    <select class='custom-select chLocation addAssign_{{ $key +1 }}' {{$class_disabled}} id='assignProfile_' name='escortId[]'  required data-parsley-required-message='Please select Profile' data-parsley-errors-container='#assign_profile_{{ $key +1 }}'>
                        <option value='' selected=''>-Assign Profile-</option>
                        {{-- @foreach($user_names as $escort)
                        <option value='{{$escort->id}}'>{{$escort->profile_name}}</option>
                        @endforeach  --}}

                        @foreach($escorts as $escort)
                        <option value='{{$escort->id}}' {{$tour_location->profile_id == $escort->id ? 'selected' : ''}}>{{$escort->profile_name}}</option>

                      
                        @endforeach
                    </select>
                </div>
                <span id='assign_profile_{{ $key +1 }}'></span>
            </div>
            <div class='row'>
                <div class='col-md-6'>  <label>Start Date: <span style='color:red'>*</span></label> <input type='date' {{$class_disabled}} class='form-control akhEditDate sdate w-100' name='start_date[]' id='startEditDate_{{$key +1 }}' value="{{ Carbon\Carbon::parse($tour_location->start_date)->format('Y-m-d') }}" required data-parsley-required-message='Please select Start Date' min="{{ Carbon\Carbon::parse($tour_location->start_date)->format('Y-m-d') }}"></div>
                <span id='sdate_{{ $key +1 }}'></span> 
                <div class='col-md-6'> <label class='col-md-6'>End Date: <span style='color:red'>*</span></label>  <input type='date' {{$class_disabled}} name='end_date[]' class='form-control edate akhEditDate w-100' id='endEditDate_{{$key + 1}}' value='{{ Carbon\Carbon::parse($tour_location->end_date)->format('Y-m-d') }}'  required data-parsley-required-message='Please select End Date'></div>
            </div>
            <span id='edate_{{ $key +1 }}'></span>
            <div class='row mt-3' >
                <div class='col-3 pr-0'><label class='pt-1' >Select Plan <span style='color:red'>*</span></label></div>
                <div class='col-9 pl-0'>
                    <select class='custom-select addplan_{{ $key +1 }}' {{$class_disabled}} id='tourPlan_{{ $key +1 }}' name='tour_plan[]' required data-parsley-required-message='Please select Plan'>
                        <option value='' selected=''>-Select Plan-</option>
                        <option value="1" {{($tour_location->tour_plan == 1) ? 'selected' : ''}}>Platinum</option>
                        <option value="2" {{($tour_location->tour_plan == 2) ? 'selected' : ''}}>Gold</option>
                        <option value="3" {{($tour_location->tour_plan == 3) ? 'selected' : ''}}>Silver</option>
                        <option value="4" {{($tour_location->tour_plan == 4) ? 'selected' : ''}}>Free</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
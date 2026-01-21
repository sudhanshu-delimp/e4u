<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-12">
        <div class="member-id pl-0 pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{auth()->user()->member_id}}</span>
        </div>
    </div>


    <form id="myProfileServiceForm" name="myProfileServiceForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">                                                
       
        <div class="about_me_drop_down_info profile-sec p-4">
            <div class="fill_profile_headings_global">
                <h2>Our Service (Tags)</h2>
            </div>
            <div class="padding_20_all_side">
                <div class="pt-2 pb-2">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 full-width-for-ipad-select">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="label">Massage Services </label>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                        <option value="" selected="" disable="">All massage services</option>
                                        @foreach(config('escorts.profile.massage-services') as $key =>$services)
                                        @if(! in_array($key, $escort->massage_services()->pluck('service_id')->toArray()))
                                            <option id="{{ $services}}" value="{{$key}}" >{{$services}}</option>
                                        @endif
                                        @endforeach
                                        
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="manage_tag_style">
                                <ul id="selected_service_one">
                                    {{-- @foreach ($massage_profile->services()->where('category_id', 1)->get() as $value) --}}
                                    @foreach ($escort->massage_services()->where('category_id', 1)->get() as $value)
                                        <li class="mb-2" id="hideenclassOne_{{$value->service_id}}">
                                            <div class='my_service_anal hideenclassOne{{$value->id}}'>
                                                <span class="dollar-sign">
                                                {{config('escorts.profile.massage-services')[$value->service_id]  }}
                                                </span>
                                                <input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value="{{$value->price}}" min=0 step=10 max=200>
                                                <input type='hidden' name='service_id[]' value="{{$value->service_id}}" placeholder='test test '>
                                                <input type='hidden' name='category_id[]' value='1'>
                                                <span id="span_id" data-id="{{$value->id}}">
                                                <i class='fas fa-times-circle akh1' id="id_{{$value->id}}" value="{{$value->service_id}}" data-sname="{{config('escorts.profile.massage-services')[$value->service_id]  }}" data-val="{{$value->service_id}}"></i>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-2 pb-2">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 full-width-for-ipad-select">
                            <div class="form-group">
                                <label class="label" for="exampleFormControlSelect1">Other Service Types </label>
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_two" name="other_services">
                                    <option value="" selected="" disable="">All other service types</option>
                                    @foreach(config('escorts.profile.other-services') as $key =>$services)
                                        @if(! in_array($key, $escort->massage_services()->pluck('service_id')->toArray()))
                                            <option id="{{ $services}}" value="{{$key}}" >{{$services}}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="manage_tag_style">
                                
                                <ul id="selected_service_two">
                                    @foreach ($escort->massage_services()->where('category_id', 2)->get() as $value)
                                        <li class="mb-2" id="hideenclassTwo_{{$value->service_id}}">
                                            <div class='my_service_anal hideenclassTwo{{$value->id}}'>
                                                <span class="dollar-sign">
                                                {{config('escorts.profile.other-services')[$value->service_id]  }}
                                                </span>
                                                <input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value="{{$value->price}}" min=0 step=10 max=200>
                                                <input type='hidden' name='service_id[]' value="{{$value->service_id}}" placeholder='test test '>
                                                <input type='hidden' name='category_id[]' value='2'>
                                                <span id="span_id" data-id="{{$value->id}}">
                                                <i class='fas fa-times-circle akh2' id="id_{{$value->id}}" value="{{$value->service_id}}" data-sname="{{config('escorts.profile.other-services')[$value->service_id]  }}" data-val="{{$value->service_id}}"></i>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                        <div class="col-md-12 text-right mb-4">
                            <input type="hidden" name="type" id="type" value="service">
                            <input type="hidden" name="massage_id" id="massage_id" value="{{$escort->id}}">
                            <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                        </div>

            </div>
        </div>
    </form>

 <form id="myProfilerRateForm" name="myProfilerRateForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">
    <div class="about_me_drop_down_info profile-sec p-4">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
            <h2>Our Rates</h2>
        </div>
        <div class="padding_20_all_side">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates pt-5">
                    <div class="rate_first_row row">
                        <div class="col-3">
                        </div>
                        <div class="col-3 rate-img-center rate-tooltip">
                            <img src="{{asset('assets/dashboard/img/massage-only.png')}}" class="w-50">
                            <span class="tooltip-info">Massage only</span>
                        </div>
                        <div class="col-3 rate-img-center rate-tooltip">
                            <img src="{{asset('assets/dashboard/img/massage-with2.png')}}" class="w-50">
                            <span class="tooltip-info">Massage with Extras, 2 hands.</span>
                        </div>
                        <div class="col-3 rate-img-center rate-tooltip">
                            <img src="{{asset('assets/dashboard/img/massage-with4.png')}}" class="w-50">
                            <span class="tooltip-info">Massage with Extras, 2 hands.</span>
                        </div>
                    </div>
                    @foreach($durations->whereIn('id',[2,3,4,5,6]) as $duration)

                    @php
                    if($duration->id!="")
                    {
                        $massage_price = $incall_price = $outcall_price =  $massage_profile_id = "";
                        if(!empty($massage_durations))
                        {
                            foreach($massage_durations as $db_duration)  
                            {
                                if(isset($db_duration['pivot']['duration_id']) && $db_duration['pivot']['duration_id']==$duration->id)
                                {
                                    
                                    $massage_price = isset($db_duration['pivot']['massage_price']) ? $db_duration['pivot']['massage_price'] : 0;
                                    $incall_price =  isset($db_duration['pivot']['incall_price']) ? $db_duration['pivot']['incall_price'] : 0;
                                    $outcall_price = isset($db_duration['pivot']['outcall_price']) ? $db_duration['pivot']['outcall_price'] : 0;
                                    $massage_profile_id = isset($db_duration['pivot']['massage_profile_id']) ? $db_duration['pivot']['massage_profile_id'] : "";

                                    
                                    break;
                                    
                                } 
                            }   
                        }
                    }
                    @endphp



                    <div class="rate_first_row">
                        <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                        <div class="form-group row">
                            <label class="col-3 label" for="exampleFormControlSelect1">{{ $duration->name == "1 Hour" ? '1 Hour' :  $duration->name}}:</label>
                            <div class="col-3">
                                <div class="service_rate_dolor_symbol form-group">
                                    <span>$</span>
                                    <input  placeholder="0" type="text" data-duration_id="{{$duration->id}}" data-massage_profile_id="{{$massage_profile_id}}"  data-data_type="massage_price"   class="form-control update_default_rate" id="massage_price" name="massage_price[]" value="{{ $escort->durationRate($duration->id, 'massage_price') }}" >
                                    <input type="hidden" class="profile_massage_price"  value="{{$massage_price}}" >
                                
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="service_rate_dolor_symbol form-group">
                                    <span>$</span>
                                    <input  placeholder="0"  type="text" data-duration_id="{{$duration->id}}" data-massage_profile_id="{{$massage_profile_id}}"  data-data_type="incall_price"  class="form-control update_default_rate" id="incall_price" name="incall_price[]" value="{{ $escort->durationRate($duration->id, 'incall_price') }}" >
                                    <input type="hidden" class="profile_incall_price"  value="{{$incall_price}}" >
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="service_rate_dolor_symbol form-group">
                                    <span>$</span>
                                    <input placeholder="0"  type="text" data-duration_id="{{$duration->id}}"  data-massage_profile_id="{{$massage_profile_id}}"  data-data_type="outcall_price"  class="form-control update_default_rate" id="outcall_price" name="outcall_price[]" value="{{ $escort->durationRate($duration->id, 'outcall_price') }}" >
                                    <input type="hidden" class="profile_outcall_price"  value="{{$outcall_price}}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

                        <div class="col-md-12 text-right mb-4">
                            <input type="hidden" name="type" id="type" value="rates">
                            <input type="hidden" name="massage_id" id="massage_id" value="{{$escort->id}}">
                            <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                        </div>
            
        </div>
    </div>
</form>
    
    <div class="tab_btm_btns_preview_and_next py-3">
        <div class="row pt-3 pb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a class="prev_step_btn btn_width_hundred" id="home-tab-prev" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-arrow-left"></i> &nbsp; Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
                <a class="nex_sterp_btn" id="contact-tab-next" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="contact" aria-selected="false">
                    Next Step <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
.rate-tooltip .tooltip-info {
    top: -28px !important;
    left: 70% !important;
}
</style>
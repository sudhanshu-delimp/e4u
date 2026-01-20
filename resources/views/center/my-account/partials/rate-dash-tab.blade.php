<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
   
    
    <div class="about_me_drop_down_info ">
        <div class="fill_profile_headings_global col-md-12 p-0  custom--social-head">
            <h2>Rates</h2>
            <span class="custom--help"><b>Help?</b></span>
        </div>

        <div class="custom-note-section">
            <div class="card" style="">
                <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                    <ol class=" mb-0">
                        <li>By completing these settings, the information set out under My rates will by default appear in your Profile creator.</li>
                                        <li>You can over ride these settings when creating a Profile, provided you have enabled
                                            the <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">feature</a>.</li>
                    </ol>
                </div>
            </div>
        </div>
        


        <div class="padding_20_all_side pb-0">
                <form id="myProfilerRateForm" name="myProfilerRateForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">
                    <div class="about_me_drop_down_info profile-sec p-4">
                       
                        <div class="padding_20_all_side">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates">
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
                                        $massage_price = $incall_price = $outcall_price = "";
                                        if(!empty($massage_durations))
                                        {
                                          foreach($massage_durations as $db_duration)  
                                            {
                                               if(isset($db_duration['pivot']['duration_id']) && $db_duration['pivot']['duration_id']==$duration->id)
                                                {
                                                   
                                                    $massage_price = isset($db_duration['pivot']['massage_price']) ? $db_duration['pivot']['massage_price'] : 0;
                                                    $incall_price =  isset($db_duration['pivot']['incall_price']) ? $db_duration['pivot']['incall_price'] : 0;
                                                    $outcall_price = isset($db_duration['pivot']['outcall_price']) ? $db_duration['pivot']['outcall_price'] : 0;
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
                                                    <input min="0" placeholder="0" type="number"  class="form-control" id="massage_price" name="massage_price[]"  value="{{ $massage_price }}" >
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="service_rate_dolor_symbol form-group">
                                                    <span>$</span>
                                                    <input min="0" placeholder="0"  type="number"  class="form-control" id="incall_price" name="incall_price[]" value="{{ $incall_price }}" >
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="service_rate_dolor_symbol form-group">
                                                    <span>$</span>
                                                    <input min="0" placeholder="0"  type="number"  class="form-control" id="outcall_price" name="outcall_price[]" value="{{ $outcall_price }}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                                        <div class="col-md-12 text-right mb-4">
                                            <input type="hidden" name="type" id="type" value="rates">
                                            <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                                            <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                        </div>
                            
                        </div>
                    </div>
                </form>



        </div>
    </div>
</div>
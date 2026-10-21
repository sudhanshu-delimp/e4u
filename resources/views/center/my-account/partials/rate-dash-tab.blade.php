<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
    <form id="myProfilerRateForm" class="common-form" name="myProfilerRateForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">
        <div class="about_me_drop_down_info">
            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" width="64px" height="64px" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                        }

                                        .st1 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                            stroke-dasharray: 3;
                                        }

                                        .st2 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                        }

                                        .st3 {
                                            fill: none;
                                        }
                                    </style>
                                    <path class="st0" d="M6.5,9.9L7,9.5c0.8-0.6,1.4-1.6,1.5-2.6l0.1-0.4c0.4-2.6,3.2-4.2,5.8-3.2l0,0c1.1,0.4,2.2,0.4,3.3,0l0,0 c2.5-1.1,5.4,0.5,5.8,3.2l0.1,0.4c0.1,1,0.7,2,1.5,2.6l0.5,0.4c2.1,1.6,2.1,4.6,0,6.2L25,16.5c-0.8,0.6-1.4,1.6-1.5,2.6l-0.1,0.4 c-0.4,2.6-3.2,4.2-5.8,3.2l0,0c-1.1-0.4-2.2-0.4-3.3,0l0,0c-2.5,1.1-5.4-0.5-5.8-3.2l-0.1-0.4c-0.1-1-0.7-2-1.5-2.6l-0.5-0.4 C4.5,14.5,4.5,11.5,6.5,9.9z"></path>
                                    <polyline class="st0" points="22,22 22,29 16,26 10,29 10,22 "></polyline>
                                    <line class="st0" x1="16" y1="9" x2="16" y2="10"></line>
                                    <line class="st0" x1="16" y1="16" x2="16" y2="17"></line>
                                    <path class="st0" d="M17,10h-1.5c-0.8,0-1.5,0.7-1.5,1.5v0c0,0.8,0.7,1.5,1.5,1.5h1c0.8,0,1.5,0.7,1.5,1.5v0c0,0.8-0.7,1.5-1.5,1.5 H15"></path>
                                    <rect x="-72" y="-360" class="st3" width="536" height="680"></rect>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>Rates <span class="custom--help"><b>Help?</b></span></h2>
                        </div>
                    </div>
                    <div class="custom-note-section">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol class=" mb-0">
                                    <li>By completing these settings, the information set out under Our Rates will by default appear in your Profile creator.</li>
                                    <li>You can over ride these settings when creating a Profile, provided you have enabled
                                        the <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">feature</a>.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates">
                    <div class="rate_first_row row pt-5">
                        <div class="col-3">
                        </div>
                        <div class="col-3 rate-img-center rate-tooltip">
                            <img src="{{asset('assets/dashboard/img/massage-only.png')}}" class="w-50">
                            <span class="tooltip-info">Massage only</span>
                        </div>
                        <div class="col-3 rate-img-center rate-tooltip">
                            <img src="{{asset('assets/dashboard/img/massage-with2.png')}}" class="w-50">
                            <span class="tooltip-info">Massage with extras +2 hands.</span>
                        </div>
                        <div class="col-3 rate-img-center rate-tooltip">
                            <img src="{{asset('assets/dashboard/img/massage-with4.png')}}" class="w-50">
                            <span class="tooltip-info">Massage with extras +4 hands.</span>
                        </div>
                    </div>
                    @foreach($durations->whereIn('id',[2,3,4,5,6,7]) as $duration)

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
                    $incall_price = isset($db_duration['pivot']['incall_price']) ? $db_duration['pivot']['incall_price'] : 0;
                    $outcall_price = isset($db_duration['pivot']['outcall_price']) ? $db_duration['pivot']['outcall_price'] : 0;
                    break;

                    }
                    }
                    }
                    }
                    @endphp

                    <div class="rate_first_row">
                        <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                        <div class="form-group row d-flex align-items-center">
                            <label class="col-3 label" for="exampleFormControlSelect1">{{ $duration->name == "1 Hour" ? '1 Hour' :  $duration->name}}:</label>
                            <div class="col-3">
                                <div class="service_rate_dolor_symbol form-group">
                                    <span>$</span>
                                    <input min="0" type="number" step="10" placeholder="0" class="form-control allow_only_numeric" id="massage_price" name="massage_price[]" value="{{ $massage_price }}" maxlength="6">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="service_rate_dolor_symbol form-group">
                                    <span>$</span>
                                    <input min="0" type="number" step="10" placeholder="0" class="form-control allow_only_numeric" id="incall_price" name="incall_price[]" value="{{ $incall_price }}" maxlength="6">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="service_rate_dolor_symbol form-group">
                                    <span>$</span>
                                    <input min="0" type="number" step="10" placeholder="0" class="form-control allow_only_numeric" id="outcall_price" name="outcall_price[]" value="{{ $outcall_price }}" maxlength="6">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 text-right commn-footer">
                <input type="hidden" name="type" id="type" value="rates">
                <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                <button id="read-more" type="submit" class="save_profile_btn common-save-btn">Update</button>
            </div>
        </div>
    </form>
</div>
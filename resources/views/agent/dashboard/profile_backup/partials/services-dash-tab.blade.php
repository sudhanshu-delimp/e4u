<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-12">
        <div class="member-id">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{$escort->user->member_id}}</span>
        </div>
    </div>
    <div class="about_me_drop_down_info ">
        <div class="fill_profile_headings_global">
            <h2>My Services</h2>
        </div>
        <div class="padding_20_all_side">
            <form id="myServices" action="{{ route('agent.store.services',[$escort->id]) }}" method="POST">
                @CSRF
                <div class="pt-2 pb-4">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 full-width-for-ipad-select">
                            <div class="form-group row">
                                <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Fun Stuff - On Viewer</label>
                                <div class="col-sm-7">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                        <option value="" selected disable>--Select--</option>
                                        @foreach($service_one as $key =>$name)
                                        <option id="{{ $name->name}}" value="{{ $name->id}}">{{ $name->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="manage_tag_style">
                                <ul id="selected_service_one">
                                    @foreach ($escort->services()->where('category_id', 1)->get() as $value)
                                    <li class="mb-2" id="{{$value->id}}">
                                        <div class='my_service_anal hideenclassOne{{$value->id}}'>
                                            <span class="dollar-sign">{{$value->name}}</span>
                                            <input type='number' class='dollar-before input_border' name='price[]' placeholder='test tet' value="{{$value->pivot->price}}" min=0>
                                            <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder='test test '>
                                            <span id="span_id" data-id="{{$value->id}}">
                                            <i class='fas fa-times-circle' id="id_{{$value->id}}" value="{{$value->pivot->service_id}}"></i>
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Kinky Stuff - On Viewer</label>
                                <div class="col-sm-7">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_two">
                                        <option value="" selected disable>--Select--</option>
                                        @foreach($service_two as $key =>$name)
                                        <option id="{{ $name->name}}" value="{{ $name->id}}">{{ $name->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="manage_tag_style">
                                <ul id="my_service_anal_two" style="display:none">
                                </ul>
                                <ul id="selected_service_two">
                                    @foreach ($escort->services()->where('category_id', 2)->get() as $key => $value)
                                    <li class="mb-2" id="{{$value->id}}">
                                        <div class='my_service_anal hideenclassTwo{{$value->id}}'>
                                            <span class="dollar-sign">{{$value->name}}</span>
                                            <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->pivot->price}}" min=0>
                                            <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder=''>
                                            <span>
                                            <i class='fas fa-times-circle' id="idTwo_{{$value->id }}" value="{{$value->pivot->service_id}}"></i>
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Fun Stuff - On Me</label>
                                <div class="col-sm-7">
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_three">
                                        <option value="" selected disable>--Select--</option>
                                        @foreach($service_three as $key =>$name)
                                        <option id="{{ $name->name}}" value="{{ $name->id}}">{{ $name->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="manage_tag_style">
                                <ul id="my_service_anal_three" style="display:none">
                                </ul>
                                <ul id="selected_service_three">
                                    @foreach ($escort->services()->where('category_id', 3)->get() as $key => $value)
                                    <li class="mb-2" id="{{$value->id}}">
                                        <div class='my_service_anal hideenclassThree{{$value->id}}'>
                                            <span class="dollar-sign">{{$value->name}}</span>
                                            <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->pivot->price}}" min="0" >
                                            <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder=''>
                                            <span>
                                            <i class='fas fa-times-circle' id="idThree_{{$value->id}}" value="{{$value->pivot->service_id}}"></i>
                                            </span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="my_services" type="submit" class="save_profile_btn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="about_me_drop_down_info ">
        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
            <h2>Rates</h2>
        </div>
        <div class="padding_20_all_side">
            <form id='storeRate' action="{{ route('agent.store.rate',[$escort->id]) }}" method="Post">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates">
                        <div class="rate_first_row row">
                            <div class="col-3">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{asset('assets/img/hand-icon.png')}}">
                            </div>
                        </div>
                        @foreach($durations as $duration)
                        <div class="rate_first_row">
                            <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                            <div class="form-group row">
                                <label class="col-3" for="exampleFormControlSelect1">{{ $duration->name}}:</label>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0"  type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="massage_price" name="massage_price[]" value="{{ $escort->durationRate($duration->id, 'massage_price') }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0"  type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="{{ $escort->durationRate($duration->id, 'incall_price') }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0"  type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="{{ $escort->durationRate($duration->id, 'outcall_price') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="store_rate" type="submit" class="save_profile_btn">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tab_btm_btns_preview_and_next">
        <div class="row pt-3 pb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a class="nex_sterp_btn btn_width_hundred"id="home-tab" data-toggle="tab" href="#aboutme" role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-arrow-left"></i>Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
                <a href="#" class="save_profile_btn">Preview</a>
                <a href="#available" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
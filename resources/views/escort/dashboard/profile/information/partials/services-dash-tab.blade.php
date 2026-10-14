<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">

    <div class="about_me_drop_down_info ">
        
        <div class="padding_20_all_side pb-0">
            <form id="myServices" class="common-form" action="{{ route('escort.settings.services') }}" method="POST">
                @CSRF
                   <div class="row inner-row">
                        <div class="col-lg-12">
                            <div class="card-top">
                                <div class="card-icon">
                                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </g>

                                        <g id="SVGRepo_iconCarrier">

                                            <path
                                                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>

                                            <path
                                                d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>

                                        </g>

                                    </svg>
                                </div>
                                <div class="card-heading">
                                    <h2>My Services <span class="custom--help"><b>Help?</b></span></h2>
                                </div>
                            </div>
                            <div class="custom-note-section">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                        <ol class=" mb-0">
                                            <li>By completing these settings, the information set out under Service Tags will by default appear in your Profile creator.
                                            </li>
                                            <li>Any value you attach to a Service Tag is a separate value and is not included in your rates.
                                            </li>
                                            <li>You can over ride these settings when creating a Profile, provided you have enabled the <a href="/escort-dashboard/update-account" class="custom_links_design">feature</a> (see My Account - Profile & Tour options).
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="inner-field-row">
                                <div class="form-group">
                                    <label class="small-icon" for="exampleFormControlSelect1">
                                        Fun Stuff - On Viewer
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Services the Escort will perform. Additional fee is optional." data-boundary="window">
                                    </label>
                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                        <option value="" selected disable>--Select--</option>
                                        @foreach($service_one as $key =>$name)
                                        <option id="{{ $name->name}}" value="{{ $name->id}}">{{ $name->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="manage_tag_style">
                                        <ul id="selected_service_one">
                                            @foreach ($escort->services()->where('category_id', 1)->get() as $value)
                                            <li class="mb-2" id="hideenclassOne_{{$value->id}}">
                                                <div class='my_service_anal hideenclassOne{{$value->id}}'>
                                                    <span class="dollar-sign">{{$value->name}}</span>
                                                    <input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value="{{$value->pivot->price}}" min=0 step=10 max=200>
                                                    <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder='test test '>
                                                    <span id="span_id" data-id="{{$value->id}}">
                                                        <small class="mytool-tip">Remove</small>
                                                    <i class='fas fa-times akh1' id="id_{{$value->id}}" value="{{$value->pivot->service_id}}" data-sname="{{$value->name}}" data-val="{{$value->pivot->service_id}}"></i>
                                                    </span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>                                 
                                <div class="form-group">
                                    <label class="small-icon" for="exampleFormControlSelect1">
                                        Kinky Stuff - On Viewer
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Services the Escort will perform. Additional fee is optional." data-boundary="window">
                                    </label>
                                    <select class="form-control select_tag_remove_box_sadow" id="service_id_two">
                                        <option value="" selected disable>--Select--</option>
                                        @foreach($service_two as $key =>$name)
                                        <option id="{{ $name->name}}" value="{{ $name->id}}">{{ $name->name}}</option>
                                        @endforeach
                                    </select>
                                        
                                    <div class="manage_tag_style">
                                        <ul id="my_service_anal_two" style="display:none">
                                        </ul>
                                        <ul id="selected_service_two">
                                            @foreach ($escort->services()->where('category_id', 2)->get() as $key => $value)
                                            <li class="mb-2" id="hideenclassTwo_{{$value->id}}">
                                                <div class='my_service_anal hideenclassTwo{{$value->id}}'>
                                                    <span class="dollar-sign">{{$value->name}}</span>
                                                    <input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value="{{$value->pivot->price}}" min=0 step=10 max=200>
                                                    <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder=''>
                                                    <span>
                                                        <small class="mytool-tip">Remove</small>
                                                    <i class='fas fa-times akh2' id="idTwo_{{$value->id }}" value="{{$value->pivot->service_id}}"  data-sname="{{$value->name}}" data-val="{{$value->pivot->service_id}}"></i>
                                                    </span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>                            
                        </div>                        
                        <div class="col-lg-6">
                            <div class="inner-field-row">                                
                                <div class="form-group">
                                    <label class="small-icon" for="exampleFormControlSelect1">
                                        Fun Stuff - On Me
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Services the client can perform. Additional fee is optional." data-boundary="window">
                                    </label>                                
                                    <select class="form-control  select_tag_remove_box_sadow" id="service_id_three">
                                        <option value="" selected disable>--Select--</option>
                                        @foreach($service_three as $key =>$name)
                                        <option id="{{ $name->name}}" value="{{ $name->id}}">{{ $name->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="manage_tag_style">
                                        <ul id="my_service_anal_three" style="display:none">
                                        </ul>
                                        <ul id="selected_service_three">
                                            @foreach ($escort->services()->where('category_id', 3)->get() as $key => $value)
                                            <li class="mb-2" id="hideenclassThree_{{$value->id}}">
                                                <div class='my_service_anal hideenclassThree{{$value->id}}'>
                                                    <span class="dollar-sign">{{$value->name}}</span>
                                                
                                                    <input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value="{{$value->pivot->price}}" min=0 step=10 max=200>
                                                    <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder=''>
                                                
                                                    <span>
                                                        <small class="mytool-tip">Remove</small>
                                                    <i class='fas fa-times akh3' id="idThree_{{$value->id}}" value="{{$value->pivot->service_id}}"  data-sname="{{$value->name}}" data-val="{{$value->pivot->service_id}}"></i>
                                                    </span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12 common-footer">
                        <button id="my_services" type="submit" class="common-save-btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
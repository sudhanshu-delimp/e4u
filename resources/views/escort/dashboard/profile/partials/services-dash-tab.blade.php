<div class="tab-pane common-card mt-4 fade {{$activeTab=='my-services'?'show active':''}}" id="services" role="tabpanel" aria-labelledby="profile-tab">
    <div class="col-lg-12">
        <div class="member-id pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z"
                    fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{$loginAccount->member_id}}</span>&nbsp;&nbsp;<span>{{$editMode?"Profile: $escort->profile_name":""}}</span>
        </div>
    </div>

    <div class="about_me_drop_down_info common-form">
        <div class="js_profile_services">
            @if (request()->segment(2) == 'profile' && request()->segment(3))
            <form id="myServicesForm" name="myServicesForm"
                action="{{ route('escort.store.services', [$escort->id]) }}" method="POST">
                @CSRF
                @endif
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
                                <h2>My Services</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="inner-field-row">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Fun Stuff - On
                                    Viewer</label>
                                <select class="form-control js_profile_service_tags"
                                    id="service_id_one">
                                    <option value="" selected disable>--Select--</option>
                                    @foreach ($service_one as $key => $name)
                                    <option id="{{ $name->name }}" value="{{ $name->id }}">
                                        {{ $name->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="manage_tag_style">
                                    <ul id="selected_service_one">
                                        @foreach ($escort->services()->where('category_id', 1)->get() as $value)
                                        @php
                                        $isDefaultTag = in_array($value->pivot->service_id ,$defaultServiceIds);
                                        @endphp
                                        <li class='mb-2 {{$isDefaultTag?"js_defaultProfileService":""}}' id="hideenclassOne_{{ $value->id }}">
                                            <div class='my_service_anal hideenclassOne{{ $value->id }}'>
                                                <span class="dollar-sign">{{ $value->name }}</span>
                                                <span class='d_profile_name'>{{'Status:'}} {{$isDefaultTag?"Default":$escort->profile_name}}
                                                    <div class="make-ittool js_default_action">{{$isDefaultTag?'Remove from Default':'Add to Default'}}</div>
                                                </span>
                                                <input type='number' class='dollar-before input_border change_default' name='price[]'
                                                    placeholder='0' value="{{ $value->pivot->price }}" min=0 step="10"
                                                    max=9999 service_id="{{ $value->id }}">
                                                <input type='hidden' name='service_id[]'
                                                    value="{{ $value->pivot->service_id }}" placeholder='test test '>
                                                <span id="span_id" data-id="{{ $value->id }}">
                                                    <small class="mytool-tip">Remove</small>
                                                    <i class='fas fa-times akh1 {{$isDefaultTag?"js_defaultProfileService":""}}' id="id_{{ $value->id }}"
                                                        value="{{ $value->pivot->service_id }}"
                                                        data-sname="{{ $value->name }}"
                                                        data-val="{{ $value->pivot->service_id }}"></i>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kinky Stuff - On
                                    Viewer</label>
                                <select class="form-control form-control-sm select_tag_remove_box_sadow js_profile_service_tags"
                                    id="service_id_two">
                                    <option value="" selected disable>--Select--</option>
                                    @foreach ($service_two as $key => $name)
                                    <option id="{{ $name->name }}" value="{{ $name->id }}">
                                        {{ $name->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="manage_tag_style">
                                    <ul id="selected_service_two">
                                        @foreach ($escort->services()->where('category_id', 2)->get() as $key => $value)
                                        @php
                                        $isDefaultTag = in_array($value->pivot->service_id ,$defaultServiceIds);
                                        @endphp
                                        <li class='mb-2 {{$isDefaultTag?"js_defaultProfileService":""}}' id="hideenclassTwo_{{ $value->id }}">
                                            <div class='my_service_anal hideenclassTwo{{ $value->id }}'>
                                                <span class="dollar-sign">{{ $value->name }}</span>
                                                <span class='d_profile_name'>{{'Status:'}} {{$isDefaultTag?"Default":$escort->profile_name}}
                                                    <div class="make-ittool js_default_action">{{$isDefaultTag?'Remove from Default':'Add to Default'}}</div>
                                                </span>
                                                <input type='number' class='dollar-before input_border change_default' name='price[]'
                                                    placeholder='0' value="{{ $value->pivot->price }}" min=0 step="10"
                                                    max=9999 service_id="{{ $value->id }}">
                                                <input type='hidden' name='service_id[]'
                                                    value="{{ $value->pivot->service_id }}" placeholder=''>
                                                <span>
                                                    <small class="mytool-tip">Remove</small>
                                                    <i class='fas fa-times akh2 {{$isDefaultTag?"js_defaultProfileService":""}}' id="idTwo_{{ $value->id }}"
                                                        value="{{ $value->pivot->service_id }}"
                                                        data-sname="{{ $value->name }}"
                                                        data-val="{{ $value->pivot->service_id }}"></i>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Fun Stuff - On
                                    Me</label>
                                <select class="form-control js_profile_service_tags"
                                    id="service_id_three">
                                    <option value="" selected disable>--Select--</option>
                                    @foreach ($service_three as $key => $name)
                                    <option id="{{ $name->name }}" value="{{ $name->id }}">
                                        {{ $name->name }}
                                    </option>
                                    @endforeach
                                </select>

                                <div class="manage_tag_style">
                                    <ul id="selected_service_three">
                                        @foreach ($escort->services()->where('category_id', 3)->get() as $key => $value)
                                        @php
                                        $isDefaultTag = in_array($value->pivot->service_id ,$defaultServiceIds);
                                        @endphp
                                        <li class='mb-2 {{$isDefaultTag?"js_defaultProfileService":""}}' id="hideenclassThree_{{ $value->id }}">
                                            <div class='my_service_anal hideenclassThree{{ $value->id }}'>
                                                <span class="dollar-sign">{{ $value->name }}</span>
                                                <span class='d_profile_name'>{{'Status:'}} {{$isDefaultTag?"Default":$escort->profile_name}}
                                                    <div class="make-ittool js_default_action">{{$isDefaultTag?'Remove from Default':'Add to Default'}}</div>
                                                </span>
                                                <input type='number' class='dollar-before input_border change_default' name='price[]'
                                                    placeholder='0' value="{{ $value->pivot->price }}" min=0
                                                    step="10" max=9999 service_id="{{ $value->id }}">
                                                <input type='hidden' name='service_id[]'
                                                    value="{{ $value->pivot->service_id }}" placeholder=''>
                                                <span>
                                                    <small class="mytool-tip">Remove</small>
                                                    <i class='fas fa-times akh3 {{$isDefaultTag?"js_defaultProfileService":""}}' id="idThree_{{ $value->id }}"
                                                        value="{{ $value->pivot->service_id }}"
                                                        data-sname="{{ $value->name }}"
                                                        data-val="{{ $value->pivot->service_id }}"></i>
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
                    @if (request()->segment(2) == 'profile' && request()->segment(3))
                    <div class="col-md-12 text-right my-3">
                        <button id="my_services" type="submit" class="save_profile_btn common-save-btn">Update</button>
                    </div>
                    
            </form>
            @endif
        </div>
        
            @if (request()->segment(2) == 'profile' && request()->segment(3))
            <form id='storeRate' action="{{ route('escort.store.rate', [$escort->id]) }}" method="Post">
                @csrf
                @endif
                <div class="row inner-row">
                    <div class="col-lg-8 horizontal-scroll-rates">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" width="64px" height="64px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;stroke:#ff3c5f;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} .st1{fill:none;stroke:#ff3c5f;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:3;} .st2{fill:none;stroke:#ff3c5f;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;} .st3{fill:none;} </style> <path class="st0" d="M6.5,9.9L7,9.5c0.8-0.6,1.4-1.6,1.5-2.6l0.1-0.4c0.4-2.6,3.2-4.2,5.8-3.2l0,0c1.1,0.4,2.2,0.4,3.3,0l0,0 c2.5-1.1,5.4,0.5,5.8,3.2l0.1,0.4c0.1,1,0.7,2,1.5,2.6l0.5,0.4c2.1,1.6,2.1,4.6,0,6.2L25,16.5c-0.8,0.6-1.4,1.6-1.5,2.6l-0.1,0.4 c-0.4,2.6-3.2,4.2-5.8,3.2l0,0c-1.1-0.4-2.2-0.4-3.3,0l0,0c-2.5,1.1-5.4-0.5-5.8-3.2l-0.1-0.4c-0.1-1-0.7-2-1.5-2.6l-0.5-0.4 C4.5,14.5,4.5,11.5,6.5,9.9z"></path> <polyline class="st0" points="22,22 22,29 16,26 10,29 10,22 "></polyline> <line class="st0" x1="16" y1="9" x2="16" y2="10"></line> <line class="st0" x1="16" y1="16" x2="16" y2="17"></line> <path class="st0" d="M17,10h-1.5c-0.8,0-1.5,0.7-1.5,1.5v0c0,0.8,0.7,1.5,1.5,1.5h1c0.8,0,1.5,0.7,1.5,1.5v0c0,0.8-0.7,1.5-1.5,1.5 H15"></path> <rect x="-72" y="-360" class="st3" width="536" height="680"></rect> </g></svg>
                                    </div>
                                    <div class="card-heading">
                                        <h2>Rates</h2>
                                        @php
                                        $existDefaultRate = $escort->durations()
                                        ->get()
                                        ->filter(function ($duration) {
                                        return $duration->pivot->massage_price > 0 ||
                                        $duration->pivot->incall_price > 0 ||
                                        $duration->pivot->outcall_price > 0;
                                        })
                                        ->values()
                                        ->toArray();
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rate_first_row row">
                            <div class="col-3">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{ asset('assets/img/hand-icon.png') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top" title="Massage rates" data-boundary="window">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{ asset('assets/app/img/aeroupimg.png') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top" title="Incall rates" data-boundary="window">
                            </div>
                            <div class="col-3 rate-img-center">
                                <img src="{{ asset('assets/app/img/areodownimg.png') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top" title="Outcall rates" data-boundary="window">
                            </div>
                        </div>
                        @foreach ($durations as $duration)
                        <div class="rate_first_row">
                            <input type="hidden" name="duration_id[]" value="{{ $duration->id }}">
                            <div class="form-group row d-flex align-items-center">
                                <label class="col-3" for="exampleFormControlSelect1">{{ $duration->name }}:</label>
                                @if($duration->name == 'Blow & Go')
                                <div class="col-3">
                                    <input type="hidden" placeholder="0" min="0"
                                        class="form-control form-control-sm select_tag_remove_box_sadow @if(request()->segment(2) == 'profile' || count($existDefaultRate) > 0) change_default @endif"
                                        id="massage_price_{{ $duration->id }}" duration_id="{{ $duration->id }}" name="massage_price[]"
                                        value="0"
                                        step="10" max=9999>
                                    <div class="form-group" style="color: #ff3c5f;font-size: 14px;">Not available</div>
                                </div>
                                @else
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input type="number" placeholder="0" min="0"
                                            class="form-control form-control-sm select_tag_remove_box_sadow @if(request()->segment(2) == 'profile' || count($existDefaultRate) > 0) change_default @endif"
                                            id="massage_price_{{ $duration->id }}" duration_id="{{ $duration->id }}" name="massage_price[]"
                                            value="{{ $escort->durationRate($duration->id, 'massage_price') }}"
                                            step="10" max=9999>
                                    </div>
                                </div>
                                @endif

                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0" placeholder="0" type="number"
                                            class="form-control form-control-sm select_tag_remove_box_sadow @if(request()->segment(2) == 'profile'  || count($existDefaultRate) > 0) change_default @endif"
                                            id="incall_price_{{ $duration->id }}" name="incall_price[]"
                                            value="{{ $escort->durationRate($duration->id, 'incall_price') }}"
                                            step="10" max=9999 duration_id="{{ $duration->id }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="service_rate_dolor_symbol form-group">
                                        <span>$</span>
                                        <input min="0" placeholder="0" type="number"
                                            class="form-control form-control-sm select_tag_remove_box_sadow @if(request()->segment(2) == 'profile' || count($existDefaultRate) > 0 ) change_default @endif"
                                            id="outcall_price_{{ $duration->id }}" name="outcall_price[]"
                                            value="{{ $escort->durationRate($duration->id, 'outcall_price') }}"
                                            step="10" max=9999 duration_id="{{ $duration->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg fill="#ff3c5f" width="64px" height="64px" viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="_x36_93_x2C__Circulation_x2C__finance_x2C__flow_x2C__market_x2C__money"> <g> <path d="M433.87,350.978l-46.367-46.368c-9.716-9.715-19.401-19.4-29.115-29.084 l2.241,76.76L433.87,350.978z M388.717,294.986l24.539,24.57c15.787-31.14,21.237-66.172,16.379-100.021 c-4.982-34.628-20.801-68.009-47.456-94.634c-26.656-26.656-60.007-42.475-94.636-47.457 c-33.847-4.889-68.88,0.592-100.021,16.348l24.57,24.57c24.382-9.996,51.1-12.58,76.696-7.723l0.156,0.031 c25.753,4.889,50.322,17.314,70.22,37.211c19.899,19.898,32.325,44.498,37.243,70.252 C401.299,243.762,398.714,270.543,388.717,294.986z M323.168,415.405l-24.538-24.538c-24.445,9.996-51.225,12.581-76.853,7.692 c-54.401-10.37-97.094-53.063-107.465-107.465c-4.889-25.628-2.335-52.438,7.693-76.884l-24.57-24.539 c-15.788,31.141-21.238,66.174-16.379,100.023c4.982,34.594,20.801,67.977,47.457,94.633 c26.655,26.655,60.037,42.474,94.664,47.457C257.026,436.643,292.06,431.192,323.168,415.405z M76.821,158.222 c25.161,25.161,50.323,50.321,75.484,75.482l-2.211-76.79L76.821,158.222z M255.346,199.513c-15.228,0-28.99,6.167-38.956,16.132 c-9.965,9.963-16.131,23.728-16.131,38.955c0,15.229,6.166,29.021,16.131,38.955c9.965,9.997,23.728,16.162,38.956,16.162 c15.228,0,29.021-6.165,38.955-16.13c9.997-9.966,16.163-23.759,16.163-38.987C310.464,224.176,285.801,199.513,255.346,199.513z M258.211,273.377c1.93-0.405,3.519-1.338,4.732-2.771c1.214-1.4,1.806-3.084,1.806-5.014c0-1.713-0.498-3.208-1.525-4.454 c-1.027-1.244-2.678-2.179-5.013-2.864V273.377z M252.575,232.272c-1.495,0.56-2.678,1.432-3.582,2.678 c-0.872,1.245-1.307,2.585-1.307,4.079c0,1.34,0.404,2.615,1.214,3.799c0.777,1.152,2.023,2.087,3.674,2.803V232.272z M475.225,293.462c-0.965,4.765,6.538,6.353,7.535,1.246l1.184-7.692c0.871-4.391-6.479-6.509-7.6-1.027L475.225,293.462z M468.187,322.672c-0.374,0.965-0.062,2.521,0.405,3.145c2.116,2.834,5.636,2.272,6.912-0.872 c0.778-2.492,1.526-4.981,2.211-7.474c1.089-5.574-6.539-6.32-7.379-1.994C469.525,317.688,468.902,320.366,468.187,322.672z M457.256,350.665c-2.055,5.201,5.263,7.444,6.945,3.239l3.176-7.07c1.962-4.918-5.232-7.473-7.038-3.02L457.256,350.665z M442.621,376.947c-2.741,4.578,3.985,8.222,6.445,4.142l4.109-6.601c2.367-3.924-3.206-8.408-6.538-3.955L442.621,376.947z M424.591,400.988c-1.245,1.245-1.152,3.83,0.062,5.045c1.776,1.773,4.017,1.681,5.729-0.063c1.713-1.962,3.364-3.955,4.983-5.979 c3.208-4.266-3.114-8.595-5.979-4.765L424.591,400.988z M403.479,422.412c-3.955,3.955,1.93,8.875,5.105,5.729 c1.931-1.712,3.831-3.486,5.729-5.262c3.737-3.736-1.867-8.969-5.292-5.544C407.214,419.048,405.377,420.761,403.479,422.412z M379.688,440.815c-4.111,2.46-0.188,9.03,4.297,6.32c2.118-1.399,4.359-2.895,6.384-4.422c4.142-3.112-0.562-9.154-4.515-6.195 C383.892,437.981,381.742,439.413,379.688,440.815z M353.654,455.824c-0.842,0.344-1.464,1.185-1.838,1.9 c-1.339,3.363,1.775,6.32,5.232,4.951c2.334-1.152,4.64-2.306,6.912-3.52c4.734-2.834,0.313-9.123-3.611-6.758L353.654,455.824z M325.814,467.159c-5.23,2.087-1.742,8.938,2.398,7.288c2.461-0.811,4.951-1.683,7.381-2.585c4.889-1.962,1.806-8.969-2.68-7.163 C330.549,465.54,328.213,466.412,325.814,467.159z M296.731,474.633c-5.108,1.028-3.428,8.502,1.368,7.537 c2.555-0.498,5.108-0.997,7.661-1.559c4.579-0.901,3.675-8.346-1.681-7.474C301.649,473.699,299.189,474.198,296.731,474.633z M266.835,478.09c-0.435,0-0.716,0.156-1.058,0.218c-4.109,1.619-3.083,7.412,1.432,7.412c2.585-0.095,5.17-0.281,7.755-0.498 c4.515,0,4.764-7.63-0.187-7.63C272.192,477.653,269.452,477.997,266.835,478.09z M36.775,218.539 c0.965-4.795-6.696-6.322-7.537-1.277c-0.435,2.585-0.809,5.139-1.183,7.723c-0.904,4.578,6.54,6.322,7.598,1.029L36.775,218.539z M43.812,189.33c1.465-3.643-4.295-7.474-7.068-2.863c-0.965,2.396-1.745,5.541-2.46,8.064c-1.089,5.572,6.54,6.32,7.412,1.992 C42.473,194.313,43.096,191.634,43.812,189.33z M54.743,161.336c2.086-5.201-5.263-7.443-6.912-3.238l-3.208,7.068 c-1.961,4.92,5.263,7.473,7.037,3.021L54.743,161.336z M69.379,135.054c2.741-4.578-3.987-8.221-6.445-4.142l-4.111,6.602 c-2.585,4.329,3.987,8.253,6.57,3.924L69.379,135.054z M87.409,111.014c3.083-3.083-1.277-8.438-5.604-5.23 c-1.776,1.961-3.488,4.172-5.169,6.227c-3.208,4.267,3.113,8.596,5.979,4.765C84.169,114.844,85.789,112.883,87.409,111.014z M108.522,89.59c3.954-3.955-1.932-8.875-5.077-5.73c-1.93,1.713-3.86,3.488-5.761,5.293c-3.706,3.707,1.9,8.938,5.294,5.512 C104.784,92.952,106.653,91.239,108.522,89.59z M132.313,71.218c0.777-0.499,1.432-1.558,1.588-2.335 c0.716-3.551-2.897-5.824-5.885-4.02c-2.149,1.434-4.268,2.93-6.384,4.454c-4.141,3.083,0.591,9.124,4.515,6.166L132.313,71.218z M158.345,56.176c3.55-1.4,2.648-8.189-2.802-7.1c-2.367,0.965-5.2,2.553-7.505,3.768c-4.701,2.834-0.311,9.125,3.613,6.758 C153.861,58.418,156.104,57.297,158.345,56.176z M186.184,44.842c5.233-2.086,1.745-8.937-2.397-7.287 c-2.428,0.779-4.983,1.682-7.38,2.584c-4.857,1.963-1.776,8.969,2.678,7.164C181.419,46.46,183.818,45.559,186.184,44.842z M215.269,37.369c5.138-1.029,3.457-8.502-1.339-7.537c-2.584,0.498-5.138,0.996-7.661,1.557 c-4.732,0.936-3.487,8.502,1.683,7.473C210.38,38.303,212.84,37.804,215.269,37.369z M245.163,33.912 c0.437,0,0.748-0.156,1.06-0.218c4.109-1.62,3.081-7.412-1.434-7.412c-2.585,0.093-5.169,0.28-7.754,0.498 c-0.84,0-2.086,0.655-2.583,1.278c-2.086,2.832-0.437,6.352,3.206,6.352C240.149,34.192,242.671,34.005,245.163,33.912z M26.001,256v0.125v0.094v0.063c0.062,63.4,25.814,120.791,67.354,162.363c41.635,41.602,99.15,67.354,162.644,67.354 c2.116,0,3.83-1.713,3.83-3.8c0-2.116-1.714-3.828-3.83-3.828c-61.377,0-116.993-24.912-157.226-65.146S33.661,317.407,33.661,256 v-0.093v-0.093l0.095-7.35c0-5.355-7.63-4.951-7.63-0.249l-0.125,7.691V256L26.001,256z M485.999,256v-0.062v-0.063v-0.093 c-0.032-63.401-25.784-120.853-67.356-162.425C377.01,51.725,319.525,26.002,256,26.002c-2.118,0-3.831,1.712-3.831,3.83 c0,2.086,1.712,3.83,3.831,3.83c61.407,0,116.991,24.881,157.224,65.113c40.233,40.233,65.146,95.816,65.146,157.225l-0.125,7.537 c0,5.355,7.63,4.951,7.63,0.248l0.125-7.504v-0.094v-0.093V256z M252.575,272.754v-16.131c-5.013-1.432-8.688-3.611-11.023-6.538 c-2.335-2.927-3.52-6.447-3.52-10.62c0-4.203,1.339-7.754,3.987-10.617c2.646-2.866,6.167-4.516,10.557-4.953v-3.799h5.636v3.799 c4.109,0.499,7.38,1.9,9.809,4.205c2.429,2.304,3.985,5.387,4.64,9.249l-9.809,1.244c-0.592-3.021-2.149-5.075-4.64-6.165V247.5 c6.196,1.649,10.432,3.828,12.673,6.477c2.242,2.646,3.363,6.072,3.363,10.244c0,4.64-1.401,8.563-4.235,11.741 c-2.832,3.206-6.756,5.168-11.801,5.946v7.193h-5.636v-7.1c-4.422-0.528-8.003-2.18-10.774-4.92 c-2.804-2.771-4.547-6.663-5.326-11.677l10.026-1.185c0.405,2.057,1.185,3.831,2.304,5.295 C249.958,271.01,251.204,272.068,252.575,272.754z" style="fill-rule:evenodd;clip-rule:evenodd;"></path> </g> </g> <g id="Layer_1"></g> </g></svg>
                                    </div>
                                    <div class="card-heading">
                                        <h2>Deposit</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <!-- Incall -->
                                <div class="form-group d-flex justify-content-start gap-20  align-items-baseline flex-wrap pt-3">
                                    <label style="width:100px">Incall :</label>

                                    <label>
                                        <input class="change_default" type="radio" name="incall_enabled" value="0" {{$escort->incall_enabled==0?'checked':''}} onclick="toggleDeposit('incall', false)"> No
                                    </label>

                                    <label>
                                        <input class="change_default" type="radio" name="incall_enabled" value="1" {{$escort->incall_enabled==1?'checked':''}} onclick="toggleDeposit('incall', true)"> Yes
                                    </label>



                                    <span id="incall_input" style="display:{{$escort->incall_enabled==0?'none':'block'}};">
                                        <div class="d-flex justify-content-start gap-10 align-items-center">
                                            <span>$</span>
                                            <input type="number" name="incall_amount" step="50" min="0" value="{{$escort->incall_amount}}" class="form-control change_default" placeholder="0" style="padding-right: 0px !important; width:100px;">
                                        </div>
                                    </span>
                                </div>

                                <!-- Outcall -->
                                <div class="form-group d-flex justify-content-start gap-20 align-items-baseline flex-wrap">
                                    <label style="width:100px">Outcall: </label>

                                    <label>
                                        <input class="change_default" type="radio" name="outcall_enabled" value="0" {{$escort->outcall_enabled==0?'checked':''}} onclick="toggleDeposit('outcall', false)"> No
                                    </label>

                                    <label>
                                        <input class="change_default" type="radio" name="outcall_enabled" value="1" {{$escort->outcall_enabled==1?'checked':''}} onclick="toggleDeposit('outcall', true)"> Yes
                                    </label>
                                    <span id="outcall_input" style="display:{{$escort->outcall_enabled==0?'none':'block'}}">
                                        <div class="d-flex justify-content-start gap-10 align-items-center">
                                            <span>$</span>
                                            <input type="number" name="outcall_amount" step="50" min="0" value="{{$escort->outcall_amount}}" class="form-control change_default" placeholder="0" style="padding-right: 0px !important; width:100px;">
                                        </div>
                                    </span>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                @if (request()->segment(2) == 'profile' && request()->segment(3))
            
                    <div class="col-md-12 text-right mt-3 mb-5">
                        <button id="store_rate" type="submit" class="save_profile_btn common-save-btn">Update</button>
                    </div>
            </form>
            @endif   
    </div>



<div class="tab_btm_btns_preview_and_next">
    <div class="row pt-3 pb-3">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
            <a class="nex_sterp_btn btn_width_hundred" id="home-tab" data-toggle="tab" href="#aboutme"
                role="tab" aria-controls="home" aria-selected="true">
                <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">

            @if(request()->segment(2) == 'profile')
            <a data-toggle="modal" data-id="{{$escort->id}}" data-target="#view-listing" class="save_profile_btn preview-profile" href="#">Preview</a>
            @endif
            <a href="#available" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab"
                aria-controls="contact" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
</div>
<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">

            <form id="myServices" class="common-form" action="{{ route('escort.settings.services') }}" method="POST">
                @CSRF
                   <div class="row inner-row">
                        <div class="col-lg-12">
                            <div class="card-top">
                                <div class="card-icon">
                                    <svg width="64px" height="64px" viewBox="0 0 33 33" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>tag-2</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-360.000000, -774.000000)" fill="#ff3c5f"> <path d="M390.097,789.321 C390.097,789.849 389.611,790.623 389.095,791.139 L378.823,801.378 L365.634,788.197 L375.89,777.974 C376.36,777.504 377.111,776.903 377.641,776.903 L389.139,776.903 C389.668,776.903 390.097,777.331 390.097,777.858 L390.097,789.321 L390.097,789.321 Z M375.89,804.304 C375.079,805.111 373.765,805.111 372.955,804.304 L362.684,794.063 C361.873,793.256 361.873,791.946 362.684,791.139 L364.166,789.66 L377.341,802.856 L375.89,804.304 L375.89,804.304 Z M390.097,774.993 L376.683,774.993 C375.624,774.993 375.431,775.455 374.422,776.511 L361.217,789.676 C359.596,791.291 359.596,793.911 361.217,795.526 L371.487,805.767 C373.108,807.382 375.735,807.382 377.356,805.767 L390.563,792.602 C391.412,791.754 392.014,791.332 392.014,790.276 L392.014,776.903 C392.014,775.849 391.155,774.993 390.097,774.993 L390.097,774.993 Z M383.959,786.019 C383.148,786.826 381.835,786.826 381.024,786.019 C380.214,785.211 380.214,783.901 381.024,783.093 C381.835,782.285 383.148,782.285 383.959,783.093 C384.77,783.901 384.77,785.211 383.959,786.019 L383.959,786.019 Z M379.558,781.63 C377.937,783.246 377.937,785.865 379.558,787.481 C381.178,789.097 383.806,789.097 385.427,787.481 C387.047,785.865 387.047,783.246 385.427,781.63 C383.806,780.015 381.178,780.015 379.558,781.63 L379.558,781.63 Z" id="tag-2" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
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
                    <div class="col-md-12 common-footer text-right">
                        <button id="my_services" type="submit" class="common-save-btn">Save</button>
                    </div>
                </div>
            </form>

</div>
<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
    
    <div class="about_me_drop_down_info ">
        <div class="fill_profile_headings_global">
            <h2>My Services</h2>
        </div>
        <div class="padding_20_all_side">
            <form id="myServices" action="{{ route('escort.settings.services') }}" method="POST">
                @CSRF
                <div class="pt-0 pb-0">
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
                                    <li class="mb-2" id="hideenclassOne_{{$value->id}}">
                                        <div class='my_service_anal hideenclassOne{{$value->id}}'>
                                            <span class="dollar-sign">{{$value->name}}</span>
                                            <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->pivot->price}}" min=0 step=10 max=200>
                                            <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder='test test '>
                                            <span id="span_id" data-id="{{$value->id}}">
                                            <i class='fas fa-times-circle akh1' id="id_{{$value->id}}" value="{{$value->pivot->service_id}}" data-sname="{{$value->name}}" data-val="{{$value->pivot->service_id}}"></i>
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
                                    <li class="mb-2" id="hideenclassTwo_{{$value->id}}">
                                        <div class='my_service_anal hideenclassTwo{{$value->id}}'>
                                            <span class="dollar-sign">{{$value->name}}</span>
                                            <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->pivot->price}}" min=0 step=10 max=200>
                                            <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder=''>
                                            <span>
                                            <i class='fas fa-times-circle akh2' id="idTwo_{{$value->id }}" value="{{$value->pivot->service_id}}"  data-sname="{{$value->name}}" data-val="{{$value->pivot->service_id}}"></i>
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
                                    <li class="mb-2" id="hideenclassThree_{{$value->id}}">
                                        <div class='my_service_anal hideenclassThree{{$value->id}}'>
                                            <span class="dollar-sign">{{$value->name}}</span>
                                            <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->pivot->price}}" min=0 step=10 max=200>
                                            <input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder=''>
                                            <span>
                                            <i class='fas fa-times-circle akh3' id="idThree_{{$value->id}}" value="{{$value->pivot->service_id}}"  data-sname="{{$value->name}}" data-val="{{$value->pivot->service_id}}"></i>
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
    
</div>
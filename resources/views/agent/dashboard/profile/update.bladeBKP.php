
@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
        <!--middle content-->
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form_process">
                            <div class="steps_to_filled_from">step 1</div>
                            <p>About me</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form_process">
                            <div class="steps_to_filled_from">step 2</div>
                            <p>My Services</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form_process">
                            <div class="steps_to_filled_from">step 3</div>
                            <p>My Availability</p>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form_process">
                            <div class="steps_to_filled_from">step 4</div>
                            <p>My Pricing Policy</p>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="filled_from_in_persantage">25%</div>
                    </div>
                </div>
                <div class="manage_process_bar_padding">
                    <div class="progress define_process_bar_width">
                        <div class="progress-bar define_process_bar_color" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <!-- Begin Page Content -->
                <div class="row">
                    <div class="col-md-12 remove_padding_in_ph">
                        <ul class="dk-tab nav gap_between_btns" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutme"
                                    role="tab" aria-controls="home" aria-selected="true">About me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services"
                                    role="tab" aria-controls="profile" aria-selected="false">My Services &
                                Rates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available"
                                    role="tab" aria-controls="contact" aria-selected="false">My
                                Availability</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pricing"
                                    role="tab" aria-controls="contact" aria-selected="false">My Pricing &
                                Policy</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-content-bg" id="myTabContent">
                            <div class="tab-pane fade show active" id="aboutme" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="member-id">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z"
                                            fill="#C2CFE0" />
                                    </svg>
                                    <span>Member ID: {{$escort->user->member_id}}</span>
                                </div>
                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <img class="img-fluid" src="{{ $escort->default_image }}" alt="">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="about-me-box-one-name">{{$escort->name}}</div>
                                            <div class="about-me-box-one-number">{{ $escort->city ? $escort->city->name : null }} - {{$escort->phone}}</div>
                                            <div class="about-me-box-one-map">
                                                <svg width="14" height="21" viewBox="0 0 14 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z"
                                                        fill="#FF3C5F" />
                                                </svg>
                                                {{ $escort->address ? $escort->address.',' : null }} {{ $escort->state ? $escort->state->name : null }} {{ $escort->pincode }}
                                            </div>
                                            <div class="about-md-box-social">
                                                @if(!empty($escort->social_links))
                                                @foreach($escort->social_links as $key=>$val)
                                                <a href="{{ $val }}"><img src="{{ asset('assets/dashboard/img/'.$key.'.svg')}}" /></a>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="pull-right">
                                                <a href="{{ route('agent.create.escort.profile', $escort->id) }}">
                                                    <svg width="30" height="30" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17.7 10.0707L16.7 11.0707L14.65 9.0207L15.65 8.0207C15.86 7.8107 16.21 7.8107 16.42 8.0207L17.7 9.3007C17.91 9.5107 17.91 9.8607 17.7 10.0707ZM8 15.6607L14.06 9.6007L16.11 11.6507L10.06 17.7207H8V15.6607ZM8 10.7207C3.58 10.7207 0 12.5107 0 14.7207V16.7207H6V14.8307L10 10.8307C9.34 10.7507 8.67 10.7207 8 10.7207ZM8 0.720703C6.93913 0.720703 5.92172 1.14213 5.17157 1.89228C4.42143 2.64242 4 3.65984 4 4.7207C4 5.78157 4.42143 6.79899 5.17157 7.54913C5.92172 8.29928 6.93913 8.7207 8 8.7207C9.06087 8.7207 10.0783 8.29928 10.8284 7.54913C11.5786 6.79899 12 5.78157 12 4.7207C12 3.65984 11.5786 2.64242 10.8284 1.89228C10.0783 1.14213 9.06087 0.720703 8 0.720703Z" fill="#0c223d"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                        <h2>About me</h2>
                                    </div>
                                    <div class="padding_20_all_side">
                                        <form id="update_about_me" action="{{ route('agent.about.me',[$escort->id])}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1"><span style="color:red">*</span>Gender:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="gender" required>
                                                                <option value='' selected disabled>-Select-</option>
                                                                <option value=1 {{ ($escort->gender == 1)? 'selected' : ''}}>Male</option>
                                                                <option value=0 {{($escort->gender== 0)? 'selected' : ''}}>Female</option>
                                                                <option value=2 {{($escort->gender== 2)? 'selected' : ''}}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1"><span style="color:red">*</span>Nationality:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="select2-dropdown" required data-parsley-required-message="Select country" name="nationality_id">
                                                                <option value="{{ old('nationality_id',$escort->nationality_id)}}" > {{($escort->nation) ? $escort->nation->name : ''}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Statistics:</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" placeholder="Enter Your Statistics"  name="statistics" class="form-control form-control-sm select_tag_remove_box_sadow" id="" value="{{ $escort->statistics }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Height:</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" placeholder="Enter Your Height" class="form-control form-control-sm select_tag_remove_box_sadow" id=""  name="height" value="{{ $escort->height}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Eyes:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" name="eyes" id="">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.eye-colors') as $key => $color)
                                                                <option value="{{ $key }}" {{ ($escort->eyes == $key) ? 'selected' : ''}}>{{ $color}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Shaved:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.shaved-type') as $key => $type)
                                                                <option value='{{ $key}}' {{ ($escort->shaved == $key) ? 'selected' : ''}}>{{ $type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Orientation:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.orientation') as $key => $orientate)
                                                                <option value='{{ $key}}'{{ ($escort->orientation == $key) ? 'selected' : ''}}>{{ $orientate}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1"><span style="color:red">*</span>Age:</label>
                                                        <div class="col-sm-7">
                                                            <input data-parsley-type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="" required name="age" value="{{ $escort->age}}" data-parsley-min="18" data-parsley-max="70">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Hair Color:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="hair_color">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.hair-colour') as $key => $colour)
                                                                <option value='{{ $key}}'{{ ($escort->hair_color == $key) ? 'selected' : ''}}>{{ $colour}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Skin tone:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="skin_tone">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.skin-tone') as $key => $colour)
                                                                <option value='{{ $key}}' {{ ($escort->skin_tone == $key) ? 'selected' : ''}}>{{ $colour}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Breast:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="breast">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.breast-size') as $key => $size)
                                                                <option value='{{ $key}}' {{ ($escort->breast == $key) ? 'selected' : ''}}>{{ $size}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Contact me:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="contact">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.contact-me') as $key => $contact)
                                                                <option value='{{ $key}}' {{ ($escort->contact == $key) ? 'selected' : ''}}>{{ $contact}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Ethnicity:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity"  name="ethnicity">
                                                                <option value="">-Select-</option>
                                                                @foreach(config('escorts.profile.ethnicities') as $key => $ethnicity)
                                                                <option value="{{ old('ethnicity', $key) }}">{{ $ethnicity }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Body type:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="body_type">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.body-type') as $key => $body_type)
                                                                <option value='{{ $key}}' {{ ($escort->body_type == $key) ? 'selected' : ''}}>{{ $body_type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Hair Style:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="hair-style" name="hair_style">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.hair-style') as $key => $hair_style)
                                                                <option value='{{ $key}}' {{ ($escort->hair_style == $key) ? 'selected' : ''}}>{{ $hair_style }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Weight:</label>
                                                        <div class="col-sm-7">
                                                            <input data-parsley-type="number" class="form-control form-control-sm  removebox_shdow" placeholder="Enter Your Weight" value="{{$escort->weight}}"  name="weight" data-parsley-min="30" data-parsley-max = "150" vlaue="{{ $escort->weight}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Dress size:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" name="dress_size">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.dress-size') as $key => $dress_size)
                                                                <option value='{{ $key}}' {{ ($escort->dress_size == $key) ? 'selected' : ''}}>{{ $dress_size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" id="update-about-me" class="save_profile_btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                        <h2>Read more</h2>
                                    </div>
                                    <div class="padding_20_all_side">
                                        <form id="read_more" action="{{ route('agent.read.more',[$escort->id])}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Piercing:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id=""  name="piercing">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.piercing') as $key => $piercing)
                                                                <option value='{{ $key}}' {{ ($escort->piercing == $key) ? 'selected' : ''}}>{{ $piercing }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Drugs:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id=""  name="drugs">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.drugs') as $key => $drug)
                                                                <option value='{{ $key}}' {{ ($escort->drugs == $key) ? 'selected' : ''}}>{{ $drug }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Language:</label>
                                                        <div class="col-sm-7">

                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="language" >
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.languages') as $key => $language)
                                                                <option value='{{ $key}}'@if(!empty($escort->language)) @if(in_array($key ,$escort->language)) selected @endif @endif data-name="{{  $language }}">{{ $language }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @if(!empty($escort->language))
                                                        @foreach($escort->language as $language)
                                                        <div class='selecated_languages select_lang'><span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!}</span> </div>
                                                        @endforeach
                                                        @endif
                                                        <div id="container_language"></div>
                                                        <div id="show_language" style="display:none">
                                                        </div>


                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Travel:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id=""  name="travel">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.travels') as $key => $travel)
                                                                <option value='{{ $key}}' {{ ($escort->travel == $key) ? 'selected' : ''}}>{{ $travel }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Tattoos:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id=""  name="tattoos">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.tattooes') as $key => $tattoos)
                                                                <option value='{{ $key}}' {{ ($escort->tattoos == $key) ? 'selected' : ''}}>{{ $tattoos }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Smoke:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id=""  name="smoke">
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.smokes') as $key => $smoke)
                                                                <option value='{{ $key}}' {{ ($escort->smoke == $key) ? 'selected' : ''}}>{{ $smoke }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Available to:</label>
                                                        <div class="col-sm-7">
                                                            <button class="btn custome_button_style dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            -Select-
                                                            </button>

                                                            <div class="dropdown-menu padding_three_px_all" aria-labelledby="dropdownMenuButton">
                                                                @foreach(config('escorts.profile.available-to') as $key => $available_to)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input available_to" id="" name="available_to[]" value='{{ $key}}' @if(!empty($escort->available_to)) @if(in_array($key , $escort->available_to)) checked @endif @endif>
                                                                <label class="form-check-label" for="exampleCheck1">{{ $available_to }}</label>
                                                            </div>
                                                            @endforeach
                                                        </div>

                                                        </div>
                                                        @isset($escort->available_to)
                                                        <div class="selecated_languages available">
                                                            <img src="{{ asset('assets/dashboard/img/male-user.png')}}" id="2" style="display:{{ (in_array(2 , $escort->available_to)) ? 'inline-block' : 'none' }}"  >
                                                            <img src="{{ asset('assets/dashboard/img/woman-avatar.png')}}" id="1" style="display:{{ (in_array(1 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                                            <img src="{{ asset('assets/dashboard/img/group.png')}}" id="4" style="display:{{ (in_array(4 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                                            <img src="{{ asset('assets/dashboard/img/couple.png')}}" id="6" style="display:{{ (in_array(6 , $escort->available_to)) ? 'inline-block' : 'none' }}">
                                                        </div>
                                                        @endisset
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">SWA License:</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" value="{{ $escort->license}}" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Play types:</label>
                                                        <div class="col-sm-7">
                                                            <div class="dropdown">
                                                                <button class="btn custome_button_style dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                -Select-
                                                                </button>
                                                                <div class="dropdown-menu padding_three_px_all" aria-labelledby="dropdownMenuButton">

                                                                    @foreach(config('escorts.profile.play-types') as $key => $play_type)

                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" name="play_type[]" value='{{ $key}}' @if(!empty($escort->play_type)) @if(in_array($key , $escort->play_type)) checked @endif @endif>
                                                                        <label class="form-check-label" for="exampleCheck1">{{ $play_type }}</label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-5" for="exampleFormControlSelect1">Payment:</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="payment_type" >
                                                                <option value="" selected disabled>-Select-</option>
                                                                @foreach(config('escorts.profile.Payments') as $key => $Payment)
                                                                <option value='{{ $key}}' {{ ($escort->payment_type == $key) ? 'selected' : ''}}>{{ $Payment }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn">Update</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                        <h2>Who am I ?</h2>
                                    </div>
                                    <div class="padding_20_all_side">
                                        <div class="whoiamtitle">Enter Your Title Here</div>
                                        <form id="update_abut_who_am_i" action="{{ route('agent.about',[$escort->id])}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea id="editor1" name="about" >
                                                    @if(!empty($escort->about)) {{ $escort->about}} @endif
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn">Update</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="fill_profile_headings_global">
                                        <h2>My Services</h2>
                                    </div>
                                    <div class="padding_20_all_side">


                                        <form id="myServices" action="{{ route('agent.store.services',[$escort->id]) }}" method="POST">
                                            @CSRF
                                            <div class="pt-2 pb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-sm-5" for="exampleFormControlSelect1">Fun Stuff - On Viewer</label>
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
                                                                <li id="{{$value->id}}"><div class='my_service_anal hideenclassOne{{$value->id}}'><span>{{$value->name}}</span>

                                                                    <input type='number' class='input_border' name='price[]' placeholder='$' value="{{$value->pivot->price}}"><input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder='$'><span id="span_id" data-id="{{$value->id}}"><i class='fas fa-times-circle' id="id_{{$value->id}}" value="{{$value->pivot->service_id}}"></i></span></div>
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
                                                            <label class="col-sm-5" for="exampleFormControlSelect1">Kinky Stuff - On Viewer</label>
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
                                                                <li id="{{$value->id}}"><div class='my_service_anal hideenclassTwo{{$value->id}}'><span>{{$value->name}}</span>

                                                                    <input type='number' class='input_border' name='price[]' placeholder='$' value="{{$value->pivot->price}}"><input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder='$'><span><i class='fas fa-times-circle' id="idTwo_{{$value->id }}" value="{{$value->pivot->service_id}}"></i></span></div>
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
                                                            <label class="col-sm-5" for="exampleFormControlSelect1">Fun Stuff - On Me</label>
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
                                                                <li id="{{$value->id}}"><div class='my_service_anal hideenclassThree{{$value->id}}'><span>{{$value->name}}</span>
                                                                    <input type='number' class='input_border' name='price[]' placeholder='$' value="{{$value->pivot->price}}"><input type='hidden' name='service_id[]' value="{{$value->pivot->service_id}}" placeholder='$'><span><i class='fas fa-times-circle' id="idThree_{{$value->id}}" value="{{$value->pivot->service_id}}"></i></span></div>
                                                                </li>
                                                                @endforeach

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn">Update</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                        <h2>Rates</h2>
                                    </div>
                                    <div class="padding_20_all_side">
                                        <form id='storeRate' action="{{ route('agent.store.rate',[$escort->id]) }}" method="Post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-9 col-md-12 col-sm-12">
                                                    @foreach($durations as $duration)
                                                    <div class="rate_first_row">
                                                        <input type="hidden" name="duration_id[]" value="{{ $duration->id}}">
                                                        <div class="form-group row">
                                                            <label class="col-md-3" for="exampleFormControlSelect1">{{ $duration->name}}:</label>
                                                            <div class="col-md-3">
                                                                <div class="service_rate_dolor_symbol form-group">
                                                                    <span>$</span>
                                                                    <input type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="massage_price" name="massage_price[]" value="{{ $escort->durationRate($duration->id, 'massage_price') }}">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="service_rate_dolor_symbol form-group">
                                                                    <span>$</span>
                                                                    <input type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="{{ $escort->durationRate($duration->id, 'incall_price') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="service_rate_dolor_symbol form-group">
                                                                    <span>$</span>
                                                                    <input type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="{{ $escort->durationRate($duration->id, 'outcall_price') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn">Update</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="fill_profile_headings_global">
                                        <h2>My Availability</h2>
                                    </div>
                                    <div class="padding_20_all_side">
                                        <form id="myability" action="{{ route('agent.store.availability', [$escort->id])}}" method="Post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Monday:</label>
                                                        <input type="hidden"  value="monday">
                                                        <div class="col-md-10">
                                                            <div class="row">

                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i }}"{{($i == $escort->availabilityFromHour('monday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="mon_mm_from" name="mon_mm_from">
                                                                            <option value="" selected disabled>-MM-</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('monday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}
                                                                            </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('monday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('monday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_to" id="mon_hh_to" >
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('monday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>@endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_mm_to" id="mon_mm_to">
                                                                            <option value="" selected disabled>-MM-</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('monday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_to">
                                                                            <option value="" selected disable>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('monday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('monday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="monday" id="resetMonday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Tuesday:</label>
                                                        <input type="hidden"  value="tuesday">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_from" id="tue_hh_from">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityFromHour('tuesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="tue_mm_from" name="tue_mm_from">
                                                                            <option value="" selected disabled>MM</option>
                                                                            <option value="00">00</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('tuesday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>

                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_from">
                                                                            <option value="" selected disable>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('tuesday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_to" id="tue_hh_to">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('tuesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_mm_to" id="tue_mm_to">
                                                                            <option value="" selected disabled>MM</option>
                                                                            <option value="00">00</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('tuesday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_to">
                                                                            <option value="" selected disable>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('tuesday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('tuesday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="tuesday" id="resetTuesday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Wednesday:</label>
                                                        <input type="hidden"  value="wednesday">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_from" id="wed_hh_from">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityFromHour('wednesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="wed_mm_from" name="wed_mm_from">
                                                                            <option value="" selected disabled>-MM-</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('wednesday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_from">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('wednesday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_to" id="wed_hh_to">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('wednesday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_mm_to" id="wed_mm_to">
                                                                            <option value="" selected disabled>-MM-</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('wednesday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_to">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('wednesday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('wednesday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="wednesday" id="resetWednesday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Thursday:</label>
                                                        <input type="hidden"  value="thursday">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_from" id="thu_hh_from">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityFromHour('thursday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="thu_mm_from" name="thu_mm_from">
                                                                            <option value="" selected disabled>-MM-</option>

                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('thursday')) ? "selected" : ''}}>

                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_from">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('thursday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('thursday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_to" id="thu_hh_to">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('thursday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_mm_to" id="thu_mm_to">
                                                                            <option value="" selected disabled>-MM-</option>

                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('thursday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_to">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('thursday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('thursday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="thursday" id="resetThursday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Friday:</label>
                                                        <input type="hidden"  value="friday">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_from" id="fri_hh_from">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityFromHour('friday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="fri_mm_from" name="fri_mm_from">
                                                                            <option value="" selected disabled>MM</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('friday')) ? "selected" : ""}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_from">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('friday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('friday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_to" id="fri_hh_to">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('friday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_mm_to" id="fri_mm_to">
                                                                            <option value="" selected disabled>MM</option>
                                                                            <option value="00">00</option>
                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('friday')) ? "selected" : ''}}>
                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}
                                                                            </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_to">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('friday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('friday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="friday" id="resetFriday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Saturday:</label>
                                                        <input type="hidden"  value="saturday">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_from" id="sat_hh_from">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityFromHour('saturday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="sat_mm_from" name="sat_mm_from">
                                                                            <option value="">-MM-</option>

                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('saturday')) ? "selected" : ''}}>

                                                                             {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_from">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('saturday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('saturday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_to" id="sat_hh_to">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('saturday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_mm_to" id="sat_mm_to">
                                                                            <option value="" selected disabled>-MM-</option>

                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('saturday')) ? "selected" : ''}}>

                                                                            {{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_to">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('saturday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('saturday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="saturday" id="resetSaturday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="exampleFormControlSelect1">Sunday:</label>
                                                        <input type="hidden"  value="sunday">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_from" id="">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityFromHour('sunday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_mm_from">
                                                                            <option value="" selected disabled>-MM-</option>

                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityFromMinute('sunday')) ? "selected" : ''}}>

                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }}
                                                                            </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_time_from">
                                                                            <option value="" selected disabled>--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityFromA('sunday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityFromA('sunday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>to</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="service_rate_dolor_symbol form-group">
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_to" id="">
                                                                            <option value="" selected disabled>-HH-</option>
                                                                            @for($i=1; $i<=12;$i++)
                                                                            <option vlaue="{{ $i}}"{{($i == $escort->availabilityToHour('sunday')) ? "selected" : ''}}>{{sprintf("%02d", $i)}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        <span>:</span>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_mm_to" id="">
                                                                            <option value="" selected disabled>-MM-</option>

                                                                            @for($i=0; $i<=6;$i++)
                                                                            <option value="{{ ($i == 6)?$i*10-1 : sprintf('%02d',$i*10) }}"{{((($i == 6)?$i*10-1 : sprintf('%02d',$i*10))== $escort->availabilityToMinute('sunday')) ? "selected" : ''}}>

                                                                            {{ ($i == 6)? $i*10-1 : sprintf('%02d',$i*10) }} </option>
                                                                            @endfor
                                                                        </select>
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="sun_time_to" name="sun_time_to">
                                                                            <option value="">--</option>
                                                                            <option value="AM"{{("AM" == $escort->availabilityToA('sunday')) ? "selected" : ''}}>AM</option>
                                                                            <option vlaue="PM"{{("PM" == $escort->availabilityToA('sunday')) ? "selected" : ''}}>PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"><input type="reset" value="Reset" class="resetdays" data-day="sunday" id="resetSunday"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn">Save</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
                                <form id="myPolicy" action="{{ route('agent.update.policy', [$escort->id])}}" method="Post">
                                    @csrf
                                    <div class="about_me_drop_down_info box_shadow_fill_profile">
                                        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                            <h2>My Pricing Policy</h2>
                                        </div>
                                        <div class="padding_20_all_side">
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea id="editor2" name="pricing_policy" >{{$escort->pricing_policy}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="about_me_drop_down_info box_shadow_fill_profile">
                                        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                            <h2>Desclaimer</h2>
                                        </div>
                                        <div class="padding_20_all_side">
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea id="editor3" name="disclaimer" >{{$escort->disclaimer}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" class="save_profile_btn" id="compliteprofilemessge">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!--<div class="about_me_drop_down_info box_shadow_fill_profile">
                                    <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                                        <h2>Membership Type</h2>
                                    </div>
                                    <div class="padding_20_all_side">
                                        <form id="membershipType" action="#" method="POST">
                                            @csrf
                                            <input id="hidden-escort-id" type="hidden" name="active_escort_id" value="{{ $escort->id }}">
                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-7">
                                                    <button type="submit" class="btn btn-success Platinum remove_padding membership_type" id="type_0" data-value="1">
                                                    <i class="glyphicon glyphicon-upload"></i>
                                                    <span>Platinum</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-primary Gold remove_padding membership_type" id="type_1" data-value="2">
                                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                                    <span>Gold</span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning Silver remove_padding membership_type" id="type_2" data-value="3">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Silver</span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning Free remove_padding membership_type" id="type_3" data-value="4">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Free</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Content Wrapper -->
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <!--<img src="..." class="rounded mr-2" alt="...">-->
    <strong class="mr-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>

@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script>
    var editor_id2 = document.getElementById("editor2");
    var editor_id3 = document.getElementById("editor3");
    let editor2 = CKEDITOR.replace(editor_id2);
    let editor3 = CKEDITOR.replace(editor_id3);


    var textarea = document.getElementById('editor1');
    let editor = CKEDITOR.replace(textarea);

    $('#select2-dropdown').select2({
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('country.list') }}",
            dataType: "json",
            type: "GET",
            data: function (params) {
                console.log(params);
                var queryParameters = {
                    query: params.term
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

</script>
<script>
    // $('#ethnicity').select2({
    //     createTag: function (params) {
    //         var term = $.trim(params.term);
    //
    //         if (term === '') {
    //             return null;
    //         }
    //         return {
    //             id: term,
    //             text: term,
    //             newTag: false // add additional parameters
    //         }
    //     },
    //     tags: false,
    //     minimumInputLength: 2,
    //     tokenSeparators: [','],
    //     ajax: {
    //         url: "{{ route('country.list') }}",
    //         dataType: "json",
    //         type: "GET",
    //         data: function (params) {
    //             console.log(params);
    //             var queryParameters = {
    //                 query: params.term
    //             }
    //             return queryParameters;
    //         },
    //         processResults: function (data) {
    //             return {
    //                 results: $.map(data, function (item) {
    //
    //                     return {
    //                         text: item.name,
    //                         id: item.id
    //                     }
    //                 })
    //             };
    //         }
    //     }
    // });


    $('#update_about_me').parsley({

    });
    $('#update_about_me').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData($('#update_about_me')[0]);

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                }
            });
        }
    });

    $('#read_more').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData($('#read_more')[0]);

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        location.reload();
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                }
            });
        }
    });

    $('#update_abut_who_am_i').on('submit', function(e) {

        let about = editor.getData();
        var form = $(this);
        if (form.parsley().isValid()) {
            var url = form.attr('action');
            var data = new FormData();
            data.append('about',about);
            //data.append('user_id',5);
            data.append('_token',$('input[name="_token"]').val());
            e.preventDefault();

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                success: function (data) {
                    console.log(data);
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                }
            });
        }
    });

    $('#language').change(function(){
        var languageValue = $('#language').val();
        $("#show_language").show();
        $(".select_lang").hide();
        var selectedLanguage = $(this).children("option:selected", this).data("name");
        $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" </span> </div> ");
        $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
    });

    $( "#selected_service_one li" ).each(function( index, element ) {
        var val = $(this).attr('id');
        $("#service_id_one option[value="+ val +"]").attr('disabled','disabled');

        $('body').on('click', "#id_"+val, function() {
            $("#service_id_one option[value="+ val +"]").attr('disabled', false);
            $('li .hideenclassOne'+val).parent().remove();
            $('#service_id_one').val('');
            console.log(val);
        });
    });

    $( "#selected_service_two li" ).each(function( index ) {
        var val = $(this).attr('id');
        $("#service_id_two option[value="+ val +"]").attr('disabled','disabled');

        $('body').on('click', "#idTwo_"+val, function() {
            $("#service_id_two option[value="+ val +"]").attr('disabled', false);
            $('li .hideenclassTwo'+val).parent().remove();
            $('#service_id_two').val('');
            console.log(val);
        });
    });
    $( "#selected_service_three li" ).each(function( index ) {
        var val = $(this).attr('id');
        $("#service_id_three option[value="+ val +"]").attr('disabled','disabled');

        $('body').on('click', "#idThree_"+val, function() {
            $("#service_id_three option[value="+ val +"]").attr('disabled', false);
            $('li .hideenclassThree'+val).parent().remove();
            $('#service_id_three').val('');
            console.log(val);
        });
    });

    $('body').on('change','#service_id_one', function(){
        var selectedIdOne = $('#service_id_one').val();
        var getNameOne = $(this).children(":selected").attr("id");
        if(selectedIdOne){
            $("#selected_service_one").append(" <li id="+selectedIdOne+"><div class='my_service_anal hideenclassOne"+selectedIdOne+"'><span>"+getNameOne+"</span><input type='number' class='input_border' name='price[]' placeholder='$'><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder='$'><span><i class='fas fa-times-circle' id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
            $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
            console.log('change='+selectedIdOne);
        }
    });

    $('body').on('change','#service_id_two', function(){
        var selectedIdTwo = $('#service_id_two').val();
        var getNameTwo = $(this).children(":selected").attr("id");
        if(selectedIdTwo){
            $("#selected_service_two").append(" <li id="+selectedIdTwo+"><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span>"+getNameTwo+"</span><input type='number' class='input_border' name='price[]' placeholder='$'><input type='hidden' name='service_id[]' value="+ selectedIdTwo +" placeholder='$'><span><i class='fas fa-times-circle' id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
            $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
            console.log('change='+selectedIdTwo);
        }
    });

    $('body').on('change','#service_id_three', function(){
        var selectedIdThree = $('#service_id_three').val();
        var getNameThree = $(this).children(":selected").attr("id");
        if(selectedIdThree){
            $("#selected_service_three").append(" <li id="+selectedIdThree+"><div class='my_service_anal hideenclassThree"+selectedIdThree+"'><span>"+getNameThree+"</span><input type='number' class='input_border' name='price[]' placeholder='$'><input type='hidden' name='service_id[]' value="+ selectedIdThree +" placeholder='$'><span><i class='fas fa-times-circle' id='id_"+ selectedIdThree+"' value="+selectedIdThree+"></i></span></div></li> ");
            $("#service_id_three option[value="+ selectedIdThree +"]").attr('disabled','disabled');
            console.log('change='+selectedIdThree);
        }
    });
//start available //
$('.available_to').click( function() {
    var val = $(this).val();
    console.log($(this).val());
    $(this).is(':checked') ? $('#'+val).show() : $('#'+val).hide();
});

//end available to
    $(".membership_type").each(function( index){
        $('body').on('click','#type_'+index, function(e){
            e.preventDefault();
            var href = $("#membershipType").attr('action');
            var plan_type = $(this).data('value');
            //var data = new FormData($('#membershipType')[0]);
            var id = $('#hidden-escort-id').val();
            console.log()
            $.ajax({
                url : href,
                method : "POST",
                data : {'plan_type': plan_type},
                //contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == 1){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                },

        });

    });
    });

    $('#myServices').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

            var url = form.attr('action');
            var data = new FormData($('#myServices')[0]);
            console.log(data);

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                },
                error: function (data) {
                    $.toast({
                        heading: 'Error!',
                        text: data.responseJSON.message,
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                }
            });
        //}
    });

    $('#storeRate').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = new FormData($('#storeRate')[0]);
        console.log(data);

        $.ajax({
            method: form.attr('method'),
            url:url,
            data:data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(!data.error){
                    $.toast({
                        heading: 'Success',
                        text: 'Record successfully update',
                        icon: 'success',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Records Not update',
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                }
            }
        });
    });

    $('#myability').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData($('#myability')[0]);
            console.log(data);

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                }
            });
        }
    });

    $('#myPolicy').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        let pricing_policy = editor2.getData();
        let disclaimer = editor3.getData();

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData();
            data.append('pricing_policy',pricing_policy);
            data.append('disclaimer',disclaimer);
            data.append('_token',$('input[name="_token"]').val());
            console.log(data);
            // if(disclaimer == "") {
            //     $.toast({
            //         heading: 'Error',
            //         text: 'This field is required',
            //         icon: 'error',
            //         loader: true,
            //         position: 'top-right',      // Change it to false to disable loader
            //         loaderBg: '#9EC600'  // To change the background
            //     });
            // }
            // if(pricing_policy == "") {
            //     $.toast({
            //         heading: 'Error',
            //         text: 'This field is required',
            //         icon: 'error',
            //         loader: true,
            //         position: 'top-right',      // Change it to false to disable loader
            //         loaderBg: '#9EC600'  // To change the background
            //     });
            // }
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                    }
                }
            });
        }
    });

    $('#read_more').parsley({

    });
    $('#myability').parsley({

    });
    $('#myPolicy').parsley({

    });


    $('.resetdays').each(function( index ){
        var days = $(this).attr('id');
        $('#'+ days).click(function(){
            console.log($(this).data('day'));
            $("."+$(this).data('day')+" option:selected").removeAttr("selected");
        });
    });
</script>

@endpush

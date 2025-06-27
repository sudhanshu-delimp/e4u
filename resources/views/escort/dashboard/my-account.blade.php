@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
     {{--
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9 ">
            <div class="about_me_drop_down_info box_shadow_fill_profile">
                <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                    <h2>Update Account</h2>
                </div>
                <div class="padding_20_all_side">
                    <form id="userProfile" action="{{ route('escort.account.update',[$escort->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="@if(!empty($escort->id)){{ $escort->id }} @endif">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3" for="exampleFormControlSelect1"><span style="color:red">*</span>Full Name:</label>
                                    <div class="col-sm-7">
                                        <input type="txt" class="form-control form-control-sm removebox_shdow" placeholder="Name" required name="name" value="{{ old('name', $escort->name) }}" data-parsley-required-message="Name is required">
                                    </div>
                                    <div class="termsandconditions_text_color">
                                        @error('name')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3" for="exampleFormControlSelect1"><span style="color:red">*</span>Gender:</label>
                                    <div class="col-sm-7">
                                        <select class="orm-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" name="gender" required data-parsley-required-message="Gender is required">
                                            <option value='' selected disabled>-Select-</option>
                                            <option value=1 {{ ($escort->gender == 1)? 'selected' : ''}}>Male</option>
                                            <option value=0 {{($escort->gender== 0)? 'selected' : ''}}>Female</option>
                                            <option value=2 {{($escort->gender== 2)? 'selected' : ''}}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" style="display:none">
                                    <label class="col-sm-3" for="exampleFormControlSelect1"><span style="color:red">* </span> Country:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="country" name="country_id" data-parsley-errors-container="#country-errors" required data-parsley-required-message="Please select country">
                                            <option value="14" selected></option>
                                        </select>
                                        <span id="country-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3" for="exampleFormControlSelect1"><span style="color:red">* </span>Home State:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="state" name="state_id" data-parsley-errors-container="#state-errors" required data-parsley-required-message="Select country">
                                            @if($escort->state)
                                            <option value="{{ old('state_id', $escort->state_id) }}" selected>{{ $escort->state->name }}</option>
                                            @endif
                                        </select>
                                        <span id="state-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3" for="exampleFormControlSelect1"><span style="color:red">* </span> City:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="city" name="city_id" data-parsley-errors-container="#city-errors" required data-parsley-required-message="Please select city">
                                            @if($escort->city)
                                            <option value="{{ old('state_id', $escort->city_id) }}" selected>{{ $escort->city->name }}</option>
                                            @endif
                                        </select>
                                        <span id="city-errors"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="padding_20_all_side">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-facebook-f"></i></span></label>
                                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Facebook" name="social_links[facebook]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $escort->social_links ? $escort->social_links['facebook'] : null }}">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-instagram"></i></span></label>
                                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Instagram" name="social_links[insta]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $escort->social_links ? $escort->social_links['insta'] : null }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-twitter"></i></span></label>
                                        <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Twitter" name="social_links[twitter]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="{{ $escort->social_links ? $escort->social_links['twitter'] : null }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    --}}
    <!--middle content end here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading">
                <h1> Edit My Account <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span></h1>
            </div>
            <div class="my-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to complete all of your personal details - who you are,
                                information about Profiles and Tours, and how Users communicate with
                                you.
                            </li>
                            <li>
                                Make sure you take the time to complete everything, it will help you
                                manage your Account much better, especially with communication. If you
                                are not sure about any of the settings, get in touch with our
                                <a href="{{ url('contact-us')}}" class="custom_links_design">Help Centre</a>
                                or your <a href="{{ url('escort-dashboard/escort-agency-request')}}" class="custom_links_design">Agent</a> if you have appointed one.
                                {{-- Agent [link to request an Agent is appointed]--}}
                            </li>
                            <li>There is some general information also available to you inside each of the
                                My Account groups.</li>
                        </ol>
                    </div>
                </div>
            </div>
       </div>
       <div class="col-md-12 mt-3">
        <div id="commanAlert" class="alert d-none rounded" role="alert"></div>
      </div>
      
        <div class="col-md-12 mt-4 mb-5">
            <div id="accordion" class="myacording-design">
                <div class="card">
                    <div class="card-header">
                        <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                        About me
                        </a>
                    </div>
                    <div id="about_me" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body">
                            <form id="userProfile" class="v-form-design" action="{{ route('escort.account.update',[$escort->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-10 px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="membership_num">Membership Number</label>
                                                    <span class="form-control form-back" >{{ $escort->member_id }}</span>
                                                    {{-- <input type="number" class="form-control" id="membership_num" placeholder="E123456" aria-describedby="emailHelp"> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="membership_num form-back">Date Joined</label>
                                                    {{-- <input type="date" class="form-control" placeholder=" " aria-describedby="emailHelp"> --}}
                                                    <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">{{Carbon\Carbon::parse($escort->created_at)->format('d/m/Y')}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="my_name" for="my_name">
                                                        My Name
                                                        <img class="delay_tooltip" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="You can also create <a target='_blank' href='{{route('escort.profile.information')}}'>Stage Names</a> to use in any Profile." data-boundary="window">
                                                    </label>
                                                    <input type="text" class="form-control" name="name" placeholder="Enter name..." value="{{ $escort->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Gender">Gender</label>
                                                    <select class="form-control" name="gender" required>
                                                        <option value="">Select</option>
                                                        @foreach(config('escorts.profile.genders') as $key => $gender)
                                                        <option value="{{$key}}" {{ ($escort->gender == $key)? 'selected' : ''}}>{{$gender}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                    <span class="form-control form-back">{{ $escort->phone }}</span>
                                                    {{-- <input type="number" class="form-control" placeholder="+61 4.." name="phone" aria-describedby="emailHelp" value="{{$escort->phone}}"> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="my-agent" for="home_state">Home State
                                                        <img class="delay_tooltip" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="This is the State you reside in. If you created your Account while you were in another State, log a <a target='_blank' href='{{url('escort-dashboard/submitticket')}}'>Support Ticket</a> and we will correct your setting." data-boundary="window">
                                                    </label>
                                                    <label  class="form-control form-back" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" value="{{$escort->state_id}}">
                                                        {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : ''}}
                                                    </label>
                                                    {{-- <select class="form-control" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" data-parsley-errors-container="#state-errors" required data-parsley-required-message="Select country">
                                                    @foreach(config('escorts.profile.states') as $key => $state)
                                                    <option value="{{ $key}}" {{$escort->state_id == $key ? 'selected' : ''}}>{{ $state['stateName'] }}</option>
                                                    @endforeach
                                                    </select> --}}

                                                    <span id="state-errors"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    {{-- @if(!empty($escort->email))
                                                    <span class="form-control form-back">{{$escort->email}}</span>
                                                    @else
                                                    <input type="text" class="form-control" placeholder="JaneDoe@domain.com.au" name="email" aria-describedby="emailHelp" value="{{$escort->email}}">
                                                    @endif --}}
                                                    {{-- <input type="text" class="form-control" placeholder="JaneDoe@domain.com.au" name="email" aria-describedby="emailHelp" value="{{$escort->email}}"> --}}
                                                    <input type="email" class="form-control" name="email" placeholder="JaneDoe@domain.com.au" aria-describedby="emailHelp" value="{{ $escort->email }}">
                                                    {{--<label type="text" class="form-control form-back" placeholder="JaneDoe@domain.com.au" name="email" aria-describedby="emailHelp" >{{$escort->email}}</label>--}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="my-agent" for="my_agent">
                                                    <span>My Agent
                                                        <img class="delay_tooltip" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="You can appoint an Agent to assist you by completing the Agency Request form.  If you want to appoint an Agent, <a target='_blank' class='theme-text-color' href='{{url('escort-dashboard/escort-agency-request')}}'>click here.</a>" data-boundary="window">
                                                    </span>
                                                </label>
                                                    <span class="form-control form-back">{{ $escort->escortsAgent ? $escort->escortsAgent->name : '' }} - Agent ID: {{ $escort->escortsAgent ? $escort->escortsAgent->id : '' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="email">Method of contact - how we communicate with you</label><br>
                                                    
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_call_me" value="4" @if(!empty($escort->contact_type)) {{(in_array(4 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_call_me">Call me</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Email" value="3"  @if(!empty($escort->contact_type)) {{(in_array(3 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Email">Email me</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Message" value="1"  @if(!empty($escort->contact_type)) {{(in_array(1 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Message">Message (via Console)</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Text" value="2"  @if(!empty($escort->contact_type)) {{(in_array(2 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Text">Text me</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                            </form>
                        </div>
                        <div class="card-body">
                            <div id="accordion-2">
                                <div class="card">
                                    <div class="card-header" id="heading-1-2">
                                        <h5 class="mb-0">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#collapse-1-2" aria-expanded="false">
                                            Important information
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-1-2" class="collapse" data-parent="#accordion-2" aria-labelledby="heading-1-2" style="">
                                        <div class="card-body">
                                            <h5>General information</h5>
                                            <ol class="pl-3">
                                                <li>The information set out on this page is mandatory.</li>
                                                <li>
                                                    When you create a Profile
                                                 <ul class="list-new">
                                                        <li class="d-flex">your name will appear in the Profile by default. You can change your name in the Profile to a Stage Name at anytime by selecting it from the drop down menu in the Profile creator, or by editing a saved Profile from your Archive Folder.</li>
                                                        <li class="d-flex">it will always default to your Home State unless you change the Location while creating the Profile by selecting the Location you want the Profile to appear in from the drop down menu in the Profile creator.</li>
                                                    </ul>
                                                </li>
                                                <li>If you select ‘Message’ as your preferred method of contact with us, you will receive a text message from us advising that you have a Message waiting for you. Log on to retrieve the message.</li>
                                                <li>If you have any queries regarding your appointed Agent, contact the Escorts4U help centre by raising a Support Ticket. Please include the Agent ID number. </li>
                                            </ol>
                                            <h5>Home State</h5>
                                            <p>If you want to change your Home State, contact the Escorts4U help centre by raising a <a class=" " href="{{ url('escort-dashboard/submitticket') }}" style="font-size: 16px;"><span class="custom_links_design">Support Ticket.</span></a> You can not change your Home State, only Escorts4U support staff can change your Home State. You will have to provide proof that you have relocated to a new Home State.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                        Profile and Tour options
                        </a>
                    </div>
                    <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                        <div class="card-body">
                            <form class="v-form-design" id="profile_tour_options" action="{{ route('escort.account.profile.tour.update',[$escort->id])}}" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Profile creator settings</label><br>
                                            <div class="form-check form-check-inline">
                                                <input name="profile_creator[]"  class="form-check-input" type="checkbox" id="Method_Message" value="1" @if(!empty($escort->profile_creator)) {{(in_array(1 , $escort->profile_creator)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Message">Include Profile Information (Stage Name optional)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="profile_creator[]"  class="form-check-input" type="checkbox" id="Method_Text" value="2" @if(!empty($escort->profile_creator)) {{(in_array(2 , $escort->profile_creator)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Text">Include Profile Information and allow to over ride</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="profile_creator[]" class="form-check-input" type="checkbox" id="Method_Email" value="3" @if(!empty($escort->profile_creator)) {{(in_array(3 , $escort->profile_creator)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Email">Include social media information</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">How can Viewers contact me</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="viewer_contact_type[]" id="Method_Message" value="1"  @if(!empty($escort->viewer_contact_type)) {{(in_array(1 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Message">Call me</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="viewer_contact_type[]" type="checkbox" id="Method_Email" value="3"  @if(!empty($escort->viewer_contact_type)) {{(in_array(3 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Email">Email me (only for private communications with a Viewer)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="viewer_contact_type[]" type="checkbox" id="Method_Text" value="2"  @if(!empty($escort->viewer_contact_type)) {{(in_array(2 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Text">Text me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Tour options</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="tour_permissition_type[]" type="checkbox" id="Method_Message" value="1" @if(!empty($escort->tour_permissition_type)) {{(in_array(1 , $escort->tour_permissition_type)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Message">Allow Tours to be created</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="tour_permissition_type[]" type="checkbox" id="Method_Text" value="2" @if(!empty($escort->tour_permissition_type)) {{(in_array(2 , $escort->tour_permissition_type)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Text">Allow Tours to be edited</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="tour_permissition_type[]" type="checkbox" id="Method_Email" value="3" @if(!empty($escort->tour_permissition_type)) {{(in_array(3 , $escort->tour_permissition_type)) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Email">Post a Tour leg one day before the arrival date</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                            </form>
                        </div>
                        <div class="card-body">
                            <div id="accordion-1">
                                <div class="card">
                                    <div class="card-header" id="heading-1-1">
                                        <h5 class="mb-0">
                                            <a class="card-link" data-toggle="collapse" href="#collapse-1-1" aria-expanded="true">
                                            General information
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-1-1" class="collapse" data-parent="#accordion-1" aria-labelledby="heading-1-1" style="">
                                        <div class="card-body">
                                            <ol>
                                                <li>By selecting a contact option, the option will appear in your Profile.</li>
                                                <li>If you disable ‘Allow Tours to be edited’ you will not be able to edit a Tour should the need arise.</li>
                                                <li>If you enable ‘Post a Tour leg ...’ you will be charged for that day.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal fade" id="my-agent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
   <div class="modal-header main_bg_color border-0">
                          <h5 class="modal-title text-white">My Agent</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                            </span>
                            </button>
                        </div>
      <div class="modal-body pt-5 pb-5">
        <p class="text-center">You can appoint an Agent to assist you by completing the Agency Request form.  If you want to appoint an Agent, <a class="theme-text-color" href="{{url('escort-dashboard/escort-agency-request')}}">click here.</a></p>
      </div>
    </div>
  </div>
</div>--}}

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript">
    $('#userProfile').parsley({

    });

    function showAlert(message, type = 'success') {
        const alertBox = $('#commanAlert');
        alertBox
            .removeClass('d-none alert-success alert-danger')
            .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
            .html(message);

        setTimeout(() => {
            alertBox.addClass('d-none');
        }, 10000);
    }

        $('#userProfile').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $("#modal-title").text('About Me');

            if (form.parsley().isValid()) {
                var url = form.attr('action');
                var data = new FormData(form[0]);

                $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                    showAlert("Your details have been updated successfully.", "success");
                    } else {
                    showAlert("Oops... something went wrong. Please try again.", "danger");
                    }
                }
                });
            }
        });

        $('#profile_tour_options').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData(form[0]);
            $("#modal-title").text('Profile and Tour options');

            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                if (!data.error) {
                    showAlert("The profile and tour options have been updated successfully.", "success");
                } else {
                    showAlert("Oops... something went wrong. Please try again.", "danger");
                }
                }
            });
        });

    // old
    // $('#userProfile').on('submit', function(e) {
    //   e.preventDefault();

    //   var form = $(this);
    //   $("#modal-title").text('About Me');
    //   if (form.parsley().isValid()) {

    //     var url = form.attr('action');
    //     var data = new FormData(form[0]);
    //     // var data = $(this).serializeArray();
    //     $.ajax({
    //       method: form.attr('method'),
    //       url: url,
    //       data: data,
    //       contentType: false,
    //       processData: false,
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       success: function(data) {
    //         if (!data.error) {
    //           $('.comman_msg').html("Saved");
    //           //$("#my_account_modal").modal('show');
    //           //$("#my_account_modal").show();
    //           $("#comman_modal").modal('show');

    //         } else {
    //           $('.comman_msg').html("Oops.. sumthing wrong Please try again");
    //           $("#comman_modal").show();

    //         }
    //       },

    //     });
    //   }
    // });
    // $('#profile_tour_options').on('submit', function(e) {
    //   e.preventDefault();

    //     var form = $(this);
    //     var url = form.attr('action');
    //     var data = new FormData(form[0]);
    //      $("#modal-title").text('Profile and Tour options');
    //     $.ajax({
    //       method: form.attr('method'),
    //       url: url,
    //       data: data,
    //       contentType: false,
    //       processData: false,
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       success: function(data) {
    //         if (!data.error) {
    //           $('.comman_msg').html("Saved");
    //           //$("#my_account_modal").modal('show');
    //           //$("#my_account_modal").show();
    //           $("#comman_modal").modal('show');

    //         } else {
    //           $('.comman_msg').html("Oops.. sumthing wrong Please try again");
    //           $("#comman_modal").show();

    //         }
    //       },

    //     });

    // });

    $("#close").click(function()
      {
          $("#my_account_modal").hide();
          location.reload();
      });
    $('#city').select2({
      allowClear: true,
      placeholder :'Select City',
      createTag: function(params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }
        return {
          id: term,
          text: term,
                  newTag: false // add additional parameters
                }
              },
              tags: false,
              minimumInputLength: 2,
              tokenSeparators: [','],
              ajax: {
                url: "{{ route('city.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                  console.log(params);
                  var queryParameters = {
                    query: params.term,
                    state_id: $('#state').val()
                  }
                  return queryParameters;
                },
                processResults: function(data) {
                  return {
                    results: $.map(data, function(item) {

                      return {
                        text: item.name,
                        id: item.id
                      }
                    })
                  };
                }
              }
            });

    $('#state').select2({
      allowClear: true,
      placeholder :'Select State',
      createTag: function(params) {
        var term = $.trim(params.term);

        if (term === '') {
          return null;
        }
        return {
          id: term,
          text: term,
                  newTag: false // add additional parameters
                }
              },
              tags: false,
              minimumInputLength: 2,
              tokenSeparators: [','],
              ajax: {
                url: "{{ route('state.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                  console.log(params);
                  var queryParameters = {
                    query: params.term,
                    country_id: $('#country').val()
                  }
                  return queryParameters;
                },
                processResults: function(data) {
                  return {
                    results: $.map(data, function(item) {

                      return {
                        text: item.name,
                        id: item.id
                      }
                    })
                  };
                }
              }
            });


    $('#country').on('change', function(e) {
      if($(this).val()) {
        $('#state').prop('disabled', false);
        $('#state').select2('open');
      } else {
        $('#state').prop('disabled', true);
      }
    });

    $('#state').on('change', function(e) {
      if($(this).val()) {
        $('#city').prop('disabled', false);
        $('#city').select2('open');
      } else {
        $('#city').prop('disabled', true);
      }
    });


</script>
@endpush

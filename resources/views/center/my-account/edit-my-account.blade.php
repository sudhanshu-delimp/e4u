@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }
.toggle-password {
    position: absolute;
    top: 40px;
    right: 22px;
    cursor: pointer;
    z-index: 2;
    color: #6c757d;
}
.brb_icon {
    color: white;
    background-color: #e5365a;
    border-radius: 10px;
    padding: 0px 8px;
}

.blink {
    animation: blink-animation 1s infinite;
}

@keyframes blink-animation {
    50% {
        opacity: 0;
    }
}
    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content start here-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Our Account</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>
                                    <li>Your Advertiser Profile Information will pre-populate any Massage Profile you
                                        create,
                                        including for any other Centres (<b>Associated Centre</b>) you have established. As
                                        you
                                        create your Profiles, you can edit them to reflect more accurately the information
                                        about
                                        the Associated Centre you are creating the Profile for, including the Masseurs who
                                        will
                                        be working at the Associated Centre.</li>
                                    <li>Always note that you can not have a Masseur attached to more than one Profile
                                        representing different Associated Centres at the same time.</li>
                                    <li>Select your preferred method of contact by a Viewer for all of your Massage
                                        Profiles.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="accordion" class="myacording-design">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link collapsed" data-toggle="collapse" href="#about_me"
                                        aria-expanded="false">
                                        About us
                                    </a>
                                </div>
                                <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                    <div class="card-body">
                                        <form id="userProfile" class="v-form-design"
                                            action="{{ route('center.account.update', [$escort->id]) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-10 px-0">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="membership_num">Membership Number</label>
                                                                <span
                                                                    class="form-control form-back">{{ $escort->member_id }}</span>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="membership_num form-back">Date Joined</label>

                                                                <label class="form-control form-back" placeholder=" "
                                                                    aria-describedby="emailHelp">{{Carbon\Carbon::parse($escort->created_at)->format('d-m-Y')}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Display Name"
                                                                    class="common_help_icon common-tooltip">Display Name
                                                                    <img class="delay_tooltip tooltip-icon"
                                                                        src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                                    <span class="tooltip-text">Insert here the trading /
                                                                        business name of the Business.</span>

                                                                </label>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                    name="name" aria-describedby="emailHelp"
                                                                    value="{{ $escort->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Entity Name"
                                                                    class="common_help_icon common-tooltip">Entity Name
                                                                    <img class="delay_tooltip tooltip-icon"
                                                                        src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                                    <span class="tooltip-text">What is the name of the
                                                                        corporate entity that owns the Business Name, like
                                                                        ABC Pty Ltd</span>

                                                                </label>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                    name="entity_name" aria-describedby="emailHelp"
                                                                    value="{{ $escort->entity_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email" class="my-agent">Our Address </label>
                                                                <input type="text" name="business_address" class="form-control" placeholder=" "
                                                                    name="" aria-describedby="emailHelp"
                                                                    value=" {{ $escort->business_address }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control form-back"
                                                                    placeholder=" " name="email"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Business No.">Business No.</label>
                                                                <input type="text" class="form-control form-back"
                                                                    placeholder=" " name="business number"
                                                                    data-parsley-type="digits"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->getRawOriginal('business_number') }}">

                                                              
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Mobile No.</label> 
                                                                 <input type="text" class="form-control form-back"
                                                                    placeholder=" " name="phone"
                                                                    data-parsley-type="digits"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->getRawOriginal('phone') }}">
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Gender"
                                                                    class="my-agent common_help_icon common-tooltip">Home
                                                                    State
                                                                    <img class="delay_tooltip tooltip-icon"
                                                                        src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                                    <span class="tooltip-text">This is the State you reside
                                                                        in. If you created your Account while you were in
                                                                        another State, log a <a
                                                                            href="{{ url('submit_ticket') }}">Support
                                                                            Ticket</a> and we will correct your
                                                                        setting.</span>
                                                                </label>
                                                                <label class="form-control form-back"
                                                                    placeholder=" "
                                                                    aria-describedby="emailHelp" id="stateNew"
                                                                    name="state_id" value="{{ $escort->state_id }}">
                                                                    {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : '' }}
                                                                </label>
                                                                {{-- <select class="form-control" name="state_id">
                                                            @foreach (config('escorts.profile.states') as $key => $state)
                                                                <option value="{{$key}}" {{$key == $escort->state_id ? 'selected' : ''}}>{{$state['stateName']}}</option>
                                                            @endforeach
                                                            </select> --}}
                                                            </div>
                                                        </div>


                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email" class="my-agent">City (Subrub).</label>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                    name="subrub_city" aria-describedby="emailHelp"
                                                                    value=" {{ $escort->subrub_city ? $escort->subrub_city : ''}}">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Our Agent</label>
                                                                <label type="text" class="form-control form-back"
                                                                    placeholder=" " name="phone"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->my_agent ? $escort->my_agent->member_id : 'NA' }}">


                                                                    @if (auth()->user()->my_agent)
                                                                        {{ (!empty(auth()->user()->my_agent->business_name)) ? auth()->user()->my_agent->business_name : (!empty(auth()->user()->my_agent->name))}}
                                                                    @else
                                                                        <a class="request_one"
                                                                            href="{{ url('/center-dashboard/agent-request') }}">
                                                                            Request one</a>
                                                                    @endif

                                                                </label>
                                                            </div>
                                                        </div>


                                                       

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="email">Method of contact:</label>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" checked
                                                                        type="checkbox" name="contact_type[]"
                                                                        id="Method_Message" value="1"
                                                                        @if (!empty($escort->contact_type)) {{ in_array(1, $escort->contact_type) ? 'checked' : null }} @endif>
                                                                    <label class="form-check-label"
                                                                        for="Method_Message">Message (via Console)</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="contact_type[]" id="Method_Text"
                                                                        value="2"
                                                                        @if (!empty($escort->contact_type)) {{ in_array(2, $escort->contact_type) ? 'checked' : null }} @endif>
                                                                    <label class="form-check-label"
                                                                        for="Method_Text">Text</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="contact_type[]" id="Method_Email"
                                                                        value="3"
                                                                        @if (!empty($escort->contact_type)) {{ in_array(3, $escort->contact_type) ? 'checked' : null }} @endif>
                                                                    <label class="form-check-label"
                                                                        for="Method_Email">Email</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="contact_type[]" id="Method_call_me"
                                                                        value="4"
                                                                        @if (!empty($escort->contact_type)) {{ in_array(4, $escort->contact_type) ? 'checked' : null }} @endif>
                                                                    <label class="form-check-label"
                                                                        for="Method_call_me">Call me</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="PayID Name"
                                                                    class="common_help_icon common-tooltip">PayID Name
                                                                    <img class="delay_tooltip tooltip-icon"
                                                                        src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                                    <span class="tooltip-text">Complete this information if
                                                                        you use PayID with your clients.</span>

                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="payID_name" value="{{ $escort->pay_id_name ?? ''}}"
                                                                    placeholder="Insert your Bank Account name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="PayID Number">PayID Number</label>
                                                                <input type="text" class="form-control" name="paID_no"
                                                                    placeholder="Insert your PayID Number" value="{{ formatAccountNumber($escort->pay_id_no, 'bsb') }}">
                                                            </div>
                                                        </div>



                                                        {{-- Social Media Consent --}}

                                                        <div class="col-md-12 my-4">
                                                            <div class="form-group">
                                                                <div>
                                                                    <h3 class="h3">Social Media Consent</h3>
                                                                <label for="">Do you consent, pursuant to clause 13.2 and 13.3 of the Terms and Conditions, to being promoted on any or all of E4U’s social media platforms?</label>
                                                                </div>
                                                                <div class="form-check form-check-inline ml-0">
                                                                    <input class="form-check-input" type="radio" name="social_media_consent" id="yes" value="1" {{ isset($escort->social_media_consent) && $escort->social_media_consent == '1' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="yes">Yes</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="social_media_consent" id="no" value="0" {{ isset($escort->social_media_consent) && $escort->social_media_consent == '0' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="no">No</label>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                        {{-- end --}}

                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" value="save"
                                                class="btn btn-primary shadow-none float-right" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>


                            @if(!is_parent_massage_user_switch())
                            <div class="card  {{ canManageClass()}}">
                                <div class="card-header">
                                    <a class="card-link collapsed" data-toggle="collapse" href="#other_centre"
                                        aria-expanded="false">
                                        Other Centres
                                    </a>
                                </div>
                                <div id="other_centre" class="collapse" data-parent="#accordion" style="">
                                    <div class="card-body px-0">
                                        <h4 class="inn_help_icon">Other Centres <span data-toggle="collapse"
                                                data-target="#in_notes" aria-expanded="true"><b>Help?</b></span></h4>

                                        <div class="card collapse p-0" id="in_notes" style="">
                                            <div class="card-body border-0 mt-0">
                                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                                <ol>
                                                    <li>Add your associated Centres in your corporate group (<b>Associated
                                                            Centre</b>) here. The Centre listed under Our Account is the
                                                        primary
                                                        Member
                                                        and account holder.</li>
                                                    <li>Your Associated Centres are managed from this Account, however, you
                                                        can grant login access to the Account for an Associated Centre by
                                                        enabling that feature.</li>
                                                    <li>Associated Centres that have been granted access to the Account,
                                                        will only see information pertaining to that Centre. That is,
                                                        Profiles and
                                                        Masseurs attached to the Profile. The Associated Centre can not
                                                        create, edit or List a Centre Profile.</li>
                                                </ol>
                                            </div>



                                        </div>
                                        <div class="d-flex justify-content-end my-3">
                                            <button type="button" class="btn-common" data-toggle="modal"  data-backdrop="static" data-keyboard="false"
                                                id="open_add_center">Add Centre</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-3 w-100" id="other_centre_table">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th style="width: 75px;">Member ID</th>
                                                        <th>Display Name</th>
                                                        <th>Entity Name</th>
                                                        <th>Address</th>
                                                        <th>Business No.</th>
                                                        <th>Mobile No.</th>
                                                        <!-- <th>Email</th> -->
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-content">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif


                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link collapsed" data-toggle="collapse"
                                        href="#profile_and_tour_options" aria-expanded="false">
                                        Profile contact options
                                    </a>
                                </div>
                                <div id="profile_and_tour_options" class="collapse" data-parent="#accordion"
                                    style="">
                                    <div class="card-body">

                                        <form class="v-form-design" id="profile_tour_options"
                                            action="{{ route('center.account.profile.contact.update', [$escort->id]) }}"
                                            method="POST">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="email">Profile creator settings</label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input name="profile_creator[]" class="form-check-input"
                                                                type="checkbox" id="profile_Info" value="1"
                                                                
                                                                 @if (!empty($escort->profile_creator)) {{ in_array(1, $escort->profile_creator) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="profile_Info">Include
                                                                Profile Information</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="profile_creator[]" class="form-check-input"
                                                                type="checkbox" id="Peofile_Over" value="2"
                                                                 @if (!empty($escort->profile_creator)) {{ in_array(2, $escort->profile_creator) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Peofile_Over">Include
                                                                Profile Information and allow to over ride</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="profile_creator[]" class="form-check-input"
                                                                type="checkbox" id="Social_Media" value="3"
                                                                
                                                                 @if (!empty($escort->profile_creator)) {{ in_array(3, $escort->profile_creator) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Social_Media">Include
                                                                social media information</label>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                    <label for="email">How can Viewers contact me</label>
                                                    <div class="switch-sec">
                                                        <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="pt-1"><i>When creating a Massage Profile, your Profile settings are by default set to your My Account information. You can over ride those settings in the Profile creator, or disable them here.
                                                        </i>
                                                    </div>
                                                </div> --}}
                                                    <div class="form-group">
                                                        <label for="email">How can Viewers contact us</label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input name="viewer_contact_type[]" class="form-check-input"
                                                                type="checkbox" id="Call_Us" value="1"
                                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(1, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Call_Us">Call
                                                                us</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="viewer_contact_type[]"
                                                                type="checkbox" id="Email_Us" value="3"
                                                                 @if (!empty($escort->viewer_contact_type)) {{ in_array(3, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Email_Us">Email us
                                                                (only for private communications with a Viewer)</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="viewer_contact_type[]" class="form-check-input"
                                                                type="checkbox" id="Text_Us" value="2"
                                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(2, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Text_Us">Text
                                                                us</label>
                                                        </div>
                                                        {{-- <div class="pt-1"><i>You can select both options if you want.</i></div> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="submit" value="Save"
                                                class="btn btn-primary shadow-none float-right" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    {{-- Modal: Add Centre --}}
    <div class="modal fade upload-modal" id="add_center" tabindex="-1" aria-labelledby="add_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scorllable">
       
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/add-center.png') }}"
                                class="custompopicon" alt=" Add Centre"> Add Centre</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </button>
                    </div>
                     <form name="add_center_frm" id="add_center_frm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <!-- Membership ID -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Membership ID</label>
                                        <input type="text" name="member_id" id="member_id" class="form-control" placeholder="Auto-generated when saved"
                                            readonly>
                                    </div>
                                </div>

                                <!-- Access Granted -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Access Granted</label>
                                        <div class="mt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="accessGranted"
                                                    id="accessYes" value="yes">
                                                <label class="form-check-label" for="accessYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="accessGranted"
                                                    id="accessNo" value="no" checked>
                                                <label class="form-check-label" for="accessNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subtle line -->
                            <hr class="my-3" style="border-top: 1px solid #e0e0e0;">

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Date Joined -->
                                    <div class="form-group">
                                        <label>Date Joined</label>
                                        <input type="text" name="join_date" id="join_date" placeholder="mm/dd/ayyyy" class="form-control"
                                           placeholder="DD-MM-YYYY" autocomplete="off" value="<?php echo date('d-m-Y');?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Display Name -->
                                    <div class="form-group">
                                        <label for="Display Name" class="common_help_icon common-tooltip">Display Name
                                            <img class="delay_tooltip tooltip-icon"
                                                src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                            <span class="tooltip-text">Insert here the trading /
                                                business name of the Business.</span>

                                        </label>

                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter display name...">
                                         <span class="text-danger error-name"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Entity Name -->
                                    <div class="form-group">
                                        <label for="Entity Name" class="common_help_icon common-tooltip">Entity Name
                                            <img class="delay_tooltip tooltip-icon"
                                                src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                            <span class="tooltip-text">What is the name of the
                                                corporate entity that owns the Business Name, like
                                                ABC Pty Ltd</span>

                                        </label>
                                        <input type="text" class="form-control" name="entity_name"  id="entity_name" placeholder="Enter entity name...">
                                         <span class="text-danger error-entity_name"></span>    
                                   
                                    </div>
                                </div>
                                <div class="col-lg-6">
                        
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"  id="email" placeholder="Enter email address...">
                                        <span class="text-danger error-email"></span>  
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <label>Address</label>    
                                    <textarea class="form-control" rows="1" name="business_address"  id="business_address" placeholder="Enter address..."></textarea>
                                    <span class="text-danger error-business_address"></span>  
                                    </div>
                                </div>
                            </div>


                            <div class="row">


                                <div class="col-lg-6">
                                    <!-- Business No. -->
                                    <div class="form-group">
                                        <label>Business No.</label>
                                        <input type="text" class="form-control" name="business_number"  id="business_number" placeholder="Enter business number...">
                                         <span class="text-danger error-business_number"></span> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Mobile No. -->
                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <input type="tel" class="form-control" name="phone"  id="phone" placeholder="Enter mobile number...">
                                        <span class="text-danger error-phone"></span> 
                                    </div>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-lg-12">
                                    <!-- Business No. -->
                                    <div class="form-group">
                                        <label>Point of Contact</label>
                                        <input type="text" class="form-control" name="contact_person"  id="contact_person" placeholder="Enter point of contact...">
                                         <span class="text-danger error-point_of_contact"></span> 
                                    </div>
                                </div>
                               
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Method of contact:</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" checked type="checkbox" name="contact_type[]"
                                                id="methodMessage" value="1">
                                            <label class="form-check-label" for="methodMessage">Message (via Console)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                id="methodText" value="2">
                                            <label class="form-check-label" for="methodText">Text</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                id="methodEmail" value="3">
                                            <label class="form-check-label" for="methodEmail">Email</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                id="Method_callme" value="4">
                                            <label class="form-check-label" for="Method_callme">Call me</label>
                                        </div>
                                    </div>
                                </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                    <span class="toggle-password" toggle="#password"><i class="fa fa-eye"></i></span>
                                    <div class="password-strength mt-2 d-none" id="password-strength-wrapper">
                                        <div class="progress" style="height:6px;">
                                            <div id="password-strength-bar"
                                                class="progress-bar"
                                                role="progressbar"
                                                style="width:0%">
                                            </div>
                                        </div>

                                        <small id="password-strength-text" class="mt-1 d-block text-muted">
                                            Password strength
                                        </small>
                                    </div>
                                    <span class="text-danger error-password"></span> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Mobile No. -->
                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input type="password" name="confirm_password" id="confirm_password"  class="form-control" placeholder="Re-type password">
                                    <span class="toggle-password" toggle="#confirm_password"><i class="fa fa-eye"></i></span>
                                    <span class="text-danger error-confirm_password"></span> 
                                </div>
                            </div>
                        </div>

                    


                        
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <!-- Submit -->
                                    <button type="submit" id="submit_button" class="btn-success-modal">Save</button>
                                </div>
                            </div>

                            <input type="hidden" name="center_id" id="center_id">
                        </form>
                    </div>
                     </form>
                </div>
       
    </div>
    </div>
    {{-- end  --}}


    {{-- Modal: View Centre --}}
   <!-- View Center Modal -->
    <div class="modal fade upload-modal" id="view_center" tabindex="-1" aria-labelledby="view_centerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon" alt="View Centre">
                        Centre Summary
                    </h5>

                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>

                <div class="modal-body" style="max-height: 50vh; overflow-y: auto;">
                    <table class="table table-bordered">
                        <tbody>

                            <tr>
                                <th width="30%">Membership ID</th>
                                <td id="v_member_id"></td>
                            </tr>

                            <tr>
                                <th>Access Granted</th>
                                <td id="v_access_granted"></td>
                            </tr>

                            <tr>
                                <th>Date Joined</th>
                                <td id="v_join_date"></td>
                            </tr>

                            <tr>
                                <th>Display Name</th>
                                <td id="v_name"></td>
                            </tr>

                            <tr>
                                <th>Entity Name</th>
                                <td id="v_entity_name"></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td id="v_business_address"></td>
                            </tr>

                            <tr>
                                <th>Point of Contact</th>
                                <td id="v_contact_person"></td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td id="v_email"></td>
                            </tr>

                            <tr>
                                <th>Business No.</th>
                                <td id="v_business_number"></td>
                            </tr>

                            <tr>
                                <th>Mobile No.</th>
                                <td id="v_phone"></td>
                            </tr>

                            <tr>
                                <th>Method of Contact</th>
                                <td id="v_method_of_contact"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- end --}}

@endsection
@push('script')
    
<!-- <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script> -->


<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

   
<script>

    var table = $("#other_centre_table").DataTable({
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    order: [[0, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10,    

    ajax: {
        url: "{{ route('center.all-other-centre-list') }}",
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    },

    columns: 
    [
            { data: 'member_id', name: 'member_id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'entity_name', name: 'entity_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'business_address', name: 'business_address', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'business_number', name: 'business_number', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'mobile', name: 'mobile', searchable: false, orderable:true ,defaultContent: 'NA'},
           // { data: 'email', name: 'email', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
            
    ],
    createdRow: function(row, data, dataIndex) {

        // if (data.status == 'Active') {
        //     $(row).css('background-color', '#e5f2e8');
        // }

        // if (data.status == 'Suspended') {
        //     $(row).css('background-color', '#fae0e0');
        // }

        // if (data.status == 'Pending') {
        //     $(row).css('background-color', '#e6d5a0');
        // }
    }



    });

 


</script>

<script type="text/javascript">

    $('#userProfile').parsley({

    });

    $('#userProfile').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        $("#modal-title").text("About Us");
        $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
        if (form.parsley().isValid()) {

            resetUnsavedChanges();
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
                    const modalElement = document.getElementById('comman_modal');
                    const modal = new bootstrap.Modal(modalElement);
                    if (!data.error) {
                        var msg = "Saved";
                        $('.comman_msg').html(msg);
                        //$("#comman_modal").modal('show');
                        
                        modal.show();
                        //$("#my_account_modal").show();

                        //
                    } else {
                        $('.Lname').html("Oops.. sumthing wrong Please try again");
                        var msg = "Oops.. sumthing wrong Please try again";
                        $('.comman_msg').html(msg);
                        //$("#comman_modal").modal('show');
                        modal.show();

                    }
                },
                error: function(xhr) {submit_button
                const modalElement = document.getElementById('comman_modal');
                const modal = new bootstrap.Modal(modalElement);

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;
                    let msg = '';

                    $.each(errors, function(key, value) {
                        msg += value[0] + "<br>";
                    });

                    $('.comman_msg').html(msg);
                    modal.show();
                }
        }

            });
        }
    });

    $("#close").click(function() {
        $("#my_account_modal").hide();
        location.reload();
    });

    $('#city').select2({
        allowClear: true,
        placeholder: 'Select City',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false 
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
        placeholder: 'Select State',
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
        if ($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });

    $('#state').on('change', function(e) {
        if ($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });

    /////////////////////
    $('#profile_tour_options').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        $("#modal-title").text("Profile Contact Options");
        $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
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
                    const modalElement = document.getElementById('comman_modal');
                const modal = new bootstrap.Modal(modalElement);
                if (!data.error) {
                    $('.comman_msg').html("Saved");
                    //$("#my_account_modal").modal('show');
                    //$("#my_account_modal").show();
                    //$("#comman_msg").modal('show');
                    modal.show();

                } else {
                    $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                    //$("#comman_msg").show();
                        modal.show();

                }
            },

        });

    });


    $(document).on('submit', 'form[name="add_center_frm"]', function(e) 
    {
         e.preventDefault(); 
         let form = $(this);
         let formData = new FormData(this);
         $('span.text-danger').text('');
         if (!document.getElementById("center_id").value) {
         swal_waiting_popup({'title':'Adding a New Centre'});
         }
         else
         {
          swal_waiting_popup({'title':'Updating Centre'});   
         }
         $.ajax({
               url: "{{ route('center.add-sub-account') }}",
               method: 'POST',
               data: formData,
               contentType: false,
               processData: false, 
               success: function(response) {
                     table.ajax.reload(null, false); 
                     Swal.close();
                     $('span.text-danger').text('');
                     $('#add_center').modal('hide');
                     $('#add_center_frm')[0].reset();
                     swal_success_popup(response.message);
               },
               error: function(xhr) 
               {
                     Swal.close();
                     console.log(xhr);
                     if (xhr.status === 422) 
                     {
                            $('span.text-danger').text('');
                            response = xhr.responseJSON || JSON.parse(xhr.responseText);
                            console.log('errors',response);
                            if (xhr.status === 422 && response && response.errors) 
                            {
                                $.each(response.errors, function(field, messages) {
                                    $('.error-' + field).text(messages[0]);
                                });
                            } 
                            else 
                            {
                                swal_error_popup(response?.message || 'Something went wrong');
                            } 
                     }
                     else {
                     swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                     }
               }
         });
    });

    document.querySelectorAll('.toggle-password').forEach(function(el) 
    {
        el.addEventListener('click', function() {
            var input = document.querySelector(this.getAttribute('toggle'));
            var icon = this.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });


    $('#password').on('keyup', function () 
    {

        let password = $(this).val();

        
        if (password.length === 0) {
        $('#password-strength-wrapper').addClass('d-none');
        return;
        }

        $('#password-strength-wrapper').removeClass('d-none');

        let strength = 0;

    
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (password.length >= 16) strength++;

        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;

    
        if ((password.match(/[^a-zA-Z0-9]/g) || []).length >= 2) {
        strength++;
        }

    
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/.test(password)) {
        strength++;
        }

        let width = 0;
        let text = '';
        let color = '';

        if (strength <= 2) {
        width = 20;
        text = 'Very Weak';
        color = 'bg-danger';

        } else if (strength <= 4) {
        width = 40;
        text = 'Weak';
        color = 'bg-warning';

        } else if (strength <= 6) {
        width = 60;
        text = 'Medium';
        color = 'bg-info';

        } else if (strength <= 8) {
        width = 80;
        text = 'Strong';
        color = 'bg-primary';

        } else {
        width = 100;
        text = 'Very Strong';
        color = 'bg-success';
        }

        $('#password-strength-bar')
        .removeClass('bg-danger bg-warning bg-info bg-primary bg-success')
        .addClass(color)
        .css('width', width + '%');

        $('#password-strength-text').text(text);
    });

    ////// Edit Center ////////////////////
    $(document).on('click', '.edit-center-btn', function () 
    {
        let row = $(this).data('row');
        $('#add_center .modal-title').html(`<img src="/assets/dashboard/img/add-center.png" class="custompopicon" alt="">Edit Centre`);
        console.log(row);

        $('.modal-title').html('Add Centre');
        $('#center_id').val(row.id);
        $('#member_id').val(row.member_id);
        $('#name').val(row.name);
        $('#entity_name').val(row.entity_name);
        $('#contact_person').val(row.contact_person);
        $('#email').val(row.email);
        $('#business_address').val(row.business_address);
        $('#business_number').val(row.business_number.replace(/\s+/g, '')); 
        $('#phone').val(row.phone.replace(/\s+/g, ''));  
        $('#join_date').val(formatDateDMY(row.created_at));
        $('input[name="accessGranted"][value="' + (row.is_access_granted == '1' ? 'yes' : 'no') + '"]').prop('checked', true);


        $('input[name="contact_type[]"]').prop('checked', false);
        if (row.contact_type && row.contact_type.length > 0) {
            $.each(row.contact_type, function(index, value) {
                $('input[name="contact_type[]"][value="' + value + '"]').prop('checked', true);
            });
        }

        $('#submit_button').html('update')
        $('#add_center .modal-title').html(`<img src="/assets/dashboard/img/add-center.png" class="custompopicon" alt="">Edit Centre`);
        $('#add_center').modal({backdrop: 'static',keyboard: false});
        $('#add_center').modal('show');
    });

    $(document).on('click', '.view-center-btn', function () {
        let row = $(this).data('row');
        $('#v_member_id').text(row.member_id ?? '');
        $('#v_access_granted').text(row.access_granted ?? '');
        $('#v_join_date').text(row.join_date ?? '');
        $('#v_name').text(row.name ?? '');
        $('#v_entity_name').text(row.entity_name ?? '');
        $('#v_business_address').text(row.business_address ?? '');
        $('#v_contact_person').text(row.contact_person ?? '');
        $('#v_email').text(row.email ?? '');
        $('#v_business_number').text(row.business_number ?? '');
        $('#v_phone').text(row.phone ?? '');
        $('#v_method_of_contact').text(row.method_of_contact ?? '');
        $('#view_center').modal('show');
    });


    $(document).on('click', '#open_add_center', function () {

        $('#add_center_frm')[0].reset();
        $('#submit_button').html('Add')
        $('#add_center .modal-title').html(`<img src="/assets/dashboard/img/add-center.png" class="custompopicon" alt="">Add Centre`);
        $('#add_center').modal({backdrop: 'static',keyboard: false});
        $('#add_center').modal('show');
    });



    $(document).on('click', '.active-account-btn', async function(e) {
        if (await isConfirm({
                'action': 'make',
                'text': 'Activate This Account.'
            })) {

           
            ajaxRequest({
                url: "{{ route('center.action-account') }}",
                method: 'POST',
                data: {
                    id: $(this).data('row-id'),
                    request_type: 'activate-account'
                },
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        swal_success_popup(response.message);
                        table.ajax.reload(null, false);
                    } else {
                        swal_error_popup(response.message);
                    }
                },
                error: function(xhr) {
                    swal_error_popup('Error occured whiile making request');
                }
            });

        }
    })

    $(document).on('click', '.account-grant-access', async function(e) {
        if (await isConfirm({
                'action': 'make',
                'text': 'Grant Access to This Account.'
            })) {
            swal_waiting_popup({'title':'Granting Permission'});      
            ajaxRequest({
                url: "{{ route('center.action-account') }}",
                method: 'POST',
                data: {
                    id: $(this).data('row-id'),
                    request_type: 'access-grant'
                },
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        swal_success_popup(response.message);
                        table.ajax.reload(null, false);
                    } else {
                        swal_error_popup(response.message);
                    }
                },
                error: function(xhr) {
                    swal_error_popup('Error occured whiile making request');
                }
            });

        }
    })

    $(document).on('click', '.account-suspend-btn', async function(e) {
        if (await isConfirm({
                'action': 'Suspend',
                'text': ' Suspend This Account.'
            })) {
            ajaxRequest({
                url: "{{ route('center.action-account') }}",
                method: 'POST',
                data: {
                    id: $(this).data('row-id'),
                    request_type: 'suspend'
                },
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        swal_success_popup(response.message);
                        table.ajax.reload(null, false);
                    } else {
                        swal_error_popup(response.message);
                    }
                },
                error: function(xhr) {
                    swal_error_popup('Error occured whiile making request');
                }
            });

        }
    })

    $(document).on('click', '.login_center', async function(e) {
        if (await isConfirm({'action': ' Login ', 'text': 'you want to access this account?'})) {

            swal_waiting_popup({'title':'Redirecting...'});    
           let account_id =  $(this).data('row-id');
            setTimeout(function () {
            window.location.href = "{{ route('center.switch-to-child', ':id') }}".replace(':id', account_id);
            }, 2000);

        }
    });
    
    function formatDateDMY(dateString) 
    {
        let date = new Date(dateString);
        let day = String(date.getDate()).padStart(2, '0');
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let year = date.getFullYear();
        return day + '-' + month + '-' + year;
    }


</script>
@endpush

@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
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
                                                                    aria-describedby="emailHelp">{{Carbon\Carbon::parse($escort->created_at)->format('d/m/Y')}}</label>
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
                                                                    name="" aria-describedby="emailHelp"
                                                                    value="{{ $escort->business_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email" class="my-agent">Our Address </label>
                                                                <input type="text" class="form-control" placeholder=" "
                                                                    name="" aria-describedby="emailHelp"
                                                                    value=" {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : ''}}">
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
                                                                <label type="text" class="form-control form-back"
                                                                    placeholder=" " name="phone"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->business_number }}">{{ $escort->business_number }}</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Mobile No.</label>
                                                                <label type="text" class="form-control form-back"
                                                                    placeholder=" " name="phone"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->phone }}">{{ $escort->phone }}</label>
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
                                                                <label for="email">My Agent</label>
                                                                <label type="text" class="form-control form-back"
                                                                    placeholder=" " name="phone"
                                                                    aria-describedby="emailHelp"
                                                                    value="{{ $escort->my_agent ? $escort->my_agent->member_id : 'NA' }}">


                                                                    @if (auth()->user()->my_agent)
                                                                        {{ auth()->user()->my_agent->member_id }}
                                                                    @else
                                                                        <a
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
                                                                    name="payID_name"
                                                                    placeholder="Insert your Bank Account name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="PayID Number">PayID Number</label>
                                                                <input type="text" class="form-control" name="paID_no"
                                                                    placeholder="Insert your PayID Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" value="save"
                                                class="btn btn-primary shadow-none float-right" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
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
                                            <button type="button" class="btn-common" data-toggle="modal"
                                                data-target="#add_center">Add Centre</button>
                                        </div>
                                        <div class="table-responsive-xl">
                                            <table class="table mb-3" id="add_centre_table">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th colspan="1" style="width: 75px;">Member ID</th>
                                                        <th colspan="2">Display Name</th>
                                                        <th colspan="2">Entity Name</th>
                                                        <th colspan="2">Address</th>
                                                        <th colspan="2">Business No.</th>
                                                        <th colspan="2">Mobile No.</th>
                                                        <th colspan="1">Email</th>
                                                        <th colspan="1" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-content">
                                                    <tr>
                                                        <td colspan="1">01</td>
                                                        <td colspan="2"><span class="grant-access">Marianne Smith
                                                                <sup>Accessed</sup></span></td>
                                                        <td colspan="2">infocomnet Pvt Ltd</td>
                                                        <td colspan="2">456 Elm Road, Perth, WA 6000 </td>
                                                        <td colspan="2">0438 028 728</td>
                                                        <td colspan="2">0438 028 728</td>
                                                        <td colspan="1">info@center.au.com</td>
                                                        <td colspan="1" class="text-center">
                                                            <div class="dropdown no-arrow">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink"
                                                                    x-placement="bottom-end">

                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-target="#edit_center"
                                                                        data-toggle="modal"> <i class="fa fa-pen"></i>
                                                                        Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#"> <i class="fa fa-check-circle"></i>
                                                                        Grant Access</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#"> <i class="fa fa-times-circle"></i>
                                                                        Suspend</a>

                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#view_center"> <i
                                                                            class="fa fa-eye "></i> View</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="1">02</td>
                                                        <td colspan="2"><span class="grant-access">Well Chalse</span>
                                                        </td>
                                                        <td colspan="2">DEF Pvt Ltd</td>
                                                        <td colspan="2">Green Street, Manning</td>
                                                        <td colspan="2">0438 028 728</td>
                                                        <td colspan="2">0438 028 728</td>
                                                        <td colspan="1">info@center.au.com</td>
                                                        <td colspan="1" class="text-center">
                                                            <div class="dropdown no-arrow">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink"
                                                                    x-placement="bottom-end">

                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-target="#edit_center"
                                                                        data-toggle="modal"> <i class="fa fa-pen"></i>
                                                                        Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#"> <i class="fa fa-check-circle"></i>
                                                                        Grant Access</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#"> <i class="fa fa-times-circle"></i>
                                                                        Suspend</a>

                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#view_center"> <i
                                                                            class="fa fa-eye "></i> View</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                                type="checkbox" id="Method_Message" value="1"
                                                                checked="">
                                                            <label class="form-check-label" for="Method_Message">Include
                                                                Profile Information</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="profile_creator[]" class="form-check-input"
                                                                type="checkbox" id="Method_Text" value="2">
                                                            <label class="form-check-label" for="Method_Text">Include
                                                                Profile Information and allow to over ride</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="profile_creator[]" class="form-check-input"
                                                                type="checkbox" id="Method_Email" value="3"
                                                                checked="">
                                                            <label class="form-check-label" for="Method_Email">Include
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
                                                                type="checkbox" id="Method_Message" value="1"
                                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(1, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Method_Message">Call
                                                                us</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="viewer_contact_type[]"
                                                                type="checkbox" id="Method_Email" value="3">
                                                            <label class="form-check-label" for="Method_Email">Email us
                                                                (only for private communications with a Viewer)</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input name="viewer_contact_type[]" class="form-check-input"
                                                                type="checkbox" id="Method_Text" value="2"
                                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(2, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Method_Text">Text
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/add-center.png') }}"
                            class="custompopicon" alt=" Add Centre"> Add Centre</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <form>
                        <div class="row">
                            <!-- Membership ID -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Membership ID</label>
                                    <input type="text" class="form-control" placeholder="Auto-generated when saved"
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
                                                id="accessYes" value="yes" checked>
                                            <label class="form-check-label" for="accessYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="accessGranted"
                                                id="accessNo" value="no">
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
                                    <input type="text" placeholder="mm/dd/ayyyy" class="form-control"
                                        onfocus="this.type='date'; this.placeholder='';">
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

                                    <input type="text" class="form-control" placeholder="Enter display name...">
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
                                    <input type="text" class="form-control" placeholder="Enter entity name...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Address -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="1" placeholder="Enter address..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <!-- Point of Contact -->
                                <div class="form-group">
                                    <label>Point of Contact</label>
                                    <input type="text" class="form-control" placeholder="Enter point of contact...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Enter email address...">
                                </div>
                            </div>

                        </div>
                        <div class="row">


                            <div class="col-lg-6">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Business No.</label>
                                    <input type="text" class="form-control" placeholder="Enter business number...">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Mobile No. -->
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="tel" class="form-control" placeholder="Enter mobile number...">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Method of contact:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" checked type="checkbox" name="contact_type[]"
                                            id="Method_Message" value="1">
                                        <label class="form-check-label" for="Method_Message">Message (via Console)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_Text" value="2">
                                        <label class="form-check-label" for="Method_Text">Text</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_Email" value="3">
                                        <label class="form-check-label" for="Method_Email">Email</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_call_me" value="4">
                                        <label class="form-check-label" for="Method_call_me">Call me</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <!-- Submit -->
                                <button type="submit" class="btn-success-modal">Save</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end  --}}

    {{-- Modal: Edit Centre --}}
    <div class="modal fade upload-modal" id="edit_center" tabindex="-1" aria-labelledby="edit_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="Edit Centre">
                        Edit Centre
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <form>
                        <div class="row">
                            <!-- Membership ID -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Membership ID</label>
                                    <input type="text" class="form-control" value="MC101" readonly>
                                </div>
                            </div>

                            <!-- Access Granted -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Access Granted</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="accessGranted"
                                                id="accessYes" value="yes" checked>
                                            <label class="form-check-label" for="accessYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="accessGranted"
                                                id="accessNo" value="no">
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
                                    <input type="text" value="30-06-2025" placeholder="DD-MM-YYYY"
                                        class="form-control" onfocus="this.type='date'; this.placeholder='';">
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

                                    <input type="text" class="form-control" value="Abc Wellness Centre">
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
                                    <input type="text" class="form-control" value="Abc Pvt Ltd">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Address -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="1">123 Main Street, Mumbai</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Point of Contact -->
                                <div class="form-group">
                                    <label>Point of Contact</label>
                                    <input type="text" class="form-control" value="Rahul Sharma">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="contact@abcwellness.com">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Business No.</label>
                                    <input type="text" class="form-control" value="BN-556677">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Mobile No. -->
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="tel" class="form-control" value="+91 9876543210">
                                </div>
                            </div>
                        </div>

                        <!-- Method of Contact -->
                        <div class="form-group">
                            <label>Method of contact:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Method_Message" value="1"
                                    checked>
                                <label class="form-check-label" for="Method_Message">Message (via Console)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Method_Text" value="2" checked>
                                <label class="form-check-label" for="Method_Text">Text</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Method_Email" value="3">
                                <label class="form-check-label" for="Method_Email">Email</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Method_call_me" value="4">
                                <label class="form-check-label" for="Method_call_me">Call me</label>
                            </div>
                        </div>

                        <!-- Footer Buttons -->
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn-success-modal ml-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal: View Centre --}}
    <div class="modal fade upload-modal" id="view_center" tabindex="-1" aria-labelledby="view_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="View Centre">
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
                                <td>MC101</td>
                            </tr>
                            <tr>
                                <th>Access Granted</th>
                                <td>Yes</td>
                            </tr>

                            <tr>
                                <th>Date Joined</th>
                                <td>30-06-2025</td>
                            </tr>
                            <tr>
                                <th>Display Name</th>
                                <td>Example Business</td>
                            </tr>
                            <tr>
                                <th>Entity Name</th>
                                <td>ABC Pvt Ltd</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>123 Business Street</td>
                            </tr>
                            <tr>
                                <th>Point of Contact</th>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>example@mail.com</td>
                            </tr>
                            <tr>
                                <th>Business No.</th>
                                <td>987654321</td>
                            </tr>
                            <tr>
                                <th>Mobile No.</th>
                                <td>+91 9876543210</td>
                            </tr>
                            <tr>
                                <th>Method of Contact</th>
                                <td>Message, Email</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        $(document).ready(function() {
            var table = $("#add_centre_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Member ID"
                },
                processing: false,
                serverSide: false,
                paging: true,
                lengthChange: true,
                searching: true,
                bStateSave: true,
                sorting: false,
                ordering: false,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10
            });
        });
    </script>
    <script type="text/javascript">
        $('#userProfile').parsley({

        });

        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            $("#modal-title").text("Abou Us");
            $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
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
                            var msg = "Saved";
                            $('.comman_msg').html(msg);
                            $("#comman_modal").modal('show');
                            //$("#my_account_modal").show();

                            //
                        } else {
                            $('.Lname').html("Oops.. sumthing wrong Please try again");
                            var msg = "Oops.. sumthing wrong Please try again";
                            $('.comman_msg').html(msg);
                            $("#comman_modal").modal('show');

                        }
                    },

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
                    if (!data.error) {
                        $('.comman_msg').html("Saved");
                        //$("#my_account_modal").modal('show');
                        //$("#my_account_modal").show();
                        $("#comman_modal").modal('show');

                    } else {
                        $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                        $("#comman_modal").show();

                    }
                },

            });

        });
    </script>
@endpush

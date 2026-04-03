@extends('layouts.admin')
@section('style')
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->

        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Abbreviations</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                            <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                            <ol></ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <div id="accordion" class="myacording-design">
                        <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                            About me
                            </a>
                        </div>
                        <div id="about_me" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                            
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
                                            <h5 class="d_sub_heading">General information</h5>
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
                                            <h5 class="d_sub_heading">Home State</h5>
                                            <p>If you want to change your Home State, contact the Escorts4U help centre by raising a <a href="{{ url('submit_ticket') }}" style="font-size: 16px;"><span class="custom_links_design">Support Ticket.</span></a> You can not change your Home State, only Escorts4U support staff can change your Home State. You will have to provide proof that you have relocated to a new Home State.</p>
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
                            <div class="card-body d_sub_heading">
                                
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
            </div> --}}
        </div>
    </div>
@endsection

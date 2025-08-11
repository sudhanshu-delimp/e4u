@extends('layouts.escort')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0);
    }
    .playbox-icon {
        display: block;
        margin: 30px auto;
    }
</style>
@endsection

@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="col-md-12 p-0">
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">My Playbox</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>

            <!-- Help Notes Accordion -->
            <div class="col-md-12 mb-4">
                <div class="collapse" id="notes">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol class="pl-4">
                                <li>This is a social feature to help Escorts connect with Viewers.</li>
                                <li>Once launched, Playbox will be visible on your profile if content is uploaded.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Playbox Content -->
            <div class="col-md-10 fill_profile_headings_global text-justify">
                <p><strong>Coming soon!</strong></p>

                <h2>What is this all about?</h2>
                <p>
                    My Playbox is an exciting new service designed for Escorts and Viewers to interact and to get to know each other better.
                    It is a social platform within the E4U Website that revolutionises how Escorts and Viewers connect.
                    All Escorts who are registered with us can use the service. It allows them to monetize their content while developing a genuine connection with the Viewer.
                </p>

                <h2>How does it work?</h2>
                <p>
                    If an Escort has uploaded content to their Playbox, the My Playbox icon will appear on any Profile they publish.
                    The Viewer simply clicks the icon which will take them to the Escort's Playbox page.
                    This is particularly helpful for Viewers to get to see an Escort who they are considering meeting with.
                </p>

                <!-- Centered Playbox Icon -->
                <img src="{{ asset('assets/dashboard/img/menu-icon/play-100.png') }}" alt="Playbox Icon" class="playbox-icon">
                <!-- Replace the image path above with the actual path -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush

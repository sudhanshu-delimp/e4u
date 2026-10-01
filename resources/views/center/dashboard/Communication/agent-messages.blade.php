@extends('layouts.center')
@section('style')
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/chat.css') }}">
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Messages</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                       <h3 class="NotesHeader"><b>Notes:</b></h3>
                      
                        <ol>
                            <li>Use Messages for all of your communications between other Users. Any Viewer you have
                                blocked, or have blocked you, will not appear in your list.</li>
                            <li>Select the User you wish to message, including reply, from the list. If you have appointed
                                an Agent, then they will always appear at the top of the list.</li>
                            <li>You will receive a notification, which will appear in the Alert Centre, when you have
                                received a Message. An indicator will also appear on the User’s Avatar.</li>
                            <li>Please note that all messaging is saved.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <x-chat/>

    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('assets/dashboard/js/chat.js') }}"></script>  
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
@endsection

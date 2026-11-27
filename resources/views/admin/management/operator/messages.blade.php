@extends('layouts.operator')
@section('style')
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/chat.css') }}">
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-4 pr-3 pr-lg-4">
        <!-- Page Heading -->
        <div class="row">
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Messages</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                       <h3 class="NotesHeader"><b>Notes:</b></h3>                        
                        <ol>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>  

        <x-chat/>
    </div>
   @endsection
   @push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/dashboard/js/chat.js') }}"></script> 
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
    
   @endpush

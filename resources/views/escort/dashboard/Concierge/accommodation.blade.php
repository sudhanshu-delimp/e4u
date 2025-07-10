
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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
             {{-- Page Heading   --}}
            <div class="row">
                <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                    <h1 class="h1">Accommodation</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12 my-2">
                    <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol></ol>
                    </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            <div class="row">
               <div class="col-md-12">
                        <div class="pt-2">
                        <h3 class="pb-2 pt-2">Partnership</h3>
                        Escorts4U has partnered with a leading online accommodation booking provider <b>(Partner)</b> to provide
                        practical and convenient advice and assistance for all of your accommodation needs and requirements
                        throughout Australia.
                        </div>
                        <div class="pt-2">
                        <h3 class="pb-2 pt-2">Launch of the Accommodation service</h3>
                        Escorts4U will be launching its Accommodation service in version 2.0 of the Website.  The service will enable you to:
                        <ul>
                            <li>book online accommodation throughout Australia (live)</li>
                            <li>qualify for 'preferred status' to receive discounted pricing</li>
                        </ul>
                        We will let you know as soon as the service is launched.
                    </div>
                    <div class="mt-5">
                        <b>Changes to this Guide</b><br>
                        <p>This Guide was last updated on 17-08-2024.</p>
                    </div>
                </div>
            </div>            
               <!--middle content end here-->
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

@endpush

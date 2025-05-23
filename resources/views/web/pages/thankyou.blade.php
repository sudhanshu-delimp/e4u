@extends('layouts.web')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<style>
   .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
    .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    }
    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>
@endsection
@section('content')
<section class="padding_top_eight_px padding_bottom_eight_px">
    <div class="container text-center">
        <div class="col-md-8 mx-auto">
        <h1 class="home_heading_first margin_btm_twenty_px">Thank You</h1>
            <p>Thank you for your feedback. We are constantly trying to improve our services, so your input
            is valuable to us. We will look closely at what you have said and see how we can improve
            things, and where it is necessary, we will get back to you.</p>
            <h3>E4U - Management</h3>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush
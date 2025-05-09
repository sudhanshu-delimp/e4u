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
        <h1>Checkout</h1>
        <form id="" action="{{ route('mobile-order-sim-payment') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div>
                @include('escort.dashboard.profile.partials.mobile-sim',['data'=>$data])
            </div>
        </form>
    </div>
@endsection
@push('script')
    <script type="text/javascript"></script>
@endpush

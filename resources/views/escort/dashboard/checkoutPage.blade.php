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
        <h1>Checkout</h1>
        <form id="my_escort_profile" action="{{ route('escort.poli.paymentUrl')}}" method="post" enctype="multipart/form-data">
            @csrf
{{--            <input type="hidden" name="user_startDate" id="user_startDate" value="{{ date('Y-m-d',strtotime(auth()->user()->created_at)) }}">--}}
            <div>
                @include('escort.dashboard.profile.partials.pricing-dash-tab2')
            </div>
        </form>
    </div>

@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript">

    </script>
@endpush


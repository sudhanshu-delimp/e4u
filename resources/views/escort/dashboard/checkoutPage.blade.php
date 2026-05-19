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
       <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Checkout</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            
        <div class="col-md-12 mb-4" id="profile_and_tour_options">
            <div class="collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                      <h3 class="NotesHeader"><b>Notes:</b> </h3>
                      <ol>
                          <li>Please note we use 2FA verification process to enable you to make payment.</li>
                          <li>Your verification code will be sent to your nominated preference.</li>
                          <li>Please check the purchase summary before you authorise payment.</li>
                      </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- 3 step bar --}}
        <div class="col-lg-12">
            <div class="progressbar">
                <div class="step active">
                    <div class="circle">✔</div>
                    <p class="step-title">1. Listings</p>
                </div>
                <div class="step active">
                    <div class="circle">✔</div>
                    <p class="step-title">2. Payment</p>
                </div>
                <div class="step">
                    <div class="circle"></div>
                    <p class="step-title">3. Completion</p>
                </div>
            </div>
            {{-- <div class="buttons">
                <button id="prev" disabled>Previous</button>
                <button id="next">Next</button>
            </div> --}}
        </div>
       </div>
       
        @switch($checkout_type)
            @case('upgrade')
                <form id="my_escort_profile" action="{{ route('escort.upgrade_list')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        @include('escort.dashboard.profile.partials.upgrade-checkout-form')
                    </div>
                </form>
                @break

            @default
            <form id="my_escort_profile" action="{{ route('escort.poli.paymentUrl')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    @include('escort.dashboard.profile.partials.pricing-dash-tab2')
                </div>
            </form>
        @endswitch
    </div>
    @include('escort.dashboard.modal.payment_form')
    @include('modal.two-step-verification',['action'=>true,'inPaymentMode'=>true])
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript">

    </script>
@endpush


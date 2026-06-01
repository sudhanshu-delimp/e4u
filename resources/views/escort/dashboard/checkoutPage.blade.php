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

    #sendOtp_modal .modal-dialog {
        max-width: 600px;
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

    </div>

    <!-- Progress Bar -->
    <div class="row">
        <div class="col-lg-12">
            <div class="custom_progress_wrapper">
                <div class="custom_pro_container">
                    <div class="progress_line" id="custom_progress" style="width: 50%"></div>

                    <div class="custom_step">
                        <div class="circle active">✓</div>
                        <div class="label active">Listings</div>
                    </div>

                    <div class="custom_step">
                        <div class="circle active current">2</div>
                        <div class="label active">Payment</div>
                    </div>

                    <div class="custom_step">
                        <div class="circle">3</div>
                        <div class="label">Completion</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

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

<script src="{{ asset('js/escort/progress_bar.js') }}"></script>
@endpush
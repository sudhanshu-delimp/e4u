@extends('layouts.escort')
@section('style')
<style>
    
        /* Card */
        
        .thank-you-card {
            border-radius: 20px;
            padding: 40px 20px;
            text-align: center;
        }
        /* Image */
        
        .thank-you-card img {
            width: 120px;
            margin-bottom: 20px;
        }
        /* Title */
        
        .thank-you-card h2 {
            margin: 10px 0;
            font-size: 24px;
        }
        /* Text */
        
        .thank-you-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }
        /* Buttons */
        
        .btn {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #0C223D;
            color: #fff;
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #0C223D;
            color: #0C223D;
        }

            .btn-primary:hover{
                background-color: #ff3c5f;
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
                    <div class="step active">
                        <div class="circle">✔</div>
                        <p class="step-title">3. Completion</p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="thank-you-card">
                    <!-- Replace with your image -->
                    <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="order">

                    <h2>Thank You for Your Order!</h2>
                    <p>Your Purchase is Confirmed! Get Ready for an Amazing Experience.</p>

                    <button class="btn btn-primary" id="continueBtn">Continue Shopping</button>

                </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script type="text/javascript"></script>
    @endpush

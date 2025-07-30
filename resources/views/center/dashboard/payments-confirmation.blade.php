@extends('layouts.center')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
       <div class="row">
            {{-- <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Payments Confirmation</h1>
            </div> --}}
            {{-- 3 step bar --}}
            <div class="col-lg-12">
                <div class="progressbar">
                    <div class="step active">
                        <div class="circle">✔</div>
                        <p class="step-title">1. Listings</p>
                    </div>
                    <div class="step">
                        <div class="circle"></div>
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
            <div class="col-lg-12">
                <table align="center" width="600" cellpadding="0" cellspacing="0" style="background:#fff; border-radius:5px; overflow:hidden;">

                    <!-- Header with Buttons -->
                    <tr style="background:#0C223D;">
                        <!-- Title -->
                        <td style="padding:15px; color:#fff; font-size:18px; font-weight:bold; width:70%; vertical-align:middle;">
                            <img src="{{ asset('assets/dashboard/img/shopping-bag.png') }}" alt="Print" style="width:40px; height:40px; vertical-align:middle;"> Order Confirmation
                        </td>
            
                        <!-- Icons -->
                        <td style="padding:15px; text-align:right; vertical-align:middle;">
                            <span style="display:flex; gap:10px; justify-content:flex-end; align-items:center;">
                                <!-- Print Icon -->
                                <a href="#" onclick="window.print();" style="display:inline-block;
                                background: #fffbfb;
                                padding: 5px;
                                border-radius: 100%;">
                                    <img src="{{ asset('assets/dashboard/img/printer.png') }}" alt="Print" style="width:22px; height:22px; vertical-align:middle;">
                                </a>
            
                                <!-- Email Icon -->
                                <a href="#" style="display:inline-block;
                                background: #fffbfb;
                                padding: 5px;
                                border-radius: 100%;">
                                    <img src="{{ asset('assets/dashboard/img/send.png') }}" alt="Email" style="width:22px; height:22px; vertical-align:middle;">
                                </a>
                            </span>
                        </td>
                    </tr>
            
                    <!-- Greeting -->
                    <tr>
                        <td colspan="2" style="padding:20px; font-size:16px; color:#333;border-top:0px; border-bottom:0px;">
                            <p>Hi <strong>John Doe</strong>,</p>
                            <p>Thank you for your order! Below are your transaction details.</p>
                        </td>
                    </tr>
            
                    <!-- Order Details Table -->
                    <tr>
                        <td colspan="2" style="padding:0 20px 20px;border-top:0px; border-bottom:0px;">
                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; font-size:14px; border:1px solid #ddd;">
                                <tr style="background:#f1f1f1; color:#0C223D; font-weight:bold;">
                                    <td style="border:1px solid #ddd;">Item</td>
                                    <td style="border:1px solid #ddd;">Qty</td>
                                    <td style="border:1px solid #ddd;">Price</td>
                                    <td style="border:1px solid #ddd;">Total</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #ddd;">Escort Membership - Gold</td>
                                    <td style="border:1px solid #ddd;">1</td>
                                    <td style="border:1px solid #ddd;">$150</td>
                                    <td style="border:1px solid #ddd;">$150</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #ddd;">Escort Profile Listing</td>
                                    <td style="border:1px solid #ddd;">1</td>
                                    <td style="border:1px solid #ddd;">$50</td>
                                    <td style="border:1px solid #ddd;">$50</td>
                                </tr>
                                <tr style="background:#f1f1f1; font-weight:bold;">
                                    <td colspan="3" style="text-align:right; border:1px solid #ddd;">Grand Total:</td>
                                    <td style="border:1px solid #ddd;">$200</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                    <!-- Payment Details -->
                    <tr>
                        <td colspan="2" style="padding:20px; font-size:14px; color:#333; line-height:1.8; border-top:0px; border-bottom:0px;">
                            <strong>Payment Method:</strong> Credit Card<br>
                            <strong>Transaction ID:</strong> TXN123456789<br>
                            <strong>Date:</strong> 28 July 2025
                        </td>
                    </tr>
            
                    <!-- Footer -->
                    <tr>
                        <td colspan="2" style="text-align:center; font-size:12px; color:#777; padding:15px; border-top:0px;">
                            © 2025 Escort Booking System. All rights reserved.
                        </td>
                    </tr>
                </table>
            </div>
       </div>
       
    </div>

@endsection


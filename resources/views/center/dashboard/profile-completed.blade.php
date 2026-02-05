@extends('layouts.center')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
       <div class="row">
            
            <div class="col-lg-6 offset-lg-3 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
                <div class="card text-center shadow-sm">
                    <div class="card-body pb-4">
                        <h1 class="card-title font-weight-bold">Profile Completed</h1>
                        <p class="card-text">Your profile has been completed successfully. You can now access all the features of your account. Thank you for providing the necessary information.</p>
                        <a href="{{ route('center.dashboard') }}" class="btn-success-modal text-white">Go to Dashboard</a> 
                    </div>
                </div>
            </div>
       </div>
       
    </div>

@endsection


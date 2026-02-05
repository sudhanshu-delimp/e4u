@extends('layouts.center')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
       <div class="row">
            
            <div class="col-lg-6 offset-lg-3 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
                <div class="card text-center shadow-sm">
                    <div class="card-body pb-4">
                        <h1 class="card-title font-weight-bold">Profile Already Created</h1>
                        <p class="card-text mb-4">Your profile has already been created. Please go to Our Profile to view the details.</p>
                        <a href="{{ route('center.list') }}" class="btn-success-modal text-white mb-4">Go to Our Profile</a> 
                    </div>
                </div>
            </div>
       </div>
       
    </div>

@endsection


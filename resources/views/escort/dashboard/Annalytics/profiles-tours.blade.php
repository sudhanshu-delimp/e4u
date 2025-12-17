
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
            <h1 class="h1">Profiles & Tours</h1>
            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol></ol>
            </div>
            </div>
        </div>
    </div>
    
     <div class="col-lg-12 card-wrapper">                
        <div class="row p-4 rounded" style="background-color: #c2cfe052;">                  
            <div class="col-lg-12">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">Profile Statistics
                </h4>
            </div>
           <div class="col-lg-12 card-list-wrapper">
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Profile Views Today
                        </div>
                        <div class="statistics-value">125</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/view-profile.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Profile Views This Week
                        </div>
                        <div class="statistics-value">35</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/view-profile-time.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label"> Year to Date
                        </div>
                        <div class="statistics-value">125</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                    </div>
                </div>
           </div>
            <div class="col-lg-12 card-list-wrapper">    
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Playbox Views Today
                        </div>
                        <div class="statistics-value">125</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/likes.png') }}" alt="icon">
                    </div>
                </div>
             
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Playbox Views This Week
                        </div>
                        <div class="statistics-value">35</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/likes.png') }}" alt="icon">
                    </div>
                </div>
            
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label"> Year to Date
                        </div>
                        <div class="statistics-value">125</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                    </div>
                </div>
           </div>
        </div> 
    </div>
    {{-- end --}}
    {{-- fourth row --}}
    <div class="col-lg-12 card-wrapper">                
        <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
            <div class="col-lg-12">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">Media Statistics
                </h4>
            </div>
            <div class="col-lg-12 card-list-wrapper">
                <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Media Views Today
                        </div>
                        <div class="statistics-value">125</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                    </div>
                </div>
        
                <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Media Views This Weeks
                        </div>
                        <div class="statistics-value">35</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                    </div>
                </div>
                <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label">Year to Date
                        </div>
                        <div class="statistics-value">125</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

@endpush

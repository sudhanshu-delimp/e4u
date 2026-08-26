
@extends('layouts.escort')
@section('style')
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    {{--middle content start here--}}
        {{-- Page Heading   --}}
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Feedback</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol></ol>
                </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        {{-- start content --}}
       
        
      {{-- fourth row --}}
        <div class="row">
            <div class="col-lg-12">                
                <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                    
                    <div class="col-lg-12 card-list-wrapper"> 
                        <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                            <div class="statistics-text">
                                <div class="statistics-label">Reviews Today
                                </div>
                                <div class="statistics-value">125</div>
                            </div>
                            <div class="statistics-icon">
                                <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                            </div>
                        </div>
                    
                        <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                            <div class="statistics-text">
                                <div class="statistics-label">Reviews This Week
                                </div>
                                <div class="statistics-value">35</div>
                            </div>
                            <div class="statistics-icon">
                                <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                            </div>
                        </div>
                    
                        <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
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
                        <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                            <div class="statistics-text">
                                <div class="statistics-label">Recommendations Today
                                </div>
                                <div class="statistics-value">125</div>
                            </div>
                            <div class="statistics-icon">
                                <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                            </div>
                        </div>
                    
                        <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                            <div class="statistics-text">
                                <div class="statistics-label">Recommendations This Week
                                </div>
                                <div class="statistics-value">35</div>
                            </div>
                            <div class="statistics-icon">
                                <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                            </div>
                        </div>
                    
                        <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
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
                    <!-- Card End -->
                </div> 
            </div>
        </div>
      {{-- end --}}
</div>
    
@endsection
@push('script')
@endpush

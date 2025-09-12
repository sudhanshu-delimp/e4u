
@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<style type="text/css">
    #socialMediaTable td,th{
        vertical-align: middle;
    }

</style>
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
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
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
                    
                    <!-- Card Start -->
                    <div class="col-md-3 mb-3">
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
                    </div>
                    <!-- Card End --> 
                    
                    <!-- Card Start -->
                    <div class="col-md-3 mb-3">
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
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
                    <div class="col-md-3 mb-3">
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
                    {{-- blank card--}}
                    <div class="col-md-3">
                        
                    </div>
                    {{-- end --}}
                    
                    <!-- Card Start -->
                    <div class="col-md-3 mb-3">
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
                    </div>
                    <!-- Card End --> 
                    
                    <!-- Card Start -->
                    <div class="col-md-3 mb-3">
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
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
                    <div class="col-md-3 mb-3">
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

        {{-- end content --}}
    {{-- middle content end here --}}
</div>
    
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#socialMediaTable').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by ID or Profile Name...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true
       });
   });
 </script>
@endpush

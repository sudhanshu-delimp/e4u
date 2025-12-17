@extends('layouts.userDashboard')
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
      
    <!-- Page Heading -->

    <div class="row">
        <div class="col-md-12 custom-heading-wrapper justify-content-between">
           <div class="d-flex align-items-center">
            <h1 class="h1">My Statistics</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
           </div>
            
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
    </div>


  <div class="row">
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               
                <ol>
                      
                </ol>
            </div>
          </div>
      </div>
  </div>
  <!-- Page Heading -->
  
        
  <div class="col-lg-12 card-wrapper">                
    <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
        <div class="col-lg-12">
            <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics
            </h4>
        </div>
        <div class="col-lg-12 card-list-wrapper">
            <div class="statistics-card  shadow-sm">
                <div class="statistics-text">
                    <div class="statistics-label">My Legbox</div>
                    <div class="statistics-value">25</div>
                </div>
                <div class="statistics-icon">
                    <img src="{{ asset('assets/dashboard/img/my-legbox.png') }}" alt="icon">
                </div>
            </div>
        
            <div class="statistics-card  shadow-sm">
                <div class="statistics-text">
                    <div class="statistics-label">Notes
                    </div>
                    <div class="statistics-value">125</div>
                </div>
                <div class="statistics-icon">
                    <img src="{{ asset('assets/dashboard/img/notes.png') }}" alt="icon">
                </div>
            </div>
        
            <div class="statistics-card  shadow-sm">
                <div class="statistics-text">
                    <div class="statistics-label">Reviews Posted
                    </div>
                    <div class="statistics-value">32</div>
                </div>
                <div class="statistics-icon">
                    <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                </div>
            </div>
        
            <div class="statistics-card  shadow-sm">
                <div class="statistics-text">
                    <div class="statistics-label">E4U Reports
                    </div>
                    <div class="statistics-value">125</div>
                </div>
                <div class="statistics-icon">
                    <img src="{{ asset('assets/dashboard/img/e4u-report.png') }}" alt="icon">
                </div>
            </div>
        
          <div class="statistics-card  shadow-sm">
              <div class="statistics-text">
                  <div class="statistics-label">Punterbox Reports
                  </div>
                  <div class="statistics-value">125</div>
              </div>
              <div class="statistics-icon">
                  <img src="{{ asset('assets/dashboard/img/ponter-box-report.png') }}" alt="icon">
              </div>
          </div>
      </div>
      <!-- Card End -->
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
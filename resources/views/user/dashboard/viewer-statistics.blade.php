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
<div class="container-fluid pl-3 pl-lg-5">
    
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Dashboard - Viewer Statistics</h1>
        <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
    </div>
    <div class="back-to-dashboard">
        <a href="{{ url()->previous() ?? route('user-dashboard') }}">
            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12 my-2">
        <div class="card collapse" id="notes" style="">
           <div class="card-body">
              <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
              <p></p>
              <ol>
                    
              </ol>
           </div>
        </div>
    </div>
</div>
<!-- Page Heading -->
<div class="row mt-2">  
    <!-- Followers Online (Legbox) -->
    <div class="col-md-6 mb-4">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead style="background-color: #0C223D; color: #ffffff;">
            <tr><th colspan="3" class="text-center">Escorts Online (Legbox)</th></tr>
          </thead>
          <tbody>
            <tr>
              <td class="icon-col"><i class="fas fa-map-marker-alt"></i></td>
              <td>In my Location</td>
              <td class="text-center">15</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-globe"></i></td>
              <td>Outside my Location</td>
              <td class="text-center">15</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-wifi"></i>
              </td>
              <td class="text-right font-weight-bold">Online : </td>
              <td class="text-center font-weight-bold">30</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-kiss-wink-heart"></i>

              </td>
              <td class="font-weight-bold">Total Legbox</td>
              <td class="text-center font-weight-bold">30</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  
    <!-- Logs & Status -->
    <div class="col-md-6 mb-4">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead style="background-color: #0C223D; color: #ffffff;">
            <tr><th colspan="3" class="text-center">Logs & Status</th></tr>
          </thead>
          <tbody>
            <tr>
              <td class="icon-col"><i class="fas fa-sign-in-alt"></i></td>
              <td>Login count</td>
              <td class="text-center">526</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="far fa-clock"></i></td>
              <td>Last login</td>
              <td class="text-center">20-06-2025 | 12:32:02 PM</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-hourglass-half"></i>

              </td>
              <td>Session duration</td>
              <td class="text-center">1 hrs.</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-map"></i></td>
              <td>Home State</td>
              <td class="text-center">Western Australia
            </td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-key"></i></td>
              <td>Password expiry</td>
              <td class="text-center">Never</td>
            </tr>
          </tbody>
        </table>
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
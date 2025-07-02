@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .select2-container .select2-choice, .select2-result-label {
    font-size: 1.5em;
    height: 52px !important; 
    overflow: auto;
    }
    .select2-arrow, .select2-chosen {
    padding-top: 6px;
    }
    span.select2.select2-container.select2-container--default > span.selection > span {
    height: 52px !important; 
    }
    .list-sec .table td, .table th{
    border: 1px solid #0c233d;
    }
</style>
@endsection
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
    <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Communication - Advertiser Messaging</h1>
        <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
    </div>
 </div>

<div class="row">
    <div class="col-md-12 my-2">
        <div class="card collapse" id="notes" style="">
          <div class="card-body">
              <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
              <ol></ol>
          </div>
        </div>
    </div>
</div>
<!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <h3><b>Coming Soon...</b></h3>
            </div>
            <div class="col-md-12 mt-4">
                
            </div>
        </div>
    <!--middle content end here-->
</div>
        </div>
    </div>
</div>
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@endpush
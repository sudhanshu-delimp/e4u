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
    #mugsTable_filter {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3">Lookup</div>
      </div>
       <div class="col-md-7">
           <h3><b>Don't know their details? Look them up</b></h3>
           <div class="e4u-modal-open mt-2">
               Search for an offender
               <input type="text" id="search">
               <button>
                    <i class="fa fa-search" aria-hidden="true" id="search-button"></i>
               </button>
           </div>
       </div>
       <div class="col-md-12">
           <br>
           <div id="content-mugs" hidden>
               <div class="box-body table table-hover">
                   {{--<table class="table table-hover" id="mugsTable">
                       <thead id="table-sec" class="table-bg">
                       <tr>
                           <th>No</th>
                           <th>User</th>
                           <th>Date</th>
                           <th>Place</th>
                           <th>Email</th>
                           <th>Name</th>
                           <th>Mobile</th>
                           <th>Details</th>
--}}{{--                                   <th>Action</th>--}}{{--
                       </tr>
                       </thead>
                   </table>--}}
                   <table class="table table-hover" id="mugsTable" style="width: 100%;">
                       <thead id="table-sec" class="table-bg">
                       <tr>
                           <th>No</th>
                           <th>User</th>
                           <th>Date</th>
                           <th>Place</th>
                           <th>Email</th>
                           <th>Name</th>
                           <th>Mobile</th>
                           <th>Details</th>
                       </tr>
                       </thead>
                   </table>
               </div>
           </div>
       </div>
   </div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    $(document).ready( function () {
        var table = $("#mugsTable").DataTable({
            "language": {
                "zeroRecords": "No record(s) found."
            },
            processing: true,
            serverSide: true,
            lengthChange: true,

            searchable:false,
            // searching:false,
            bStateSave: false,

            ajax: {
                url: "{{ route('escort.mug.dataTable') }}",
                data: function (d) {
                    d.type = 'player';
                }
            },
            columns: [
                { data: 'sn', name: 'sn', searchable: true, orderable:false ,defaultContent: 'NA'},
                { data: 'user_name', name: 'user_id', searchable: true, orderable:false ,defaultContent: 'NA'},
                { data: 'date', name: 'date', searchable: true, orderable:true ,defaultContent: 'NA'},
                { data: 'place_name', name: 'place_name', searchable: true, orderable:false ,defaultContent: 'NA'},
                { data: 'email', name: 'email', searchable: false, orderable:false,defaultContent: 'NA' },
                { data: 'name', name: 'name', searchable: false, orderable:false ,defaultContent: 'NA'},
                { data: 'mobile', name: 'mobile', searchable: true, orderable:false,defaultContent: 'NA' },
                { data: 'explain_incident', name: 'explain_incident', searchable: false, orderable:true,defaultContent: 'NA' }
            ],
            order: [2, 'desc'],
        });

        $("#search-button").on('click', function(e) {
            if($("#search").val()) {
                table.search($("#search").val()).draw();
                $("#content-mugs").attr('hidden', false);
            } else {
                $("#content-mugs").attr('hidden', true);
            }
        });
    });
</script>
@endpush

@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->{{-- Page Heading   --}}
   <div class="row">  
         <div class="custom-heading-wrapper col-md-12">
             <h1 class="h1">Database (Centres)</h1>
             <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
         </div>
         <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
               <div class="card-body">
                  <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                  <ol>
                     <li>The Database lists all Massage Centres within your Territory.
                     </li>
                     <li>You can undertake a search:</li>
                     <ol class="level-2">
                        <li>according to your preference; and</li>
                        <li>to group Massage Centres according to the post code.</li>
                     </ol>
                  </ol>
               </div>
            </div>
         </div>   
   </div>
   {{-- end --}}
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   $(document).ready(function() {
       $('#createProspectTable').DataTable({
           language: {
               search: "_INPUT_",
               searchPlaceholder: "Search By Agent Id",
               sSearch: 'Search:'
           },
           paging: true,
           pageLength: 10,
           lengthMenu: [10, 25, 50, 100],
           info: true,
           searching: true,
           order: [[1, 'asc']]
       });
   });
   </script>
   


@endpush
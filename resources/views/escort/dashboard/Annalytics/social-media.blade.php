
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
            <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                <h1 class="h1">Social Media</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 my-4">
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
                <div class="table-responsive-xl">
                    <table id="socialMediaTable" class="table table-bordered display" width="100%" >
                        <thead class="bg-first">
                        <tr>
                                <th>Social Icon</th>
                                <th>Social Platform</th>
                                <th class="text-center">Clicks Today</th>
                                <th class="text-center">Clicks This Week</th>
                                <th class="text-center">Year to Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="statistics-icon">
                                    <img src="{{ asset('assets/dashboard/img/twitter-icon.png') }}" alt="icon">
                                </div></td>
                                <td>Twitter</td>
                                <td class="text-center">25</td>
                                <td class="text-center">125</td>
                                <td class="text-center">1,500</td>
                            </tr>
                            <tr>
                                <td><div class="statistics-icon">
                                    <img src="{{ asset('assets/dashboard/img/instagram-icon.png') }}" alt="icon">
                                </div></td>
                                <td>Instagram</td>
                                <td class="text-center">25</td>
                                <td class="text-center">125</td>
                                <td class="text-center">1,500</td>
                            </tr>
                            <tr>
                                <td><div class="statistics-icon">
                                    <img src="{{ asset('assets/dashboard/img/facebook-icon.png') }}" alt="icon">
                                </div></td>
                                <td>Facebook</td>
                                <td class="text-center">25</td>
                                <td class="text-center">125</td>
                                <td class="text-center">1,500</td>
                            </tr>
                            <tr>
                                <td><div class="statistics-icon">
                                    <img src="{{ asset('assets/dashboard/img/click.png') }}" alt="icon">
                                </div></td>
                                <td class="text-right font-weight-bold" colspan="3">Total Clicks</td>
                                <td class="text-center font-weight-bold">4,500</td>
                            </tr>
                        </tbody>
                    </table>
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

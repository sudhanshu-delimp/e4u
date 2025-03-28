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
        #listings_length {
            width: 30%;
            top: 40px;
            position: relative;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">{{ucfirst($type)}} Pinup Listings</div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" id="profile_and_tour_options">
            <div class="row collapse" id="notes">
                <div class="col-md-12 mb-5">
                    <?php
                    if ($type == "current") {
                    ?>
                    <div class="card">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to check all of your current Pinup listings (<b>Listing</b>), no matter the Location.  This report includes Listings associated with a Tour.</li>
                              <li>You can change the Listing here or from within the Tour by selecting 'Action'. You will be able to Edit, Suspend or Delete the Listing; and</li>
                              <li>Where you suspend a Listing that is currently posted, you will not be refunded any portion of the Fee.</li>
                          </ol>
                        </div>
                    </div>
                    <?php
                    } else if ($type == "past") {
                    ?>
                    <div class="card">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to check all of your past listings (<b>Listing</b>), no matter the Location.  This report includes Listings associated with past Tours.</li>
                              <li>The report will provide you with information associated with the Listing, such as the:
                                  <ol type="a">
                                      <li>Location and duration of the Listing; and</li>
                                      <li>Fees associated with the Listing.</li>
                                  </ol>
                              </li>
                              <li>Please note, where you suspended a listing in any Location, you were not refunded any Fee at the time of suspension.</li>
                          </ol>
                        </div>
                    </div>                    
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive pl-1 pt-3 list-sec" id="">
                        <table id="listings" class="table table-striped" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>State</th>
                                <th>Profile Name</th>
                                <th>Week Start Date</th>
                                <th>Payment Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                                $dataTableData = [];
                            @endphp
                            @foreach($pinups as $pinup)
                                @php
                                    $dataTableData[] = [
                                           'sl_no' => $i++,
                                           'name' => config('escorts.profile.states')[$pinup['state_id']]['stateName'],
                                           'profile_name' => $pinup['escort_id'],
                                           'week_start' => date('d-m-Y', strtotime($pinup['week_start'])),
                                           'payment_amount' => '$'.number_format($pinup['payment_amount'], 2),
                                       ];
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
       <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
       <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
       <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
       <script type="text/javascript">
           $(document).ready(function(e) {
               $("#listings").DataTable({
                   data: <?php echo json_encode($dataTableData)?>,
                   @if($type=='past')
                   order: [[4, 'desc']],
                   @else
                   order: [[4, 'asc']],
                   @endif
                   columns: [
                       {data: 'sl_no', searchable: false, orderable:false},
                       {data: 'name'},
                       {data: 'profile_name'},
                       {data: 'week_start'},
                       {data: 'payment_amount'}
                   ]
               });
           })
       </script>
@endpush


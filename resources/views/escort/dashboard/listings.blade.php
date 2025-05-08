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
            <div class="v-main-heading h3" style="display: inline-block;">{{ucfirst($type)}} Listings</div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" id="profile_and_tour_options">
            <div class="row collapse" id="notes">
                <div class="col-md-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($type == "current") {
                            ?>
                            <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol>
                                <li>Use this feature to check all of your current listings, no matter the Location. This
                                    report does not include listings associated with a Tour.
                                </li>
                                <li>You can change the Profile listing by selecting 'Action'. You will be able to:
                                    <ol type="a">
                                        <li>Edit, Suspend or Delete the listing; and</li>
                                        <li>Switch on and off your Be Right Back (<b>BRB</b>) notification. When you activate
                                            your BRB, a floating notification will appear at the top of your Profile
                                            advising when you will be returning, but allowing your Profile still to be
                                            viewed.
                                        </li>
                                    </ol>
                                </li>
                                <li>Where you suspend a listing that is currently posted, you will not be refunded any
                                    Fee.
                                </li>
                            </ol>
                            <?php
                            } else if ($type == "past") {
                            ?>
                            <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol>
                                <li>Use this feature to view or delete any of your past Profile listings.</li>
                                <li>You can re-post a Profile by selecting 'Re-Post' under the Action function.</li>
                                <li>Old Profile listings will purge when you delete the Profile from your Archives or
                                    the Profile has not been active for 2 years.
                                </li>
                            </ol>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive pl-1 pt-3 list-sec" id="">
                        <table id="listings" class="table table-striped" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Profile Name</th>
                                <th>Location</th>
                                <th>Stage Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>                                
                                <!-- <th>Fee / Fee Paid</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                                $dataTableData = [];
                            @endphp
                            @foreach($relatedEscorts as $escort)
                                @php
                                    // dd($relatedEscorts, $escort);
                                    if($escort['purchase']) {
                                @endphp
                                @foreach($escort['purchase'] as $purchase)
                                    @php
                                        $dataTableData[] = [
                                           'sl_no' => $i++,
                                           'profile_name' => $escort['profile_name'],
                                           'name' => $escort['name'],
                                           'city' => config("escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName")."<br>".(config("escorts.profile.states.$escort[state_id].stateName")),
                                           'start_date' => date('d-m-Y', strtotime($purchase['start_date'])),
                                           'end_date' => date('d-m-Y', strtotime($purchase['end_date'])),
                                           'days' => ( Carbon\Carbon::parse($purchase['end_date'])->diffInDays(Carbon\Carbon::parse($purchase['start_date']))),
                                       ];
                                    @endphp
                                    {{--<tr class="tr-sec">
                                       <td>{{($i++)}}</td>
                                        <td>{{$escort['profile_name']}}</td>
                                        <td>{{$escort['name']}}</td>
                                       <td>{{config("escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName")}}<br>({{config("escorts.profile.states.$escort[state_id].stateName")}})</td>
                                        <td>{{date('d-m-Y', strtotime($purchase['start_date']))}}</td>
                                        <td>{{date('d-m-Y', strtotime($purchase['end_date']))}}</td>
                                        <td>{{( Carbon\Carbon::parse($purchase['end_date'])->diffInDays(Carbon\Carbon::parse($purchase['start_date'])))}}</td>
                                    </tr>--}}
                                @endforeach
                                @php
                                    }
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
                       {data: 'profile_name'},
                       {data: 'name'},
                       {data: 'city'},
                       {data: 'start_date'},
                       {data: 'end_date'},
                       {data: 'days', searchable: false}
                   ]
               });
           })
       </script>
@endpush


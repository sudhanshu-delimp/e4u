@extends('layouts.agent') @section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    @endsection @section('content')
    <style type="text/css">
        .table td {
            border-color: #022c3d !important;
        }

        .table td,
        .table th {
            padding: 0.4rem;
            text-align: center;
        }

        .note_list ol li {
            padding-left: 25px
        }

        .total_row {
            border-top: 2px solid !important;
            border-bottom: 2px solid !important;
        }

        .table-bordered {
            border-color: #022c3d !important;
        }

        .custom_fees_tab li a {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.01em;
            padding: 10px;
            background: #022c3d;
            border-radius: 3px;
            color: #fff;
        }

        .custom_fees_tab li a.active {
            background-color: #ff3c5f !important;
            color: #fff !important;
        }

        select option {
            color: #858796 !important;
        }
    </style>
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->
        <div class="row">
            <div class="custom-heading-wrapper col-lg-12">
                <h1 class="h1">Fees Summary</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>You can apply filters within the Fees Summary to suit your query or report type.</li>
                            <li>All Fees paid to you under the Agent Agreement will be paid into your nominated Bank
                                Account. Fees is inclusive of GST.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <ul class="nav nav-tabs tab-sec custom_fees_tab">
                    <li class="active"><a href="#one" data-toggle="tab" class="active">Fees Summary (Advertiser)</a></li>
                    <li><a href="#two" data-toggle="tab">Fees Summary (YoY)</a></li>
                </ul>
            </div>
            <div class="col-md-12 mt-4">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-4 border-0">
                                <div class="tab-content" id="myTabContent">
                                    {{-- 1 --}}
                                    @include('agent.dashboard.Fees.fees_summery_advertiser')
                                    {{-- 2 --}}
                                    @include('agent.dashboard.Fees.fees_summery_yoy')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- For Escort Report --}}
    <div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog"
        aria-labelledby="CompetitorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div id="appendSingleEscort">
                    
                </div>
            </div>
        </div>
    </div>
    {{-- end --}} {{-- For Massage Report --}}

    <div class="modal fade upload-modal" id="message-report" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div id="appendSingleMassage">
                </div>
            </div>
        </div>
    </div>

    <div id="manage-route" data-csrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-advertiser-fees-summery="{{ route('agent.advertiser.fees.summary') }}"
        data-agent-fees-summary="{{ route('agent.fees.summary') }}"
        data-single-advertiser-summary="{{route('single-advertiser-summary')}}"
        ></div>


    {{-- end --}}
    @endsection @push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    {{--
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script> --}} {{--
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script> --}} {{--
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/agent/management/fee/fees-summery.js') }}?v={{ filemtime(public_path('js/agent/management/fee/fees-summery.js')) }}"></script>

    <script>
        // $(document).ready(function() {
        //     $('#select-fy').on('change', function() {
        //         const selectedFY = $(this).val();
        //         $('#current-fy').text(selectedFY.replace('-', ' / '));
        //     })
        // });
    </script>
@endpush

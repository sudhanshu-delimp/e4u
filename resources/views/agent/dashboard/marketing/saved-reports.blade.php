@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
        .report-table {
            border: 0px;
            border-collapse: collapse;
            border-radius: 5px !important;
            padding: 25px;
        }

        .report-table th,
        .report-table td {
            border: none !important;
        }

        .report-table th {
            font-weight: bold;
        }

        .custom-height {
            height: 40px !important;
        }

        #mergeList .table .inner_details strong {
            width: 110px;
        }

        #mergeList table td {
            vertical-align: middle;
        }

        .border {
            border: 1px solid #d1d3e2 !important;
        }

        .list-group-item+.list-group-item {
            border-top-width: 1px;
        }
    </style>

    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            /* ✅ Bootstrap modal z-index 1050 se upar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .progress-container {
            width: 300px;
            height: 6px;
            background: #ccc;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
            position: relative;
        }

        /* Smooth moving bar */

        .progress-bar {
            position: absolute;
            width: 40%;
            height: 100%;
            background: #ff3c5f;
            animation: smoothSlide 1.2s linear infinite;
        }

        @keyframes smoothSlide {
            0% {
                left: -40%;
            }

            100% {
                left: 100%;
            }
        }

        .download-icon {
            font-size: 50px;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(8px);
            }
        }
    </style>

    {{-- Loader --}}
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #fff;
        }

        /* Container */
        .progress-container {
            width: 300px;
            height: 6px;
            background: #ccc;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
            position: relative;
        }

        /* Smooth moving bar */

        .progress-bar {
            position: absolute;
            width: 40%;
            height: 100%;
            background: #ff3c5f;
            animation: smoothSlide 1.2s linear infinite;
        }

        @keyframes smoothSlide {
            0% {
                left: -40%;
            }

            100% {
                left: 100%;
            }
        }

        .download-icon {
            font-size: 50px;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(8px);
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Saved Reports</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>Reports generated from <a href="{{ route('agent.marketing.prospect.list') }}"
                                    class="custom_links_design">Prospects List</a> are saved here.</li>
                            <li>Use these Lists to:
                                <ol>
                                    <li>merge into any of the marketing material provided.</li>
                                    <li>print as a working sheet.</li>
                                    <li>work from your computer screen.</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}

        <!-- Trigger Button -->

        <!-- Main DataTable (Your Reports Table) -->
        <div class="table-responsive-xl">
            <table class="table mb-3" id="save_report_table">
                <thead class="table-bg">
                    <tr>
                        <th>ID</th>
                        <th>Date Generated</th>
                        <th>Post Code</th>
                        <th>Listings</th>
                        <th>Merged</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>


    <div id="loader" class="overlay d-none">
        <div class="download-icon"><img src="{{ asset('assets/dashboard/img/arrow.png') }}" alt=""
                style="width: 70px;"></div>
        <h2 id>Downloading... Please wait</h2>
        <p id="progressText">0 / 0</p>
        <div class="progress-container">
            <div class="progress-bar"></div>

        </div>
    </div>


    @include('agent.dashboard.marketing.modal.merge-type-modal') {{-- Merge Type --}}
    @include('agent.dashboard.marketing.modal.view-list-modal') {{-- view Modal  --}}
    @include('agent.dashboard.marketing.modal.view-report-modal') {{-- Merged Documents modal --}}
    @include('agent.dashboard.marketing.modal.appointment-modal') {{-- Appointment Modal --}}
    @include('agent.dashboard.marketing.modal.search-modal') {{-- Search Modal --}}



    <div id="manage-route" data-csrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-postcodes-url="{{ route('agent.marketing.prospect.postcodes') }}"
        data-generate-url="{{ route('agent.marketing.prospect.store-report') }}"
        data-recipients-url="{{ route('agent.marketing.prospect.recipients') }}"
        data-reports-url="{{ route('agent.marketing.prospect.reports') }}"
        data-action-url="{{ route('agent.marketing.prospect.report-action') }}"
        data-clear-reports-url="{{ route('agent.marketing.prospect.clear-reports') }}"
        data-agent-state="{{ auth()->user()->state_abbr ?? '' }}"
        data-save-report="{{ route('agent.marketing.prospect.save-report') }}"
        data-report-list-action="{{ route('agent.marketing.prospect.report.action') }}"
        data-generate-pdf="{{ route('agent.marketing.prospect.generate.pdf') }}"
        data-update-save-report="{{ route('agent.marketing.prospect.update.save.report') }}"
        data-view-centerlist-url="{{ route('agent.marketing.prospect.view.centerlist', ['id' => '__ID__']) }}"
        data-save-report-list="{{ route('agent.marketing.save.report.list') }}"
        data-view-approspectlist="{{ route('agent.marketing.save.report.appointment.list', ['id' => '__ID__']) }}"
        data-search-center="{{ route('agent.marketing.save.report.search.center') }}"
        data-progress-data="{{ route('agent.marketing.prospect.progress', ['id' => '__ID__']) }}"
        data-download-data="{{ route('agent.marketing.prospect.download', ['id' => '__ID__']) }}"></div>
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
 


    <script src="{{ asset('agent/dashboard/marketing/prospect-lists/create-prospect.js') }}"></script>
@endpush

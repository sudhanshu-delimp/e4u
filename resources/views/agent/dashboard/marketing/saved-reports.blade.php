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

    @include('agent.dashboard.marketing.modal.merge-type-modal') {{-- Merge Type --}}
    @include('agent.dashboard.marketing.modal.view-list-modal') {{-- view Modal  --}}
    @include('agent.dashboard.marketing.modal.view-report-modal') {{-- Merged Documents modal --}}



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
        data-save-report-list="{{ route('agent.marketing.save.report.list') }}"></div>
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>



    {{-- <script src="{{ asset('agent/dashboard/marketing/save-report/save-reports.js') }}"></script> --}}
    <script src="{{ asset('agent/dashboard/marketing/prospect-lists/create-prospect.js') }}"></script>
@endpush

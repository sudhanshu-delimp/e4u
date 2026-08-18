@extends('layouts.agent')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Database (Centres)</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true"><b>Help?</b></span>
                </div>
                @if (request('from') == 'dashboard')
                    <div class="back-to-dashboard">
                        <a href="{{ route('agent.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>The Database lists all Massage Centres within your Territory. From time to time, the
                                database is updated, usually with a new file. Previous files will remain in the list as
                                historical</li>
                            <li>You can create a working report by undertaking a search, via the <a
                                    href="{{ route('agent.marketing.prospect.list') }}"
                                    class="custom_links_design">Prospects List</a> page:</li>
                            <ol class="level-2">
                                <li>according to your preference; and</li>
                                <li>to group Massage Centres according to the post code.</li>
                            </ol>
                            <li>You can download the Data file to be viewed in Excel. The Date file can not be edited.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-end flex-wrap gap-10 my-3">
                <div class="total_listing">
                    <div><span>Active Post Codes : </span></div>
                    <div><span class="totalInprogressTask">0</span></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive-xl">
                    <table class="table mb-3" id="databaseCentreTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Uploaded</th>
                                <th>Territory</th>
                                <th>Centres</th>
                                <th>Mobile</th>
                                {{-- <th>Landline</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="manage-route" data-csrf-token="{{ csrf_token() }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-marketing-database-centres="{{ route('agent.marketing.database.centres') }}"
        data-marketing-view-database-center="{{ route('agent.marketing.database.view', ['id' => '__ID__']) }}"
        data-marketing-download-database-center="{{ route('agent.marketing.database.download', ['id' => '__ID__']) }}"
        data-count-active-post-code="{{ route('agent.marketing.database.active.count') }}"
        data-download-pdf="{{ route('agent.marketing.database.download.pdf', ['id' => '__ID__']) }}">

        @include('agent.dashboard.marketing.modal.data-summary-modal')
    @endsection
    @push('script')
        <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
        </script>
        <script src="{{ asset('agent/dashboard/marketing/database-center.js') }}"></script>
    @endpush

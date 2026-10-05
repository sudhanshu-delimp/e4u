@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
    <style>
        .small-muted {
            font-size: 12px;
            color: #6c757d;
        }

        .card {
            box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
        }

        #mergeList .table .inner_details {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            align-items: center;
        }

        #mergeList .table .inner_details strong {
            width: 110px;
        }

        #mergeList table td {
            vertical-align: middle;
        }

        #mergeList table th {
            text-align: center;
        }

        #postcodeDropdown .dropdown-item {
            cursor: pointer;
            padding: 6px 12px;
        }

        #postcodeDropdown .dropdown-item:hover {
            background-color: #f0f0f0;
        }

        .range-error {
            color: #dc3545;
            font-weight: 600;
        }

        .range-success {
            color: #28a745;
            font-weight: 600;
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
        {{-- Page Heading --}}
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Prospect Lists (Centres)</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>                     </span>
                </div>

            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>The E4U data list (<b>Data</b>) includes all known Massage Centres located in your
                                Territory.
                                From time to time the Data will be updated. You will be notified when the Data is
                                updated.</li>
                            <li>Use the search feature to create your prospect list (<b>List</b>). Once you have created the
                                List, you can then apply the List in the following manner:
                                <ol class="level-2">
                                    <li>merging the List into any of the marketing material provided.</li>
                                    <li>printing the List as a working sheet.</li>
                                    <li>working from the List via your computer screen.</li>
                                </ol>
                            </li>
                            <li>A Massage Centre who becomes a Member will remain in the List.</li>
                            <li>You can access your Lists anytime from <a
                                    href="{{ route('agent.marketing.save.report.list') }}" class="custom_links_design">Saved
                                    Reports</a>.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                {{-- Generate List Section --}}
                <div class="gen-prospect-list common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg fill="#ff3c5f" width="64px" height="64px" viewBox="0 0 1000 1000" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 1000 1000" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata> <g> <g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)"> <path d="M1685.8,4989.2c-253.7-58.9-499.3-265.9-621.1-519.6l-75.1-158.3l-6.1-4141c-4.1-2772.8,2-4173.4,16.2-4238.4c56.8-267.9,257.8-513.6,523.7-639.4l156.3-75.1l3258-6.1c2174-4.1,3290.4,2,3355.4,16.2c326.8,69,627.2,365.4,702.4,692.2c14.2,58.9,22.3,1049.5,22.3,2809.4c0,2616.5-2,2724.1-38.6,2801.2c-48.7,101.5-3373.6,3428.5-3458.9,3460.9C5449.2,5017.6,1797.5,5015.6,1685.8,4989.2z M4856.5,3087.2c0-1433.1,2-1451.4,115.7-1648.3c89.3-152.2,253.7-298.4,426.3-381.6l158.3-75.1l1427-6.1l1425-6.1v-2494.7c0-1891.9-6.1-2506.9-24.4-2547.5c-52.8-117.7,148.2-111.6-3385.8-111.6s-3333.1-6.1-3385.8,111.6c-38.6,81.2-34.5,8302.2,4.1,8371.2c58.9,105.6,12.2,101.5,1682.8,103.5h1556.9V3087.2z M6866.1,1585.1c-1351.9-4.1-1337.7-6.1-1380.3,109.6c-12.2,30.5-20.3,552.1-20.3,1293V4230l1319.4-1319.4l1319.4-1319.4L6866.1,1585.1z"></path> <path d="M2989-327.1v-304.5h2009.6h2009.6v304.5v304.5H4998.6H2989V-327.1z"></path> <path d="M2989-1646.5V-1951h2009.6h2009.6v304.5v304.5H4998.6H2989V-1646.5z"></path> <path d="M2989-2925.3v-304.5h954.1h954v304.5v304.5h-954H2989V-2925.3z"></path> </g> </g> </g></svg>
                        </div>

                        <div class="card-heading">
                            <h2>Generate List</h2>
                        </div>
                    </div>
                     <hr class="custom-hr">
                    <div class="card-heading mt-3">
                        <h2>Filter Types</h2>
                    </div>

                     <hr class="custom-hr">
                    <form id="generateForm">
                        <div class="form-group d-flex align-items-center gap-20 flex-wrap">
                            <label class="mb-0">Post Code</label>
                            <div class="radio-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="postcodeType" value="single"
                                            checked>
                                        Single</label>
                                </div>
                                <div class="form-check form-check-inline">

                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="postcodeType" value="multiple">
                                        Multiple</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="postcodeType" value="all">
                                        All</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group w-50 position-relative" id="singlePostCodeField">
                            <label>Enter Post Code</label>
                            <input type="text" id="singlePostCode" class="form-control" placeholder="e.g. 6000"
                                autocomplete="off">
                            <div id="postcodeDropdown" class="dropdown-menu w-100"
                                style="max-height:200px;overflow-y:auto;"></div>
                        </div>

                        <div class="form-group d-none w-50" id="multiplePostCodeFields">
                            <label>Enter Post Code Range</label>
                            <div class="d-flex gap-2">
                                <div class="position-relative flex-fill mr-2">
                                    <input type="text" id="fromPostCode" class="form-control" placeholder="From"
                                        autocomplete="off">
                                    <div id="fromPostcodeDropdown" class="dropdown-menu w-100"
                                        style="max-height:200px;overflow-y:auto;"></div>
                                </div>
                                <div class="position-relative flex-fill">
                                    <input type="text" id="toPostCode" class="form-control" placeholder="To"
                                        autocomplete="off">
                                    <div id="toPostcodeDropdown" class="dropdown-menu w-100"
                                        style="max-height:200px;overflow-y:auto;"></div>
                                </div>
                            </div>
                            <div id="rangeFeedback" class="mt-2" style="font-size:13px;"></div>
                        </div>

                        <div class="form-group d-none w-50" id="allPostCodeField">
                            <label>State</label>
                            <span class="badge bg-first ml-2" id="stateBadge"
                                style="font-size:14px;">{{ auth()->user()->home_state ?? 'N/A' }}</span>
                            <small class="d-block text-muted mt-1">All postcodes for your state will be included.</small>
                        </div>

                        <h3>Options</h3>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-group d-flex align-items-center gap-20 flex-wrap">
                                <label class="mb-0">Trial Run Only</label>
                                <div class="radio-group">
                                    <div class="form-check form-check-inline">

                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="trialRun" value="on">
                                            On</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="trialRun"
                                                value="off" checked>
                                            Off</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex gap-20">
                                <button type="button" id="showRecipients" class="btn-common mr-0" disabled>Show
                                    Recipients</button>
                                <button type="button" id="proceedBtn" class="btn-common mr-0">Proceed</button>
                            </div>

                        </div>
                    </form>
                </div>

                {{-- Preview List --}}
                <div class="prospect-list-table d-none common-card" id="previewCard">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" width="64px" height="64px" viewBox="0 0 1000 1000" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 1000 1000" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata> <g> <g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)"> <path d="M1685.8,4989.2c-253.7-58.9-499.3-265.9-621.1-519.6l-75.1-158.3l-6.1-4141c-4.1-2772.8,2-4173.4,16.2-4238.4c56.8-267.9,257.8-513.6,523.7-639.4l156.3-75.1l3258-6.1c2174-4.1,3290.4,2,3355.4,16.2c326.8,69,627.2,365.4,702.4,692.2c14.2,58.9,22.3,1049.5,22.3,2809.4c0,2616.5-2,2724.1-38.6,2801.2c-48.7,101.5-3373.6,3428.5-3458.9,3460.9C5449.2,5017.6,1797.5,5015.6,1685.8,4989.2z M4856.5,3087.2c0-1433.1,2-1451.4,115.7-1648.3c89.3-152.2,253.7-298.4,426.3-381.6l158.3-75.1l1427-6.1l1425-6.1v-2494.7c0-1891.9-6.1-2506.9-24.4-2547.5c-52.8-117.7,148.2-111.6-3385.8-111.6s-3333.1-6.1-3385.8,111.6c-38.6,81.2-34.5,8302.2,4.1,8371.2c58.9,105.6,12.2,101.5,1682.8,103.5h1556.9V3087.2z M6866.1,1585.1c-1351.9-4.1-1337.7-6.1-1380.3,109.6c-12.2,30.5-20.3,552.1-20.3,1293V4230l1319.4-1319.4l1319.4-1319.4L6866.1,1585.1z"></path> <path d="M2989-327.1v-304.5h2009.6h2009.6v304.5v304.5H4998.6H2989V-327.1z"></path> <path d="M2989-1646.5V-1951h2009.6h2009.6v304.5v304.5H4998.6H2989V-1646.5z"></path> <path d="M2989-2925.3v-304.5h954.1h954v304.5v304.5h-954H2989V-2925.3z"></path> </g> </g> </g></svg>
                            </div>

                            <div class="card-heading">
                                <h2>Preview Recipients</h2>
                            </div>
                        </div>
                        <button class="btn-cancel-modal mr-0" id="closePreview">Close</button>
                    </div>
                    <hr class="custom-hr">
                    <div class="table-responsive mt-3">
                        <table class="table" id="previewTable">
                            <thead class="bg-first">
                                <tr>
                                    <th>ID</th>
                                    <th>Business Name</th>
                                    <th>Address</th>
                                    <th>Post Code</th>
                                    <th>Mobile Number</th>
                                    <th>Business Number</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                {{-- Reports Table --}}
                <div class="prospect-list-table common-card">
                    <div class="d-flex justify-content-between align-items-center">
                       
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" width="64px" height="64px" viewBox="0 0 1000 1000" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 1000 1000" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata> <g> <g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)"> <path d="M1685.8,4989.2c-253.7-58.9-499.3-265.9-621.1-519.6l-75.1-158.3l-6.1-4141c-4.1-2772.8,2-4173.4,16.2-4238.4c56.8-267.9,257.8-513.6,523.7-639.4l156.3-75.1l3258-6.1c2174-4.1,3290.4,2,3355.4,16.2c326.8,69,627.2,365.4,702.4,692.2c14.2,58.9,22.3,1049.5,22.3,2809.4c0,2616.5-2,2724.1-38.6,2801.2c-48.7,101.5-3373.6,3428.5-3458.9,3460.9C5449.2,5017.6,1797.5,5015.6,1685.8,4989.2z M4856.5,3087.2c0-1433.1,2-1451.4,115.7-1648.3c89.3-152.2,253.7-298.4,426.3-381.6l158.3-75.1l1427-6.1l1425-6.1v-2494.7c0-1891.9-6.1-2506.9-24.4-2547.5c-52.8-117.7,148.2-111.6-3385.8-111.6s-3333.1-6.1-3385.8,111.6c-38.6,81.2-34.5,8302.2,4.1,8371.2c58.9,105.6,12.2,101.5,1682.8,103.5h1556.9V3087.2z M6866.1,1585.1c-1351.9-4.1-1337.7-6.1-1380.3,109.6c-12.2,30.5-20.3,552.1-20.3,1293V4230l1319.4-1319.4l1319.4-1319.4L6866.1,1585.1z"></path> <path d="M2989-327.1v-304.5h2009.6h2009.6v304.5v304.5H4998.6H2989V-327.1z"></path> <path d="M2989-1646.5V-1951h2009.6h2009.6v304.5v304.5H4998.6H2989V-1646.5z"></path> <path d="M2989-2925.3v-304.5h954.1h954v304.5v304.5h-954H2989V-2925.3z"></path> </g> </g> </g></svg>
                            </div>

                            <div class="card-heading">
                                <h2>Generated Report List</h2>
                            </div>
                        </div>
                        <div>
                            <button class="btn-success-modal mr-0" id="clearReports">Clear</button>
                            <button class="btn-success-modal mr-0" id="saveReport">Save Report</button>
                        </div>
                    </div>
                    <hr class="custom-hr">
                    <div class="table-responsive mt-3">
                        <table class="table" id="reportsTable">
                            <thead class="bg-first">
                                <tr>
                                    <th>ID</th>
                                    <th>Date Generated</th>
                                    <th>Post Code</th>
                                    <th>Listings</th>
                                    <th>Merged</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- modal  --}}


    @include('agent.dashboard.marketing.modal.merge-type-modal') {{-- Merge Type --}}
    @include('agent.dashboard.marketing.modal.view-list-modal') {{-- view Modal  --}}
    @include('agent.dashboard.marketing.modal.view-report-modal') {{-- Merged Documents modal --}}

    {{-- end modals --}}


    <div id="loader" class="overlay d-none">
        <div class="download-icon"><img src="{{ asset('assets/dashboard/img/arrow.png') }}" alt=""
                style="width: 70px;"></div>
        <h2 id>Downloading... Please wait</h2>
        <p id="progressText">0 / 0</p>
        <div class="progress-container">
            <div class="progress-bar"></div>
            
        </div>
    </div>



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
        data-progress-data="{{route('agent.marketing.prospect.progress', ['id' => '__ID__'])}}"
        data-download-data="{{route('agent.marketing.prospect.download', ['id' => '__ID__'])}}"
        ></div>
@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
 
    <script src="{{ asset('agent/dashboard/marketing/prospect-lists/create-prospect.js') }}"></script>
@endpush

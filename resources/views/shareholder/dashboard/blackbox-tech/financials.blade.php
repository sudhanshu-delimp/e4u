@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Financials</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>All of the Company’s financial statements are available here.</li>
                        <li>Click the financial report you are looking for and it will download as a .pdf file for you
                            to view.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="shareholder_list_wrapper">
                <div class="row no-gutters">

                    <!-- Left Side PDF Viewer -->
                    <div class="col-md-9">
                        <div class="pdf-area">
                            <div class="pdf-title" id="pdfTitle"> Balance Sheet (30-06-2025)</div>
                            <iframe id="pdfViewer" class="pdf-viewer"
                                src="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2025.pdf') }}"></iframe>
                        </div>
                    </div>

                    <!-- Right Side Tabs -->
                    <div class="col-md-3">
                        <div class="search_by_year">
                            <form method="GET" action="" id="searchForm">
                                <input type="search" name="search" placeholder="Search by year">
                            </form>
                        </div>

                        <div class="nav flex-column nav-pills shareholder_tab_sidebar p-0" id="pdfTabs">
                            <ul id="pdfList">

                                <li>
                                    <a href="javascript:void(0)" class="nav-link active"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2025.pdf') }}"
                                        data-title=" Balance Sheet (30-06-2025)">
                                        Balance Sheet (30-06-2025)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2024-to-30-06-2025.pdf') }}"
                                        data-title="Profit and Loss (30-06-2025)">
                                        Profit and Loss (30-06-2025)
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-31-12-2024.pdf') }}"
                                        data-title=" Balance Sheet (31-12-2024)">

                                        Balance Sheet (31-12-2024)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2024-to-31-12-2024.pdf') }}"
                                        data-title="Profit and Loss (31-12-2024)">
                                        Profit and Loss (31-12-2024)
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2024.pdf') }}"
                                        data-title="Balance Sheet (30-06-2024)">
                                        Balance Sheet (30-06-2024)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2023-to-30-06-2024.pdf') }}"
                                        data-title="Profit and Loss (30-06-2024)">
                                        Profit and Loss (30-06-2024)
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-31-12-2023.pdf') }}"
                                        data-title="Balance Sheet (31-12-2023)">
                                        Balance Sheet (31-12-2023)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2023-to-31-12-2023.pdf') }}"
                                        data-title="Profit and Loss (31-12-2023)">
                                        Profit and Loss (31-12-2023)
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2023.pdf') }}"
                                        data-title="Balance Sheet (30-06-2023)">
                                        Balance Sheet (30-06-2023)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2022-to-30-06-2023.pdf') }}"
                                        data-title="Profit and Loss (30-06-2023)">
                                        Profit and Loss (30-06-2023)
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-31-12-2022.pdf') }}"
                                        data-title="Balance Sheet (31-12-2022)">
                                        Balance Sheet (31-12-2022)
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="nav-link"
                                        data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2022-to-31-12-2022.pdf') }}"
                                        data-title="Profit and Loss (31-12-2022)">
                                        Profit and Loss (31-12-2022)
                                    </a>
                                </li>


                            </ul>
                            <p id="message"></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('script')

    <script src="{{ asset('assets/js/shareholder-common.js') }}"></script>
@endsection

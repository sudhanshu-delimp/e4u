@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Annual Report </h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b></h3>
                   
                    <ol>
                        <li>The Company’s Annual Reports (<b>Annual Report</b>) are available to all Shareholders.</li>
                        <li>To access any Annual Report, simply select the year you are wanting from the search list.</li>
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
                            <div class="pdf-title" id="pdfTitle"> Annual Report 2025</div>
                            <iframe id="pdfViewer" class="pdf-viewer"
                                src="{{ asset('assets/dashboard/document/Annual_Report_Blackbox_Tech_Pty_Ltd_(2025).pdf') }}"></iframe>
                        </div>
                    </div>

                    <!-- Right Side Tabs -->
                    <div class="col-md-3">
                        <div class="search_by_year">
                            <form action="" method="GET" id="searchForm">
                                <input type="search" name="search" placeholder="Search by year">
                            </form>
                        </div>

                        <div class="nav flex-column nav-pills shareholder_tab_sidebar p-0" id="pdfTabs">
                            <ul id="pdfList">

                                <li>
                                    <a href="javascript:void(0)" class="nav-link active"
                                        data-pdf="{{ asset('assets/dashboard/document/Annual_Report_Blackbox_Tech_Pty_Ltd_(2025).pdf') }}"
                                        data-title=" Annual Report 2025">
                                        Annual Report 2025
                                    </a>
                                </li>
                                


                            </ul>
                            <div id="message"></div>
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

@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
        #GuidelineTable td{
            color: #000 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Guidelines</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                            <li>These Guidelines and Procedures are provided to assist you meet your obligations
                                under the Website’s Terms & Conditions.</li>
                            <li>Click the Document you are looking for and it will download as a .pdf file for you to view.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="GuidelineTable" style="width: 100%">
                        <thead class="table-bg">
                            <tr>
                                <th>Document</th>
                                <th>Type</th>
                                <th>Effective Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/guidelines-pdf/Guidelines -Services-KPIs-(10-2025).pdf') }}" target="_blank"
                                                class="custom_links_design" download="Performance_KPIs.pdf">Performance KPIs</a>
                                            <p>Key Performance Indicators for the
                                                Agent when undertaking their duties</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Guidelines</td>
                                <td>1st October 2025</td>

                            </tr>


                            <tr>
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{  asset('assets/dashboard/guidelines-pdf/Guidelines-Classifications-Laws-(10-2025).pdf') }}" target="_blank"
                                                class="custom_links_design" download="Classification_Laws.pdf">Classification Laws</a>
                                            <p>The essential principles associated
                                                with Classification Laws.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Guidelines</td>
                                <td>1st October 2025</td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{  asset('assets/dashboard/guidelines-pdf/Procedure-Signing-Up-Advertiser-(10-2025).pdf') }}" target="_blank"
                                                class="custom_links_design" download="Signing_Up_an_Advertiser.pdf">Signing Up an Advertiser</a>
                                            <p>The procedure to follow when
                                                signing up an Advertiser online.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Procedure</td>
                                <td>1st October 2025</td>

                            </tr>

                            <tr>
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/guidelines-pdf/Guidelines-Media-(10-2025).pdf')}}" target="_blank"
                                                class="custom_links_design" download="Understanding_Media.pdf">Understanding Media</a>
                                            <p>Rules about Media types and
                                                dimensions.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Guidelines</td>
                                <td>1st October 2025</td>

                            </tr>


                           


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    var table = $('#GuidelineTable').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search by Document Title",
            sSearch: 'Search:'
        },
        processing: false,
        serverSide: false,
        lengthChange: true,
        order: [],
        searchable: false,
        searching: true,
        bStateSave: true
    });
</script>
@endsection

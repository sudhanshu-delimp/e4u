@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style>
     #FormsTable td{
            color: #000 !important;
        }
</style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Forms</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>These forms are in pdf format and can be either saved to your computer or printed, and
                                are provided to assist Agents with the delivery of the Services.</li>
                                <li>Click the link to activate the download.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="FormsTable" style="width: 100%">
                        <thead class="table-bg">
                            <tr>
                                <th>Document</th>
                                <th>Area</th>
                                <th>Effective Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/Massage-Centres-Details.pdf') }}" target="_blank"
                                                class="custom_links_design" download="Massage-Centres-Details.pdf">Agent Work Sheet - Massage Centre</a>
                                            <p>A complete summary of the business.
                                                Used to complete a MC’s Account and
                                                My Information.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Massage Centre</td>
                                <td>1st October 2025</td>

                            </tr>


                            <tr>
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{  asset('assets/dashboard/forms-pdf/Credit-Card-Payment-Form.pdf') }}" target="_blank"
                                                class="custom_links_design" download="Credit-Card-Payment-Form.pdf">Credit Card Payment Form</a>
                                            <p>Manual form for processing Advertiser
                                                payments.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Advertiser</td>
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
    var table = $('#FormsTable').DataTable({
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

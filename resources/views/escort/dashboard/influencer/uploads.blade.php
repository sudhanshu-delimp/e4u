@extends('layouts.escort')
@section('style')
   <style>
    .table td{
        vertical-align: middle;
    }
    </style> 
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Uploads</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>Download the E4U Influencer icon from here and store it on your computer.</li>
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
                                <th>Description</th>
                                <th>Platform</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="guide-document">
                                        <img src="{{ asset('assets/dashboard/forms-pdf/E4U_Coin_2026.png') }}" alt="" style="width: 100px">
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/E4U_Coin_2026.png') }}"
                                                target="_blank" class="custom_links_design"
                                                download="E4U_Coin_2026.png">E4U Influencer</a>
                                            <p>Click to download the icon in PNG format. Use
                                                this Icon for your Social Media platforms.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>All Platforms </td>
                                <td>2026</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

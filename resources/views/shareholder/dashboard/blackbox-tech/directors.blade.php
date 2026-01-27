@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between">
        <div class="custom-heading-wrapper">
            <h1 class="h1">Directors</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="back-to-dashboard">
            @if (request('from') !== 'sidebar')
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>The Company’s Directors details are set out here.</li>
                        <li>The Directors are available to Shareholders to discuss any aspects of the Company,
                            subsidiaries and related entities.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- content start --}}

    <div class="row sh_directors">
        <div class="col-md-12 mt-2">
            <div id="table-sec" class="table-responsive-xl">
                <table class="table" id="AgentReportTable">
                    <thead class="table-bg">
                        <tr>
                            <th>Full Name & Address </th>
                            <th>Positions Held</th>
                            <th>Meeting Status</th>
                            <th>Other Directorships<sup>(1)</sup></th>
                            <th>Mobile</th>
                            <th>Email<sup>(2)</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Wayne David Primrose</p>
                                <p>188 Almeria Parade Upper Swan WA 6069</p>
                            </td>
                            <td>
                                <p>Chairman Director</p>
                            </td>
                            <td>
                                <p>Chairman</p>
                                <p>Attendee</p>
                            </td>
                            <td>
                                <p>Agency Management (Australia) Pty Ltd</p>
                                <p>PEAMS Australia Pty Ltd</p>
                            </td>
                            <td>0438 028 728</td>
                            <td>
                            
                             <a href="{{ asset('assets/dashboard/forms-pdf/directors/test.pdf') }}"
                                                target="_blank" class="custom_links_design"
                                                download >wayne@blackboxtech.com.au</a>
                            </td>

                        </tr>

                          <tr>
                            <td>
                                <p>Andrew Stewart Stephen</p>
                                <p>32 Astral Avenue Carlisle WA 6101</p>
                            </td>
                            <td>
                                <p>Director</p>
                            </td>
                            <td>
                                <p>Attendee</p>
                            </td>
                            <td>
                                
                                <p>PEAMS Australia Pty Ltd</p>
                            </td>
                            <td>0401 071 478</td>
                            <td>
                            
                             <a href="{{ asset('assets/dashboard/forms-pdf/directors/test.pdf') }}"
                                                target="_blank" class="custom_links_design"
                                                download >andrew@blackboxtech.com.au</a>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <p>David John Bovell</p>
                                <p>3 Walba Way Swanbourne WA 6010</p>
                            </td>
                            <td>
                                <p>Director</p>
                            </td>
                            <td>
                                <p></p>
                            </td>
                            <td>
                                
                                <p></p>
                            </td>
                            <td>0408 922 355</td>
                            <td>
                            
                                <a href="{{ asset('assets/dashboard/forms-pdf/directors/test.pdf') }}"
                                                target="_blank" class="custom_links_design"
                                                download >david@blackboxtech.com.au </a>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- end --}}

</div>
@endsection
@section('script')
<script></script>
@endsection

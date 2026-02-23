@extends('layouts.admin')
@section('style')
    <style>
        td,
        th {
            vertical-align: middle !important;
        }

        #transactionSummaryTable td {
            white-space: normal !important;
            word-break: break-word;
        }

        .avatar img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row mt-5">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Media Verification</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 ">
                <div class="card collapse mb-4" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Media is managed in the following manner:
                                <ol class="level-2">
                                    <li>Escort:
                                        <ol class="level-3">
                                            <li>A selfie is uploaded with their Username, Membership ID and Mobile
                                                number printed (can be hand written) on a sheet of paper held up to
                                                their side and not obscuring any part of them (<b>Verification Image</b>).
                                            </li>
                                            <li>A drivers licence or passport which matches their Username and Home
                                                State is acceptable.</li>
                                        </ol>
                                    </li>
                                    <li>Centre:
                                        <ol class="level-3">
                                            <li>A photo is uploaded of the Centre’s business premises which displays
                                                the name of the business and the business number (<b>Verification
                                                    Image</b>); and for a Masseur
                                            </li>
                                            <li>A selfie is uploaded with the Masseur’s Username, Membership ID and
                                                Mobile number printed (can be hand written) on a sheet of paper held
                                                up to their side and not obscuring any part of them (<b>Verification
                                                    Image</b>).</li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li>Media verification only applies to photos. All uploaded photos by default are
                                Unverified.</li>
                            <li>
                                As soon as an Advertiser uploads the Verification Image, the status for all photos
                                changes to Verified, including any Listed Profile. In the case of a Centre, if the Centre
                                uploads a Verification Image of the Centre, the photos are Verified but the Masseurs are
                                not. A Masseur’s status is determined individually.

                            </li>
                            <li>
                                Once a Verification Image has been resolved, the report status is changed from Pending to
                                either:
                                <ol class="level-2">
                                    <li>Verified. All photos in the Advertiser’s Media retain the Verified status.</li>
                                    <li>Rejected. All photos in the Advertiser’s Media are changed to Unverified.
                                        Each Masseur’s status is addressed separately. Where a Masseur’s
                                        Verification Image is approved, then the Masseur’s Media is displayed as
                                        Verified, regardless of the Centre’s Media status.</li>
                                    The status of a Masseur is recorded separately and reflected according to the
                                    Masseur’s Verification Image outcome.
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" id="mediaverifyTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Member ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Submitted</th>
                                <th>Agent ID</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>E60125</td>
                                <td>18-02-2026</td>
                                <td>Tiera</td>
                                <td>1438 028 728</td>
                                <td>Escort</td>
                                <td>N/A</td>
                                <td>Selfie</td>
                                <td><span class="custom_badge badge_pending">Pending</span></td>
                                 <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                    class="fa fa-eye"></i> View Tag</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>M50248</td>
                                <td>17-02-2026</td>
                                <td>Lin’s Massage Place</td>
                                <td>1438 028 228</td>
                                <td>Agent</td>
                                <td>A50489</td>
                                <td>Selfie</td>
                                <td><span class="custom_badge badge_pending">Pending</span></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                    class="fa fa-eye"></i> View Tag</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>E20147</td>
                                <td>15-02-2026</td>
                                <td>Julie</td>
                                <td>1438 028 259</td>
                                <td>Escort</td>
                                <td>N/A</td>
                                <td>Selfie</td>
                                <td><span class="custom_badge badge_rejected">Rejected</span></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                    class="fa fa-eye"></i> View Tag</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>E40258</td>
                                <td>10-02-2026</td>
                                <td>Josephine</td>
                                <td>1438 028 128</td>
                                <td>Agent</td>
                                <td>A40789</td>
                                <td>Passport</td>
                                <td><span class="custom_badge badge_accepted">Verified</span></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                    class="fa fa-eye"></i> View Tag</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>M30147</td>
                                <td>05-02-2026</td>
                                <td>Perth Massage Centre</td>
                                <td>1438 028 328</td>
                                <td>Centre</td>
                                <td>N/A</td>
                                <td>Selfie</td>
                                <td><span class="custom_badge badge_accepted">Verified</span></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                    class="fa fa-eye"></i> View Tag</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>M40895</td>
                                <td>30-01-2026</td>
                                <td>By The River Massage</td>
                                <td>1438 028 159</td>
                                <td>Agent</td>
                                <td>A40025</td>
                                <td>Selfie</td>
                                <td><span class="custom_badge badge_rejected">Rejected</span></td>
                               <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                    class="fa fa-eye"></i> View Tag</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>




                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.reports.modal.view_image')
    @include('admin.reports.modal.view_tag')
    @include('admin.reports.modal.view_centre')
    @include('admin.reports.modal.verify_masseur_images')
@endsection
@section('script')
    <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>


    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>


    <script>
        var table = $("#mediaverifyTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID"
            },
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,

            columns: [{
                    data: 'member_id',
                    name: 'member_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'date',
                    name: 'date',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'submitted',
                    name: 'submitted',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'agent_id',
                    name: 'agent_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'type',
                    name: 'type',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'edit',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],
        });
    </script>
@endsection

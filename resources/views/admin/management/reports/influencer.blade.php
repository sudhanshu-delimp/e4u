@extends('layouts.admin')
@section('style')

@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Influencer Requests</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Applications to become an E4U Influencer (<b>Influencer</b>) are summarised here.
                                    </li>
                                    <li>Complete the Influencer data, Edit action, before the assessment is undertaken.</li>
                                    <li>Only the Managing Director can approve the status of an Influencer to an Escort.
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div id="table-sec" class="table-responsive-xl">
                                    <table class="table" id="InfluencerReportTable">
                                        <thead class="table-bg">
                                            <tr>
                                                <th>Ref</th>
                                                <th>Requested</th>
                                                <th>Member ID</th>
                                                <th>Mobile</th>
                                                <th>Home State</th>
                                                <th>Social Media</th>
                                                <th>Approved</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>123</td>
                                                <td>01-11-2025</td>
                                                <td>M40161</td>
                                                <td>1438 028 733</td>
                                                <td>Qld</td>
                                                <td>
                                                    <ul class="pl-3 mb-0">
                                                        <li class="mb-0">address</li>
                                                        <li class="mb-0">address</li>
                                                    </ul>
                                                </td>
                                                <td>28-12-2025</td>
                                                <td>Pending</td>
                                                <td>
                                                    <div class="dropdown no-arrow">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i
                                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                        </a>
                                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                            aria-labelledby="dropdownMenuLink">
                                                            <div class="custom-tooltip-container"><a
                                                                    class="dropdown-item align-item-custom toggle-massage-notification"
                                                                    href="#" title="Click to disable notification">
                                                                    <a class="dropdown-item align-item-custom"
                                                                        data-toggle="modal" data-target="#payAgentreport"
                                                                        href=""> <i class="fa fa-check-circle"
                                                                            aria-hidden="true"></i>
                                                                        Approve</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewAgentreport"> <i class="fa fa-ban"
                                                                            aria-hidden="true"></i>
                                                                        Suspend</a>


                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewAgentreport"> <i
                                                                            class="fa fa-thumbs-down"
                                                                            aria-hidden="true"></i>
                                                                        Decline</a>


                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#editSocialMediaAccount"> <i
                                                                            class="fa fa-pen" aria-hidden="true"></i>
                                                                        Edit</a>


                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item align-item-custom"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewAgentreport"> <i class="fa fa-eye"
                                                                            aria-hidden="true"></i>
                                                                        View Summary</a>
                                                            </div>
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
                </div>
            </div>
            <!--middle content end here-->
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <div class="modal fade upload-modal" id="editSocialMediaAccount" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved" class="custompopicon">
                        <span class="success-modal-title">Edit Social Media Accounts</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body">
                    <form name="edit_social_media" id="edit_social_media" method="POST"
                        action=""
                        enctype="multipart/form-data">

                     <div class="row social_media_modal" style="max-height: 500px; overflow:auto;">

                        <!-- Section -->
                        <div class="col-12 my-2">
                              <h6 class="border-bottom pb-1 text-blue-primary">Social Media Account 1</h6>
                        </div>

                        <!-- Name -->
                        <div class="col-6 mb-3">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">Name:</span>
                                 </div>
                                 <input type="text" class="form-control rounded-0"
                                       name="name" id="name"
                                       value="Monika Goswami" placeholder="Name">
                              </div>
                              <span class="text-danger error-name"></span>
                        </div>

                        <!-- URL Address -->
                        <div class="col-6 mb-3">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">URL Address:</span>
                                 </div>
                                 <input type="url" class="form-control rounded-0"
                                       name="address" id="address"
                                       value="https://www.facebook.com"
                                       placeholder="URL Address">
                              </div>
                              <span class="text-danger error-address"></span>
                        </div>

                        <!-- Date Joined -->
                        <div class="col-6 mb-3">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">Date Joined:</span>
                                 </div>
                                 <input type="date" class="form-control rounded-0"
                                       name="date_joined" id="date_joined">
                              </div>
                              <span class="text-danger error-date_joined"></span>
                        </div>

                        <!-- Followers -->
                        <div class="col-6 mb-3">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">Followers:</span>
                                 </div>
                                 <input type="text" class="form-control rounded-0"
                                       name="followers" id="followers"
                                       value="2" placeholder="Followers">
                              </div>
                              <span class="text-danger error-followers"></span>
                        </div>

                        <!-- Posts -->
                        <div class="col-6 mb-3">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">Posts:</span>
                                 </div>
                                 <input type="text" class="form-control rounded-0"
                                       name="posts" id="posts"
                                       value="02" placeholder="Posts">
                              </div>
                              <span class="text-danger error-posts"></span>
                        </div>

                        <!-- Re-Posts -->
                        <div class="col-6 mb-3">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">Re-Posts:</span>
                                 </div>
                                 <input type="text" class="form-control rounded-0"
                                       name="re_posts" id="re_posts"
                                       value="02" placeholder="Re-Posts">
                              </div>
                              <span class="text-danger error-re_posts"></span>
                        </div>

                     </div>

                     <!-- Footer -->
                     <div class="modal-footer p-0">
                        <button type="submit" class="btn-success-modal">Save</button>
                     </div>
                  </form>


                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script>
        var table = $("#InfluencerReportTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Agent ID"
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
                    data: 'Ref',
                    name: 'Ref',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'Requested',
                    name: 'Requested',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'member_id',
                    name: 'member_id',
                    searchable: true,
                    orderable: false,
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
                    data: 'home_state',
                    name: 'home_state',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'social_media',
                    name: 'social_media',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'approved',
                    name: 'approved',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: true,
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
@endpush

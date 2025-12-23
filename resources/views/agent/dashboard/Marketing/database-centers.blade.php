@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex align-items-center justify-content-between col-md-12">
                  <div class="custom-heading-wrapper">
                     <h1 class="h1">Database (Centres)</h1>
                     <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
                  </div>
                  @if (request('from') !== 'sidebar')
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
                            <li>The Database lists all Massage Centres within your Territory.
                            </li>
                            <li>You can undertake a search:</li>
                            <ol class="level-2">
                                <li>according to your preference; and</li>
                                <li>to group Massage Centres according to the post code.</li>
                            </ol>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-10">
                <div class="mb-2 d-flex align-items-center justify-content-between flex-wrap gap-10">
                    <div class="total_listing">
                        <div><span>Active Post Codes : </span></div>
                        <div><span class="totalInprogressTask">12</span></div>
                    </div>
                    <div class="total_listing">
                        <div><span>Total Centres : </span></div>
                        <div><span class="totalCompletedTask">624</span></div>
                    </div>
                </div>
                <div class="text-center  d-flex justify-content-end align-items-center gap-10 flex-wrap">

                    <span class="mr-2  font-weight-bold">Status:</span>
                    <span class="d-flex justify-content-start gap-5 align-items-center">Appointed <i
                            class="fas fa-circle status-appointed mr-2"></i></span>
                    <span class="d-flex justify-content-start gap-5 align-items-center">Active <i
                            class="fas fa-circle status-active mr-2"></i></span>

                    <span class="d-flex justify-content-start gap-5 align-items-center">Open <i
                            class="fas fa-circle status-open mr-2"></i></span>
                    <span class="d-flex justify-content-start gap-5 align-items-center">Unavailable <i
                            class="fas fa-circle status-unavailable "></i></span>

                </div>
            </div>
            <div class="col-lg-12">
                <!-- Main DataTable (Your Reports Table) -->
                <div class="table-responsive-xl">
                    <table class="table mb-3" id="data_center_table">
                        <thead class="table-bg">
                            <tr>
                                <th>Status</th>
                                <th>Business Name</th>
                                <th>Address</th>
                                <th>Post Code</th>
                                <th>Mobile Number</th>
                                <th>Business Number</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <i class="fas fa-circle status-open mr-2"></i></td>
                                <td>Body Heat
                                    Massage</td>
                                <td>62 Gordon Rd East Osborne Park</td>
                                <td>6017</td>
                                <td>0456 665 012</td>
                                <td>9236 2587</td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#view_data_center" data-toggle="modal"> <i
                                                    class="fa fa-eye"></i>
                                                View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-target="#edit_data_center" data-toggle="modal"> <i
                                                    class="fa fa-pen"></i>
                                                Edit</a>

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




    {{-- Modal: Edit database Centre --}}
    <div class="modal fade upload-modal" id="edit_data_center" tabindex="-1" aria-labelledby="edit_data_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="Edit Centre">
                        Edit Database Centre
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <form>
                        <div class="row">

                            <!-- Access Granted -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status"
                                                checked>
                                            <label class="form-check-label" for="status">Appointed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status"
                                                value="status">
                                            <label class="form-check-label" for="status">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status"
                                                value="status">
                                            <label class="form-check-label" for="status">Open</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status"
                                                value="status">
                                            <label class="form-check-label" for="status">Unavailable</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subtle line -->
                        <hr class="my-3" style="border-top: 1px solid #e0e0e0;">

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Entity Name -->
                                <div class="form-group">
                                    <label for="Display Name">Business Name

                                    </label>

                                    <input type="text" class="form-control" value="Abc Wellness Centre">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Address -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="1">123 Main Street, Mumbai</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Post Code-->
                                <div class="form-group">
                                    <label>Post Code</label>
                                    <input type="text" class="form-control" value="6017">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="contact@abcwellness.com">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Mobile No. -->
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="tel" class="form-control" value="+91 0456 665 012">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Business No.</label>
                                    <input type="text" class="form-control" value="9236 2587">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Website -->
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control" value="www.info.com">
                                </div>
                            </div>
                        </div>

                        <!-- Footer Buttons -->
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn-success-modal ml-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="view_data_center" tabindex="-1" aria-labelledby="view_data_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="View Centre">
                        Database Centre Summary
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body" style="max-height: 50vh; overflow-y: auto;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Status</th>
                                <td>Appointed</td>
                            </tr>
                            <tr>
                                <th>Business Name </th>
                                <td>Abc Wellness Centre</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>123 Main Street, Mumbai</td>
                            </tr>
                            <tr>
                                <th>Post Code</th>
                                <td>6017</td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td>0456 665 012</td>
                            </tr>
                            <tr>
                                <th>Business Number</th>
                                <td>0436 258 037</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>contact@abcwellness.com</td>
                            </tr>
                            <tr>
                                <th>Website</th>
                                <td>www.info.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn-success-modal">Print</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            // Init DataTable
            var table = $("#data_center_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Member ID"
                },
                processing: false,
                serverSide: false,
                paging: true,
                lengthChange: false,
                searching: false, // disable default search
                bStateSave: true,
                ordering: false,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10
            });
        });
    </script>
@endpush

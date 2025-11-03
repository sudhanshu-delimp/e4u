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
                    <!-- Page Heading -->
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Manage Staff </h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class=" col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Create and manage Staff here.</li>
                                    <li>Set the security level for Staff as well as granting access.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel with-nav-tabs panel-warning">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab3warning">
                                        <div class="row pb-3">

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="bothsearch-form" style="gap: 10px;">
                                                    <button type="button" class="btn-common mr-0" data-toggle="modal"
                                                        data-target="#addStaffnew">Add New Staff Member</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive-xl">
                                            <table class="table mb-3" id="staffTable">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th scope="col">
                                                            Staff ID

                                                        </th>
                                                        <th scope="col">
                                                            Staff Member

                                                        </th>
                                                        <th scope="col">
                                                            Security Level
                                                        </th>
                                                        <th scope="col">
                                                            Position
                                                        </th>
                                                        <th scope="col">
                                                            Mobile
                                                        </th>
                                                        <th scope="col">
                                                            Email
                                                        </th>
                                                        <th scope="col">
                                                            Total
                                                            Logins
                                                        </th>
                                                        <th scope="col">
                                                            Last Login
                                                        </th>

                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-content">
                                                    <tr>
                                                        <td width="10%" class="theme-color">S60001</td>
                                                        <td class="theme-color">Binny John</td>
                                                        <td class="theme-color">1</td>
                                                        <td class="theme-color">Managing Director</td>
                                                        <td class="theme-color">0438 028 728</td>
                                                        <td class="theme-color">Binny@john.com.au </td>
                                                        <td class="theme-color">1,999</td>
                                                        <td class="theme-color">20-05-2025 09:12 am </td>
                                                        <td>
                                                            <div class="dropdown no-arrow ml-3">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink" style="">
                                                                    <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#ViewStaffAccount"> <i
                                                                            class="fa fa-eye "></i> View Account</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#"> <i class="fa fa-ban"></i>
                                                                        Suspend</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-target="#updateStaff"
                                                                        data-toggle="modal"> <i class="fa fa-pen"></i> Edit
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot class="bg-first">
                                                    <tr>
                                                        <th colspan="3" class="text-left">Server time: <span
                                                                class="serverTime">{{ getServertime() }}</span></th>
                                                        <th colspan="3" class="text-center">Refresh time: <span
                                                                class="refreshSeconds"> 15</span></th>
                                                        <th colspan="3" class="text-right">Up time: <span
                                                                class="uptimeClass">{{ getAppUptime() }}</span></th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                    </div>

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
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- add new staff member popupform -->
    <div class="modal fade upload-modal" id="addStaffnew" tabindex="-1" role="dialog" aria-labelledby="addStaffnewLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffnewTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Add New Staff
                        Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="add_staff" method="POST" action="{{ route('admin.add-staff') }}"
                        enctype="multipart/form-data">
                        <div class="row">
                            <!-- Section: Personal Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Full Name"
                                    name="name" id="name">
                                     <span class="text-danger error-name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Address" 
                                    name="address" id="address">
                                    <span class="text-danger error-address"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Phone" 
                                    name="phone" id="phone">
                                    <span class="text-danger error-phone"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" class="form-control rounded-0" placeholder="Private Email"
                                    name="email" id="email">
                                     <span class="text-danger error-email"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control" name="gender" id="gender">
                                  <option value="">Select Gender</option>
                                    @foreach (config('escorts.profile.genders') as $key => $gender)
                                        <option value="{{ $key }}">{{ $gender }}</option>
                                    @endforeach
                                </select>
                                 <span class="text-danger error-genders"></span>
                            </div>

                            <!-- Next of Kin Section -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text"  name="kin_name" id="kin_name" class="form-control rounded-0"
                                    placeholder="Kin of Name">
                                     <span class="text-danger error-kin_name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text"  name="kin_relationship" id="kin_relationship" class="form-control rounded-0"
                                    placeholder="Relationship">
                                     <span class="text-danger error-kin_relationship"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text"  name="kin_mobile" id="kin_mobile" class="form-control rounded-0"
                                    placeholder="Mobile">
                                     <span class="text-danger error-kin_mobile"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" name="kin_email" class="form-control rounded-0"
                                    placeholder="Email (optional)">
                                    <span class="text-danger error-kin_email"></span>
                            </div>

                            <!-- Section: Other Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text"  name="position" id="position" class="form-control rounded-0" placeholder="Position">
                                 <span class="text-danger error-position"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0"  name="select_city">
                                    <option>Select Location</option>
                                    <option>Delhi</option>
                                    <option>Mumbai</option>
                                    <option>Bangalore</option>
                                    <!-- Add more cities as needed -->
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text"  name="commenced_date" id="commenced_date" class="form-control rounded-0"
                                    placeholder="Commenced Date (DD/MM/YYYY)" onfocus="(this.type='date')"
                                    onblur="if(this.value==''){this.type='text'}">
                                    <span class="text-danger error-commenced_date"></span>

                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0"  name="level" id="level">
                                    <option value="">Security Level</option>
                                    <option value="Level-1">Level 1</option>
                                    <option value="Level-2">Level 2</option>
                                    <option value="Level-3" selected>Level 3</option>
                                    <option value="Level-4">Level 4</option>
                                </select>
                                <span class="text-danger error-level"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="employment_status" id="employment_status">
                                   <option value="">Select Employment Status</option>
                                    @foreach (config('staff.employment_status') as $key => $empStatus)
                                        <option value="{{ $key }}">{{ $empStatus }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-employment_status"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="employment_agreement" id="employment_agreement" >
                                    <option value="">Employment Agreement?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="text-danger error-employment_agreement"></span>
                            </div>

                            <!-- Section: Building Security -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
                            </div>

                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0"  name="building_access_code" id="building_access_code">
                                    <option value="">Access Code Provided?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="text-danger error-building_access_code"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0"  name="keys_issued" id="keys_issued">
                                    <option value="">Key Provided?</option>
                                   <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                 <span class="text-danger error-keys_issued"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0" name="car_parking" id="car_parking">
                                    <option value="">Car Park?</option>
                                   <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                 <span class="text-danger error-car_parking"></span>
                            </div>

                        </div>
                        <div class="modal-footer p-0 pl-2 pb-4">
                            <button type="submit" class="btn-success-modal mr-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->


    <!-- update staff member popupform -->
    <div class="modal fade upload-modal" id="updateStaff" tabindex="-1" role="dialog"
        aria-labelledby="updateStaffLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStaff"> <img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Update Staff
                        Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <!-- Section: Personal Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Full Name" 
                                    value="Binny John" name="staff_f_name">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Address" 
                                    value="123 Street Name, City" name="staff_address">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Mobile" 
                                    value="0412 345 678" name="staff_phone">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" class="form-control rounded-0" placeholder="Private Email" 
                                    value="binny@example.com" name="staff_email">
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0"  name="staff_gender">
                                    <option>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option selected value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Next of Kin Section -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text"  name="emr_name" class="form-control rounded-0"
                                    value="Alice John" placeholder="Name">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text"  name="emr_relation" class="form-control rounded-0"
                                    value="Wife" placeholder="Relationship">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text"  name="emr_phone" class="form-control rounded-0"
                                    value="0412 765 432" placeholder="Mobile">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" name="emr_email" class="form-control rounded-0"
                                    value="alice@example.com" placeholder="Email (optional)">
                            </div>

                            <!-- Section: Other Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text"  name="position" class="form-control rounded-0"
                                    value="Security Officer" placeholder="Position">
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0"  name="select_city">
                                    <option>Select Location</option>
                                    <option selected>Delhi</option>
                                    <option>Mumbai</option>
                                    <option>Bangalore</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text"  name="commenced_date" class="form-control rounded-0"
                                    value="2023-08-15" placeholder="Commenced Date (DD/MM/YYYY)"
                                    onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0"  name="select_level">
                                    <option value="Level-1">Level 1</option>
                                    <option value="Level-2">Level 2</option>
                                    <option value="Level-3" selected>Level 3</option>
                                    <option value="Level-4">Level 4</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="emp_status" >
                                    <option>Select Employment Status</option>
                                    <option value="Full-Time" selected>Full Time</option>
                                    <option value="Part-Time">Part Time</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Contractor">Contractor</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="agreement" >
                                    <option>Employment Agreement?</option>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Section: Building Security -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
                            </div>

                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0"  name="code">
                                    <option>Access Code Provided?</option>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0"  name="key">
                                    <option>Key Provided?</option>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0"  name="car_parking">
                                    <option>Car Park?</option>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer p-0 pl-2 pb-4">
                            <button type="button" class="btn-success-modal mr-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->


    <!-- View Staff Member popupform -->
    <div class="modal fade upload-modal" id="ViewStaffAccount" tabindex="-1" role="dialog"
        aria-labelledby="ViewStaffAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content basic-modal">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="ViewStaffAccountLabel">
                        <img src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">
                        View Staff Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body custom-modal-height">
                    <div class="row">
                        <div class="col-12">

                            <div class="card mb-3 p-3">
                                <!-- Avatar + Name -->
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar"
                                        class="rounded-circle mr-3" width="50" height="50">
                                    <h6 class="mb-0">Binny John</h6>
                                </div>
                                <!-- Personal Details -->
                                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Address</th>
                                        <td>123 Street Name, City</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>0412 345 678</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>binny@example.com</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>Female</td>
                                    </tr>
                                </table>

                                <!-- Next of Kin -->
                                <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Name</th>
                                        <td>Alice John</td>
                                    </tr>
                                    <tr>
                                        <th>Relationship</th>
                                        <td>Wife</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>0412 765 432</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>alice@example.com</td>
                                    </tr>
                                </table>

                                <!-- Other Details -->
                                <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Position</th>
                                        <td>Security Officer</td>
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        <td>Delhi</td>
                                    </tr>
                                    <tr>
                                        <th>Commenced Date</th>
                                        <td>2023-08-15</td>
                                    </tr>
                                    <tr>
                                        <th>Level</th>
                                        <td>Level 3</td>
                                    </tr>
                                    <tr>
                                        <th>Employment Status</th>
                                        <td>Full Time</td>
                                    </tr>
                                    <tr>
                                        <th>Agreement</th>
                                        <td>Yes</td>
                                    </tr>
                                </table>

                                <!-- Building Security -->
                                <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Access Code Provided?</th>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Key Provided?</th>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Car Park?</th>
                                        <td>Yes</td>
                                    </tr>
                                </table>

                                <!-- Footer Buttons -->
                                <div class="d-flex justify-content-end mb-2">
                                    <button class="btn-success-modal d-block mr-2" onclick="window.print();">
                                        <i class="fa fa-print text-white"></i> Print
                                    </button>
                                    <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                        aria-label="Close">
                                        Close
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end -->

@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}
                "></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#staffTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
                language: {
                    search: "Search:",
                    searchPlaceholder: "Search by Staff ID or Name..."
                },
                columnDefs: [{
                        orderable: false,
                        targets: -1
                    } // Disable ordering on Action column
                ]
            });

        });

        $(document).ready(function(e) {
            // ajaxReload();
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {
                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });

            $(document).on('submit', 'form[name="add_staff"]', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Staff Details'
                });
                //  return false

                $.ajax({
                    url: "{{ route('admin.add-staff') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#addStaffnew').modal('hide');
                        swal_success_popup(response.message);
                    },
                    error: function(xhr) {

                        Swal.close();
                        console.log(xhr);
                        if (xhr.status === 422) {
                            $('span.text-danger').text('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });
                        } else {
                            swal_error_popup(xhr.responseJSON.message ||
                                'Something went wrong');
                        }
                    }
                });
            });

        });
    </script>
@endpush

@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .select2-container .select2-choice, .select2-result-label {
    font-size: 1.5em;
    height: 52px !important;
    overflow: auto;
    }
    .select2-arrow, .select2-chosen {
    padding-top: 6px;
    }
    span.select2.select2-container.select2-container--default > span.selection > span {
    height: 52px !important;
    }
</style>
@endsection
@section('content')
<div id="wrapper">
     <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid" id="replace-item">
                <!--middle content-->
                <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <!-- Begin Page Content -->
                        <div class="container-fluid" style="padding: 0px 0px;">
                            <!-- Page Heading -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="v-main-heading h3">Advertiser List</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <form class="search-form-bg navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn-right-icon" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="bothsearch-form">
                                        <button type="button" class="btn btn-primary create-tour-sec dctour" onclick="window.print();return false;">Print Report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid --><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body pb-0">
                                        <p class="mb-1"><b>Notes</b> </p>
                                        <ol class="pl-4">
                                            <li style="font-size: 15px;">You can access all of your Advertisers here.  The report 'Earnings' column is Commission paid to you by E4U according to the Advertiser's spend.</li>
                                            <li style="font-size: 15px;" class="mb-0">Click the 'Action' button and select from the range of options available to you including Messaging to an Advertiser.</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="panel with-nav-tabs panel-warning">
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active show" id="tab1warning">
                                                <div class="table-responsive-xl" id="table-sec">
                                                    <table class="table" id="myAdvertisersList">
                                                        <thead class="table-bg">
                                                            <tr>
                                                                <th scope="col">Member ID
                                                                </th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Mobile</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Contact</th>
                                                                <th scope="col">Home State</th>
                                                                <th scope="col">Date Engage</th>
                                                                <th scope="col">Appointed</th>
                                                                <th scope="col">Earnings</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-content">
                                                            <tr class="row-color">
                                                                <td class="theme-color">E03153</td>
                                                                <td class="theme-color">Carla</td>
                                                                <td class="theme-color">09876543210</td>
                                                                <td class="theme-color">demo@gmail.com</td>
                                                                <td class="theme-color">Mobile</td>
                                                                <td class="theme-color">WA</td>
                                                                <td class="theme-color">19/02/2022</td>
                                                                <td class="theme-color">25/02/2022</td>
                                                                <td class="theme-color">$200</td>
                                                                <td class="theme-color">
                                                                    <div class="dropdown no-arrow">
                                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                        </a>
                                                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                            <a class="dropdown-item" id="manage-profile" href="#">Manage Profile</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" id="manage-tour" href="#">Manage Tour</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Manage Media</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#" id="manage-concierge">Manage Concierge &amp; Services</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">Print Report</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination float-right pt-4">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" aria-label="Previous">
                                                                <span aria-hidden="true">«</span>
                                                                <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" aria-label="Next">
                                                                <span aria-hidden="true">»</span>
                                                                <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--middle content end here-->
                    <!--right side bar start from here-->
                </div>
                <!--right side bar end-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="Tour_Name" tabindex="-1" role="dialog" aria-labelledby="Tour_NameLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="Tour_Name">Create New Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <div class="form-group">
                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Tour Name">
                </div>
                <div id="accordion" class="myacording-design">
                    <div class="card">
                        <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour" aria-expanded="false">Western Australia</a> </div>
                        <div class="collapse show" data-parent="#accordion" id="new_tour">
                            <div class="card-body border-0 p-0 mt-4">
                                <div class="form-group">
                                    <select class="custom-select">
                                        <option selected="">Select Location</option>
                                        <option>Adelaide</option>
                                        <option>Brisbane</option>
                                        <option>Canberra</option>
                                        <option>Darwin</option>
                                        <option>Hobart</option>
                                        <option>Melbourne</option>
                                        <option>Perth</option>
                                        <option>Sydney</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                                    </div>
                                    <div class="col">
                                        <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3 pr-0">
                                        <label class="pt-1">Assign Profile</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                        <select class="custom-select">
                                            <option selected="">Select Profile</option>
                                            <option>Adelaide</option>
                                            <option>Brisbane</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="accordion" class="myacording-design">
                    <div class="card">
                        <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour-2" aria-expanded="false">Western Australia</a> </div>
                        <div class="collapse" data-parent="#accordion" id="new_tour-2">
                            <div class="card-body border-0 p-0 mt-4">
                                <div class="form-group">
                                    <select class="custom-select">
                                        <option selected="">Select Location</option>
                                        <option>Adelaide</option>
                                        <option>Brisbane</option>
                                        <option>Canberra</option>
                                        <option>Darwin</option>
                                        <option>Hobart</option>
                                        <option>Melbourne</option>
                                        <option>Perth</option>
                                        <option>Sydney</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                                    </div>
                                    <div class="col">
                                        <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3 pr-0">
                                        <label class="pt-1">Assign Profile</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                        <select class="custom-select">
                                            <option selected="">Select Profile</option>
                                            <option>Adelaide</option>
                                            <option>Brisbane</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation mb-3" data-count="1">Add Location <i class="fa fa-fw fa-plus text-white"></i> </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal">Edit Tour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <div class="form-group">
                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Tour Name">
                </div>
                <div id="accordion" class="myacording-design">
                    <div class="card">
                        <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour" aria-expanded="false">Western Australia</a> </div>
                        <div class="collapse show" data-parent="#accordion" id="new_tour">
                            <div class="card-body border-0 p-0 mt-4">
                                <div class="form-group">
                                    <select class="custom-select">
                                        <option selected="">Select Location</option>
                                        <option>Adelaide</option>
                                        <option>Brisbane</option>
                                        <option>Canberra</option>
                                        <option>Darwin</option>
                                        <option>Hobart</option>
                                        <option>Melbourne</option>
                                        <option>Perth</option>
                                        <option>Sydney</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                                    </div>
                                    <div class="col">
                                        <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-3 pr-0">
                                        <label class="pt-1">Assign Profile</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                        <select class="custom-select">
                                            <option selected="">Select Profile</option>
                                            <option>Adelaide</option>
                                            <option>Brisbane</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation mb-3" data-count="1">Add Location <i class="fa fa-fw fa-plus text-white"></i> </button>
            </div>
        </div>
    </div>
</div>
@include('agent.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   $(document).ready(function(){
      $("#manage-profile").click(function(){
            $("#replace-item").replaceWith
            ('<div class="container-fluid"><div class="row"><div class="col-sm-10 col-md-10 col-lg-10"><div class="container-fluid" style="padding:0"><nav aria-label="breadcrumb"><ol class="breadcrumb bread-sec pl-0"><li class="breadcrumb-item"><a href="#" style=""><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li><li class="breadcrumb-item active" aria-current="page">to Advertiser list</li></ol></nav><div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 font-weight-bold">Manage Profile (Jane Power)</h1></div><div class="row"><div class="col-lg-4 col-md-12 col-sm-12"><form class="search-form-bg navbar-search"><div class="input-group"><input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn-right-icon" type="button"><i class="fas fa-search fa-sm"></i></button></div></div></form></div><div class="col-lg-8 col-md-12 col-sm-12"><div class="bothsearch-form"><button type="button" class="btn btn-primary create-tour-sec dctour">Create New Profile</button></div></div></div></div><br><div class="row"><div class="col-md-12"><div class="panel with-nav-tabs panel-warning"><div class="panel-body"><div class="tab-content"><div class="tab-pane fade in active show" id="tab1warning"><div class="table-responsive-xl"id="table-sec"><table class="table" id="onlyEscortList"><thead class="table-bg"><tr><th scope="col">Profile Name</th><th scope="col">Mobile Number</th><th scope="col">Type</th><th scope="col">Membership</th><th scope="col">Home State</th><th scope="col">Age</th><th scope="col">Vaccine</th><th scope="col">Action</th></tr></thead><tbody class="table-content"><tr class="row-color"><td><img src="{{ asset('assets/app/img/profile-image.png')}}">Kathryn Murphy</td><td class="theme-color">0434043981</td><td class="theme-color">Female</td><td class="theme-color">Gold</td><td class="theme-color">SA</td><td class="theme-color">25</td><td class="theme-color">Vaccinated, up to date</td><td class="theme-color"><div class="dropdown no-arrow"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item" id="manage-profile" href="#">Edit Profile</a><div class="dropdown-divider"></div><a class="dropdown-item" href="#">Delete Profile</a></div></div></td></tr></tbody></table><nav aria-label="Page navigation example"><ul class="pagination float-right pt-4"><li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li><li class="page-item"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li></ul></nav></div></div></div></div></div></div></div></div></div></div>');
      });

        $("#manage-tour").click(function(){
            $("#replace-item").replaceWith
            ('<div class="container-fluid"><div class="row"><div class="col-sm-10 col-md-10 col-lg-10"><div class="container-fluid" style="padding:0"><nav aria-label="breadcrumb"><ol class="breadcrumb bread-sec pl-0"><li class="breadcrumb-item"><a href="#" style=""><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li><li class="breadcrumb-item active" aria-current="page">to Advertiser list</li></ol></nav><div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 font-weight-bold">Manage Profile (Jane Power)</h1></div><div class="row"><div class="col-lg-4 col-md-12 col-sm-12"><form class="search-form-bg navbar-search"><div class="input-group"><input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn-right-icon" type="button"><i class="fas fa-search fa-sm"></i></button></div></div></form></div><div class="col-lg-8 col-md-12 col-sm-12"><div class="bothsearch-form"><button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Tour_Name">Create New Tour 4</button></div></div></div></div><br><div class="row"><div class="col-md-12"><div class="panel with-nav-tabs panel-warning"><div class="panel-body"><div class="tab-content"><div class="tab-pane fade in active show" id="tab1warning"><div class="table-responsive-xl" id="table-sec"><table class="table" id=""><thead class="table-bg"><tr><th scope="col">Escort Name</th><th scope="col">Profile Name</th><th scope="col">Tour Name</th><th scope="col">Days</th><th scope="col">Total Cost<sup>(1)</sup></th><th scope="col">Action</th></tr></thead><tbody class="table-content"><tr class="row-color"><td><img src="{{ asset('assets/app/img/profile-image.png')}}">Kathryn Murphy</td><td class="theme-color">Kathy -Adelaide 1</td><td class="theme-color">Summer Tour</td><td class="theme-color">10</td><td class="theme-color">$80.00</td><td class="theme-color"><div class="dropdown no-arrow"><a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a><div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style=""><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Edit Tour</a><div class="dropdown-divider"></div><a class="dropdown-item" href="#">Delete Tour</a></div></div></td></tr></tbody></table><nav aria-label="Page navigation example"><ul class="pagination float-right pt-4"><li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li><li class="page-item"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li></ul></nav></div></div></div></div></div></div></div></div></div></div>');
        });

        $("#manage-concierge").click(function(){
            $("#replace-item").replaceWith
            ('<div class="container-fluid pl-3 pl-lg-5"><!--middle content start here--><!--middle content--><div class="row"><div class="col-sm-12 col-md-12 col-lg-12 "><!-- Begin Page Content --><div class="container-fluid p-0"><!-- Page Heading --><div class="col-md-12 p-0"><nav aria-label="breadcrumb"><ol class="breadcrumb bread-sec pl-0"><li class="breadcrumb-item"><a href="#" style=""><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li><li class="breadcrumb-item active" aria-current="page">to Advertiser list</li></ol></nav> <div class="d-sm-flex align-items-center justify-content-between mb-4"><h1 class="h3 mb-0 font-weight-bold">Concierge &amp; Services</h1></div></div><p>Escorts4U has partnered with Condom Man ) to offer a delivery service to the door, within the Perth CBD, and Express Post to other capital cities.</p><div class="d-sm-flex align-items-center justify-content-between mb-1 mt-4"><h3><b>Partnership</b></h3></div><p>Escorts4U has partnered with Condom Man ) to offer a delivery service to the door, within the Perth CBD, and Express Post to other capital cities.</p> <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-4"><h3><b>Ordering Products</b></h3></div><p><b>Please ensure:</b></p><ul class="product-list"><li>Your order is complete and the details are correct</li><li>There is access to your stay</li><li>You have you mobile nearby. We will call you 5 minutes out</li><li>You have the exact cash to pay for your order</li></ul></div><!-- /.container-fluid --><br></div><!--middle content end here--><!--right side bar start from here--></div><div class="row"><div class="col-lg-6 col-sm-12 col-md-12"><form action="" class="ordingring-products"><div><input class="form-check-input ml-0" type="checkbox" value="" id="flexCheckDefault">&nbsp; <label for="html">Condom</label></div><div><input class="form-check-input ml-0" type="checkbox" value="" id="flexCheckDefault">&nbsp; <label for="css">Lubricants</label></div>&nbsp; <div><input class="form-check-input ml-0" type="checkbox" value="" id="flexCheckDefault">&nbsp; <label for="javascript">Massage Oil</label></div>&nbsp; </form></div></div><div class="row mt-4"><div class="col-md-12"><div class="table-responsive-xl"><table class="table"><thead class="table-bg"><tr><th scope="col">Product </th><th scope="col">Code</th><th scope="col">Description </th><th scope="col">Unit Price</th><th scope="col">Qty</th><th scope="col">Total </th></tr></thead><tbody class="table-content"><tr class="row-color"><td class="theme-color"><div class="form-check d-flex align-items-center"><input class="form-check-input mr-2" type="checkbox" value="" id="flexCheckDefault"><label class="form-check-label" for="flexCheckDefault"></label><img src="{{ asset('assets/app/img/condom.png')}}"></div></td><td class="theme-color">FSCF</td><td class="theme-color"><b>Four Seasons - Close Fitting</b><br>Naked closer fitting condoms for a secure fit with less chance of slipping off during the experience.<br><b>QTY: 144 Size: 49mm</b></td><td class="theme-color">$ 40.00</td><td class="theme-color qty"><form action=""><select name="cars" id="cars"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></form></td><td class="theme-color">$ 80.00</td></tr><tr class="row-color"><td class="theme-color"><div class="form-check d-flex align-items-center"><input class="form-check-input mr-2" type="checkbox" value="" id="flexCheckDefault"><label class="form-check-label" for="flexCheckDefault"></label><img src="{{ asset('assets/app/img/condom.png')}}"></div></td><td class="theme-color">FSCF</td><td class="theme-color"><b>Four Seasons - Close Fitting</b><br>Naked closer fitting condoms for a secure fit with less chance of slipping off during the experience.<br><b>QTY: 144 Size: 49mm</b></td><td class="theme-color">$ 40.00</td><td class="theme-color qty"><form action=""><select name="cars" id="cars"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></form></td><td class="theme-color">$ 80.00</td></tr><tr class="total-bg"><td class="theme-color">Total All </td><td class="theme-color"></td><td class="theme-color"></td><td class="theme-color"></td><td class="theme-color qty"></td><td class="theme-color">$ 160.00</td></tr></tbody></table></div></div></div><div class="row mt-5"><div class="col-lg-6 col-sm-12 col-md-12 left-sidebar-bg"><form action=""><div id="accordion" class="myacording-design mb-5"><div class="card"><div class="card-header"><a class="card-link collapsed" data-toggle="collapse" href="#order" aria-expanded="false">Important information about your order and products </a></div><div id="order" class="collapse" data-parent="#accordion" style=""><div class="card-body pb-0"><p><b>Q? Can I change my order?</b></p><p>Yes. Please contact the Condom Man before he arrives to discuss your chnages. There is no guarantee the changes can be met.</p><p><b>Q? Can I return any of the products?</b></p><p>No. Please check the products on delivery. You will be provided with a copy of your order to match up the delivery.</p><p><b>Product Quality</b></p><p>Condom Man can supply everything that you may be looking for to enhance your sex life or to protect yourself, including:</p><ul class="prof-sec"><li>Condoms - all types, sizes, colours &amp; flavours</li><li>Lubricants - all water-based, safe to use with condoms</li><li>Massage Oils - we will advise which ones are suitable to use also as lubricants</li></ul><p>Condom Man only supplys products that are tested and reliable, and conform to the most rigorous testing and Australian standards, such as:</p><ul class="prof-sec"><li>Ansell</li><li>Four Season</li><li>Glyde</li><li>Durex</li><li>"Wet Stuff" from Gel Works</li></ul></div></div></div><div class="card"><div class="card-header"><a class="card-link collapsed" data-toggle="collapse" href="#Confidentiality" aria-expanded="false">Confidentiality </a></div><div id="Confidentiality" class="collapse" data-parent="#accordion" style=""><div class="card-body pb-0"><p><b>Q? Who will see my order?</b></p><p>When you lodge an order, an email is sent directly to Condom Man.</p><p><b>Q? Who will I be discussing my order with?</b></p><p>You will be contacted directly by Condom Man. All conversations will remain confidential between you and Condom Man. Escorts4U does not have any communications with Condom Man regarding your order.</p><p><b>Q? Can I contact Condom Man directly?</b></p><p>Yes. See contact details below.</p></div></div></div><div class="card"><div class="card-header"><a class="card-link collapsed" data-toggle="collapse" href="#contact" aria-expanded="false">Contact details </a></div><div id="contact" class="collapse" data-parent="#accordion" style=""><div class="card-body pb-0"><p>You can contact Condom Man through either of the following methods:</p><p>Condom Man<br>PO Box 1569<br>Bibra Lake DC WA 6965<br></p><p>T: +61 418 957 236<br>E: info@condomman.com.au<br>W: <a target="_blank" href="https://www.condomman.com.au"><span class="theme-text-color">www.condomman.com.au</span></a></p></div></div></div></div></form></div><div class="col-lg-6 col-sm-12 col-md-12 right-sidebar-bg" style="background: none"><div class="d-sm-flex align-items-center justify-content-between mb-3"><h3><b>Ordering Products</b></h3></div><div class="form-row"><div class="col"><label for="number"><b>Mobile Number</b></label><input type="number" class="form-control"></div><div class="col"><label for="email"><b>Email</b></label><input type="text" class="form-control"></div><div class="col-md-12 my-2"><label for="Address"><b>Address</b></label><input type="text" class="form-control"></div><div class="col-md-12 my-1"><label for="Instructions"><b>Any Special Instructions?</b></label><textarea type="textarea" class="form-control" rows="5"></textarea><div class=""><div><input type="radio" id="html1" name="fav_language" value="HTML1"><label for="Delivery"><b>Delivery to the door</b></label><input type="radio" id="css1" name="fav_language" value="CSS1" style="margin-left: 17px;"><label for="Post"><b>Post</b></label><b></b></div><b><div><input type="radio" id="javascript1" name="fav_language" value="JavaScript1"><label for="yourself"><b>CC yourself</b></label></div></b></div><b><div class="d-flex justify-content-end mr-0"><button type="button" class="bulk-btn">Place Order</button></div></b></div><b></b></div><b><!--right side bar end--></b></div><b></b></div><b><!-- End of Main Content --><!-- Footer --><footer class="sticky-footer bg-white"><div class="container my-auto"><div class="copyright text-center my-auto"><span></span></div></div></footer><!-- End of Footer --></b></div>');
        });


      var id = '8';
      var url = "{{ route('agent.onlyEscort.dataTable',':id') }}";
      url = url.replace(':id',id);
      var table = $('#onlyEscortList').DataTable({
         //$('#').DataTable({
         "language": {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>',

            oPaginate: {
               sNext: '<span aria-hidden="true">»</span>',
               sPrevious: '<span aria-hidden="true">«</span>',
               sFirst: '<span aria-hidden="true">»</span>',
               sLast: '<span aria-hidden="true">»</span>'
            }

         },
         info: false,
         bLengthChange: false,
         processing: true,
         serverSide: true,
         lengthChange: true,
         order: [1,'asc'],
         searchable:false,
         //searching:true,
         bStateSave: false,

         ajax: {
               url: url,
               data: function (d) {
                  d.type = 'player';
               }
         },
         columns: [

            { data: 'pro_name', name: 'pro_name', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'gender', name: 'gender', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'membership', name: 'membership', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'homeState', name: 'homeState', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'age', name: 'age', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'vaccine', name: 'vaccine', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'actionAgentEscortProfile', name: 'actionAgentEscortProfile', searchable: false, orderable:false,defaultContent: 'NA' },
         ]
      });
   });

</script>

@endpush

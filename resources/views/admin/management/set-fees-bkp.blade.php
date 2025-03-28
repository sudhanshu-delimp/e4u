@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
    .swal-button {
    background-color: #242a2c;
    }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">
            <!--middle content-->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <!-- Begin Page Content -->
                    <div class="container-fluid" style="padding: 0px 0px;">
                        <!-- Page Heading -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="v-main-heading h3">Set Pricing - Escort</div>
                        </div>
                        <div class="row ml-1 mb-3">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs tab-sec pb-2">
                                    <li class="active"><a href="#tab1warning" data-toggle="tab" class="active">Advertising</a></li>
                                    <li><a href="#tab2warning" data-toggle="tab" class="">Other Fees & Concierge Services</a></li>
                                    <li><a href="#tab3warning" data-toggle="tab" class="">Discounts</a></li>
                                </ul>
                            </div>
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
                                <div class="bothsearch-form" style="gap: 10px;">
                                    <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Competitor">Set New Pricing</button>
                                    <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Competitor">Create Note</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid --><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                            <div class="table-responsive-xl">
                                                <table class="table">
                                                    <thead class="table-bg">
                                                        <tr>
                                                            <th scope="col">Days</th>
                                                            <th scope="col">Platinum</th>
                                                            <th scope="col">Gold</th>
                                                            <th scope="col">Silver</th>
                                                            <th scope="col">Free</th>
                                                            <th scope="col">Pin-up</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        @foreach( $items as $key => $result)
                                                        @php 
                                                        $price_platinum = $result->where('days',$key)->where('membership_id',1)->first(); 
                                                        $price_gold = $result->where('days',$key)->where('membership_id',2)->first(); 
                                                        $price_silver = $result->where('days',$key)->where('membership_id',3)->first(); 
                                                        $price_free = $result->where('days',$key)->where('membership_id',4)->first(); 
                                                        $price_pinup = $result->where('days',$key)->where('membership_id',5)->first(); 
                                                        
                                                        
                                                        
                                                        @endphp
                                                        <tr class="row-color">
                                                            <td class="theme-color">{{$key}} {{$key ==1 ? 'day': 'days'}}</td>
                                                           
                                                            <td class="theme-color">{{ $price_platinum['price'] }}</td>
                                                            <td class="theme-color">{{$price_gold['price']}}</td>
                                                            <td class="theme-color">{{$price_silver['price']}}</td>
                                                            <td class="theme-color">{{$price_free['price']}}</td>
                                                            <td class="theme-color">{{$price_pinup['price']}}</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                    @endforeach
                                                        {{-- <tr class="row-color">
                                                            <td class="theme-color">1 day</td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td class="theme-color">50.00</td>
                                                            <td class="theme-color">--</td>
                                                            <td class="theme-color">150.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color">1 day</td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td class="theme-color">50.00</td>
                                                            <td class="theme-color">--</td>
                                                            <td class="theme-color">150.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color">1 day</td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td class="theme-color">50.00</td>
                                                            <td class="theme-color">--</td>
                                                            <td class="theme-color">150.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color">1 day</td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td class="theme-color">50.00</td>
                                                            <td class="theme-color">--</td>
                                                            <td class="theme-color">150.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-5">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ul style="list-style: auto;">
                                                                <li>this is a sample notes </li>
                                                                <li>the quick brown fox jumps over the lazy dog</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2warning">
                                            <div class="table-responsive-xl">
                                                <table class="table">
                                                    <thead class="table-bg">
                                                        <tr>
                                                            <th scope="col">Service Type(1)</th>
                                                            <th scope="col">Fee</th>
                                                            <th scope="col">Frequency</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td class="theme-color"><b>Platinum</b></td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color"><b>Gold</b></td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color"><b>Silver</b></td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-5">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ul style="list-style: auto;">
                                                                <li>this is a sample notes </li>
                                                                <li>the quick brown fox jumps over the lazy dog</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab3warning">
                                            <div class="table-responsive-xl">
                                                <table class="table">
                                                    <thead class="table-bg">
                                                        <tr>
                                                            <th scope="col">Service Type(1)</th>
                                                            <th scope="col">Fee</th>
                                                            <th scope="col">Frequency</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td class="theme-color"><b>Platinum</b></td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color"><b>Gold</b></td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td class="theme-color"><b>Silver</b></td>
                                                            <td class="theme-color">90.00</td>
                                                            <td class="theme-color">60.00</td>
                                                            <td>
                                                                <div class="dropdown no-arrow ml-3">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Edit <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-5">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ul style="list-style: auto;">
                                                                <li>this is a sample notes </li>
                                                                <li>the quick brown fox jumps over the lazy dog</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
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
    <!-- End of Main Content -->
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
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<div class="modal fade upload-modal" id="Competitor" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Competitor">Set New Pricing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="set-price modal-body">
                <form>
                    <div class="row">
                        <div class="col-2 mb-3 pl-0 pr-0">
                            <small class="form-text text-muted pb-2">--</small>
                            <select class="form-control rounded-0 p-1 select-section">
                                <option style="
                                    ">Set Day(s)</option>
                            </select>
                        </div>
                        <div class="col-2 mb-3 pr-0">
                            <small class="form-text text-muted pb-2">Platinum:</small>
                            <input type="text" class="form-control rounded-0" placeholder="$0.00">
                        </div>
                        <div class="col-2 mb-3 pr-0">
                            <small class="form-text text-muted pb-2">Gold</small>
                            <input type="text" class="form-control rounded-0" placeholder="$0.00">
                        </div>
                        <div class="col-2 mb-3 pr-0">
                            <small class="form-text text-muted pb-2">Silver</small>
                            <input type="text" class="form-control rounded-0" placeholder="$0.00">
                        </div>
                        <div class="col-2 mb-3 pr-0">
                            <small class="form-text text-muted pb-2">Free</small>
                            <input type="text" class="form-control rounded-0" placeholder="$0.00">
                        </div>
                        <div class="col-2 mb-3 pr-0">
                            <small class="form-text text-muted pb-2">Pin-up</small>
                            <input type="text" class="form-control rounded-0" placeholder="$0.00">
                        </div>
                    </div>
                    <div id="education_fields">
                    </div>
                    <div class="input-group-btn float-right">
                        <a href="#"><span class="theme-text-color" onclick="education_fields();">Add new Pricing</span></a>
                    </div>
                </form>
            </div>
            <div class="modal-footer p-0 pl-2 pb-4">
                <div class="col-12 mb-3">
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-primary mr-3">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Edit_Competitor">Edit Competitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Competitor Name">
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Competitor Website">
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Rating">
                        </div>
                        <div class="col-6 mb-3">
                            <select class="form-control rounded-0">
                                <option>Choose Home Country</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <select class="form-control rounded-0">
                                <option>Select Home State</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-check-label pr-4" for="exampleCheck1">Entered Data</label>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Completed</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var room = 1;
    function education_fields() {
    
      room++;
      var objTo = document.getElementById('education_fields')
      var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass"+room);
    var rdiv = 'removeclass'+room;
      divtest.innerHTML = '<div class="row"><div class="col-2 mb-3 pl-0 pr-0"><small class="form-text text-muted pb-2">--</small><select class="form-control rounded-0 p-1 select-section"><option>Set Day(s)</option></select></div><div class="col-2 mb-3 pr-0"><small class="form-text text-muted pb-2">Platinum:</small> <input class="form-control rounded-0" placeholder="$0.00"></div><div class="col-2 mb-3 pr-0"><small class="form-text text-muted pb-2">Gold</small> <input class="form-control rounded-0" placeholder="$0.00"></div><div class="col-2 mb-3 pr-0"><small class="form-text text-muted pb-2">Silver</small> <input class="form-control rounded-0" placeholder="$0.00"></div><div class="col-2 mb-3 pr-0"><small class="form-text text-muted pb-2">Free</small> <input class="form-control rounded-0" placeholder="$0.00"></div><div class="col-2 mb-3 pr-0"><small class="form-text text-muted pb-2">Pin-up</small> <input class="form-control rounded-0" placeholder="$0.00"></div></div>';
      
      objTo.appendChild(divtest)
    }
</script>
@endsection
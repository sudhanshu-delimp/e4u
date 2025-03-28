@extends('layouts.userDashboard')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pt-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-9">
            <div class="v-main-heading h3 pt-0 pb-2">Viewer Dashbaord</div>
            <div class="alert alert-info bg-white border-0 shadow" style="border-left: #FFB648 solid 9px !important;">
                <button type="button" aria-hidden="true" class="close"><span aria-hidden="true"><img src="{{ asset('assets/app/img/noti-cross.png')}}" class="img-fluid img_resize_in_smscreen"></span></button>
                <span>You have a pending activity</span>
            </div>
            <div class="alert alert-info bg-white border-0 shadow" style="border-left: #4BDE97 solid 9px !important;">
                <button type="button" aria-hidden="true" class="close"><span aria-hidden="true"><img src="{{ asset('assets/app/img/noti-cross.png')}}" class="img-fluid img_resize_in_smscreen"></span></button>
                <span>In progress</span>
            </div>
            <div class="alert alert-info bg-white border-0 shadow" style="border-left: #5887FF solid 9px !important;">
                <button type="button" aria-hidden="true" class="close"><span aria-hidden="true"><img src="{{ asset('assets/app/img/noti-cross.png')}}" class="img-fluid img_resize_in_smscreen"></span></button>
                <span>Completed</span>
            </div>
            <div class="alert alert-info bg-white border-0 shadow" style="border-left: #FF3C5F solid 9px !important;">
                <button type="button" aria-hidden="true" class="close"><span aria-hidden="true"><img src="{{ asset('assets/app/img/noti-cross.png')}}" class="img-fluid img_resize_in_smscreen"></span></button>
                <span>Please complete your account information</span>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 ">
            <div class="sidebar-box-administrator">
                <h2 class="h4 mb-0 text-gray-800">Favorites online</h2>
                <table class="sidebar-table">
                    <tbody>
                        <tr>
                            <td class="leftside-table">In my location</td>
                            <td class="rightside-table">01</td>
                        </tr>
                        <tr>
                            <td class="leftside-table">Outside my location</td>
                            <td class="rightside-table">01</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="sidebar-box-administrator">
                <h2 class="h4 mb-0 text-gray-800">My Statistics</h2>
                <table class="sidebar-table">
                    <tbody>
                        <tr>
                            <td class="leftside-table">My Recommendation</td>
                            <td class="rightside-table">01</td>
                        </tr>
                        <tr>
                            <td class="leftside-table">Report</td>
                            <td class="rightside-table">01</td>
                        </tr>
                        <tr>
                            <td class="leftside-table">Reviews</td>
                            <td class="rightside-table">01</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--middle content end here-->
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
@endpush
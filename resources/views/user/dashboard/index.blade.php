@extends('layouts.userDashboard')
@section('content')
<div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Viewer Dashbaord</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
               <div class="card-body">
                  <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                  <ol>
                        
                  </ol>
               </div>
            </div>
      </div>
    </div>
    <div class="row">
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.favorites-online') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_favorites.png') }}" alt="Favorites Online">
                    </div>
                    <h2>
                        Favorites Online
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.my-legbox') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_mylegbox.png') }}" alt=" My Legbox">
                    </div>
                    <h2>
                       My Legbox
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.punterbox') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_punterbox.png') }}" alt="Punterbox">
                    </div>
                    <h2>
                        Punterbox
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.viewer-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/viewer-statistics.png') }}" alt="Viewer Statistics">
                    </div>
                    <h2>
                        Viewer Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.my-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-statistics.png') }}" alt="Viewer Statistics">
                    </div>
                    <h2>
                        My Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.task-list') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_tasklist.png') }}" alt="Task List">
                    </div>
                    <h2>
                        Task List
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.logs-and-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_logs-stats.png') }}" alt="Logs & Status">
                    </div>
                    <h2>
                        Logs & Status
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
    </div>

    




    {{-- old code --}}
    <div class="row mt-5 d-none">
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
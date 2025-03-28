@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bread-sec pl-0">
                        <li class="breadcrumb-item"><a href="{{ url('escort-dashboard/view-archives') }}" style="
                            "><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profiles &amp; Archives</li>
                    </ol>
                </nav>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Media </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-2">
                <div class="card archive-sec">
                    <a href="{{route('escort.archive-view-photos')}}">
                        <figure class="figure m-0">
                            <img src="{{ asset('assets/dashboard/img/Vector.png') }}" class="figure-img img-fluid rounded" alt=" ">
                            <figcaption class="figure-caption">
                                <p>Photos</p>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card archive-sec">
                    <a href="{{ route('escort.archive-view-videos')}}">
                        <figure class="figure m-0">
                            <img src="{{ asset('assets/dashboard/img/Vector.png') }}" class="figure-img img-fluid rounded" alt=" ">
                            <figcaption class="figure-caption">
                                <p>Videos</p>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    //$(document).ready( function () {
   
    //} );
 
</script>
@endpush
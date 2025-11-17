<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/app/img/favicon.ico') }}" />

    <title>Viewer Console</title>

    <!-- Custom fonts for this template-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:ital,wght@0,200;0,400;1,200&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/app/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-style.css?v1.5') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-responsive.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/file-upload/css/jquery.fileupload.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/file-upload/css/jquery.fileupload-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/file-upload/css/jquery.fileupload-noscript.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/file-upload/css/jquery.fileupload-ui-noscript.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/app/vendor/file-upload/css/pin.css') }}"/>
    <link href="{{ asset('assets/dashboard/css/fill-profile-details.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
    <!-- google fonts -->
    <!-- font awsome -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/style.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="{{asset('assets/app/css/jquery-ui.css')}}">
    <script src="{{asset('assets/app/js/jquery-ui.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @section('style')
    @show
    <style>
        .inactive_li {
            pointer-events: none; 
            opacity:0.5;
        }
        
    </style>
</head>

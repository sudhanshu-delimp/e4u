<!DOCTYPE html>
<html lang="en-IN">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

     <link rel="shortcut icon" href="{{ asset('assets/app/img/favicon.ico') }}" />
        <title>E4U - Escorts for you</title>

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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript" src="{{ asset('assets/plugins/ajax/libs/jquery/jquery.min.js') }}"></script>


    <link rel="stylesheet" href="{{asset('assets/app/css/jquery-ui.css')}}">
    <script src="{{asset('assets/app/js/jquery-ui.min.js')}}"></script>
   <style>
       /*CSS TO MAKE CALENDER ICON INLINE*/
       .form-group{
           position:relative;
       }
       .ui-datepicker-trigger{
           right: 16px;
           bottom: 20%;
           position: absolute;
       }
       .form-control{
           padding-right:30px!important;
       }

        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            display: none;
        }

         .tooltip-inner {
             border: 1px solid #FF3C5F !important;
         }
        .bs-tooltip-auto[x-placement^=top] .arrow::before, .bs-tooltip-top .arrow::before {
            border-top-color: #FF3C5F;
        }
        .tooltip-inner {
            font-size: 15px;
            padding: 20px 10px;
        }

        ol.ol_lower_alpha_bracket {
            /*counter-reset: list;*/
            padding-left:25px;
        }

        ol.ol_lower_alpha_bracket > li:before {
            content:"(" counter(list, lower-alpha) ") ";
            margin-left:-25px;
        }

        ol.ol_lower_alpha_bracket > li {
            list-style: none;
            counter-increment: list;
        }
    </style>
    @section('style')

    @show
</head>

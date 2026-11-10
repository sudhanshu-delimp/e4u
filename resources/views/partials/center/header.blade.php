<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

     <link rel="shortcut icon" href="{{ asset('assets/app/img/favicon.ico') }}" />
        <title>Massage Centre Console</title>

    <!-- Custom fonts for this template-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:ital,wght@0,200;0,400;1,200&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/app/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-style.css?v1.7') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-responsive.css?v1.3') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/common-style/style.css?v1.04') }}" rel="stylesheet" />
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
   
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @section('style')
    @show


 <style>
    .toogle_eye_form_wrap{
    position: relative;
    }
    .toogle-eye-password {
    position: absolute;
    top: 40px;
    right: 10px;
    cursor: pointer;
    z-index: 2;
    color: #6c757d;
    }

    .hide_element{
        display: none !important;
    }


    
    html, body {
        height: 100%;
        margin: 0;
        overflow: hidden;
    }
        
        #wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        #accordionSidebar {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            flex-shrink: 0;
            z-index: 1030;
        }

       #content-wrapper {
            flex: 1;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        #content {
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }

        .db-custom-topbar {
            flex-shrink: 0;
            margin-bottom: 0 !important;
            /* default margin hataya */
            z-index: 1020;
        }

        #content>.container-fluid {
            flex: 1;
            overflow-y: auto;
            /* Sirf content scroll hoga */
            overflow-x: hidden;
            padding-top: 1.5rem;
            /* Topbar se thoda gap */
            padding-bottom: 2rem;
        }

        
        #accordionSidebar::-webkit-scrollbar,
        #content>.container-fluid::-webkit-scrollbar {
            width: 6px;
        }

        #accordionSidebar::-webkit-scrollbar-thumb,
        #content>.container-fluid::-webkit-scrollbar-thumb {
            background: #0c223da1;
            border-radius: 4px;
        }

       
        @media (min-width: 768px) {

            
            .sidebar {
                transition: width 0.3s ease-in-out !important;
            }

            #content-wrapper {
                transition: width 0.3s ease-in-out, margin 0.3s ease-in-out !important;
            }

            .sidebar.toggled:hover {
                width: 265px !important;
                position: relative !important;
                /* Content ke upar chadhega nahi, use aage khiskayega */
                flex-shrink: 0 !important;
                overflow-y: auto !important;
            }

          .sidebar.toggled:hover .sidebar-brand .sidebar-brand-text {
                display: inline !important;
            }

           .sidebar.toggled:hover .nav-item .nav-link {
                width: 100% !important;
                text-align: left !important;
                padding: 0.5rem 0 0.5rem 1rem !important;
            }

            .sidebar.toggled:hover .nav-item .nav-link span {
                font-size: 15px !important;
                font-weight: 500 !important;
                display: inline !important;
            }
            
            .sidebar.toggled:hover .nav-item .nav-link i,
            .sidebar.toggled:hover .nav-item .nav-link img,
            .sidebar.toggled:hover .nav-item .nav-link svg {
                margin-right: 0.5rem !important;
            }

           .sidebar.toggled:hover .nav-item .nav-link[data-toggle=collapse]::after {
                display: inline-block !important;
                float: right !important;
                margin-right: 1.5rem !important;
            }

           .sidebar.toggled:hover .nav-item .collapse {
                position: relative !important;
                left: 0 !important;
                top: 0 !important;
                margin: 0 1rem !important;
                animation: none !important;
            }

            .sidebar.toggled:hover .nav-item .collapse .collapse-inner {
                box-shadow: none !important;
                border-radius: 0 !important;
                min-width: unset !important;
            }
        }
 </style>
</head>

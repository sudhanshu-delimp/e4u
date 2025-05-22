<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="shortcut icon" href="{{ asset('assets/app/img/favicon.ico') }}" />
        <title>E4U - Escorts for you</title>
        <link rel="stylesheet" href="{{ asset('assets/app/css/bootstrap.min.css') }}">
        <!-- jquery ui cdn -->
        {{-- @php
        $url = ['/acceptable-usage-policy','/cookie-policy','/copyright-statement','/covid-19-statement','/disclaimer-statement','/law-enforcement','/privacy-policy','/refund-policy','/spam-policy','/terms-conditions','/abbreviations','/alerts','/blogs','/contact-us','/etiquette','/faqs','/feedback','/help-for-advertisers','/help-for-agents','/help-for-massage-centres','/help-for-viewers'];
        @endphp
        @if(in_array($_SERVER['REQUEST_URI'],$url))
        <link rel="stylesheet" href="{{ asset('assets/app/css/custom.css') }}"/>
        @endif --}}

        <link rel="stylesheet" href="{{ asset('assets/app/css/jquery-ui.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/app/css/jquery-ui.structure.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">


        <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/dashboard/css/dk-style.css') }}" rel="stylesheet">
        <!-- jquery ui cdn -->

        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
       <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:ital,wght@0,200;0,400;0,500;0,700;1,200&display=swap"
        rel="stylesheet">
        <!-- google fonts -->

        <!-- font awsome -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/shivam-dk-resoponsive.css') }}"> -->
        <title>profile description page</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- jquery ui cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.min.css"/>
        <!-- jquery ui cdn -->
        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
        <!-- google fonts -->
        <!-- font awsome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/style.css?v1.1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/shivam-dk-resoponsive.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
        <script>
        </script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
        @section('style')
        @show

    </head>

<body>

<a id="back-to-top-2" href="#" class="btn btn-light btn-lg back-to-top" style="display: none;" role="button"><img src="{{ asset('assets/img/Vector(23).svg') }}"></a>
<a id="back-to-bottom-2" href="#" class="btn btn-light btn-lg back-to-bottom" style="display: none;" role="button"><img src="{{ asset('assets/img/Vector(23).svg') }}" ></a>
<section class="mx-auto max_width_for_content">

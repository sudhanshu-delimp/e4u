<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Report</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ url('/') . '/' . 'assets/dashboard/vendor/file-upload/css/fill-profile-details.css' }}"
        rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ url('/') . '/' . 'assets/dashboard/css/sb-admin-2.min.css' }}" rel="stylesheet">
    <link href="{{ url('/') . '/' . 'assets/dashboard/css/dk-style.css?v1.4' }}" rel="stylesheet">
    <link href="{{ url('/') . '/' . 'assets/dashboard/css/dk-responsive.css' }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .info-item {
            background: #f8faff;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .info-item label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .info-item span {
            font-size: 15px;
            font-weight: 500;
            color: #000;
        }

        .d-none {
            display: none !important;
        }

        .heading {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1px;
        }

        @page {
            size: A4;
        }

        /* Header */

        .page-number:before {
            content: counter(page);
        }

        .my-account-card {
            background-color: #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            max-width: 100%;
            margin: 0px auto !important;
            padding: 0px !important;
            border-radius: 10px;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
        }

        h6 {
            font-size: 16px;
        }

        .my-account-card .table td {
            vertical-align: middle;
        }


        table td {
            padding: .35rem .75rem .45rem .75rem !important;
        }

        table th {
            padding: .35rem .75rem .45rem .75rem !important;
            font-weight: 500;
            vertical-align: middle;

        }
    </style>
</head>

<body style="margin:0;width:100%">
    @php
        $id = $user->id;
        $businessName = isset($user->shareholder->business_name) ? $user->shareholder->business_name : 'NA';
        $memberId = isset($user->member_id) ? $user->member_id : 'NA';
        $dateOfEntry = isset($user->date_of_entry) ? showDateWithFormat($user->date_of_entry, 'd-m-Y') : 'NA';
        $memberType = isset($user->member_type) ? ucfirst($user->member_type) : 'NA';
        $threshold = isset($user->threshold) ? ucfirst($user->threshold) : 'No';
        $numberOfShares = isset($user->number_of_shares) ? number_format($user->number_of_shares) : 'NA';
        $shareholding = isset($user->shareholding) ? $user->shareholding : 'NA';
        $heldOnTrust = isset($user->held_on_trust) ? ucfirst($user->held_on_trust) : 'NO';
        $deedfile = isset($user->trust_deed_file) ? $user->trust_deed_file : '';

    @endphp
    <div class="container1">

        <div class="col-md-12 ">
            <div class="card mb-3 p-3">
                <div class="my-account-card">
                    <div class="card-head" style="display: flex; justify-content:space-between;align-items:center;">
                        <h2>Shareholding Report</h2>
                    </div>
                    <!-- Avatar + Name -->
                    <div style="margin-left:-10px;">
                        <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar"
                            style="vertical-align:middle; border-radius:50%; margin-right:10px;" width="50"
                            height="50">

                        <h6 style="display:inline-block; vertical-align:middle; margin:0;">
                            {{ $businessName }}
                        </h6>
                    </div>

                    <h6 class=" text-blue-primary">Shareholding Details</h6>
                    <!-- Details Table -->
                    <table class="table table-bordered mb-3">
                        <tr>
                            <th style="width:40%;">Shareholder</th>
                            <td>{{ $businessName }}</td>
                        </tr>
                        <tr>
                            <th>Member ID</th>
                            <td>{{ $memberId }}</td>
                        </tr>
                        <tr>
                            <th>Date of Entry</th>
                            <td>{{ $dateOfEntry }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $memberType }}</td>
                        </tr>
                        <tr>
                            <th>Shares</th>
                            <td>{{ $numberOfShares }}</td>
                        </tr>
                        <tr>
                            <th>Shareholding</th>
                            <td>{{ $shareholding }}%</td>
                        </tr>
                        <tr>
                            <th>Threshold</th>
                            <td>{{ $threshold }}</td>
                        </tr>
                        <tr>
                            <th>Beneficially Held</th>
                            <td>{{ $heldOnTrust }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

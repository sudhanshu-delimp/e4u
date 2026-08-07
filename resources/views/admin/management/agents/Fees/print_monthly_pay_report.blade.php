<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Montly Fee Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-style.css?v1.2') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-responsive.css?v1.2') }}" rel="stylesheet">
    <style>
        .heading {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1px;
        }

        @page {
            size: A4;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
        }

        h6 {
            font-size: 16px;
        }

        .table td {
            vertical-align: middle;
        }

        table td {
            padding: .75rem;
            color: #333 !important;
            font-size: 12px;
        }

        table th {
            padding: .45rem .75rem .55rem !important;
            font-size: 12px;
            font-weight: 500;
            vertical-align: middle;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body style="margin:0;width:100%">
    @php
        $path = public_path('/assets/dashboard/img/auth.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $payAgentId = $reportData['payAgentId'];
        $payMonthlyReportDate = $reportData['payMonthlyReportDate'];
        $payMonthlyReportMonth = $reportData['payMonthlyReportMonth'];
        $payAgenFee = number_format($reportData['payAgenFee'], 2, '.', ''); 
    @endphp    
    <!-- Body -->

        <table class="table mb-0 common_accordian_table" style="background-color:#0c223d;">
            <tr>
                <td style="text-align: left !important;"> <span>
                        <img src="{{ $base64 }}" style="width: 25px;">
                    </span><span
                        style="color:#fff; font-weight:bold;text-align: left !important;padding-top:-20px;font-size: 14px;">Payment
                        Authorisation</span> </td>
            </tr>
        </table>
        <table class="w-100 table common_modal_table" style="padding: 20px 0 0 0;">
            <tr>
                <td style="font-weight: bold; color: #001f4d;">Agent ID:</td>
                <td><span id="payAgentId">{{$payAgentId}}</span></td>
                <td style="font-weight: bold; color: #001f4d;">Date:</td>
                <td><span id="payMonthlyReportDate">{{$payMonthlyReportDate}}</span></td>
            </tr>
            <tr>
                <td style="font-weight: bold; color: #001f4d;">Fee Total:</td>
                <td><span id="payAgenFee">${{$payAgenFee}}</span></td>
                <td style="font-weight: bold; color: #001f4d;">Month:</td>
                <td><span id="payMonthlyReportMonth">{{$payMonthlyReportMonth}}</span></td>
            </tr>
        </table>
        <p>
            The Fee for the month is authorised for payment into the
            Operator’s nominated Bank Account for the Agent.
        </p>
        <p style="margin-top: 25px;">
            Managing Director: <span style="display: inline-block; border-bottom: 1px solid #000; width: 200px;"></span>
        </p>
</body>
</html>

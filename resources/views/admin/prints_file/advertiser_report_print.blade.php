<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertiser Report</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 220mm;
            height: 250mm;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            box-sizing: border-box;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h2 {
            margin: 0;
            font-size: 18px;
        }
        button {
            padding: 6px 12px;
            background: #000;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .col-6 {
            width: 50%;
            padding: 5px 0;
        }
        .col-12 {
            width: 100%;
            padding: 5px 0;
        }
        strong {
            display: inline-block;
            min-width: 100px;
        }
        .notes {
            margin: 30px 0;
        }
        .notes div {
            border-bottom: 1px solid #000;
            height: 40px;
            margin-bottom: 5px;
        }
        .checkbox-group {
            margin: 15px 0;
        }
        .checkbox-group label {
            margin-right: 20px;
        }
        .signature-row {
            display: flex;
            margin-top: 20px;
        }
        .signature-box {
            border: 1px solid #000;
            flex: 1;
            padding: 10px;
            text-align: center;
        }
        .signature-box + .signature-box {
            margin-left: 10px;
        }
        @media print {
            body {
                background: none;
            }
            button {
                display: none;
            }
            .container {
                box-shadow: none;
                margin: 0;
                width: auto;
            }
        }
        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .checkbox-group label {
            margin-left: 10px;
            font-weight: normal;
            margin-right: 50px;
        }

        table.signature-table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        table.signature-table td {
            border: 1px solid #000;
            padding: 15px 8px;
            vertical-align: top;
        }

        table.signature-table strong {
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">
    <div class="header">
        <h2>My Report Information</h2>
        <button onclick="window.print()">Print Report</button>
    </div>
    <div class="row">
        <div class="col-6"><strong>Item No:</strong>#{{$report->id }}{{$report->escort_id}}</div>
        <div class="col-6"><strong>Member ID:</strong> {{$report->escort->user->member_id}}</div>
    </div>
    <div class="row">
        <div class="col-6"><strong>Report Type:</strong> {{formatStringTitleCase($report->report_tag)}}</div>
        <div class="col-6"><strong>Advertiser ID:</strong> {{$report->escort->id}}</div>
        
    </div>
    <div class="row">
        <div class="col-6"><strong>Stage Name:</strong> {{$report->escort->name}}</div>
        <div class="col-6"><strong>Date Created:</strong> {{$report->created_at->format('d-m-Y') }}</div>
    </div>

    <div class="row">
        <div class="col-6"><strong>Viewer ID:</strong> {{$report->escort_id}}</div>
        <div class="col-6"><strong>Status:</strong> {{$report->report_status == 'pending' ? 'Current' : 'Resolved'}}</div>
    </div>

    <div class="row">
        <div class="col-12 " style="display: flex; margin-top:10px;">
            <div class="col-3"><strong>Comments:</strong></div><div class="col-9">{{Str::title($report->report_desc)}}</div> </div>
    </div>

    <div class="notes">
        <strong>Notes:</strong>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="checkbox-group " style="margin-top:7%" >
        <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td colspan="2" style="border:1px solid #000; padding:8px; padding-top:3%; padding-bottom:3%; font-weight:bold;">Management only:</td>
                            <td colspan="2" style="border:1px solid #000; padding:8px; width:500px; ">
                            <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Cancel Membership</span>
                            </label>
                            </td>
                            <td colspan="2" style="border:1px solid #000; padding:8px; width:500px;">
                            <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Re-instate Membership</span>
                            </label>
                            </td>
                        </tr>

                        <tr>
                            <td style="border:1px solid #000; padding:40px 12px; font-weight:bold; width:75px;" colspan="1">Name:</td>
                            <td colspan="2" style="border:1px solid #000; padding:25px 12px; width:200px"></td>
                            <td style="border:1px solid #000; padding:25px 12px; font-weight:bold; width:100px;">Signature:</td>
                            <td colspan="1" style="border:1px solid #000; padding:25px 12px;"></td>
                        </tr>
                    </table>
    </div>

</body>
</html>

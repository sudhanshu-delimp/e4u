<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Montly Fee Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

</head>

<body style="margin:0;width:100%">
    @php
        $path = public_path('/assets/dashboard/img/auth.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $payOperatorId = $reportData['payOperatorId'];
        $payMonthlyReportDate = $reportData['payMonthlyReportDate'];
        $payMonthlyReportMonth = $reportData['payMonthlyReportMonth'];
        $payOperatorFee = number_format($reportData['payOperatorFee'], 2, '.', '');
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
            <td style="font-weight: bold; color: #000;">Operator ID:</td>
            <td><span id="payAgentId">{{ $payOperatorId }}</span></td>
            <td style="font-weight: bold; color:  #000;">Date:</td>
            <td><span id="payMonthlyReportDate">{{ $payMonthlyReportDate }}</span></td>
        </tr>
        <tr>
            <td style="font-weight: bold; color:  #000;">Fee Total:</td>
            <td><span id="payAgenFee">${{ $payOperatorFee }}</span></td>
            <td style="font-weight: bold; color:  #000;">Month:</td>
            <td><span id="payMonthlyReportMonth">{{ $payMonthlyReportMonth }}</span></td>
        </tr>
    </table>
    <p>
        The Fee for the month is authorised for payment into the
        Operator’s nominated Bank Account.
    </p>
    <p style="margin-top: 25px;">
        Managing Director: <span style="display: inline-block; border-bottom: 1px solid #000; width: 250px;"></span>
    </p>

    <div style="margin-top: 0px; font-size: 14px;">
        <hr style="margin-top: 20px; margin-bottom:30px;">
        <p style="font-weight: bold; color: #000; margin-bottom: 20px;font-size: 16px;">Office Use Only:</p>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 5px 0;font-size: 14px;width:50%;">EFT Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="padding: 5px 0;font-size: 14px;width:50%;">General Ledger: ______________________________</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 50px;font-size: 14px;">Processed by: ______________________________________</td>
            </tr>
        </table>
    </div>
</body>

</html>

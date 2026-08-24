<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listing Cancellation</title>

</head>

<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50; text-align: justify;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color:#0c223d; padding: 20px; text-align: left;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                                    </td>
                                    <td style="vertical-align: middle; text-align: right;">
                                        <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">Listing Cancellation- Escort</h1>
                                        <div style="font-size: 13px; color: #cccccc;">Member ID: {{$result->main_purchase->escort->user->member_id ?? ''}}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Body content -->
                    <tr>
                        <td style="padding: 30px; text-align: justify;">
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{$result->main_purchase->escort->user->name ?? ''}},</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Your Listing has been successfully cancelled.
                            </p>
                            <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Cancellation Details:</b></p>
                            <table>
                                <tr>
                                    <th style="text-align: left">Profile: </th>
                                    <td>{{ $result->main_purchase->escort->name }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left">Credit:</th>
                                    <td>{{ formatCurrency($result->net_credit_amount) }}</td>
                                </tr>
                            </table>
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                Pursuant to your cancellation, your Wallet has been credited with {{ formatCurrency($result->net_credit_amount) }} for future use.
                            </p>
                            <!-- email info -->
                            <x-email-info />
                            <!-- end -->
                        </td>
                    </tr>
                </table>

                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
                    <tr>
                        <td>
                            <x-email-footer />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
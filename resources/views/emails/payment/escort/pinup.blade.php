<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listing Pin Up</title>

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
                                        <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">Listing Pin Up - Escort</h1>
                                        <div style="font-size: 13px; color: #cccccc;">Member ID: {{$mainAccount->member_id ?? ''}}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Body content -->
                    <tr>
                        <td style="padding: 30px; text-align: justify;">
                            <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{$mainAccount->name ?? ''}},</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                We confirm your application to be listed as a Pin Up has been accepted. You will appear as the Pin Up for {{config("escorts.profile.states.$escortPinup->state_id.stateName")}} from {{$escortPinup->start_date}} to {{$escortPinup->end_date}}. Attached is a summary of your transaction.
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
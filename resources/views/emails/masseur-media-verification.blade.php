<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Media Verification</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50;">
                    <!-- Header with background and logo -->
                    <tr>
                        <td style="background-color:#0c223d; padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: left;">
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo"
                                            style="height: 50px;">
                                    </td>
                                   
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                                        <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;"> Media Verification - {{$body['status'] == "1" ? 'Approved' : 'Rejected'}} (Masseur)</h1>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            {{ $body['member_id'] }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <!-- Greeting -->
                            <p style="font-size: 18px; margin: 0 0 15px 0;"><b>Dear {{$body['name'] ?? 'Member'}},</b> </p>
                            @if($body['status'] == "1")
                                <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                    We are pleased to confirm that your media for Masseur: {{$body['masseur_member_id']}} has been approved after reviewing your Verification Image and is now marked as ‘Verified’.
                                </p>
                            @elseif($body['status'] == "2")
                                <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                    We advise that your recent uploaded Verification Image for Masseur: {{$body['masseur_member_id']}} has
been rejected. Please resubmit a fresh Verification Image for approval.
                                </p>
                            @endif
                             <!-- email info -->
                                <x-email-info/>
                            <!-- end -->

                            @if(!empty($body['agent_id']))
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                   cc: Your Agent {{$body['agent_id']}}
                                </p>
                            @endif

                        </td>
                    </tr>
                </table>
                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d;  font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
                    <tr>
                         <td>
                            <x-email-footer/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html> 
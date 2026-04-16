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
                                         Media Verification - {{$body['status'] == "1" ? 'Approved' : 'Rejected'}}<br>
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
                                    We are please to confirm your Media, after having reviewed your Verification Image, has
                                    been approved as <i>‘Verified’</i>. Any Profile you List will display your Media status as Verified
                                    and carry the E4U Verified icon.
                                </p>
                            @elseif($body['status'] == "2")
                                <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                    We advise that your recent uploaded Verification Image has been rejected. Please
                                    resubmit a fresh Verification Image for approval.
                                </p>
                            @endif
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations Centre</b>
                            </p>

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
                    style="background-color:#0c223d; padding: 0px; font-family:Arial, sans-serif; color:#ffffff; font-size:12px; text-align:center;">
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
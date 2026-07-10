<!DOCTYPE html>
<html>

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
                                        <h1
                                            style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">
                                            Dispatch Notification - Product </h1>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Member ID: {{ $data['member_id'] ?? '' }}
                                            <br>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content Section -->
                    <tr>
                        <td style="padding: 30px; font-size: 16px;">


                            <p style="margin: 0 0 15px 0;"><b>Dear {{ $data['member_name'] }},</b></p>

                            <p style="margin: 20px 0 15px 0;">
                                We are please to confirm your order for Product has been completed and despatched
                                today. You can track the progress of the delivery by going to
                                <a href="www.auspost.com.au/mypost/track/search">www.auspost.com.au/mypost/track/search
                                </a> enter the tracking number below.
                            </p>


                            <p style="margin: 15px 0;">
                                <strong>Order Ref:</strong> #{{ $data['order_id'] }}
                            </p>
                            <p style="margin: 15px 0;">
                                <strong>Date Dispatched:</strong> {{ date('d-m-Y') }}
                            </p>

                            @if (!empty($data['tracking_id']))
                                <p style="margin: 15px 0;">
                                    <strong>AusPost Tracking:</strong> {{ $data['tracking_id'] ?? '' }}
                                </p>
                            @endif
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations Centre</b>
                            </p>
                        </td>
                    </tr>
                </table>

                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
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

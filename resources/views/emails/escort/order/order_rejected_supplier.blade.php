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
                                            E4U Concierge - Product Order Rejected
                                        </h1>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Our Ref: {{ $data['communication_id'] ?? '' }}<br>
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


                            <p style="margin: 0 0 15px 0;"><b>Dear Supplier,</b></p>
                            <p style="margin: 20px 0 15px 0;">
                                This is to notify you that the following product order has been marked as
                                <strong>Rejected</strong>.
                            </p>

                            @if (!empty($data['reject_reason']))
                                <p style="margin: 15px 0;">
                                    <strong>Reason for Rejection:</strong> {{ $data['reject_reason'] }}
                                </p>
                            @endif
                            @if (!empty($data['order_id']))
                                <p style="margin: 15px 0;">
                                    <strong>Order Ref:</strong> #{{ $data['order_id'] }}
                                </p>
                            @endif

                            <p style="margin: 15px 0;">
                                The order has been updated successfully in the system.
                            </p>

                            <p style="margin: 15px 0;">
                                Please keep this notification for your records and refer to the order reference in any
                                future correspondence regarding this order.
                            </p>

                            <p style="margin: 15px 0;">
                                If you have any questions, please contact the E4U Operations Centre.
                            </p>

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

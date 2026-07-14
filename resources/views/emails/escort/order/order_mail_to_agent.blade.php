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
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                                    </td>
                                    <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                                        <h1
                                            style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">
                                            Order Confirmation - Products
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

                            <p style="margin: 0 0 15px 0;"><b>Dear
                                    {{ $data['agent_name'] ?? $data['billing_name'] }},</b></p>
                            <p style="margin: 20px 0 15px 0;">
                                Thank you for your order. This email confirms that you have successfully placed an order
                                for Products on behalf of

                                <strong>{{ $data['escort_name'] ?? 'the Escort' }}</strong>.

                            </p>

                            <p style="margin: 15px 0;">

                                If the order was submitted before 11:00 am and delivery was requested,
                                delivery will occur on the same day.

                                If the Products are being sent by post, please allow up to 48 hours for
                                delivery. The Products will be

                                dispatched to the nominated delivery address associated with this order.

                            </p>



                            <p style="margin: 15px 0;">

                                If the Products are not received within 72 hours, please lodge a
                                Support Ticket through your Dashboard

                                and quote the reference number {{ $data['order_id'] }}.

                            </p>



                            <p style="margin: 15px 0;">

                                We confirm that payment for this order has been processed according to your
                                instructions.

                            </p>
                            <p style="font-size: 15px; margin-top: 20px;">
                                Regards,<br>
                                <b>E4U - Operations Centre</b>
                            </p>

                            <hr style="border: 0; border-top: 1px solid #ccc;">


                            <p style="margin: 20px 0 10px 0;"><strong>Notes:</strong></p>



                            <ol style="padding-left: 20px; margin: 0; line-height: 22px;font-size:13px">

                                <li>

                                    If the Products are being sent by post:

                                    <ul style="padding-left: 20px; margin-top: 10px; list-style: none;">
                                        <li>(a) they will be dispatched on the next business day; and</li>
                                        <li>(b) tracking information will be available.</li>
                                    </ul>
                                </li>

                                <li style="margin-top: 10px;">
                                    You can view this order in your Dashboard by navigating to
                                    Transaction Summary and selecting
                                    View from the available actions.
                                </li>

                                {{-- <li style="margin-top: 10px;">
                                    Please retain this reference number for any future enquiries regarding this order.
                                </li> --}}

                            </ol>


                            <br>
                            <p>
                                Sent: {{ \Carbon\Carbon::now('Australia/Perth')->format('d-m-Y \a\t h:i A') }}.
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

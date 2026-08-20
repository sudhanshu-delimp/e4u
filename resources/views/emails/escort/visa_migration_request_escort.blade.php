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
                                            E4U Concierge - Visa Migration Request
                                        </h1>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Ref: {{ $data['ref'] ?? '' }}<br>
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

                            <p style="margin: 15px 0; text-align: justify">
                                Your request for Visa services assistance has been processed. Please allow
                                24 hours for a team member to make contact with you through your selected
                                preferred method.
                                If you have not been contacted by a member of the team with 24 hours,
                                please lodge a <a href="{{ route('support-ticket.form_create') }}"
                                    style="text-decoration: none;color:#EA3323">Support Ticket</a> and quote the
                                reference number stated in
                                your A-Alert. </p>



                            <!-- email info -->
                            <x-email-info />
                            <!-- end -->

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

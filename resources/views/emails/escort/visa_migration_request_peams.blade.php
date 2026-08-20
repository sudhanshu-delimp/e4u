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

                            <p style="margin: 0 0 15px 0;"><b>Dear PEAMS Australia Pty Ltd Team,</b></p>


                            <p style="margin: 0 0 20px 0;">
                                I am seeking assistance regarding a visa enquiry and would like to discuss my options
                                and requirements with your team.
                            </p>

                            <p style="margin: 0 0 10px 0; font-weight: 600;">
                                Please find my details below:
                            </p>

                            <div style="margin-bottom: 25px;">
                                <p style="margin: 5px 0;"><strong>First Name:</strong> {{ $data['first_name'] }}</p>
                                <p style="margin: 5px 0;"><strong>Last Name:</strong> {{ $data['last_name'] }}</p>
                                <p style="margin: 5px 0;"><strong>Email:</strong> {{ $data['email'] }}</p>
                                <p style="margin: 5px 0;"><strong>Mobile:</strong> {{ $data['mobile'] }}</p>
                                <p style="margin: 5px 0;"><strong>Preferred Contact
                                        Method:</strong>{{ $data['preferred_contact_method'] ?? 'Not specified' }} </p>
                            </div>

                            <p style="margin: 0 0 10px 0; font-weight: 600;">
                                Visa Details:
                            </p>

                            <div style="margin-bottom: 25px;">
                                <p style="margin: 5px 0;"><strong>Area of Advice:</strong> {{  ucwords(str_replace('_', ' ', $data['area_type']));
 }}
                                </p>
                                <p style="margin: 5px 0;"><strong>Visa Enquiry Type:</strong>
                                    {{ $data['visa_enquiry_type'] }}</p>
                                <p style="margin: 5px 0;"><strong>Passport Country of
                                        Issue:</strong>{{ $data['passport_country'] }}</p>
                            </div>
                            <p style="margin: 5px 0;">
                                <strong>Comments:</strong>
                            </p>

                            <div
                                style="margin-top: 8px; padding: 12px 15px; background-color: #f7f7f7; border: 1px solid #e0e0e0; border-radius: 4px;">
                                {{ $data['comments'] ?: 'No additional comments provided.' }}
                            </div>
<br>
                            <p style="margin: 0 0 20px 0;">
                                I would appreciate it if one of your team members could contact me to discuss my visa
                                requirements and advise me on the available options and next steps.
                            </p>

                            <p style="margin: 0 0 20px 0;">
                                Thank you for your assistance. I look forward to hearing from you.
                            </p>



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

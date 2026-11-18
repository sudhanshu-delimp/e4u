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
                                           Order Confirmation - Email Account
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
                               Your request for an Email Account has been received. Please allow 48 hours for the Email
Account notification and setup instructions to arrive. We will, by separate email to you,
forward your Email Client Configuration details.</p>
                            <p style="margin: 15px 0; text-align: justify">
                               If you do not receive your notification within 72 hours, please lodge a Support Ticket, by
logging onto your Dashboard, and quote your reference number {{ $data['ref'] ?? '' }} </p>
                            <p style="margin: 15px 0; text-align: justify">
                               We confirm payment will be made according to your instructions. </p>

                          <div class="email-service-notes">
                              <strong>Notes:</strong>
                              <ol>
                                  <li>
                                      Your Email service:
                                      <ol type="a">
                                          <li>will be established within 24 hours of this request;</li>
                                          <li>will be active when you receive the notification; and</li>
                                          <li>can be accessed through a browser or by installing the Email account on your device.</li>
                                      </ol>
                                  </li>
                                  <li>
                                      See <a href="#" target="_blank">Terms &amp; Conditions</a> for how to use this service.
                                  </li>
                              </ol>
                          </div>

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

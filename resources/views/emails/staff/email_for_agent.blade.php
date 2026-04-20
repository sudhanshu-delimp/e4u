<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Confirmation of Registration</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
    <tr>
      <td align="center">
        <!-- Main container -->
        <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50;">

          <!-- Header with background and logo -->
          <tr>
            <td style="background-color:#0c223d; padding: 20px;">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="text-align: left;">
                    <img src="{{ asset('images/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                  </td>
                  <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                     <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">Confirmation of Registration - Support Agent </h1>
                    <span style="font-size: 13px; color: #cccccc;">Agent ID: {{$agent['agent_id']}}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Content Padding -->
          <tr>
            <td style="padding: 30px;">
              
              <!-- Greeting -->
              <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Dear {{$agent['name'] ?? ''}},</b></p>

              <!-- Main Message -->
              <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">We are please to confirm your Registration has been received. One of our team members
                will be in touch with you within the next 24 hours to discuss your application for Membership
                as an Agent.</p>

              <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">Please don't hesitate to get in touch if you need to. You can reach the E4U Help Desk by
                forwarding a message from the ‘Contact Us’ page located in the Website footer.</p>

              <!-- Closing -->
              <!-- email info -->
                                <x-email-info/>
                            <!-- end -->

            </td>
          </tr>

        </table>

        <!-- Footer -->
        <table width="600" cellpadding="0" cellspacing="0" style="background-color:#0c223d; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
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

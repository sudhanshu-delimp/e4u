<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Account Activate - Operator</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 20px 0;">
    <tr>
      <td align="center">
        <!-- Main container -->
        <table width="700" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50;">
          <!-- Header with background and logo -->
          <tr>
            <td style="background-color:#0c223d; padding: 20px;">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="text-align: left;">
                    <img src="{{ asset('assets/app/img/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                  </td>
                  <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                    Account Activate - Operator <br>
                    <span style="font-size: 13px; color: #cccccc;">
                      Operator ID: {{$operator['member_id'] ?? ''}}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- Content Padding -->
          <tr>
            <td style="padding: 30px;">
              <p style="font-size: 16px; margin: 0 0 15px 0;">Dear {{$operator['business_name']}},</p>
                <p style="font-size: 16px; margin: 20px 0 15px 0;">We are please to advise you that your account which was recently Suspended has now been activated. You can now access the dashboard.</p>
                <!-- Details Table -->
                <p style="font-size: 15px; margin-top: 20px;">
                    Regards,<br>
                    <b>E4U - Operations</b>
                </p>
            </td>
          </tr>
        </table>
        <!-- Footer -->
        <table width="700" cellpadding="0" cellspacing="0" style="background-color:#0c223d; padding: 15px 30px; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
          <tr>
            <td>
              <em>This is an automatically generated email by the Escorts4U Operations Centre.<br>
                &copy; Copyright {{date('Y');}} Blackbox Tech Pty Ltd. All rights reserved.</em>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

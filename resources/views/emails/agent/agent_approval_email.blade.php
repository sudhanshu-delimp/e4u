<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Account Approval - Agent</title>
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
                    Account Approval - Agent <br>
                    <span style="font-size: 13px; color: #cccccc;">
                      Agent ID: {{$agent['member_id'] ?? ''}}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Content Padding -->
          <tr>
            <td style="padding: 30px;">
              
              <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Attention Operations</b></p>
                <p style="font-size: 16px; margin: 20px 0 15px 0;">Your Account has been approved.Please find the Login Credentials:</p>
                <!-- Details Table -->
                <table width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-size: 15px; color: #2b3d50;">
                  
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Mobile Number :</td>
                    <td style="padding: 10px 0px 10px 10px">{{$agent['phone'] ?? ''}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Password :</td>
                    <td style="padding: 10px 0px 10px 10px">{{$agent['plainPassword'] ?? ''}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Login url:</td>
                    <td style="padding: 10px 0px 10px 10px">{{ config('app.url')}}</td>
                  </tr>
                  
                </table>

               
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

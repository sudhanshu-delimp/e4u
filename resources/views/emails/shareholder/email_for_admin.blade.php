<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Registration - Supplier</title>
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
                    New Registration - Supplier <br>
                    <span style="font-size: 13px; color: #cccccc;">
                      Supplier ID: {{$supplier['member_id'] ?? ''}}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Content Padding -->
          <tr>
            <td style="padding: 30px;">
              
              <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Attention Operations</b></p>
                <p style="font-size: 16px; margin: 20px 0 15px 0;">The following Supplier Registration was made on the {{$supplier['create_at'] ?? ''}}. Details of the
                  registration are:</p>
                <!-- Details Table -->
                <table width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-size: 15px; color: #2b3d50;">
                  
                 
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Name:</td>
                    <td style="padding: 10px 0px 10px 10px">{{$supplier['name'] ?? ''}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Mobile:</td>
                    <td style="padding: 10px 0px 10px 10px">{{$supplier['phone'] ?? ''}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Email:</td>
                    <td style="padding: 10px 0px 10px 10px">{{$supplier['email'] ?? ''}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Location:</td>
                    <td style="padding: 10px 0px 10px 10px">{{$supplier['location'] ?? ''}}</td>
                  </tr>
                  <tr>
                    <td style="font-weight: bold; padding: 10px 0px;">Supplier ID:</td>
                    <td style="padding: 10px 0px 10px 10px">{{$supplier['member_id'] ?? ''}}</td>
                  </tr>
                </table>

                 <!-- Closing -->
              <p style="font-size: 15px; margin-top: 20px;">
                Regards,<br>
                <b>E4U - Operations Centre</b>
              </p>
            </td>
          </tr>

        </table>

        {{-- <x-email-footer /> --}}
                    <x-email-footer />
                {{-- <x-email-footer /> --}}

      </td>
    </tr>
  </table>
</body>
</html>

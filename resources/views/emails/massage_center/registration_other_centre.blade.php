<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Registration - Massage Centre</title>
</head>

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
                                        <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">New Registration - Massage Centre</h1>
                                        <span style="font-size: 13px; color: #cccccc;">
                                            Member ID: {{$user->member_id ?? ''}}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">

                            <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Attention Operations</b></p>
                            <p style="font-size: 16px; margin: 35px 0 15px 0;">
                                Dear <strong>{{ !empty($user->contact_person) ? $user->contact_person : (!empty($user->name) ? $user->name : 'Massage Centre') }}</strong>, 
                            </p>
                            <p>
                                Your Massage Centre account was successfully created on {{$user->created_at->format('d-m-Y')}} and has now been granted access. Please find your login credentials below.

                            </p> 
                            
                            

                            <table width="100%" cellpadding="5" cellspacing="0"
                                style="border-collapse: collapse; font-size: 15px; color: #2b3d50;">

                                <tr>
                                    <td style="font-weight: bold; padding: 10px 0px;width: 160px;">Login ID / Mobile No :</td>
                                    <td style="padding: 10px 0px 10px 10px">{{removeSpaceFromString($user->phone)}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; padding: 10px 0px;width: 160px;">Password :</td>
                                    <td style="padding: 10px 0px 10px 10px">{{$userpassword}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; padding: 10px 0px;width: 160px;">Login url :</td>
                                    <td style="padding: 10px 0px 10px 10px">{{ route('advertiser.login') }}</td>
                                </tr>

                            </table>

                           
                          

                            <!-- Details Table -->
                            

                            <!-- Closing -->
                             <!-- email info -->
                                <x-email-info/>
                            <!-- end -->
                        </td>
                    </tr>

                </table>

                <!-- Footer -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#0c223d; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
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

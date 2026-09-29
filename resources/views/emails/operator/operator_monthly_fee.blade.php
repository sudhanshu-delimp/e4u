<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Operator Monthly Fee Report</title>
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
                                        <img src="{{ asset('images/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                                    </td>
                                    <td
                                        style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold; vertical-align: middle;">
                                        <h1
                                            style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">
                                            Monthly Fee Report - {{ $operator['report_date'] }} </h1>
                                        <span style="font-size: 13px; color: #cccccc;">Member ID:
                                            {{ $operator['member_id'] }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">

                            <!-- Greeting -->
                            <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Dear
                                    {{ $operator['name'] }},</b></p>

                            <!-- Main Message -->
                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">Your Monthly Fee Report
                                (<b>Monthly Report</b>) has been reconciled and uploaded to your
                                Console. Please log on and review the Monthly Report for your approval. If you have
                                any concerns with the Monthly Report, please raise a query (<b>Query</b>).</p>

                            <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">The Fee set out in the
                                Monthly Report will be paid into your nominated bank account,
                                by the Operator, within seven days of the Monthly Report being approved by you.</p>
                            <p><b>Note:</b></p>
                            <p>If you raise a Query:</p>

                            <table>
                                <tr>
                                    <td style="vertical-align: baseline; padding-right:20px;"> (a)</td>
                                    <td>
                                        the Fee corresponding to the Query will be separated from the Report and remain
                                        in
                                        escrow until the query is resolved (Resolved Query); and
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: baseline;padding-right:20px;"> (b)
                                    </td>
                                    <td>
                                        a Resolved Query will be included in the following Monthly Report.
                                    </td>
                                </tr>
                            </table>
                            <!-- Closing -->
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tax Invoice</title>
</head>
<body style="margin: 0; padding: 24px 0; background-color: #eef2f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 13px; color: #132238; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">

    <!-- Outer Wrapper Table -->
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #eef2f7;">
        <tr>
            <td align="center" style="padding: 0 10px;">
                
                <!-- Main Invoice Container (Max Width 700px for Email Clients) -->
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px; background-color: #ffffff; border: 1px solid #cbd5e1; border-radius: 6px; overflow: hidden;">
                                        
                                        <!-- Top Blue Header -->
                                        <tr>
                                            <td style="background-color: #0c223d; padding: 12px 18px;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td align="left" valign="middle">
                                                            <img src="https://staging.e4u.host.powerwebhosting.com.au/assets/images/escorts4u-logo.png" alt="E4U Logo" width="95" style="display: block; border: 0; outline: none; text-decoration: none; max-width: 95px; height: auto;" />
                                                        </td>
                                                        <td align="right" valign="middle" style="font-size: 18px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; text-transform: uppercase;">
                                                            TAX INVOICE
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Main Header (Company Details + Stamp + Meta) -->
                                        <tr>
                                            <td style="padding: 18px 18px 14px 18px; border-bottom: 2px solid #e2e8f0;">
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <!-- Company Details -->
                                                        <td width="50%" valign="middle" align="left" style="font-size: 11px; line-height: 1.5; color: #53657d;">
                                                            <div style="font-size: 13.5px; font-weight: 700; color: #0c223d; margin-bottom: 3px;">
                                                                Blackbox Tech Pty Ltd <span style="font-weight: 400; font-size: 11.5px; color: #53657d;">t/as E4U</span>
                                                            </div>
                                                            <div style="margin-bottom: 1px;"><strong style="color: #0c223d;">B:</strong> 168 Guildford Road Maylands WA 6051</div>
                                                            <div style="margin-bottom: 1px;"><strong style="color: #0c223d;">P:</strong> GPO Box T1756 Perth WA 6845</div>
                                                            <div>
                                                                <strong style="color: #0c223d;">T:</strong> 1300 700 444 &nbsp;|&nbsp; 
                                                                <strong style="color: #0c223d;">E:</strong> <a href="mailto:admin@e4u.com.au" style="color: #1a5ea9; text-decoration: none;">admin@e4u.com.au</a><br />
                                                                <strong style="color: #0c223d;">W:</strong> <a href="https://www.e4u.com.au" target="_blank" style="color: #1a5ea9; text-decoration: none;">e4u.com.au</a>
                                                            </div>
                                                        </td>

                                                        <!-- Paid Stamp (Email-safe badge) -->
                                                        <td width="20%" valign="middle" align="center">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border: 2px dashed #1aa34d; border-radius: 100px; padding:20px 3px; background-color: #f0fdf4;">
                                                                <tr>
                                                                    <td align="center" style="padding: 5px 12px; font-size: 14px; font-weight: 800; color: #1aa34d; letter-spacing: 1px; line-height: 1.2;">
                                                                        <span style="font-size: 8px; font-weight: 700; display: block; letter-spacing: 0.5px;">THANK YOU</span>
                                                                        PAID
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>

                                                        <!-- Invoice Meta -->
                                                        <td width="30%" valign="middle" align="right" style="font-size: 11.5px; line-height: 1.5;">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="right">
                                                                <tr>
                                                                    <td align="right" style="color: #53657d; font-weight: 600; padding: 2px 6px;">Invoice Date:</td>
                                                                    <td align="right" style="color: #0c223d; font-weight: 700; padding: 2px 0;">{{ !empty($payment->created_at) ? $payment->created_at->format('d-m-Y') : '---' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="right" style="color: #53657d; font-weight: 600; padding: 2px 6px;">Invoice No:</td>
                                                                    <td align="right" style="color: #0c223d; font-weight: 700; padding: 2px 0;">{{ $payment?->ref_no ?? '---' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="right" style="color: #53657d; font-weight: 600; padding: 2px 6px;">ABN:</td>
                                                                    <td align="right" style="color: #0c223d; font-weight: 700; padding: 2px 0;">88 664 919 975</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Invoice Body Container -->
                                        <tr>
                                            <td style="padding: 16px 18px 20px 18px;">
                                                
                                                <!-- Metadata Table Section -->
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 14px;">
                                                    <tr>
                                                        <td width="40%" valign="bottom" align="left" style="font-size: 12px; line-height: 1.6; color: #0c223d; padding-bottom: 2px;">
                                                            <div><strong>Member ID:</strong> {{!empty($payment) ? $payment->user->member_id : '---'}}</div>
                                                            <div><strong>Location:</strong> {{!empty($payment) ? $payment->user->home_state : '---'}}</div>
                                                        </td>
                                                        <td width="60%" valign="bottom" align="right">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #cbd5e1; text-align: center;">
                                                                <thead>
                                                                    <tr style="background-color: #0c223d;">
                                                                        <th style="padding: 5px; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Completed By</th>
                                                                        <th style="padding: 5px; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Currency</th>
                                                                        <th style="padding: 5px; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Home State</th>
                                                                        <th style="padding: 5px; font-size: 10px; font-weight: 600; color: #ffffff; text-transform: uppercase; border: 1px solid #1e3a63;">Member ID</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr style="background-color: #fafbfc;">
                                                                        <td style="padding: 5px; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{ $payment?->createdBy->member_id ?? '---' }}</td>
                                                                        <td style="padding: 5px; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">AUS</td>
                                                                        <td style="padding: 5px; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{!empty($payment) ? $payment->user->home_state : '---'}}</td>
                                                                        <td style="padding: 5px; font-size: 11px; color: #132238; border: 1px solid #cbd5e1;">{{!empty($payment) ?$payment->user->member_id : '---'}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Line Items Table -->
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #cbd5e1; width: 100%;">
                                                    <thead>
                                                        <tr style="background-color: #0c223d;">
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 12%;">Date</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 14%;">Service Type</th>
                                                            <th style="padding: 8px 6px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: left; width: 34%;">Service Description</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: center; width: 8%;">Qty<sup>(1)</sup></th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 10%;">Rate</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 10%;">Discount</th>
                                                            <th style="padding: 8px 4px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 10%;">GST</th>
                                                            <th style="padding: 8px 6px; font-size: 10.5px; font-weight: 600; color: #ffffff; border: 1px solid #1e3a63; text-align: right; width: 12%;">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         @if(!empty($payment))
                                                            @include('escort.dashboard.Bookkeeping.modal.partials.tax-invoice-items', compact('payment'))
                                                        @endif
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>
                
            </td>
        </tr>
    </table>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Supplier Report Summary</title>
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
                    <img src="{{ asset('assets/app/img/logo.png') }}" alt="E4U Logo" style="height: 50px;">
                  </td>
                  <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;">
                    <h1 style="margin: 0; font-size: 16px; font-weight: bold; color:#ffffff; text-align: right;">Supplier Report</h1>
                    <span style="font-size: 13px; color: #cccccc;">
                      Supplier ID: {{ $supplier['member_id'] ?? $supplier['id'] ?? '' }}
                    </span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Content Padding -->
          <tr>
            <td style="padding: 30px;">
              <p style="font-size: 16px; margin: 0 0 15px 0;">
                Dear {{ $supplier['business_name'] ?? $supplier['name'] ?? 'Supplier' }},
              </p>

              <p style="font-size: 15px; line-height: 22px; margin: 0 0 20px 0;">
                Please find attached the latest supplier report generated for your account. Below is a brief summary of your registered details:
              </p>

              <!-- Supplier Summary Table -->
              <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; margin-bottom: 20px; font-size: 14px; background-color: #f9f9f9; border: 1px solid #e2e8f0;">
                <tr>
                  <td style="font-weight: bold; width: 35%; border-bottom: 1px solid #e2e8f0;">Business Name:</td>
                  <td style="border-bottom: 1px solid #e2e8f0;">{{ $supplier['business_name'] ?? $supplier['name'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold; border-bottom: 1px solid #e2e8f0;">Business Number:</td>
                  <td style="border-bottom: 1px solid #e2e8f0;">{{ $supplier['business_number'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold; border-bottom: 1px solid #e2e8f0;">ABN:</td>
                  <td style="border-bottom: 1px solid #e2e8f0;">{{ $supplier['abn'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">Contact:</td>
                  <td>{{ $supplier['contact'] ?? $supplier['phone'] ?? 'N/A' }}</td>
                </tr>
              </table>

              <p style="font-size: 14px; line-height: 20px; margin: 0 0 20px 0; color: #555555;">
                If you have any questions or require further clarification regarding the attached report, please feel free to reach out to our team.
              </p>

              <!-- Email info component -->
              <x-email-info/>
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

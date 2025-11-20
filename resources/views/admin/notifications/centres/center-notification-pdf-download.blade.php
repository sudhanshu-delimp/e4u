<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>View Appointment — Details</title>
    <style>
        @media print {
        .no-print {
            display: none !important;
        }
        .print-sheet {
          box-shadow: none !important;
        }
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; background:#f3f4f6; margin:0;">

    <div class="overlay" style="display:flex;align-items:center;justify-content:center;padding:20px;">
        <div class="print-sheet" role="dialog" aria-modal="true" style="width:210mm;max-width:100%;background:#fff;border-radius:6px;box-shadow:0 10px 30px rgba(0,0,0,0.25);overflow:hidden;transform:scale(0.98)">

            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid #e6e6e6;background:#fafafa;">
                <div style="display:flex;gap:12px;align-items:center;">
                    <h2 style="margin:0;font-size:18px;color:#0C223D">Center Notification Details</h2>

                </div>
                <div style="display:flex;gap:8px;align-items:center;">
                    <button onclick="window.print()" class="no-print" style="appearance:none;border:1px solid #0C223D;background:#0C223D;color:#fff;padding:8px 12px;border-radius:4px;cursor:pointer;font-size:13px;">Print</button>

                </div>
            </div>

            <div style="padding:18px;">



                <!-- Appointment Details Table -->
                <table style="width:100%;border-collapse:collapse;font-size:14px;margin-bottom:18px;">
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;width:25%;font-weight:bold;">Ref</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{sprintf('#%05d', $pdfDetail['ref'])}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Heading</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['heading']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Type</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['type']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Status</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['status']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Member ID</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['member_id']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Start Date</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['start_date']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Finish Date</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['end_date']}}</td>
                    </tr>
                    @if($pdfDetail['type'] == 'Template')
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Template Name</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{ucfirst($pdfDetail['template_name'])}}</td>
                    </tr>
                    @else
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Content</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{ucfirst($pdfDetail['content'])}}</td>
                    </tr>
                    @endif

                </table>



                <!-- Footer -->
                <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;font-size:12px;color:#666;">
                   
                    
                </div>

            </div>

        </div>
    </div>

    <script>
        function closePopup() {
            document.querySelector('.overlay').style.display = 'none';
        }
    </script>

</body>

</html>
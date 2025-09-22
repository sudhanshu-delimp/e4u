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
                    <h2 style="margin:0;font-size:18px;color:#0C223D">Appointment Details</h2>

                </div>
                <div style="display:flex;gap:8px;align-items:center;">
                    <button onclick="window.print()" class="no-print" style="appearance:none;border:1px solid #0C223D;background:#0C223D;color:#fff;padding:8px 12px;border-radius:4px;cursor:pointer;font-size:13px;">Print</button>

                </div>
            </div>

            <div style="padding:18px;">



                <!-- Appointment Details Table -->
                <table style="width:100%;border-collapse:collapse;font-size:14px;margin-bottom:18px;">
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;width:25%;font-weight:bold;">Date</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['date']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Time</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['time']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Advertiser</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['advertiser']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Address</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['address']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Point of Contact</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['point_of_contact']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Mobile</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['mobile']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Summary</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{$pdfDetail['summary']}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Source</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{ucfirst($pdfDetail['source'])}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #ccc;padding:8px;font-weight:bold;">Importance</td>
                        <td style="border:1px solid #ccc;padding:8px;">{{ucfirst($pdfDetail['importance'])}}</td>
                    </tr>
                </table>

                <!-- Map -->
                <div style="margin-bottom:12px;border:1px solid #ececec;border-radius:4px;overflow:hidden;">
                    <div style="font-size:14px;color:#0C223D;padding:10px 12px;border-bottom:1px solid #f0f0f0;font-weight: bold">Map</div>
                    <div style="padding:8px;">
                        <iframe src="https://www.google.com/maps?q={{ urlencode($pdfDetail['address']) }}&output=embed" style="width:100%;height:240px;border:0;display:block;" loading="lazy" title="appointment-location"></iframe>
                    </div>
                </div>

                <!-- Notes -->
                <div style="padding:12px;border:1px solid #ececec;border-radius:4px;background:#fff;margin-bottom:18px;">
                    <div style="font-size:14px;color:#0C223D;margin-bottom:8px; font-weight: bold;">Notes:</div>
                    <div style="padding-top:6px;">
                        <div style="height:26px;border-bottom:1px solid #d9d9d9;margin-bottom:10px;"></div>
                        <div style="height:26px;border-bottom:1px solid #d9d9d9;margin-bottom:10px;"></div>
                        <div style="height:26px;border-bottom:1px solid #d9d9d9;margin-bottom:10px;"></div>
                        <div style="height:26px;border-bottom:1px solid #d9d9d9;margin-bottom:10px;"></div>
                        <!-- <div style="height:26px;border-bottom:1px solid #d9d9d9;margin-bottom:10px;"></div> -->
                    </div>
                </div>

                <!-- Footer -->
                <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;font-size:12px;color:#666;">
                    {{-- <div>Appointment ID: <strong style="color:#111;">APT-20250925-001</strong></div> --}}
                    <div>Created: {{$pdfDetail['create_date']}}</div>
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
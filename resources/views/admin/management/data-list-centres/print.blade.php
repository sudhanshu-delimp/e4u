<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data List (Centres)</title>
    <style>
        .print-sheet{
            width:850px;max-width:100%;background:#fff;border-radius:6px;box-shadow:0 0px 4px rgba(0,0,0,0.25);overflow:hidden;transform:scale(0.98)
        }
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
        <div class="print-sheet" role="dialog" aria-modal="true">

            <div
                style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid #e6e6e6;background:#fafafa;">
                <div style="display:flex;gap:12px;align-items:center;">
                    <h2 style="margin:0;font-size:18px;color:#0C223D">Agent Summary</h2>

                </div>
                <div style="display:flex;gap:8px;align-items:center;">
                    <button onclick="window.print()" class="no-print"
                        style="appearance:none;border:1px solid #0C223D;background:#0C223D;color:#fff;padding:8px 12px;border-radius:4px;cursor:pointer;font-size:13px;">Print</button>

                </div>
            </div>

            <div style="padding:18px;">



                <div class="modal-body">
                    <table class="table table-bordered table-hover text-center" style="width:100%;border-collapse:collapse; border:1px solid #ddd;">

                        <thead style="border: 1px solid #ddd; background:#f9f9f9;">
                            <tr>
                                <th style="text-align: left; padding: 12px;">Deployed</th>
                                <th style="text-align: left; padding: 12px;">Agent</th>
                                <th style="text-align: left; padding: 12px;">Agent ID</th>
                                <th style="text-align: center; padding: 12px;">Agent Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($printPdfs as $pdf)
                                <tr>
                                    <td style="padding: 12px; border: 1px solid #ddd;">{{ basicDateFormat($pdf['created_at']) }}</td>
                                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $pdf['business_name'] ?? '' }}</td>
                                    <td style="padding: 12px; border: 1px solid #ddd;">{{ $pdf['member_id'] ?? '' }}</td>
                                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;"><span
                                            class="custom_badge {{ getStatusBadgeClass($pdf['status']) }}">{{ $pdf['status'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

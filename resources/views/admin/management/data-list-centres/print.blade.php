<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data List (Centres)</title>
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
        <div class="print-sheet" role="dialog" aria-modal="true"
            style="width:210mm;max-width:100%;background:#fff;border-radius:6px;box-shadow:0 10px 30px rgba(0,0,0,0.25);overflow:hidden;transform:scale(0.98)">

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
                    <table class="table table-bordered">

                        <thead class="table-bg">
                            <tr>
                                <th>Deployed</th>
                                <th>Agent</th>
                                <th>Agent ID</th>
                                <th>Agent Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($printPdfs as $pdf)
                                <tr>
                                    <td>{{ basicDateFormat($pdf['created_at']) }}</td>
                                    <td>{{ $pdf['business_name'] ?? '' }}</td>
                                    <td>{{ $pdf['member_id'] ?? '' }}</td>
                                    <td><span
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

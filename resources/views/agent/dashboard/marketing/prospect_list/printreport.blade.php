<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Agent Report</title>
    <script>
        function printPage() {
          window.print();
        }
      </script>
      <style>
        @media print{
            .print_btn{
                display: none;
            }
        }
      </style>
</head>

<body style="font-family: Arial, sans-serif; color: #000; padding: 20px;">
    <div style="
    width: 900px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 25px;
    border-radius: 10px;">
    <!-- Header Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="margin: 0; font-size: 20px;">Center List</h2>
        <button onclick="printPage()" class="print_btn" style="padding: 8px 16px; font-size: 14px; background-color: #001f4d; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
          🖨️ Print
        </button>
      </div>
    <!-- Agent Summary Table -->
    <div class="profile_summary">
        <table style="width: 50%; font-size: 14px; border-collapse: collapse; margin-bottom:15px;">
            <tr>
                <td style="border:0px; padding: 6px 8px;
    width: 120px;"><strong>Report For:</strong></td>
                <td style="border-left:5px solid #000; width:10px;"></td>
                <td style="border:0px; padding: 6px 8px;">{{$data['report_from']}}</td>
            </tr>
            <tr>
                <td style="border:0px; padding: 6px 8px; 
    width: 120px;"><strong>Date Generated:</strong></td>
                <td style="border-left:5px solid #000; width:10px;"></td>
                <td style="border:0px; padding: 6px 8px;">{{$data['date_generated']}}</td>
            </tr>
            <tr>
                <td style="border:0px; padding: 6px 8px; 
    width: 120px;"><strong>Post Code:</strong></td>
                <td style="border-left:5px solid #000; width:10px;"></td>
                <td style="border:0px; padding: 6px 8px;">{{$data['post_code']}}</td>
            </tr>
            <tr>
                <td style="border:0px; padding: 6px 8px; 
    width: 120px;"><strong>Listings:</strong></td>
                <td style="border-left:5px solid #000; width:10px;"></td>
                <td style="border:0px; padding: 6px 8px;">{{$data['listings']}}</td>
            </tr>
        </table>
    </div>

    <!-- Data Table -->
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
        <thead>
            <tr style="background-color: #001f4d; color: #fff;">
                <th style="border: 1px solid #000; padding: 6px;">ID</th>
                <th style="border: 1px solid #000; padding: 6px;">Business Name</th>
                <th style="border: 1px solid #000; padding: 6px;">Address</th>
                <th style="border: 1px solid #000; padding: 6px;">Post Code</th>
                <th style="border: 1px solid #000; padding: 6px;">Mobile Number</th>
                <th style="border: 1px solid #000; padding: 6px;">Business Number</th>
                <th style="border: 1px solid #000; padding: 6px;">Email</th>
                <th style="border: 1px solid #000; padding: 6px;">Signed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($centres as $centre)
            <tr>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->id}}</td>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->bussiness_name}}</td>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->address}}</td>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->post_code}}</td>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->mobile_number}}</td>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->business_number}}</td>
                <td style="border: 1px solid #000; padding: 6px;">{{$centre->email}}</td>
                <td style="border: 1px solid #000; padding: 6px; text-align: center;">
                    <input type="checkbox" />
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    </div>
</body>

</html>
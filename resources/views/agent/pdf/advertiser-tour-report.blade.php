<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Tour Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0 0 8px 0;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #0b2a4a;
            font-size: 20px;
            font-weight: 700;
        }
         h3 {
            text-align: center;
            color: #0b2a4a;
            font-size: 16px;
            font-weight: 700;
        }

        th {
            background: #0b2a4a;
            color: #fff;
        }
      


        .numValue {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .numValue .currency {
            display: table-cell;
            width: 15px;
            text-align: left;
        }

        .numValue .amount {
            display: table-cell;
            text-align: right;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <div class="header"> 
        <h2>Tour Report</h2>

       
    </div>

    <table>
        <thead>
            <tr>
               
                <th>Tour Title</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Mobile</th>
               
                <th>Number of Locations</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Days</th>
                <th>Pin Up</th>
                <th>Listing Fee</th>
                <th>Agent’s Fee</th>
            </tr>
        </thead>

        <tbody>
            @forelse($alltours as $row)
                <tr>
                    <td>{{ $row['tour_name'] }}</td>
                    <td>{{ $row['member_id'] }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['mobile'] }}</td>
                    
                   
                    <td class="text-center">{{ $row['no_of_location'] }}</td>
                    <td>{{ $row['start_date'] }}</td>
                    <td>{{ $row['end_date'] }}</td>

                    <td>{{ $row['total_days'] }}</td>
                    <td>{{ $row['pin_up'] }}</td>
                  
                   
                    <td>
                    <div class="numValue">
                        <span class="currency">$</span>
                        <span class="amount">{{ $row['listing_fee'] }}</span>
                    </div>
                </td>

                <td>
                    <div class="numValue">
                        <span class="currency">$</span>
                        <span class="amount">{{ $row['agent_fee'] }}</span>
                    </div>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        No records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
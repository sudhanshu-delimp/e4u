<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tour Summary - {{ $member_id }}</title>
    <style>
        @page {
            margin: 10mm;
            size: A4 portrait;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #000000;
        }
        .header {
            background-color: #0c223d;
            color: #ffffff;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: bold;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }
        th {
            background-color: #0c223d;
            color: #ffffff;
            padding: 8px;
            font-size: 12px;
            text-align: center;
            border: 1px solid #0c223d;
        }
        td {
            padding: 8px;
            border: 1px solid #dee2e6;
            text-align: center;
            font-size: 13px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .totals-row {
            font-weight: bold;
        }
        .totals-row td {
            border-top: 2px solid #000000;
            border-bottom: 2px solid #000000;
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


        img.custompopicon {
    max-width: 25px;
    margin-right: 0.5rem;
    margin-top: 10px;
}
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('assets/dashboard/img/tour-summary.png') }}" class="custompopicon"> 
        Tour Summary - {{ $member_id }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Location</th>
                <th style="width: 20%;">Start Date</th>
                <th style="width: 20%;">End Date</th>
                <th style="width: 25%;">Membership</th>
                <th style="width: 10%;">Days</th>
                <th style="width: 10%;">Listing Fee</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $row)
                @php
                    $bgStyle = ($index % 2 !== 0) ? 'background-color: #f9f9f9;' : '';
                @endphp
                <tr style="{{ $bgStyle }}">
                    <td>{{ $row['location'] }}</td>
                    <td>{{ $row['start_date'] }}</td>
                    <td>{{ $row['end_date'] }}</td>
                    <td>
                        @if (is_array($row['membership']) && count($row['membership']) > 0)
                            @foreach ($row['membership'] as $m)
                                {{ $m['member_id'] }} - {{ $m['plan'] }}<br>
                            @endforeach
                        @else
                            {{ is_string($row['membership']) ? $row['membership'] : '-' }}
                        @endif
                    </td>
                    <td>{{ $row['days'] }}</td>
                    <td class="text-right">${{ $row['listing_fee'] }}</td>
                </tr>

                @if (!empty($row['is_pinup']) && !empty($row['pinup_data']))
                    <tr style="{{ $bgStyle }}">
                        <td>{{ $row['pinup_data']['location'] }}</td>
                        <td>{{ $row['pinup_data']['start_date'] }}</td>
                        <td>{{ $row['pinup_data']['end_date'] }}</td>
                        <td>{{ $row['pinup_data']['membership'] }}</td>
                        <td>{{ $row['pinup_data']['days'] }}</td>
                        <td> 
                            
                        
                       <div class="num_value">$<span>{{ number_format((float) $row['pinup_data']['listing_fee'], 2) }}</span></div> 
                            
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="6" class="text-center">No location details found.</td>
                </tr>
            @endforelse

            <tr class="totals-rows">
                <td colspan="4" class="text-right">Totals :</td>
                <td class="text-center">{{ $total_days }}</td>
                <td class="text-right">${{ $total_fee }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
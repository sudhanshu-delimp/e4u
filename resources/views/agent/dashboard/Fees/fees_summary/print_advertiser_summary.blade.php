<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Escort Report: {{ $datas['advertiser_name'] }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            color: #222;
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
        }

        h2 {
            border-bottom: 1px solid #10253f;
            color: #10253f;
            font-size: 14px;
            margin: 0 0 10px;
            padding-bottom: 7px;
        }

        table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #10253f;
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #10253f;
            color: #fff;
            font-weight: bold;
        }

        .label {
            text-align: left;
        }

        .amount {
            text-align: right;
            white-space: nowrap;
        }

        .year-row,
        .total-row,
        .grand-total-row {
            font-weight: bold;
        }

        .year-row {
            background: #e8edf3;
        }

        .total-row,
        .grand-total-row {
            background: #f2f4f7;
        }

        .year-column {
            width: 14%;
        }

        .spend-column {
            width: 8.5%;
        }

        .statistics-column {
            width: 8.75%;
        }
    </style>
</head>
<body>
    <h2>Escort Report: {{ $datas['advertiser_name'] }} (Member ID: {{ $datas['member_id'] }})</h2>
    <table>
        <colgroup>
            <col class="year-column">
            <col class="spend-column">
            <col class="spend-column">
            <col class="spend-column">
            <col class="spend-column">
            <col class="spend-column">
            <col class="spend-column">
            <col class="statistics-column">
            <col class="statistics-column">
            <col class="statistics-column">
            <col class="statistics-column">
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2">Financial Year / Location</th>
                <th colspan="6">Spend</th>
                <th colspan="4">Statistics</th>
            </tr>
            <tr>
                <th>Platinum</th>
                <th>Gold</th>
                <th>Silver</th>
                <th>PinUp</th>
                <th>Fixed</th>
                <th>Totals</th>
                <th>Listings</th>
                <th>Listing Days</th>
                <th>Tours</th>
                <th>Tour Days</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas['fy_data'] as $yearData)
                <tr class="year-row">
                    <td class="label">{{ $yearData['fy_label'] }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['platinum']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['gold']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['silver']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['pinup']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['fixed']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['total']) }}</td>
                    <td>{{ $yearData['fy_totals']['listings'] }}</td>
                    <td>{{ $yearData['fy_totals']['listing_days'] }}</td>
                    <td>{{ $yearData['fy_totals']['tours'] }}</td>
                    <td>{{ $yearData['fy_totals']['tour_days'] }}</td>
                </tr>
                @foreach ($yearData['states'] as $location => $spend)
                    <tr>
                        <td class="label">{{ $location }}</td>
                        <td class="amount">{{ formatCurrency($spend['platinum']) }}</td>
                        <td class="amount">{{ formatCurrency($spend['gold']) }}</td>
                        <td class="amount">{{ formatCurrency($spend['silver']) }}</td>
                        <td class="amount">{{ formatCurrency($spend['pinup']) }}</td>
                        <td class="amount">{{ formatCurrency($spend['fixed']) }}</td>
                        <td class="amount">{{ formatCurrency($spend['total']) }}</td>
                        <td>{{ $spend['listings'] }}</td>
                        <td>{{ $spend['listing_days'] }}</td>
                        <td>{{ $spend['tours'] }}</td>
                        <td>{{ $spend['tour_days'] }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td class="label">Totals</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['platinum']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['gold']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['silver']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['pinup']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['fixed']) }}</td>
                    <td class="amount">{{ formatCurrency($yearData['fy_totals']['total']) }}</td>
                    <td>{{ $yearData['fy_totals']['listings'] }}</td>
                    <td>{{ $yearData['fy_totals']['listing_days'] }}</td>
                    <td>{{ $yearData['fy_totals']['tours'] }}</td>
                    <td>{{ $yearData['fy_totals']['tour_days'] }}</td>
                </tr>
            @endforeach
            <tr class="grand-total-row">
                <td class="label">Grand Totals</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['platinum']) }}</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['gold']) }}</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['silver']) }}</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['pinup']) }}</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['fixed']) }}</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['total']) }}</td>
                <td>{{ $datas['grand_totals']['listings'] }}</td>
                <td>{{ $datas['grand_totals']['listing_days'] }}</td>
                <td>{{ $datas['grand_totals']['tours'] }}</td>
                <td>{{ $datas['grand_totals']['tour_days'] }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

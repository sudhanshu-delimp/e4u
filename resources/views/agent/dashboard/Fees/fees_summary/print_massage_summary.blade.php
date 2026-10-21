<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Massage Centre Report: {{ $datas['advertiser_name'] }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            color: #222;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
        }

        h2 {
            border-bottom: 1px solid #10253f;
            color: #10253f;
            font-size: 14px;
            margin: 0 0 10px;
            padding-bottom: 7px;
        }

        h3 {
            color: #10253f;
            font-size: 11px;
            margin: 12px 0 5px;
        }

        table {
            border-collapse: collapse;
            table-layout: auto;
            margin-bottom: 10px;
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
            padding: 4px 5px;
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

        .total-row {
            background: #f2f4f7;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Massage Centre Report: {{ $datas['advertiser_name'] }} (Member ID: {{ $datas['member_id'] ?: 'N/A' }})</h2>

    <h3>Spend</h3>
    <table>
        <thead>
            <tr>
                <th>Financial Year</th>
                <th>Spend</th>
                <th>Listings</th>
                <th>Total Days</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datas['fy_data'] as $fy)
                <tr>
                    <td class="label">{{ $fy['fy_label'] }}</td>
                    <td class="amount">{{ formatCurrency($fy['fy_totals']['total']) }}</td>
                    <td>{{ $fy['fy_totals']['listings'] }}</td>
                    <td>{{ $fy['fy_totals']['listing_days'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No listed massage purchases found.</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td class="label">Grand Totals</td>
                <td class="amount">{{ formatCurrency($datas['grand_totals']['total']) }}</td>
                <td>{{ $datas['grand_totals']['listings'] }}</td>
                <td>{{ $datas['grand_totals']['listing_days'] }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Masseur Statistics (Listings / Days)</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">Financial Year</th>
                @forelse ($datas['masseurs'] as $index => $masseur)
                    <th colspan="2">Masseur {{ $index + 1 }} ({{ $masseur->member_id ?: 'N/A' }})</th>
                @empty
                    <th colspan="2">No masseurs</th>
                @endforelse
            </tr>
            <tr>
                @forelse ($datas['masseurs'] as $masseur)
                    <th>Listings</th>
                    <th>Days</th>
                @empty
                    <th colspan="2">Statistics unavailable</th>
                @endforelse
            </tr>
        </thead>
        <tbody>
            @forelse ($datas['fy_data'] as $fy)
                <tr>
                    <td class="label">{{ $fy['fy_label'] }}</td>
                    @forelse ($datas['masseurs'] as $masseur)
                        <td>{{ $fy['masseurs'][$masseur->id]['listings'] ?? 0 }}</td>
                        <td>{{ $fy['masseurs'][$masseur->id]['days'] ?? 0 }}</td>
                    @empty
                        <td colspan="2">No statistics available.</td>
                    @endforelse
                </tr>
            @empty
                <tr>
                    <td colspan="{{ max(count($datas['masseurs']) * 2 + 1, 3) }}">No statistics available.</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td class="label">Grand Totals</td>
                @forelse ($datas['masseurs'] as $masseur)
                    <td>{{ $datas['grand_totals']['masseurs'][$masseur->id]['listings'] ?? 0 }}</td>
                    <td>{{ $datas['grand_totals']['masseurs'][$masseur->id]['days'] ?? 0 }}</td>
                @empty
                    <td colspan="2">No statistics available.</td>
                @endforelse
            </tr>
        </tbody>
    </table>
</body>
</html>

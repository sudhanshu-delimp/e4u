<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <title>Listing Report</title>

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
        <h2>Listing Report - {{ $advertiserType == 'massage' ?  ucfirst($advertiserType). ' Centre' : ucfirst($advertiserType) }}</h2>


    </div>

    <!-- <div class="info">
        <strong>Period :</strong>
        {{ $fromDate }} to {{ $toDate }}
    </div> -->

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Member ID </th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Days</th>

                @if($advertiserType == 'escort')
                <th>Type</th>
                <th>Pin Up</th>
                @endif

                <th>Listing Fee</th>
                <th>Agent Fee</th>
            </tr>
        </thead>

        <tbody>

            @forelse($advertisers as $row)

            @php
            $memberId = $row->advertiser->user->member_id ?? '';
            $member_type = "";


            $name = $advertiserType != 'massage' ? $row->advertiser->name : $row->advertiser->business_name;
            $mobile = $row->advertiser->phone ?? '';

            $startDate = $row->start_date ?? '';
            $endDate = $row->end_date ?? '';

            $totalDays = '';

            if ($startDate && $endDate) {
            $totalDays = Carbon\Carbon::parse($startDate)
            ->diffInDays(Carbon\Carbon::parse($endDate)) + 1;
            }

            $pinUp = '--';

            if ($advertiserType == 'escort') {
            $member_type = $row->membershipPlan->name;
            $pinUp = isset($row->advertiser->escort->pinup)
            && count($row->advertiser->escort->pinup) > 0
            ? 'Yes'
            : 'No';
            }

            $listingFee = $row->paid_rate ?? 0;

            if ($row->paymentItems && $row->paymentItems->payment && $row->paymentItems->payment->agent_commission_percent > 0) 
            {
                $payment = $row->paymentItems?->payment;
                if ($payment && $payment->agent_commission_percent > 0) 
                $agentFee = calculate_agent_commission($listingFee,$payment->agent_commission_percent);
                else
                $agentFee = 0.00;
            } 
            
            else {
            $agentFee = 0;
            }
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $memberId }}
                </td>

                <td>
                    {{ $name }}
                </td>

                <td>
                    {{ $mobile }}
                </td>

                <td>
                    {{ $startDate }}
                </td>

                <td>
                    {{ $endDate }}
                </td>

                <td class="text-center">
                    {{ $totalDays }}
                </td>

                @if($advertiserType == 'escort')
                  <td class="text-center">
                    {{ $member_type }}
                </td>

                <td class="text-center">
                    {{ $pinUp }}
                </td>
                @endif

                <td>
                    <div class="numValue">
                        <span class="currency">$</span>
                        <span class="amount">{{ formatCurrency($listingFee, '') }}</span>
                    </div>
                </td>

                <td>
                    <div class="numValue">
                        <span class="currency">$</span>
                        <span class="amount">{{ formatCurrency($agentFee, '') }}</span>
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
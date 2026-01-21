<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Member Report</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ url('/') . '/' . 'assets/dashboard/vendor/file-upload/css/fill-profile-details.css' }}"
        rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ url('/') . '/' . 'assets/dashboard/css/sb-admin-2.min.css' }}" rel="stylesheet">
    <link href="{{ url('/') . '/' . 'assets/dashboard/css/dk-style.css?v1.4' }}" rel="stylesheet">
    <link href="{{ url('/') . '/' . 'assets/dashboard/css/dk-responsive.css' }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .info-item {
            background: #f8faff;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .info-item label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .info-item span {
            font-size: 15px;
            font-weight: 500;
            color: #000;
        }

        .d-none {
            display: none !important;
        }

        .heading {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1px;
        }

        @page {
            size: A4;
        }

        /* Header */

        .page-number:before {
            content: counter(page);
        }

        .my-account-card {
            background-color: #fff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            max-width: 100%;
            margin: 0px auto !important;
            padding: 0px !important;
            border-radius: 10px;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
        }

        h6 {
            font-size: 16px;
        }

        .my-account-card .table td {
            vertical-align: middle;
        }


        table td {
            padding: .15rem .75rem .35rem .75rem !important;
        }

        table th {
            padding: .15rem .75rem .35rem .75rem !important;
            font-weight: 500;
            vertical-align: middle;

        }
    </style>
</head>

<body style="margin:0;width:100%">
    <div class="container1">
        @php
            $appointedDate = '';
            $agreementDate = '';
            $contactTypesText = '';
            $contactTypesArray = [];
            if (!empty($operator->operator_detail->date_appointed)) {
                $appointedDate = showDateWithFormat($operator->operator_detail->date_appointed, 'd-m-Y');
            }

            if (!empty($operator->operator_detail->agreement_date)) {
                $agreementDate = showDateWithFormat($operator->operator_detail->agreement_date, 'd-m-Y');
            }

            if (is_array($operator->contact_type)) {
                $contactType = $operator->contact_type;
            } elseif (!empty($operator->contact_type)) {
                $contactType = json_decode($operator->contact_type, true) ?? [];
            } else {
                $contactType = [];
            }
            if (count($contactType) > 0) {
                if (in_array('1', $contactType)) {
                    $contactTypesArray[] = 'Messaging';
                }
                if (in_array('2', $contactType)) {
                    $contactTypesArray[] = 'Text';
                }
                if (in_array('3', $contactType)) {
                    $contactTypesArray[] = 'Email';
                }
                if (in_array('4', $contactType)) {
                    $contactTypesArray[] = 'Call Us';
                }
            }
            $contactTypesText = implode(', ', $contactTypesArray);

           $countries = config('operator.country');
$countryName = isset($countries[$operator->country_id]['name']) ? $countries[$operator->country_id]['name'] : '';
        @endphp
        <div class="col-md-12 ">
            <div class="card mb-3 p-3">
                <div class="my-account-card">
                    <div class="card-head" style="display: flex; justify-content:space-between;align-items:center;">
                        <h2>Operator Report</h2>
                    </div>
                    <!-- Avatar + Name -->
                    <div style="margin-left:-10px;">
                        <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar"
                            style="vertical-align:middle; border-radius:50%; margin-right:10px;" width="50"
                            height="50">

                        <h6 style="display:inline-block; vertical-align:middle; margin:0;">
                            {{ $operator->name }}
                        </h6>
                    </div>

                    <h6 class=" text-blue-primary">Merchant Details</h6>
                    <table class="table table-bordered mb-3">
                        <tr>
                            <th width="40%">Operator ID</th>
                            <td width="60%">{{ $operator->member_id }}</td>
                        </tr>
                        <tr>
                            <th>Date Appointed</th>
                            <td>{{ $appointedDate }}</td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $operator->name }}</td>
                        </tr>
                        <tr>
                            <th>Business Name</th>
                            <td>{{ $operator->business_name }}</td>
                        </tr>
                        <tr>
                            <th>ABN</th>
                            <td>{{ $operator->abn }}</td>
                        </tr>
                        <tr>
                            <th>Business Address</th>
                            <td>{{ $operator->business_address }}</td>
                        </tr>
                        <tr>
                            <th>Business Number</th>
                            <td>{{ $operator->business_number }}</td>
                        </tr>
                        <tr>
                            <th>Point of Contact</th>
                            <td>{{ $operator->operator_detail->point_of_contact }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $operator->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $operator->email }}</td>
                        </tr>
                        <tr>
                            <th>Territory</th>
                            <td>{{ $countries }}</td>
                        </tr>
                        <tr>
                            <th>Method of Contact</th>
                            <td>{{ $contactTypesText }}</td>
                        </tr>
                    </table>

                    <!-- Agreement Details -->
                    <h6 class=" text-blue-primary">Agreement Details</h6>
                    <table class="table table-bordered mb-3">
                        <tr>
                            <th width="40%">Agreement Date</th>
                            <td width="60%">{{ $agreementDate }}</td>
                        </tr>
                        <tr>
                            <th>Term</th>
                            <td>{{ $operator->operator_detail->term }}</td>
                        </tr>
                        <tr>
                            <th>Fees</th>
                            <td>{{ $operator->operator_detail->fee }}</td>
                        </tr>
                    </table>
                    <!-- Commission -->
                    <h6 class=" text-blue-primary">Commission</h6>
                    <table class="table table-bordered mb-3">
                        <tr>
                            <th width="40%">Advertising</th>
                            <td width="60%">{{ $operator->operator_detail->commission_advertising_percent }}%</td>
                        </tr>
                        <tr>
                            <th>Massage Centre (Registrations)</th>
                            <td>{{ $operator->operator_detail->commission_massage_centre_percent }}%</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

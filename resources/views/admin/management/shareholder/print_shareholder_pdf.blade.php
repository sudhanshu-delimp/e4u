<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shareholder Report</title>


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
            padding: .75rem .75rem .75rem .75rem !important;
        }

        table th {
            padding: .75rem .75rem .75rem .75rem !important;
            font-weight: 500;
            vertical-align: middle;

        }
    </style>
</head>

<body style="margin:0;width:100%">
    <div class="container1">

        <div class="col-md-12 ">
            <div class="card mb-3 p-3">
                <div class="my-account-card">
                    <div class="card-head" style="display: flex; justify-content:space-between;align-items:center;">
                        <h2>Shareholder Report</h2>
                    </div>
                    <!-- Avatar + Name -->
                    @php
                        $setting = $shareholder->shareholder_setting ?? null;
                        $idle_preference_times = config('staff.idle_preference_time');
                        $idle_preference_time = '';
                        $twofa = '';
                        if (isset($setting) && isset($setting->idle_preference_time)) {
                            $idle_preference_time = isset(
                                $idle_preference_times[(string) $setting->idle_preference_time],
                            )
                                ? $idle_preference_times[$setting->idle_preference_time]
                                : '';
                        }
                        $twofas = config('staff.twofa');
                        if (isset($setting) && isset($setting->twofa)) {
                            $twofa = isset($twofas[$setting->twofa]) ? $twofas[$setting->twofa] : '';
                        }

                        $contactTypesText = '';
                        $contactTypesArray = [];
                        if (is_array($shareholder->contact_type)) {
                            $contactType = $shareholder->contact_type;
                        } elseif (!empty($shareholder->contact_type)) {
                            $contactType = json_decode($shareholder->contact_type, true) ?? [];
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
                        $contactKey = 1;
                    @endphp

                    <!-- Avatar + Name -->
                    <div style="margin-left:-10px;margin-bottom:10px;">
                        <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar"
                            style="vertical-align:middle; border-radius:50%; margin-right:10px;" width="50"
                            height="50">

                        <h6 style="display:inline-block; vertical-align:middle; margin:0;">
                            {{ $shareholder->contact_person }}
                        </h6>
                    </div>
                    <!-- Details Table -->
            <div class="col-12 my-2">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th width="40%">Shareholder</th>
                        <td width="60%">{{ $shareholder->business_name }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $shareholder->business_address }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 my-2">
                <h6 class="text-blue-primary">Primary Contact</h6>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Contact</th>
                            <td width="60%">{{ $shareholder->contact_person }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $shareholder->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $shareholder->email }}</td>
                        </tr>
                    </tbody>
                </table>
                 <!-- Key Contact -->
            @if ($shareholder->contacts)
                @foreach ($shareholder->contacts as $contact)
                 <h6 class="text-blue-primary">Key Contact {{ $contactKey }}</h6>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Contact</th>
                            <td width="60%">{{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $contact->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                    </tbody>
                </table>
                 @php
                        $contactKey = $contactKey + 1;
                    @endphp
                @endforeach
            @endif
            <!-- End Key Contact -->
            </div>
            <div class="col-12 my-2">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Method of Contact</th>
                            <td width="60%">{{ $contactTypesText }}</td>
                        </tr>
                        <tr>
                            <th>Idle Time Preference</th>
                            <td>{{ $idle_preference_time }}</td>
                        </tr>
                        <tr>
                            <th>2FA Authentication</th>
                            <td>{{ $twofa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

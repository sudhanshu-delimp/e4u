@php
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Member Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:ital,wght@0,200;0,400;1,200&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/app/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/dashboard/vendor/file-upload/css/fill-profile-details.css') }}" rel="stylesheet"
        type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-style.css?v1.4') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/dk-responsive.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        h2 {
            font-weight: bold
        }

        .print-btn {
            padding: 8px 14px;
            background: #0d6efd;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

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

        .btn-cancel-modal {
            background-color: #ff3c5f;
            color: var(--white);
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            color: #fff;
        }

        .print-btn {
            background-color: #0c223d;
            color: var(--white);
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            color: #fff;
        }

        @media print {
            body {
                background: none;
            }

            .print-btn {
                display: none;
            }

            .btn-cancel-modal {
                display: none;
            }

            .container {
                box-shadow: none;
                border: 1px solid #ccc;
            }
        }

        .heading {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        @php
            $employmentStatuss = config('staff.employment_status');
            $employmentStatus = isset($employmentStatuss[$staff->staff_detail->employment_status])
                ? $employmentStatuss[$staff->staff_detail->employment_status]
                : '';
            $securityLevels = config('staff.security_level');
            $securityLevel = isset($securityLevels[$staff->staff_detail->security_level])
                ? $securityLevels[$staff->staff_detail->security_level]
                : '';
            $genders = config('escorts.profile.genders');
            $gender = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';
            $cities = config('escorts.profile.cities');
            $city = isset($cities[$staff->city_id]) ? $cities[$staff->city_id] : '';

                 $setting = $staff->staff_setting??null;
        $idle_preference_times = config('staff.idle_preference_time');
        $idle_preference_time = "";
         $twofa = "";
        if(isset( $setting) && (isset($setting->idle_preference_time) || $setting->idle_preference_time === null)) {
            $idle_preference_time = isset($idle_preference_times[(string)$setting->idle_preference_time]) ? $idle_preference_times[$setting->idle_preference_time] : "";
        }
        $twofas = config('staff.twofa');
        if(isset( $setting) && isset($setting->twofa)) {
        $twofa = isset($twofas[$setting->twofa]) ? $twofas[$setting->twofa] : "";
        }
        @endphp
        <div class="col-md-12  my-2" id="printArea">
            <div class="my-account-card">
                <div class="card-head" style="display: flex; justify-content:space-between;align-items:center;">
                    <h2>Staff Member Repord</h2>
                    <form>
                        <button type="button" class="print-btn" onclick="window.print()"><span
                                style="font-size: 12px;">🖨️</span>Print Report</button>
                        <a href="{{ url()->previous() }}" class="btn-cancel-modal" id="cancel_print_report"
                            style="text-decoration: none;">Close</a>
                    </form>
                </div>

                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Member ID</th>
                            <td width="60%">{{ $staff->member_id }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Full Name</th>
                            <td width="60%">{{ $staff->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td> {{ $staff->staff_detail->address }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $staff->phone }}</td>
                        </tr>
                        <tr>
                            <th>Private Email</th>
                            <td>{{ $staff->email }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $gender }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Next of Kin Section -->
              
                    <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>

                    <table class="table table-bordered mb-3">
                        <tbody>
                            <tr>
                                <th width="40%">Name of Kin</th>
                                <td width="60%">{{ $staff->staff_detail->kin_name }}</td>
                            </tr>
                            <tr>
                                <th>Relationship</th>
                                <td> {{ $staff->staff_detail->kin_relationship }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $staff->staff_detail->kin_mobile }}</td>
                            </tr>
                            <tr>
                                <th>Email (optional)</th>
                                <td>{{ $staff->staff_detail->kin_email }}</td>
                            </tr>
                        </tbody>
                    </table>
            
                <!-- Section: Other Details -->
               
                    <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>

                    <table class="table table-bordered mb-3">
                        <tbody>
                            <tr>
                                <th>Security Level</th>
                                <td>{{ $securityLevel }}</td>
                            </tr>
                            <tr>
                                <th width="40%">Position</th>
                                <td width="60%">{{ $staff->staff_detail->position($staff->staff_detail->position) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td> {{ $city }}</td>
                            </tr>
                            <tr>
                                <th>Commenced Date</th>
                                <td>{{ showDateWithFormat($staff->staff_detail->commenced_date, 'd/m/Y') }}</td>
                            </tr>

                            <tr>
                                <th>Employment Status</th>
                                <td>{{ $employmentStatus }}</td>
                            </tr>
                            <tr>
                                <th>Employment Agreement</th>
                                <td>{{ ucfirst($staff->staff_detail->employment_agreement) }}</td>
                            </tr>
                        </tbody>
                    </table>
            
                <!-- Section: Building Security -->
             
                    <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
                    <table class="table table-bordered mb-3">
                        <tbody>
                            <tr>
                                <th width="40%">Building Security</th>
                                <td width="60%">{{ ucfirst($staff->staff_detail->building_access_code) }}</td>
                            </tr>
                            <tr>
                                <th>Key Provided?</th>
                                <td> {{ ucfirst($staff->staff_detail->keys_issued) }}</td>
                            </tr>
                            <tr>
                                <th>Car Park?</th>
                                <td>{{ ucfirst($staff->staff_detail->car_parking) }}</td>
                            </tr>
                        </tbody>
                    </table>

                   
               
                <table class="table table-bordered mb-3">
                    <tbody>
                        <tr>
                            <th width="40%">Idle Time Preference</th>
                            <td width="60%">{{$idle_preference_time}}</td>
                        </tr>
                        <tr>
                            <th width="40%">2FA Authentication</th>
                            <td width="60%">{{ $twofa }}</td>
                        </tr>
                    </tbody>
                </table>
           
                </div>
        </div>
    </div>
</body>
</html>

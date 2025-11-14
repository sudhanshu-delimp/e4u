@php
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account Report</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
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

<body  onload="window.print()">
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
        @endphp
        <div class="col-md-12 " id="printArea">
            <div class="my-account-card">
                <div class="card-head" style="display: flex; justify-content:space-between;align-items:center;">
                    <h2 style="font-weight: 500;">My Account Details </h2>
                    <form>
                        <button type="button" class="print-btn" onclick="window.print()"><span
                                style="font-size: 12px;">🖨️</span> Print Report</button>
                        <a href="{{ url()->previous() }}" class="btn-cancel-modal" id="cancel_print_report"
                            style="text-decoration: none;">Close</a>
                    </form>
                </div>
                <h5 class="heading">Personal Details</h5>
                <div class="info-grid">
                    <div class="info-item {{ $staff->member_id == '' ? 'd-none' : '' }}">
                        <label>Member ID</label>
                        <span class="account_member_id">{{ $staff->member_id }}</span>
                    </div>
                    <div class="info-item {{ $staff->name == '' ? 'd-none' : '' }}">
                        <label>Full Name</label>
                        <span class="account_member_name">{{ $staff->name }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->address == '' ? 'd-none' : '' }}">
                        <label>Address</label>
                        <span class="account_ip_address">{{ $staff->staff_detail->address }}</span>
                    </div>
                    <div class="info-item {{ $staff->phone == '' ? 'd-none' : '' }}">
                        <label>Phone</label>
                        <span class="account_platform">{{ $staff->phone }}</span>
                    </div>
                    <div class="info-item {{ $staff->email == '' ? 'd-none' : '' }}">
                        <label>Private Email</label>
                        <span class="account_visit_page">{{ $staff->email }}</span>
                    </div>
                </div>

                <h5 class="heading">Next of Kin (Emergency Contact)</h5>
                <div class="info-grid">
                    <div class="info-item {{ $staff->staff_detail->kin_name == '' ? 'd-none' : '' }}">
                        <label>Kin of Name</label>
                        <span class="account_member_id">{{ $staff->staff_detail->kin_name }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->kin_relationship == '' ? 'd-none' : '' }}">
                        <label>Relationship</label>
                        <span class="account_member_name">{{ $staff->staff_detail->kin_relationship }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->kin_mobile == '' ? 'd-none' : '' }}">
                        <label>Mobile</label>
                        <span class="account_ip_address">{{ $staff->staff_detail->kin_mobile }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->kin_email == '' ? 'd-none' : '' }}">
                        <label>Email</label>
                        <span class="account_platform">{{ $staff->staff_detail->kin_email }}</span>
                    </div>
                </div>

                <h5 class="heading">Other Details</h5>
                <div class="info-grid">
                     <div class="info-item {{ $securityLevel == '' ? 'd-none' : '' }}">
                        <label>Security Level</label>
                        <span class="account_platform">{{ $securityLevel }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->position == '' ? 'd-none' : '' }}">
                        <label>Position</label>
                        <span class="account_member_id">{{ $staff->staff_detail->position($staff->staff_detail->position) }}</span>
                    </div>
                    <div class="info-item {{ $city == '' ? 'd-none' : '' }}">
                        <label>Location</label>
                        <span class="account_member_name">{{ $city }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->commenced_date == '' ? 'd-none' : '' }}">
                        <label>Commenced Date</label>
                        <span class="account_ip_address">{{showDateWithFormat($staff->staff_detail->commenced_date, "d/m/Y")}}</span>
                    </div>
                   
                    <div class="info-item {{ $employmentStatus == '' ? 'd-none' : '' }}">
                        <label>Employment Status</label>
                        <span class="account_visit_page">{{ $employmentStatus }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->employment_agreement == '' ? 'd-none' : '' }}">
                        <label>Employment Agreement</label>
                        <span
                            class="account_visit_page">{{ ucfirst($staff->staff_detail->employment_agreement) }}</span>
                    </div>
                </div>
                <h5 class="heading">Building Security</h5>
                <div class="info-grid">
                    <div class="info-item {{ $staff->staff_detail->building_access_code == '' ? 'd-none' : '' }}">
                        <label>Building Security</label>
                        <span class="account_member_id">{{  ucfirst($staff->staff_detail->building_access_code) }}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->keys_issued == '' ? 'd-none' : '' }}">
                        <label>Key Provided?</label>
                        <span class="account_member_name">{{  ucfirst($staff->staff_detail->keys_issued )}}</span>
                    </div>
                    <div class="info-item {{ $staff->staff_detail->car_parking == '' ? 'd-none' : '' }}">
                        <label>Car Park?</label>
                        <span class="account_ip_address">{{  ucfirst($staff->staff_detail->car_parking) }}</span>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</body>

</html>

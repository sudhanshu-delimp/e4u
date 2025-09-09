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
            padding: 15px;
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
        .d-none{
            display: none !important;
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
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="col-md-12 " id="printArea">
            <div class="my-account-card">
                <div class="card-head">

                    <h2>My Account details </h2>

                </div>
                <div class="info-grid">
                    <div class="info-item {{ $userData['account_member_id'] != null ? '' : 'd-none' }}">
                        <label>Member ID</label>
                        <span class="account_member_id">{{$userData['account_member_id']}}</span>
                    </div>
                    <div class="info-item {{ $userData['account_member_name'] != null ? '' : 'd-none' }}">
                        <label>Member</label>
                        <span class="account_member_name">{{ $userData['account_member_name'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_ip_address'] != null ? '' : 'd-none' }}">
                        <label>IP Address</label>
                        <span class="account_ip_address">{{ $userData['account_ip_address'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_platform'] != null ? '' : 'd-none' }}">
                        <label>Platform</label>
                        <span class="account_platform">{{ $userData['account_platform'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_visit_page'] != null ? '' : 'd-none' }}">
                        <label>Page</label>
                        <span class="account_visit_page">{{ $userData['account_visit_page'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_listed_profile_count'] != null ? '' : 'd-none' }}">
                        <label>Listed Profiles (Escort)</label>
                        <span class="account_listed_profile_count">{{ $userData['account_listed_profile_count'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_masseurs_count'] != null ? '' : 'd-none' }}">
                        <label>Published Masseurs (Massage Centre)</label>
                        <span class="account_masseurs_count">{{ $userData['account_masseurs_count'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_massage_legbox'] != null ? '' : 'd-none' }}">
                        <label>Massage Legboxes (Massage Centre)</label>
                        <span class="account_massage_legbox">{{ $userData['account_massage_legbox'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_list_adervtiser_count'] != null ? '' : 'd-none' }}">
                        <label>List Advertisers (Escort)</label>
                        <span class="account_list_adervtiser_count">{{ $userData['account_list_adervtiser_count'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_legbox_count'] != null ? '' : 'd-none' }}">
                        <label>Escort Legboxes (Viewer)</label>
                        <span class="account_legbox_count">{{ $userData['account_legbox_count'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_escort_playmates'] != null ? '' : 'd-none' }}">
                        <label>Playmates</label>
                        <span class="account_escort_playmates">{{ $userData['account_escort_playmates'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_refer_by_advertiser_agent'] != null ? '' : 'd-none' }}">
                        <label>Reffered By Advertisers</label>
                        <span class="account_refer_by_advertiser_agent">{{ $userData['account_refer_by_advertiser_agent'] }}</span>
                    </div>
                    <div class="info-item {{ $userData['account_refer_by_massage_center_agent'] != null ? '' : 'd-none' }}">
                        <label>Reffered By Massage Centers</label>
                        <span class="account_refer_by_massage_center_agent">{{ $userData['account_refer_by_massage_center_agent'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

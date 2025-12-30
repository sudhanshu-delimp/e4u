<?php

return [
    'supportTicket' => [
        'statuses' => [
            '1' => 'Active',
            '2' => 'In-progress',
            '3' => 'Resolved',
            '4' => 'Withdrawn'
        ],
        'priorities' => [
            'Normal',
            'Urgent',
            'High',
            'Low'
        ]
    ],

    
    'contactus_admin_email' => env('CONTACTUS_ADMIN_EMAIL', 'admin@e4u.com.au'),
    'contactus_cc_email' => env('CONTACTUS_CC_EMAIL', 'rizwan.khan@delimp.com'),
    
    'feedback_subject' => [
        '1' => 'Complaint',
        '2' => 'Complement',
        '3' => 'Improvement suggestion',
        '4' => 'New feature suggestion',
        '5' => 'Report Advertiser (include Member ID)',
        '6' => 'Request for Information',
        '7' => 'Report a bug in the Website',
        '8' => 'Report Scammer',
    ],
    'access_denied_suspended_msg' => env('ACCESS_DENIED_SUSPENDED_MSG', 'Your membership has been Suspended due to a Report'),
];

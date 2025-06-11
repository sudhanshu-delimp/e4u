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
];

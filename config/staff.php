<?php

return [
    'employment_status' => [
        'full_time' => 'Full Time',
        'part_time' => 'Part Time',
        'casual'  => 'Casual',
        'contractor' > 'Contractor',
    ],
    'security_level' => [
        '1' => 'Level 1',
        '2' => 'Level 2',
        '3' => 'Level 3',
        '4' => 'Level 4',
    ],
    'position' => [
        '1' => 'Managing Director',
        '2' => 'Director',
        '3' => 'Staff',
        '4' => 'Developer',
    ],
    'staff_role_type' => '1',
    'staff_member_id_prefix' => 'S',
    'access_denied_msg' => env('ACCESS_DENIED_MSG', 'Access denied. You do not have permission to view this page'),

    /**
     * Permission to access pages
     */
    "page_access" => [
        "1" => [ //Level 1: Managing Director
            "sidebar" => ['management' => ['yesNo' => 'yes']],
            "view" => ['yesNo' => 'yes'],
            "edit" => ['yesNo' => 'yes'],
            "add" => ['yesNo' => 'yes'],
            "delete" => ['yesNo' => 'yes'],
        ], //All access
        "2" => [ //Level 2: Director
            "sidebar" => ['management' =>  ['yesNo' => 'no']],
            "view" => ['yesNo' => 'yes'],
            "edit" => ['yesNo' => 'no'],
            "add" => ['yesNo' => 'no'],
            "delete" => ['yesNo' => 'no'],
        ],
        "3" => [ //Level 3: Staff
            "sidebar" => ['management' =>  ['yesNo' => 'no']],
            "view" => ['yesNo' => 'yes'],
            "edit" => ['yesNo' => 'yes'],
            "add" => ['yesNo' => 'no'],
            "delete" => ['yesNo' => 'no'],
        ],
        "4" => [ //Level 4: Developer
            "sidebar" => ['management' =>  ['yesNo' => 'yes']],
            "view" => ['yesNo' => 'yes'],
            "edit" => ['yesNo' => 'no'],
            "add" => ['yesNo' => 'no'],
            "delete" => ['yesNo' => 'no'],
        ]
    ],

    'idle_preference_time' => [
        '15' => '15 minutes',
        '30' => '30 minutes',
        '60' => '60 minutes',
        '99999999' => 'Never',
    ],

    'twofa' => [
        '1' => 'Email',
        '2' => 'Text',
    ],

    "admin_management_url_endpoint" => [
        'email-management',
        'sim-management',
        'logs-staff',
        'marketing-templates-e4u',
        'marketing-templates-agents',
        'post-office',
        'set-fees',
        'manage-user',
        'memberships',
        'legbox-report',
        'agents-monthly-report',
        'punterbox-reports',
        'tours',
        'staff',
        'competitor-database',
        'monthly-fee-reports',
        'commission-summary',
        'operator-manage',
        'profile',
        'agent',
        'manage-suppliers',
        'dashboard',
        'All-user',
        'email-templates',
        'annual-report',
        'minutes',
        'annual-profit-and-loss',
        'balance-sheet',
        'constitution',
        'newsletter',
        'shareholder-notices',
        'subsidiaries-balance-sheet',
        'subsidiaries-annual-profit-and-loss',
        'updates',
        'influencer'
    ],
    'genders' => [
			'6' => 'Female',
			'1' => 'Male',
		],
    'idle_vever_minute' => '99999999',
];

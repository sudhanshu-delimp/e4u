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
    'staff_role_type' => '6',
    'staff_member_id_prefix' => 'S',
    'access_denied_msg' => env('ACCESS_DENIED_MSG','Access denied. You do not have permission to view this page'),

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
    ]
];

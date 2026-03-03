<?php

return [
    'employment_status' => [
        'full_time' => 'Full Time',
        'part_time' => 'Part Time',
        'casual'  => 'Casual',
        'contractor' => 'Contractor',
    ],
    'security_level' => [
        '1' => 'Level 1',
        '2' => 'Level 2',
        //'3' => 'Level 3',
       // '4' => 'Level 4',
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

    'position' => [
        '1' => 'Admin',
        '2' => 'Staff',
       // '3' => 'Staff',
       // '4' => 'Developer',
    ],
    'staff_role_type' => '9',
    'staff_member_id_prefix' => 'OS',
    'access_denied_msg' => env('ACCESS_DENIED_MSG', 'Access denied. You do not have permission to view this page'),

    'genders' => [
			'6' => 'Female',
			'1' => 'Male',
		],
    'idle_vever_minute' => '99999999',

    /**
     * Permission to access pages
     */
    "page_access" => [
        "1" => [ //Level 1: Admin,  All access
            "sidebar" => ['management' => ['yesNo' => 'yes']],
            "view" => ['yesNo' => 'yes'],
            "edit" => ['yesNo' => 'yes'],
            "add" => ['yesNo' => 'yes'],
            "delete" => ['yesNo' => 'yes'],
        ],
        "2" => [ //Level 2: Staff
            "sidebar" => ['management' =>  ['yesNo' => 'no']],
            "view" => ['yesNo' => 'yes'],
            "edit" => ['yesNo' => 'no'],
            "add" => ['yesNo' => 'no'],
            "delete" => ['yesNo' => 'no'],
        ]
        
    ],
    /**
     * 1: Staff add/edit only under selected operator
     */
    'staff_add_edit_under_selected_operatory_county' => env('STAFF_ADD_EDIT_UNDER_SELECTED_OPERATOR_COUNTY', false),
];



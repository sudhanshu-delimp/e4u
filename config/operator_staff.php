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
];



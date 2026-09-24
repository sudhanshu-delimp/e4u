<?php

return [
    'supportTicket' => [
        'departments' => [
            'Accounts',
            'Photo verification',
            'Support',
            'Technical',
            'Website Report'
        ],
        'services' => [
            // 'Alert notifications',
            // 'Escort Agent',
            // 'Viewer review',
            // 'Ugly Mugs register',
            // 'Other',

            'Advertiser Listings',
            'Advertiser Media',
            'Advertiser Profile Information',
            'Advertiser Profiles',
            'My Account',
            'My Information',
            'Fees',
            'Notifications & Features',
            'Other',
        ]
    ],

    'advertising' => [
        [
            'membership_type' => 'Platinum',
            'period' => 'Fixed',
            'frequency' => 'per day',
            'rate' => 8.00,
            'discount_percent' => 6.25,
            'discounted_rate' => 7.50,
        ],
        [
            'membership_type' => 'Gold',
            'period' => 'Fixed',
            'frequency' => 'per day',
            'rate' => 6.00,
            'discount_percent' => 5,
            'discounted_rate' => 5.70,
        ],
        [
            'membership_type' => 'Silver',
            'period' => 'Fixed',
            'frequency' => 'per day',
            'rate' => 4.00,
            'discount_percent' => 5,
            'discounted_rate' => 3.80,
        ],
        [
            'membership_type' => 'Free<sup>(3)</sup>',
            'period' => '21 days',
            'frequency' => 'per day',
            'rate' => 0.00,
            'discount_percent' => null,
            'discounted_rate' => 0.00,
        ],
        [
            'membership_type' => 'Pin-Up<sup>(4)</sup>',
            'period' => 'Fixed',
            'frequency' => 'per week',
            'rate' => 475.00,
            'discount_percent' => 0.00,
            'discounted_rate' => 475.00,
        ],
    ],


    'membership_types' => ['Platinum', 'Gold', 'Silver'],
    'no_of_members' => ['1', '2', '3', '4', '5'],

    'cities' => [
        "3919" => "Adelaide",
        "4411" => "Brisbane",
        "4566" => "Canberra",
        "4947" => "Darwin",
        "5621" => "Hobart",
        "6235" => "Melbourne",
        "6839" => "Perth",
        "7408" => "Sydney",
    ],

    'nz_cities' => [
        "4059" => "North Island",
        "4071" => " South Island",
    ],


    'statesName' => [
        "Australian Capital Territory" => 1,
        "New South Wales" => 2,
        "Victoria" => 3,
        "Queensland" => 4,
        "South Australia" => 5,
        "Western Australia" => 6,
        "Tasmania" => 7,
        "Northern Territory" => 8,
        "Uttar Pradesh" => 9,
        "Delhi" => 10,
    ],


    'states' => [
        '4008' => [
            "stateName" => 'Maharashtra',
            'stateAbbr' => 'MH',
            'timeZone' => 'Asia/Kolkata',
            'cities' => [
                133504 => [
                    'cityName' => 'Pune',
                    'timeZone' => 'Asia/Kolkata',
                ],
            ],
        ],
        '4022' => [
            "stateName" => 'Uttar Pradesh',
            'stateAbbr' => 'UP',
            'timeZone' => 'Asia/Kolkata',
            'cities' => [
                57601 => [
                    'cityName' => 'Agra',
                    'timeZone' => 'Asia/Kolkata',
                ],
            ],
        ],
        '4021' => [
            "stateName" => 'Delhi',
            'stateAbbr' => 'DL',
            'timeZone' => 'Asia/Kolkata',
            'cities' => [
                131679 => [
                    'cityName' => 'Delhi',
                    'timeZone' => 'Asia/Kolkata',
                ],
            ],
        ],
        '3907' => [
            "stateName" => 'Australian Capital Territory',
            'stateAbbr' => 'ACT',
            'timeZone' => 'Australia/Sydney',
            'cities' => [
                4566 => [
                    'cityName' => 'Canberra',
                    'timeZone' => 'Australia/Sydney',
                ],
            ],
        ],
        '3909' => [
            "stateName" => 'New South Wales',
            'stateAbbr' => 'NSW',
            'timeZone' => 'Australia/Sydney',
            'cities' => [
                7408 => [
                    'cityName' => 'Sydney',
                    'timeZone' => 'Australia/Sydney',
                ],
            ],
        ],
        '3910' => [
            "stateName" => 'Northern Territory',
            'stateAbbr' => 'NT',
            'timeZone' => 'Australia/Darwin',
            'cities' => [
                4947 => [
                    'cityName' => 'Darwin',
                    'timeZone' => 'Australia/Darwin',
                ],
            ],
        ],
        '3905' => [
            "stateName" => 'Queensland',
            'stateAbbr' => 'QLD',
            'timeZone' => 'Australia/Brisbane',
            'cities' => [
                4411 => [
                    'cityName' => 'Brisbane',
                    'timeZone' => 'Australia/Brisbane',
                ],
            ],
        ],
        '3904' => [
            "stateName" => 'South Australia',
            'stateAbbr' => 'SA',
            'timeZone' => 'Australia/Adelaide',
            'cities' => [
                3919 => [
                    'cityName' => 'Adelaide',
                    'timeZone' => 'Australia/Adelaide',
                ],
            ],
        ],
        '3908' => [
            "stateName" => 'Tasmania',
            'stateAbbr' => 'TAS',
            'timeZone' => 'Australia/Hobart',
            'cities' => [
                5621 => [
                    'cityName' => 'Hobart',
                    'timeZone' => 'Australia/Hobart',
                ],
            ],
        ],
        '3903' => [
            "stateName" => 'Victoria',
            'stateAbbr' => 'VIC',
            'timeZone' => 'Australia/Melbourne',
            'cities' => [
                6235 => [
                    'cityName' => 'Melbourne',
                    'timeZone' => 'Australia/Melbourne',
                ],
            ],
        ],
        '3906' => [
            "stateName" => 'Western Australia',
            'stateAbbr' => 'WA',
            'timeZone' => 'Australia/Perth',
            'cities' => [
                6839 => [
                    'cityName' => 'Perth',
                    'timeZone' => 'Australia/Perth',
                ],
            ],
        ],
    ],

];

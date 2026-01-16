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


        'membership_types' => ['Platinum', 'Gold' , 'Silver'],
        'no_of_members' => ['1', '2','3','4','5'],


];

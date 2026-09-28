<?php

    return [
        'default_country' => 'Australia',
        'escorts' => [
            'levels' => [
                0 => 'escort_page',
                1 => 'country',
                2 => 'country_gender',
                3 => 'city',
                4 => 'city_gender',
                5 => 'listing',
                6 => 'profile'
            ],
            
            'segment_map' => [
                'escort_page'    => ['country'],
                'country'        => ['country'],
                'country_gender' => ['country', 'gender'],
                'city'           => ['country', 'state', 'city'],
                'city_gender'    => ['country', 'state', 'city', 'gender'],
                'listing'        => ['country', 'state', 'city', 'gender', 'listingId'],
                'profile'        => ['country', 'state', 'city', 'gender', 'listingId', 'profileId'],
            ],
            
            'templates' => [
                'escort_page' => [
                    'title' => 'Find Independent Escort Services | Book Now | Escorts4U',
                    'description' => 'Find and book Independent private Escort Services. Explore 100% verified profiles with real photos, detailed service lists, and immediate availability.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],

                'country' => [
                    'title' => 'Find Escort Services in {country} | Book Now | Escorts4U',
                    'description' => 'Find and book Independent Escort Services in {country}. Explore 100% verified profiles with real photos, detailed service lists, and immediate availability.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],

                'country_gender' => [
                    'title' => 'Book {gender} Escort Services in {country} | Escorts4U',
                    'description' => 'Find and book {gender} Escort Services in Australia. Explore 100% verified profiles with real photos, detailed service lists, and immediate availability.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'city' => [
                    'title' => 'Book {city} Escorts | Services Available | Escorts4U',
                    'description' => 'Find and book {city} Escorts in {country}. Explore 100% verified profiles with real photos, detailed service lists, and immediate availability.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'city_gender' => [
                    'title' => '{city} {gender} Escorts Listings| Escorts4U',
                    'description' => 'Find and book {city} {gender} Escorts in {country}. Explore 100% verified profiles with real photos, detailed service lists, and immediate availability.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],

                'listing' => [
                    'title'       => '{city} {gender} Escorts Listings| Escorts4U',
                    'description' => "Find and book {city} {gender} Escorts in {country}. Explore 100% verified profiles with real photos, detailed service lists, and immediate availability.",
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),

                ],

                'profile' => [
                    'title' => '{city} {gender} Escorts | Escorts4U | {pro_name}',
                    'description' => 'Book {pro_name}, a verified {city} {gender} escorts. Explore a 100% verified profile with real photos, services, and immediate availability.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
            ],  
        ],

        'massage' => [
            'levels' => [
                0 => 'massage_page',
                1 => 'country',
                2 => 'state',
                3 => 'city',
                4 => 'listing',
                5 => 'profile',
            ],

            'segment_map' => [
                'massage_page' => ['country'],
                'country' => ['country'],
                'state'   => ['country', 'state'],
                'city'    => ['country', 'state', 'city'],
                'listing' => ['country', 'state', 'city', 'listingId'],
                'profile' => ['country', 'state', 'city', 'listingId', 'MprofileId'],
            ],

            'templates' => [
                'massage_page' => [
                    'title' => 'Massage Centers in {country} | YourSite',
                    'description' => 'Browse verified massage centers across {country}. Updated listings daily.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],

                'country' => [
                    'title' => 'Massage Centers in {country} | YourSite',
                    'description' => 'Browse verified massage centers across {country}. Updated listings daily.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'state' => [
                    'title' => 'Massage Centers in {state}, {country} | YourSite',
                    'description' => 'Find massage centers across {state}, {country}. Verified listings.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'city' => [
                    'title' => 'Massage Centers in {city}, {state}, {country} | YourSite',
                    'description' => 'Find top-rated massage centers in {city}. Verified listings, real reviews.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'listing' => [
                    'title' => '{name} - Massage Center in {city} | YourSite',
                    'description' => 'Detailed listing of {name}, massage center in {city}.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'profile' => [
                    'title' => '{mc_pro_name} - Massage Center in {city} | YourSite',
                    'description' => 'Detailed listing of {mc_pro_name}, massage center in {city}.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
            ],
        ],
    ];
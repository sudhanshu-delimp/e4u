<?php

    return [
        'default_country' => 'Australia',
        'escorts' => [
            'levels' => [
                0 => 'country',
                1 => 'country',
                2 => 'country_gender',
                3 => 'city',
                4 => 'city_gender',
                5 => 'listing',
                6 => 'profile'
            ],
            
            'segment_map' => [
                'country'        => ['country'],
                'country_gender' => ['country', 'gender'],
                'city'           => ['country', 'state', 'city'],
                'city_gender'    => ['country', 'state', 'city', 'gender'],
                'listing'        => ['country', 'state', 'city', 'gender', 'listingId'],
                'profile'        => ['country', 'state', 'city', 'gender', 'listingId', 'profileId'],
            ],
            
            'templates' => [
                'country' => [
                    'title' => 'Find Escorts in {country} | YourSite',
                    'description' => 'Browse verified escorts across {country}. Genuine profiles, updated daily.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],

                'country_gender' => [
                    'title' => 'Book {gender} Escort Services in {country} | Escorts4U',
                    'description' => 'Find {gender} escorts across {country}. Verified profiles, updated daily.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'city' => [
                    'title' => 'Book {city} Escorts | Services Available | Escorts4U',
                    'description' => 'Find top-rated escorts in {city}. Verified profiles, real reviews.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
                'city_gender' => [
                    'title' => '{city} {gender} Escorts | Book Now | Escorts4U',
                    'description' => 'Browse {gender} escorts in {city}, {country}. Updated listings, verified profiles.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],

                'listing' => [
                    'title'       => '{name} - {gender} Escort in {city} | YourSite',
                    'description' => "View {name}'s profile - {gender} escort based in {city}, {state}.",
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),

                ],

                'profile' => [
                    'title' => '{name} - Profile {profileId} | YourSite',
                    'description' => 'Detailed profile of {name}, {gender} escort in {city}.',
                    'og_image' => app()->runningInConsole() ? '' : asset('assets/app/img/shutterstock_338759729.png'),
                ],
            ],  
        ],

        'massage' => [
            'levels' => [
                0 => 'country',
                1 => 'country',
                2 => 'city',
                3 => 'listing',
                4 => 'profile',
            ],

            'segment_map' => [
                'country' => ['country'],
                'city'    => ['country', 'state', 'city'],
                'listing' => ['country', 'state', 'city', 'listingId'],
                'profile' => ['country', 'state', 'city', 'listingId', 'profileId'],
            ],

            'templates' => [
                'country' => [
                    'title' => 'Massage Centers in {country} | YourSite',
                    'description' => 'Browse verified massage centers across {country}. Updated listings daily.',
                ],
                'state' => [
                    'title' => 'Massage Centers in {state}, {country} | YourSite',
                    'description' => 'Find massage centers across {state}, {country}. Verified listings.',
                ],
                'city' => [
                    'title' => 'Massage Centers in {city}, {state}, {country} | YourSite',
                    'description' => 'Find top-rated massage centers in {city}. Verified listings, real reviews.',
                ],
                'listing' => [
                    'title' => '{name} - Massage Center in {city} | YourSite',
                    'description' => 'Detailed listing of {name}, massage center in {city}.',
                ],
            ],
        ],
    ];
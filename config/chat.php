<?php

// users.type values
// 0=viewer, 1=admin, 2=sub-admin, 3=escort, 4=massage-center, 5=agent,
// 6=staff, 7=operator, 8=shareholder, 9=operator-staff, 10=supplier

return [

    'types' => [
        'viewer'         => 0,
        'admin'          => 1,
        'escort'         => 3,
        'massage_center' => 4,
        'agent'          => 5,
    ],

    // Who can chat with whom (keys and values are type ids).
    // Phase 1: Escort <-> Viewer. Phase 2: Escort <-> Agent.
    // Later, enable more by adding lines here, for example:
    //   5 => [3, 4],  4 => [5],   // agent <-> massage centre
    //   3 => [0, 5, 1],  1 => [3],   // escort <-> admin
    'rules' => [
        3 => [0, 5], // escort -> viewer, agent
        0 => [3],    // viewer -> escort
        5 => [3],    // agent  -> escort
    ],

    // Label shown as "Type:" in the chat header
    'type_labels' => [
        0 => 'Viewer',
        1 => 'Admin',
        3 => 'Escort',
        4 => 'Massage Centre',
        5 => 'Agent',
    ],

    // Types that can NOT be blocked
    'unblockable' => [5],

    // Escort starting a chat with a viewer needs extra checks
    // (Notifications & Features settings + Legbox)
    'requires_viewer_checks' => [3],

    // Avatar colour per state abbreviation.
    // Abbreviation comes from config('escorts.profile.states.{state_id}.stateAbbr').
    // Hex values are a first guess, adjust to the design.
    'state_colors' => [
        'ACT' => '#1F4FBF', // blue
        'NSW' => '#4DA6E0', // sky blue
        'NT'  => '#B5532B', // red ochre
        'QLD' => '#800000', // maroon
        'SA'  => '#D32F2F', // red
        'TAS' => '#006A4E', // bottle green
        'VIC' => '#1B2A5C', // navy
        'WA'  => '#D4A017', // gold
    ],

    // Fallback colour when state is missing or unknown
    'default_color' => '#6B7280',
];
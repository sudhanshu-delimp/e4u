<?php

return [
    'massage_default_icon' => 'avatars/default/default_massage.png',
    'escort_default_icon' => 'avatars/default/default_escort.png',
    'viewer_default_icon' => 'avatars/default/need_image.png',
    'agent_default_icon' => 'avatars/default/need_image.png',
    'staff_default_icon' => 'avatars/default/staff_default.png',
    'socket_url' => (env('APP_ENV') === 'production' ? 'https' : 'http') . '://' .env('SOCKET_HOST').':'.env('SOCKET_PORT'),





    'NotificationIcon' => [
        'general' => '<i class="fas fas fa-comments text-white"></i>',
        'agent_accept' => '<i class="fas fa-file-alt text-white"></i>',
        'agent_follow_up' => '<i class="fas fa-exclamation-triangle text-white"></i>',
        'support_ticket' => '<i class="fas fa-ticket-alt text-white"></i>',
        'legbox_notification' => '<i class="fas fas fa-comments text-white"></i>',

        
    ],

    'twilio' => [
        'sid'   => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from'  => env('TWILIO_FROM'),
    ],

     'sms_api' => [
        'key'   => env('SMS_API_KEY'),
        'secret' => env('SMS_API_SECRET'),
    ],


    
    
 

    
    'app_env' => env('APP_ENV'),
    'dashboard_viewer' => [

            'escort' => [
                            // [
                            //     'key'   =>  'My_Legbox_Viewers',
                            //     'name'  =>  'My Legbox Viewers',
                            //     'text'  =>  'View a complete summary of your Legbox Viewers.',
                            //     'icon'  =>  'boxicon/icon_mylegbox.png',
                            //     'link'  =>   '#',
                            // ],

                            // [
                            //     'key'   =>  'My_Playbox_Summary',
                            //     'name'  =>  'My Playbox Summary',
                            //     'text'  =>  'View a complete financial and analytical summary of your My Playbox service.',
                            //     'icon'  =>  'boxicon/icon_myplaybox.png',
                            //     'link'  =>   'escort-dashboard/archive-myplaybox',
                            // ],

                            [
                                'key'   =>  'Manage_Media',
                                'name'  =>  'Manage Media',
                                'text'  =>  'Manage all of your photos and video content from here.',
                                'icon'  =>  'boxicon/icon_manage-media.png',
                                'link'  =>   'escort-dashboard/archive-view-photos',
                            ],

                            [
                                'key'   => 'Support_Tickets',
                                'name'  =>  'Support Tickets',
                                'text'  =>  'View your Support Tickets.',
                                'icon'  =>  'boxicon/icon_support-tickets.png',
                                'link'  =>   'submit_ticket'
                            ],
        
                        ],
                        
             'center' => [

                            [
                                'key'   =>  'media_views',
                                'name'  =>  'Media Views',
                                'text'  =>  'View a complete summary of your Media Views.',
                                'icon'  =>  'boxicon/center/media-views-today.png',
                                'link'  =>   'center-dashboard/archive-view-photos',
                            ],

                            [
                                'key'   => 'Support_Tickets',
                                'name'  =>  'Support Tickets',
                                'text'  =>  'View a complete summary of your Support Tickets.',
                                'icon'  =>  'boxicon/icon_support-tickets.png',
                                'link'  =>   'submit_ticket'
                            ],

                            [
                                'key'   =>  'profile_views',
                                'name'  =>  'Profile Views',
                                'text'  =>  'View a complete summary of your Profile Views.',
                                'icon'  =>  'boxicon/center/profile-views-today.png',
                                'link'  =>   'center-dashboard/profile-informations',
                            ],

                            [
                                'key'   =>  'recommendations',
                                'name'  =>  'Recommendations',
                                'text'  =>  'View a complete summary of your Recommendations.',
                                'icon'  =>  'boxicon/center/recommendations-this-week.png',
                                'link'  =>   '#',
                            ],

                            [
                                'key'   =>  'reviews_posted',
                                'name'  =>  'Reviews Posted',
                                'text'  =>  'View a complete summary of your Reviews Posted.',
                                'icon'  =>  'boxicon/center/reviews-posted-this-week.png',
                                'link'  =>   '#',
                            ],

                            
        
            ]        



         ],


];






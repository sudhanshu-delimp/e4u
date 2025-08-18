<?php

return [
    'massage_default_icon' => 'default/default_massage.png',
    'escort_default_icon' => 'default/default_escort.png',
    'socket_url' => (env('APP_ENV') === 'production' ? 'https' : 'http') . '://' .env('SOCKET_HOST').':'.env('SOCKET_PORT'),


    'NotificationIcon' => [
        'general' => '<i class="fas fas fa-comments text-white"></i>',
        'agent_accept' => '<i class="fas fa-file-alt text-white"></i>',
        'agent_follow_up' => '<i class="fas fa-exclamation-triangle text-white"></i>',
        'support_ticket' => '<i class="fas fa-ticket-alt text-white"></i>',
    ],

 

    'dashboard_viewer' => [

            'escort' => [
                            [
                                'key'   =>  'My_Legbox_Viewers',
                                'name'  =>  'My Legbox Viewers',
                                'text'  =>  'View a complete summary of your Legbox Viewers.',
                                'icon'  =>  'boxicon/icon_mylegbox.png',
                                'link'  =>   '#',
                            ],

                            [
                                'key'   =>  'My_Playbox_Summary',
                                'name'  =>  'My Playbox Summary',
                                'text'  =>  'View a complete financial and analytical summary of your My Playbox service.',
                                'icon'  =>  'boxicon/icon_myplaybox.png',
                                'link'  =>   url('escort-dashboard/archive-myplaybox'),
                            ],

                            [
                                'key'   =>  'Manage_Media',
                                'name'  =>  'Manage Media',
                                'text'  =>  'Manage all of your photos and video content from here.',
                                'icon'  =>  'boxicon/icon_manage-media.png',
                                'link'  =>   '#',
                            ],

                            [
                                'key'   => 'Support_Tickets',
                                'name'  =>  'Support Tickets',
                                'text'  =>  'View your Support Tickets.',
                                'icon'  =>  'boxicon/icon_support-tickets.png',
                                'link'  =>   url('submit_ticket')
                            ],
        
                        ]
         ],


];






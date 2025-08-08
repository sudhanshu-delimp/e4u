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

        
    ]

];






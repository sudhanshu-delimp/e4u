import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

export function createEcho(csrfToken) {
    return new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        wsHost: process.env.MIX_PUSHER_HOST,
        wsPort: process.env.MIX_PUSHER_PORT,
        wssPort: process.env.MIX_PUSHER_PORT,
        forceTLS: process.env.MIX_PUSHER_SCHEME === 'https',
        enabledTransports: ['ws', 'wss'],
        disableStats: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': csrfToken || '',
            },
        },
    });
}
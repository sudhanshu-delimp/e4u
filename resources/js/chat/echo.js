import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

export function createEcho(csrfToken) {
    const host = process.env.MIX_PUSHER_HOST;
    const port = process.env.MIX_PUSHER_PORT;
    const scheme = process.env.MIX_PUSHER_SCHEME;

    const options = {
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        // Pusher cloud (no custom host) always uses TLS
        forceTLS: !host || scheme === 'https',
        enabledTransports: ['ws', 'wss'],
        disableStats: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': csrfToken || '',
            },
        },
    };

    // A self-hosted server (Soketi) needs its own host and port
    if (host) {
        options.wsHost = host;
        options.wsPort = port;
        options.wssPort = port;
    }

    return new Echo(options);
}
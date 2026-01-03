import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

console.log('echo.js loaded');

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_REVERB_APP_KEY,

    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,

    forceTLS: import.meta.env.VITE_REVERB_SCHEME === 'https',
    encrypted: false,

    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});

console.log('Echo instance:', window.Echo);

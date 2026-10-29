import { io } from 'socket.io-client';

let socket = null;
export function createSocket(url, token) {
    if (!socket) socket = io(url, { auth: { token }, transports: ['websocket', 'polling'] });
    return socket;
}
import { createSocket } from './socket';
import { previewText } from './render';

const root = document.getElementById('chat-notify');

if (root) {
    const cfg = root.dataset;
    const me = Number(cfg.me);
    const socket = createSocket(cfg.socketUrl, cfg.token);

    function avatarUrl(path) {
        if (!path) {
            return '';
        }

        return /^(https?:)?\//.test(path) ? path : cfg.avatarBase + '/' + path;
    }

    function stack() {
        let box = document.getElementById('chatToastStack');

        if (box) {
            return box;
        }

        const style = document.createElement('style');

        style.textContent =
            '#chatToastStack{position:fixed;right:20px;bottom:20px;z-index:99999;display:flex;flex-direction:column;gap:10px;pointer-events:none}' +
            '.chat-toast{pointer-events:auto;display:flex;align-items:center;gap:12px;width:320px;max-width:calc(100vw - 40px);padding:12px 14px;background:#fff;border:1px solid #f3d5db;border-left:4px solid #ff3c5f;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.14);cursor:pointer;animation:chatToastIn .25s ease-out}' +
            '.chat-toast-av{width:40px;height:40px;border-radius:50%;flex:0 0 40px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:14px;overflow:hidden}' +
            '.chat-toast-av img{width:100%;height:100%;object-fit:cover}' +
            '.chat-toast-body{flex:1;min-width:0}' +
            '.chat-toast-name{font-weight:600;font-size:14px;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}' +
            '.chat-toast-text{font-size:13px;color:#6b7280;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}' +
            '.chat-toast-x{border:0;background:transparent;font-size:18px;line-height:1;color:#9ca3af;cursor:pointer}' +
            '@keyframes chatToastIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:none}}';
        document.head.appendChild(style);

        box = document.createElement('div');
        box.id = 'chatToastStack';
        document.body.appendChild(box);

        return box;
    }

    // Open the conversation: on the chat page switch to it, elsewhere go to the chat page
    function openChat(id) {
        if (document.getElementById('chatApp')) {
            window.dispatchEvent(new CustomEvent('chat:open', { detail: id }));
        } else {
            window.location.href = cfg.chatUrl + '#chat-' + id;
        }
    }

    function showToast(info, msg) {
        const box = stack();

        while (box.children.length >= 3) {
            box.firstChild.remove();
        }

        const toast = document.createElement('div');
        const av = document.createElement('div');
        const body = document.createElement('div');
        const name = document.createElement('div');
        const text = document.createElement('div');
        const close = document.createElement('button');

        toast.className = 'chat-toast';
        av.className = 'chat-toast-av';
        av.style.background = info.color || '#ff3c5f';
        av.textContent = (info.name || '?').split(' ').map((w) => w[0]).join('').slice(0, 2).toUpperCase();

        if (info.avatar) {
            const img = new Image();

            img.alt = '';
            img.onload = () => { av.textContent = ''; av.appendChild(img); };
            img.src = avatarUrl(info.avatar);
        }

        body.className = 'chat-toast-body';
        name.className = 'chat-toast-name';
        name.textContent = info.name || 'New message';
        text.className = 'chat-toast-text';
        text.textContent = previewText(msg);
        close.className = 'chat-toast-x';
        close.type = 'button';
        close.innerHTML = '&times;';

        body.append(name, text);
        toast.append(av, body, close);
        box.appendChild(toast);

        const remove = () => toast.remove();
        const timer = setTimeout(remove, 6000);

        close.addEventListener('click', (e) => { e.stopPropagation(); clearTimeout(timer); remove(); });
        toast.addEventListener('click', () => { clearTimeout(timer); remove(); openChat(msg.conversation_id); });
    }

    // Windows / browser notification for a background tab
    function desktopNotify(info, msg) {
        if (!('Notification' in window) || Notification.permission !== 'granted') {
            return false;
        }

        const options = { body: previewText(msg), tag: 'chat-' + msg.conversation_id };

        if (info.avatar) {
            options.icon = avatarUrl(info.avatar);
        }

        const note = new Notification(info.name || 'New message', options);

        note.onclick = () => { window.focus(); openChat(msg.conversation_id); note.close(); };

        return true;
    }

    // Browsers allow the permission prompt only after a user click
    if ('Notification' in window && Notification.permission === 'default') {
        document.addEventListener('click', () => Notification.requestPermission(), { once: true });
    }

    socket.on('MessageSent', (msg) => {
        const info = (msg && msg.notify) || {};

        if (!msg || msg.sender_id === me || info.muted) {
            return;
        }

        // The conversation is open and visible, so no notification needed
        if (window.chatActiveId === msg.conversation_id && !document.hidden) {
            return;
        }

        if (document.hidden) {
            if (!desktopNotify(info, msg)) {
                showToast(info, msg);
            }
        } else {
            showToast(info, msg);
        }
    });
}
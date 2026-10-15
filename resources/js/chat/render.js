const DAY_MS = 86400000;
const ONLINE_WINDOW_MS = 5 * 60 * 1000;

const settings = { avatarBase: '' };

export function configure(options) {
    Object.assign(settings, options || {});
}

export function escapeHtml(text) {
    return String(text === null || text === undefined ? '' : text).replace(/[&<>"']/g, (ch) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    }[ch]));
}

export function nl2br(text) {
    return escapeHtml(text).replace(/\n/g, '<br>');
}

/**
 * First letter of the first name and of the last name.
 */
export function initials(name) {
    const parts = String(name || '').trim().split(/\s+/).filter(Boolean);

    if (!parts.length) {
        return '?';
    }

    if (parts.length === 1) {
        return parts[0].charAt(0).toUpperCase();
    }

    return (parts[0].charAt(0) + parts[parts.length - 1].charAt(0)).toUpperCase();
}

export function avatarStyle(color) {
    return 'background:' + escapeHtml(color || '#6B7280') +
        ';color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;overflow:hidden;';
}

function avatarUrl(path) {
    if (!path) {
        return '';
    }

    const value = String(path).trim();

    // Full URLs and root-relative paths are used as they are
    if (/^(https?:)?\/\//.test(value) || value.charAt(0) === '/') {
        return value;
    }

    // Avatars live in /avatars. The stored value can be "avatars/x.png" or only "x.png"
    const relative = value.indexOf('/') === -1
        ? 'avatars/' + value
        : value.replace(/^\/+/, '');

    return settings.avatarBase + '/' + relative;
}

/**
 * Inner HTML of an avatar circle: the photo when there is one,
 * otherwise the initials. A broken photo falls back to initials (see controller.js).
 */
export function avatarInner(person) {
    const text = escapeHtml(initials(person.name));
    const url = avatarUrl(person.avatar);

    if (!url) {
        return text;
    }

    return `<img class="chat-avatar-img" src="${escapeHtml(url)}" alt="" data-initials="${text}"
        style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">`;
}

export function isOnline(lastOnlineAt) {
    if (!lastOnlineAt) {
        return false;
    }

    const time = new Date(String(lastOnlineAt).replace(' ', 'T')).getTime();

    return !isNaN(time) && Math.abs(Date.now() - time) < ONLINE_WINDOW_MS;
}

export function sameDay(a, b) {
    const x = new Date(a);
    const y = new Date(b);

    return x.getFullYear() === y.getFullYear()
        && x.getMonth() === y.getMonth()
        && x.getDate() === y.getDate();
}

export function formatTime(iso) {
    return new Date(iso).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

export function formatSize(bytes) {
    if (bytes >= 1048576) {
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    return Math.max(1, Math.round(bytes / 1024)) + ' KB';
}

export function dayLabel(iso) {
    const date = new Date(iso);
    const now = new Date();

    if (sameDay(date, now)) {
        return 'Today';
    }

    if (sameDay(date, new Date(now.getTime() - DAY_MS))) {
        return 'Yesterday';
    }

    return date.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
}

export function listTime(iso) {
    const date = new Date(iso);
    const now = new Date();

    if (sameDay(date, now)) {
        return formatTime(iso);
    }

    if (sameDay(date, new Date(now.getTime() - DAY_MS))) {
        return 'Yesterday';
    }

    return date.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' });
}

export function previewText(message) {
    if (message.type === 'image') {
        return 'Photo';
    }

    if (message.type === 'video') {
        return 'Video';
    }

    return message.body || '';
}

/**
 * One row of the sidebar chat list.
 * ctx: { states, activeId, isOnline(user), isTyping(conversationId) }
 */
export function chatItemHtml(conv, ctx) {
    const user = conv.user;
    const abbr = ctx.states[user.location_id] || '';
    const online = ctx.isOnline(user);
    const active = conv.id === ctx.activeId ? ' active' : '';

    let previewHtml;

    if (ctx.isTyping(conv.id)) {
        previewHtml = '<span style="color:#25a244;font-style:italic;">typing...</span>';
    } else {
        const preview = conv.last
            ? (conv.last.mine ? 'You: ' : '') + conv.last.preview
            : 'No messages yet';

        previewHtml = escapeHtml(preview);
    }

    const time = conv.last ? listTime(conv.last.created_at) : '';

    return `
        <div class="chat-user${active}"
            data-id="${conv.id}"
            data-name="${escapeHtml(user.name)}"
            data-member="${escapeHtml(user.member_id)}"
            data-location="${escapeHtml(abbr)}">

            <div class="avatar avatar-light" style="${avatarStyle(user.color)}">
                ${avatarInner(user)}
            </div>

            <div class="user-info">

                <div class="user-top">
                    <span class="user-type">${escapeHtml(user.member_id)}</span>
                </div>

                <div class="user-name">
                    ${escapeHtml(user.name)}
                    <span class="status-dot${online ? '' : ' offline'}"></span>
                </div>

                <div class="user-top">
                    <span class="user-type">${previewHtml}</span>
                    <span class="user-time">${escapeHtml(time)}</span>
                </div>

                <div class="more-info-wrapper">

                    <button type="button" class="chatInfoBtn" aria-label="More options">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>

                    <div class="more-info-dropdown">

                        <button type="button" class="contactInfoBtn chat-mark-read">
                            <i class="bi bi-check-circle"></i>
                            Mark as Read
                        </button>

                        <button type="button" class="filter-option chat-action" data-action="contact">
                            <i class="bi bi-person-vcard"></i>
                            Contact Info
                        </button>

                        <button type="button" class="filter-option chat-action" data-action="archive">
                            <i class="bi bi-archive"></i>
                            ${conv.is_archived ? 'Unarchive' : 'Archive'}
                        </button>

                        <button type="button" class="filter-option chat-action" data-action="delete">
                            <i class="bi bi-trash3"></i>
                            Delete
                        </button>

                    </div>

                </div>

            </div>

            ${conv.unread > 0 ? `<span class="unread-count">${conv.unread}</span>` : ''}

        </div>
    `;
}

function attachmentsHtml(msg) {
    return (msg.attachments || []).map((a) => {
        const url = escapeHtml(a.url);

        if (a.kind === 'image') {
            return `<a href="${url}" target="_blank" rel="noopener">
                <img src="${url}" alt="" loading="lazy"
                    style="max-width:79px;max-height:260px;border-radius:8px;display:block;">
            </a>`;
        }

        return `<video src="${url}" controls preload="metadata"
            style="max-width:260px;max-height:260px;border-radius:8px;display:block;"></video>`;
    }).join('');
}

/**
 * One message bubble, with a date divider when the day changes.
 * ctx: { me: {id, name, avatar, color}, peer: {name, avatar, color} }
 */
export function messageHtml(msg, prev, ctx) {
    const mine = msg.sender_id === ctx.me.id;
    const person = mine ? ctx.me : ctx.peer;

    const divider = (!prev || !sameDay(prev.created_at, msg.created_at))
        ? `<div class="date-divider"><span>${escapeHtml(dayLabel(msg.created_at))}</span></div>`
        : '';

    const avatar = `
        <div class="message-avatar" style="${avatarStyle(person.color)}">
            ${avatarInner(person)}
        </div>`;

    // One grey tick = sent, two blue ticks = seen
    let tick = '';

    if (mine) {
        tick = msg.read_at
            ? '<i class="bi bi-check2-all chat-tick" style="color:#34B7F1;"></i>'
            : '<i class="bi bi-check2 chat-tick"></i>';
    }

    const caption = msg.body ? `<div>${nl2br(msg.body)}</div>` : '';

    const bubble = `
        <div class="message-wrapper">
            <div class="message-bubble">${attachmentsHtml(msg)}${caption}</div>
            <div class="message-time">
                ${escapeHtml(formatTime(msg.created_at))}
                ${tick}
            </div>
        </div>`;

    return `
        ${divider}
        <div class="message-row ${mine ? 'sent' : 'received'}" data-id="${msg.id}">
            ${mine ? bubble + avatar : avatar + bubble}
        </div>
    `;
}

/**
 * One result row inside the New chat modal.
 */
export function memberResultHtml(member) {
    return `
        <div class="member-result"
            data-user-id="${member.id}"
            data-member-id="${escapeHtml(member.member_id)}"
            data-member-name="${escapeHtml(member.name)}"
            data-avatar="${escapeHtml(member.avatar || '')}"
            data-color="${escapeHtml(member.color)}"
            data-location="">

            <div class="member-avatar" style="${avatarStyle(member.color)}">
                ${avatarInner(member)}
            </div>

            <div class="member-info">
                <strong>${escapeHtml(member.name)}</strong>
                <span>${escapeHtml(member.member_id)}${member.type_label ? ' · ' + escapeHtml(member.type_label) : ''}</span>
            </div>

            <button type="button" class="add-member-action">
                <i class="bi bi-plus-lg"></i>
            </button>

        </div>
    `;
}
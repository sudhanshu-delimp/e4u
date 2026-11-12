const DAY_MS = 86400000;
const ONLINE_WINDOW_MS = 5 * 60 * 1000;
export const EDIT_WINDOW_MS = 15 * 60 * 1000;
// A message can be edited for 15 minutes after it was sent (the server checks this too)
export function canEdit(msg) {
    return Date.now() - new Date(msg.created_at).getTime() <= EDIT_WINDOW_MS;
}
const SHOWABLE_IMAGES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/avif'];
const PLAYABLE_VIDEOS = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'];

function hasImageGallery(attachments) {
    return attachments.length >= 4 && attachments.every((attachment) =>
        attachment.kind === 'image' && SHOWABLE_IMAGES.indexOf(String(attachment.mime || '').toLowerCase()) !== -1
    );
}

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

    if (message.type === 'document') {
        return 'Document';
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

               
                <div class="user-name">
                    ${escapeHtml(user.name)}
                    <span class="user-type">(${escapeHtml(user.member_id)})</span>
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

                        ${conv.is_appointed ? '' : `
                        <button type="button" class="filter-option chat-action" data-action="archive">
                            <i class="bi bi-archive"></i>
                            ${conv.is_archived ? 'Unarchive' : 'Archive'}
                        </button>`}

                        ${conv.is_appointed || ctx.meIsAdmin ? '' : `
                        <button type="button" class="filter-option chat-action" data-action="delete">
                            <i class="bi bi-trash3"></i>
                            Delete
                        </button>`}

                    </div>

                </div>

            </div>

            ${conv.unread > 0 ? `<span class="unread-count">${conv.unread}</span>` : ''}

        </div>
    `;
}

function hasVideoGallery(list) {
    // Agar 1 se zyada videos hain aur sabhi playable hain
    return list.length > 1 && list.every(a => 
        a.kind === 'video' && PLAYABLE_VIDEOS.indexOf(String(a.mime || '').toLowerCase()) !== -1
    );
}

// Small chips under a message: emoji and how many people used it
function reactionsHtml(msg, meId) {
    const list = msg.reactions || [];

    if (!list.length) {
        return '';
    }

    const groups = {};

    list.forEach((r) => {
        groups[r.emoji] = groups[r.emoji] || { count: 0, mine: false };
        groups[r.emoji].count += 1;

        if (r.user_id === meId) {
            groups[r.emoji].mine = true;
        }
    });

    const chips = Object.keys(groups).map((emoji) => {
        const g = groups[emoji];
        const style = 'border:1px solid ' + (g.mine ? '#ff3c5f' : '#e5e7eb') + ';background:' + (g.mine ? '#ffe4e6' : '#fff') +
            ';border-radius:12px;padding:0 6px;font-size:13px;line-height:20px;cursor:pointer; position:absolute; bottom:17px; right:0px;';

        return `<button type="button" class="chat-reaction-chip" data-emoji="${escapeHtml(emoji)}" style="${style}">${escapeHtml(emoji)}${g.count > 1 ? ' ' + g.count : ''}</button>`;
    }).join('');

    return `<div class="chat-reactions" style="display:flex;flex-wrap:wrap;gap:4px;margin-top:3px;">${chips}</div>`;
}

function attachmentsHtml(msg) {
    const list = msg.attachments || [];
    if (!list.length) return '';

    const showableImages = (typeof SHOWABLE_IMAGES !== 'undefined') ? SHOWABLE_IMAGES : ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    const playableVideos = (typeof PLAYABLE_VIDEOS !== 'undefined') ? PLAYABLE_VIDEOS : ['video/mp4', 'video/webm', 'video/ogg'];
    const esc = (typeof escapeHtml === 'function') ? escapeHtml : (s) => String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    const fmtSize = (typeof formatSize === 'function') ? formatSize : (b) => b ? (b / (1024 * 1024)).toFixed(1) + ' MB' : '';

    // 1. Separate Media (Image/Video) and Documents
    const mediaList = [];
    const docList = [];

    list.forEach(a => {
        const mime = String(a.mime || '').toLowerCase();
        const isImg = a.kind === 'image' && showableImages.indexOf(mime) !== -1;
        const isVid = a.kind === 'video' && playableVideos.indexOf(mime) !== -1;

        if (isImg || isVid) {
            mediaList.push(a);
        } else {
            docList.push(a);
        }
    });

    let outputHtml = '';

    // 2. RENDER MEDIA (IMAGES / VIDEOS) IN GALLERY GRID
    if (mediaList.length === 1) {
        const a = mediaList[0];
        const url = esc(a.url);
        const mime = String(a.mime || '').toLowerCase();

        if (a.kind === 'image') {
            outputHtml += `<div class="chat-single-media">
                <a href="${url}" class="chat-media" data-kind="image" target="_blank" rel="noopener">
                    <img src="${url}" alt="" loading="lazy" style="max-width:260px;max-height:260px;border-radius:12px;display:block;">
                </a>
            </div>`;
        } else {
            outputHtml += `<div class="chat-single-media">
                <video src="${url}" class="chat-media" data-kind="video" controls preload="metadata"
                    style="max-width:260px;max-height:260px;border-radius:12px;display:block;"></video>
            </div>`;
        }
    } else if (mediaList.length > 1) {
        const tiles = mediaList.map((a, index) => {
            const url = esc(a.url);
            const hidden = index > 3 ? ' chat-gallery-hidden' : '';
            const overlay = (index === 3 && mediaList.length > 3)
                ? `<span class="chat-gallery-more" aria-hidden="true"><i class="bi bi-plus-lg"></i><span>${mediaList.length - 3}</span></span>`
                : '';

            let content = '';
            if (a.kind === 'image') {
                content = `<img src="${url}" alt="" loading="lazy">`;
            } else {
                content = `<video src="${url}#t=0.5" preload="metadata" muted playsinline></video>
                           <i class="bi bi-play-circle-fill chat-video-play-icon" aria-hidden="true"></i>`;
            }

            return `<a href="${url}" class="chat-media chat-gallery-tile${hidden}" data-kind="${esc(a.kind || 'file')}" target="_blank" rel="noopener">
                ${content}
                ${overlay}
            </a>`;
        }).join('');

        outputHtml += `<div class="chat-image-gallery">${tiles}</div>`;
    }

    // 3. RENDER DOCUMENTS (Clean Stacked List at bottom)
    if (docList.length > 0) {
        const docs = docList.map(a => {
            const url = esc(a.url);
            const fileName = esc(a.name || 'Document');
            const ext = esc((String(a.name || '').split('.').pop() || 'FILE').toUpperCase());
            const isPdf = ext === 'PDF';
            const sizeStr = fmtSize(a.size);

            return `
            <a href="${url}" download="${fileName}" class="doc-card" title="${fileName}">
                <div class="doc-icon-box ${isPdf ? 'pdf' : 'other'}">
                    <i class="bi ${isPdf ? 'bi-file-earmark-pdf-fill' : 'bi-file-earmark-text-fill'}"></i>
                </div>
                <div class="doc-info">
                    <span class="doc-name">${fileName}</span>
                    <span class="doc-meta"><strong>${ext}</strong> ${sizeStr ? '&bull; ' + sizeStr : ''}</span>
                </div>
                <div class="doc-download-btn">
                    <i class="bi bi-download"></i>
                </div>
            </a>`;
        }).join('');

        outputHtml += `<div class="chat-doc-list">${docs}</div>`;
    }

    return outputHtml;
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

    if (mine && !msg.deleted) {
        tick = msg.read_at
            ? '<i class="bi bi-check2-all chat-tick" style="color:#34B7F1;"></i>'
            : '<i class="bi bi-check2 chat-tick"></i>';
    }

    let content;

    if (msg.deleted) {
        content = '<div style="font-style:italic;opacity:.7;"><i class="bi bi-slash-circle"></i> This message was deleted</div>';
    } else {
        const caption = msg.body ? `<div>${nl2br(msg.body)}</div>` : '';

        content = attachmentsHtml(msg) + caption;
    }

    const edited = (!msg.deleted && msg.edited)
        ? ' <span style="opacity:.6;">(edited)</span>'
        : '';

    // Edit (first 15 minutes only) and delete, on my own messages
       // Delete on every message, edit only on my own text messages (first 15 minutes)
    let actions = '';

    if (!msg.deleted) {
        const buttonStyle = 'border:0;background:transparent;padding:0 4px;cursor:pointer;color:inherit;font-size:12px; margin:0px;';
        const hasFiles = (msg.attachments || []).length > 0;

        const edit = (mine && !hasFiles && msg.body && canEdit(msg))
            ? `<button type="button" class="chat-msg-edit" title="Edit" style="${buttonStyle}"><i class="bi bi-pencil"></i></button>`
            : '';
        const remove = ctx.meIsAdmin
            ? ''
            : `<button type="button" class="chat-msg-delete" title="Delete" style="${buttonStyle}"><i class="bi bi-trash3"></i></button>`;
                const react = `<button type="button" class="chat-msg-react" title="React" style="${buttonStyle}"><i class="bi bi-emoji-smile"></i></button>`;

                actions = `<span class="chat-msg-actions" style="margin-left:8px;opacity:.65;">${react}${edit}${remove}</span>`;
    }

    const bubble = `
        <div class="message-wrapper">
            <div class="message-bubble${hasImageGallery(msg.attachments || []) ? ' chat-gallery-bubble' : ''}">${content}</div> ${reactionsHtml(msg, ctx.me.id)}
            <div class="message-time">
                ${escapeHtml(formatTime(msg.created_at))}${edited}
                ${tick}
                ${actions}
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
export function memberResultHtml(member, online) {
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
            <span class="member-status${online ? '' : ' offline'}">${online ? 'Online' : 'Offline'}</span>

            <button type="button" class="add-member-action">
                <i class="bi bi-plus-lg"></i>
            </button>

        </div>
    `;
}
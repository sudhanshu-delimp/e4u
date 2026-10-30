// import { createEcho } from './echo';
import { createSocket } from './socket';
import { createApi } from './api';
import * as view from './render';
import { initChatActions } from './actions';
import { chooseDelete, notice } from './dialogs';

// UI filter value -> server filter value
const FILTERS = { chats: 'active', archived: 'archived', deleted: 'deleted' };

// Radio value -> server location value
const LOCATIONS = { 'your-location': 'mine', australia: 'australia' };

const EMPTY_STYLE = 'padding:24px;text-align:center;color:#6b7280;font-size:14px;';
const MAX_FILE_BYTES = 50 * 1024 * 1024;
const MAX_FILES = 10;
const TYPING_SEND_GAP_MS = 2000;
const TYPING_SHOW_MS = 3500;

const FILE_ACCEPT = 'image/*,video/*,.heic,.heif,.avif,.tif,.tiff,.mkv,.avi,.wmv,.flv,.3gp,.3g2,.mpg,.mpeg,.ogv,.m4v';
const IMAGE_EXT = ['jpg', 'jpeg', 'jpe', 'jfif', 'png', 'gif', 'webp', 'bmp', 'avif', 'heic', 'heif', 'tif', 'tiff', 'ico'];
const VIDEO_EXT = ['mp4', 'm4v', 'mov', 'webm', 'ogv', 'mkv', 'avi', 'wmv', 'flv', '3gp', '3g2', 'mpg', 'mpeg'];
const PREVIEWABLE_IMAGES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/avif'];

// 'image', 'video' or null when the file type is not supported
function fileKind(file) {
    const ext = (file.name.split('.').pop() || '').toLowerCase();

    if (ext === 'svg' || file.type === 'image/svg+xml') {
        return null;
    }

    if (file.type.indexOf('image/') === 0 || IMAGE_EXT.indexOf(ext) !== -1) {
        return 'image';
    }

    if (file.type.indexOf('video/') === 0 || VIDEO_EXT.indexOf(ext) !== -1) {
        return 'video';
    }

    return null;
}

/**
 * Show a message with the site's global showAlert(type, message).
 * Falls back to a plain alert when that function is not on the page.
 */
function notify(message, type) {
    const text = message || 'Something went wrong.';

    if (typeof showAlert === 'function') {
        showAlert(type || 'error', text);
        return;
    }

    notice(type || 'error', text);
}

export function initChat(root) {
    if (root.dataset.chatReady) {
        return;
    }

    root.dataset.chatReady = '1';
    const config = JSON.parse(root.dataset.config || '{}');
    const me = config.me;
    const api = createApi(config);
    // const echo = createEcho(config.csrf);
    const socket = createSocket(config.socketUrl, config.socketToken);

    view.configure({ avatarBase: config.avatarBase || '' });

    const el = {
        list: document.getElementById('chatList'),
        messages: document.getElementById('messages'),
        input: document.getElementById('messageInput'),
        sendBtn: document.getElementById('sendBtn'),
        fileInput: document.getElementById('fileInput'),
        composer: document.querySelector('.message-composer'),
        headerAvatar: document.getElementById('chatHeaderAvatar'),
        headerName: document.getElementById('chatUserName'),
        headerStatus: document.getElementById('chatStatus'),
        headerMeta: document.getElementById('chatUserMeta'),
        sidebar: document.getElementById('sidebar'),
        overlay: document.getElementById('sidebarOverlay'),
        modal: document.getElementById('addMemberModal'),
        memberSearch: document.getElementById('memberSearchInput'),
        memberResults: document.getElementById('memberResults'),
    };

    const checkedRadio = document.querySelector('input[name="location"]:checked');

    const state = {
        filter: 'active',
        location: LOCATIONS[checkedRadio ? checkedRadio.value : 'your-location'] || 'mine',
        conversations: [],
        pending: null, // chat started from the modal that has no message yet
        activeId: null,
        messages: [],
        hasMore: false,
        loadingOlder: false,
        sending: false,
        online: new Set(), // user ids currently on the chat page
        typing: {}, // conversation id -> hide timer
        lastTypingSent: 0,
        pendingFiles: [],
        editingId: null,
        previewUrls: [],
    };

    /* ---------------------------------------------------
       Helpers
    --------------------------------------------------- */

    function findConv(id) {
        return state.conversations.find((c) => c.id === id)
            || (state.pending && state.pending.id === id ? state.pending : null);
    }

    function visibleConversations() {
        const list = state.conversations.slice();

        if (state.pending && !list.some((c) => c.id === state.pending.id)) {
            list.unshift(state.pending);
        }

        return list;
    }

    function messageContext() {
        const conv = findConv(state.activeId);

        return { me, peer: conv ? conv.user : { name: '?', color: '#6B7280' } };
    }

    function isUserOnline(user) {
        return state.online.has(user.id) || view.isOnline(user.last_online_at);
    }

    function scrollBottom() {
        el.messages.scrollTop = el.messages.scrollHeight;
    }


    function prepareVideos(scope) {
        scope.querySelectorAll('video:not([data-ready])').forEach((video) => {
            video.dataset.ready = '1';
            video.preload = 'metadata';
            video.setAttribute('playsinline', '');

            const original = (video.getAttribute('src') || '').split('#')[0];

            if (!original) {
                return;
            }

            video.src = original + '#t=0.1';

            let tries = 0;

            const retry = () => {
                if (tries >= 6 || video.readyState > 0) {
                    return;
                }

                tries++;
                video.src = original + (original.indexOf('?') === -1 ? '?' : '&') + '_r=' + Date.now() + '#t=0.1';
                video.load();
            };

            video.addEventListener('error', () => setTimeout(retry, 1500 * (tries + 1)));
            video.addEventListener('loadedmetadata', () => { tries = 6; });
            setTimeout(retry, 2500);
        });
    }


    function showSending(files) {
        hideSending();

        if (!document.getElementById('chatSpinStyle')) {
            const style = document.createElement('style');

            style.id = 'chatSpinStyle';
            style.textContent = '@keyframes chatSpin{to{transform:rotate(360deg)}}';
            document.head.appendChild(style);
        }

        const row = document.createElement('div');

        row.id = 'chatSending';
        row.className = 'message-row sent';
        row.innerHTML = `<div class="message-wrapper"><div class="message-bubble" style="display:flex;align-items:center;gap:10px;">
        <span style="width:18px;height:18px;border:3px solid #e5e7eb;border-top-color:#ff3c5f;border-radius:50%;display:inline-block;animation:chatSpin .8s linear infinite;"></span>
        <span>Sending ${files.length} file(s)... large videos can take a few minutes. Please do not close this page.</span>
    </div></div>`;

        el.messages.appendChild(row);
        scrollBottom();
    }

    function hideSending() {
        const row = document.getElementById('chatSending');

        if (row) {
            row.remove();
        }
    }

    function closeSidebarOnMobile() {
        if (window.innerWidth <= 800) {
            if (el.sidebar) {
                el.sidebar.classList.remove('open');
            }

            if (el.overlay) {
                el.overlay.classList.remove('show');
            }
        }
    }

    function closeMemberModal() {
        if (el.modal) {
            el.modal.classList.remove('show');
        }
    }

    function closeAllChatMenus() {
        document.querySelectorAll('.more-info-wrapper.open').forEach((w) => w.classList.remove('open'));
    }

    // Leave the open chat (after it is archived or deleted)
    // Leave the open chat (after it is archived or deleted)
    function closeActive() {
        state.activeId = null;
        state.messages = [];
        state.hasMore = false;

        clearAttachPreview();
        renderHeader(null);
        renderMessages();
        updateBlockUi(null);
        setComposerEnabled(false);
        renderList();
    }

    // Block state of the open chat: header menu label, banner and composer
    function updateBlockUi(conv) {
        const button = document.getElementById('blockUserBtn');
        const old = document.getElementById('chatBlockBanner');

        if (old) {
            old.remove();
        }

        if (!conv) {
            return;
        }

        const unblockable = (config.unblockable || []).map(Number).indexOf(Number(conv.user.type)) !== -1;

        if (button) {
            button.style.display = unblockable ? 'none' : '';
            button.innerHTML = '<i class="bi bi-slash-circle"></i> ' + (conv.blocked_by_me ? 'Unblock User' : 'Block User');
        }

        const blocked = !!(conv.blocked_by_me || conv.blocked_me);

        if (blocked) {
            const banner = document.createElement('div');

            banner.id = 'chatBlockBanner';
            banner.setAttribute('style', 'padding:10px 14px;border-top:1px solid #e5e7eb;background:#fff7ed;font-size:13px;display:flex;justify-content:space-between;align-items:center;gap:10px;');
            banner.innerHTML = conv.blocked_by_me
                ? 'You blocked this user. <button type="button" class="chat-unblock" style="border:0;background:transparent;color:#e11d48;font-weight:600;cursor:pointer;">Unblock</button>'
                : 'You cannot reply to this conversation.';

            el.composer.parentNode.insertBefore(banner, el.composer);
        }

        setComposerEnabled(!blocked);
    }

    function setComposerEnabled(enabled) {
        el.input.disabled = !enabled;
        el.sendBtn.disabled = !enabled;
    }

    /* ---------------------------------------------------
       Rendering
    --------------------------------------------------- */

    function renderList() {
        const list = visibleConversations();

        if (!list.length) {
            el.list.innerHTML = `<div class="chat-empty" style="${EMPTY_STYLE}">No chats here. Click New to start one.</div>`;
            return;
        }

        const ctx = {
            states: config.states || {},
            activeId: state.activeId,
            isOnline: isUserOnline,
            isTyping: (id) => !!state.typing[id],
        };

        el.list.innerHTML = list.map((conv) => view.chatItemHtml(conv, ctx)).join('');
    }

    function renderHeader(conv) {
        if (!conv) {
            el.headerAvatar.innerHTML = '';
            el.headerAvatar.removeAttribute('style');
            el.headerName.textContent = 'Select a chat';
            el.headerStatus.innerHTML = '';
            el.headerMeta.innerHTML = '';
            return;
        }

        const user = conv.user;
        const online = isUserOnline(user);
        const typing = !!state.typing[conv.id];

        const abbr = (config.states || {})[user.location_id] || '-';

        el.headerAvatar.setAttribute('style', view.avatarStyle(user.color));
        el.headerAvatar.innerHTML = view.avatarInner(user);
        el.headerName.textContent = user.name;

        el.headerStatus.innerHTML = typing
            ? '<span style="color:#25a244;font-style:italic;">typing...</span>'
            : `<span class="status-dot${online ? '' : ' offline'}"></span> ${online ? 'Active' : 'Offline'}`;

        el.headerMeta.innerHTML =
            `Type: ${view.escapeHtml((config.typeLabels || {})[user.type] || '')} <span>|</span> ` +
            `Member ID: ${view.escapeHtml(user.member_id)} <span>|</span> ` +
            `Location: ${view.escapeHtml(abbr)}`;
    }

    function renderMessages() {
        if (!state.activeId) {
            el.messages.innerHTML = `<div class="chat-empty" style="${EMPTY_STYLE}">Select a chat to start messaging.</div>`;
            return;
        }

        if (!state.messages.length) {
            el.messages.innerHTML = `<div class="chat-empty" style="${EMPTY_STYLE}">No messages yet. Say hello!</div>`;
            return;
        }

        const ctx = messageContext();

        el.messages.innerHTML = state.messages
            .map((msg, i) => view.messageHtml(msg, state.messages[i - 1], ctx))
            .join('');
    }

    function appendMessage(msg) {
        if (state.messages.some((m) => m.id === msg.id)) {
            return;
        }

        const prev = state.messages[state.messages.length - 1];

        state.messages.push(msg);

        if (state.messages.length === 1) {
            renderMessages();
        } else {
            el.messages.insertAdjacentHTML('beforeend', view.messageHtml(msg, prev, messageContext()));
        }

        scrollBottom();
    }

    // Re-draw the parts that show presence and typing
    function refreshLiveUi() {
        renderList();

        const conv = findConv(state.activeId);

        if (conv) {
            renderHeader(conv);
        }
    }

    /* ---------------------------------------------------
       Data loading
    --------------------------------------------------- */

    async function loadList() {
        try {
            const res = await api.conversations({ filter: state.filter, location: state.location });

            state.conversations = res.data || [];

            if (state.pending && state.conversations.some((c) => c.id === state.pending.id)) {
                state.pending = null;
            }
        } catch (error) {
            console.error('Chat list failed', error);
            state.conversations = [];
        }

        renderList();
    }

    async function loadMessages(older) {
        const id = state.activeId;
        const params = { limit: 30 };

        if (older && state.messages.length) {
            params.before_id = state.messages[0].id;
        }

        const res = await api.messages(id, params);

        if (state.activeId !== id) {
            return;
        }

        state.hasMore = !!res.has_more;

        if (older) {
            const previousHeight = el.messages.scrollHeight;

            state.messages = res.data.concat(state.messages);
            renderMessages();
            el.messages.scrollTop = el.messages.scrollHeight - previousHeight;
        } else {
            state.messages = res.data;
            renderMessages();
            scrollBottom();
        }
    }

    function markRead(id) {
        const conv = findConv(id);

        if (conv && conv.unread > 0) {
            conv.unread = 0;
            renderList();
        }

        api.read(id).catch(() => { });
    }

    async function openConversation(id) {
        const conv = findConv(id);

        if (!conv) {
            return;
        }

        state.activeId = id;
        state.messages = [];
        state.hasMore = false;

        clearAttachPreview();
        renderList();
        renderHeader(conv);
        renderMessages();
        setComposerEnabled(true);
        updateBlockUi(conv);
        closeSidebarOnMobile();

        try {
            await loadMessages(false);
        } catch (error) {
            console.error('Messages failed', error);
            return;
        }

        if (state.activeId === id) {
            markRead(id);
            el.input.focus();
        }
    }

    /* ---------------------------------------------------
       Attachments
    --------------------------------------------------- */

    function clearAttachPreview() {
        cancelEdit();
        const box = document.getElementById('chatAttachPreview');

        if (box) {
            box.remove();
        }

        state.previewUrls.forEach((url) => URL.revokeObjectURL(url));
        state.previewUrls = [];
        state.pendingFiles = [];
    }

    // function showAttachPreview(file) {
    //     clearAttachPreview();

    //     state.pendingFile = file;

    //     let thumb;

    //     if (PREVIEWABLE_IMAGES.indexOf(file.type) !== -1) {
    //         state.previewUrl = URL.createObjectURL(file);
    //         thumb = `<img src="${state.previewUrl}" alt="" style="width:44px;height:44px;object-fit:cover;border-radius:6px;">`;
    //     } else {
    //         const icon = fileKind(file) === 'image' ? 'bi-image' : 'bi-camera-video';
    //         thumb = `<span style="width:44px;height:44px;border-radius:6px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:20px;"><i class="bi ${icon}"></i></span>`;
    //     }

    //     const box = document.createElement('div');

    //     box.id = 'chatAttachPreview';
    //     box.setAttribute('style', 'display:flex;align-items:center;gap:10px;padding:8px 14px;border-top:1px solid #e5e7eb;background:#f9fafb;font-size:13px;');
    //     box.innerHTML = `
    //         ${thumb}
    //         <span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
    //             ${view.escapeHtml(file.name)} (${view.formatSize(file.size)})
    //         </span>
    //         <button type="button" class="chat-attach-remove" title="Remove"
    //             style="border:0;background: #ff3c5f;font-size:20px;line-height:1;cursor:pointer;">&times;</button>
    //     `;

    //     el.composer.parentNode.insertBefore(box, el.composer);
    // }

    function renderAttachPreview() {
        const old = document.getElementById('chatAttachPreview');

        if (old) {
            old.remove();
        }

        state.previewUrls.forEach((url) => URL.revokeObjectURL(url));
        state.previewUrls = [];

        if (!state.pendingFiles.length) {
            return;
        }

        const thumbs = state.pendingFiles.map((file, index) => {
            let thumb;

            if (PREVIEWABLE_IMAGES.indexOf(file.type) !== -1) {
                const url = URL.createObjectURL(file);

                state.previewUrls.push(url);
                thumb = `<img src="${url}" alt="" style="width:56px;height:56px;object-fit:cover;border-radius:6px;display:block;">`;
            } else {
                const icon = fileKind(file) === 'image' ? 'bi-image' : 'bi-camera-video';

                thumb = `<span style="width:56px;height:56px;border-radius:6px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:22px;"><i class="bi ${icon}"></i></span>`;
            }

            return `<div style="position:relative;flex:0 0 auto;" title="${view.escapeHtml(file.name)}">
                ${thumb}
                <button type="button" class="chat-attach-remove" data-index="${index}" title="Remove"
                    style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;border-radius:50%;border:0;background:#111827;color:#fff;font-size:14px;line-height:20px;padding:0;cursor:pointer;">&times;</button>
            </div>`;
        }).join('');

        const box = document.createElement('div');

        box.id = 'chatAttachPreview';
        box.setAttribute('style', 'display:flex;align-items:center;gap:12px;padding:10px 14px;border-top:1px solid #e5e7eb;background:#f9fafb;font-size:13px;overflow-x:auto;');
        box.innerHTML = thumbs + `<span style="color:#6b7280;white-space:nowrap;">${state.pendingFiles.length} file(s)</span>`;

        el.composer.parentNode.insertBefore(box, el.composer);
    }

    function onFileChosen() {
        const chosen = Array.from(el.fileInput.files || []);

        // Reset so choosing the same file again still fires a change event
        el.fileInput.value = '';

        if (!chosen.length) {
            return;
        }

        if (!state.activeId) {
            notify('Select a chat first.', 'error');
            return;
        }

        for (const file of chosen) {
            if (state.pendingFiles.length >= MAX_FILES) {
                notify('You can send up to ' + MAX_FILES + ' files at a time.', 'error');
                break;
            }

            if (!fileKind(file)) {
                notify(file.name + ': this file type is not supported.', 'error');
                continue;
            }

            if (file.size > MAX_FILE_BYTES) {
                notify(file.name + ' is too large. Maximum size is 50 MB.', 'error');
                continue;
            }

            state.pendingFiles.push(file);
        }

        renderAttachPreview();
        el.input.focus();
    }

    /* ---------------------------------------------------
       Sending and receiving
    --------------------------------------------------- */

    function touchConversation(msg, options) {
        let conv = state.conversations.find((c) => c.id === msg.conversation_id);

        if (!conv && state.pending && state.pending.id === msg.conversation_id) {
            conv = state.pending;
            state.conversations.unshift(conv);
            state.pending = null;
        }

        if (!conv) {
            return false;
        }

        conv.last = {
            preview: view.previewText(msg),
            created_at: msg.created_at,
            mine: options.mine,
        };
        conv.unread = options.unread;

        state.conversations = [conv].concat(state.conversations.filter((c) => c !== conv));

        return true;
    }

    /* ---------------------------------------------------
   Edit and delete one message
--------------------------------------------------- */

    function messageById(id) {
        return state.messages.find((m) => m.id === id);
    }

    // Swap one message for its new version and redraw, keeping the scroll position
    function replaceMessage(msg) {
        const position = state.messages.findIndex((m) => m.id === msg.id);

        if (position === -1) {
            return;
        }

        const scroll = el.messages.scrollTop;

        state.messages[position] = msg;
        renderMessages();
        el.messages.scrollTop = scroll;
    }

    function cancelEdit() {
        state.editingId = null;

        const banner = document.getElementById('chatEditBanner');

        if (banner) {
            banner.remove();
        }
    }

    function startEdit(id) {
        const msg = messageById(id);

        if (!msg || msg.deleted) {
            return;
        }

        if (!view.canEdit(msg)) {
            notify('Messages can be edited only within 15 minutes.', 'error');
            renderMessages();
            return;
        }

        // Also clears any selected attachments and an earlier edit
        clearAttachPreview();

        state.editingId = id;

        const banner = document.createElement('div');

        banner.id = 'chatEditBanner';
        banner.setAttribute('style', 'display:flex;align-items:center;justify-content:space-between;gap:10px;padding:8px 14px;border-top:1px solid #e5e7eb;background:#eff6ff;font-size:13px;');
        banner.innerHTML = '<span><i class="bi bi-pencil"></i> Editing message</span>' +
            '<button type="button" class="chat-edit-cancel" aria-label="Cancel" style="border:0;background:transparent;font-size:20px;line-height:1;cursor:pointer;">&times;</button>';

        el.composer.parentNode.insertBefore(banner, el.composer);

        el.input.value = msg.body || '';
        el.input.focus();
    }

    async function deleteMessage(id) {
        const msg = messageById(id);

        if (!msg || msg.deleted) {
            return;
        }

        // "Delete for everyone" is only for my own messages
        const mode = await chooseDelete({ allowEveryone: msg.sender_id === me.id });

        if (!mode) {
            return;
        }

        try {
            const res = await api.deleteMessage(id, mode);

            if (state.editingId === id) {
                cancelEdit();
                el.input.value = '';
            }

            if (mode === 'me') {
                const scroll = el.messages.scrollTop;

                state.messages = state.messages.filter((m) => m.id !== id);
                renderMessages();
                el.messages.scrollTop = scroll;
            } else {
                replaceMessage(res.data);
            }

            loadList();
        } catch (error) {
            notify(error.message || 'Message could not be deleted.', 'error');
        }
    }

    // The other person edited or deleted a message
    function onMessageChanged(msg) {
        if (!msg) {
            return;
        }

        if (msg.conversation_id === state.activeId) {
            replaceMessage(msg);
        }

        loadList();
    }

    async function sendMessage() {
        const body = el.input.value.trim();
        const files = state.pendingFiles.slice();

        if (state.sending) {
            return;
        }

        // Saving an edited message
        if (state.editingId) {
            if (!body) {
                notify('A message cannot be empty. Use delete instead.', 'error');
                return;
            }

            if (files.length) {
                notify('Attachments cannot be added while editing.', 'error');
                return;
            }

            state.sending = true;

            try {
                const res = await api.editMessage(state.editingId, body);

                replaceMessage(res.data);
                cancelEdit();
                el.input.value = '';
                loadList();
            } catch (error) {
                notify(error.message || 'Message could not be edited.', 'error');
            } finally {
                state.sending = false;
                el.input.focus();
            }

            return;
        }

        if ((!body && !files.length) || !state.activeId) {
            return;
        }

        state.sending = true;
        el.sendBtn.disabled = true;

        if (files.length) {
            showSending(files);
        }

        try {
            const res = await api.send(state.activeId, body, files);

            hideSending();
            el.input.value = '';
            clearAttachPreview();
            appendMessage(res.data);
            touchConversation(res.data, { mine: true, unread: 0 });
            renderList();
        } catch (error) {
            notify(error.message || 'Message could not be sent.', 'error');
        } finally {
            hideSending();
            state.sending = false;
            el.sendBtn.disabled = false;
            el.input.focus();
        }
    }

    function onIncoming(msg) {
        if (!msg || msg.sender_id === me.id) {
            return;
        }

        clearTyping(msg.conversation_id);

        const active = msg.conversation_id === state.activeId;
        const known = findConv(msg.conversation_id);

        if (active) {
            appendMessage(msg);
        }

        const touched = touchConversation(msg, {
            mine: false,
            unread: active ? 0 : (known ? known.unread : 0) + 1,
        });

        if (!touched) {
            // Brand new conversation, fetch the list again
            loadList();
            return;
        }

        renderList();

        if (active) {
            // This also turns the sender's ticks blue
            api.read(msg.conversation_id).catch(() => { });
        }
    }

    /* ---------------------------------------------------
       Typing, seen ticks, presence
    --------------------------------------------------- */

    function clearTyping(conversationId) {
        if (state.typing[conversationId]) {
            clearTimeout(state.typing[conversationId]);
            delete state.typing[conversationId];
        }
    }

    function onTyping(event) {
        if (!event || event.user_id === me.id) {
            return;
        }

        const id = event.conversation_id;

        clearTyping(id);

        state.typing[id] = setTimeout(() => {
            delete state.typing[id];
            refreshLiveUi();
        }, TYPING_SHOW_MS);

        refreshLiveUi();
    }

    function onInputTyping() {
        if (!state.activeId || !el.input.value) {
            return;
        }

        const now = Date.now();

        if (now - state.lastTypingSent < TYPING_SEND_GAP_MS) {
            return;
        }

        state.lastTypingSent = now;
        api.typing(state.activeId).catch(() => { });
    }

    // A person went offline: drop every online sign for them right away
    function markOffline(userId) {
        state.online.delete(userId);

        state.conversations.forEach((conv) => {
            if (conv.user.id === userId) {
                conv.user.last_online_at = null;
            }
        });

        if (state.pending && state.pending.user.id === userId) {
            state.pending.user.last_online_at = null;
        }

        refreshLiveUi();
    }

    function onMessagesRead(event) {
        if (!event || event.conversation_id !== state.activeId) {
            return;
        }

        const upTo = event.up_to_id;

        state.messages.forEach((m) => {
            if (m.sender_id === me.id && m.id <= upTo && !m.read_at) {
                m.read_at = event.read_at;
            }
        });

        el.messages.querySelectorAll('.message-row.sent').forEach((row) => {
            if (Number(row.dataset.id) > upTo) {
                return;
            }

            const icon = row.querySelector('.chat-tick');

            if (icon) {
                icon.className = 'bi bi-check2-all chat-tick';
                icon.style.color = '#34B7F1';
            }
        });
    }

    /* ---------------------------------------------------
       New chat modal
    --------------------------------------------------- */

    const MEMBER_HINT = `<div class="chat-empty" style="${EMPTY_STYLE}">Type a Member ID to search.</div>`;

    let memberTimer = null;

    async function searchMembers(term) {
        // Show a loading line only when there are no results on screen yet
        if (!el.memberResults.querySelector('.member-result')) {
            el.memberResults.innerHTML = `<div class="chat-empty" style="${EMPTY_STYLE}">Loading...</div>`;
        }

        try {
            const res = await api.members(term);

            // Ignore stale responses
            if (el.memberSearch.value.trim() !== term) {
                return;
            }

            if (res.data.length) {
                el.memberResults.innerHTML = res.data
                    .map((m) => ({ m, online: isUserOnline(m) }))
                    .sort((a, b) => Number(b.online) - Number(a.online))
                    .map((x) => view.memberResultHtml(x.m, x.online))
                    .join('');
            } else {
                el.memberResults.innerHTML = term
                    ? '<div class="no-search-result"><i class="bi bi-person-x"></i> No eligible member found</div>'
                    : `<div class="chat-empty" style="${EMPTY_STYLE}">No members available to add.</div>`;
            }
        } catch (error) {
            el.memberResults.innerHTML = `<div class="chat-empty" style="${EMPTY_STYLE}">Could not load members. Try again.</div>`;
        }
    }

    async function startChat(member) {
        try {
            const res = await api.start(member.id);

            if (!findConv(res.conversation_id)) {
                state.pending = {
                    id: res.conversation_id,
                    user: {
                        id: member.id,
                        name: member.name,
                        member_id: member.member_id,
                        avatar: member.avatar,
                        color: member.color,
                        location_id: null,
                        last_online_at: null,
                    },
                    last: null,
                    unread: 0,
                };
            }

            closeMemberModal();
            renderList();
            openConversation(res.conversation_id);
            loadList();
        } catch (error) {
            notify(error.message || 'Chat could not be started.', 'error');
        }
    }

    if (el.memberSearch) {
        el.memberSearch.addEventListener('input', function () {
            clearTimeout(memberTimer);

            const term = this.value.trim();

            // An empty box shows everyone who can be added
            memberTimer = setTimeout(() => searchMembers(term), term ? 300 : 0);
        });
    }

    el.memberResults.addEventListener('click', (event) => {
        const row = event.target.closest('.member-result');

        if (!row) {
            return;
        }

        startChat({
            id: Number(row.dataset.userId),
            name: row.dataset.memberName,
            member_id: row.dataset.memberId,
            avatar: row.dataset.avatar,
            color: row.dataset.color,
        });
    });

    /* ---------------------------------------------------
       Events
       Capture-phase listeners run before the older static UI script,
       so demo handlers for the same elements never fire.
    --------------------------------------------------- */

    document.addEventListener('click', (event) => {
        const target = event.target;

        if (!root.contains(target)) {
            return;
        }

        // Send button
        if (target.closest('#sendBtn')) {
            event.preventDefault();
            event.stopPropagation();
            sendMessage();
            return;
        }
        // Edit, delete and cancel-edit on messages
        const editBtn = target.closest('.chat-msg-edit');

        if (editBtn) {
            event.preventDefault();
            event.stopPropagation();
            startEdit(Number(editBtn.closest('.message-row').dataset.id));
            return;
        }

        const deleteBtn = target.closest('.chat-msg-delete');

        if (deleteBtn) {
            event.preventDefault();
            event.stopPropagation();
            deleteMessage(Number(deleteBtn.closest('.message-row').dataset.id));
            return;
        }

        if (target.closest('.chat-edit-cancel')) {
            event.preventDefault();
            event.stopPropagation();
            cancelEdit();
            el.input.value = '';
            return;
        }

        // Remove one selected attachment
        const removeBtn = target.closest('.chat-attach-remove');

        if (removeBtn) {
            event.preventDefault();
            event.stopPropagation();
            state.pendingFiles.splice(Number(removeBtn.dataset.index), 1);
            renderAttachPreview();
            return;
        }

        // Three dots on a chat row
        const dots = target.closest('.chat-user .chatInfoBtn');

        if (dots) {
            event.preventDefault();
            event.stopPropagation();

            const wrapper = dots.closest('.more-info-wrapper');
            const wasOpen = wrapper.classList.contains('open');

            closeAllChatMenus();

            if (!wasOpen) {
                wrapper.classList.add('open');
            }

            return;
        }

        // Mark as read from the row menu
        const mark = target.closest('.chat-mark-read');

        if (mark) {
            event.preventDefault();
            event.stopPropagation();

            const item = mark.closest('.chat-user');

            closeAllChatMenus();

            if (item) {
                markRead(Number(item.dataset.id));
            }

            return;
        }

        // New button: show everyone who can be added (the older script opens the modal)
        if (target.closest('#newChatBtn')) {
            el.memberSearch.value = '';
            searchMembers('');
        }

        // Filter options (do not stop propagation, the old script still closes the dropdown)
        const option = target.closest('#filterDropdown .filter-option');

        if (option) {
            state.filter = FILTERS[option.dataset.filter] || 'active';
            loadList();
        }
    }, true);

    document.addEventListener('keydown', (event) => {
        if (event.target !== el.input || event.isComposing) {
            return;
        }

        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            event.stopPropagation();
            sendMessage();
        }
    }, true);

    // The file input: take over from the old script that only pasted the file name
    document.addEventListener('change', (event) => {
        if (event.target === el.fileInput) {
            event.stopPropagation();
            onFileChosen();
        }
    }, true);

    document.addEventListener('change', (event) => {
        if (event.target.matches && event.target.matches('input[name="location"]')) {
            state.location = LOCATIONS[event.target.value] || 'mine';
            loadList();
        }
    });

    // A photo that fails to load falls back to the initials
    document.addEventListener('error', (event) => {
        const target = event.target;

        if (target && target.classList && target.classList.contains('chat-avatar-img')) {
            target.replaceWith(document.createTextNode(target.dataset.initials || '?'));
        }
    }, true);

    el.input.addEventListener('input', onInputTyping);

    el.list.addEventListener('click', (event) => {
        if (event.target.closest('.more-info-wrapper')) {
            return;
        }

        const item = event.target.closest('.chat-user');

        if (item) {
            openConversation(Number(item.dataset.id));
        }
    });

    el.messages.addEventListener('scroll', async () => {
        if (el.messages.scrollTop > 40 || !state.hasMore || state.loadingOlder || !state.activeId) {
            return;
        }

        state.loadingOlder = true;

        try {
            await loadMessages(true);
        } catch (error) {
            console.error('Older messages failed', error);
        } finally {
            state.loadingOlder = false;
        }
    });

    /* ---------------------------------------------------
       Start
    --------------------------------------------------- */

    if (el.fileInput) {
        el.fileInput.accept = FILE_ACCEPT;
        el.fileInput.multiple = true;
    }

    renderHeader(null);
    renderMessages();
    setComposerEnabled(false);
    el.memberResults.innerHTML = MEMBER_HINT;

    socket.on('MessageSent', onIncoming);
    socket.on('UserTyping', onTyping);
    socket.on('MessagesRead', onMessagesRead);
    socket.on('MessageChanged', onMessageChanged);

    socket.on('presence:here', (ids) => {
        state.online = new Set(ids);
        refreshLiveUi();
    });
    socket.on('presence:joining', (u) => {
        state.online.add(u.id);
        refreshLiveUi();
    });
    socket.on('presence:leaving', (u) => markOffline(u.id));
    socket.on('UserOffline', (e) => markOffline(Number(e.user_id)));

    initChatActions({
        root,
        state,
        api,
        notify,
        findConv,
        loadList,
        closeActive,
        closeAllChatMenus,
        isUserOnline,
        hideBlocked: config.hideBlockedChats,
        renderList,
        renderMessages,
        updateBlockUi,
    });

    loadList();
}
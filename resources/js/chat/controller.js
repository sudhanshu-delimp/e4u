import { createEcho } from './echo';
import { createApi } from './api';
import * as view from './render';
import { initChatActions } from './actions';

// UI filter value -> server filter value
const FILTERS = { chats: 'active', archived: 'archived', deleted: 'deleted' };

// Radio value -> server location value
const LOCATIONS = { 'your-location': 'mine', australia: 'australia' };

const EMPTY_STYLE = 'padding:24px;text-align:center;color:#6b7280;font-size:14px;';
const MAX_FILE_BYTES = 50 * 1024 * 1024;
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

    window.alert(text);
}

export function initChat(root) {
    const config = JSON.parse(root.dataset.config || '{}');
    const me = config.me;
    const api = createApi(config);
    const echo = createEcho(config.csrf);

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
        pendingFile: null,
        previewUrl: null,
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
    function closeActive() {
        state.activeId = null;
        state.messages = [];
        state.hasMore = false;

        clearAttachPreview();
        renderHeader(null);
        renderMessages();
        setComposerEnabled(false);
        renderList();
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

        api.read(id).catch(() => {});
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
        const box = document.getElementById('chatAttachPreview');

        if (box) {
            box.remove();
        }

        if (state.previewUrl) {
            URL.revokeObjectURL(state.previewUrl);
        }

        state.previewUrl = null;
        state.pendingFile = null;
    }

       function showAttachPreview(file) {
        clearAttachPreview();

        state.pendingFile = file;

        let thumb;

        if (PREVIEWABLE_IMAGES.indexOf(file.type) !== -1) {
            state.previewUrl = URL.createObjectURL(file);
            thumb = `<img src="${state.previewUrl}" alt="" style="width:44px;height:44px;object-fit:cover;border-radius:6px;">`;
        } else {
            const icon = fileKind(file) === 'image' ? 'bi-image' : 'bi-camera-video';
            thumb = `<span style="width:44px;height:44px;border-radius:6px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:20px;"><i class="bi ${icon}"></i></span>`;
        }

        const box = document.createElement('div');

        box.id = 'chatAttachPreview';
        box.setAttribute('style', 'display:flex;align-items:center;gap:10px;padding:8px 14px;border-top:1px solid #e5e7eb;background:#f9fafb;font-size:13px;');
        box.innerHTML = `
            ${thumb}
            <span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                ${view.escapeHtml(file.name)} (${view.formatSize(file.size)})
            </span>
            <button type="button" class="chat-attach-remove" title="Remove"
                style="border:0;background: #ff3c5f;font-size:20px;line-height:1;cursor:pointer;">&times;</button>
        `;

        el.composer.parentNode.insertBefore(box, el.composer);
    }

       function onFileChosen() {
        const file = el.fileInput.files && el.fileInput.files[0];

        // Reset so choosing the same file again still fires a change event
        el.fileInput.value = '';

        if (!file) {
            return;
        }

        if (!state.activeId) {
            notify('Select a chat first.', 'error');
            return;
        }

        if (!fileKind(file)) {
            notify('This file type is not supported. Send an image or a video.', 'error');
            return;
        }

        if (file.size > MAX_FILE_BYTES) {
            notify('File is too large. Maximum size is 50 MB.', 'error');
            return;
        }

        showAttachPreview(file);
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

    async function sendMessage() {
        const body = el.input.value.trim();
        const file = state.pendingFile;

        if ((!body && !file) || !state.activeId || state.sending) {
            return;
        }

        state.sending = true;
        el.sendBtn.disabled = true;

        try {
            const res = await api.send(state.activeId, body, file);

            el.input.value = '';
            clearAttachPreview();
            appendMessage(res.data);
            touchConversation(res.data, { mine: true, unread: 0 });
            renderList();
        } catch (error) {
            notify(error.message || 'Message could not be sent.', 'error');
        } finally {
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
            api.read(msg.conversation_id).catch(() => {});
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
        api.typing(state.activeId).catch(() => {});
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
                el.memberResults.innerHTML = res.data.map(view.memberResultHtml).join('');
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

        // Remove the selected attachment
        if (target.closest('.chat-attach-remove')) {
            event.preventDefault();
            event.stopPropagation();
            clearAttachPreview();
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
    }

    renderHeader(null);
    renderMessages();
    setComposerEnabled(false);
    el.memberResults.innerHTML = MEMBER_HINT;

    echo.private('user.' + me.id)
        .listen('.MessageSent', onIncoming)
        .listen('.UserTyping', onTyping)
        .listen('.MessagesRead', onMessagesRead);

    echo.join('online')
        .here((users) => {
            state.online = new Set(users.map((u) => u.id));
            refreshLiveUi();
        })
        .joining((user) => {
            state.online.add(user.id);
            refreshLiveUi();
        })
        .leaving((user) => {
            state.online.delete(user.id);
            refreshLiveUi();
        });

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
    });

    loadList();
}
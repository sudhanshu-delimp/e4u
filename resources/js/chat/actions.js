import * as view from './render';
import { confirmAction } from './dialogs';

/**
 * Row menu actions (Contact Info, Archive, Delete) and the header Contact Info button.
 * Capture-phase listeners keep the older static UI script from running its demo handlers.
 */
export function initChatActions(ctx) {
    const {
        root, state, api, notify, findConv, loadList, closeActive, closeAllChatMenus,
        isUserOnline, renderList, renderMessages, updateBlockUi,hideBlocked,
    } = ctx;

    let overlay = null;

    function closeModal() {
        if (!overlay) {
            return;
        }

        overlay.remove();
        overlay = null;
        document.removeEventListener('keydown', onKey, true);
    }

    function onKey(event) {
        if (event.key === 'Escape') {
            event.stopPropagation();
            closeModal();
        }
    }


    function openContactModal(info) {
        closeModal();

        const online = isUserOnline({
            id: info.id,
            last_online_at: info.last_online_at
        });

        let status = 'Offline';

        if (online) {
            status = 'Active now';
        } else if (info.last_online_at) {
            status = 'Last seen ' + info.last_online_at;
        }

        const rows = [
            ['Member ID', info.member_id],
            ['Type', info.type],
            ['Phone', info.phone || 'N/A'],
            ['Location', info.location],
            ['Home state', info.home_state],
            ['Member since', info.member_since],
            // ['Status', status],
        ].filter(row => row[1]);

        const rowsHtml = rows.map(row => `
            <div class="form-group row border-bottom">
                <label class="col-sm-5"><strong>${view.escapeHtml(row[0])}:</strong></label>
                <div class="col-sm-7 text-right">
                    ${view.escapeHtml(row[1])}
                </div>
            </div>
        `).join('');

        overlay = document.createElement('div');
        overlay.className = 'chat-contact-overlay';

        // Sits above the whole page, so the modal and its backdrop are always visible
        overlay.setAttribute('style', 'position:fixed;inset:0;z-index:99999;');

        overlay.innerHTML = `
            <div class="modal-backdrop fade show"></div>

            <div class="modal fade upload-modal modal-form-cancel show"
                 role="dialog"
                 aria-modal="true"
                 style="display:block;overflow-y:auto;">

                <div class="modal-dialog modal-dialog-centered modal-md"
                     role="document">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <img src="/assets/dashboard/img/list-profile.png"
                                     class="custompopicon"
                                     alt="Contact">
                                Contact Details
                            </h5>

                            <button type="button"
                                    class="close chat-contact-close"
                                    aria-label="Close">
                                <span aria-hidden="true">
                                    <img src="/assets/app/img/newcross.png"
                                         class="img-fluid img_resize_in_smscreen"
                                         alt="Close">
                                </span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="container p-0">

                                <div class="text-center mb-4">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div style="position:relative;">
                                            <div style="${view.avatarStyle(info.color)}width:84px;height:84px;border-radius:16px;font-size:26px;">
                                                ${view.avatarInner({
            name: info.name,
            avatar: info.avatar
        })}
                                            </div>
                                            ${online ? '<span style="position:absolute;right:-4px;bottom:-4px;width:16px;height:16px;border-radius:50%;background:#22c55e;border:3px solid #fff;"></span>' : ''}
                                        </div>
                                    </div>

                                    <h5>${view.escapeHtml(info.name || '')}</h5>

                                    <p class="mb-0">
                                        ${view.escapeHtml(status)}
                                    </p>
                                </div>

                                <hr>

                                ${rowsHtml}

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        `;

        overlay.addEventListener('click', event => {
            // The close buttons, the dark area around the dialog, or the backdrop
            if (
                event.target.closest('.chat-contact-close') ||
                event.target.classList.contains('modal') ||
                event.target.classList.contains('modal-backdrop')
            ) {
                closeModal();
            }
        });

        document.body.appendChild(overlay);
        document.addEventListener('keydown', onKey, true);
    }


    async function showContact(id) {
        try {
            const res = await api.contact(id);
            openContactModal(res.data);
        } catch (error) {
            notify(error.message || 'Could not load contact info.', 'error');
        }
    }

    async function archiveChat(id) {
        const conv = findConv(id);
        const archive = !(conv && conv.is_archived);

        try {
            await api.archive(id, archive);

            if (state.activeId === id) {
                closeActive();
            }

            await loadList();
            if (archive) {
                showAlert('success', 'Chat archived.');
            } else {
                showAlert('success', 'Chat moved back to your list.');
            }
        } catch (error) {
            notify(error.message || 'Action failed.', 'error');
        }
    }

    async function deleteChat(id) {
        const ok = await confirmAction({
            title: 'Delete this chat?',
            text: 'The other person will still keep it.',
            confirmText: 'Delete',
            danger: true,
        });

        if (!ok) {
            return;
        }

        try {
            await api.deleteChat(id);

            if (state.activeId === id) {
                closeActive();
            }

            await loadList();
            notify('Chat deleted.', 'success');
        } catch (error) {
            notify(error.message || 'Chat could not be deleted.', 'error');
        }
    }

    function closeHeaderMenu() {
        const wrapper = document.querySelector('.more-wrapper');

        if (wrapper) {
            wrapper.classList.remove('open');
        }
    }

    async function clearChat() {
        const conv = findConv(state.activeId);

        if (!conv) {
            return;
        }

        const ok = await confirmAction({
            title: 'Clear this chat?',
            text: 'The other person will still keep the messages.',
            confirmText: 'Clear chat',
            danger: true,
        });

        if (!ok) {
            return;
        }

        try {
            await api.clear(conv.id);

            state.messages = [];
            state.hasMore = false;
            conv.last = null;
            conv.unread = 0;

            renderMessages();
            renderList();
            notify('Chat cleared.', 'success');
        } catch (error) {
            notify(error.message || 'Chat could not be cleared.', 'error');
        }
    }

    async function toggleBlock() {
        const conv = findConv(state.activeId);

        if (!conv) {
            return;
        }

        const unblock = !!conv.blocked_by_me;

        if (!unblock) {
            const ok = await confirmAction({
                title: 'Block this user?',
                text: 'You will not be able to message each other.',
                confirmText: 'Block',
                danger: true,
            });

            if (!ok) {
                return;
            }
        }

        try {
            if (unblock) {
                await api.unblock(conv.id);
            } else {
                await api.block(conv.id);
            }

            conv.blocked_by_me = !unblock;

            // Massage Centre: a blocked person leaves the list right away
            if (hideBlocked && !unblock) {
                closeActive();
                await loadList();
                notify('User blocked.', 'success');
                return;
            }

            updateBlockUi(conv);
            notify(unblock ? 'User unblocked.' : 'User blocked.', 'success');
        } catch (error) {
            notify(error.message || 'Action failed.', 'error');
        }
    }

    document.addEventListener('click', (event) => {
        const target = event.target;

        if (!root.contains(target)) {
            return;
        }

        // Buttons inside a chat row menu
        const action = target.closest('.chat-action');

        if (action) {
            event.preventDefault();
            event.stopPropagation();

            const item = action.closest('.chat-user');

            closeAllChatMenus();

            if (!item) {
                return;
            }

            const id = Number(item.dataset.id);

            if (action.dataset.action === 'contact') {
                showContact(id);
            } else if (action.dataset.action === 'archive') {
                archiveChat(id);
            } else if (action.dataset.action === 'delete') {
                deleteChat(id);
            }

            return;
        }

        // Clear Chat in the header menu
        if (target.closest('#clearChatBtn')) {
            event.preventDefault();
            event.stopPropagation();
            closeHeaderMenu();
            clearChat();
            return;
        }

        // Block / Unblock in the header menu, and Unblock in the banner
        if (target.closest('#blockUserBtn') || target.closest('.chat-unblock')) {
            event.preventDefault();
            event.stopPropagation();
            closeHeaderMenu();
            toggleBlock();
            return;
        }

        // Contact Info in the header three dots menu
        if (target.closest('#contactInfoBtn')) {
            event.preventDefault();
            event.stopPropagation();

            const wrapper = document.querySelector('.more-wrapper');

            if (wrapper) {
                wrapper.classList.remove('open');
            }

            if (state.activeId) {
                showContact(state.activeId);
            }
        }
    }, true);
}
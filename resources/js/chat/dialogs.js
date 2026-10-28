/**
 * Dialogs for the chat, built on SweetAlert. Works with SweetAlert2 (window.Swal)
 * and with sweetalert 2.x (window.swal). Browser alert() and confirm() are never used.
 */
function isSwal2() {
    return !!(window.Swal && typeof window.Swal.fire === 'function');
}

function isSwal() {
    return typeof window.swal === 'function';
}

function missing() {
    console.error('SweetAlert is not loaded on this page.');
}

// Yes / No question. Resolves to true when the user confirms.
export async function confirmAction({ title, text, confirmText, danger }) {
    if (isSwal2()) {
        const result = await window.Swal.fire({
            title,
            text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText || 'Yes',
            cancelButtonText: 'Cancel',
            confirmButtonColor: danger ? '#e11d48' : undefined,
            reverseButtons: true,
        });

        return !!result.isConfirmed;
    }

    if (isSwal()) {
        const value = await window.swal({
            title,
            text,
            icon: 'warning',
            buttons: ['Cancel', confirmText || 'Yes'],
            dangerMode: !!danger,
        });

        return !!value;
    }

    missing();

    return false;
}

// Delete a message. Resolves to 'me', 'everyone' or null (cancelled).
export async function chooseDelete({ allowEveryone }) {
    if (!allowEveryone) {
        const ok = await confirmAction({
            title: 'Delete this message?',
            text: 'It will be removed only for you.',
            confirmText: 'Delete for me',
            danger: true,
        });

        return ok ? 'me' : null;
    }

    if (isSwal2()) {
        const result = await window.Swal.fire({
            title: 'Delete this message?',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Delete for everyone',
            denyButtonText: 'Delete for me',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#e11d48',
        });

        if (result.isConfirmed) {
            return 'everyone';
        }

        return result.isDenied ? 'me' : null;
    }

    if (isSwal()) {
        const value = await window.swal({
            title: 'Delete this message?',
            icon: 'warning',
            buttons: {
                cancel: 'Cancel',
                me: { text: 'Delete for me', value: 'me' },
                everyone: { text: 'Delete for everyone', value: 'everyone', className: 'swal-button--danger' },
            },
        });

        return value === 'me' || value === 'everyone' ? value : null;
    }

    missing();

    return null;
}

// A short message (type is 'success' or 'error')
export function notice(type, text) {
    const icon = type === 'success' ? 'success' : 'error';

    if (isSwal2()) {
        window.Swal.fire({ icon, text });
        return;
    }

    if (isSwal()) {
        window.swal({ icon, text });
        return;
    }

    missing();
}
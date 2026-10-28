export function createApi({ csrf, routes }) {

    async function request(url, options = {}) {
        const headers = {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrf || '',
        };

        // JSON bodies need a content type, FormData sets its own boundary
        if (typeof options.body === 'string') {
            headers['Content-Type'] = 'application/json';
        }

        const response = await fetch(url, {
            credentials: 'same-origin',
            ...options,
            headers,
        });

        let data = null;

        try {
            data = await response.json();
        } catch (e) {
            data = null;
        }

        if (!response.ok) {
            let message = data && data.message ? data.message : 'Request failed';

            // Laravel validation errors: show the first one
            if (data && data.errors) {
                const first = Object.values(data.errors)[0];
                message = Array.isArray(first) ? first[0] : message;
            }

            const error = new Error(message);
            error.status = response.status;
            error.data = data;
            throw error;
        }

        return data;
    }

    // Conversation URLs are built from the messages route: .../conversations/__ID__/messages
    const conversationUrl = (id, suffix) =>
        routes.messages.replace('__ID__', id).replace(/\/messages$/, suffix ? '/' + suffix : '');

    const withId = (template, id) => template.replace('__ID__', id);

    const query = (params) => {
        const text = new URLSearchParams(params || {}).toString();
        return text ? '?' + text : '';
    };

    return {
        conversations: (params) => request(routes.conversations + query(params)),

        members: (q) => request(routes.members + query({ q })),

        start: (userId) => request(routes.conversations, {
            method: 'POST',
            body: JSON.stringify({ user_id: userId }),
        }),

        messages: (id, params) => request(withId(routes.messages, id) + query(params)),

        send: (id, body, files) => {
            if (files && files.length) {
                const form = new FormData();

                if (body) {
                    form.append('body', body);
                }

                files.forEach((file) => form.append('files[]', file));

                return request(withId(routes.messages, id), { method: 'POST', body: form });
            }

            return request(withId(routes.messages, id), {
                method: 'POST',
                body: JSON.stringify({ body }),
            });
        },

        read: (id) => request(withId(routes.read, id), { method: 'POST' }),

        typing: (id) => request(withId(routes.typing, id), { method: 'POST' }),

        contact: (id) => request(conversationUrl(id, 'contact')),

        archive: (id, archived) => request(conversationUrl(id, 'archive'), {
            method: 'POST',
            body: JSON.stringify({ archived }),
        }),

        deleteChat: (id) => request(conversationUrl(id, 'delete'), { method: 'POST' }),
        clear: (id) => request(conversationUrl(id, 'clear'), { method: 'POST' }),
        block: (id) => request(conversationUrl(id, 'block'), { method: 'POST' }),
        unblock: (id) => request(conversationUrl(id, 'block'), { method: 'DELETE' }),
        editMessage: (id, body) => request(withId(routes.message, id), {
            method: 'PATCH',
            body: JSON.stringify({ body }),
        }),
        deleteMessage: (id, mode) => request(withId(routes.message, id), {
            method: 'DELETE',
            body: JSON.stringify({ mode }),
        }),
    };
}
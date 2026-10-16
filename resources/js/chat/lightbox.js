/**
 * Click a photo in a chat bubble to open a viewer for every photo and video of that message.
 * Arrow buttons, the keyboard arrows and a swipe move between items.
 * Esc, the close button or a click on the dark area closes it.
 */
export function initLightbox(root) {
    let overlay = null;
    let stage = null;
    let counter = null;
    let items = [];
    let index = 0;
    let touchStartX = 0;

    function show() {
        const item = items[index];
        const node = document.createElement(item.kind === 'video' ? 'video' : 'img');

        node.src = item.src;
        node.setAttribute('style', 'max-width:100%;max-height:100%;border-radius:8px;box-shadow:0 10px 40px rgba(0,0,0,.5);');

        if (item.kind === 'video') {
            node.controls = true;
            node.autoplay = true;
        }

        stage.innerHTML = '';
        stage.appendChild(node);
        counter.textContent = items.length > 1 ? (index + 1) + ' / ' + items.length : '';
    }

    function move(step) {
        if (items.length < 2) {
            return;
        }

        index = (index + step + items.length) % items.length;
        show();
    }

    function onKey(event) {
        if (event.key === 'Escape') {
            event.stopPropagation();
            close();
        } else if (event.key === 'ArrowRight') {
            move(1);
        } else if (event.key === 'ArrowLeft') {
            move(-1);
        }
    }

    function close() {
        if (!overlay) {
            return;
        }

        overlay.remove();
        overlay = null;
        document.removeEventListener('keydown', onKey, true);
    }

    function open(list, start) {
        close();

        items = list;
        index = start;

        const arrow = 'position:absolute;top:50%;transform:translateY(-50%);border:0;background:rgba(255,255,255,.18);' +
            'color:#fff;width:44px;height:44px;border-radius:50%;font-size:20px;cursor:pointer;';
        const showArrows = items.length > 1;

        overlay = document.createElement('div');
        overlay.setAttribute(
            'style',
            'position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.88);' +
            'display:flex;align-items:center;justify-content:center;'
        );

        overlay.innerHTML = `
            <button type="button" class="chat-lb-close" aria-label="Close"
                style="position:absolute;top:14px;right:20px;border:0;background:transparent;color:#fff;font-size:34px;line-height:1;cursor:pointer;">&times;</button>
            ${showArrows ? `<button type="button" class="chat-lb-prev" aria-label="Previous" style="${arrow}left:16px;">&#10094;</button>` : ''}
            <div class="chat-lb-stage" style="width:100%;height:100%;padding:56px 72px;box-sizing:border-box;display:flex;align-items:center;justify-content:center;"></div>
            ${showArrows ? `<button type="button" class="chat-lb-next" aria-label="Next" style="${arrow}right:16px;">&#10095;</button>` : ''}
            <div class="chat-lb-counter" style="position:absolute;bottom:16px;left:0;right:0;text-align:center;color:#fff;font-size:14px;"></div>
        `;

        stage = overlay.querySelector('.chat-lb-stage');
        counter = overlay.querySelector('.chat-lb-counter');

        overlay.addEventListener('click', (event) => {
            if (event.target.closest('.chat-lb-prev')) {
                move(-1);
            } else if (event.target.closest('.chat-lb-next')) {
                move(1);
            } else if (event.target === overlay || event.target === stage || event.target.closest('.chat-lb-close')) {
                close();
            }
        });

        overlay.addEventListener('touchstart', (event) => {
            touchStartX = event.changedTouches[0].clientX;
        });

        overlay.addEventListener('touchend', (event) => {
            const distance = event.changedTouches[0].clientX - touchStartX;

            if (Math.abs(distance) > 50) {
                move(distance < 0 ? 1 : -1);
            }
        });

        document.body.appendChild(overlay);
        document.addEventListener('keydown', onKey, true);
        show();
    }

    root.addEventListener('click', (event) => {
        const link = event.target.closest('a.chat-media');

        if (!link) {
            return;
        }

        // Stop the link from opening a new tab
        event.preventDefault();

        const bubble = link.closest('.message-bubble');
        const nodes = Array.from(bubble.querySelectorAll('.chat-media'));

        open(
            nodes.map((node) => ({
                kind: node.dataset.kind,
                src: node.tagName === 'A' ? node.getAttribute('href') : (node.currentSrc || node.src),
            })),
            nodes.indexOf(link)
        );
    });
}
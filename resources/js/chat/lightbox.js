/**
 * Click on a photo inside a chat bubble to see it large.
 * Esc, the close button or a click on the dark area closes it.
 */
export function initLightbox(root) {
    let overlay = null;

    function onKey(event) {
        if (event.key === 'Escape') {
            event.stopPropagation();
            close();
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

    function open(src) {
        close();

        overlay = document.createElement('div');
        overlay.setAttribute(
            'style',
            'position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.85);' +
            'display:flex;align-items:center;justify-content:center;padding:24px;cursor:zoom-out;'
        );

        const image = document.createElement('img');
        image.src = src;
        image.alt = '';
        image.setAttribute(
            'style',
            'max-width:100%;max-height:100%;border-radius:8px;box-shadow:0 10px 40px rgba(0,0,0,.5);'
        );

        const button = document.createElement('button');
        button.type = 'button';
        button.setAttribute('aria-label', 'Close');
        button.innerHTML = '&times;';
        button.setAttribute(
            'style',
            'position:absolute;top:16px;right:20px;border:0;background:transparent;' +
            'color:#fff;font-size:34px;line-height:1;cursor:pointer;'
        );

        overlay.appendChild(image);
        overlay.appendChild(button);
        overlay.addEventListener('click', close);

        document.body.appendChild(overlay);
        document.addEventListener('keydown', onKey, true);
    }

    root.addEventListener('click', (event) => {
        const image = event.target.closest('.message-bubble a > img');

        if (!image) {
            return;
        }

        // Stop the link from opening a new tab
        event.preventDefault();
        open(image.currentSrc || image.src);
    });
}
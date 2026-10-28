import { initChat } from './controller';
import { initLightbox } from './lightbox';

document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('chatApp');

    if (root) {
        initChat(root);
        initLightbox(root);
    }
});
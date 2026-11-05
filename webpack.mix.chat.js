const mix = require('laravel-mix');

mix.setPublicPath('public/chat-build');
mix.js('resources/js/chat/index.js', 'js/chat.js');

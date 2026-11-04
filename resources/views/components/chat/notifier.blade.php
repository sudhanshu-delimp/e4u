@props(['url' => '#'])

@auth
    <div id="chat-notify" hidden
         data-socket-url="{{ config('chat.socket.public_url') }}"
         data-token="{{ \App\Services\ChatSocket::token(auth()->id()) }}"
         data-me="{{ auth()->id() }}"
         data-chat-url="{{ $url }}"
         data-avatar-base="{{ rtrim(asset(''), '/') }}"></div>
    <script src="{{ asset('chat-build/js/notify.js') }}?v={{ @filemtime(public_path('chat-build/js/notify.js')) ?: time() }}"></script>
@endauth
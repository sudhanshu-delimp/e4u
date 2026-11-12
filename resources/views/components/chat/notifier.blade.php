@props(['url' => '#'])

@auth
    <div id="chat-notify" hidden
         data-socket-url="{{ config('chat.socket.public_url') }}"
         data-token="{{ \App\Services\ChatSocket::token(auth()->id()) }}"
         data-me="{{ auth()->id() }}"
         data-chat-url="{{ $url }}"
         data-call-url="{{ route('chat.call', ['conversation' => '__ID__']) }}"
         data-csrf="{{ csrf_token() }}"
        data-ice='@json(config("chat.ice_servers", []))'
         data-avatar-base="{{ rtrim(asset(''), '/') }}"></div>
         
    <script src="{{ asset('chat-build/js/notify.js') }}?v={{ @filemtime(public_path('chat-build/js/notify.js')) ?: time() }}"></script>
@endauth
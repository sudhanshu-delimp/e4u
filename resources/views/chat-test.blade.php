<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat test</title>
</head>
<body>
    <h3>Console Open (F12)</h3>
    <script src="{{ asset('chat-build/js/chat.js') }}"></script>
</body>
</html>
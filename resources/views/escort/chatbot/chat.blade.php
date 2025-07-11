@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }
    </style>
@endsection
@section('content')
<div class="container-fluid h-100">
    <div class="row h-100">
        <!-- Sidebar Chat List -->
        <div class="col-md-4 border-end bg-white overflow-auto">
            <div class="p-3 fw-bold border-bottom">Chats</div>
            <ul class="list-group list-group-flush">
                @foreach($users as $user)
                    <li class="list-group-item list-group-item-action"
                        onclick="loadChat({{ $user->id }})">
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <small class="text-muted">{{ $user->last_message ?? 'No messages yet' }}</small>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chat Window -->
        <div class="col-md-8 d-flex flex-column bg-light">
            <!-- Header -->
            <div class="p-3 bg-white border-bottom fw-bold" id="chatHeader">
                Select a chat to start messaging
            </div>

            <!-- Messages Area -->
            <div id="chatBox" class="flex-grow-1 overflow-auto p-3" style="height: 65vh;">
                <!-- Messages will appear here -->
            </div>

            <!-- Input Area -->
            <div class="p-3 bg-white border-top">
                <form id="messageForm" class="d-flex">
                    <input type="text" class="form-control me-2" id="messageInput" placeholder="Type your message...">
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function loadChat(userId) {
        document.getElementById('chatHeader').innerText = 'Chat with User #' + userId;
        document.getElementById('chatBox').innerHTML = `
            <div class="text-center text-muted">Loading messages...</div>
        `;
        // TODO: Load messages using AJAX or Livewire
    }

    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const input = document.getElementById('messageInput');
        const message = input.value.trim();
        if (!message) return;

        const box = document.getElementById('chatBox');
        box.innerHTML += `
            <div class="d-flex justify-content-end mb-2">
                <div class="bg-primary text-white p-2 rounded">${message}</div>
            </div>
        `;
        input.value = '';
        box.scrollTop = box.scrollHeight;

        // TODO: Send message to backend
    });
</script>
@endsection
@push('script')
    <script type="text/javascript"></script>
@endpush

@php
$chatMe = auth()->user();

$chatConfig = [
'csrf' => csrf_token(),
'me' => [
'id' => $chatMe->id,
'name' => \App\Support\ChatState::displayName($chatMe),
'member_id' => $chatMe->member_id,
'avatar' => $chatMe->avatar_img,
'color' => \App\Support\ChatState::color($chatMe->state_id),
],
// Relative avatar paths are resolved against this base URL
'avatarBase' => rtrim(asset(''), '/'),
'routes' => [
'members' => route('chat.members'),
'conversations' => route('chat.index'),
'messages' => route('chat.messages', ['conversation' => '__ID__']),
'read' => route('chat.read', ['conversation' => '__ID__']),
'typing' => route('chat.typing', ['conversation' => '__ID__']),
'message' => route('chat.message.update', ['message' => '__ID__']),
],
// state id => abbreviation (ACT, NSW...)
'states' => collect(config('escorts.profile.states', []))
->map(fn ($s) => $s['stateAbbr'] ?? '')
->all(),
// users.type => label shown as "Type:" in the header
'typeLabels' => config('chat.type_labels', []),
// Types that cannot be blocked (Agent)
'unblockable' => config('chat.unblockable', []),
// Massage Centre: a blocked person leaves the list right away
'hideBlockedChats' => in_array((int) $chatMe->type, config('chat.hide_blocked_for', []), true),
];

$chatAssetVersion = @filemtime(public_path('chat-build/js/chat.js')) ?: time();
@endphp

<div class="chat-app" id="chatApp" data-config="{{ json_encode($chatConfig) }}">

    <!-- LEFT SIDEBAR -->
    <aside class="chat_sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="title-row">
                <h1>Chats</h1>

                <div class="location-selector">

                    <label class="location-option">
                        <input type="radio" name="location" value="your-location" checked>
                        <span class="radio-custom"></span>
                        <span>Your Location</span>
                    </label>

                    <label class="location-option">
                        <input type="radio" name="location" value="australia">
                        <span class="radio-custom"></span>
                        <span>Australia</span>
                    </label>

                </div>

                <div class="sidebar-actions">

                    <button class="new-chat-btn" id="newChatBtn">
                        <i class="bi bi-plus-lg"></i>
                        New
                    </button>

                    <div class="filter-wrapper">

                        <button id="filterBtn" type="button">
                            <i class="bi bi-funnel"></i>
                            Filter
                        </button>

                        <div class="filter-dropdown more-dropdown" id="filterDropdown">
                            <button type="button" class="filter-option active" data-filter="chats">
                                <i class="bi bi-person-check"></i> {{ [4 => 'Active Viewers', 5 => 'Active Advertisers'][(int) auth()->user()->type] ?? 'Active Users' }}
                            </button>
                            <button type="button" class="filter-option" data-filter="archived">
                                <i class="bi bi-archive"></i> Archived Chats
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Search User by Member ID or Name...">
            </div>

        </div>

        <!-- CHAT LIST (rendered by chat.js) -->
        <div class="chat-list" id="chatList"></div>

    </aside>


    <!-- MAIN CHAT -->
    <main class="chat-area">

        <!-- CHAT HEADER -->
        <header class="chat-header">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="header-avatar avatar" id="chatHeaderAvatar"></div>

            <div class="header-user">

                <h2 id="chatUserName">Select a chat</h2>

                <div class="active-status" id="chatStatus"></div>

                <div class="user-meta" id="chatUserMeta"></div>

            </div>

            <div class="header-actions">

                <!-- SEARCH -->
                <button id="chatSearchBtn" title="Search messages">
                    <i class="bi bi-search"></i>
                </button>

                <!-- THREE DOTS -->
                <div class="more-wrapper">

                    <button id="chatMoreBtn" title="More">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>

                    <div class="more-dropdown" id="moreDropdown">

                        <button id="contactInfoBtn">
                            <i class="bi bi-person-vcard"></i>
                            Contact Info
                        </button>

                        <button id="clearChatBtn">
                            <i class="bi bi-trash3"></i>
                            Clear Chat
                        </button>

                        <div class="dropdown-divider"></div>

                        <button id="blockUserBtn" class="danger-option">
                            <i class="bi bi-slash-circle"></i>
                            Block User
                        </button>

                    </div>

                </div>

            </div>

        </header>

        <!-- CHAT SEARCH AREA -->
        <div class="chat-search-area" id="chatSearchArea">

            <div class="chat-search-inner">

                <i class="bi bi-search"></i>

                <input type="text" id="messageSearchInput" placeholder="Search messages in this chat..." autocomplete="off">

                <button id="closeMessageSearch" title="Close search">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <div class="search-result-count" id="searchResultCount">
                Search messages
            </div>

        </div>

        <!-- MESSAGES (rendered by chat.js) -->
        <section class="messages" id="messages"></section>

        <!-- MESSAGE COMPOSER -->
        <footer class="message-composer">

            <button class="composer-btn" id="attachmentBtn" title="Attach">
                <i class="bi bi-paperclip"></i>
            </button>

            <button class="composer-btn" id="emojiBtn" title="Emoji">
                <i class="bi bi-emoji-smile"></i>
            </button>

            <div id="emojiPicker" class="emoji-picker-container"></div>

            <div class="input-wrapper">
                <input
                    type="text"
                    id="messageInput"
                    placeholder="Type a message..."
                    autocomplete="off">
            </div>

            <button class="send-btn" id="sendBtn" title="Send">
                <i class="bi bi-send-fill"></i>
            </button>

            <input type="file" id="fileInput" hidden>

        </footer>

    </main>

</div>

<!-- ADD MEMBER MODAL -->
<div class="modal-overlay" id="addMemberModal">

    <div class="add-member-modal">

        <div class="modal-header">

            <div>
                <span class="modal-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </span>

                <div class="modal-title-content">
                    <h3>Add Member</h3>
                    <p>Member is: {{ auth()->user()->name
                        ? auth()->user()->name . ' (' . auth()->user()->member_id . ')'
                        : auth()->user()->member_id }}</p>
                </div>
            </div>

            <button class="modal-close" id="closeMemberModal">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>

        <div class="member-search">
            <i class="bi bi-search"></i>
            <input type="text" id="memberSearchInput" placeholder="Search by Member ID or Name...">
        </div>

        <!-- MEMBER RESULTS (rendered by chat.js) -->
        <div class="member-results" id="memberResults"></div>

        <div class="modal-footer">
            <button class="cancel-btn" id="cancelMemberModal">
                Cancel
            </button>
        </div>

    </div>

</div>

<!-- MOBILE OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script src="{{ asset('chat-build/js/chat.js') }}?v={{ $chatAssetVersion }}"></script>
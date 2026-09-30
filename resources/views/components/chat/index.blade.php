<div class="chat-app">

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
                    <!-- <button id="filterBtn">
                        <svg width="12px" height="15px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#0c223d">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>filter_line</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Business" transform="translate(-720.000000, 0.000000)">
                                        <g id="filter_line" transform="translate(720.000000, 0.000000)">
                                            <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path>
                                            <path d="M3,4.5 C3,3.67157 3.67157,3 4.5,3 L19.5,3 C20.3284,3 21,3.67157 21,4.5 L21,6.58579 C21,7.11622 20.7893,7.62493 20.4142,8 L15,13.4142 L15,20.8382 C15,21.6559 14.1395,22.1878 13.4081,21.8221 L9.69098,19.9635 C9.2675,19.7518 9,19.319 9,18.8455 L9,13.4142 L3.58579,8 C3.21071,7.62493 3,7.11622 3,6.58579 L3,4.5 Z M5,5 L5,6.58579 L10.5607,12.1464 C10.842,12.4278 11,12.8093 11,13.2071 L11,18.382 L13,19.382 L13,13.2071 C13,12.8093 13.158,12.4278 13.4393,12.1464 L19,6.58579 L19,5 L5,5 Z" fill="#0c223d"> </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        Filter
                    </button> -->
                </div>

            </div>
            <div class="search-box">
                <i class="bi bi-search"></i>

                <input type="text" id="searchInput" placeholder="Search User by Member ID or Name...">
            </div>

        </div>

        <!-- CHAT LIST -->
        <div class="chat-list" id="chatList">

            <!-- 1. Jasmine Thompson -->
            <div class="chat-user active"
                data-name="Jasmine Thompson"
                data-member="A20352"
                data-location="NSW">

                <div class="avatar avatar-light">
                    <img src="{{ asset('assets/dashboard/img/avatar/1.jpg') }}" alt="avatar">
                </div>

                <div class="user-info">

                    <div class="user-top">
                        <span class="user-type">A20352</span>
                    </div>

                    <div class="user-name">
                        Jasmine Thompson
                        <span class="status-dot"></span>
                    </div>

                    <div class="user-top">
                        <span class="user-type">
                            Yes, I am working on it. Will share soon...
                        </span>

                        <span class="user-time">
                            10:24 AM
                        </span>
                    </div>
                   
                    <div class="more-info-wrapper">

                        <button type="button" class="chatInfoBtn" aria-label="More options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <div class="more-info-dropdown">

                            <button type="button" class="contactInfoBtn">
                                <i class="bi bi-check-circle"></i>
                                Mark as Read
                            </button>

                            <button type="button" class="viewProfileBtn">
                                <i class="bi bi-person"></i>
                                View Profile
                            </button>

                            <div class="dropdown-divider"></div>

                            <button
                                type="button"
                                class="deleteUserBtn danger-option"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete User
                            </button>

                        </div>

                    </div>
                   
                </div>

                <span class="unread-count">2</span>
                
               
                    
            </div>


            <!-- 2. John Smith -->
            <div class="chat-user"
                data-name="John Smith"
                data-member="A20411"
                data-location="NSW">

                <div class="avatar image-placeholder">
                    <img src="{{ asset('assets/dashboard/img/avatar/2.jpg') }}" alt="avatar">
                </div>

                <div class="user-info">

                    <div class="user-top">
                        <span class="user-type">A20411</span>
                    </div>

                    <div class="user-name">
                        John Smith
                        <span class="status-dot offline"></span>
                    </div>

                    <div class="user-top">
                        <span class="user-type">
                            Hi
                        </span>

                        <span class="user-time">
                            09:30 AM
                        </span>
                    </div>
                    
                   <div class="more-info-wrapper">

                        <button type="button" class="chatInfoBtn" aria-label="More options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <div class="more-info-dropdown">

                            <button type="button" class="contactInfoBtn">
                                <i class="bi bi-check-circle"></i>
                                Mark as Read
                            </button>

                            <button type="button" class="viewProfileBtn">
                                <i class="bi bi-person"></i>
                                View Profile
                            </button>

                            <div class="dropdown-divider"></div>

                            <button
                                type="button"
                                class="deleteUserBtn danger-option"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete User
                            </button>

                        </div>

                    </div>

                </div>

                <span class="unread-count">1</span>

            </div>


            <!-- 3. Emily Wilson -->
            <div class="chat-user"
                data-name="Emily Wilson"
                data-member="A20567"
                data-location="NSW">

                <div class="avatar avatar-light">
                    <img src="{{ asset('assets/dashboard/img/avatar/3.jpg') }}" alt="avatar">
                </div>

                <div class="user-info">

                    <div class="user-top">
                        <span class="user-type">A20567</span>
                    </div>

                    <div class="user-name">
                        Emily Wilson
                        <span class="status-dot"></span>
                    </div>

                    <div class="user-top">
                        <span class="user-type">
                            Thanks for the update. I will check and confirm.
                        </span>

                        <span class="user-time">
                            Yesterday
                        </span>
                    </div>
                    
                    
                   <div class="more-info-wrapper">

                        <button type="button" class="chatInfoBtn" aria-label="More options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <div class="more-info-dropdown">

                            <button type="button" class="contactInfoBtn">
                                <i class="bi bi-check-circle"></i>
                                Mark as Read
                            </button>

                            <button type="button" class="viewProfileBtn">
                                <i class="bi bi-person"></i>
                                View Profile
                            </button>

                            <div class="dropdown-divider"></div>

                            <button
                                type="button"
                                class="deleteUserBtn danger-option"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete User
                            </button>

                        </div>

                    </div>
                </div>

                <span class="unread-count">3</span>

            </div>


            <!-- 4. David Miller -->
            <div class="chat-user"
                data-name="David Miller"
                data-member="A20678"
                data-location="NSW">

                <div class="avatar avatar-light">
                    <img src="{{ asset('assets/dashboard/img/avatar/4.jpg') }}" alt="avatar">
                </div>

                <div class="user-info">

                    <div class="user-top">
                        <span class="user-type">A20678</span>
                    </div>

                    <div class="user-name">
                        David Miller
                        <span class="status-dot"></span>
                    </div>

                    <div class="user-top">
                        <span class="user-type">
                            The documents have been uploaded successfully.
                        </span>

                        <span class="user-time">
                            Yesterday
                        </span>
                    </div>
                    
                    
                   <div class="more-info-wrapper">

                        <button type="button" class="chatInfoBtn" aria-label="More options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <div class="more-info-dropdown">

                            <button type="button" class="contactInfoBtn">
                                <i class="bi bi-check-circle"></i>
                                Mark as Read
                            </button>

                            <button type="button" class="viewProfileBtn">
                                <i class="bi bi-person"></i>
                                View Profile
                            </button>

                            <div class="dropdown-divider"></div>

                            <button
                                type="button"
                                class="deleteUserBtn danger-option"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete User
                            </button>

                        </div>

                    </div>
                </div>

                <span class="unread-count">1</span>

            </div>


            <!-- 5. Sophia Garcia -->
            <div class="chat-user"
                data-name="Sophia Garcia"
                data-member="A20789"
                data-location="NSW">

                <div class="avatar avatar-light">
                    <img src="{{ asset('assets/dashboard/img/avatar/5.jpg') }}" alt="avatar">
                </div>

                <div class="user-info">

                    <div class="user-top">
                        <span class="user-type">A20789</span>
                    </div>

                    <div class="user-name">
                        Sophia Garcia
                        <span class="status-dot offline"></span>
                    </div>

                    <div class="user-top">
                        <span class="user-type">
                            Can we discuss this request tomorrow?
                        </span>

                        <span class="user-time">
                            24 Sep
                        </span>
                    </div>
                    
                    
                   <div class="more-info-wrapper">

                        <button type="button" class="chatInfoBtn" aria-label="More options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <div class="more-info-dropdown">

                            <button type="button" class="contactInfoBtn">
                                <i class="bi bi-check-circle"></i>
                                Mark as Read
                            </button>

                            <button type="button" class="viewProfileBtn">
                                <i class="bi bi-person"></i>
                                View Profile
                            </button>

                            <div class="dropdown-divider"></div>

                            <button
                                type="button"
                                class="deleteUserBtn danger-option"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete User
                            </button>

                        </div>

                    </div>
                </div>

                <span class="unread-count">2</span>

            </div>


            <!-- 6. Daniel Martinez -->
            <div class="chat-user"
                data-name="Daniel Martinez"
                data-member="A20890"
                data-location="NSW">

                <div class="avatar avatar-light">
                    <img src="{{ asset('assets/dashboard/img/avatar/6.jpg') }}" alt="avatar">
                </div>

                <div class="user-info">

                    <div class="user-top">
                        <span class="user-type">A20890</span>
                    </div>

                    <div class="user-name">
                        Daniel Martinez
                        <span class="status-dot"></span>
                    </div>

                    <div class="user-top">
                        <span class="user-type">
                            I have received your message. Thank you.
                        </span>

                        <span class="user-time">
                            23 Sep
                        </span>
                    </div>
                    
                    
                   <div class="more-info-wrapper">

                        <button type="button" class="chatInfoBtn" aria-label="More options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>

                        <div class="more-info-dropdown">

                            <button type="button" class="contactInfoBtn">
                                <i class="bi bi-check-circle"></i>
                                Mark as Read
                            </button>

                            <button type="button" class="viewProfileBtn">
                                <i class="bi bi-person"></i>
                                View Profile
                            </button>

                            <div class="dropdown-divider"></div>

                            <button
                                type="button"
                                class="deleteUserBtn danger-option"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete User
                            </button>

                        </div>

                    </div>
                </div>

                <span class="unread-count">1</span>

            </div>

        </div>


    </aside>


    <!--  MAIN CHAT -->
    <main class="chat-area">

        <!-- CHAT HEADER -->
        <header class="chat-header">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="header-avatar avatar">
                <img src="{{ asset('assets/dashboard/img/avatar/1.jpg') }}" alt="avatar">
            </div>

            <div class="header-user">

                <h2 id="chatUserName">
                    Jasmine Thompson
                </h2>

                <div class="active-status">
                    <span class="status-dot"></span> Active
                </div>

                <div class="user-meta">
                    Type: Agent
                    <span>|</span> Location: NSW
                </div>

            </div>


            <div class="header-actions">

                <!-- SEARCH -->
                <button id="chatSearchBtn" title="Search messages">
                    <i class="bi bi-search"></i>
                </button>


                <!-- VIDEO -->
                <button id="videoCallBtn" title="Video Call">
                    <i class="bi bi-camera-video-fill"></i>
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
        <!-- 
             MESSAGES
        = -->
        <section class="messages" id="messages">

            <div class="date-divider">
                <span>Today</span>
            </div>


            <!-- RECEIVED -->
            <div class="message-row received">

                <div class="message-avatar">
                    JT
                </div>

                <div class="message-wrapper">

                    <div class="message-bubble">
                        Hi
                    </div>

                    <div class="message-time">
                        10:15 AM
                    </div>

                </div>

            </div>


            <!-- SENT -->
            <div class="message-row sent">

                <div class="message-wrapper">

                    <div class="message-bubble">
                        Hellow
                    </div>

                    <div class="message-time">
                        10:16 AM
                        <i class="bi bi-check2-all"></i>
                    </div>

                </div>

                <div class="message-avatar">
                    JS
                </div>

            </div>


            <!-- RECEIVED -->
            <div class="message-row received">

                <div class="message-avatar">
                    JT
                </div>

                <div class="message-wrapper">

                    <div class="message-bubble">
                        How are you..?
                    </div>

                    <div class="message-time">
                        10:17 AM
                    </div>

                </div>

            </div>


            <!-- SENT -->
            <div class="message-row sent">

                <div class="message-wrapper">

                    <div class="message-bubble">
                        I am fine what about you..?
                    </div>

                    <div class="message-time">
                        10:24 AM
                        <i class="bi bi-check2-all"></i>
                    </div>

                </div>

                <div class="message-avatar">
                    JS
                </div>

            </div>


            <!-- RECEIVED -->
            <div class="message-row received">

                <div class="message-avatar">
                    JT
                </div>

                <div class="message-wrapper">

                    <div class="message-bubble">
                        That's good to hear!<br> Do you have any update on the previous request?
                    </div>

                    <div class="message-time">
                        10:34 AM
                    </div>

                </div>

            </div>


            <!-- SENT -->
            <div class="message-row sent">

                <div class="message-wrapper">

                    <div class="message-bubble">
                        Yes, I am working on it. Will share soon.
                    </div>

                    <div class="message-time">
                        10:36 AM
                        <i class="bi bi-check2-all"></i>
                    </div>

                </div>

                <div class="message-avatar">
                    JS
                </div>

            </div>

        </section>


        <!-- 
             MESSAGE COMPOSER
        = -->
        <footer class="message-composer">

            <button class="composer-btn" id="attachmentBtn" title="Attach">
                <i class="bi bi-paperclip"></i>
            </button>

            <button class="composer-btn" id="emojiBtn" title="Emoji">
                <i class="bi bi-emoji-smile"></i>
            </button>

            <div class="input-wrapper">

                <input type="text" id="messageInput" placeholder="Type a message..." autocomplete="off">

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
                    <p>Add a member to your chats</p>
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


        <!-- MEMBER RESULTS -->

        <div class="member-results" id="memberResults">

            <div class="member-result" data-member-id="A20411" data-member-name="John Smith" data-location="NSW">

                <div class="member-avatar">
                    JS
                </div>

                <div class="member-info">

                    <strong>
                        John Smith
                    </strong>

                    <span>
                        A20411 · NSW
                    </span>

                </div>

                <span class="member-status offline">
                    Offline
                </span>

                <button class="add-member-action">
                    <i class="bi bi-plus-lg"></i>
                </button>

            </div>


            <div class="member-result" data-member-id="A20567" data-member-name="Emily Wilson" data-location="NSW">

                <div class="member-avatar">
                    EW
                </div>

                <div class="member-info">

                    <strong>
                        Emily Wilson
                    </strong>

                    <span>
                        A20567 · NSW
                    </span>

                </div>

                <span class="member-status">
                    Active
                </span>

                <button class="add-member-action">
                    <i class="bi bi-plus-lg"></i>
                </button>

            </div>


            <div class="member-result" data-member-id="A20678" data-member-name="David Miller" data-location="NSW">

                <div class="member-avatar">
                    DM
                </div>

                <div class="member-info">

                    <strong>
                        David Miller
                    </strong>

                    <span>
                        A20678 · NSW
                    </span>

                </div>

                <span class="member-status">
                    Active
                </span>

                <button class="add-member-action">
                    <i class="bi bi-plus-lg"></i>
                </button>

            </div>


            <div class="member-result" data-member-id="A20789" data-member-name="Sophia Garcia" data-location="NSW">

                <div class="member-avatar">
                    SG
                </div>

                <div class="member-info">

                    <strong>
                        Sophia Garcia
                    </strong>

                    <span>
                        A20789 · NSW
                    </span>

                </div>

                <span class="member-status offline">
                    Offline
                </span>

                <button class="add-member-action">
                    <i class="bi bi-plus-lg"></i>
                </button>

            </div>

        </div>


        <div class="modal-footer">

            <button class="cancel-btn" id="cancelMemberModal">
                Cancel
            </button>

        </div>

    </div>

</div>
<!-- MOBILE OVERLAY -->

<div class="sidebar-overlay" id="sidebarOverlay"></div>
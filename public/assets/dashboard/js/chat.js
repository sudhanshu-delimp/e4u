document.addEventListener("DOMContentLoaded", function() {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const searchInput =
        document.getElementById("searchInput");

    const chatList =
        document.getElementById("chatList");

    const messageInput =
        document.getElementById("messageInput");

    const sendBtn =
        document.getElementById("sendBtn");

    const messages =
        document.getElementById("messages");

    const attachmentBtn =
        document.getElementById("attachmentBtn");

    const emojiBtn =
        document.getElementById("emojiBtn");

    const fileInput =
        document.getElementById("fileInput");

    const sidebar =
        document.getElementById("sidebar");

    const mobileMenu =
        document.getElementById("mobileMenu");

    const sidebarOverlay =
        document.getElementById("sidebarOverlay");

    const chatUserName =
        document.getElementById("chatUserName");


    /* =====================================================
       CHAT USERS
    ===================================================== */

    function getChatUsers() {

        return document.querySelectorAll(
            ".chat-user"
        );

    }


    /* =====================================================
       CHAT SELECTION
    ===================================================== */

    function bindChatUsers() {

        const chatUsers =
            getChatUsers();


        chatUsers.forEach(function(user) {

            /*
             * Avoid duplicate event listener
             */

            if (user.dataset.chatBound === "true") {
                return;
            }

            user.dataset.chatBound = "true";


            user.addEventListener(
                "click",
                function() {

                    const allUsers =
                        getChatUsers();


                    allUsers.forEach(
                        function(item) {

                            item.classList.remove(
                                "active"
                            );

                        }
                    );


                    this.classList.add(
                        "active"
                    );


                    const name =
                        this.dataset.name || "";


                    /*
                     * Update chat header
                     */

                    if (chatUserName) {

                        chatUserName.textContent =
                            name;

                    }


                    /*
                     * Mobile sidebar close
                     */

                    if (
                        window.innerWidth <= 800
                    ) {

                        closeSidebar();

                    }

                }
            );

        });

    }


    bindChatUsers();


    /* =====================================================
       SEARCH USERS
    ===================================================== */

    if (searchInput) {

        searchInput.addEventListener(
            "input",
            function() {

                const searchValue =
                    this.value
                    .toLowerCase()
                    .trim();


                const chatUsers =
                    getChatUsers();


                chatUsers.forEach(
                    function(user) {

                        const name =
                            (
                                user.dataset.name ||
                                ""
                            ).toLowerCase();


                        const member =
                            (
                                user.dataset.member ||
                                ""
                            ).toLowerCase();


                        const location =
                            (
                                user.dataset.location ||
                                ""
                            ).toLowerCase();


                        if (
                            name.includes(
                                searchValue
                            ) ||

                            member.includes(
                                searchValue
                            ) ||

                            location.includes(
                                searchValue
                            )
                        ) {

                            user.style.display =
                                "flex";

                        } else {

                            user.style.display =
                                "none";

                        }

                    }
                );

            }
        );

    }


    /* =====================================================
       SEND MESSAGE
    ===================================================== */

    function sendMessage() {

        /*
         * Safety check
         */

        if (!messageInput || !messages) {
            return;
        }


        const message =
            messageInput.value.trim();


        /*
         * Don't send empty message
         */

        if (!message) {
            return;
        }


        /*
         * Create message row
         */

        const messageRow =
            document.createElement("div");


        messageRow.className =
            "message-row sent";


        /*
         * Current time
         */

        const now =
            new Date();


        const time =
            now.toLocaleTimeString(
                [], {
                    hour: "2-digit",
                    minute: "2-digit"
                }
            );


        messageRow.innerHTML = `

            <div class="message-wrapper">

                <div class="message-bubble">
                    ${escapeHtml(message)}
                </div>

                <div class="message-time">

                    ${time}

                    <i class="bi bi-check2"></i>

                </div>

            </div>

            <div class="message-avatar">
                JS
            </div>

        `;


        messages.appendChild(
            messageRow
        );


        /*
         * Clear input
         */

        messageInput.value = "";


        /*
         * Scroll bottom
         */

        scrollToBottom();


        /*
         * Demo:
         * Single check -> double check
         */

        setTimeout(
            function() {

                const checkIcon =
                    messageRow.querySelector(
                        ".message-time i"
                    );


                if (checkIcon) {

                    checkIcon.className =
                        "bi bi-check2-all";

                }

            },
            700
        );

    }


    /* =====================================================
       SEND BUTTON
    ===================================================== */

    if (sendBtn) {

        sendBtn.addEventListener(
            "click",
            sendMessage
        );

    }


    /* =====================================================
       ENTER TO SEND
    ===================================================== */

    if (messageInput) {

        messageInput.addEventListener(
            "keydown",
            function(event) {

                /*
                 * Enter = Send
                 *
                 * Shift + Enter = New Line
                 */

                if (
                    event.key === "Enter" &&
                    !event.shiftKey
                ) {

                    event.preventDefault();

                    sendMessage();

                }

            }
        );

    }


    /* =====================================================
       EMOJI
    ===================================================== */

    if (emojiBtn) {

        emojiBtn.addEventListener(
            "click",
            function() {

                if (!messageInput) {
                    return;
                }


                const emoji =
                    " 😊";


                messageInput.value +=
                    emoji;


                messageInput.focus();

            }
        );

    }


    /* =====================================================
       ATTACHMENT / FILE UPLOAD
    ===================================================== */

    if (
        attachmentBtn &&
        fileInput
    ) {

        attachmentBtn.addEventListener(
            "click",
            function() {

                fileInput.click();

            }
        );


        /*
         * File selected
         */

        fileInput.addEventListener(
            "change",
            function() {

                if (!this.files ||
                    !this.files.length
                ) {

                    return;

                }


                const file =
                    this.files[0];


                console.log(
                    "Selected file:",
                    file.name
                );


                /*
                 * Existing behavior
                 */

                if (messageInput) {

                    messageInput.value =
                        "📎 " + file.name;


                    messageInput.focus();

                }

            }
        );

    }


    /* =====================================================
       MOBILE SIDEBAR
    ===================================================== */

    if (mobileMenu) {

        mobileMenu.addEventListener(
            "click",
            function() {

                openSidebar();

            }
        );

    }


    if (sidebarOverlay) {

        sidebarOverlay.addEventListener(
            "click",
            function() {

                closeSidebar();

            }
        );

    }


    function openSidebar() {

        if (sidebar) {

            sidebar.classList.add(
                "open"
            );

        }


        if (sidebarOverlay) {

            sidebarOverlay.classList.add(
                "show"
            );

        }

    }


    function closeSidebar() {

        if (sidebar) {

            sidebar.classList.remove(
                "open"
            );

        }


        if (sidebarOverlay) {

            sidebarOverlay.classList.remove(
                "show"
            );

        }

    }


    /* =====================================================
       NEW CHAT / ADD MEMBER
    ===================================================== */

    const newChatBtn =
        document.getElementById(
            "newChatBtn"
        );

    const newChatText =
        document.getElementById(
            "newChatText"
        );


    /*
     * Add Member Modal
     */

    const addMemberModal =
        document.getElementById(
            "addMemberModal"
        );

    const closeMemberModal =
        document.getElementById(
            "closeMemberModal"
        );

    const cancelMemberModal =
        document.getElementById(
            "cancelMemberModal"
        );


    function openMemberModal() {

        /*
         * If modal exists,
         * open modal
         */

        if (addMemberModal) {

            addMemberModal.classList.add(
                "show"
            );


            const memberSearchInput =
                document.getElementById(
                    "memberSearchInput"
                );


            if (memberSearchInput) {

                memberSearchInput.value =
                    "";


                setTimeout(
                    function() {

                        memberSearchInput.focus();

                    },
                    100
                );

            }


            return;

        }


        /*
         * If new modal HTML
         * doesn't exist yet,
         * don't break old system.
         */

        console.log(
            "Add Member modal not found."
        );

    }


    function newChat() {

        /*
         * New Add Member modal exists
         */

        if (addMemberModal) {

            openMemberModal();

            return;

        }


        /*
         * Old behavior fallback
         */

        console.log(
            "New chat clicked"
        );

    }


    /*
     * New Chat button
     */

    if (newChatBtn) {

        newChatBtn.addEventListener(
            "click",
            newChat
        );

    }


    /*
     * New text
     */

    if (newChatText) {

        newChatText.addEventListener(
            "click",
            newChat
        );

    }


    /* =====================================================
       CLOSE MEMBER MODAL
    ===================================================== */

    function closeMemberModalFunc() {

        if (!addMemberModal) {
            return;
        }


        addMemberModal.classList.remove(
            "show"
        );

    }


    if (closeMemberModal) {

        closeMemberModal.addEventListener(
            "click",
            closeMemberModalFunc
        );

    }


    if (cancelMemberModal) {

        cancelMemberModal.addEventListener(
            "click",
            closeMemberModalFunc
        );

    }


    /*
     * Click outside modal
     */

    if (addMemberModal) {

        addMemberModal.addEventListener(
            "click",
            function(event) {

                if (
                    event.target ===
                    addMemberModal
                ) {

                    closeMemberModalFunc();

                }

            }
        );

    }


    /* =====================================================
       FILTER DROPDOWN
    ===================================================== */

    const filterBtn =
        document.getElementById(
            "filterBtn"
        );


    const filterWrapper =
        document.querySelector(
            ".filter-wrapper"
        );


    const filterDropdown =
        document.getElementById(
            "filterDropdown"
        );


    /*
     * Filter button
     */

    if (
        filterBtn &&
        filterWrapper
    ) {

        filterBtn.addEventListener(
            "click",
            function(event) {

                event.stopPropagation();


                filterWrapper.classList.toggle(
                    "open"
                );


                /*
                 * Close 3 dots
                 */

                closeMoreDropdown();

            }
        );

    }


    /*
     * Filter options
     */

    document
        .querySelectorAll(
            ".filter-option"
        )
        .forEach(
            function(option) {

                option.addEventListener(
                    "click",
                    function(event) {

                        event.stopPropagation();


                        /*
                         * Remove active
                         */

                        document
                            .querySelectorAll(
                                ".filter-option"
                            )
                            .forEach(
                                function(item) {

                                    item.classList.remove(
                                        "active"
                                    );

                                }
                            );


                        /*
                         * Current active
                         */

                        this.classList.add(
                            "active"
                        );


                        /*
                         * Get filter
                         */

                        const filter =
                            this.dataset.filter ||
                            "all";


                        filterChats(
                            filter
                        );


                        /*
                         * Close dropdown
                         */

                        if (
                            filterWrapper
                        ) {

                            filterWrapper.classList.remove(
                                "open"
                            );

                        }

                    }
                );

            }
        );


    function filterChats(filter) {

        const chatUsers =
            getChatUsers();


        chatUsers.forEach(
            function(user) {

                let show =
                    true;


                /*
                 * All
                 */

                if (
                    filter === "all"
                ) {

                    show = true;

                }


                /*
                 * Unread
                 */
                else if (
                    filter === "unread"
                ) {

                    show = !!user.querySelector(
                        ".unread-count"
                    );

                }


                /*
                 * Active
                 */
                else if (
                    filter === "active"
                ) {

                    const status =
                        user.querySelector(
                            ".status-dot"
                        );


                    /*
                     * If status exists,
                     * use it.
                     *
                     * Otherwise keep visible.
                     */

                    if (status) {

                        show = !status.classList.contains(
                            "offline"
                        );

                    } else {

                        show = true;

                    }

                }


                /*
                 * Offline
                 */
                else if (
                    filter === "offline"
                ) {

                    const status =
                        user.querySelector(
                            ".status-dot"
                        );


                    if (status) {

                        show =
                            status.classList.contains(
                                "offline"
                            );

                    } else {

                        show = false;

                    }

                }


                /*
                 * Agent
                 */
                else if (
                    filter === "agent"
                ) {

                    /*
                     * Your current users
                     * have Type: Agent.
                     */

                    const type =
                        user.querySelector(
                            ".user-type"
                        );


                    if (type) {

                        show =
                            type.textContent
                            .toLowerCase()
                            .includes(
                                "agent"
                            );

                    } else {

                        show = true;

                    }

                }


                user.style.display =
                    show ?
                    "flex" :
                    "none";

            }
        );

    }


    /* =====================================================
       HEADER MESSAGE SEARCH
    ===================================================== */

    const chatSearchBtn =
        document.getElementById(
            "chatSearchBtn"
        );


    const chatSearchArea =
        document.getElementById(
            "chatSearchArea"
        );


    const messageSearchInput =
        document.getElementById(
            "messageSearchInput"
        );


    const closeMessageSearch =
        document.getElementById(
            "closeMessageSearch"
        );


    const searchResultCount =
        document.getElementById(
            "searchResultCount"
        );


    /*
     * Open search
     */

    if (
        chatSearchBtn &&
        chatSearchArea
    ) {

        chatSearchBtn.addEventListener(
            "click",
            function() {

                chatSearchArea.classList.add(
                    "show"
                );


                if (messageSearchInput) {

                    messageSearchInput.focus();

                }


                closeMoreDropdown();

            }
        );

    }


    /*
     * Close search
     */

    if (closeMessageSearch) {

        closeMessageSearch.addEventListener(
            "click",
            function() {

                if (chatSearchArea) {

                    chatSearchArea.classList.remove(
                        "show"
                    );

                }


                if (messageSearchInput) {

                    messageSearchInput.value =
                        "";

                }


                clearMessageSearch();

            }
        );

    }


    /*
     * Search messages
     */

    if (messageSearchInput) {

        messageSearchInput.addEventListener(
            "input",
            function() {

                const value =
                    this.value
                    .trim()
                    .toLowerCase();


                clearMessageSearch();


                if (!value) {

                    if (searchResultCount) {

                        searchResultCount.textContent =
                            "Search messages";

                    }

                    return;

                }


                const bubbles =
                    document.querySelectorAll(
                        ".message-bubble"
                    );


                let count = 0;


                bubbles.forEach(
                    function(bubble) {

                        const text =
                            bubble.textContent;


                        if (
                            text
                            .toLowerCase()
                            .includes(value)
                        ) {

                            highlightText(
                                bubble,
                                this.value
                            );

                            count++;

                        }

                    },
                    this
                );


                if (searchResultCount) {

                    searchResultCount.textContent =
                        count +
                        (
                            count === 1 ?
                            " message found" :
                            " messages found"
                        );

                }

            }
        );

    }


    function highlightText(
        element,
        search
    ) {

        if (!element || !search) {
            return;
        }


        const text =
            element.textContent;


        const escaped =
            search.replace(
                /[.*+?^${}()|[\]\\]/g,
                "\\$&"
            );


        const regex =
            new RegExp(
                "(" + escaped + ")",
                "gi"
            );


        element.innerHTML =
            text.replace(
                regex,
                '<span class="search-highlight">$1</span>'
            );

    }


    function clearMessageSearch() {

        const bubbles =
            document.querySelectorAll(
                ".message-bubble"
            );


        bubbles.forEach(
            function(bubble) {

                /*
                 * Remove previous highlight
                 * safely.
                 */

                const highlighted =
                    bubble.querySelectorAll(
                        ".search-highlight"
                    );


                highlighted.forEach(
                    function(span) {

                        span.replaceWith(
                            span.textContent
                        );

                    }
                );

            }
        );

    }


    /* =====================================================
       THREE DOTS
    ===================================================== */

    const chatMoreBtn =
        document.getElementById(
            "chatMoreBtn"
        );


    const moreWrapper =
        document.querySelector(
            ".more-wrapper"
        );


    function closeMoreDropdown() {

        if (moreWrapper) {

            moreWrapper.classList.remove(
                "open"
            );

        }

    }


    if (
        chatMoreBtn &&
        moreWrapper
    ) {

        chatMoreBtn.addEventListener(
            "click",
            function(event) {

                event.stopPropagation();


                moreWrapper.classList.toggle(
                    "open"
                );


                /*
                 * Close filter
                 */

                if (filterWrapper) {

                    filterWrapper.classList.remove(
                        "open"
                    );

                }

            }
        );

    }


    /* =====================================================
       OUTSIDE CLICK
    ===================================================== */

    document.addEventListener(
        "click",
        function() {

            if (filterWrapper) {

                filterWrapper.classList.remove(
                    "open"
                );

            }


            closeMoreDropdown();

        }
    );


    /*
     * Prevent dropdown from closing
     */

    if (filterDropdown) {

        filterDropdown.addEventListener(
            "click",
            function(event) {

                event.stopPropagation();

            }
        );

    }


    if (moreWrapper) {

        const moreDropdown =
            moreWrapper.querySelector(
                ".more-dropdown"
            );


        if (moreDropdown) {

            moreDropdown.addEventListener(
                "click",
                function(event) {

                    event.stopPropagation();

                }
            );

        }

    }
    
    /* =========================================
   CHAT LIST MORE INFO DROPDOWN
========================================= */

function bindMoreInfoDropdowns() {

    const chatUsers = document.querySelectorAll(".chat-user");

    chatUsers.forEach(function (chatUser) {

        const wrapper =
            chatUser.querySelector(".more-info-wrapper");

        const infoBtn =
            chatUser.querySelector(".chatInfoBtn");

        const dropdown =
            chatUser.querySelector(".more-info-dropdown");

        if (!wrapper || !infoBtn || !dropdown) {
            return;
        }

        /* Prevent duplicate binding */
        if (wrapper.dataset.moreInfoBound === "true") {
            return;
        }

        wrapper.dataset.moreInfoBound = "true";


        /* =========================================
           THREE DOT CLICK
        ========================================= */

        infoBtn.addEventListener("click", function (event) {

            event.preventDefault();
            event.stopPropagation();

            /* Close all other dropdowns */
            document
                .querySelectorAll(".more-info-wrapper.open")
                .forEach(function (otherWrapper) {

                    if (otherWrapper !== wrapper) {
                        otherWrapper.classList.remove("open");
                    }

                });

            /* Open current dropdown */
            wrapper.classList.toggle("open");

        });


        /* =========================================
           DROPDOWN CLICK
        ========================================= */

        dropdown.addEventListener("click", function (event) {

            event.stopPropagation();

        });


        /* =========================================
           MARK AS READ
        ========================================= */

        const markReadBtn =
            dropdown.querySelector(".contactInfoBtn");

        if (markReadBtn) {

            markReadBtn.addEventListener("click", function (event) {

                event.stopPropagation();

                const unreadCount =
                    chatUser.querySelector(".unread-count");

                if (unreadCount) {
                    unreadCount.remove();
                }

                wrapper.classList.remove("open");

                console.log(
                    "Marked as read:",
                    chatUser.dataset.name
                );

            });

        }


        /* =========================================
           VIEW PROFILE
        ========================================= */

        const viewProfileBtn =
            dropdown.querySelector(".viewProfileBtn");

        if (viewProfileBtn) {

            viewProfileBtn.addEventListener("click", function (event) {

                event.stopPropagation();

                wrapper.classList.remove("open");

                console.log(
                    "View profile:",
                    chatUser.dataset.name
                );

            });

        }


        /* =========================================
           DELETE USER
        ========================================= */

        const deleteUserBtn =
            dropdown.querySelector(".deleteUserBtn");

        if (deleteUserBtn) {

            deleteUserBtn.addEventListener("click", function (event) {

                event.stopPropagation();

                const userName =
                    chatUser.dataset.name;

                const confirmed = confirm(
                    `Are you sure you want to delete ${userName}?`
                );

                if (!confirmed) {
                    return;
                }

                wrapper.classList.remove("open");

                /*
                 * Remove from UI
                 * Replace this with AJAX/API
                 * when backend delete is ready.
                 */
                chatUser.remove();

                console.log(
                    "Deleted user:",
                    userName
                );

            });

        }

    });

}


/* =========================================
   CLICK OUTSIDE = CLOSE ALL
========================================= */

document.addEventListener("click", function () {

    document
        .querySelectorAll(".more-info-wrapper.open")
        .forEach(function (wrapper) {

            wrapper.classList.remove("open");

        });

});


/* =========================================
   ESC = CLOSE ALL
========================================= */

document.addEventListener("keydown", function (event) {

    if (event.key === "Escape") {

        document
            .querySelectorAll(".more-info-wrapper.open")
            .forEach(function (wrapper) {

                wrapper.classList.remove("open");

            });

    }

});


/* Bind all current chat users */
bindMoreInfoDropdowns();





    /* =====================================================
       3 DOT ACTIONS
    ===================================================== */

    const contactInfoBtn =
        document.getElementById(
            "contactInfoBtn"
        );


    if (contactInfoBtn) {

        contactInfoBtn.addEventListener(
            "click",
            function() {

                closeMoreDropdown();

                console.log(
                    "Contact info clicked"
                );

            }
        );

    }


    const muteBtn =
        document.getElementById(
            "muteBtn"
        );


    if (muteBtn) {

        muteBtn.addEventListener(
            "click",
            function() {

                closeMoreDropdown();

                console.log(
                    "Mute notifications clicked"
                );

            }
        );

    }


    const clearChatBtn =
        document.getElementById(
            "clearChatBtn"
        );


    if (clearChatBtn) {

        clearChatBtn.addEventListener(
            "click",
            function() {

                closeMoreDropdown();


                const confirmed =
                    confirm(
                        "Are you sure you want to clear this chat?"
                    );


                if (!confirmed) {
                    return;
                }


                if (messages) {

                    messages.innerHTML =
                        "";

                }

            }
        );

    }


    const blockUserBtn =
        document.getElementById(
            "blockUserBtn"
        );


    if (blockUserBtn) {

        blockUserBtn.addEventListener(
            "click",
            function() {

                closeMoreDropdown();

                console.log(
                    "Block user clicked"
                );

            }
        );

    }


    /* =====================================================
       MEMBER SEARCH
    ===================================================== */

    const memberSearchInput =
        document.getElementById(
            "memberSearchInput"
        );


    const memberResults =
        document.getElementById(
            "memberResults"
        );


    if (
        memberSearchInput &&
        memberResults
    ) {

        memberSearchInput.addEventListener(
            "input",
            function() {

                const value =
                    this.value
                    .toLowerCase()
                    .trim();


                const members =
                    memberResults.querySelectorAll(
                        ".member-result"
                    );


                let visibleCount = 0;


                members.forEach(
                    function(member) {

                        const name =
                            (
                                member.dataset
                                .memberName ||
                                ""
                            ).toLowerCase();


                        const memberId =
                            (
                                member.dataset
                                .memberId ||
                                ""
                            ).toLowerCase();


                        const location =
                            (
                                member.dataset
                                .location ||
                                ""
                            ).toLowerCase();


                        const matched =
                            name.includes(
                                value
                            ) ||

                            memberId.includes(
                                value
                            ) ||

                            location.includes(
                                value
                            );


                        member.style.display =
                            matched ?
                            "flex" :
                            "none";


                        if (matched) {

                            visibleCount++;

                        }

                    }
                );


                /*
                 * No result
                 */

                let noResult =
                    memberResults.querySelector(
                        ".no-search-result"
                    );


                if (
                    visibleCount === 0 &&
                    value !== ""
                ) {

                    if (!noResult) {

                        noResult =
                            document.createElement(
                                "div"
                            );


                        noResult.className =
                            "no-search-result";


                        noResult.innerHTML = `
                            <i class="bi bi-person-x"></i>
                            No member found
                        `;


                        memberResults.appendChild(
                            noResult
                        );

                    }

                } else {

                    if (noResult) {

                        noResult.remove();

                    }

                }

            }
        );

    }


    /* =====================================================
       ADD MEMBER BUTTONS
    ===================================================== */

    function bindMemberButtons() {

        document
            .querySelectorAll(
                ".add-member-action"
            )
            .forEach(
                function(button) {

                    /*
                     * Prevent duplicate events
                     */

                    if (
                        button.dataset.memberBound ===
                        "true"
                    ) {

                        return;

                    }


                    button.dataset.memberBound =
                        "true";


                    button.addEventListener(
                        "click",
                        function() {

                            const member =
                                this.closest(
                                    ".member-result"
                                );


                            if (!member) {
                                return;
                            }


                            const memberId =
                                member.dataset.memberId ||
                                "";


                            const memberName =
                                member.dataset.memberName ||
                                "";


                            console.log(
                                "Add member:",
                                memberId,
                                memberName
                            );


                            /*
                             * Button state
                             */

                            this.classList.add(
                                "added"
                            );


                            this.innerHTML =
                                '<i class="bi bi-check-lg"></i>';


                            this.disabled =
                                true;


                            /*
                             * Add to sidebar
                             */

                            addMemberToChatList(
                                member
                            );

                        }
                    );

                }
            );

    }


    bindMemberButtons();


    /* =====================================================
       ADD MEMBER TO CHAT LIST
    ===================================================== */

    function addMemberToChatList(
        member
    ) {

        if (!chatList) {
            return;
        }


        const memberId =
            member.dataset.memberId || "";


        const memberName =
            member.dataset.memberName || "";


        const location =
            member.dataset.location || "";


        /*
         * Check existing
         */

        const existing =
            document.querySelector(
                '.chat-user[data-member="' +
                memberId +
                '"]'
            );


        if (existing) {

            existing.click();

            closeMemberModalFunc();

            return;

        }


        /*
         * Get initials
         */

        const initials =
            memberName
            .split(" ")
            .map(
                function(word) {

                    return word.charAt(0);

                }
            )
            .join("")
            .substring(0, 2)
            .toUpperCase();


        /*
         * Create chat item
         */

        const newChat =
            document.createElement(
                "div"
            );


        newChat.className =
            "chat-user";


        newChat.dataset.name =
            memberName;


        newChat.dataset.member =
            memberId;


        newChat.dataset.location =
            location;


        newChat.innerHTML = `

            <div class="avatar avatar-light">
                ${escapeHtml(initials)}
            </div>

            <div class="user-info">

                <div class="user-top">

                    <span class="user-type">
                        Type:
                        <strong>Agent</strong>
                    </span>

                    <span class="user-time">
                        New
                    </span>

                </div>

                <div class="user-top">

                    <span class="user-type">
                        Location:
                        <strong>
                            ${escapeHtml(location)}
                        </strong>
                    </span>

                </div>

                <div class="user-name">

                    ${escapeHtml(memberName)}

                    <span class="status-dot"></span>

                </div>

            </div>

        `;


        /*
         * Add at top
         */

        chatList.prepend(
            newChat
        );


        /*
         * Bind new chat
         */

        bindChatUsers();


        /*
         * Close modal
         */

        closeMemberModalFunc();


        /*
         * Select new chat
         */

        newChat.click();

    }


    /* =====================================================
       ESCAPE KEY
    ===================================================== */

    document.addEventListener(
        "keydown",
        function(event) {

            if (
                event.key ===
                "Escape"
            ) {

                closeMemberModalFunc();

                closeMoreDropdown();


                if (filterWrapper) {

                    filterWrapper.classList.remove(
                        "open"
                    );

                }


                if (
                    chatSearchArea
                ) {

                    chatSearchArea.classList.remove(
                        "show"
                    );

                }

            }

        }
    );


    /* =====================================================
       SCROLL
    ===================================================== */

    function scrollToBottom() {

        if (!messages) {
            return;
        }


        messages.scrollTo({

            top: messages.scrollHeight,

            behavior: "smooth"

        });

    }


    /* =====================================================
       ESCAPE HTML
    ===================================================== */

    function escapeHtml(text) {

        const div =
            document.createElement(
                "div"
            );


        div.textContent =
            text;


        return div.innerHTML;

    }


    /* =====================================================
       INITIAL SCROLL
    ===================================================== */

    scrollToBottom();

});
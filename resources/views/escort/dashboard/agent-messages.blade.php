@extends('layouts.escort')

@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center">
                <h1 class="p-0">Messages</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 my-2">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                            <li>Use Messages for all of your communications between other Users. Any Viewer you have
                                blocked, or have blocked you, will not appear in your list.</li>
                            <li>Select the User you wish to message, including reply, from the list. If you have appointed
                                an Agent, then they will always appear at the top of the list.</li>
                            <li>You will receive a notification, which will appear in the Alert Centre, when you have
                                received a Message. An indicator will also appear on the User’s Avatar.</li>
                            <li>Please note that all messaging is saved.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="main--chat--wrapper">
                <div class="chat-sidebar">
                    <div class="chat-aside-header">
                        <div class="head-text">
                            <h3 class="head-text-title">Chats</h3>
                        </div>
                        <div class="aside-head-tool">
                            <ul>
                                <li>
                                    <div class="trace-location">
                                        <div class="find-location"><span></span>Your Location</div>
                                        <div class="current-location"><span></span>Australia</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="trace-filter">
                                        <div class="filter-new">
                                            <button type="button" class="btn" data-toggle="modal"
                                                data-target="#filternewModal">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4">
                                                        </path>
                                                    </svg>
                                                </span>
                                                New
                                            </button>
                                        </div>
                                        <div class="filter-fill">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5">
                                                    </path>
                                                </svg>
                                            </span>
                                            Filter
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="searchchat-id">
                            <input type="text" class="form-control form-control-solid" id="search"
                                placeholder="Search contact / chat">
                        </div>
                    </div>

                    <div class="aside-chatcontent">
                        <div class="chat-list">
                            <ul class="custom-chat-list">
                                <li class="chat-person">
                                    <div class="asisde-chat-item">
                                        <div class="chat--thumnil">
                                            <div class="user-image">
                                                <span class="member-image"></span>
                                                <span class="custom-member-id">A20352</span>
                                            </div>
                                        </div>
                                        <div class="member-type">
                                            <div class="membertype-list">
                                                <ul>
                                                    <li>Type: <span>Agent</span></li>
                                                    <li>Location: <span>NSW</span></li>
                                                    <li class="member-name">John Smith <span
                                                            class="mem-notification"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="meber-status">
                                            <div class="member-openmedialist">
                                                <div class="media-option-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="membedr-lastseen">typing</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-person">
                                    <div class="asisde-chat-item">
                                        <div class="chat--thumnil">
                                            <div class="user-image">
                                                <span class="member-image"><img
                                                        src="http://e4u.local/escorts/images/105/e1d28ba21acd94ddb4495ea78.jpg"></span>
                                                <span class="custom-member-id"></span>
                                            </div>
                                        </div>
                                        <div class="member-type">
                                            <div class="membertype-list">
                                                <ul>
                                                    <li>Type: <span>Agent</span></li>
                                                    <li>Location: <span>NSW</span></li>
                                                    <li class="member-name">John Smith <span
                                                            class="mem-notification"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="meber-status">
                                            <div class="member-openmedialist">
                                                <div class="media-option-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="membedr-lastseen">typing</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="chating-pannel">
                    <div class="chatting-panel-header">
                        <div class="header-panel-wrapper">
                            <div class="chating-user">
                                <div class="user-image">
                                    <span class="member-image"></span>
                                    <span class="custom-member-id">A20352</span>
                                </div>
                                <div class="uesr-ifo">
                                    <span class="user-title">Jasmine Thompson</span>
                                    <span class="user-status">Active</span>
                                </div>
                            </div>

                            <div class="user-search-list">
                                <ul>
                                    <li>
                                        <div class="search-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                                </path>
                                            </svg>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="chat--body-caontainer">
                        <div class="chat-conversion">
                            <div class="user-reply">Hi</div>
                            <div class="admin-reply">Hellow</div>
                        </div>
                    </div>

                    <div class="chat-footer">
                        <div class="chat-footer-wrapper">
                            <div class="custom-smile">
                                <ul>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"></path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"></path>
                                        </svg>
                                    </li>
                                </ul>
                            </div>
                            <div class="custom-messgae">
                                <div class="tyn-chat-form-input" id="tynChatInput" contenteditable=""></div>
                            </div>
                            <div class="custom-submit">
                                <ul>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"></path>
                                        </svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="filternewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
@endsection

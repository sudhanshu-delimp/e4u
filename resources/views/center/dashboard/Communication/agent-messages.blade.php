@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
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

                                            <div class="filter--container">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-chat-square-text" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z">
                                                                </path>
                                                                <path
                                                                    d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5">
                                                                </path>
                                                            </svg>
                                                            <span>All Chats</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-person-check" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4">
                                                                </path>
                                                                <path
                                                                    d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z">
                                                                </path>
                                                            </svg>
                                                            <span>Active Contacts</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-archive"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5">
                                                                </path>
                                                            </svg>
                                                            <span>Archived Chats</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-bookmark-x"
                                                                viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708">
                                                                </path>
                                                                <path
                                                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z">
                                                                </path>
                                                            </svg>
                                                            <span>Spam Messages</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-trash"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                                                </path>
                                                                <path
                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                                                </path>
                                                            </svg>
                                                            <span>Trash Bin</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="searchchat-id">
                            <input type="text" class="form-control form-control-solid" id="search"
                                placeholder="Search User by Member ID">
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
                                                <div class="member-openmedia-content">
                                                    <ul class="tyn-list-links">
                                                        <li><a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z">
                                                                    </path>
                                                                </svg><!-- check -->
                                                                <span>Mark as Read</span></a></li><!-- li -->
                                                        <li><a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-bell"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6">
                                                                    </path>
                                                                </svg><!-- bell -->
                                                                <span>Mute Notifications</span></a></li><!-- li -->
                                                        <li><a href="contacts.html">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-person" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z">
                                                                    </path>
                                                                </svg><!-- person -->
                                                                <span>Block User</span></a></li><!-- li -->

                                                        <li class="dropdown-divider"></li><!-- li -->
                                                        <li><a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-file-earmark-arrow-down"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z">
                                                                    </path>
                                                                    <path
                                                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z">
                                                                    </path>
                                                                </svg><!-- file-earmark-arrow-down -->
                                                                <span>Archive</span></a></li><!-- li -->
                                                        <li><a href="#deleteChat" data-bs-toggle="modal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                                                    </path>
                                                                    <path
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                                                    </path>
                                                                </svg><!-- trash -->
                                                                <span>Delete</span></a></li><!-- li -->

                                                    </ul>
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
                                                <div class="member-openmedia-content">
                                                    <ul class="tyn-list-links">
                                                        <li><a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z">
                                                                    </path>
                                                                </svg><!-- check -->
                                                                <span>Mark as Read</span></a></li><!-- li -->
                                                        <li><a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-bell"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6">
                                                                    </path>
                                                                </svg><!-- bell -->
                                                                <span>Mute Notifications</span></a></li><!-- li -->
                                                        <li><a href="contacts.html">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-person" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z">
                                                                    </path>
                                                                </svg><!-- person -->
                                                                <span>Block User</span></a></li><!-- li -->

                                                        <li class="dropdown-divider"></li><!-- li -->
                                                        <li><a href="#">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-file-earmark-arrow-down"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z">
                                                                    </path>
                                                                    <path
                                                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z">
                                                                    </path>
                                                                </svg><!-- file-earmark-arrow-down -->
                                                                <span>Archive</span></a></li><!-- li -->
                                                        <li><a href="#deleteChat" data-bs-toggle="modal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                                                    </path>
                                                                    <path
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                                                    </path>
                                                                </svg><!-- trash -->
                                                                <span>Delete</span></a></li><!-- li -->

                                                    </ul>
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
                                <ul class="d-flex">
                                    <li class="search-wrapper">
                                        <div class="search-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="search--item--contain">

                                            <div class="tyn-chat-search d-flex" id="tynChatSearch">
                                                <div class="flex-grow-1">
                                                    <div class="form-group">
                                                        <div
                                                            class="form-control-wrap form-control-plaintext-wrap d-flex align-items-center">
                                                            <div class="form-control-icon start mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-search" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                                                    </path>
                                                                </svg><!-- search -->
                                                            </div>
                                                            <input type="text"
                                                                class="form-control form-control-plaintext"
                                                                id="searchInThisChat" placeholder="Search in this chat">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <ul class="tyn-list-inline d-flex">
                                                        <li><button class="btn btn-icon btn-sm btn-transparent">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-chevron-up" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z">
                                                                    </path>
                                                                </svg><!-- chevron-up -->
                                                            </button></li>
                                                        <li><button class="btn btn-icon btn-sm btn-transparent">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708">
                                                                    </path>
                                                                </svg><!-- chevron-down -->
                                                            </button></li>
                                                    </ul>
                                                    <ul class="tyn-list-inline ">
                                                        <li>
                                                            <div class="btn btn-icon btn-md  cross-search">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-x-lg"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z">
                                                                    </path>
                                                                </svg><!-- x-lg -->
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="search-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-camera-video-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2z">
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
                            <div class="user-reply">How are you..?</div>
                            <div class="admin-reply">I am fine what about you..?</div>
                        </div>
                    </div>

                    <div class="chat-footer">
                        <div class="chat-footer-wrapper">
                            <div class="custom-smile">
                                <ul>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2">
                                            </path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8">
                                            </path>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z">
                                            </path>
                                        </svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal cutom-member-modal fade" id="filternewModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #0c223d;">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">Search by Member ID</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="/assets/app/img/newcross.png" class="" alt="cross">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="searchchat-id">
                            <input type="text" class="form-control form-control-solid" id="search"
                                placeholder="Search User by Member ID">
                        </div>
                        <div class="newchat-wrapper">
                            <ul>
                                <li class="chatitem">
                                    <div class="newchat-item">
                                        <div class="user-thumnil"><img
                                                src="http://e4u.local/escorts/images/105/e1d28ba21acd94ddb4495ea78.jpg">
                                        </div>
                                        <div class="user-id">Member id: <span>A20352</span></div>
                                        <div class="start-chat"><button>Start Chat</button></div>
                                    </div>
                                </li>
                                <li class="chatitem">
                                    <div class="newchat-item">
                                        <div class="user-thumnil"><img
                                                src="http://e4u.local/escorts/images/105/e1d28ba21acd94ddb4495ea78.jpg">
                                        </div>
                                        <div class="user-id">Member id: <span>A20352</span></div>
                                        <div class="start-chat"><button>Start Chat</button></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {

            // Toggle actions
            jQuery('.cross-search').click(function(e) {
                jQuery('li.search-wrapper').removeClass('search--actived');
                e.stopPropagation();
            });

            jQuery('.search-item').click(function(e) {
                jQuery(this).parent().toggleClass('search--actived');
                e.stopPropagation();
            });

            jQuery('.media-option-btn').click(function(e) {
                jQuery(this).parent().toggleClass('mediaoption-actived');
                e.stopPropagation();
            });

            jQuery('.trace-filter .filter-fill').click(function(e) {
                jQuery(this).toggleClass('filter-activated');
                e.stopPropagation();
            });

            // Click outside to remove active classes
            jQuery(document).click(function(e) {
                // Agar click kisi specified element ke andar nahi hua
                if (!jQuery(e.target).closest(
                        '.search-wrapper, .search-item, .media-option-btn, .trace-filter .filter-fill')
                    .length) {
                    jQuery('.search-wrapper').removeClass('search--actived');
                    jQuery('.media-option-btn').parent().removeClass('mediaoption-actived');
                    jQuery('.trace-filter .filter-fill').removeClass('filter-activated');
                }
            });

        });
    </script>
@endsection

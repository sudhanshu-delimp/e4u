@php
    $escortName = ($escort->gender == 'Transgender')? 'TS-' . $escort->name : $escort->name;
@endphp
    
<div class="listview_each_section_border_btm silver-sec brb--listing">
    <div class="manage_listview_margin_gold_section  list_provide_cruise plat_list_frame">
        

        
        <div class="row">
            <div class="col-lg-12">
                <div class="EC__list_card">
                    <div class="all-escort-profile-pic">                       
                        <a href="{{ getEscortMassageDetailUrl($escort) }}">
                            @if ($escort->latestActiveBrb)
                                <div class="brb--content">
                                    <div class="brb--wrappr">
                                        <span class="brb-text">BRB</span> at <span
                                            class="brb-time">{{ date('h:i A', strtotime($escort->latestActiveBrb->selected_time)) }}</span>
                                        <span
                                            class="brb-date">{{ date('d-m-Y', strtotime($escort->latestActiveBrb->selected_time)) }}</span>
                                    </div>
                                </div>
                            @endif
                            <img src="{{ $escort->first_image ? asset('assets/app/img/service-provider/Frame-408.png') : asset('assets/app/img/service-provider/Frame-408.png') }}"
                                class="img-fluid" title="View Profile">
                        </a>
                        <div class="siliver_logo_icon"><img src="{{ asset('images/platinum_membership.png') }}">
                        </div>
                        <div class="add_to_fab_list_view_each_sec">
                            @if (auth()->user())
                                 @if ($viewerAuth->type == '0')
                                    <span
                                        class="add_to_favrate custom--favourite @if (in_array($escort->id, $user_type)) {{ 'null' }}@else{{ 'fill' }} @endif legboxClass_{{ $escort->id }}"
                                        id="legboxId_{{ $escort->id }}" data-escortId="{{ $escort->id }}"
                                        data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}"
                                        data-name="{{ $escortName }}">
                                        {{-- @if (!empty($user_type)) --}}
                                            @if (in_array($escort->id, $user_type))
                                                <i class='fa fa-heart' style='color: #ff3c5f;'
                                                    aria-hidden='true'></i>
                                                <span class="custom-heart-text list-tool remove-tool">Remove from My
                                                    Legbox</span>
                                            @else
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                <span class="custom-heart-text list-tool">Add to My Legbox</span>
                                            @endif
                                        {{-- @endif --}}
                                    </span>
                                @else
                                    <span class="add_to_favrate custom--favourite"
                                        data-name="{{ $escortName }}"><i class="fa fa-heart-o"
                                            aria-hidden="true"></i><span class="custom-heart-text list-tool">Add to
                                            My Legbox </span></span>
                                @endif
                            @else
                                {{-- <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escortName}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span> --}}
                                <span class="add_to_favrate custom--favourite" data-escortId="{{ $escort->id }}"
                                    data-name="{{ $escortName }}"><i class="fa fa-heart-o"
                                        aria-hidden="true"></i><span class="custom-heart-text list-tool">Add to My
                                        Legbox</span></span>
                            @endif
                        </div>
                        
                        <div class="video_icon_ec custom--available-section">


                            @if ($escort->escort_videos->count() > 0)
                                <div class="video_icon">
                                    <a href="#">
                                        <img src="{{ asset('assets/app/img/video_play.svg') }}">
                                        <span class="custom--tooltip">Escort has video to view</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        @if ($escort->first_image)
                            <div class="verify-image-custom">
                                @php
                                    $media_status = getMediaVerificationDataBigIcon($escort->verification_status ?? 0,);
                                @endphp
                                <img src="{{ $media_status['icon'] }}">
                                <span class="common_shield_tooltip">{{ $media_status['label'] }}</span>
                            </div>
                        @endif
                    </div>
                    {{-- end --}}
                    <div class="all-escort-view-profile-box">
                        <div class="ec_tab_header">
                            <ul class="nav nav-tabs" id="profileTabs-{{ $escort->id }}" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-details-tab-{{ $escort->id }}" data-toggle="tab"
                                        href="#profile-details-{{ $escort->id }}" role="tab" aria-controls="profile-details-{{ $escort->id }}"
                                        aria-selected="true">
                                        Profile Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="services-tab-{{ $escort->id }}" data-toggle="tab" href="#services-{{ $escort->id }}"
                                        role="tab" aria-controls="services-{{ $escort->id }}" aria-selected="false">

                                        Services
                                    </a>
                                </li>
                            </ul>
                            <div class="add_to_shortlist_btn manage_btn_gor_gold_in_responsive">
                                @if (Request::path() == 'showList')
                                    <button type="button"
                                        class="btn btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn removeshortlist custom-sort-filter"
                                        data-name="{{ $escortName }}" data-escortId="{{ $escort->id }}">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.75 3.25H8.24999C7.52064 3.25 6.82117 3.53973 6.30545 4.05546C5.78972 4.57118 5.49999 5.27065 5.49999 6V20C5.49898 20.1377 5.53587 20.2729 5.60662 20.391C5.67738 20.5091 5.77926 20.6054 5.90112 20.6695C6.02298 20.7335 6.16012 20.7627 6.2975 20.754C6.43488 20.7453 6.56721 20.6989 6.67999 20.62L12 16.91L17.32 20.62C17.4467 20.7063 17.5967 20.7516 17.75 20.75C17.871 20.7486 17.9903 20.7213 18.1 20.67C18.2203 20.6041 18.3208 20.5072 18.3911 20.3894C18.4615 20.2716 18.499 20.1372 18.5 20V6C18.5 5.27065 18.2103 4.57118 17.6945 4.05546C17.1788 3.53973 16.4793 3.25 15.75 3.25Z" fill="#ffffff"></path> </g></svg>
                                        Remove from Shortlist</button>
                                @else
                                    <button type="button"
                                        class="btn custom-sort-filter btn_for_profile_list_view min_width_hundredpresent fill_platinum_btn shortlist myescort_{{ $escort->id }}"
                                        id="escort_{{ $escort->id }}" data-name="{{ $escortName }}"
                                        data-escortId="{{ $escort->id }}"
                                        data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17.75 20.75C17.5974 20.747 17.4487 20.702 17.32 20.62L12 16.91L6.68 20.62C6.56249 20.6915 6.42757 20.7294 6.29 20.7294C6.15243 20.7294 6.01751 20.6915 5.9 20.62C5.78491 20.5607 5.68741 20.4722 5.61722 20.3634C5.54703 20.2546 5.50661 20.1293 5.5 20V6C5.5 5.27065 5.78973 4.57118 6.30546 4.05546C6.82118 3.53973 7.52065 3.25 8.25 3.25H15.75C16.4793 3.25 17.1788 3.53973 17.6945 4.05546C18.2103 4.57118 18.5 5.27065 18.5 6V20C18.5005 20.1362 18.4634 20.2698 18.3929 20.3863C18.3223 20.5027 18.2209 20.5974 18.1 20.66C17.9927 20.7189 17.8724 20.7498 17.75 20.75ZM12 15.25C12.1532 15.2484 12.3033 15.2938 12.43 15.38L17 18.56V6C17 5.66848 16.8683 5.35054 16.6339 5.11612C16.3995 4.8817 16.0815 4.75 15.75 4.75H8.25C7.91848 4.75 7.60054 4.8817 7.36612 5.11612C7.1317 5.35054 7 5.66848 7 6V18.56L11.57 15.38C11.6967 15.2938 11.8468 15.2484 12 15.25Z" fill="#fff"></path> </g></svg>
                                        @if (!empty($escortId))
                                            @if (in_array($escort->id, $escortId))
                                                Remove from Shortlist
                                            @else
                                                Add to Shortlist
                                            @endif
                                        @else
                                            Add to Shortlist
                                        @endif
                                        </img>
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="tab-content" id="profileTabsContent">

                            <!-- Profile Details -->
                            <div class="tab-pane fade show active" id="profile-details-{{ $escort->id }}" role="tabpanel"
                                aria-labelledby="profile-details-tab">
                                <div class="ec_list_header">
                                    <div class="">
                                        <div class="ec_name">{{ $escortName }}</div>
                                        <span class="ec_other_details">
                                            <span class="give_rating_after_get_servive">
                                                Rating :
                                                (@for ($i = 1; $i <= 5; $i++)
                                                    @if ($escort->star_rating && $escort->star_rating > 0 && $i <= $escort->star_rating)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @endif
                                                @endfor)
                                            </span>
                                            <span></span>
                                            <span>AGE: (<span class="age">{{ $escort->age }}</span>)
                                            </span>
                                        </span>
                                    </div>

                                    <div class="age">

                                    </div>
                                </div>

                                <div class="ec_list_meta">
                                    <div class="services_card">
                                        <spna class="icon">
                                            <svg fill="#ff3c5f" width="64px" height="64px" viewBox="0 0 200 200"
                                                data-name="Layer 1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <title></title>
                                                    <path
                                                        d="M178.25,26.34c-.5-4-4-7-7.5-8l-26.5-5.5c-5.5-1-10.5,2.5-12,8s2.5,10.5,8,12l8,1.5-23.5,23.5a44.64,44.64,0,0,0-48,0l-2-2,8-8a9.9,9.9,0,0,0-14-14l-8,8-7.5-7.5,7-1.5a10.2,10.2,0,1,0-4-20l-26.5,5.5a10.85,10.85,0,0,0-8,8l-5.5,26.5c-1,5.5,2.5,10.5,8,12,5.5,1,10.5-2.5,12-8l2-9.5,8.5,8.5-8,8a9.9,9.9,0,0,0,14,14l8-8,2,2a43.59,43.59,0,0,0-7,24,45.08,45.08,0,0,0,35,44v7.5h-20a10,10,0,0,0,0,20h20v10a10,10,0,1,0,20,0v-10h20a10,10,0,0,0,0-20h-20v-7.5a45.08,45.08,0,0,0,35-44,43.59,43.59,0,0,0-7-24l23.5-23.5,1.5,8a10.25,10.25,0,0,0,12,8,9.76,9.76,0,0,0,8-11.5Zm-77.5,94.5a25,25,0,1,1,25-25A24.76,24.76,0,0,1,100.75,120.84Z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </spna>
                                        <span class="details">
                                            <p>Gender</p>
                                            <span>{{ $escort->gender ? $escort->gender : '' }}</span>
                                        </span>
                                    </div>
                                    <div class="services_card">
                                        <spna class="icon">
                                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z"
                                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </spna>
                                        <span class="details">
                                            <p>Location</p>
                                            <span>{{ $escort->city ? $escort->city->name : '' }}</span>
                                        </span>
                                    </div>

                                    <div class="services_card">
                                        <spna class="icon">
                                            <svg width="64px" height="64px" viewBox="0 0 24 24" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                                    <title>ic_fluent_person_available_24_regular</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <g id="🔍-Product-Icons" stroke="none" stroke-width="1"
                                                        fill="none" fill-rule="evenodd">
                                                        <g id="ic_fluent_person_available_24_regular" fill="#ff3c5f"
                                                            fill-rule="nonzero">
                                                            <path
                                                                d="M17.5,12 C20.5375661,12 23,14.4624339 23,17.5 C23,20.5375661 20.5375661,23 17.5,23 C14.4624339,23 12,20.5375661 12,17.5 C12,14.4624339 14.4624339,12 17.5,12 Z M14.8535534,17.1464466 C14.6582912,16.9511845 14.3417088,16.9511845 14.1464466,17.1464466 C13.9511845,17.3417088 13.9511845,17.6582912 14.1464466,17.8535534 L16.1464466,19.8535534 C16.3417088,20.0488155 16.6582912,20.0488155 16.8535534,19.8535534 L20.8535534,15.8535534 C21.0488155,15.6582912 21.0488155,15.3417088 20.8535534,15.1464466 C20.6582912,14.9511845 20.3417088,14.9511845 20.1464466,15.1464466 L16.5,18.7928932 L14.8535534,17.1464466 Z M12.0222607,13.9993086 C11.7255613,14.4626083 11.4860296,14.9660345 11.3136172,15.4996352 L4.25241795,15.499921 C3.83882492,15.499921 3.50354153,15.8352044 3.50354153,16.2487975 L3.50354153,16.8264756 C3.50354153,17.3621428 3.69465071,17.8802318 4.0425094,18.2875833 C5.29581764,19.7552799 7.2616965,20.5010712 10,20.5010712 C10.5964371,20.5010712 11.1563096,20.4656877 11.6802333,20.3951657 C11.9254268,20.8900389 12.2329719,21.3486241 12.5917507,21.7614991 C11.7962462,21.9217336 10.9313618,22.0010712 10,22.0010712 C6.85413751,22.0010712 4.46812444,21.0958945 2.90182147,19.2616629 C2.32205983,18.5827471 2.00354153,17.7192572 2.00354153,16.8264756 L2.00354153,16.2487975 C2.00354153,15.0067773 3.0103978,13.999921 4.25241795,13.999921 L12.0222607,13.9993086 Z M10,2.0046246 C12.7614237,2.0046246 15,4.24320085 15,7.0046246 C15,9.76604835 12.7614237,12.0046246 10,12.0046246 C7.23857625,12.0046246 5,9.76604835 5,7.0046246 C5,4.24320085 7.23857625,2.0046246 10,2.0046246 Z M10,3.5046246 C8.06700338,3.5046246 6.5,5.07162798 6.5,7.0046246 C6.5,8.93762123 8.06700338,10.5046246 10,10.5046246 C11.9329966,10.5046246 13.5,8.93762123 13.5,7.0046246 C13.5,5.07162798 11.9329966,3.5046246 10,3.5046246 Z"
                                                                id="🎨-Color"> </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </spna>
                                        <span class="details">
                                            <p>Available</p>
                                            <div class="available custom-gender-type-icon">

                                                <span>

                                                    @if ($escort->available_to)
                                                        @foreach ($escort->available_to as $key => $available_to)
                                                            <div class="icon-with-tooltip position-relative">
                                                                <img
                                                                    src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                                                <span class="custom-icon-hover-tooltip">
                                                                    {{ config('escorts.profile.available-to')[$available_to] }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="services_card">
                                        <span class="icon">
                                            <svg fill="#ff3c5f" width="64px" height="64px"
                                                viewBox="0 0 32.00 32.00" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" stroke="#ff3c5f"
                                                stroke-width="0.00032" transform="matrix(1, 0, 0, 1, 0, 0)">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <title>hand-holding-heart</title>
                                                    <path
                                                        d="M29.287 19.252c-0.486-0.206-1.052-0.326-1.646-0.326-0.65 0-1.267 0.144-1.82 0.402l0.027-0.011-5.121 2.301c-0.32-1.36-1.523-2.356-2.959-2.356-0.058 0-0.115 0.002-0.172 0.005l0.008-0h-3.711l-4.691-1.375c-0.104-0.032-0.225-0.051-0.349-0.051-0.001 0-0.002 0-0.003 0h-1.669v-0.257c0-0.69-0.56-1.25-1.25-1.25v0h-3.883c-0.69 0-1.25 0.56-1.25 1.25v0 12.208c0 0.69 0.56 1.25 1.25 1.25h3.883c0.69-0 1.25-0.56 1.25-1.25v-0.44c1.596 0.316 2.993 0.738 4.33 1.278l-0.159-0.057c1.209 0.432 2.603 0.682 4.056 0.682 1.676 0 3.274-0.332 4.732-0.934l-0.082 0.030c1.271-0.563 2.351-1.16 3.372-1.839l-0.083 0.052c0.334-0.207 0.668-0.412 1.004-0.611 1.648-0.977 2.973-1.832 4.17-2.699 0.595-0.424 1.115-0.843 1.608-1.29l-0.014 0.013c0.428-0.353 0.769-0.795 0.997-1.3l0.009-0.023c0.052-0.133 0.082-0.287 0.082-0.448 0-0.093-0.010-0.184-0.029-0.271l0.002 0.008c-0.176-1.17-0.885-2.144-1.868-2.68l-0.019-0.010zM4.681 28.541h-1.383v-9.709h1.383zM28.379 22.174c-0.398 0.356-0.831 0.702-1.283 1.024l-0.046 0.031c-1.131 0.818-2.395 1.635-3.975 2.57-0.352 0.209-0.697 0.424-1.045 0.639-0.833 0.557-1.791 1.091-2.793 1.547l-0.129 0.052c-1.096 0.451-2.369 0.712-3.703 0.712-1.137 0-2.229-0.19-3.247-0.54l0.070 0.021c-1.451-0.607-3.148-1.097-4.911-1.392l-0.137-0.019v-6.48h1.489l4.691 1.375c0.105 0.032 0.226 0.051 0.351 0.051h3.891c0.443 0 0.697 0.17 0.697 0.469s-0.254 0.469-0.697 0.469h-6.809c-0.69 0-1.25 0.56-1.25 1.25s0.56 1.25 1.25 1.25v0h7.781c0 0 0 0 0.001 0 0.185 0 0.361-0.040 0.519-0.113l-0.008 0.003 7.803-3.504c0.228-0.105 0.494-0.167 0.774-0.167 0.183 0 0.359 0.026 0.526 0.075l-0.013-0.003c0.185 0.113 0.326 0.282 0.4 0.484l0.002 0.007c-0.066 0.064-0.137 0.129-0.201 0.189zM16.060 17.075c0.23 0.254 0.561 0.413 0.929 0.413s0.699-0.159 0.928-0.412l0.001-0.001 5.96-6.607c1.172-1.091 1.919-2.627 1.969-4.338l0-0.009c0-0.014 0-0.030 0-0.047 0-1.469-0.599-2.798-1.566-3.755l-0-0c-0.986-0.973-2.34-1.574-3.836-1.574-1.321 0-2.533 0.469-3.477 1.25l0.009-0.007c-0.872-0.648-1.971-1.038-3.16-1.038-0.481 0-0.947 0.064-1.39 0.183l0.037-0.009c-1.926 0.548-3.411 2.033-3.949 3.919l-0.010 0.040c-0.107 0.405-0.168 0.869-0.168 1.348 0 1.582 0.669 3.008 1.74 4.010l0.003 0.003zM10.919 5.729c0.311-1.061 1.13-1.88 2.169-2.185l0.023-0.006c0.213-0.061 0.459-0.095 0.712-0.096h0c0.909 0.030 1.717 0.435 2.28 1.064l0.003 0.003c0.226 0.226 0.539 0.366 0.884 0.366s0.658-0.14 0.884-0.366v0c0.654-0.727 1.577-1.199 2.612-1.26l0.010-0.001c0.787 0.006 1.499 0.324 2.018 0.836l-0-0c0.518 0.556 0.836 1.305 0.836 2.128 0 1.024-0.492 1.933-1.254 2.504l-0.008 0.006c-0.016 0.015-0.031 0.030-0.044 0.046l-0.001 0.001-5.053 5.601-5.097-5.648c-0.649-0.552-1.059-1.369-1.059-2.282 0-0.253 0.031-0.498 0.090-0.733l-0.004 0.021z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="details">
                                            <p>Massage</p>

                                            <span>@php
                                                $durationPrice = $escort->oneHourDuration->first()->pivot ?? 0;
                                            @endphp
                                                {{ $durationPrice ? '$' . number_format($durationPrice->massage_price) . '/hr' : 'N/A' }}</span>
                                        </span>
                                    </div>
                                    <div class="services_card">
                                        <span class="icon">
                                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z"
                                                        stroke="#ff3c5f" stroke-width="2"></path>
                                                    <path d="M9.5 14.5L15 9" stroke="#ff3c5f" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14 15H9.32833C9.147 15 9 14.853 9 14.6716V10"
                                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="details">
                                            <p>Incalls</p>

                                            <span>{{ $durationPrice ? '$' . number_format($durationPrice->incall_price) . '/hr' : 'N/A' }}</span>
                                        </span>
                                    </div>
                                    <div class="services_card">
                                        <span class="icon">
                                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3Z"
                                                        stroke="#ff3c5f" stroke-width="2"></path>
                                                    <path d="M14.5 9.5L9 15" stroke="#ff3c5f" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M10 9H14.6717C14.853 9 15 9.14703 15 9.32837V14"
                                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="details">
                                            <p>Outcalls</p>

                                            <span>{{ $durationPrice ? '$' . number_format($durationPrice->outcall_price) . '/hr' : 'N/A' }}</span>
                                        </span>
                                    </div>
                                </div>

                                @php
                                    $plainTextAbout = strip_tags($escort->about);
                                    $limitText = Str::limit($plainTextAbout, 200, '...');
                                @endphp
                                <div class="prof_desc ec_list_about">
                                    <strong>About Me</strong><br>
                                    <p class="list_view_profile_pera_font_size">{!! $limitText !!}
                                        @if (strlen($plainTextAbout) > 200)
                                            <a href=" {{ getEscortMassageDetailUrl($escort) }}"
                                                class="h6 text-danger">Read
                                                More</a>
                                        @endif
                                    </p>
                                </div>

                                <div class="all-escort-view-profile-btn">
                                    {{-- social-media icon --}}
                                    <div class="social_media_icons">
                                        <div class="social_media_wrapper">
                                            <div class="s_icon ec_playbox_icon">
                                                <a href="{{ url('playbox') }}" target="_blank"><img
                                                        src="{{ asset('assets/app/img/MyPlaybox.png') }}"
                                                        alt="logo"></a>
                                                <div class="custom-tooltip">I don't have any Playbox.</div>
                                            </div>
                                            <div class="d-flex justify-content-between gap-10">
                                                @if (!empty($escort->user->profile_creator) && in_array(3, $escort->user->profile_creator))
                                                    @if ($escort->user->social_links && $escort->user->social_links['facebook'] !== null)
                                                        <div class="s_icon">
                                                            <a href="{{ $escort->user->social_links && $escort->user->social_links['facebook'] != '' ? $escort->user->social_links['facebook'] : 'https://www.facebook.com/' }}"
                                                                target="_blank"><img
                                                                    src="{{ asset('assets/app/img/facebook.png') }}"
                                                                    alt="logo"></a>
                                                        </div>
                                                    @endif
                                                    @if ($escort->user->social_links && $escort->user->social_links['insta'] !== null)
                                                        <div class="s_icon">
                                                            <a href="{{ $escort->user->social_links && $escort->user->social_links['insta'] != '' ? $escort->user->social_links['insta'] : 'https://www.instagram.com/' }}"
                                                                target="_blank"><img
                                                                    src="{{ asset('assets/app/img/instagram.png') }}"
                                                                    alt="logo"></a>
                                                        </div>
                                                    @endif
                                                    @if ($escort->user->social_links && $escort->user->social_links['twitter'] !== null)
                                                        <div class="s_icon">
                                                            <a href="{{ $escort->user->social_links && $escort->user->social_links['twitter'] != '' ? $escort->user->social_links['twitter'] : 'https://x.com/' }}"
                                                                target="_blank"><img
                                                                    src="{{ asset('assets/app/img/twitter-x.png') }}"
                                                                    alt="logo"></a>
                                                        </div>
                                                    @else
                                                        <div class="s_icon">
                                                            <a href="https://x.com/NMugs32853" target="_blank"><img
                                                                    src="{{ asset('assets/app/img/twitter-x.png') }}"
                                                                    alt="logo"></a>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="s_icon">
                                                        <a href="https://x.com/NMugs32853" target="_blank"><img
                                                                src="{{ asset('assets/app/img/twitter-x.png') }}"
                                                                alt="logo"></a>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <a href="{{ getEscortMassageDetailUrl($escort) }}"
                                        class="btn btn_for_profile_list_view custom-view-profile"
                                        style="float: right;">View
                                        Profile</a>
                                </div>

                            </div>

                            <!-- Services -->
                            <div class="tab-pane fade p-2" id="services-{{ $escort->id }}" role="tabpanel"
                                aria-labelledby="services-tab-{{ $escort->id }}">
                                <table class="table table-striped open-time-table mb-0">
                                    <thead class="table_heading_bgcolor_color">
                                        <tr>
                                            <th class="text-left">Service</th>
                                            <th>Massage</th>
                                            <th class="text-center">Incalls</th>
                                        </tr>
                                    </thead>                                    
                                        <tbody>
                                            @if (!empty($escort->durations))
                                                @foreach ($escort->durations as $key => $duration)
                                                    <tr>
                                                        <td>{{ $duration->name }} </td>
                                                        <td class="text-center">{!! $duration->pivot->massage_price
                                                            ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($duration->pivot->massage_price) . '</div>'
                                                            : "<span class='if_data_not_available'>N/A</span>" !!}
                                                        </td>
                                                        <td class="text-center">{!! $duration->pivot->incall_price
                                                            ? "<div class='public-num-value-table'> <span>$ </span>" . number_format($duration->pivot->incall_price) . '</div>'
                                                            : "<span class='if_data_not_available'>N/A</span>" !!}
                                                        </td>
                                                    </tr>
                                                    @if ($loop->index == 5)
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <thead class="table_heading_bgcolor_color available_footer">
                                            <tr>
                                                <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span
                                                        class="date_from_available">{{ date('d-m-Y', strtotime($escort->start_date)) }}</span>
                                                    to <span
                                                        class="date_from_available">{{ date('d-m-Y', strtotime($escort->end_date)) }}</span>
                                                </th>
                                            </tr>
                                        </thead>
                                </table>
                            </div>

                        </div>

                       
                    {{-- 3rd --}}
                    <table class="table table-striped mb-0">
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Massage</th>
                                <th scope="col">Incalls</th>
                            </tr>
                        </thead>
                    </table>
                    {{-- end --}}
                </div>
            </div>
        </div>



        
    </div>
</div>
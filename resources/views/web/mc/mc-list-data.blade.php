@php
    $ids = $listings->pluck('id')->toArray();
@endphp


@foreach ($listings as $listing)


    @php
        $other_services = '';
        $massage_services = '';

        $relativePath = $listing->imagePosition(1);
        $currentImage = asset($relativePath);
        $thumnail = asset($relativePath);
        if (str_contains($currentImage, 'img-11.png')) {
            $massage_thumb = config('escorts.escort_default_thumb');
        } else {
            if ($currentImage != '' && is_file(public_path($relativePath))) {
                $massage_thumb = $currentImage;
            } else {
                $massage_thumb = config('escorts.escort_default_thumb');
            }
        }

        $social_links = get_social_links($listing->user_id);

        if (isset($social_links['twitter']) && $social_links['twitter'] != '') {
            $twitter_link = $social_links['twitter'];
        } else {
            $twitter_link = 'https://x.com/NMugs32853';
        }

    @endphp

    <div class="mc_card_wrapper">
        <div class="mc_list_card">

            <!-- Left Image -->
            <div class="mc_list_img">

                @if ($listing->latest_active_brb)
                    <div class="brb--content">
                        <div class="brb--wrappr">
                            <span class="brb-text">Closed </span> until <span
                                class="brb-time">{{ date('h:i A', strtotime($listing->latest_active_brb->selected_time)) }}</span>
                            <br> <span
                                class="brb-date">{{ date('d-m-Y', strtotime($listing->latest_active_brb->selected_time)) }}</span>
                        </div>
                    </div>
                @endif

                <a href="{{ getEscortMassageDetailUrl($listing, 'massage') }}" class="mc_card_link"> <img
                        src="{{ $massage_thumb }}" alt=""></a>
                <span class="verify_icon">
                    @php
                        $media_verification_status = get_profile_verification_status($listing->id);
                        $media_status = getMediaVerificationDataBigIcon($media_verification_status ?? 0);
                    @endphp
                    <img src="{{ $media_status['icon'] }}" alt="pending">
                    <span class="common_shield_tooltip">{{ $media_status['label'] }}</span>
                </span>
                <div class="social_media_icons w-100">
                    <div class="social_media_wrapper">


                        <div class="d-flex justify-content-between gap-10">

                            @if (isset($social_links['facebook']) && $social_links['facebook'] != '')
                                <div class="s_icon">
                                    <a href="{{ $social_links['facebook'] }}" target="_blank"><img
                                            src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/facebook.png"
                                            alt="logo"></a>
                                </div>
                            @endif

                            @if (isset($social_links['insta']) && $social_links['insta'] != '')
                                <div class="s_icon">
                                    <a href="{{ $social_links['insta'] }}" target="_blank"><img
                                            src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/instagram.png"
                                            alt="logo"></a>
                                </div>
                            @endif


                            <div class="s_icon">
                                <a href="{{ $twitter_link }}" target="_blank"><img
                                        src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/twitter-x.png"
                                        alt="logo"></a>
                            </div>



                        </div>

                    </div>


                </div>
                <div class="mc_list_legbox">


                    @if (auth()->user())
                        @if (auth()->user()->type == 0)
                            <span
                                class="add_to_favrate @if (in_array($listing->id, $logedInUpser->massageCenterLegBox->pluck('id')->toArray())) {{ 'null' }}@else{{ 'fill' }} @endif custom--favourite"
                                id="legboxId_{{ $listing->id }}" data-massageId="{{ $listing->id }}"
                                data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}"
                                data-name="{{ $listing->business_name }} ">
                                @if (!empty($logedInUpser))
                                    @if (in_array($listing->id, $logedInUpser->massageCenterLegBox->pluck('id')->toArray()))
                                        <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                                        <span class="custom-heart-text">Remove from My Legbox</span>
                                    @else
                                        <i class="fa fa-heart-o" aria-hidden='true'></i>
                                        <span class="custom-heart-text">Add to My Legbox</span>
                                    @endif
                                @endif
                            </span>
                        @else
                            <span class="my_legbox_icon" data-target="#my_legbox" data-toggle="modal">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <span class="mc_legbox_tooltip">Add to My Legbox</span>
                            </span>
                        @endif
                    @else
                        <span class="my_legbox_icon" data-target="#my_legbox" data-toggle="modal">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="mc_legbox_tooltip">Add to My Legbox</span>
                        </span>
                    @endif
                </div>
                <div class="video_icon_mc custom--available-section">
                    <div class="video_icon">
                        <a href="#">
                            @php
                                $videoCnt = checkVideoExistInMcProfile($listing->user_id);
                            @endphp
                            @if ($videoCnt > '0')
                                <img src="{{ asset('assets/app/img/video_play.svg') }}">
                            @endif
                            <span class="custom--tooltip">Massage Centres has video to view</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Middle Content -->
            <div class="mc_list_content">
                <div class="mc_list_content_inner w-100">
                    
                   <div class="mc_tab_header">
                     <ul class="nav nav-tabs" id="profileTabs-{{ $listing->id }}" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="profile-details-tab-{{ $listing->id }}" data-toggle="tab"
                                href="#profile-details-{{ $listing->id }}" role="tab"
                                aria-controls="profile-details-{{ $listing->id }}" aria-selected="true">
                                Profile Details
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="open-times-tab-{{ $listing->id }}" data-toggle="tab"
                                href="#open-times-{{ $listing->id }}" role="tab"
                                aria-controls="open-times-{{ $listing->id }}" aria-selected="false">
                                Open Times
                            </a>
                        </li>
                    </ul>
                    

                        @php
                            $inWishlist = in_array($listing->id, session('wishlist', []));
                        @endphp
                        
                        <span class="list_button_wrap" id="list_button_wrap_id{{ $listing->id }}">
                            <button type="button" class="{{ $inWishlist ? 'm_removelist' : 'm_wishlist' }}"
                                data-id="{{ $listing->id }}">

                               <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff" stroke-width="0.168"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17.75 20.75C17.5974 20.747 17.4487 20.702 17.32 20.62L12 16.91L6.68 20.62C6.56249 20.6915 6.42757 20.7294 6.29 20.7294C6.15243 20.7294 6.01751 20.6915 5.9 20.62C5.78491 20.5607 5.68741 20.4722 5.61722 20.3634C5.54703 20.2546 5.50661 20.1293 5.5 20V6C5.5 5.27065 5.78973 4.57118 6.30546 4.05546C6.82118 3.53973 7.52065 3.25 8.25 3.25H15.75C16.4793 3.25 17.1788 3.53973 17.6945 4.05546C18.2103 4.57118 18.5 5.27065 18.5 6V20C18.5005 20.1362 18.4634 20.2698 18.3929 20.3863C18.3223 20.5027 18.2209 20.5974 18.1 20.66C17.9927 20.7189 17.8724 20.7498 17.75 20.75ZM12 15.25C12.1532 15.2484 12.3033 15.2938 12.43 15.38L17 18.56V6C17 5.66848 16.8683 5.35054 16.6339 5.11612C16.3995 4.8817 16.0815 4.75 15.75 4.75H8.25C7.91848 4.75 7.60054 4.8817 7.36612 5.11612C7.1317 5.35054 7 5.66848 7 6V18.56L11.57 15.38C11.6967 15.2938 11.8468 15.2484 12 15.25Z" fill="#ffffff"></path> </g></svg>
                                {{ $inWishlist ? 'Remove from Shortlist' : 'Add to Shortlist' }}
                            </button>
                        </span>

                   </div>


                    <div class="tab-content" id="profileTabsContent-{{ $listing->id }}">

                        <!-- Profile Details -->
                        <div class="tab-pane fade show active" id="profile-details-{{ $listing->id }}"
                            role="tabpanel" aria-labelledby="profile-details-tab-{{ $listing->id }}">
                            <div class="mc_list_header">
                                <div>
                                    <h6 class="mc_list_title">{{ $listing->business_name }} </h6>
                                    <span class="mc_list_rating">
                                        ( Rating :
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (isset($listing->star_rating) && $listing->star_rating > 0 && $i <= $listing->star_rating)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endif
                                        @endfor)
                                    </span>
                                </div>
                            </div>
                            <div class="mc_list_meta">
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512 512" xml:space="preserve" stroke="#ff3c5f">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M256,0C114.618,0,0,114.618,0,256s114.618,256,256,256s256-114.618,256-256S397.382,0,256,0z M256,469.333 c-117.818,0-213.333-95.515-213.333-213.333S138.182,42.667,256,42.667S469.333,138.182,469.333,256S373.818,469.333,256,469.333 z">
                                                            </path>
                                                            <path
                                                                d="M277.333,106.667h-64C201.551,106.667,192,116.218,192,128v128v149.333c0,11.782,9.551,21.333,21.333,21.333 c11.782,0,21.333-9.551,21.333-21.333v-128h42.667c47.131,0,85.333-38.202,85.333-85.333S324.465,106.667,277.333,106.667z M277.333,234.667h-42.667v-85.333h42.667C300.901,149.333,320,168.433,320,192S300.901,234.667,277.333,234.667z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Parking</p>
                                        <span>{{ config('escorts.profile.Parking.' . $listing->parking, 'N/A') }}</span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg width="64px" height="64px" viewBox="0 0 512 512"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill="#ff3c5f"
                                                    d="M217 28.098v455.804l142-42.597V70.697zM119 55v160h18V73h62V55zm257.98.03l.02 2.275V87h16V55zM377 105v16h16v-16zm0 34v236h16V139zm-276.564 58.727L42.162 256l58.274 58.273V279h96v-46h-96zM244 232c6.627 0 12 10.745 12 24s-5.373 24-12 24-12-10.745-12-24 5.373-24 12-24zm-125 65v151h18V297zm258 96v14h16v-14zm0 32v23h16v-23zM32 471v18h167v-18zm290.652 0l-60 18H480v-18z">
                                                </path>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Entry</p>
                                        <span>{{ config('escorts.profile.Entry.' . $listing->entry, 'N/A') }}</span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 458.508 458.508" xml:space="preserve" stroke="#ff3c5f"
                                            stroke-width="2.751048">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <path
                                                        d="M110.12,398.508c-5.522,0-10,4.477-10,10v40c0,5.522,4.478,10,10,10s10-4.478,10-10v-40 C120.12,402.985,115.643,398.508,110.12,398.508z">
                                                    </path>
                                                    <path
                                                        d="M193.453,398.508c-5.522,0-10,4.477-10,10v40c0,5.522,4.478,10,10,10c5.523,0,10-4.478,10-10v-40 C203.453,402.985,198.976,398.508,193.453,398.508z">
                                                    </path>
                                                    <path
                                                        d="M276.786,398.508c-5.522,0-10,4.477-10,10v40c0,5.522,4.478,10,10,10s10-4.478,10-10v-40 C286.786,402.985,282.309,398.508,276.786,398.508z">
                                                    </path>
                                                    <path
                                                        d="M68.453,326.508c-5.523,0-10,4.477-10,10v40c0,5.522,4.478,10,10,10s10-4.478,10-10v-40 C78.453,330.985,73.976,326.508,68.453,326.508z">
                                                    </path>
                                                    <path
                                                        d="M151.786,326.508c-5.523,0-10,4.477-10,10v40c0,5.522,4.477,10,10,10c5.522,0,10-4.478,10-10v-40 C161.786,330.985,157.309,326.508,151.786,326.508z">
                                                    </path>
                                                    <path
                                                        d="M235.12,326.508c-5.523,0-10,4.477-10,10v40c0,5.522,4.477,10,10,10c5.522,0,10-4.478,10-10v-40 C245.12,330.985,240.643,326.508,235.12,326.508z">
                                                    </path>
                                                    <path
                                                        d="M318.453,326.508c-5.522,0-10,4.477-10,10v40c0,5.522,4.478,10,10,10s10-4.478,10-10v-40 C328.453,330.985,323.976,326.508,318.453,326.508z">
                                                    </path>
                                                    <path
                                                        d="M419.453,0c-5.522,0-10,4.477-10,10v10h-91c-79.901,0-145.495,62.384-150.661,141h-9.079c-5.522,0-10,4.477-10,10v26.981 c-24.004,6.861-46.324,19.285-64.884,36.204c-18.305,16.688-32.612,37.433-41.704,60.322h-3.071c-5.522,0-10,4.477-10,10 c0,5.522,4.477,10,10,10h10h288.797h10c5.522,0,10-4.478,10-10c0-5.523-4.478-10-10-10h-3.071 c-9.092-22.89-23.399-43.635-41.704-60.322c-18.56-16.919-40.879-29.343-64.884-36.204V171c0-5.523-4.478-10-10-10h-8.237 c5.029-49.91,47.284-89,98.498-89h91v10c0,5.522,4.478,10,10,10s10-4.478,10-10V10C429.453,4.477,424.976,0,419.453,0z M218.192,181v15h-49.479v-15H218.192z M323.026,294.508H63.88c18.018-38.659,53.201-68.087,94.785-78.508h69.576 C269.825,226.421,305.008,255.849,323.026,294.508z M318.453,52c-62.249,0-113.48,48.045-118.576,109h-12.045 c5.125-67.58,61.752-121,130.621-121h91v12H318.453z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Shower</p>
                                        <span>{{ config('escorts.profile.Shower.' . $listing->parking, 'N/A') }}</span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M3 21H21" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M19 21V15V7C19 5.11438 19 4.17157 18.4142 3.58579C17.8284 3 16.8856 3 15 3H12H9C7.11438 3 6.17157 3 5.58579 3.58579C5 4.17157 5 5.11438 5 7V15V21"
                                                    stroke="#ff3c5f" stroke-width="2" stroke-linejoin="round"></path>
                                                <path d="M9 8L10 8" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M9 12L10 12" stroke="#ff3c5f" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M9 16L10 16" stroke="#ff3c5f" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M14 8L15 8" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M14 12L15 12" stroke="#ff3c5f" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M14 16L15 16" stroke="#ff3c5f" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Building</p>
                                        <span>{{ config('escorts.profile.Building.' . $listing->parking, 'N/A') }}</span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3 4C3 3.44772 2.55228 3 2 3C1.44772 3 1 3.44772 1 4V14V17V20C1 20.5523 1.44772 21 2 21C2.55228 21 3 20.5523 3 20V18H21V20C21 20.5523 21.4477 21 22 21C22.5523 21 23 20.5523 23 20V17V14V11C23 8.23858 20.7614 6 18 6H12C11.4477 6 11 6.44772 11 7V9.5C11 7.567 9.433 6 7.5 6C5.567 6 4 7.567 4 9.5C4 11.433 5.567 13 7.5 13H3V4ZM7.5 13C9.433 13 11 11.433 11 9.5V13H7.5ZM21 15V16H3V15H12H21ZM21 11V13H13V8H18C19.6569 8 21 9.34315 21 11ZM6 9.5C6 8.67157 6.67157 8 7.5 8C8.32843 8 9 8.67157 9 9.5C9 10.3284 8.32843 11 7.5 11C6.67157 11 6 10.3284 6 9.5Z"
                                                    fill="#ff3c5f"></path>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Type</p>
                                        <span>{{ config('escorts.profile.furniture_types.' . $listing->furniture_types, 'N/A') }}</span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" stroke="#000000"
                                            stroke-width="0.00024000000000000003">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M16.2451 8.29289C16.6356 7.90237 17.2688 7.90237 17.6593 8.29289C18.0498 8.68342 18.0498 9.31658 17.6593 9.70711L11.9043 15.4611C11.1232 16.242 9.85696 16.242 9.07596 15.461L7.29288 13.6779C6.90235 13.2874 6.90235 12.6542 7.29288 12.2637C7.6834 11.8732 8.31657 11.8732 8.70709 12.2637L9.78359 13.3402C10.1741 13.7307 10.8073 13.7307 11.1978 13.3402L16.2451 8.29289Z"
                                                    fill="#ff3c5f"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12 1.00195C11.0268 1.00195 10.3021 1.39456 9.68627 1.72824C9.54287 1.80594 9.40536 1.88044 9.27198 1.94605C8.49696 2.32729 7.32256 2.78014 4.93538 2.94144C3.36833 3.04732 1.97417 4.32298 2.03666 6.03782C2.13944 8.85853 2.46666 11.7444 3.12474 14.1763C3.76867 16.5559 4.78826 18.7274 6.44528 19.8321C8.02992 20.8885 9.33329 21.8042 10.2053 22.4293C11.276 23.1969 12.724 23.1969 13.7947 22.4293C14.6667 21.8042 15.97 20.8885 17.5547 19.8321C19.2117 18.7274 20.2313 16.5559 20.8752 14.1763C21.5333 11.7445 21.8605 8.8586 21.9633 6.03782C22.0258 4.32298 20.6316 3.04732 19.0646 2.94144C16.6774 2.78014 15.503 2.32729 14.728 1.94605C14.5946 1.88045 14.4571 1.80596 14.3138 1.72828C13.6979 1.39459 12.9732 1.00195 12 1.00195ZM5.07021 4.93689C7.70274 4.75901 9.13306 4.24326 10.1548 3.74068C10.4467 3.5971 10.6724 3.47746 10.8577 3.37923C11.3647 3.11045 11.5694 3.00195 12 3.00195C12.4305 3.00195 12.6352 3.11045 13.1423 3.37923C13.3276 3.47746 13.5533 3.5971 13.8452 3.74068C14.8669 4.24326 16.2972 4.75901 18.9298 4.93689C19.5668 4.97993 19.9826 5.47217 19.9646 5.965C19.865 8.70066 19.5487 11.4218 18.9447 13.6539C18.3265 15.9383 17.4653 17.4879 16.4453 18.1679C14.8385 19.2392 13.5162 20.1681 12.6294 20.8038C12.2553 21.072 11.7447 21.072 11.3705 20.8038C10.4837 20.1681 9.1615 19.2392 7.55469 18.1679C6.53465 17.4879 5.67349 15.9383 5.0553 13.6538C4.45127 11.4217 4.13502 8.70059 4.03533 5.965C4.01738 5.47217 4.43314 4.97993 5.07021 4.93689Z"
                                                    fill="#ff3c5f"></path>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Security</p>
                                        <span>{{ config('escorts.profile.Security.' . $listing->security, 'N/A') }}</span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 512 512" xml:space="preserve">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M269.62,436.454H35.557c-9.948,0-18.013,8.065-18.013,18.013c0,9.948,8.065,18.013,18.013,18.013h234.064 c9.948,0,18.013-8.065,18.013-18.013C287.633,444.519,279.569,436.454,269.62,436.454z">
                                                            </path>
                                                            <path
                                                                d="M467.635,413.673l-68.947-0.055L374.5,370.546c6.055,6.36,13.686,11.061,22.331,13.615 c4.76,1.406,9.615,2.101,14.442,2.101c8.358,0,16.635-2.088,24.182-6.194l15.469-8.415c11.909-6.479,20.581-17.206,24.419-30.206 c3.839-13,2.385-26.719-4.094-38.626l-8.414-15.467c-6.479-11.909-17.204-20.581-30.205-24.42 c-13-3.841-26.719-2.387-38.626,4.092l-15.468,8.415c-21.293,11.585-30.971,36.303-24.487,58.686l-2.602-4.634 c-0.919-1.636-1.971-3.251-3.127-4.806c-7.018-9.874-16.785-17.24-27.852-21.356c0.838-0.773,1.66-1.572,2.448-2.421 c16.656-17.927,15.624-46.063-2.294-62.727L208.672,133.931c-1.018-0.946-2.112-1.867-3.259-2.744 c-0.567-0.464-1.159-0.89-1.741-1.332c6.458-1.524,12.612-4.328,18.143-8.342c10.972-7.962,18.185-19.719,20.312-33.106 l2.764-17.393c4.39-27.635-14.522-53.691-42.157-58.083l-17.392-2.764c-27.63-4.393-53.691,14.521-58.083,42.157l-2.763,17.389 c-2.127,13.387,1.086,26.803,9.048,37.774c3.999,5.511,8.957,10.071,14.597,13.518c-5.437,1.899-10.627,4.602-15.419,8.079 c-12.874,9.344-21.339,23.141-23.844,38.91L88.412,299.599H59.554C26.716,299.599,0,326.314,0,359.152 c0,32.838,26.716,59.554,59.554,59.554l240.152-0.006l34.314,61.106c8.276,14.735,24.409,23.533,41.248,22.584l92.311,0.077 c0.01,0,0.017,0,0.025,0c24.466,0,44.381-19.898,44.396-44.367C512.016,433.62,492.114,413.691,467.635,413.673z M388.669,315.851c1.113-3.772,3.629-6.883,7.084-8.764l15.469-8.415c3.454-1.88,7.431-2.302,11.205-1.186 c3.772,1.113,6.883,3.63,8.764,7.085l8.415,15.468c1.879,3.455,2.302,7.434,1.188,11.206c-1.114,3.772-3.629,6.883-7.084,8.763 l-15.47,8.415c-3.454,1.878-7.434,2.3-11.204,1.188c-3.772-1.114-6.883-3.63-8.765-7.086l-8.415-15.468 C387.977,323.603,387.555,319.622,388.669,315.851z M160.074,75.368l2.763-17.389c1.275-8.018,8.832-13.505,16.85-12.232 l17.391,2.764c8.019,1.275,13.506,8.835,12.233,16.851l-2.764,17.393c-0.617,3.882-2.709,7.294-5.891,9.603 c-3.185,2.31-7.079,3.245-10.961,2.625l-17.391-2.763c-3.884-0.617-7.294-2.709-9.604-5.893S159.456,79.253,160.074,75.368z M144.467,173.588c0.986-6.206,4.329-11.658,9.416-15.349c5.086-3.69,11.302-5.179,17.513-4.196 c4.177,0.664,8.091,2.435,11.323,5.124c0.238,0.198,0.479,0.389,0.727,0.575c0.268,0.199,0.502,0.394,0.687,0.566L296.07,264.55 c0.005,0.005,0.011,0.01,0.016,0.014c3.382,3.143,3.577,8.449,0.436,11.831c-3.141,3.383-8.449,3.576-11.803,0.461 l-70.183-65.454c-4.883-4.554-11.882-6.032-18.189-3.845c-6.307,2.188-10.886,7.685-11.899,14.284l-11.94,77.759h-47.636 L144.467,173.588z M256.286,299.599h-47.333l5.929-38.614L256.286,299.599z M467.609,466.441c-0.001,0-0.004,0-0.005,0 l-92.891-0.077c-0.006,0-0.012,0-0.018,0c-0.443,0-0.886,0.017-1.328,0.049c-3.222,0.241-6.351-1.428-7.934-4.247l-39.476-70.298 c-3.188-5.679-9.194-9.192-15.706-9.192l-250.697,0.007c-12.974,0-23.529-10.555-23.529-23.529 c0-12.974,10.555-23.528,23.529-23.528h44.286h84.125H299.76c7.645,0,14.846,3.75,19.263,10.029 c0.118,0.168,0.238,0.334,0.363,0.497c0.257,0.34,0.476,0.67,0.651,0.983l52.399,93.306c3.186,5.674,9.184,9.188,15.691,9.192 l79.481,0.065c0,0,0,0,0.001,0c4.617,0.004,8.371,3.761,8.367,8.377C475.971,462.69,472.217,466.441,467.609,466.441z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Massage Services</p>

                                        <span>
                                            @foreach ($listing->massage_services()->where('category_id', 1)->get() as $value)
                                                @php
                                                    $massage_services .=
                                                        config('escorts.profile.massage-services')[$value->service_id] . ', ';
                                                @endphp
                                            @endforeach

                                            {{ rtrim($massage_services, ', ') }}
                                        </span>
                                    </span>
                                </div>
                                <div class="services_card">
                                    <spna class="icon">
                                        <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns:x="&amp;ns_extend;"
                                            xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="64px" height="64px" viewBox="0 0 24 24"
                                            enable-background="new 0 0 24 24" xml:space="preserve">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <metadata>
                                                    <sfw xmlns="&amp;ns_sfw;">
                                                        <slices> </slices>
                                                        <slicesourcebounds width="505" height="984"
                                                            bottomleftorigin="true" x="0" y="-120"> </slicesourcebounds>
                                                    </sfw>
                                                </metadata>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <circle cx="7" cy="12" r="2"></circle>
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <circle cx="12" cy="12" r="2"></circle>
                                                        </g>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <circle cx="17" cy="12" r="2"></circle>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </spna>
                                    <span class="details">
                                        <p>Other Service Types</p>

                                        <span>
                                            @foreach ($listing->massage_services()->where('category_id', 2)->get() as $value)
                                                @php
                                                    $other_services .=
                                                        config('escorts.profile.other-services')[$value->service_id] . ', ';
                                                @endphp
                                            @endforeach

                                            {{ rtrim($other_services, ', ') }}


                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="mc_list_about">
                                <strong>About Us</strong><br>

                                <p class="mc_list_desc">
                                    {{ Str::limit(strip_tags($listing->about_us_box), 140) }}

                                    <a href="{{ getEscortMassageDetailUrl($listing, 'massage') }}"
                                        class="read-more-link">Read More</a>
                                </p>
                            </div>

                            <div class="mc_list_address">
                                <img src="{{ asset('assets/app/img/gps.png') }}" alt="address" class="custompopicon">
                                {{ $listing->address }}
                            </div>
                        </div>


                        <!-- Open Times -->
                        <div class="tab-pane fade" id="open-times-{{ $listing->id }}" role="tabpanel"
                            aria-labelledby="open-times-tab-{{ $listing->id }}">

                            <table class="table table-striped mb-0">
                                <tbody style="text-align: left;">
                                    <?php echo get_weakly_availibility($listing); ?>
                                </tbody>

                            </table>

                        </div>

                    </div>


                   
                </div>
            </div>


        </div>
    </div>
@endforeach

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

            </div>
            <div>
                <!-- Middle Content -->
                <div class="mc_list_content">
                    <div class="mc_list_content_inner w-100">
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
                            <div class="mc_list_address">
                                <img src="{{ asset('assets/app/img/gps.png') }}" alt="address" class="custompopicon">
                                {{ $listing->address }}
                            </div>
                            @php
                                $inWishlist = in_array($listing->id, session('wishlist', []));
                            @endphp


                            <span class="list_button_wrap" id="list_button_wrap_id{{ $listing->id }}">
                                <button type="button" class="{{ $inWishlist ? 'm_removelist' : 'm_wishlist' }}"
                                    data-id="{{ $listing->id }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                        viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    {{ $inWishlist ? 'Remove from Shortlist' : 'Add to Shortlist' }}
                                </button>
                            </span>
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

                        <div class="mc_list_meta">
                            <span><strong>Parking :</strong>
                                {{ config('escorts.profile.Parking.' . $listing->parking, 'N/A') }}</span>
                            <span><strong>Entry :</strong>
                                {{ config('escorts.profile.Entry.' . $listing->entry, 'N/A') }}</span>
                            <span><strong>Shower :</strong>
                                {{ config('escorts.profile.Shower.' . $listing->parking, 'N/A') }}</span>
                        </div>

                        <div class="mc_list_meta">
                            <span><strong>Building :</strong>
                                {{ config('escorts.profile.Building.' . $listing->parking, 'N/A') }}</span>
                            <span><strong>Type :</strong>
                                {{ config('escorts.profile.furniture_types.' . $listing->furniture_types, 'N/A') }}</span>
                            <span><strong>Security :</strong>
                                {{ config('escorts.profile.Security.' . $listing->security, 'N/A') }}</span>
                        </div>

                        <div>
                            <div class="mc_list_meta">
                                <span><strong>Massage Services : </strong>

                                    @foreach ($listing->massage_services()->where('category_id', 1)->get() as $value)
                                        @php
                                            $massage_services .=
                                                config('escorts.profile.massage-services')[$value->service_id] . ', ';
                                        @endphp
                                    @endforeach

                                    {{ rtrim($massage_services, ', ') }}
                                </span>
                            </div>


                            <div class="mc_list_meta">
                                <span><strong>Other Service Types : </strong>

                                    @foreach ($listing->massage_services()->where('category_id', 2)->get() as $value)
                                        @php
                                            $other_services .=
                                                config('escorts.profile.other-services')[$value->service_id] . ', ';
                                        @endphp
                                    @endforeach

                                    {{ rtrim($other_services, ', ') }}


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
                    </div>
                </div>


                <div class="mc_list_time">
                    <div id="accordion" class="myacording-design">
                        <div class="card common-card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#about_me">
                                    Open Times
                                </a>
                            </div>
                            <div id="about_me" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table table-striped mb-0">
                                        
                                        <tbody style="text-align: left;"><?php echo get_weakly_availibility($listing); ?> </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach

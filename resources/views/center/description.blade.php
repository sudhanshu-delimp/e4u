@extends('layouts.web')
@section('content')
<div class="profile_description_banner">
    <div class="container-fluid back_to_search_btn pt-2">
        <a href="#"><img src="{{ asset('assets/app/img/leftsymbole.svg') }}"> Back to search</a>
    </div>
    <div class="container">
        <div class="profile_page_title">
            <img src="{{ asset('assets/app/img/profile/image36.png') }}">
            <h2 class="display_inline_block">{{ $escort->name}}</h2>
        </div>
        <div class="profile_page_name_and_phno">
            <p>Perth - {{ $escort->phone}} </p>
        </div>
        <div class="profile_page_location_and_id">
            <ul>
                <li>
                    <span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <p class="display_inline_block ">{{ $escort->address}}</p>
                </li>
                <li>
                    <span class="profile_location_icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <p class="display_inline_block ">Member ID: {{ $escort->user_id}}</p>
                </li>
            </ul>
        </div>
        <ul class="profile_page_social_profiles">
            <li><a href="{{ $escort->social_links['facebook']}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="{{ $escort->social_links['insta']}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="{{ $escort->social_links['twitter']}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</div>
<div class="container-fluid px-0 next-preview-fixed">
    <div class="d-flex d-flex justify-content-between">
        <div class="previous_btn_profile next_previous_btn_pogision preview-dk">
            <span class="previous_icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
            <span class="previous_text">Previous</span>
        </div>
        <div class="next_btn_profile next_previous_btn_pogision next-dk">
            <span class="previous_text">Next</span>
            <span class="previous_icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- ffffffffff -->
        <div class="col-md-8 col-xl-8 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-12 col-xl-8 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4">
                            <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                <div class="div_contain_text">
                                    <div class="profile_message">
                                        <h4>Massage</h4>
                                    </div>
                                    <div class="profile_hr">
                                        <h4>200/hr</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4">
                            <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                <div class="div_contain_text">
                                    <div class="profile_message">
                                        <h4>Incalls</h4>
                                    </div>
                                    <div class="profile_hr">
                                        <h4>100/hr</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4 mx-auto">
                            <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                <div class="div_contain_text">
                                    <div class="profile_message">
                                        <h4>Outcalls</h4>
                                    </div>
                                    <div class="profile_hr">
                                        <h4>300/hr</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4 col-sm-12 text-center">
                    <button type="button" class="btn my_legbox"><i class="fa fa-heart-o" aria-hidden="true"></i>Save to My Legbox</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 table-width-dk mb-2">
                    <table class="table table_striped">
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Massage</th>
                                <th scope="col">Incalls</th>
                                <th scope="col">Outcalls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($escort->durations as $key => $duration)
                            <tr>
                                <td>{{ $duration->name }}</td>
                                <td>{!! ($duration->pivot->massage_price) ? $duration->pivot->massage_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                </td>
                                <td>{!! ($duration->pivot->incall_price) ? $duration->pivot->incall_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                </td>
                                <td>{!! ($duration->pivot->outcall_price) ? $duration->pivot->outcall_price : "<span class='if_data_not_available'>N/A</span>" !!}
                                </td>
                            </tr>
                            @endforeach
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th class="payment_accept_text_color" scope="col" colspan="4">Payment ($AUS): Cash; Card</th>
                            </tr>
                        </thead>
                        </tbody>
                    </table>
                    <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                            <img src="{{ asset('assets/app/img/like.png') }}">
                        </div>
                        <div class="process_bar_width like_mjo">
                            <progress class="like" value="75" max="100"></progress>
                        </div>
                        <div class="display_persantage">
                            <p>70%</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 table-width-dk">
                    <table class="table table_striped mb-0">
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th scope="col">Arriving</th>
                                <th scope="col">Departing</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>25th May 2019</td>
                                <td>1st June 2019</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table_striped">
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th scope="col">Day</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Monday</td>
                                <td>
                                    {{ $availability->monday_from }} - {{ $availability->monday_to}}
                                </td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td>1:00 pm - 5:00 pm</td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>1:00 pm - 5:00 pm</td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td>1:00 pm - 5:00 pm</td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td>1:00 pm - 5:00 pm</td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td>1:00 pm - 5:00 pm</td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td>1:00 pm - 5:00 pm</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                            <img src="{{ asset('assets/app/img/dislike.png') }}">
                        </div>
                        <div class="process_bar_width dislike_mjo">
                            <progress class="dislike" value="75" max="100"></progress>
                        </div>
                        <div class="display_persantage">
                            <p>70%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>About me</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Gender:</span> <span class="about_box_small_heading_value">@if($escort->gender == 0) Female @elseif($escort->gender == 1) Male @else Other @endif</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Nationality:</span> <span class="about_box_small_heading_value"> {{ $escort->country->name}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Statistics:</span> <span class="about_box_small_heading_value">{{ $escort->statistics}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Height:</span> <span class="about_box_small_heading_value"> {{ $escort->height}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Eyes:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.eye-colors.$escort->eyes") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Shaved:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.eye-colors.$escort->shaved") }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Orientation:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.orientation.$escort->orientation") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Age:</span> <span class="about_box_small_heading_value">{{ $escort->age}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Hair Colour:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.heai-color.$escort->hair_color") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Skin tone:</span> <span class="about_box_small_heading_value">{{ $escort->skin_tone}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Breast:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.skin-tone.$escort->breast")}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Contact me:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.contact-me.$escort->contact") }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Ethnicity:</span> <span class="about_box_small_heading_value">{{ $escort->ethnicity}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Body type:</span> <span class="about_box_small_heading_value"> {{ $escort->body_type}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Hair style:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hair-style.$escort->hair_style")}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Weight:</span> <span class="about_box_small_heading_value">{{ $escort->weight}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Dress size:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.dress-size.$escort->dress_size")}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Language:</span>
                                @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span id="y" class="about_box_small_heading_value">Read more&gt;&gt;</span>
                        </div>
                    </div>
                    <div class="hide_data">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Piercing:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.piercing.$escort->piercing") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Drugs:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.drugs.$escort->drugs") }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Tattoos:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.tattooes.$escort->tattoos") }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Smoke:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.smokes.$escort->smoke") }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Play types:</span> @foreach($escort->play_type as $playtype)<span class="about_box_small_heading_value">{{ config("escorts.profile.play-types.$playtype") }} </span>@endforeach
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Payment:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.payments.$escort->payment_type") }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="padding_and_border_for_read_more_section mt-2">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Languages:</span> @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach
                                    </div>
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Travel:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.travels.$escort->travel") }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Available to:</span> <span class="about_box_small_heading_value">{{ $escort->available_to }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">SWA License:</span> <span class="about_box_small_heading_value">{{ $escort->license}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>Who Am I?</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    {{ $escort->about }}
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>My Service</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <p>Check out what I enjoy the most with you in private. Let's have some fun. Feel free to ask me any questions about my services.</p>
                    <div class="accordion-container">
                        <div class="set">
                            <a>
                            On You - Fun Stuff
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="content">
                                <div class="accodien_manage_padding_content">
                                    <div class="table-responsive">
                                        <div class="row margin_zero_for_table">
                                            <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                <table class="table table_border_dash">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($services_one as $key => $service)
                                                        <tr>
                                                            <td class="table_border_dash_left">{{ $service->name }}</td>
                                                            <td class="table_border_solid_left"></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                <table class="table table_border_dash">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($services_two as $key => $service)
                                                        <tr>
                                                            <td class="table_border_dash_left">{{ $service->name }}</td>
                                                            <td class="table_border_solid_left"></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12 padding_none">
                                                <table class="table table_border_dash">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($services_three as $key => $service)
                                                        <tr>
                                                            <td class="table_border_dash_left">{{ $service->name }}</td>
                                                            <td class="table_border_solid_left"></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--<div class="col-md-4 padding_none">
                                                <table class="table table_border_dash">
                                                 <thead>
                                                     <tr class="background_color_table_head_color">
                                                         <th scope="col">Description</th>
                                                         <th scope="col">Extra</th>
                                                       </tr>
                                                 </thead>
                                                 <tbody>
                                                     <tr>
                                                        <td class="table_border_solid_right table_border_dash_left">BJ - natural</td>
                                                         <td class="table_border_dash_left">$ 50</td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Cum in mouth</td>
                                                         <td>$ 50</td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Deep throat</td>
                                                         <td></td>
                                                       </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Fingering</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Kissing</td>
                                                         <td></td>
                                                         </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Massage Prostate</td>
                                                         <td></td>
                                                       </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Masturbation</td>
                                                         <td></td>
                                                       </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Nipple Sucking</td>
                                                         <td></td>
                                                       </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Reverse oral (69)</td>
                                                         <td></td>
                                                   </tr>
                                                     <tr>
                                                        <td class="table_border_solid_right table_border_dash_left">Sexy Lingerie</td>
                                                         <td></td>
                                                   </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Stiptease</td>
                                                         <td></td>
                                                       </tr>
                                                 </tbody>
                                                </table>
                                                </div>
                                                <div class="col-md-4 padding_none">
                                                <table class="table table_border_dash">
                                                 <thead>
                                                     <tr class="background_color_table_head_color">
                                                         <th scope="col">Description</th>
                                                         <th scope="col">Extra</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">BJ - Protected</td>
                                                         <td class="table_border_dash_left"></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Cum over body</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Face sit - arse</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">GFE</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Kissing - French</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Massage Tantric</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Multiple Positions</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Oral</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Rimming</td>
                                                         <td>$50</td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Shared Shower</td>
                                                         <td></td>
                                                     </tr>
                                                     <tr>
                                                         <td class="table_border_solid_right table_border_dash_left">Uniforms</td>
                                                         <td></td>
                                                     </tr>
                                                 </tbody>
                                                </table>
                                                </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="set">
                            <a>
                            On You - Kinky Stuff
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="content">
                                <div class="accodien_manage_padding_content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                                </div>
                            </div>
                        </div>
                        <div class="set">
                            <a>
                            On Me
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="content">
                                <div class="accodien_manage_padding_content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>Reviews</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item carousel-item-next carousel-item-left">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap_between_text_and_img">
                                            <div class="manage_testimonials_profile_img">
                                                <img src="{{ asset('assets/app/img/profile/testmonialbyimg.png') }}">
                                            </div>
                                            <div class="testimonial_by">Sierra</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="star-rating star-align-dk">
                                            <ul class="list-inline">
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                                <li class="list-inline-item testi_icon_color"><b class="">3.5</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum idac nisl bibendum scelerisque non non.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item active carousel-item-left">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap_between_text_and_img">
                                            <div class="manage_testimonials_profile_img">
                                                <img src="{{ asset('assets/app/img/profile/testmonialbyimg.png') }}">
                                            </div>
                                            <div class="testimonial_by">Sierra</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="star-rating star-align-dk">
                                            <ul class="list-inline">
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item testi_icon_color"><i class="fa fa-star-o"></i></li>
                                                <li class="list-inline-item testi_icon_color"><b class="">3.5</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum idac nisl bibendum scelerisque non non.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel controls -->
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn add_reviews_btn"><img src="{{ asset('assets/app/img/feedbackicon.png') }}">Add Reviews</button>
                            </div>
                            <div class="col-md-6">
                                <div class="arroww">
                                    <a class="carousel-control-prev manage_oprcity" href="#myCarousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="carousel-control-next manage_oprcity" href="#myCarousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ffffffffff -->
        <!-- sssssssssssssssss -->
        <div class="col-md-4 profile-sidebar-margin-top">
            <!-- video crousal start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-0">
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-interval="10000">
                                    <div class="row">
                                        <div class="col-6 remove_padding_for_carousel">
                                            <img src="{{ asset('assets/app/img/one.jpg') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                        <div class="col-6 remove_padding_for_carousel">
                                            <img src="{{ asset('assets/app/img/one.jpg') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-interval="10000">
                                    <div class="row">
                                        <div class="col-6 remove_padding_for_carousel">
                                            <img src="{{ asset('assets/app/img/one.jpg') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                        <div class="col-6 remove_padding_for_carousel">
                                            <img src="{{ asset('assets/app/img/one.jpg') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-interval="10000">
                                    <div class="row">
                                        <div class="col-6 remove_padding_for_carousel">
                                            <img src="{{ asset('assets/app/img/one.jpg') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                        <div class="col-6 remove_padding_for_carousel">
                                            <img src="{{ asset('assets/app/img/one.jpg') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-4 col-lg-4 padding4-left">
                                                        <div class="video-gallery-popup">
                                                            <img src="{{ asset('assets/app/img/profile/girl.jpg') }}" class="object-fit img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-8 col-lg-8 ">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 padding15-bottom">
                                                                <div class="video-gallery-popup">
                                                                    <img src="{{ asset('assets/app/img/profile/girl-horizontal.png') }}" style="width: 100%;
                                                                        height: 370px;
                                                                        object-fit: cover;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex no-padding">
                                                                <div><img src="{{ asset('assets/app/img/profile/girl.jpg') }}" class="img-fluid full-img"></div>
                                                                <div><img src="{{ asset('assets/app/img/profile/girl3.jpg') }}" class="img-fluid full-img"></div>
                                                                <div><img src="{{ asset('assets/app/img/profile/girl4.jpg') }}" class="img-fluid full-img"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- video crousal end -->
            <div class="row pt-2">
                <div class="col-5">
                    <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#mysendmessage">
                    <img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Message Me</button>
                </div>
                <div class="col-7 text-right">
                    <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#sendcarlat"><img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Report Advertiser</button>
                </div>
            </div>
            <!-- accordien start here -->
            <div class="accordion-container">
                <div class="set">
                    <a>
                    My Pricing Policy
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            {!! $escort->pricing_policy !!}
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                    Disclaimer
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            {!! $escort->disclaimer !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- accordien end here -->
            <!-- tip section start here -->
            <div class="box_shadow padding_twelve_px">
                <div class="profile_card_border profile_description_contect position-relative">
                    <h2><img src="{{ asset('assets/app/img/informationtip.svg') }}"> Tips</h2>
                    <!-- Carousel controls start-->
                    <div class="arroww_tip_crousal">
                        <a class="carousel-control-prev manage_oprcity next-01" href="#tipcrousal" data-slide="prev">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                        <!--number indicatert start here -->
                        <div class="num-01 indicator_align_between_aero_center"></div>
                        <!--number indicatert end here -->
                        <a class="carousel-control-next manage_oprcity prev-01" href="#tipcrousal" data-slide="next">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                    <!-- Carousel controls end-->
                </div>
                <div class="pt-2">
                    <div id="tipcrousal" class="carousel slide carousel_remove_in_tip" data-ride="carousel" data-interval="false">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item tip_carousel_item_text active item-01">
                                <p>Avoid using email, use our messenging centre.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Avoid using email, use our messenging centre.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tip section end here -->
            <!-- jkjkgjkhf -->
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_description_contect">
                    <h2><img src="{{ asset('assets/app/img/bedroom.svg') }}"> Playmates</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <p class="profile_description_contect_pera">Message me to arrange a play date.</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile/profile_photo.png') }}"></div>
                                <p class="suggase_profile_name">Sierra</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile/profile_pictwo.png') }}"></div>
                                <p class="suggase_profile_name">Vivviene</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- jkjkgjkhf -->
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_description_contect">
                    <h2>Contacting Us</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <span class="span_display_block connecting_me_chat_phone">You can contact us by: <img src="{{ asset('assets/app/img/wechat.svg') }}"> or <img src="{{ asset('assets/app/img/phoneicon.svg') }}"></span>
                    <b>When texting me please say:</b>
                    <p class="profile_description_contect_pera">
                        i [name of Advertiser], I found you on Escorts4u ..." on our number {{ $escort->phone}}
                    </p>
                </div>
            </div>
        </div>
        <!-- sssssssssssssssss -->
    </div>
</div>
<!-- model start here 1-->
<div class="modal fade ss" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Send New Harmony Nature Massage a message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <form id="messageMe" action="{{ route('store.message',[$escort->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Mobile</label>
                                <input type="text" placeholder="Mobile number" maxlength="10" step="100"
                                    data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                    data-parsley-type="number" class="form-control" name="phone" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model end here 1-->
<!-- model start here 2-->
<div class="modal fade ss" id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/feedbackpoup.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report Carla Brasil </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="popu_heading_style">Notes</p>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>Only review if you had direct contact with escort</li>
                                <li>Do not write fake or abusive reviews, they will not be pusnished</li>
                                <li>To contact this escort, click on send message [link to message modal] </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">Your Review</label>
                                <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <p class="diff_font_pera mb-0">Tell us ...</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="1">
                                <span class="form-check-label" for="exampleRadios2">
                                Real Photos
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="0">
                                <span class="form-check-label" for="exampleRadios2">
                                Fake Photos
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary">Post Reviews</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script>
    $('#messageMe').parsley({

    });
    $('#messageMe').on('submit', function(e) {

        var form = $(this);
        if (form.parsley().isValid()) {
            var url = form.attr('action');
            var data = new FormData();
            data.append('_token',$('input[name="_token"]').val());
            e.preventDefault();

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#messageMe')[0].reset();
                        setTimeout(function(){
                        $('#mysendmessage').modal('hide');
                        }, 1000);

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#messageMe')[0].reset();
                        setTimeout(function(){
                        $('#mysendmessage').modal('hide');
                        }, 1000);
                    }
                }
            });
        }
    });
    $('#reviewAdvertiser').on('submit',function(e){
        e.preventDefault();
        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData($('#reviewAdvertiser')[0]);
            console.log(data);

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#reviewAdvertiser')[0].reset();
                        setTimeout(function(){
                        $('#sendcarlat').modal("hide");
                        }, 1000);
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#reviewAdvertiser')[0].reset();
                        setTimeout(function(){
                        $('#sendcarlat').modal("hide");
                    }, 1000);
                    }
                }
            });
    }
    });

</script>
@endpush

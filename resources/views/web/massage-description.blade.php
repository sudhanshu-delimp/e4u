@extends('layouts.web')
@section('content')
<div class="profile_description_banner" style="background: url( {{ $escort->imagePosition(9) ? asset($escort->imagePosition(9)) : asset('assets/app/img/profiledescrition.png')}});">
    <div class="container-fluid back_to_search_btn pt-2">
        <a href=""><img src="{{ asset('assets/app/img/leftsymbole.svg') }}"> Back to search</a>
    </div>
    <div class="container">
        <div class="profile_page_title">
            <h2 class="display_inline_block p-0">{{ $escort->name}}</h2>
        </div>
        <div class="profile_page_name_and_phno">
            <p>{{$escort->city ? $escort->city->name: ''}} - {{ $escort->phone}}</p>
        </div>
        <div class="profile_page_location_and_id">
            <ul>
                <li>
                    <span class="profile_location_icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <p class="display_inline_block ">{{ $escort->address}} </p>
                </li>
                <li>
                    <span class="profile_location_icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <p class="display_inline_block ">Member ID: {{ $escort->member_id}}</p>
                </li>
            </ul>
        </div>
        <ul class="profile_page_social_profiles">
            <li><a href="//{{ $escort->social_links ? $escort->social_links['facebook'] : null }}" target="_blanck"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="//{{ $escort->social_links ? $escort->social_links['insta'] : null }}" target="_blanck"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="//{{ $escort->social_links ? $escort->social_links['twitter'] : null }}" target="_blanck"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</div>
<div class="container-fluid px-0 next-preview-fixed">
    <div class="d-flex d-flex justify-content-between">
        <div class="previous_btn_profile next_previous_btn_pogision preview-dk">
            <a href="{{ $previous}}" class="text-decoration-none">
            <span class="previous_icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
            <span class="previous_text remove_in_sm">Previous</span>
            </a>
        </div>
        <div class="next_btn_profile next_previous_btn_pogision next-dk">
            <a href="{{ $next}}" class="text-decoration-none">
            <span class="previous_text remove_in_sm">Next</span>
            <span class="previous_icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
            </a>
        </div>
    </div>
</div>
<div class="container profile_contain">
    <div class="row">
        <!-- ffffffffff -->
        <div class="col-md-8 col-xl-8 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-12 col-xl-8 col-sm-12 col-12">
                    <div class="row mess_row">
                        <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4">
                            <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                <div class="div_contain_text">
                                    <div class="profile_message">
                                        <h4>Massage</h4>
                                    </div>
                                    @php $services = $escort->durations()->where("name", "1 Hour")->first(); @endphp
                                    <div class="profile_hr">
                                        <h4>{{$services->pivot->massage_price ? $services->pivot->massage_price."/hr" : ''}} </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4">
                            <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                <img src="{{ asset('assets/app/img/areodownimg.png') }}">
                                <div class="div_contain_text">
                                    <div class="profile_message">
                                        <h4>Individual</h4>
                                    </div>
                                    <div class="profile_hr">
                                        <h4>{{$services->pivot->incall_price ? $services->pivot->incall_price."/hr" : ''}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-6 col-6 mb-4 mx-auto">
                            <div class="d-flex align-items-center justify-content-center manage_gap_text_img-profile">
                                <img src="{{ asset('assets/app/img/aeroupimg.png') }}">
                                <div class="div_contain_text">
                                    <div class="profile_message">
                                        <h4>2+ Person</h4>
                                    </div>
                                    <div class="profile_hr">
                                        <h4>{{$services->pivot->outcall_price ? $services->pivot->outcall_price."/hr" : ''}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4 col-sm-12 text-center">
                    <button type="button" class="btn my_legbox all_btn_flx">
                    {{-- <span class="add_to_favrate"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                    Save to My Legbox</button> --}}
                    @if(auth()->user())
                        @if(auth()->user()->type === 0)
                            <span class="add_to_favrate @if(in_array($escort->id,$user_type->massageCenterLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}" data-name="{{$escort->name}}">
                                @if(!empty($user_type))
                                    @if(in_array($escort->id,$user_type->massageCenterLegBox->pluck('id')->toArray()))
                                        <i class='fa fa-heart' style='color: #ff3c5f;' title="Remove from Legbox" aria-hidden='true'></i>
                                    @else
                                        <i class="fa fa-heart-o" title="Add to Legbox" aria-hidden='true'></i>
                                    @endif
                                @endif
                            </span>
                        @else
                            <span class="add_to_favrate" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i></span>
                        @endif
                        Save to My Legbox</button>
                    @else
                    <span class="add_to_favrate"  data-escortId="{{$escort->id}}" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true" title="Removed from Legbox"></i></span>Save to My Legbox</button>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 table-width-dk mb-2">
                    <div style="width: 100%"><iframe width="100%" height="153" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=nema%20san%20francisco+()&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" style="
                        filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
                        "></iframe></div>
                    <table class="table table_striped">
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th scope="col">Rates</th>
                                <th scope="col">Massage</th>
                                <th scope="col">Individual</th>
                                <th scope="col">2+ Person</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($escort->durations))
                            @foreach($escort->durations as $key => $duration)
                            <tr>
                                <td>{{ $duration->name == "1 Hour" ? "60 Minutes" : $duration->name }}</td>
                                <td>{!! ($duration->pivot->massage_price) ? '$ '.$duration->pivot->massage_price : "<span class='na-label'>N/A</span>" !!}
                                </td>
                                <td>{!! ($duration->pivot->incall_price) ? '$ '.$duration->pivot->incall_price : "<span class='na-label'>N/A</span>" !!}
                                </td>
                                <td>{!! ($duration->pivot->outcall_price) ? '$ '.$duration->pivot->outcall_price : "<span class='na-label'>N/A</span>" !!}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            {{--
                            <tr>
                                <td>30 Minutes</td>
                                <td><span class="na-label">N/A</span></td>
                                <td>$ 10.00</td>
                                <td><span class="na-label">N/A</span></td>
                            </tr>
                            <tr>
                                <td>45 Minutes</td>
                                <td>$ 20.00</td>
                                <td>$ 10.00</td>
                                <td>$ 10.00</td>
                            </tr>
                            <tr>
                                <td>60 Minutes</td>
                                <td>$ 20.00</td>
                                <td>$ 10.00</td>
                                <td>$ 10.00</td>
                            </tr>
                            --}}
                        </tbody>
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th class="payment_accept_text_color" scope="col" colspan="4">Payment ($AUS): {{ config("escorts.profile.Security.$escort->security")}}</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                            {{-- {{ dd($escortLike)}} --}}
                            <i class="{{ $massageLike && $massageLike->like == 1 ? 'fa fa-thumbs-up' : 'fa fa-thumbs-o-up'}}" id="like" title="like" aria-hidden="true"></i>
                            <!-- <img class="likeImg" id="like" value='1' src="{{ asset('assets/app/img/like.png') }}"> -->
                        </div>
                        <div class="process_bar_width like_mjo">
                            <progress class="like" value="{{$lp}}" max="100"></progress>
                        </div>
                        <div class="display_persantage">
                            <p id="like_per">{{$lp}}%</p>
                        </div>
                    </div>
                    {{-- <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                            <img src="{{ asset('assets/app/img/like.png') }}">
                        </div>
                        <div class="process_bar_width like_mjo">
                            <progress class="like" value="75" max="100"></progress>
                        </div>
                        <div class="display_persantage">
                            <p>70%</p>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-6 col-md-12 table-width-dk">
                    <!-- <table class="table table_striped mb-0">
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
                        </table> -->
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
                                    @if(!empty($availability->availability_time['monday']))
                                    {{ $availability->availability_time['monday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->monday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->monday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td>
                                    @if(!empty($availability->availability_time['tuesday']))
                                    {{ $availability->availability_time['tuesday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->tuesday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->tuesday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>
                                    @if(!empty($availability->availability_time['wednesday']))
                                    {{ $availability->availability_time['wednesday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->wednesday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->wednesday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td>
                                    @if(!empty($availability->availability_time['thursday']))
                                    {{ $availability->availability_time['thursday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->thursday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->thursday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td>
                                    @if(!empty($availability->availability_time['friday']))
                                    {{ $availability->availability_time['friday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->friday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->friday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td>
                                    @if(!empty($availability->availability_time['saturday']))
                                    {{ $availability->availability_time['saturday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->saturday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->saturday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td>
                                    @if(!empty($availability->availability_time['sunday']))
                                    {{ $availability->availability_time['sunday'] }}
                                    @else
                                    {{ ($availability) ?  Carbon\Carbon::parse($availability->sunday_from)->format('g:i A'): '' }} - {{ ($availability) ? Carbon\Carbon::parse($availability->sunday_to)->format('g:i A') : ''}}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                        <i class="{{ $massageLike && $massageLike->like == 0 ? 'fa fa-thumbs-down' : 'fa fa-thumbs-o-down'}} " id="dislike" title="dislike" aria-hidden="true"></i>
                            <!-- <img class="likeImg" id="dislike" value='0' src="{{ asset('assets/app/img/dislike.png') }}"> -->
                        </div>
                        <div class="process_bar_width dislike_mjo">
                            <progress class="dislike" value="{{$dp}}" max="100"></progress>
                        </div>
                        <div class="display_persantage">
                            <p id="dis_per">{{$dp}}%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>About me</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <span class="about_box_small_heading">Building:</span>
                                <span class="about_box_small_heading_value">{{ config("escorts.profile.Building.$escort->building")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Parking:</span>
                                <span class="about_box_small_heading_value">{{ config("escorts.profile.Parking.$escort->parking")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Entry:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.Entry.$escort->entry")}}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <span class="about_box_small_heading">Type:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.furniture_types.$escort->furniture_types")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Shower:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.Shower.$escort->shower")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Ambiance:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.Ambiance.$escort->ambiance")}}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <span class="about_box_small_heading">Security:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.Security.$escort->security")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Payment:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.Payment.$escort->payment")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Loyalty program:</span>
                                <span class="about_box_small_heading_value">{{config("escorts.profile.Loyalty.$escort->loyalty")}}</span>
                            </div>
                            <div class="">
                                <span class="about_box_small_heading">Languages:</span>
                                @if(!empty($escort->language))  @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-2">
                            <p class="mb-0"><span class="about_box_small_heading">Address:</span> <span class="about_box_small_heading_value"> {{$escort->address}} </span></p>
                            {{--
                            <p class="mb-0"><span class="about_box_small_heading">Contact Us:</span> <span class="about_box_small_heading_value">Phone; Text; Email</span></p>
                            --}}
                            <p class="mb-0"><span class="about_box_small_heading">Massage Service:</span>
                                <span class="about_box_small_heading_value">
                                @foreach ($escort->massage_services()->where('category_id', 1)->get() as $value)
                                {{config('escorts.profile.massage-services')[$value->service_id]  }};
                                @endforeach
                                {{-- Aromotherapy; Remedial; Deep tissue; Sports; Reflexology; Shiatsu; Hot stone; Trigger point; Swedish; Nuru; Thai; Couples --}}
                                </span>
                            </p>
                            <p><span class="about_box_small_heading">Other Service Types:</span>
                                <span class="about_box_small_heading_value">
                                @foreach ($escort->massage_services()->where('category_id', 2)->get() as $value)
                                {{config('escorts.profile.other-services')[$value->service_id]  }};
                                @endforeach
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>Who Am I?</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <div class="padding_20_tob_btm_side">
                        {{$escort->about}}
                        {{--
                        <p class="who_we_are_sub_heading">New Harmony Nature Massage in the Perth CBD -Come And Relax</p>
                        <p>Welcome everyone to the Perth CBD harmony nature massage shop where we have new Taiwan ladies working everyday. We will definitely be able to service your needs so if you have some spare time and want to relax, there is no better way to do this than by having a massage at the Harmony Nature Massage for the perfect cure.</p>
                        <p>We understand the stress that an individual goes through on a daily basis. Come and visit us and let us bring to you our relaxation therapy we have developed for your every need . Absolutely the best massage around.</p>
                        --}}
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>Our Masseurs</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <p>Check out our experienced masseurs. All services are conducted in private. Feel free to ask us or any of our masseurs any questions about our services.</p>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img our-masseurs" data-toggle="modal" data-target="#product_view">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="d-flex align-items-center gap_between_text_and_img">
                                <div class=""><img src="{{ asset('assets/app/img/profile_photo.png') }}"></div>
                                <p>Sierra</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>Reviews</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item">
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
                            <div class="carousel-item active">
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
                                <button type="button" class="btn add_reviews_btn all_btn_flx" data-toggle="modal" data-target="#add_reviews">
                                <img src="{{ asset('assets/app/img/feedbackicon.png') }}"> Add Reviews
                                </button>
                            </div>
                            <div class="col-md-6">
                                <div class="arroww next_prev">
                                    <a class="carousel-control-prev manage_oprcity" href="#myCarousel" data-slide="prev">
                                    <img src="{{ asset('assets/app/img/prev.svg') }}">
                                    </a>
                                    <a class="carousel-control-next manage_oprcity" href="#myCarousel" data-slide="next">
                                    <img src="{{ asset('assets/app/img/next.svg') }}">
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
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" data-interval="false">
                            <div class="carousel-inner">

                                @if($escort->gallary->isNotEmpty())

                                    @foreach($escort->gallary()->wherePivotIn('position',[1,2,3,4,5,6,7])->get() as $key=>$media)

                                        <div class="carousel-item {{($key == 0) ? "active" : ""}} " data-interval="10000">
                                            {{-- @if($media->pivot->position != 9 && $media->pivot->position != 8 && $media->pivot->position != 10) --}}
                                            <div class="row">
                                                <div class="col-12 remove_padding_for_carousel">
                                                    <img src="{{ asset($media->path) }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal" data-id="">
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                        </div>

                                    @endforeach
                                    @else
                                    <div class="carousel-item active " data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="{{ asset('assets/app/img/service-provider/Frame-408.png') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            {{-- {{dd($escort->medias)}} --}}
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content border-0">
                                        <div class="modal-header border-0">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                            <div class="col-12">
                                                <ul class="nav nav-tabs justify-content-center border-0">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">All</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu1-tab" data-toggle="tab" href="#menu1">Photos</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu2">Videos</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="row m-n2">
                                                        <div class="col-lg-5 px-md-2 py-md-2 left-video-sec">
                                                            <video width="100%" height="240" controls="">
                                                                <source src="e4u2/public/" type="video/mp4">
                                                                <source src="movie.ogg" type="video/ogg">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                        <div class="col-lg-7 px-md-2 py-md-2 right-side-img">
                                                            <div class="row m-n2">
                                                                <div class="col-lg-12 px-md-2 py-md-2 right-top-im">
                                                                    <img src="{{ asset('assets/app/img/profiledescrition.png') }}" class="img-fluid">
                                                                </div>
                                                                <div class="col-lg-4 px-md-2 py-md-2 right-bott-im">
                                                                    <img src="{{ asset('escorts/attatchment/images/42/frame-409.png') }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                                                    <div class="row m-n2 right-side-img">
                                                        <div class="col-lg-12 px-md-2 py-md-2 right-top-im">
                                                            <img src="{{ asset('escorts/attatchment/images/42/frame-409.png') }}" class="img-fluid">
                                                        </div>
                                                        <div class="col-sm-6 col-md-4 col-lg-3 px-md-2 py-md-2 right-bott-im1">
                                                            <img src="{{ asset('escorts/attatchment/images/42/frame-409.png') }}" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                                                    <div class="row m-n2  left-video-sec">
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
        <div class="row pt-2 eqal-bx">
            <div class="col-5">
                <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#mysendmessage">
                <img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Message Me</button>
            </div>
            <div class="col-7 text-right">
                <button type="button" class="btn profile_message_btn_cc" data-toggle="modal" data-target="#sendcarlat"><img src="{{ asset('assets/app/img/messageicon.png') }}" class="image_20px_msg">Report Advertiser</button>
            </div>
        </div>
        <input type="hidden" name="escortId" value="{{auth()->user() ? auth()->user()->id : null}}" id="eid">
        <!-- accordien start here -->
        <!-- accordien end here -->
        <!-- jkjkgjkhf -->
        <div class="box_shadow manage_padding_margin_bg_color">
            <div class="profile_card_border profile_description_contect">
                <h2><img src="{{ asset('assets/app/img/contact_me.svg') }}"> Contacting me</h2>
            </div>
            <div class="padding_20_tob_btm_side reduse_pad">
                <span class="span_display_block connecting_me_chat_phone">You can contact me by: <img src="{{ asset('assets/app/img/wechat.svg') }}"> or <img src="{{ asset('assets/app/img/phoneicon.svg') }}"></span>
                <br>
                <b>When texting me please say:</b>
                <p class="profile_description_contect_pera pt-2">
                    Hi {{ $escort->name}}, I found you on Escorts4u ..." on our number {{ $escort->phone}}.
                </p>
            </div>
        </div>
    </div>
    <!-- sssssssssssssssss -->
</div>
</div>
<!-- model start here 1-->
<div class="modal fade" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Send New Harmony Nature Massage a message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 teop-text">
                <p class="popu_heading_style">Note:-</p>
                <ol class="mb-0">
                    <li>The Escort needs to have this feature enabled in order to receive it.</li>
                    <li>You will receive a notification when thismessage is responded to.</li>
                </ol>
            </div>
            <form id="messageMe" action="{{ asset('store-message/42') }}" method="post" novalidate="">
                <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
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
                                <input type="text" placeholder="Mobile number" maxlength="10" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="number" class="form-control" name="phone">
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
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report  nanshi 102 to our team.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="#" method="post">
                <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
                <div class="modal-body">
                    <p class="popu_heading_style">Notes</p>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>Only report if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reports, as it may result in your Account being suspended. Only genuine reports will be considered.</li>
                                <li>The Profile page URL will automatically attach to this report.</li>
                                <li>You will receive a notification when this report has been resolved. </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">What is wrong:</label>
                                <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3" placeholder="Message (250 characters)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex  align-items-center">
                                <p class="diff_font_pera mb-0 mr-2">Why are you reporting this Profile:</p>
                                <div class="form-check py-0 mr-2">
                                    <input class="form-check-input" type="checkbox" name="photo_status" id="exampleRadios2" value="1">
                                    <span class="form-check-label" for="exampleRadios2">
                                    Fake Media
                                    </span>
                                </div>
                                <div class="form-check py-0 mr-2">
                                    <input class="form-check-input" type="checkbox" name="photo_status" id="exampleRadios2" value="0">
                                    <span class="form-check-label" for="exampleRadios2">
                                    Spam
                                    </span>
                                </div>
                                <div class="form-check py-0">
                                    <input class="form-check-input" type="checkbox" name="photo_status" id="exampleRadios2" value="2">
                                    <span class="form-check-label" for="exampleRadios2">
                                    Other
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn main_bg_color site_btn_primary">Forward Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model start here 3-->
<div class="modal fade add_reviews" id="add_reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Add review for Carla Brasil
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="#" method="post">
                <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
                <div class="modal-body">
                    <p class="popu_heading_style mb-2">Note</p>
                    <div class="row">
                        <div class="col teop-text">
                            <ul>
                                <li>Only review if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reviews, as they will not be published.</li>
                                <li>To contact this Escort click on <span style="color: #FF3C5F;">Message Me</span>.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group popup_massage_box">
                                <label for="exampleFormControlTextarea1">Tell us about your experience:</label>
                                <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="3" placeholder="Message (250 characters)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="revew-myratings">
                        <p class="mb-0">Rating:</p>
                        <div class="rating">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
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
<!-- model start here 1-->
<div class="modal fade" id="newmodal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Send New Harmony Nature Massage a message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 teop-text">
                <p class="popu_heading_style">Note:-</p>
                <ol class="mb-0">
                    <li>The Escort needs to have this feature enabled in order to receive it.</li>
                    <li>You will receive a notification when thismessage is responded to.</li>
                </ol>
            </div>
            <form id="messageMe" action="#" method="post">
                <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
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
                                <input type="text" placeholder="Mobile number" maxlength="10" step="100" data-parsley-validation-threshold="1" data-parsley-trigger="keyup" data-parsley-type="number" class="form-control" name="phone">
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
<div class="modal fade product_view" id="product_view">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-4 mb-2 pt-1">
                <div class="row">
                    <div class="col-md-4 product_img pr-0">
                        <img src="{{ asset('assets/app/img/Frame-4181.png')}}" class="img-responsive" style="width: 305px;height: 374px;object-fit: cover;">
                    </div>
                    <div class="col-md-1 product_img pl-0" style="display: grid;gap: 8px;">
                        <img src="{{ asset('assets/app/img/Frame-4201.png')}}" class="img-responsive" style="width: 108px;height: 119px;object-fit: cover;">
                        <img src="{{ asset('assets/app/img/Frame-4211.png')}}" class="img-responsive" style="width: 108px;height: 119px;object-fit: cover;"><img src="{{ asset('assets/app/img/Frame-4222.png')}}" class="img-responsive" style="width: 108px;height: 119px;object-fit: cover;">
                    </div>
                    <div class="col-md-7 product_content pl-5 pt-1" style="">
                        <div class="row pb-4">
                            <div class="col-md-5">
                                <div class="free_profile_name_and_color profile-text">Jane Doe</div>
                            </div>
                            <div class="col-md-4 pr-1 pt-1">
                                <div class="age" style="text-align: end;">
                                    <span class="margin_and_font_size_color_for_free">AGE:</span><span class="free_profile_age_color_and_font mr-3">21</span>
                                    <div class="d-inline video_icon">
                                        <a href="#">
                                        <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 pt-1">
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
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td>Available Time: <span class="about_box_small_heading_value">8am - 7pm</span></td>
                                    <td>Nationality: <span class="about_box_small_heading_value">Australian</span></td>
                                </tr>
                                <tr>
                                    <td>Types: <span class="about_box_small_heading_value">Thai</span></td>
                                    <td>Available Days:<span class="about_box_small_heading_value"> M T W TH F</span></td>
                                </tr>
                                <tr>
                                    <td>Mobile Number: <span class="about_box_small_heading_value"> 0438 028 728</span></td>
                                    <td>Vaccine:<span class="about_box_small_heading_value"> Vaccinated, up to date</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="pt-4">Hi everyone, I am Melani and I am here in Perth for all those guys who enjoy the thrill of being with that quite little girl who secretely really is that office slut. I am tall, slim and naughty when it matters. With smooth skin and long hair to run your hands through, and of course something...</p>
                        <h5> <img src="{{ asset('assets/app/img/Vector-31.png')}}" class="img-responsive" style="margin-top: -6px;"> Member ID: E4U152021 -001 </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal hh" id="my_legbox" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">My Legbox</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                    <span id="Lname">Please log in or Register to access your Legbox</span>
                </h1>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <a href="{{ route('viewer.login') }}" type="button" class="btn main_bg_color site_btn_primary" id="loginUrl" >Login</a>
                <a href="{{ route('register') }}" type="button" class="btn main_bg_color site_btn_primary" id="regUrl" style="width: 26%;">Register</a>
            </div>

        </div>
    </div>
</div>
<!-- model end here 1-->
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

<script type="text/javascript">
    $('#like').click(function() {
        var id = $("#eid").val();
        console.log("isdfsdf=", id);
        if(id != '') {
            $(this).removeClass('fa-thumbs-o-up');
            $("#dislike").removeClass('fa fa-thumbs-down');
            $(this).addClass('fa-thumbs-up');
            $("#dislike").addClass('fa fa-thumbs-o-down');
            var url = "{{ route('web.massageLikeDislike')}}"
            // $.post(url, function(response){
            // alert("success");

            // });
            var id = "{{$escort->id}}";
            $.post({
            url,
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            data: {"like":1, "massageId": id}}
            ).done(function (data) {
                console.log(data);
                if(data.error == 2) {
                    $("#like").removeClass('fa fa-thumbs-up');
                    $("#dislike").removeClass('fa fa-thumbs-down');
                    $("#like").addClass('fa fa-thumbs-o-up');
                    $("#dislike").addClass('fa fa-thumbs-o-down');

                }
                $(".like").val(data.lp);
                $("#like_per").html("<p>"+data.lp+"%</p>");

                $(".dislike").val(data.dp);
                $("#dis_per").html("<p>"+data.dp+"%</p>");
            }).fail(function(data){

            });
        }
    });

    $('#dislike').click(function() {
        var id = $("#eid").val();
        if(id != '') {
           $(this).removeClass('fa-thumbs-o-down');
            $("#like").removeClass('fa fa-thumbs-up');
            $(this).addClass('fa-thumbs-down');
            $("#like").addClass('fa fa-thumbs-o-up');
            var url = "{{ route('web.massageLikeDislike')}}"
            var id = "{{$escort->id}}";
            $.post({
            url,
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            data: {"like":0, "massageId": id}}
            ).done(function (data) {

                console.log(data);
                if(data.error == 2) {
                    $("#like").removeClass('fa fa-thumbs-up');
                    $("#dislike").removeClass('fa fa-thumbs-down');
                    $("#like").addClass('fa fa-thumbs-o-up');
                    $("#dislike").addClass('fa fa-thumbs-o-down');

                }
                $(".dislike").val(data.dp);
                $("#dis_per").html("<p>"+data.dp+"%</p>");

                $(".like").val(data.lp);
                $("#like_per").html("<p>"+data.lp+"%</p>");



            }).fail(function(data){
            console.log("Try again champ!", $('input[name="_token"]').val());
            });
        }

    });
    $(document).on('click','.add_to_favrate', function(){

var name = $(this).attr('data-name');

var Eid = $(this).attr('data-escortId');console.log("name=="+ Eid);
var Uid = $(this).attr('data-userId');
var cidcl = $(this).attr('class');
var cid = cidcl.split(' ');
if(cid[1] == 'fill') {
    $(this).removeClass('fill');
    $(this).addClass('null');
    $('#legboxId_'+Eid).html("<i class='fa fa-heart' style='color: #ff3c5f;' title='Remove from legbox' aria-hidden='true'></i>");
    var url = "{{ route('user.save.massage.legbox' ,':id')}} ";
    url = url.replace(':id',Eid);
    $('.class_msg').text(name + ' added to your Legbox');
    $('#add_wishlist').modal('show');
    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(data) {
            console.log(data);

        }
    });
    console.log("fill");
}
else if(cid[1] == 'null') {
    $(this).removeClass('null');
    $(this).addClass('fill');
    $('#legboxId_'+Eid).html("<i class='fa fa-heart-o' title='Add to legbox' aria-hidden='true'></i>");
    var url = "{{ route('user.delete.massage.legbox' ,':id')}} ";
    url = url.replace(':id',Eid);
    //$('.class_msg').text(name + ' Remove from Legbox ');
    $('.class_msg').text(name + ' has been removed from your Legbox ');
    $('#add_wishlist').modal('show');
    $.ajax({
        type:"post",
        url:url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(data) {
            console.log(data);

        }
    });
    console.log("null");
}
else {
    $('#my_legbox').modal('show');
    var login_url = "{!! route('viewer.login',[':id','path'=>'center-profile']) !!}";
    var loginurl = login_url.replace(':id','MclegboxId='+Eid);
    //var loginurl2 = loginurl.replace(':path','path='+window.location.pathname);
    console.log(loginurl);

    //{{--var loginurl = "{{ route('viewer.login',':id') }}";
    //loginurl = loginurl.replace(':id','MclegboxId='+Eid) --}}
    var regurl = "{{ route('register',':id') }}";

    regurl = regurl.replace(':id','MclegboxId='+Eid)
    $('#loginUrl').attr('href',loginurl)
    $('#regUrl').attr('href',regurl)
}



console.log(cid[1] + "-"+ Eid);
console.log(cidcl);

});
    </script>
@endpush

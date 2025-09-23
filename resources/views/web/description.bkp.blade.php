@extends('layouts.web')
@section('content')
<div class="profile_description_banner" style="background: url({{ $escort->imagePosition(9) ? asset($escort->imagePosition(9)) : asset('assets/app/img/profiledescrition.png')}});">
{{-- <div class="profile_description_banner" style="background: url({{$escort->banner_image ? $escort->banner_image : asset('assets/app/img/profiledescrition.png')}});"> --}}
    <div class="container-fluid back_to_search_btn pt-2">
        <a href="{{route('find.all')}}"><img src="{{ asset('assets/app/img/leftsymbole.svg') }}"> Back to search</a>
    </div>
    <div class="container">
        <div class="profile_page_title">
            @if($escort->membership == 1)
            <img src="{{ asset('assets/app/img/profile/image36.png') }}">
            @elseif($escort->membership == 2)
            <img src="{{ asset('assets/app/img/img_gold.png') }}">
            @elseif($escort->membership == 3)
            <img src="{{ asset('assets/app/img/img_silver.png') }}">
            @else

            @endif
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
                    <p class="display_inline_block ">Member ID: {{ $escort->member_id}}</p>
                </li>
            </ul>
        </div>
        <ul class="profile_page_social_profiles">
            @if(!empty($escort->user->profile_creator) && in_array(3,$escort->user->profile_creator))
            <li>
                <a href="//{{ $escort->user->social_links ? $escort->user->social_links['facebook'] : null }}" target="_blanck">
                <i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="//{{ $escort->user->social_links ? $escort->user->social_links['insta'] : null }}" target="_blanck"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="//{{ $escort->user->social_links ? $escort->user->social_links['twitter'] : null }}" target="_blanck"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            @else
            <li>
                <a href="#">
                <i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            @endif
        </ul>
    </div>
</div>
<div class="container-fluid px-0 next-preview-fixed">
    <div class="d-flex d-flex justify-content-between">
        <div class="previous_btn_profile next_previous_btn_pogision preview-dk">

            <a href="{{ $previous}}" class="text-decoration-none d-flex">
            <span class="previous_icon"><i class="fa fa-chevron-left text-white" aria-hidden="true"></i></span>
            <span class="previous_text remove_in_sm">Previous</span>
            </a>
        </div>
        <div class="next_btn_profile next_previous_btn_pogision next-dk">
            <a href="{{ $next}}" class="text-decoration-none">
            <span class="previous_text remove_in_sm">Next</span>
            <span class="previous_icon"><i class="fa fa-chevron-right text-white" aria-hidden="true"></i></span>
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
                                    <div class="profile_hr">
                                        <h4>

                                        {{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','=','1 Hour')->first()->pivot->massage_price : '' }}/hr</h4>
                                        {{-- <h4>{{$escort->durations->pluck('pivot')->max('massage_price')}}/hr</h4> --}}
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
                                        {{-- <h4>{{$escort->durations->pluck('pivot')->max('incall_price')}}/hr</h4> --}}
                                        <h4>{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','=','1 Hour')->first()->pivot->incall_price : ''}}/hr</h4>
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
                                        <h4>{{$escort->durations()->where('name','=','1 Hour')->first() ? $escort->durations()->where('name','1 Hour')->first()->pivot->outcall_price : ''}}/hr</h4>
                                        {{-- <h4>{{$escort->durations->pluck('pivot')->max('outcall_price')}}/hr</h4> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4 col-sm-12 text-center">
                    <button type="button" class="btn my_legbox all_btn_flx">
                    @if(auth()->user())
                        @if(auth()->user()->type == 0)
                        <span class="add_to_favrate @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray())){{'null'}}@else{{'fill'}}@endif" id="legboxId_{{$escort->id}}"  data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                            @if(!empty($user_type))
                                @if(in_array($escort->id,$user_type->myLegBox->pluck('id')->toArray()))
                                    <i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>
                                @else
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                @endif
                            @endif
                        </span>
                        @else
                        <span class="add_to_favrate"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        @endif
                    @else
                    <span class="add_to_favrate" data-escortId="{{$escort->id}}" data-name="{{$escort->name}}"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                    @endif
                    Save to My Legbox</button>
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

                            @if(!empty($escort->durations))
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
                            @endif
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th class="payment_accept_text_color" scope="col" colspan="4">Payment ($AUS):

                                    {{ config("escorts.profile.Security.$escort->payment_type")}}
                                </th>
                            </tr>
                        </thead>
                        </tbody>
                    </table>
                    <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                            {{-- {{ dd($escortLike)}} --}}
                            <i class="{{ $escortLike && $escortLike->like == 1 ? 'fa fa-thumbs-up' : 'fa fa-thumbs-o-up'}}" id="like" title="" aria-hidden="true"></i>
                            <!-- <img class="likeImg" id="like" value='1' src="{{ asset('assets/app/img/like.png') }}"> -->
                        </div>
                        <div class="process_bar_width like_mjo">
                            <progress class="like" value="{{$lp}}" max="100"></progress>
                        </div>
                        <div class="display_persantage">
                            <p id="like_per">{{$lp}}%</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 table-width-dk">
                    <table class="table table_striped mb-0 arrive--depart">
                        <thead class="table_heading_bgcolor_color">
                            <tr>
                                <th class="text-center" scope="col">Arriving</th>
                                <th class="text-center" scope="col">Departing</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{Carbon\Carbon::parse($escort->start_date)->format('jS F Y ') }}</td>
                                <td>{{Carbon\Carbon::parse($escort->end_date)->format('jS F Y ')}}</td>

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
                                    @if(!empty($availability->availability_time['monday']))
                                        {{ $availability->availability_time['monday'] }}
                                    @elseif(!empty($availability->monday_from) && !empty($availability->monday_to))

                                        {{ ($availability) ? $availability->monday_from: '' }} - {{ ($availability) ? $availability->monday_to : ''}}
                                    @else
                                        {{ "Unavailable"; }}
                                    @endif

                                </td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td>
                                @if(!empty($availability->availability_time['tuesday']))
                                    {{ $availability->availability_time['tuesday'] }}
                                @elseif(!empty($availability->tuesday_from) && !empty($availability->tuesday_to))
                                    {{ ($availability) ? $availability->tuesday_from: '' }} - {{ ($availability) ? $availability->tuesday_to : ''}}
                                @else
                                    {{ "Unavailable"; }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>
                                @if(!empty($availability->availability_time['wednesday']))
                                    {{ $availability->availability_time['wednesday'] }}
                                @elseif(!empty($availability->wednesday_from) && !empty($availability->wednesday_to))
                                    {{ ($availability) ? $availability->wednesday_from: '' }} - {{ ($availability) ? $availability->wednesday_to : ''}}
                                @else
                                    {{ "Unavailable"; }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td>
                                @if(!empty($availability->availability_time['thursday']))
                                    {{ $availability->availability_time['thursday'] }}
                                @elseif(!empty($availability->thursday_from) && !empty($availability->thursday_to))
                                    {{ ($availability) ? $availability->thursday_from: '' }} - {{ ($availability) ? $availability->thursday_to : ''}}
                                @else
                                    {{ "Unavailable"; }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td>
                                @if(!empty($availability->availability_time['friday']))
                                    {{ $availability->availability_time['friday'] }}
                                @elseif(!empty($availability->friday_from) && !empty($availability->friday_to))
                                    {{ ($availability) ? $availability->friday_from: '' }} - {{ ($availability) ? $availability->friday_to : ''}}
                                @else
                                    {{ "Unavailable"; }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Saturday</td>
                                <td>
                                @if(!empty($availability->availability_time['saturday']))
                                    {{ $availability->availability_time['saturday'] }}
                                @elseif(!empty($availability->saturday_from) && !empty($availability->saturday_to))
                                    {{ ($availability) ? $availability->saturday_from: '' }} - {{ ($availability) ? $availability->saturday_to : ''}}
                                @else
                                    {{ "Unavailable"; }}
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Sunday</td>
                                <td>
                                @if(!empty($availability->availability_time['sunday']))
                                    {{ $availability->availability_time['sunday'] }}
                                @elseif(!empty($availability->sunday_from) && !empty($availability->sunday_to))
                                    {{ ($availability) ? $availability->sunday_from: '' }} - {{ ($availability) ? $availability->sunday_to : ''}}
                                @else
                                    {{ "Unavailable"; }}
                                @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                        <div class="like_img">
                        <i class="{{ $escortLike && $escortLike->like == 0 ? 'fa fa-thumbs-down' : 'fa fa-thumbs-o-down'}} " id="dislike" title="Add to Legbox" aria-hidden="true"></i>
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
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Gender:</span> <span class="about_box_small_heading_value">{{ $escort->gender}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Nationality:</span> <span class="about_box_small_heading_value"> {{ ($escort->nationality) ? $escort->nationality->name : ''}}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Orientation:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.orientation.$escort->orientation") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Age:</span> <span class="about_box_small_heading_value">{{ $escort->age}}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Ethnicity:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.ethnicities.$escort->ethnicity")}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Body type:</span> <span class="about_box_small_heading_value"> {{ config("escorts.profile.body-type.$escort->body_type")}}</span>
                            </div>
                        </div>
                    </div>

                </div>

                   <div class="profile_card_border profile_page_box_heading">
                    <h2>Statistics</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Height:</span> <span class="about_box_small_heading_value"> {{config("escorts.profile.heights.$escort->height") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Eyes:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.eye-colors.$escort->eyes") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Shaved:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.shaved-type.$escort->shaved") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Contact me:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.contact-me.$escort->contact") }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">

                            <div class="mb-2">
                                <span class="about_box_small_heading">Hair Colour:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hair-colour.$escort->hair_color") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Skin tone:</span> <span class="about_box_small_heading_value">{{config("escorts.profile.skin-tone.$escort->skin_tone") }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Breast:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.breast-size.$escort->breast")}}</span>
                            </div>
                            <!-- <div class="mb-2">
                                <span class="about_box_small_heading">Language:</span>
                                 @if(!empty($escort->language))  @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach @endif
                            </div> -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-2">
                                <span class="about_box_small_heading">Hair style:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.hair-style.$escort->hair_style")}}</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Weight:</span> <span class="about_box_small_heading_value">{{ $escort->weight}} Kgs</span>
                            </div>
                            <div class="mb-2">
                                <span class="about_box_small_heading">Dress size:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.dress-size.$escort->dress_size")}}</span>
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
                                    <span class="about_box_small_heading">Play types:</span> @if(!empty($escort->play_type)) @foreach($escort->play_type as $playtype)<span class="about_box_small_heading_value">{{ config("escorts.profile.play-types.$playtype") }} </span>@endforeach @endif
                                </div>
                                <div class="mb-2">
                                    <span class="about_box_small_heading">Payment:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.Payments.$escort->payment_type") }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="padding_and_border_for_read_more_section mt-2">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Languages:</span> @if(!empty($escort->language)) @foreach($escort->language as $lang)<span class="about_box_small_heading_value"> {{ config("escorts.profile.languages.$lang") }}</span>@endforeach @endif
                                    </div>
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Travel:</span> <span class="about_box_small_heading_value">{{ config("escorts.profile.travels.$escort->travel") }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">Available to:</span> @if(!empty($escort->available_to)) @foreach($escort->available_to as $available_to) <span class="about_box_small_heading_value">{{ config("escorts.profile.available-to.$available_to") }}</span>@endforeach @endif
                                    </div>
                                    <div class="mb-2">
                                        <span class="about_box_small_heading">SWA License:</span> <span class="about_box_small_heading_value">{{ $escort->license}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="escortId" value="{{auth()->user() ? auth()->user()->id : null}}" id="eid">
            </div>
            <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                <div class="profile_card_border profile_page_box_heading">
                    <h2>Who Am I?</h2>
                </div>
                <div class="padding_20_tob_btm_side">
                    {!! $escort->about_title !!}
                </div>
                <div class="padding_20_tob_btm_side">
                    {!! $escort->about !!}
                </div>
            </div>
            <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
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
                                        <div class="row margin_zero_for_table table-grid">
                                            <div class="padding_none">
                                                <table class="table">

                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat1_services_one))

                                                            @foreach($cat1_services_one as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat1_services_two))
                                                            @foreach($cat1_services_two as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat1_services_three))
                                                            @foreach($cat1_services_three as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

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
                                    <div class="table-responsive">
                                        <div class="row margin_zero_for_table table-grid">
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat2_services_one))
                                                            @foreach($cat2_services_one as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat2_services_two))
                                                            @foreach($cat2_services_two as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat2_services_three))
                                                            @foreach($cat2_services_three as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
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
                                    <div class="table-responsive">
                                        <div class="row margin_zero_for_table table-grid">
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       {{-- {{dd($cat3_services_one)}} --}}
                                                        @if(!empty($cat3_services_one))
                                                            @foreach($cat3_services_one as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat3_services_two))
                                                            @foreach($cat3_services_two as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="padding_none">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="background_color_table_head_color">
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($cat3_services_three))
                                                            @foreach($cat3_services_three as $service)
                                                            <tr>
                                                                <td class="table_border_dash_left">{{ $service->name }}</td>
                                                                <td class="table_border_solid_left">{{$service->pivot->price ? '$'. $service->pivot->price : ''}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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


                                {{-- @if(count($escort->medias) == 0 || $escort->membership == 4)
                                <div class="carousel-item active " data-interval="10000">
                                    <div class="row">
                                        <div class="col-12 remove_padding_for_carousel">

                                            <img src="{{asset('assets/app/img/service-provider/Frame-408.png') }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                        </div>

                                    </div>
                                </div>
                                @endif
                                @if($escort->membership != 4)
                                    @foreach($escort->medias as $key=>$media)
                                        @if($media->type == 0)
                                        <div class="carousel-item {{($key == 0) ? "active" : ""}}" data-interval="10000">
                                            <div class="row">
                                                <div class="col-12 remove_padding_for_carousel">

                                                    <img src="{{ asset($media->path) }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                                </div>

                                            </div>
                                        </div>
                                        @else
                                        <div class="carousel-item {{($key == 0) ? "active" : ""}}" data-interval="10000">
                                            <div class="row">
                                                <div class="col-12 remove_padding_for_carousel">
                                                    <video width="100%" height="144" controls>
                                                    <source  src="{{ asset($media->path) }}" class="d-block w-100" alt="..." data-toggle="modal" data-target="#exampleModal">
                                                    </video>
                                                </div>

                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif --}}
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
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content border-0">
                                            <div class="modal-header border-0">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                                <div class="col-12">
                                                {{-- <div class="popup-tab-heading"> --}}
                                                    <ul class="nav nav-tabs justify-content-center border-0">
                                                       <!--  <li class="nav-item">
                                                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home">All</a>
                                                        </li> -->
                                                        <li class="nav-item">
                                                          <a class="nav-link" id="menu1-tab" data-toggle="tab" href="#menu1">Photos</a>
                                                        </li>
                                                        <li class="nav-item">
                                                          <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu2">Videos</a>
                                                        </li>
                                                      </ul>

                                                {{-- </div> --}}
                                            </div>

                                            </div>
                                            <div class="modal-body">

                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        {--<div class="row m-n2">


                                                            {{-- {{dd($escort->medias[count($escort->medias)-1])}} --}}
                                                            <div class="col-lg-5 px-md-2 py-md-2 left-video-sec">
                                                                <video width="100%" height="240" controls>
                                                                  <source src="{{ asset($escort->LastVedio) }}" type="video/mp4">
                                                                  <source src="movie.ogg" type="video/ogg">
                                                                  Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                            <div class="col-lg-7 px-md-2 py-md-2 right-side-img">
                                                                <div class="row m-n2">
                                                                    <div class="col-lg-12 px-md-2 py-md-2 right-top-im">
                                                                        <img src="{{$escort->banner_image ? $escort->banner_image : asset('assets/app/img/profiledescrition.png')}}" class="img-fluid">
                                                                    </div>
                                                                    @foreach($escort->medias as $key=>$media)
                                                                        @if($media->type == 0)
                                                                        <div class="col-lg-4 px-md-2 py-md-2 right-bott-im">
                                                                            <img src="{{ asset($media->path) }}" class="img-fluid">
                                                                        </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                                                       {{-- <div class="row m-n2 right-side-img">
                                                            <div class="col-lg-12 px-md-2 py-md-2 right-top-im">
                                                                <img src="{{$escort->banner_image ? $escort->banner_image : asset('assets/app/img/profiledescrition.png')}}" class="img-fluid">
                                                            </div>
                                                            @foreach($escort->medias as $key=>$media)
                                                                @if($media->type == 0)
                                                                <div class="col-sm-6 col-md-4 col-lg-3 px-md-2 py-md-2 right-bott-im1">
                                                                    <img src="{{ asset($media->path) }}" class="img-fluid">
                                                                </div>
                                                                @endif
                                                            @endforeach
                                                        </div> --}}

                                                        <div class="row">
   <div class="col-md-4 col-sm-12 co-xs-12 gal-item pl-4">
      <div class="row">
         <div class="col-md-12 col-sm-12 co-xs-12 gal-item">
            <div class="box">
               <img src="http://fakeimg.pl/758x370/" class="img-ht img-fluid rounded">
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
      <div class="col-md-12 col-sm-6 co-xs-12 gal-item">
         <div class="box">
            <img src="http://fakeimg.pl/748x177/" class="img-ht img-fluid rounded">
         </div>
      </div>
      <div class="col-md-12 col-sm-6 co-xs-12 gal-item">
         <div class="box">
            <img src="http://fakeimg.pl/748x177/" class="img-ht img-fluid rounded">
         </div>
      </div>
      <div class="col-md-12 col-sm-6 co-xs-12 gal-item">
         <div class="box">
            <img src="http://fakeimg.pl/748x177/" class="img-ht img-fluid rounded">
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
      <div class="col-md-12 col-sm-6 co-xs-12 gal-item">
         <div class="box">
            <img src="http://fakeimg.pl/748x177/" class="img-ht img-fluid rounded">
         </div>
      </div>
      <div class="col-md-12 col-sm-6 co-xs-12 gal-item">
         <div class="box">
            <img src="http://fakeimg.pl/748x177/" class="img-ht img-fluid rounded">
         </div>
      </div>
      <div class="col-md-12 col-sm-6 co-xs-12 gal-item">
         <div class="box">
            <img src="http://fakeimg.pl/748x177/" class="img-ht img-fluid rounded">
         </div>
      </div>
   </div>
</div>
                                                    </div>
                                                    <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                                                        <div class="row m-n2  left-video-sec">
                                                            @foreach($escort->medias as $key=>$media)
                                                                @if($media->type == 1)
                                                                <div class="col-lg-4 px-md-2 py-md-2 left-video-sec">
                                                                    <video width="100%" height="240" controls >
                                                                    <source src="{{ asset($media->path) }}" type="video/mp4">
                                                                    <source src="movie.ogg" type="video/ogg">
                                                                    Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                                @endif
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 tab1">
                                                        <div class="row tab-pane fade  active show" id="home">
                                                            @foreach($escort->medias as $key=>$media)
                                                            @if($media->type == 0)
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                            </div>
                                                            @else
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div>
                                                                    <video width="248" height="250" controls>
                                                                    <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 tab2">
                                                        <div class="row tab-pane fade" id="menu1">
                                                            @foreach($escort->medias as $key=>$media)
                                                            @if($media->type == 0)
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                            </div>

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 tab3">
                                                        <div class="row tab-pane fade" id="menu2">
                                                            @foreach($escort->medias as $key=>$media)


                                                            @if($media->type == 1)
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div>
                                                                    <video width="248" height="250" controls>
                                                                    <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>

                                                        {{-- <div class="row" id="home">
                                                            @foreach($escort->medias as $key=>$media)
                                                            @if($media->type == 0)
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                            </div>
                                                            @else
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div>
                                                                    <video width="248" height="250" controls>
                                                                    <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="row" id="menu1">
                                                            @foreach($escort->medias as $key=>$media)
                                                            @if($media->type == 0)
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div><img src="{{ asset($media->path)}}" class="img-fluid full-img"></div>
                                                            </div>

                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="row" id="menu2">
                                                            @foreach($escort->medias as $key=>$media)


                                                            @if($media->type == 1)
                                                            <div class="col-sm-4 col-md-4 col-lg-4 d-flex no-padding">
                                                                <div>
                                                                    <video width="248" height="250" controls>
                                                                    <source  src="{{ asset($media->path) }}" class="d-block w-100">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div> --}}
                                                    </div>
                                                </div> -->
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
            <!-- accordien start here -->
            <div class="accordion-container-new">
                <div class="set">
                    <a class="pb-1 pt-1">
                    My Pricing Policy
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            {{--{!! $escort->pricing_policy !!} --}}
                            <p>
                                Prices are all inclusive unless an extra is listed in My Serices. For Outcalls, price is rate + taxi to and from my location.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a class="pb-1 pt-1">
                    Disclaimer
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>Donations are for my companionship and nothing else. It is not an offer or promise for prostitution or illegal activity.
                                Anything that may occur between us is our choice as consenting adults.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- accordien end here -->
            <!-- tip section start here -->
            <div class="box_shadow padding_twelve_px">
                <div class="profile_card_border profile_description_contect position-relative">
                    <h2><img src="{{ asset('assets/app/img/tips.svg') }}">Tips</h2>
                    <!-- Carousel controls start-->
                    {{-- <div class="arroww_tip_crousal">
                        <a class="carousel-control-prev manage_oprcity next-01" href="#tipcrousal" data-slide="prev" id="prev">
                        <i class="fa fa-arrow-left text-white" aria-hidden="true"></i>
                        </a>
                        <!--number indicatert start here -->
                        <div class="num-01 indicator_align_between_aero_center"></div>
                        <!--number indicatert end here -->
                        <a class="carousel-control-next manage_oprcity prev-01" href="#tipcrousal" data-slide="next" id="next">
                        <i class="fa fa-arrow-right text-white" aria-hidden="true"></i>
                        </a>
                    </div> --}}
                    <!-- Carousel controls end-->
                </div>
                <div class="pt-2">
                    <div id="tipcrousal" class="carousel slide carousel_remove_in_tip" data-ride="carousel" data-interval="2500">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item tip_carousel_item_text active item-01">
                                <p>Ask questions and become informed.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Protect your details, use our contact form.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>If it seems to good to be true, it probably is.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Report any suspicious Profiles.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Only meet Advertisers who seem trustworthy.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Trust your instincts.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Avoid using email, use our messaging centre.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Be cautious with external links.</p>
                            </div>
                            <div class="carousel-item tip_carousel_item_text item-01">
                                <p>Do not offer any of your personal information.</p>
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
                <div class="padding_20_tob_btm_side reduse_pad">
                    <p class="profile_description_contect_pera">Message me to arrange a play date.</p>
                    <div class="row play_grid">

                    {{-- @if(!auth()->user()->playmates->isEmpty()) --}}
                        @if(! is_null($escort->user->playmates))
                        @foreach($escort->user->playmates as $playmate)

                            <div class="col-6">
                                <a href="{{ route('profile.description',$playmate->id)}}" target="_blank">
                                <div class="d-flex align-items-center five_px_gap_img_text">

                                    <img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="{{$playmate->default_image ? asset($playmate->default_image) : asset('assets/app/img/icons-profile.png') }}">
                                    <p class="suggase_profile_name">{{ $playmate->name }}</p>

                                </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <!-- jkjkgjkhf -->
            <div class="box_shadow manage_padding_margin_bg_color">
                <div class="profile_card_border profile_description_contect">
                   <h2><img src="{{ asset('assets/app/img/contact_me.svg') }}"> Contacting me</h2>
                </div>
                <div class="padding_20_tob_btm_side reduse_pad">
                    <span class="span_display_block connecting_me_chat_phone">You can contact me by: <img src="{{ asset('assets/app/img/wechat.svg') }}"> or <img src="{{ asset('assets/app/img/phoneicon.svg') }}"></span>
                    </br>
                    @php
                    //echo "<pre>";
                    //print_r($escort->user->viewer_contact_type);
                    $from = $escort->phone;
                    //$to = sprintf("%s-%s-%s",
                    $number = sprintf("%s-%s-%s",
                            substr($from, 0, 3),
                            substr($from, 3, 3),
                            substr($from, 6));

                    @endphp

                    <b>When texting me please say:</b>
                    <p class="profile_description_contect_pera">
                        " <b><i>Hi {{ $escort->name}}, I found you on Escorts4U ...</i></b>"
                            @if(!empty($escort->user->viewer_contact_type))
                                @if(in_array(1, $escort->user->viewer_contact_type) || in_array(2, $escort->user->viewer_contact_type) )
                                    @if(in_array(3, $escort->user->viewer_contact_type))
                                        on my number {{ $number}} or email {{ $escort->user->email ? $escort->user->email : ''}}
                                    @else
                                        on my number {{ $number}}
                                    @endif
                                @elseif(in_array(3, $escort->user->viewer_contact_type))
                                    on my email {{ $escort->user->email ? $escort->user->email : ''}}
                                @else
                                    on my number --
                                @endif
                            @else
                            on my number --
                            @endif
                    </p>
                </div>
            </div>
            <div class="vax-btn">
            @if($escort->covidreport == 2)
            <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, up to date</button>
            @elseif($escort->covidreport == 1)
            <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vaccinated.svg') }}">Vaccinated, not up to date</button>
            @else
            <button type="button" class="btn my_legbox single-prof-btn"><img src="{{ asset('assets/app/img/vax.svg') }}">Not Vaccinated</button>
            @endif
          </div>
        </div>

        <!-- sssssssssssssssss -->
    </div>
</div>
<!-- model start here 1-->
<div class="modal fade" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Send New Harmony Nature Massage a message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text">
                <p class="mb-1 mt-3"><b>Notes</b></p>
                <ol class="mb-0">
                    <li>The Escort needs to have this feature enabled in order to receive it.</li>
                    <li>You will receive a notification when thismessage is responded to.</li>
                </ol>
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
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report  {{$escort->name}} to our team.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="mb-1 mt-3"><b>Notes</b></p>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
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
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="mb-1 mt-3"><b>Notes</b></p>
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
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img_resize_in_smscreen">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Send New Harmony Nature Massage a message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 teop-text">
                <p class="mb-1 mt-3"><b>Notes</b></p>
                <ol class="mb-0">
                    <li>The Escort needs to have this feature enabled in order to receive it.</li>
                    <li>You will receive a notification when thismessage is responded to.</li>
                </ol>
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
<div class="modal fade ss" id="newmodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
                <img src="{{ asset('assets/app/img/alert.png') }}" class="img_resize_in_smscreen pr-3">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report  {{$escort->name}} to our team.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <!-- <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> -->
                </span>
                </button>
            </div>
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="mb-1 mt-3"><b>Notes</b></p>
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
                            <p class="diff_font_pera mb-0">Why are you reporting this Profile:</p>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="1">
                                <span class="form-check-label" for="exampleRadios2">
                                Fake Media
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="0">
                                <span class="form-check-label" for="exampleRadios2">
                                    Spam
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="photo_status" id="exampleRadios2" value="2">
                                <span class="form-check-label" for="exampleRadios2">
                                    Other
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

<!-- model start here 3-->
<div class="modal fade add_reviews" id="newmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
            <form id="reviewAdvertiser" action="{{ route('review.advertiser',[$escort->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="popu_heading_style">Notes</p>
                    <div class="row">
                        <div class="col teop-text">
                            <ul>
                                <li>Only review if you had direct contact with the Escort.</li>
                                <li>Do not write fake or abusive reviews, as they will not be published.</li>
                                <li>To contact this Escort click on Message Me.</li>
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
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M10.0922 2.9718C10.4494 2.1963 11.5515 2.1963 11.9088 2.9718L13.8812 7.25376C14.0267 7.56974 14.326 7.78737 14.6715 7.8284L19.3497 8.38398C20.1967 8.48456 20.5371 9.53115 19.9113 10.1107L16.4507 13.3157C16.1958 13.5518 16.0817 13.9032 16.1493 14.244L17.0679 18.8725C17.2341 19.7097 16.3426 20.3568 15.5981 19.9395L11.4894 17.6366C11.1857 17.4663 10.8153 17.4663 10.5116 17.6366L6.40286 19.9395C5.65835 20.3568 4.76691 19.7097 4.93306 18.8725L5.85163 14.2441C5.91928 13.9033 5.80515 13.5518 5.55019 13.3157L2.08904 10.1107C1.4632 9.53124 1.80356 8.48455 2.65055 8.38398L7.32946 7.82839C7.67493 7.78737 7.97426 7.56974 8.11981 7.25375L10.0922 2.9718Z" stroke="#FF3C5F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
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

<div class="modal" id="my_legbox" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width rounded-0">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">My Legbox</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body text-center">
             <h1 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                    <span id="Lname">Please log in or Register to access your Legbox</span>
                </h1>
                <a href="{{ route('viewer.login') }}" type="button" class="btn btn-danger site_btn_primary" id="loginUrl" >Login</a>
                <a href="{{ route('register') }}" type="button" class="btn btn-danger site_btn_primary" id="regUrl">Register</a>
            </div>
        </div>
    </div>
</div>
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
        var url = "{{ route('web.likeDislike')}}"
        // $.post(url, function(response){
        // alert("success");

        // });
        var id = "{{$escort->id}}";
        $.post({
        url,
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        data: {"like":1, "escortId": id}}
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
        var url = "{{ route('web.likeDislike')}}"
        var id = "{{$escort->id}}";
        $.post({
        url,
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        data: {"like":0, "escortId": id}}
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
</script>

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
<script type="text/javascript">

    $(document).ready(function(){
        var totalItems = $('.item-01').length;
        var currentIndex = $('div.carousel-item').index()+1;
        var currentIndex_active = $('div.carousel-item.active').index();
        let prev = totalItems + 1;
        $("body").on('click','#prev',function(){
            prev -= 1;
            console.log(prev);
            if(prev >= 1) {
                $('.num-01').html('' + prev + '&nbsp;/&nbsp;' + totalItems + '');
            }
            else {
                console.log("els="+prev);
                prev = totalItems;
                $('.num-01').html('' + prev + '&nbsp;/&nbsp;' + totalItems + '');
            }

        });

        $("body").on('click','#next',function(){
            currentIndex += 1;
            console.log(prev);
            if(currentIndex <= 9) {
                $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
            }
            else {
                console.log("els="+prev);
                currentIndex = 1;
                $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
            }

        });
        $("body").on('click','.likeImg',function(){
            var value = $(this).attr('value');
            var id = "{{$escort->id}}";

           // {{--var url = "{{ route('user.likes' ,$escort->id)}} ";--}}
            console.log("ok="+url);

            // $.ajax({
            //     type:"post",
            //     url:url,
            //     data:{value: value},
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //     success:function(data) {
            //         console.log(data);

            //     }
            // });
            // if(value == 1) {
            //     console.log("ok="+value);
            // }
            // else {
            //     console.log("els="+value);

            // }

        });

    })
    $("#home-tab").click(function(){
        $('.tab2').hide();
        $('.tab3').hide();
        $('.tab1').show();
    })
    $("#menu1-tab").click(function(){
        $('.tab1').hide();
        $('.tab3').hide();
        $('.tab2').show();
    })
    $("#menu2-tab").click(function(){
        $('.tab1').hide();
        $('.tab2').hide();
        $('.tab3').show();
    })

    // var totalItems = $('.item-01').length;
    // var currentIndex = $('div.carousel-item').index() + 1;

    // var down_index = 0;

    // $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
    // $(".next-01").click(function() {
    //   currentIndex_active = $('div.carousel-item.active').index() + 2;
    //   console.log("cu="+currentIndex_active);
    //   if (totalItems >= currentIndex_active) {
    //     down_index = $('div.carousel-item.active').index() + 1;
    //     console.log(down_index);
    //     $('.num-01').html('' + currentIndex_active + '&nbsp;/&nbsp;' + totalItems + '');
    //   } else {
    //     down_index = 1; //just to make 0 to go to else part when back button is clicked
    //     $('.num-01').html('1' + '&nbsp;/&nbsp;' + totalItems + '');
    //     console.log("dn="+down_index);
    //   }
    // });

    // $(".prev-01").click(function() {
    //   down_index = down_index - 1;
    //   console.log("dn="+down_index);
    //   if (down_index >= 1) {
    //     $('.num-01').html('' + down_index + '&nbsp;/&nbsp;' + totalItems + '');
    //   } else {
    //     down_index = totalItems; //last slide value
    //     $('.num-01').html('' + totalItems + '&nbsp;/&nbsp;' + totalItems + '');
    //   }
    // });
    $(document).on('click','.add_to_favrate', function(){
      var Eid = $(this).attr('data-escortId');
      var Uid = $(this).attr('data-userId');
      var cidcl = $(this).attr('class');
      var cid = cidcl.split(' ');
      if(cid[1] == 'fill') {
            $(this).removeClass('fill');
            $(this).addClass('null');
            $('#legboxId_'+Eid).html("<i class='fa fa-heart' style='color: #ff3c5f;' aria-hidden='true'></i>");
            var url = "{{ route('user.save.legbox' ,':id')}} ";
            url = url.replace(':id',Eid);
            $.ajax({
                type:"post",
                url:url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data) {
                    console.log(data);

                }
            });
      }
        else if(cid[1] == 'null') {
            $(this).removeClass('null');
            $(this).addClass('fill');
            $('#legboxId_'+Eid).html("<i class='fa fa-heart-o' aria-hidden='true'></i>");
            var url = "{{ route('user.delete.legbox' ,':id')}} ";
            url = url.replace(':id',Eid);
            $.ajax({
                type:"post",
                url:url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data) {
                    console.log(data);

                }
            });
        }
        else {
            $('#my_legbox').modal('show');
            var login_url = "{!! route('viewer.login',[':id','path'=>'escort-profile']) !!}";
            var loginurl = login_url.replace(':id','legboxId='+Eid);
            console.log(loginurl);

            //{{--var loginurl = "{{ route('viewer.login',':id') }}";
            //loginurl = loginurl.replace(':id','MclegboxId='+Eid) --}}
            var regurl = "{{ route('register',':id') }}";

            regurl = regurl.replace(':id','legboxId='+Eid)
            $('#loginUrl').attr('href',loginurl)
            $('#regUrl').attr('href',regurl)
        }



      console.log(cid[1] + "-"+ Eid);
      console.log(cidcl);
    });
    </script>
@endpush

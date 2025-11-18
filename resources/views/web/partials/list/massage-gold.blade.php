
@php
    $escortName = ($escort->gender == 'Transgender')? 'TS - ' . $escort->name : $escort->name;
@endphp


<div class="listview_each_section_border_btm">
    <div class="manage_listview_margin_gold_section padding_20_all_side_service_provider_list_view box_shdow_service_provider_list_view gold_list_frame">
        <div class="row plat_num_row">
            <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 pr-3 pr-lg-0 self-w-73">
                <div class="row plat-inner  mr-0 ml-0">
                    <div class="col-md-4 featured-pic pl-0">
                        {{-- <a href="{{ route('profile.description',$escort->id)}}"> --}}
                            <a href="{{ route('center.profile.description',[$escort->id,$escort->city_id])}}">
                        <div class="section_wise_level_icon_img">
                            <img src="{{  asset($escort->imagefrontPosition(1)) }}" class="img-fluid height_for_gold" title="View Profile">
                            {{-- <div class="siliver_logo_icon"><img src="{{ asset('assets/app/img/img_gold.png')}}"></div> --}}
                            {{-- <div class="add_to_fab_list_view_each_sec">
                                <span class="add_to_favrate">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                </span>
                            </div> --}}
                            <div class="verify_image">
                                <img src="{{ asset('assets/app/img/verifyimage.png')}}" class="custom-sheild">
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-8 gold-seven pr-lg-0 pr-3">
                        <div class="d-block justify-content-between mb-2">
                            <!-- <div class="free_profile_name_and_color v-otherheding">{{$escort->name}}</div> -->
                            <div class="v-list-location">
                                <h2>{{$escortName}}</h2>
                                <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$escort->address ? $escort->address : ""}} </p>
                            </div>
                            <div class="v-list-count-3">
                                <ul>
                                    <li>Contact Us: <span>Phone, Text, Email</span></li>
                                    <li>Building:  <span> {{ config("escorts.profile.Building.$escort->building")}}</span></li>
                                    <li>Type:  <span> {{ config("escorts.profile.furniture_types.$escort->furniture_types")}}</span></li>
                                    <li>Entry: <span> {{ config("escorts.profile.Entry.$escort->entry")}}</span></li>
                                    <li>Ambiance: <span> {{ config("escorts.profile.Ambiance.$escort->ambiance")}} </span></li>
                                    <li>Loyalty programs: <span> {{ config("escorts.profile.Loyalty.$escort->loyalty")}}</span></li>
                                    <li>Parking <span> {{ config("escorts.profile.Parking.$escort->parking")}}</span></li>
                                    <li>Security: <span> {{ config("escorts.profile.Security.$escort->security")}}</span></li>
                                    <li>Payment: <span> {{ config("escorts.profile.Payment.$escort->payment")}}</span></li>
                                </ul>
                            </div>
                            {{-- <!-- <div class="age">
                               <span class="margin_and_font_size_color_for_free">AGE:</span><span class="free_profile_age_color_and_font">{{$escort->age}}</span>
                               <div class="d-inline video_icon">
                                <a href="#">
                                    <img src="{{ asset('assets/app/img/video_play.svg') }}">
                                    </a>
                               </div>
                           </div> --> --}}

                        </div>
                        {{-- <!-- <div class="d-flex justify-content-between mb-3 flex_warp gold_icon_list">
                            <div class="gender">
                                <span>Gender:</span>
                                <span>{{$escort->gender ? $escort->gender : ''}}</span>
                            </div>
                            <div class="perth">
                                <span>{{$escort->city ? $escort->city->name: ''}}</span>
                                <span class="give_rating_after_get_servive">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="free_profile_avilabletoimg_size">
                                <span>Available:</span>
                                <span>
                                @if($escort->available_to)
                                @foreach($escort->available_to as $key => $available_to)
                                <img src="{{ config('escorts.profile.available-to-images')[$available_to] }}">
                                @endforeach
                                @endif
                                </span>
                            </div>

                        </div> --> --}}
                        <div class="mt-2">
                            <p class="v-list_view_profile_pera_font_size list_view_profile_pera_font_size">Hi everyone, I am Melani and I am here in Perth for all those guys who enjoy the thrill of being with that quite little girl who secretely really is that office slut. <br> I am tall, slim and naughty when it matters. With smooth skin and long hair to run your hands through, and of course something lovely for you to play with down there.
                            </p>

                            @if(Request::path() == "massage-show-list")
                                <button type="button" class="short-list btn btn-primary removeshortlist" id="escort_{{$escort->id}}" data-name="{{$escortName}}" data-escortId="{{$escort->id}}">

                                Remove from Shortlist</button>

                            @else

                                <button type="button" class="short-list btn btn-primary shortlist myescort_{{$escort->id}}" id="escort_{{$escort->id}}" data-name="{{$escortName}}" data-escortId="{{$escort->id}}" data-userId="{{ auth()->user() ? auth()->user()->id : 'NA' }}">
                                    @if(!empty($escortId))
                                        {{-- @if($escort->shortListed->isEmpty()) --}}
                                        @if(in_array($escort->id,$escortId))
                                        <img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_btn.svg') }}">
                                        Remove from Shortlist
                                        @else
                                        Add to Shortlist
                                        @endif
                                    @else
                                    Add to Shortlist

                                    @endif
                                </button>
                            @endif
                            {{-- <button type="button" class="short-list btn btn-primary shortlist w-50" data-name="Juli test" data-escortid="39">Add to Shortlist</button> --}}
                        </div>

                    </div>
                    {{-- <!-- <div class="col-md-2 padding_zero_in_desktop fifteen_left_right_padding">
                        <div class="mb-3">
                            <button type="button" class="btn btn_for_profile_list_view min_width_hundredpresent">
                                <img class="listiconprofilelistview" src="{{ asset('assets/app/img/small-btn.svg') }}">Add to short list
                            </button>
                        </div>
                        <div class="icon-lis-col">
                            <div class="mb-1">
                               <div class="d-flex manage_gap_text_img-profile mb-2">
                                  <img src="{{ asset('assets/app/img/handwithhart.png')}}">
                                  <div class="div_contain_text">
                                     <div class="profile_message">
                                        <h4>Massage</h4>
                                     </div>
                                     <div class="profile_hr">
                                        <h4>{{ $escort->durations->pluck('pivot')->min('massage_price') }}/hr</h4>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="mb-1">
                                <div class="d-flex manage_gap_text_img-profile mb-2">
                                   <img src="{{ asset('assets/app/img/areodownimg.png')}}">
                                   <div class="div_contain_text">
                                      <div class="profile_message">
                                         <h4>Incalls</h4>
                                      </div>
                                      <div class="profile_hr">
                                        <h4>{{ $escort->durations->pluck('pivot')->min('incall_price') }}/hr</h4>
                                      </div>
                                   </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex manage_gap_text_img-profile mb-2">
                                    <img src="{{ asset('assets/app/img/aeroupimg.png')}}">
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Outcalls</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>{{ $escort->durations->pluck('pivot')->min('outcall_price') }}/hr</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --> --}}
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 self-w-26">
                <table class="v-table-desi table table-striped border">
                    <thead class="table_heading_bgcolor_color">
                        <tr>
                            <th scope="col" colspan="2"><img src="{{ asset('assets/app/img/calendar-clock.png')}}" class="img-fluid"> Open Times</th>
                            <!-- <th scope="col">Massage</th> -->
                            <!-- <th scope="col">Incalls</th> -->
                        </tr>
                    </thead>
                    <tbody class="massage-centres-list">

                        @php $availability = $escort->availability; @endphp
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
                        {{-- <tr>
                            <td>Sunday</td>
                            <td>8”00 PM - 1:00 AM</td>
                        </tr> --}}
                    <!-- <tbody>
                        @if(!empty($escort->durations))
                        @foreach($escort->durations as $key => $duration)
                        <tr>
                            <td>{{ $duration->name }}</td>
                            <td>{!! ($duration->pivot->massage_price) ? $duration->pivot->massage_price : "<span class='if_data_not_available'>N/A</span>" !!}
                            </td>
                            <td>{!! ($duration->pivot->incall_price) ? $duration->pivot->incall_price : "<span class='if_data_not_available'>N/A</span>" !!}
                            </td>
                        </tr>
                        @if($loop->index == 3)
                            @break
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                    <thead class="table_heading_bgcolor_color">
                        <tr>
                            <th class="payment_accept_text_color" scope="col" colspan="3">Available: <span class="date_from_available">{{ date('d-m-Y',strtotime($escort->start_date))}}</span>   to   <span class="date_from_available">{{date('d-m-Y',strtotime($escort->end_date))}}</span></th>
                        </tr>
                    </thead> -->
                </table>
            </div>
        </div>
    </div>
</div>

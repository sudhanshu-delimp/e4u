 @foreach($listings as $listing)
        <div class="mc_list_card">

            <!-- Left Image -->

            <div class="mc_list_img">
                <a href="{{ route('web.massage-description') }}" class="mc_card_link">
                    <img src="{{ asset('assets/app/img/massage/mc2.jpg') }}" alt="">
                </a>
                    <span class="verify_icon">
                        <img src="{{ asset('assets/app/img/verify/unverified_light.png') }}" alt="">
                    </span>
                    <div class="mc_list_legbox">
                        <span class="my_legbox_icon" data-target="#my_legbox" data-toggle="modal">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="mc_legbox_tooltip">Add to My Legbox</span>
                        </span>
                    </div>
                
            </div>

            <!-- Middle Content -->
            <div class="mc_list_content">
                <div class="mc_list_content_inner">
                    <div class="mc_list_header">
                        <span class="mc_list_title">{{$listing->profile_name}}</span>
                        <span class="mc_list_rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                    </div>

                    <div class="mc_list_address">
                        <img src="{{ asset('assets/app/img/gps.png') }}" alt="address" class="custompopicon">
                        123 Massage St, Perth, WA 6000
                    </div>

                    <div class="mc_list_meta">
                        <span><strong>Parking:</strong> Front</span>
                        <span><strong>Entry:</strong> Front</span>
                        <span><strong>Shower:</strong> Yes</span>
                    </div>

                    <div class="mc_list_meta">
                        <span><strong>Building:</strong> Shop</span>
                        <span><strong>Type:</strong> Table</span>
                        <span><strong>Security:</strong> Yes</span>
                    </div>

                    <div class="mc_list_meta">
                        <span><strong>Massage Services:</strong> Swedish Massage, Deep Tissue</span>
                    </div>
                    <div class="mc_list_meta">
                        <span><strong>Other Service Types:</strong> Aromatherapy, Body Scrub</span>
                    </div>

                    <div class="mc_list_about">
                        <strong>About Us</strong><br>
                        {{-- <p class="mc_list_desc"> Beautiful Girls Available Every Day in Rockingham, Mandurah, and Fremantle.</p> --}}
                        <p class="mc_list_desc">
                            Beautiful Girls Available Every Day in Rockingham, Mandurah, and Fremantle.
                            This is extra text added to make sure the content exceeds four lines so we can test
                            the read more link functionality properly and append the link at the end of the fourth line
                            correctly.
                            Beautiful Girls Available Every Day in Rockingham, Mandurah, and Fremantle.
                            This is extra text added to make sure the content exceeds four lines so we can test
                            the read more link functionality properly and append the link at the end of the fourth line
                            correctly.<a href="#" class="read-more-link">Read More</a>
                        </p>
                    </div>
                </div>
                <div class="mc_list_footer">
                    <a href="#" class="mc_btn_shortlist" data-target="#add_wishlist" data-toggle="modal">Add
                        to Shortlist</a>
                </div>

            </div>

            <!-- Right Open Times -->
            <div class="mc_list_time">

                <table class="table table-striped mb-0">
                    <thead class="bg-first">
                        <tr>
                            <th colspan="2">
                                <div class="d-flex gap-20 align-items-center"><img
                                        src="{{ asset('assets/app/img/open-time.png') }}" alt="Open Times"
                                        class="custompopicon"> Open Times</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Monday:</td>
                            <td class="text-right">Closed</td>
                        </tr>

                        <tr>
                            <td>Tuesday:</td>
                            <td class="text-right">9:30 am to 10:00 pm</td>
                        </tr>

                        <tr>
                            <td>Wednesday:</td>
                            <td class="text-right">9:30 am to 10:00 pm</td>
                        </tr>

                        <tr>
                            <td>Thursday:</td>
                            <td class="text-right">9:30 am to 10:00 pm</td>
                        </tr>

                        <tr>
                            <td>Friday:</td>
                            <td class="text-right">9:30 am to 10:00 pm</td>
                        </tr>

                        <tr>
                            <td>Saturday:</td>
                            <td class="text-right">9:30 am to 10:00 pm</td>
                        </tr>

                        <tr>
                            <td>Sunday:</td>
                            <td class="text-right">Closed</td>
                        </tr>
                    </tbody>

                </table>

            </div>


        </div>
        @endforeach
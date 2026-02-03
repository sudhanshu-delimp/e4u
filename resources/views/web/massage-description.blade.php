@extends('layouts.web')
@section('style')
<style>
    .mc_profile_table .table th{
    padding: .8rem .55rem !important;
}
    </style>
    @stop
@section('content')
    <div class="container profile_description_banner custom--profile custommassage--profile--page"
        style="background: url('assets/app/img/massage/massage_2.jpg');
    background-position: center; background-repeat:no-repeat">

        <div class="container-fluid back_to_search_btn pt-2">
            <a href="#" class="back--search">
                Back to Search
                <span class="previous_icon">
                    <i class="fa fa-chevron-up text-white" aria-hidden="true"></i>
                </span>
            </a>
        </div>

        <div class="container">
            <div class="profile_page_title">
                <h2 class="display_inline_block p-0">Profile Name</h2>
            </div>

            <div class="profile_page_name_and_phno">
                <p>City Name - 000 000 0000</p>
            </div>

            <div class="profile_page_location_and_id">
                <ul>
                    <li>
                        <span class="profile_location_icon">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </span>
                        <p class="display_inline_block">Full Address Here</p>
                    </li>
                    <li>
                        <span class="profile_location_icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <p class="display_inline_block">Member ID: 123456</p>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center justify-content-start gap-10">
                <ul class="profile_page_social_profiles ml-0">
                    <li class="social-media-profile">
                        <a href="https://www.facebook.com/" target="_blank">
                            <img src="{{ asset('assets/app/img/facebook.png') }}" class="facebook-logo" alt="logo">
                        </a>
                    </li>

                    <li class="social-media-profile">
                        <a href="https://www.instagram.com/" target="_blank">
                            <img src="{{ asset('assets/app/img/instagram.png') }}" class="instagram-logo" alt="logo">
                        </a>
                    </li>

                    <li class="social-media-profile">
                        <a href="https://x.com/" target="_blank">
                            <img src="{{ asset('assets/app/img/twitter-x.png') }}" class="twitter-x-logo" alt="logo">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid px-0 next-preview-fixed">
        <div class="d-flex d-flex justify-content-between">
            <div class="previous_btn_profile next_previous_btn_pogision preview-dk previousDisableButtonCss">
                <a href="" class="text-decoration-none d-flex">
                    <span class="previous_icon"><i class="fa fa-chevron-left text-white" aria-hidden="true"></i></span>
                    <span class="previous_text remove_in_sm">Previous</span>
                </a>
            </div>
            <div class="next_btn_profile next_previous_btn_pogision next-dk nextDisableButtonCss">
                <a href="" class="text-decoration-none">
                    <span class="previous_text remove_in_sm">Next</span>
                    <span class="previous_icon"><i class="fa fa-chevron-right text-white" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
    </div>
    <div class="container profile_contain">
        <div class="row">
            <div class="col-md-8 col-xl-8 col-sm-12 col-12">
                <div class="row mb-3">
                    <div class="col-md-12 col-xl-8 col-sm-12 col-12">
                        <div class="row mess_row custom_message_types">

                            <div class="col-sm-12 d-flex align-items-center justify-content-center gap-10 flex-wrap">
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                        <img src="assets/dashboard/img/massage-only.png" alt="Massage">
                                        <p class="mc_rate_tooltip">Massage only</p> 
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Massage</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>$100/hr</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                    <img src="assets/dashboard/img/massage-with2.png" alt="Masseur">
                                     <p class="mc_rate_tooltip">Massage with extras +2 hands.</p> 
                                    </div>    
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>Masseur</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>$120/hr</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-10">
                                    <div class="mc_tooltip_wrap">
                                    <img src="assets/dashboard/img/massage-with4.png" alt="2+ Masseurs">
                                    <p class="mc_rate_tooltip">Massage with extras +4 hands.</p>   
                                    </div>
                                    <div class="div_contain_text">
                                        <div class="profile_message">
                                            <h4>2+ Masseurs</h4>
                                        </div>
                                        <div class="profile_hr">
                                            <h4>$150/hr</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 col-xl-4 col-sm-12 text-center">
                        <button type="button" class="btn mc_my_legbox_btn" data-target="#my_legbox" data-toggle="modal">
                            <span class="add_to_favrate">
                                <i class="fa fa-heart-o" aria-hidden="true" title="Add to Legbox"></i>
                            </span>
                            Save to My Legbox
                        </button>
                    </div>
                </div>

                <div class="row mc_profile_table">
                    <div class="col-lg-6 col-md-12">

                        

                        <table class="table table_striped">
                            <thead>
                                <tr>
                                    <th>Rates</th>
                                    <th>Massage</th>
                                    <th>Masseur</th>
                                    <th>2+ Masseurs</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>15 Minutes</td>
                                    <td><div class="public-num-value-table"> <span>$ </span>100</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>120</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>150</div></td>
                                </tr>
                                <tr>
                                    <td>30 Minutes</td>
                                    <td><div class="public-num-value-table"> <span>$ </span>100</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>120</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>150</div></td>
                                </tr>
                                 <tr>
                                    <td>45 Minutes</td>
                                    <td><div class="public-num-value-table"> <span>$ </span>100</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>120</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>150</div></td>
                                </tr>
                                 <tr>
                                    <td>1 Hour</td>
                                    <td><div class="public-num-value-table"> <span>$ </span>100</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>120</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>150</div></td>
                                </tr>
                                <tr>
                                    <td>1.5 Hours</td>
                                    <td><div class="public-num-value-table"> <span>$ </span>150</div></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>180</div></td>
                                    <td class="text-center"><span class="na-label ">N/A</span></td>
                                </tr>
                                <tr>
                                    <td>2 Hours</td>
                                    <td><div class="public-num-value-table"> <span>$ </span>200</div></td>
                                    <td class="text-center"><span class="na-label text-center">N/A</span></td>
                                    <td><div class="public-num-value-table"> <span>$ </span>250</div></td>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="4">
                                        Payment ($AUS): Cash, Card
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <table class="table table_striped">
                            <thead>
                                <tr>
                                    <th scope="col">Day</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Monday</td>
                                    <td>9:00 AM - 6:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>9:00 AM - 6:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Wednesday</td>
                                    <td>9:00 AM - 6:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    <td>9:00 AM - 6:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    <td>9:00 AM - 8:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Saturday</td>
                                    <td>10:00 AM - 5:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    <td>Closed</td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </div>

                    <div class="col-sm-12">
                        <div style="width: 100%">
                            <iframe width="100%" height="153" frameborder="0" scrolling="no" marginheight="0"
                                marginwidth="0"
                                src="https://maps.google.com/maps?width=100%25&height=600&hl=en&q=nema%20san%20francisco&t=&z=14&ie=UTF8&iwloc=B&output=embed"
                                style="filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));">
                            </iframe>
                        </div>
                    </div>
                </div>

                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>About us</h2>
                    </div>

                    <div class="padding_20_tob_btm_side">
                        <div class="row">

                            <div class="col-md-4">
                                <div>
                                    <span class="about_box_small_heading">Building:</span>
                                    <span class="about_box_small_heading_value">Apartment</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Parking:</span>
                                    <span class="about_box_small_heading_value">Available</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Entry:</span>
                                    <span class="about_box_small_heading_value">Private</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <span class="about_box_small_heading">Type:</span>
                                    <span class="about_box_small_heading_value">Modern</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Shower:</span>
                                    <span class="about_box_small_heading_value">Yes</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Ambiance:</span>
                                    <span class="about_box_small_heading_value">Relaxing</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <span class="about_box_small_heading">Security:</span>
                                    <span class="about_box_small_heading_value">On-site</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Payment:</span>
                                    <span class="about_box_small_heading_value">Cash, Card</span>
                                </div>
                                <div>
                                    <span class="about_box_small_heading">Loyalty program:</span>
                                    <span class="about_box_small_heading_value">Available</span>
                                </div>
                                
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 pt-2">
                                <p class="mb-0">
                                    <span class="about_box_small_heading">Address:</span>
                                    <span class="about_box_small_heading_value">123 Sample Street, City</span>
                                </p>
                                <p class="mb-0">
                                    <span class="about_box_small_heading">Languages:</span>
                                    <span class="about_box_small_heading_value">English, Spanish</span>
                                </p>
                                <p class="mb-0">
                                    <span class="about_box_small_heading">Massage Service:</span>
                                    <span class="about_box_small_heading_value">
                                        Swedish Massage, Deep Tissue, Relaxation
                                    </span>
                                </p>
                                <p>
                                    <span class="about_box_small_heading">Other Service Types:</span>
                                    <span class="about_box_small_heading_value">
                                        Aromatherapy, Body Scrub
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Who are we?</h2>
                    </div>
                    <div class="padding_20_tob_btm_side">
                        <div class="text-justify">
                            I am a professional massage therapist who focuses on creating a calm,
                            relaxing, and respectful experience. My goal is to help you unwind,
                            relieve stress, and feel completely at ease in a clean and comfortable
                            environment. Every session is tailored to your needs, ensuring privacy,
                            discretion, and quality service at all times.
                        </div>
                    </div>
                </div>


                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Our Masseurs</h2>
                    </div>

                    <div class="padding_20_tob_btm_side">
                        <p class="text-justify">
                            Check out our experienced Masseurs. All services are conducted in private.
                            Feel free to ask us or any of our Masseurs any questions about our services.
                        </p>

                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="d-flex align-items-center gap_between_text_and_img our-masseurs"
                                    data-toggle="modal" data-target="#product_view">
                                    <div><img src="assets/app/img/profile_photo.png"></div>
                                    <p class="mb-0">Sierra</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2>Our Services</h2>
                    </div>

                    <div class="padding_20_tob_btm_side">
                        <p class="text-justify">
                            Check out what services are available.
                            Feel free to ask us or your Masseur any questions about our services.
                        </p>

                        <div class="accordion-container">
                            <!-- All Massage Services -->
                            <div class="set">
                                <a>
                                    All Massage Services
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content" style="display: none;">
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
                                                            <tr>
                                                                <td class="table_border_dash_left">Oral</td>
                                                                <td class="table_border_solid_left"><span
                                                                        class="if_data_not_available">N/A</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table_border_dash_left">Masturbation</td>
                                                                <td class="table_border_solid_left"><div class="public-num-value-table"> <span>$ </span>150</div></td>
                                                            </tr>
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
                                                            <tr>
                                                                <td class="table_border_dash_left">Kissing</td>
                                                                <td class="table_border_solid_left"><span
                                                                        class="if_data_not_available">N/A</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table_border_dash_left">Deep throat</td>
                                                                <td class="table_border_solid_left"><span
                                                                        class="if_data_not_available">N/A</span></td>
                                                            </tr>
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
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="table_border_dash_left">&nbsp;</td>
                                                                <td class="table_border_solid_left"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  All Other Service Types -->
                            <div class="set">
                                <a>
                                    All Other Service Types
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content" style="display: none;">
                                    <div class="accodien_manage_padding_content">
                                        <div class="table-responsive">
                                            <div class="row margin_zero_for_table table-grid">
                                                <div class="padding_none" style="padding: 1px;">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" class="let-talk-about border-0"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="padding_none" style="padding: 1px;">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" style="padding-top: 15px;"
                                                                    class="let-talk-about border-0">Let's talk about it.</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="padding_none" style="padding: 1px;">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="background_color_table_head_color">
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Extra</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" class="let-talk-about border-0"></td>
                                                            </tr>
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


            </div>
            <!-- ffffffffff -->
            <!-- sssssssssssssssss -->
            <div class="col-md-4 profile-sidebar-margin-top">
                <!-- video crousal start -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 px-0">
                            <div id="carouselExampleInterval" class="carousel slide mc_view_media" data-ride="carousel"
                                data-interval="false">
                                <span class="mc_tooltip" data-toggle="modal" data-target="#exampleModal">Click to view My Media.</span>
                                <div class="carousel-inner">
                                    
                                    <!-- Carousel Item 1 -->
                                    <div class="carousel-item active" data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="assets/app/img/massage/mc7.jpg"
                                                    class="d-block w-100" alt="Gallery Image" data-toggle="modal"
                                                    data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carousel Item 2 -->
                                    <div class="carousel-item" data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="assets/app/img/massage/mc6.jpg"
                                                    class="d-block w-100" alt="Gallery Image" data-toggle="modal"
                                                    data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carousel Item 3 -->
                                    <div class="carousel-item" data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="assets/app/img/massage/mc5.jpg"
                                                    class="d-block w-100" alt="Gallery Image" data-toggle="modal"
                                                    data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carousel Item 4 -->
                                    <div class="carousel-item" data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="assets/app/img/massage/mc4.jpg"
                                                    class="d-block w-100" alt="Gallery Image" data-toggle="modal"
                                                    data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carousel Item 5 -->
                                    <div class="carousel-item" data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="assets/app/img/massage/mc3.jpg"
                                                    class="d-block w-100" alt="Gallery Image" data-toggle="modal"
                                                    data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Carousel Item 6 -->
                                    <div class="carousel-item" data-interval="10000">
                                        <div class="row">
                                            <div class="col-12 remove_padding_for_carousel">
                                                <img src="assets/app/img/massage/mc2.jpg"
                                                    class="d-block w-100" alt="Gallery Image" data-toggle="modal"
                                                    data-target="#exampleModal">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Carousel Controls -->
                                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleInterval" role="button"
                                    data-slide="next">
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
                        <button type="button" class="btn profile_message_btn_cc" data-toggle="modal"
                            data-target="#mysendmessage">
                            <img src="assets/app/img/smallsmsicon.png" class="image_20px_msg">Message Us
                        </button>
                    </div>
                    <div class="col-7 text-right">
                        <button type="button" class="btn profile_message_btn_cc" data-toggle="modal"
                            data-target="#reportMcNew">
                            <img src="assets/app/img/smallsmsicon.png" class="image_20px_msg">Report Masseurs
                        </button>
                    </div>
                </div>

                <!-- Hidden input (static example) -->
                <input type="hidden" name="escortId" value="123" id="eid">

                <!-- Like / Dislike Bar -->
                <div class="like_and_process_bar_padding d-flex align-items-center gap_tepx">
                    <div class="like_img">
                        <i id="dislike" class="fa fa-thumbs-o-down" title="Dislike" aria-hidden="true"></i>
                    </div>
                    <div class="process_bar_width like_mjo">
                        <div id="vote_bar" class="progress" style="height: 25px;">
                            <div class="progress-bar bg-danger progress-bar-stripped" style="width: 0%">0%</div>
                            <div class="progress-bar bg-success" style="width: 100%;">100%</div>
                        </div>
                    </div>
                    <div class="like_img">
                        <i id="like" class="fa fa-thumbs-o-up" title="Like" aria-hidden="true"></i>
                    </div>
                </div>

                <!-- Playmates Section -->
                {{-- <div class="box_shadow manage_padding_margin_bg_color">
                    <div class="profile_card_border profile_description_contect">
                        <h2><img src="assets/app/img/bedroom.svg"> Playmates</h2>
                    </div>
                    <div class="padding_20_tob_btm_side reduse_pad">
                        <p class="profile_description_contect_pera">Alina does not have any Playmates.</p>
                    </div>
                </div> --}}

                <!-- Contacting Me Section -->
                <div class="box_shadow manage_padding_margin_bg_color">
                    <div class="profile_card_border profile_description_contect">
                        <h2><img src="assets/app/img/contact_me.svg"> Contacting us</h2>
                    </div>
                    <div class="padding_20_tob_btm_side reduse_pad">
                        <span class="span_display_block connecting_me_chat_phone">
                            You can contact us by:<br>
                            <p class="font-weight-bold mb-0 mt-2">When texting us please say:</p>
                            <p class="profile_description_contect_pera">
                                <b><i>Hi, I found you on Escorts4U ...</i></b>
                                on our number 1438 028 743
                            </p>
                        </span>
                    </div>
                </div>

                <!-- Vaccination Status -->
                <div class="vax-btn">
                    <button type="button" class="btn my_legbox single-prof-btn">
                        <img src="assets/app/img/vaccinated.svg">Vaccinated, up to date
                    </button>
                </div>

                <!-- Accordion: Pricing Policy & Disclaimer -->
                <div class="accordion-container-new">
                    <div class="set">
                        <a class="pb-1 pt-1">
                           Our Pricing Policy
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="content">
                            <div class="accodien_manage_padding_content">
                                <p class="text-justify">Prices are all inclusive unless an extra is listed in Our Services,
                                     or you reach an agreement separately with the Masseur.</p>
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
                                <p class="text-justify">Any companionship which is agreed to between the Masseur and the client is not an offer or promise for
                                    prostitution or illegal activity. Anything that may occur between the Masseur and the client is their choice as
                                    consenting adults.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Carousel -->
                <div class="box_shadow padding_twelve_px">
                    <div class="profile_card_border profile_description_contect position-relative">
                        <h2><img src="assets/app/img/tips.svg">Tips</h2>
                    </div>
                    <div class="pt-2">
                        <div id="tipcrousal" class="carousel slide carousel_remove_in_tip" data-ride="carousel"
                            data-interval="5000">
                            <div class="carousel-inner">
                                <div class="carousel-item tip_carousel_item_text active">
                                        <p>Be on time.</p>
                                    </div>
                                    <div class="carousel-item tip_carousel_item_text">
                                        <p>Do not offer any of your personal information.</p>
                                    </div>
                                    <div class="carousel-item tip_carousel_item_text">
                                        <p>Ask questions; it’s okay.</p>
                                    </div>
                                    <div class="carousel-item tip_carousel_item_text">
                                        <p>Maintain good hygiene.</p>
                                    </div>
                                    <div class="carousel-item tip_carousel_item_text">
                                        <p>Keep your conversation light and non-suggestive.</p>
                                    </div>
                                    <div class="carousel-item tip_carousel_item_text">
                                        <p>Be clear about the service you are looking for.</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="box_shadow manage_padding_margin_bg_color box_shad_pad">
                    <div class="profile_card_border profile_page_box_heading">
                        <h2 class="custom--review"><img src="assets/app/img/review-custom.png"> Reviews</h2>
                    </div>
                    <div class="pt-3 row">
                        <div class="col-md-12">
                            <p class="testimonial"><strong>[MC Name]</strong> has no Reviews. Why don't you give them their first Review?</p>
                        </div>
                        {{-- <div class="col-md-12 mb-4"></div> --}}
                    </div>
                    {{-- <button type="button" class="btn add_reviews_btn all_btn_flx disabled-button open_review_box" data-toggle="modal" data-target="#add_reviews">
                        <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                        Login to Add Review
                    </button> --}}
                    <button type="button" class="btn add_reviews_btn all_btn_flx disabled-button open_review_box">
                        <img src="{{ asset('assets/app/img/feedbackicon.png') }}">
                        <a href="{{route("viewer.login")}}" style="color: white;">Login to Add Review</a>
                    </button>
                    
                </div>


            </div>
            <!-- sssssssssssssssss -->
        </div>
    </div>

    <!-- model start here 1-->
    <div class="modal fade" id="mysendmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color">

                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img
                            src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Message Us </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                @if (auth()->check() && auth()->user()->type == 0)
                    <div class="modal-body">
                        <h6 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                            <span id="Lname">To message Alina please go to your Dashboard and select
                                Communications > Messages. </span>
                        </h6>
                        <hr style="background-color: #0C223D">
                        <p class="mb-1 mt-3"><b>Notes:</b></p>
                        <ol>
                            <li>Make sure you have enabled Messaging in your settings. If you have added Alina to your
                                Legbox, they will appear in your Message list. Otherwise, you can search by Member ID.</li>
                            <li>To message Alina, they will also need to have Messaging enabled.</li>
                        </ol>
                    </div>
                    <div class="modal-footer text-center justify-content-center">
                        <a href="{{ route('user.viewer-messages') }}" type="button" class="btn-success-modal text-white"
                            id="loginUrl" style="text-decoration: none;">Go to Message</a>
                    </div>
                @else
                    <!-- if viewer not login -->
                    <div class="modal-body text-center">
                        <h5 class="popu_heading_style mb-4 mt-4">
                            <span id="Lname">Message Us is only available to Viewers.
                                Please log in or Register to access Message Us.</span>
                        </h5>
                        <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                        <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                       
                    </div>
                @endif
                <!--- end -->

            </div>
        </div>
    </div>
    <!-- model end here 1-->
    <!-- model start here 2-->

    <div class="modal fade" id="reportMcNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color">
               
                
                <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="custompopicon"> Report Masseur </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <!-- if viewer not login -->
            <div class="modal-body pb-0 teop-text" >
                <h6 class="popu_heading_style mb-4 mt-4 " style="text-align: center; color:#0C223D;">
                    <span id="Lname">Report Masseur is only available to Viewers. Please log in or Register to access Report Advertiser.</span>
                </h6>
                <div class="modal-footer text-center justify-content-center" >
                <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                </div>
            </div>
            <!--- end -->

        </div>
    </div>
</div>

    <div class="modal fade ss" id="sendcarlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color">
                    <img src="{{ asset('assets/app/img/alert.png') }}" class="custompopicon">
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Report {{-- [Name] --}} to
                        our team.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <form id="reviewAdvertiser" action="#" method="post">
                    <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group popup_massage_box">
                                    <p class="font-weight-bold">What is wrong:</p>
                                    <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="5"
                                        placeholder="Message (250 characters)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex  align-items-center">
                                    <p class="diff_font_pera mb-0 mr-2">Why are you reporting this Profile:</p>
                                    <div class="form-check py-0 mr-2">
                                        <input class="form-check-input" type="checkbox" name="photo_status"
                                            id="exampleRadios2" value="1">
                                        <span class="form-check-label" for="exampleRadios2">
                                            Fake Media
                                        </span>
                                    </div>
                                    <div class="form-check py-0 mr-2">
                                        <input class="form-check-input" type="checkbox" name="photo_status"
                                            id="exampleRadios2" value="0">
                                        <span class="form-check-label" for="exampleRadios2">
                                            Spam
                                        </span>
                                    </div>
                                    <div class="form-check py-0">
                                        <input class="form-check-input" type="checkbox" name="photo_status"
                                            id="exampleRadios2" value="2">
                                        <span class="form-check-label" for="exampleRadios2">
                                            Other
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr style="background-color: #0C223D">
                        <p class="mb-1 mt-3"><b>Notes:</b></p>
                        <ol>
                            <li>Only report if you had direct contact with the Massage Centre.</li>
                            <li>Do not write fake or abusive reports, as it may result in your Account being
                                suspended. Only genuine
                                reports will be considered.</li>
                            <li>The Massage Centre’s Member ID will automatically attach to this report.</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-success-modal">Send Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- model start here 3-->
    <div class="modal fade add_reviews" id="add_reviews" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color">
                    <img src="{{ asset('assets/app/img/feedbackicon.png') }}" class="custompopicon">
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel">Add review for [MC Name]
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <form id="reviewAdvertiser" action="#" method="post">
                    <input type="hidden" name="_token" value="UuIFvrcEqKkKmQRBOgnpguuLsEYEUO1qHwlvC49U">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group popup_massage_box">
                                    <p class="font-weight-bold">Tell us about your experience:</p>
                                    <textarea name="description" class="form-control popup_massage_box" id="exampleFormControlTextarea1" rows="5"
                                        placeholder="Message (250 characters)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="revew-myratings">
                            <p class="mb-0" style="font-size: 20px;">Rating:</p>
                            <div class="rating-stars">
                                <svg class="star" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                </svg>
                                 <svg class="star" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                </svg>
                                 <svg class="star" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                </svg>
                                 <svg class="star" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                </svg>
                                 <svg class="star" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#ccc" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3-6 3 1.5-6L3 8.5 9 8z"/>
                                </svg>
                                
                            </div>
                        </div>

                        <hr style="background-color: #0C223D">
                        <p class="mb-1 mt-3"><b>Notes :</b></p>
                        <ol>
                            <li>Only review if you had direct contact with the Massage Centre.</li>
                            <li>Do not write fake or abusive reviews, as they will not be published.</li>
                            <li>To contact this Massage Centre click on <a href="{{ route('user.viewer-messages') }}"
                                    style="color: #ff3c5f;" class="custom_links_design">Message Us</a>.
                            </li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-success-modal" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-success-modal">Submit Reviews</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- confirmation review modal --}}
        <div class="modal fade" id="review-submitted-popup" tabindex="-1" role="dialog" aria-labelledby="reportAdvertiserLabelNew" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
        
                    <!-- Header with navy background and [X] -->
                    <div class="modal-header" style="background-color: #0e2346; color: white; display: flex; justify-content: space-between; align-items: center; border-radius:0px">
                        <img src="{{ asset('assets/app/img/tick.png')}}"
                                        class="custompopicon">
                        <h5 class="modal-title font-weight-bold" id="reportAdvertiserLabelNew">Review Submitted</h5>
                        <button type="button" class="close text-danger font-weight-bold" data-dismiss="modal" aria-label="Close" style="font-size: 20px;" >
                        <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </button>
                    </div>
        
                    <!-- if logi Body content -->
                
                    <div class="modal-body text-center">
                        <h5 class="popu_heading_style mt-4">Thank you for your Review.</h5>
                        <h6 class="popu_heading_style mb-4 mt-2">
                        
                            Your Review for <span id="review-escort-name"></span> has been submitted for approval.
                        </h6>
                    
                    </div>
                    <div class="modal-footer pt-0" style="justify-content: center; ">
                        <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal"
                            id="close">Ok</button>
                    </div>
        
                </div>
            </div>
        </div>
    {{-- end --}}


    <!-- model start here 1-->
    <div class="modal fade" id="newmodal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color">
                    <img src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="icustompopicon">
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img
                            src="{{ asset('assets/app/img/smallsmsicon.png') }}" class="img-fluid"> Send New Harmony
                        Nature Massage a
                        message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
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
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Email address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Mobile</label>
                                    <input type="text" placeholder="Mobile number" maxlength="10" step="100"
                                        data-parsley-validation-threshold="1" data-parsley-trigger="keyup"
                                        data-parsley-type="number" class="form-control" name="phone">
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
                        <button type="submit" class="btn-success-modal">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade product_view" id="product_view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                     <h5 class="mc_member_id"> <img src="{{ asset('assets/app/img/Vector-31.png') }}" class="img-responsive"
                                    > Member ID: M60124-001 </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-4 mb-2 pt-1">
                    <div class="row">

                        <div class="col-md-4 product_img mc_profile_img pr-0">
                            <img src="{{ asset('assets/app/img/Frame-4181.png') }}" class="img-responsive"
                                style="width: 305px;height: 374px;object-fit: cover;">
                            <div class="veryfy_img">
                                <img src="{{ asset('assets/app/img/verify/unverified_light.png') }}">
                            </div>
                        </div>

                        <div class="col-md-1 product_img pl-0" style="display: grid;gap: 8px;">
                            <img src="{{ asset('assets/app/img/Frame-4201.png') }}" class="img-responsive"
                                style="width: 108px;height: 119px;object-fit: cover;">
                            <img src="{{ asset('assets/app/img/Frame-4211.png') }}" class="img-responsive"
                                style="width: 108px;height: 119px;object-fit: cover;"><img
                                src="{{ asset('assets/app/img/Frame-4222.png') }}" class="img-responsive"
                                style="width: 108px;height: 119px;object-fit: cover;">
                        </div>

                        <div class="col-md-7 product_content pl-5 pt-1 d-flex flex-column justify-content-between" style=""> 
                                                       
                                <div>
                                    <div class="mc_profile_info">
                                        <h3 class="mb-0">Jane Doe</h3>
                                        <span>AGE: <b>21</b></span>
                                       
                                        <div class="massage_type">                                       
                                            <div class="massage_type_info">                                           
                                                <img src="{{ asset('assets/dashboard/img/massage-only.png') }}">                                             
                                                <p class="mc_rate_tooltip">Massage only</p>                                         
                                            </div>
                                            <div class="massage_type_info">                                           
                                                    <img src="{{ asset('assets/dashboard/img/massage-with2.png') }}">
                                            <p class="mc_rate_tooltip">Massage with extras +2 hands.</p>                                      
                                            </div>
                                            <div class="massage_type_info">                                            
                                                    <img src="{{ asset('assets/dashboard/img/massage-with4.png') }}">
                                                <p class="mc_rate_tooltip">Massage with extras +4 hands.</p>                                    
                                            </div>                                        
                                        </div> 
                                    </div> 
                                <div class="mc_profile_modal">                                    
                                    <span><b>Mobile Number:</b> <span class="about_box_small_heading_value">0438 028 728</span></span>
                                    <span><b>Vaccination:</b> <span class="about_box_small_heading_value">Vaccinated, up to date</span></span>
                                </div>
                                <div class="mc_profile_modal">
                                    <span><b>Nationality:</b> <span class="about_box_small_heading_value">Australian</span></span>
                                    <span><b>Ethnicity:</b> <span class="about_box_small_heading_value">Thai</span></span>
                                </div>
                                <div class="mc_profile_modal d-block">
                                    <span><b>Massage Services:</b> <span class="about_box_small_heading_value">Deep tissue, Foot</span></span>
                                </div>

                                 <div class="mc_profile_modal d-block">
                                    <span><b>Other Service Types:</b> <span class="about_box_small_heading_value">Back stepping</span></span>
                                </div>
                                
                                
                                </div>
                                
                               <div>
                                    <h5 class="mb-0" style="color: #000">About Me</h5>
                                    <p class=" mt-0 text-justify">Hi everyone, I am Melani and I am here in Perth for all those guys who enjoy
                                        the thrill of being with that quite little girl who secretely really is that office slut. I
                                        am tall, slim and naughty when it matters. With smooth skin and long hair to run your hands
                                        through, and of course something...</p>
                                    </div>
                                </div>
                               
                            

                            
                        </div>
                        
                        <div class="col-lg-12 mt-2 p-0">
                            <div class="table-responsive-sm mc_avail_table">
                                <table class="table table-bordered">
                                    <thead class="bg-first">
                                        <tr>
                                            <th colspan="7" class="text-center">Availability</th>
                                        </tr>
                                        <tr>
                                            <th style="width:14.2%">Monday</th>
                                            <th style="width:14.2%">Tuesday</th>
                                            <th style="width:14.2%">Wednesday</th>
                                            <th style="width:14.2%">Thursday</th>
                                            <th style="width:14.2%">Friday</th>
                                            <th style="width:14.2%">Saturday</th>
                                            <th style="width:14.2%">Sunday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="na-label ">N/A</span></td>
                                            <td><span class="na-label ">N/A</span></td>
                                            <td>9:30am - 9:00pm</td>
                                            <td>9:30am - 9:00pm</td>
                                           <td><span class="na-label ">N/A</span></td>
                                            <td>10:00am - 9:00pm</td>
                                            <td>11:00am - 7:00pm</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- model end here 1-->






    {{-- My Photos --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header d-flex justify-content-between align-items-center">                                       
                    <ul class="nav nav-tabs justify-content-center border-0">
                        <li class="nav-item">
                            <a class="nav-link active" id="menu1-tab" data-toggle="tab" href="#menu1">My Photos</a>
                        </li>
                        {{-- @if ($galleryVideos->count()>0) --}}
                            <li class="nav-item">
                                <a class="nav-link" id="menu2-tab" data-toggle="tab" href="#menu2">My Videos</a>
                            </li>
                        {{-- @endif --}}
                    </ul>
                    <button type="button" class="p-0" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                
                <div class="modal-body p-1">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="profile-tab">
                            {{-- <div class="gallery">
                                @if($escort->gallary->isNotEmpty())


                                        <div class="gallery__item gallery__item--lg">
                                            <img src="{{ ($escort->gallary()->wherePivotIn('position',[1])->select('path')->first()) ? asset($escort->gallary()->wherePivotIn('position',[1])->select('path')->first()->path) : ''}}" alt="">
                                            
                                        </div>
                                        <div class="small-images">
                                        @foreach($escort->gallary()->wherePivot('type',0)->wherePivotIn('position',[2,3,4,5,6,7])->orderBy('position','asc')->get() as $key=>$media)
                                        
                                            <div class="gallery__item">
                                                <img src="{{ asset($media->path) }}" alt="">
                                            </div>

                                        @endforeach
                                    </div>
                                @endif
                            </div> --}}
                            <div class="gallery">
                                <div class="gallery__item gallery__item--lg">
                                    <img src="{{ asset('assets/app/img/massage/mc7.jpg') }}" alt="main">

                                    </div>
                                    <div class="small-images">
                                                                
                                    <div class="gallery__item">
                                        <img src="{{ asset('assets/app/img/massage/mc6.jpg') }}" alt="main">
                                    </div>

                                                                
                                    <div class="gallery__item">
                                        <img src="{{ asset('assets/app/img/massage/mc5.jpg') }}" alt="main">
                                    </div>

                                                                
                                    <div class="gallery__item">
                                       <img src="{{ asset('assets/app/img/massage/mc4.jpg') }}" alt="main">
                                    </div>

                                                                
                                    <div class="gallery__item">
                                        <img src="{{ asset('assets/app/img/massage/mc3.jpg') }}" alt="main">
                                    </div>

                                                                
                                    <div class="gallery__item">
                                        <img src="{{ asset('assets/app/img/massage/mc2.jpg') }}" alt="main">
                                    </div>

                                                                
                                    <div class="gallery__item">
                                        <img src="{{ asset('assets/app/img/massage/mc1.jpg') }}" alt="main">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row px-3 pb-2" id="dvSource">
                                
                                        {{-- @foreach($galleryVideos as $key=>$media) --}}
                                            <div class="col-md-4" id="dm_2">
                                                <a href="#">
                                                    {{-- <video style="z-index: 1" controls="" id="videoId_2" src="{{ asset($media->path) }}">
                                                        <source src="{{ asset($media->path) }}" type="video/mp4">
                                                    </video> --}}
                                                </a>
                                            </div>
                                        {{-- @endforeach --}}
                                    

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- end --}}

    {{-- my legbox --}}
    
    <div class="modal fade" id="my_legbox" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width rounded-0">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title popup_modal_title_new" id="exampleModalLabel"> <img src="{{ asset('assets/app/img/my-legbox.png')}}" class="custompopicon"> My Legbox</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    </span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="popu_heading_style mb-4 mt-4" style="text-align: center;">
                        <span id="Lname">My Legbox is only available to Viewers. Please log in or Register to access your Legbox.</span>
                    </h5>
                    <a href="{{ route('viewer.login') }}" type="button" class="site_btn_primary btn-cancel-modal" id="loginUrl" style="text-decoration: none;">Login</a>
                    <a href="{{ route('register') }}" type="button" class="site_btn_primary" id="regUrl" style="text-decoration: none;">Register</a>
                </div>
            </div>
        </div>
    </div>

    {{-- end --}}

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    {{-- <script type="text/javascript">
        $('#like').click(function() {
            var id = $("#eid").val();
            console.log("isdfsdf=", id);
            if (id != '') {
                $(this).removeClass('fa-thumbs-o-up');
                $("#dislike").removeClass('fa fa-thumbs-down');
                $(this).addClass('fa-thumbs-up');
                $("#dislike").addClass('fa fa-thumbs-o-down');
                var url = "{{ route('web.massageLikeDislike') }}"
                
                var id = "{{ $escort->id }}";
                $.post({
                    url,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    data: {
                        "like": 1,
                        "massageId": id
                    }
                }).done(function(data) {
                    console.log(data);
                    if (data.error == 2) {
                        $("#like").removeClass('fa fa-thumbs-up');
                        $("#dislike").removeClass('fa fa-thumbs-down');
                        $("#like").addClass('fa fa-thumbs-o-up');
                        $("#dislike").addClass('fa fa-thumbs-o-down');

                    }
                    $(".like").val(data.lp);
                    $("#like_per").html("<p>" + data.lp + "%</p>");

                    $(".dislike").val(data.dp);
                    $("#dis_per").html("<p>" + data.dp + "%</p>");
                }).fail(function(data) {

                });
            }
        });

        $('#dislike').click(function() {
            var id = $("#eid").val();
            if (id != '') {
                $(this).removeClass('fa-thumbs-o-down');
                $("#like").removeClass('fa fa-thumbs-up');
                $(this).addClass('fa-thumbs-down');
                $("#like").addClass('fa fa-thumbs-o-up');
                var url = "{{ route('web.massageLikeDislike') }}"
                var id = "{{ $escort->id }}";
                $.post({
                    url,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    data: {
                        "like": 0,
                        "massageId": id
                    }
                }).done(function(data) {

                    console.log(data);
                    if (data.error == 2) {
                        $("#like").removeClass('fa fa-thumbs-up');
                        $("#dislike").removeClass('fa fa-thumbs-down');
                        $("#like").addClass('fa fa-thumbs-o-up');
                        $("#dislike").addClass('fa fa-thumbs-o-down');

                    }
                    $(".dislike").val(data.dp);
                    $("#dis_per").html("<p>" + data.dp + "%</p>");

                    $(".like").val(data.lp);
                    $("#like_per").html("<p>" + data.lp + "%</p>");



                }).fail(function(data) {
                    console.log("Try again champ!", $('input[name="_token"]').val());
                });
            }

        });
        $(document).on('click', '.add_to_favrate', function() {

            var name = $(this).attr('data-name');

            var Eid = $(this).attr('data-escortId');
            console.log("name==" + Eid);
            var Uid = $(this).attr('data-userId');
            var cidcl = $(this).attr('class');
            var cid = cidcl.split(' ');
            if (cid[1] == 'fill') {
                $(this).removeClass('fill');
                $(this).addClass('null');
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart' style='color: #ff3c5f;' title='Remove from legbox' aria-hidden='true'></i>"
                );
                var url = "{{ route('user.save.massage.legbox', ':id') }} ";
                url = url.replace(':id', Eid);
                $('.class_msg').text(name + ' added to your Legbox');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);

                    }
                });
                console.log("fill");
            } else if (cid[1] == 'null') {
                $(this).removeClass('null');
                $(this).addClass('fill');
                $('#legboxId_' + Eid).html(
                    "<i class='fa fa-heart-o' title='Add to legbox' aria-hidden='true'></i>");
                var url = "{{ route('user.delete.massage.legbox', ':id') }} ";
                url = url.replace(':id', Eid);
                $('.class_msg').text(name + ' has been removed from your Legbox ');
                $('#add_wishlist').modal('show');
                $.ajax({
                    type: "post",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);

                    }
                });
                console.log("null");
            } else {
                $('#my_legbox').modal('show');
                var login_url = "{!! route('viewer.login', [':id', 'path' => 'center-profile']) !!}";
                var loginurl = login_url.replace(':id', 'MclegboxId=' + Eid);
                
                console.log(loginurl);

                
                var regurl = "{{ route('register', ':id') }}";

                regurl = regurl.replace(':id', 'MclegboxId=' + Eid)
                $('#loginUrl').attr('href', loginurl)
                $('#regUrl').attr('href', regurl)
            }



            console.log(cid[1] + "-" + Eid);
            console.log(cidcl);

        });
    </script> --}}
@endpush

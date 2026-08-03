@section('style')
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
<!-- Preloader -->
<div id="preloader" class="{{ View::hasSection('enable_loader') ? 'pre-active' : '' }}">
    <div class="loader"></div>
</div>

<footer class="e4u-footer">

    <div class="container-fluid">

        <!-- TOP -->

        <div class="row ">

            <div class="col-lg-12 my-2">
                <div class="footer-logo-wrapper">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/app/img/logo.png') }}" alt="logo" class="footer_logo"></a>
                    </div>


                    <div class="top-actions my-2">
                        @if (!auth()->user())
                        <ul class="footer_list_style_none footerbtn-flex custom--foter-login">
                            <li class="dropdown">
                                <a style="padding: 5px 15px;width:120px; border-radius:100px; text-align: center;"
                                    class="nav-link dropdown-toggle footer_reg_btn" id="navbarDropdownn" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="{{ route('register') }}">Register</a>
                                <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                                    <a class="dropdown-item" href="{{ route('advertiser.register') }}">Advertiser</a>
                                    <a class="dropdown-item" href="{{ route('register') }}">Viewer</a>
                                    <a class="dropdown-item" href="{{ route('agent.register') }}">Agent </a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a style="padding: 5px 15px; border-radius:100px; width:120px; text-align: center;"
                                    class="nav-link dropdown-toggle   footer_login_btn primery_color"
                                    id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" href="{{ route('register') }}">Log in</a>
                                <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                                    <a class="dropdown-item" href="{{ route('admin.login') }}">Admin</a>
                                    <a class="dropdown-item" href="{{ route('operator.login')}}">Operator</a>
                                    <a class="dropdown-item" href="{{ route('shareholder.login')}}">Shareholder</a>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- ADVERTISING STATEMENT -->

        <div class="statement-box">
            <h5>Advertising Statement</h5>

            <div id="statementContent" class="statement-content">
                <p>
                    The primary purpose of this Website is to permit adults to advertise their companionship to other adults.
                    Escorts4U helps Advertisers and Users find each other, what happens after that connection is made is up to them. We are not a party to any agreement, or involved in any interaction, between Advertisers and Users.

                    Any price indicated in an Advertiser's Profile relates to their time only and nothing else. Any service offered or whatever else that may occur is a mutual decision between consenting adults and is Private between them. It is your responsibility to be cognisant of and to comply with the Local Laws.
                    Further details may be found in the Terms and Conditions.</p>
            </div>
        </div>

        <!-- MAIN LINKS -->

        <div class="row">
            @php
            $viewType = 'grid';
            if (request()->get('view_type') === 'list') {
            $viewType = 'list';
            }
            @endphp
            <!-- Location - AUS -->
            <div class="col-md-6 col-lg-2">

                <h5 class="footer-title">Location - AUS</h5>

                <div class="footer-links location-grid">

                    @foreach (config('escorts.profile.cities') as $key => $city)
                    @php
                    $query = request()->query();
                    $query['city'] = $key;
                    $query['gender'] = '';
                    @endphp

                    <li><a href="{{ route('find.all', request()->segment(2)) .
                            '?' .
                            http_build_query(
                                array_merge(request()->query(), [
                                    'city' => $key,
                                    'gender' => '',
                                    'view_type' => $viewType,
                                ]),
                            ) }}"
                            class="footer_view_type_one" id="{{ $key }}">{{ $city }}</a></li>
                    @endforeach
                </div>

                <h5 class="footer-title ">Location - NZ</h5>

                <div class="footer-links location-grid">

                    @foreach (config('escorts.profile.nz_cities') as $key => $city)
                    @php
                    $query = request()->query();
                    $query['city'] = $key;
                    $query['gender'] = '';
                    @endphp

                    <li class="footer_view_type_one disabled-link"><a href="javascript:void(0);">{{ $city }}</a></li>
                    @if ($loop->iteration == 4)
                    @break
                    @endif
                    @endforeach
                </div>

            </div>

            <!-- LEGAL -->
            <div class="col-md-4 col-lg-4 ">

                <h5 class="footer-title">Legal</h5>

                <ul class="footer-links location-grid">
                    <li><a href="{{ url('acceptable-usage-policy') }}">Acceptable Usage Policy</a></li>
                    <li><a href="{{ url('cookie-policy') }}">Cookie Policy</a></li>
                    <li><a href="{{ url('copyright-statement') }}">Copyright Statement</a></li>
                    <li><a href="{{ url('covid-19-statement') }}">Covid-19 Statement</a></li>
                    <li><a href="{{ url('disclaimer-statement') }} ">Disclaimer Statement</a></li>
                    <li><a href="{{ url('law-enforcement') }} ">Law Enforcement</a></li>
                    <li><a href="{{ url('privacy-policy') }} ">Privacy Policy</a></li>
                    <li><a href="{{ url('privacy-collection-notice') }} ">Privacy Collection Notice</a></li>
                    <li><a href="{{ url('refund-policy') }} ">Refund Policy</a></li>
                    <li><a href="{{ url('spam-policy') }} ">Spam Policy</a></li>
                    <li><a href="{{ url('terms-conditions') }} ">Terms & Conditions</a></li>
                </ul>

            </div>

            <!-- COMMUNITY -->
            <div class="col-md-6 col-lg-4 ">

                <h5 class="footer-title">Community</h5>

                <ul class="footer-links location-grid">
                    <li><a href="{{ url('abbreviations') }} ">Abbreviations</a></li>
                    <li><a href="{{ url('alerts') }} ">Alerts</a></li>
                    <li><a href="{{ url('blogs') }}">Blog</a></li>
                    <li><a href="{{ url('contact-us') }} ">Contact Us</a></li>
                    <li><a href="{{ url('etiquette') }} ">Etiquette</a></li>
                    <li><a href="{{ url('faqs') }} ">FAQs</a></li>
                    <li><a href="{{ url('feedback') }}">Feedback</a></li>
                    <li><a href="{{ url('help-for-agents') }} ">Help for Agents</a></li>
                    <li><a href="{{ url('help-for-escorts') }} ">Help for Escorts</a></li>
                    <li><a href="{{ url('help-for-massage-centres') }} ">Help for Massage Centres</a></li>
                    <li><a href="{{ url('help-for-viewers') }} ">Help for Viewers</a></li>
                    <li><a href="{{ url('influencer') }} ">Influencer</a></li>
                </ul>

            </div>

            <!-- RESOURCES -->
            <div class="col-md-6 col-lg-2 ">

                <h5 class="footer-title">Resources</h5>

                <ul class="footer-links resource-item ">
                    <li> <a href="{{ 'https://agencymanagement.com.au' }}" target="_blank">
                            <div class="icon_boxs"><img src="{{ asset('assets/app/img/AM_icon-boxed.png') }}"></div>
                            Agency Management
                        </a></li>
                    <li><a href="{{ 'https://nationaluglymugs.com.au' }}" target="_blank">
                            <div class="icon_boxs"><img src="{{ asset('assets/app/img/Logo_NUM.png') }}"></div> NUM
                        </a>
                    </li>
                    <li><a href="{{ 'https://peamsaustralia.com.au' }}" target="_blank">
                            <div class="icon_boxs"><img src="{{ asset('assets/app/img/PEAMS_Icon.png') }}"></div> PEAMS
                            Australia
                        </a></li>
                    <li><a href="{{ 'https://punterbox.com.au' }}" target="_blank">
                            <div class="icon_boxs"><img src="{{ asset('assets/app/img/Icon_Punterbox.png') }}"></div>
                            Punterbox
                        </a>
                    </li>

                </ul>


            </div>

        </div>
        <!-- BOTTOM -->

        <div class="bottom-footer">

            <div class="row align-items-center">

                <div class="col-lg-4">

                    <div class="bottom-links">
                        <span class="cptby">© E4U 2026.</span>

                        <div class="b-links">
                            <a href="#" class="cook--seting">Cookie Settings</a>
                            <a href="{{ route('notice.dmca') }}">DMCA Notices</a>

                            <a href="{{ url('parent-control') }} ">Parent Control</a>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 delimp_copyright order-last order-md-0">
                    <span><img
                            src="{{ asset('assets/app/img/delimp-technology.png') }}"
                            alt="Delimp Technology Pvt. Ltd."> Built by <a href="https://delimp.com/" target="_blank">
                            Delimp Technology Pvt. Ltd. </a></span>
                </div>
                <div class="col-lg-4">

                    <div class="footer-social">
                        <span class="last-revision mr-3">
                            Last Revision: 1 June 2025
                        </span>
                        <span class="cptby">Follow Us : </span>
                        <span class="social-icons">
                            <a href="https://x.com/Escorts46919U" target="_blank"><img
                                    src="{{ asset('assets/app/img/twitter-x.png') }}" class="twitter-x-logo"
                                    alt="logo"></a>
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="modal fade upload-modal defult-modal" id="manage-consent" tabindex="-1" role="dialog"
        aria-labelledby="cookies-notice" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white" id="manage_consent"><img
                            src="{{ asset('assets/app/img/aeroupimg.png') }}" class="custompopicon"> Manage Consent
                        Preferences</h5>
                    <button type="button" class="main_bg_color border-0" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body pl-0">
                    <div class="container-fluid pl-0">
                        <div class="row">
                            <div class="col-md-4 p-x-0 p-y-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill"
                                        href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                        aria-selected="true">Strictly Necessary Cookies</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                        aria-selected="false">Performance Cookies</a>
                                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                        href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                        aria-selected="false">Functional Cookies</a>
                                </div>
                            </div>
                            <!-- /#admin-sidebar -->
                            <div class="col-md-8 p-x-3 p-y-1">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                                        aria-labelledby="v-pills-home-tab">
                                        These cookies are necessary for the Website to function and cannot
                                        be switched off in our systems. They are usually only set in response
                                        to actions made by you which amount to a request for services, such
                                        as setting your privacy preferences, logging in, selecting filters within
                                        the Advertiser Home Page or filling in any forms. You can set your
                                        browser to block or alert you about these cookies, but some parts of
                                        the Website may not then work. These cookies do not store any
                                        personally identifiable information about you.
                                        <p class="pt-4"><a href="#"
                                                class="termsandconditions_text_color">Always Active</a></p>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                        aria-labelledby="v-pills-profile-tab">
                                        These cookies allow us to count visits and traffic sources so we can
                                        measure and improve the performance of the Website. They help us
                                        to know which pages are the most and least popular and see how
                                        visitors move around the Website. All information these cookies
                                        collect is aggregated and therefore anonymous. If you do not allow
                                        these cookies we will not know when you have visited our Website,
                                        and will not be able to monitor its performance.
                                        <div class="custom-control custom-switch pt-2" style="padding-left: 35px;">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch_1">
                                            <label class="custom-control-label" for="customSwitch_1"></label>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                        aria-labelledby="v-pills-messages-tab">
                                        These cookies enable the Website to provide enhanced functionality
                                        and personalisation. They may be set by us or by third party providers
                                        whose services we have added to our pages <span
                                            class="termsandconditions_text_color">(see Concierge
                                            Services).</span> If you do not allow these cookies then some or all of
                                        these
                                        services may not function properly.
                                        <div class="custom-control custom-switch pt-2" style="padding-left: 35px;">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch_2">
                                            <label class="custom-control-label" for="customSwitch_2"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /#admin-main-control -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn main_bg_color site_btn_primary rounded btn-color"
                        id="saveAllCookies">Save All Settings</button>
                    <button type="button" class="btn main_bg_color site_btn_primary rounded "
                        style="background: #5D6D7E;border: #5D6D7E;" id="closeCookies">Reject All Cookies</button>
                    <button type="button"
                        class="btn main_bg_color site_btn_primary rounded btn-color color-change-id">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
    <div id="myFrontpop" class="modal upload-modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('assets/app/img/logo.png') }}" style="max-width: 195px; width:100%">
                </div>
                <div class="modal-body">
                    <h5 class="modal-title"><img src="{{ asset('assets/app/img/block-user.png') }}"
                            class="img-fluid"> User Agreement</h5>
                    <p>This Website contains sexually explicit material (<b>Explicit Material</b>). Do NOT continue if:
                    </p>
                    <ol class="pl-3">
                        <li>You are not at least 18 years of age or the age of majority in any jurisdiction that
                            you view the Explicit Material (<b>Age of Majority</b>).
                        </li>
                        <li>The Explicit Material offends you.</li>
                        <li>Viewing the Explicit Material is not legal in the location where you view it.</li>
                    </ol>
                    <p>To access this Website you must be over the Age of Majority and agree with the terms of entry
                        below.</p>
                    <p>Your Location:</p>
                    <form id="agreeMyForm">
                        <div class="form-group">
                            <select class="form-control loc" id="location_state" required name="location_state"
                                data-parsley-errors-container="#ch_lock"
                                data-parsley-required-message="Select your location">
                                <option style="font-weight: 500;" value="" disabled selected>No State Selected
                                </option>
                                @foreach (config('escorts.profile.states') as $key => $state)
                                <option style="font-weight: 500;" value="{{ $key }}">
                                    {{ $state['stateName'] }}
                                </option>
                                @endforeach
                            </select>
                            <span id="ch_lock"></span>
                            <p class="pt-2" style="font-size: 14px;">(Geolocation technology is active in this
                                Website (limited to your Capital City and/or State). Identifying your location will
                                pre-select your search criteria)</p>
                        </div>
                        <div class="form-check p-0 pl-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1"
                                required data-parsley-errors-container="#ch_name"
                                data-parsley-required-message="Please acknowledge the Declaration">
                            <p><label class="form-check-label" for="defaultCheck1">
                                    I declare I am over the Age of Majority and I agree to the <a
                                        href="{{ url('terms-conditions') }}"><span>Terms and Conditions</span></a> and
                                    <a href="{{ url('acceptable-usage-policy') }}"><span>Policies</span></a>.
                                </label>
                            </p>
                            </label>
                            <span id='ch_name' style="color:red"></span>
                        </div>
                        <button type="submit" class="btn-success-modal agree">I agree - Enter
                            Escorts4U</button>
                        <a class="pr-3" href="https://www.google.com/" style="text-align: center;display: flex;"
                            role="button">I disagree - Leave the Website</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Poup -->
    <div id="privacy-popup" class="popup-overlay custom--cookie--popup">
        <div class="popup-content">
            <div class="popup--header">
                <h2><img src="/assets/app/img/settings.png" class="custompopicon" alt="cross"> Privacy Preference
                    Center</h2>
                <a id="close-popup" class="close-btn"><img src="/assets/app/img/newcross.png" class=""
                        alt="cross"></a>
            </div>
            <div class="popup--content--area">
                <p>When you visit any website, it may store or retrieve information on your browser, mostly in
                    the form of cookies. This information might be about you, your preferences or your device
                    and is mostly used to make the website work as you expect it to. The information does not
                    usually directly identify you, but it can give you a more personalised web experience.
                </p>
                <p class="mt-2">Because we respect your right to privacy, you can choose not to allow some types of
                    cookies. Click on the different category headings to find out more and change our default
                    settings. However, blocking some types of cookies may impact your experience with this
                    Website and our service offering.</p>
                <a href="{{ route('web.cookie-policy') }}" target="_blank">More information</a>

                <div class="btn-group">
                    <button class="btn allow allowAllCookie">Allow All</button>
                </div>

                <div class="consent-section">
                    <h3>Manage Consent Preferences</h3>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span>Functional Cookies</span>
                            <label class="switch">
                                <input type="checkbox" class="functionalCookie">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="accordion-content">
                            <p>These cookies enable the Website to provide enhanced functionality and personalisation.
                                They may be set by us or by third party providers whose services we have added to our
                                pages
                                (see <a href="{{ route('web.help-for-advertisers') }}" target="_blank">Concierge
                                    Services</a>). If you do not allow these cookies then some or all of these services
                                may not function properly.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span>Strictly Necessary Cookies <strong class="always-active">Always
                                    Active</strong></span>
                        </div>
                        <div class="accordion-content">
                            <p>These cookies are necessary for the Website to function and cannot be switched off in our
                                systems. They are usually only set in response to actions made by you which amount to a
                                request for services, such as setting your privacy preferences, logging in, selecting
                                filters within the Advertiser Home Page or filling in any forms. You can set your
                                browser to block or alert you about these cookies, but some parts of the Website may not
                                then work. These cookies do not store any personally identifiable information about you.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span>Performance Cookies</span>
                            <label class="switch">
                                <input type="checkbox" class="performanceCookie">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="accordion-content">
                            <p>These cookies allow us to count visits and traffic sources so we can measure and improve
                                the performance of the Website. They help us to know which pages are the most and least
                                popular and see how visitors move around the Website. All information these cookies
                                collect is aggregated and therefore anonymous. If you do not allow these cookies we will
                                not know when you have visited our Website, and will not be able to monitor its
                                performance.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span>Targeting Cookies</span>
                            <label class="switch">
                                <input type="checkbox" class="targetingCookie">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="accordion-content">
                            <p>These cookies may be set through our Website by our advertising partners (as and when
                                they are appointed). They may be used by those companies to build a profile of your
                                interests and show you relevant adverts on other sites. They do not store directly
                                personal information, but are based on uniquely identifying your browser and internet
                                device. If you do not allow these cookies, you will experience less targeted
                                advertising.</p>
                        </div>
                    </div>
                </div>


            </div>

            <div class="footer-buttons">
                <button class="btn reject rejectAllCookies">Reject All</button>
                <button class="btn confirm saveAllCookiesSetting" id="saveAllCookies">Confirm My Choices</button>
            </div>
        </div>
    </div>
    <!--  -->

</footer>

<script src="{{ asset('assets/app/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/app/js/js.cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/js/jqueryuijs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
@include('partials.common.footer-scripts')
<script>
    $('#agreeMyForm').parsley({

    });
    $(document).ready(function() {
        @if(View::hasSection('enable_navigator'))
        navigator.geolocation.getCurrentPosition(async function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            getPinupProfile(latitude, longitude);
            const newUrl = "{{ route('public.web.escort.listing') }}" + `/?lat=${latitude}&lng=${longitude}`;
            const advertiserBtn = document.querySelector(".btn_advertiser");
            if (advertiserBtn) {
                let currentHref = advertiserBtn.getAttribute("href");
                advertiserBtn.setAttribute("href", newUrl);
            }
        });
        @endif

        var loginForm = $("#loginForm");

        loginForm.submit(function(e) {

            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData($("#loginForm")[0]);
            console.log(formData);
            var token = $('input[name="_token"]').attr('value');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-Token': token
                },
                success: function(data) {
                    window.location.href = "{{ route('find.all') }}";
                    console.log(data);
                },
                error: function(data) {

                    console.log("error: ", data.responseJSON.errors);
                    errorsHtml = '<div class="alert alert-danger"><ul>';

                    $.each(data.responseJSON.errors, function(key, value) {
                        errorsHtml += '<li>' + value +
                            '</li>'; //showing only the first error.
                    });

                    errorsHtml += '</ul></di>';
                    $('#formerror').html(errorsHtml);
                }
            });
        });

        $('#global-login-modal').on('hide.bs.modal', function() {
            $('#loginForm')[0].reset();
            $('#loginForm .alert').remove();
        });
    });
</script>
<!-- script for tip crousal start here -->
<script type="text/javascript">
    var totalItems = $('.item-01').length;
    var currentIndex = $('div.carousel-item').index() + 1;
    var down_index;
    $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
    $(".next-01").click(function() {
        currentIndex_active = $('div.carousel-item.active').index() + 2;
        if (totalItems >= currentIndex_active) {
            down_index = $('div.carousel-item.active').index() + 2;
            $('.num-01').html('' + currentIndex_active + '&nbsp;/&nbsp;' + totalItems + '');
        } else {
            down_index = 1; //just to make 0 to go to else part when back button is clicked
            $('.num-01').html('1' + '&nbsp;/&nbsp;' + totalItems + '');

        }
    });

    $(".prev-01").click(function() {
        down_index = down_index - 1;
        if (down_index >= 1) {
            $('.num-01').html('' + down_index + '&nbsp;/&nbsp;' + totalItems + '');
        } else {
            down_index = totalItems; //last slide value
            $('.num-01').html('' + totalItems + '&nbsp;/&nbsp;' + totalItems + '');
        }
    });

    $(".allowAllCookie").click(function() {
        $(".functionalCookie").prop('checked', true);
        $(".performanceCookie").prop('checked', true);
        $(".targetingCookie").prop('checked', true);
        saveAllCookies('allow');
    });
    /////////////Cookie Policy//////////////////
    // $(document).ready(function(){
    //     $("#onloadpopup .close").click(function(){
    //         $("#onloadpopup").removeClass("show");
    //         $("#onloadpopup").css('display', 'none');
    //     });

    //     if ($.cookie('onloadpopup') === 'cooki-policy') {
    //         $("#onloadpopup").removeClass("show");
    //         $("#onloadpopup").css('display', 'none');
    //     } else {
    //         $.cookie('onloadpopup', 'cooki-policy', { expires: 5});
    //         $("#onloadpopup").modal('show');
    //     }
    // });

    ////////////
    $(document).ready(function() {
        $(function() {
            var stateId;
            var url = window.location.pathname;
            console.log(url);
            // $(".agree").attr('disabled',true);
            $('body').on('change', '.loc', function() {
                var stateId = $(this).val();

            })

            var stateId = $.cookie('state-id');

            $("body").on('click', '.acceptCookies', function() {



                $.cookie('onloadpopup', 'cooki-policy', {
                    expires: 5
                });

                if ($('#customSwitch_1').is(":checked")) {
                    $.cookie('Performance-Cookies', 'on', {
                        expires: 5
                    });
                } else {

                    $.cookie('Performance-Cookies', 'off', {
                        expires: 5
                    });
                }

                if ($('#customSwitch_2').is(":checked")) {
                    $.cookie('Functional-Cookies', 'on', {
                        expires: 5
                    });
                } else {

                    $.cookie('Functional-Cookies', 'off', {
                        expires: 5
                    });
                }

                $("#myFrontpop").modal("hide");


                $("#onloadpopup").modal('hide');
                $("#cookies-notice").modal('hide');



            });

            $("body").on('click', '.agree', function() {

                if ($('#agreeMyForm').parsley().isValid()) {
                    //  var stateId = $('#location_state').data('value');
                    var stateId = $('#location_state').val();
                    $.cookie('user-agreement', 'true', {
                        expires: 5
                    });

                    // $.cookie('state-id', stateId, { expires: 5});
                    $.cookie('state-id', stateId, {
                        expires: 5
                    });
                    $.cookie('session-state-id', stateId);
                    $("#myFrontpop").modal("hide");

                    console.log('Ji ', $.cookie('user-agreement'), $.cookie(
                        'session-state-id'));
                    //$("#onloadpopup").modal('show');
                }

            });


            if ($.cookie('user-agreement') === 'true') {
                // $("#myFrontpop").on('hidden.bs.modal', function (e) {
                // });
                // $("#myFrontpop").css('display', 'none');
                //$("#onloadpopup").modal('show');
            } else {
                // $.cookie('user-agreement', 'user-agreement', { expires: 5});
                if (url != "/acceptable-usage-policy") {
                    $("#myFrontpop").modal("show");
                    // $("#myFrontpop").on('shown.bs.modal', function (e) {
                    // });

                }

            }
        });
        console.log("footer");
        var token = $('input[name="_token"]').attr('value');

        $.post({
            type: 'POST',
            url: "{{ route('web.state.name') }}",
            headers: {
                'X-CSRF-Token': token
            },
        }).done(function(data) {
            if (data.error == true) {
                console.log(data.stateName);

                //var st_name = $('#location_state').find(":selected").text(data.stateName);
                //var st_name = $('select[name="location_state"]').find(":selected").text(data.stateName);
                $("#location_state").find(`option:contains(${data.stateName})`).prop('selected', true);

            } else {

            }
        });


    });
    console.log($.cookie('user-agreement'));
    ////////////



    // video slider of EC and MC for profile page.
    const swipers = [];

    document.querySelectorAll('.mySwiper').forEach(function(el) {

        const swiper = new Swiper(el, {
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                type: 'fraction'
            },
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev')
            },
            observer: true,
            observeParents: true,
            resizeObserver: true,

            on: {
                slideChange: function() {

                    // Stop & Reload all videos of current slider
                    el.querySelectorAll('video').forEach(function(video) {
                        video.pause();
                        video.currentTime = 0;
                        video.load();
                    });

                    // Refresh Swiper
                    this.update();
                    this.updateSize();
                    this.updateSlides();
                }
            }
        });

        swipers.push(swiper);

    });

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {

        swipers.forEach(function(swiper) {

            swiper.update();
            swiper.updateSize();
            swiper.updateSlides();

            // Reload videos after tab becomes visible
            swiper.el.querySelectorAll('video').forEach(function(video) {
                video.load();
            });

        });

    });
</script>
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top-2').fadeIn();
            } else {
                $('#back-to-top-2').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top-2').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });

        // save btn
        $(".color-change-id").click(function() {
            var mycolor = 'background-color:#5D6D7E';
            $(".color-change-id").attr("style", mycolor);
            setTimeout(function() {
                $(".color-change-id").attr("style", 'background-color:#0c223d');
            }, 500);
        });
    });

    $(document).ready(function() {
        // Show the button only if content is taller than window
        if ($(document).height() > $(window).height()) {
            $('#back-to-bottom-2').show();
        } else {
            $('#back-to-bottom-2').hide();
        }

        // Scroll handler
        $('#back-to-bottom-2').fadeOut();
        $(window).scroll(function() {
            let scrollTop = $(this).scrollTop();
            let windowHeight = $(this).height();
            let documentHeight = $(document).height();

            // Check if at the bottom of the page
            if (scrollTop + windowHeight >= documentHeight - 10) {
                $('#back-to-bottom-2').fadeOut(); // Hide at bottom
            } else if (scrollTop > 10) {
                $('#back-to-bottom-2').fadeIn(); // Show when scrolling
            } else {
                $('#back-to-bottom-2').fadeOut(); // Hide at top
            }
        });

        // Scroll to bottom on click
        $('#back-to-bottom-2').click(function() {
            $('html, body').animate({
                scrollTop: $(document).height() - $(window).height()
            }, 400);
            return false;
        });
    });
</script>
<script>
    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 50) {
            $(".home--header").addClass("header--active");
        } else {
            $(".home--header").removeClass("header--active");
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.custom--cookie--popup .close-btn').click(function() {
            $('.custom--cookie--popup').removeClass('cookie--activate');
        });

        $('a.cook--seting').click(function() {
            $('.custom--cookie--popup').addClass('cookie--activate');

            if ($.cookie('Functional-Cookies') === 'on') {
                $('.functionalCookie').prop('checked', true);
            } else {
                $('.functionalCookie').prop('checked', false);
            }

            if ($.cookie('Targeting-Cookies') === 'on') {
                $('.targetingCookie').prop('checked', true);
            } else {
                $('.targetingCookie').prop('checked', false);
            }

            if ($.cookie('Performance-Cookies') === 'on') {
                $('.performanceCookie').prop('checked', true);
            } else {
                $('.performanceCookie').prop('checked', false);
            }

            $('.saveAllCookiesSetting').text('Confirm My Choices');
            $('.rejectAllCookies').text('Reject All');

        });
    });

    if ($.cookie('onloadpopup') === 'cooki-policy') {
        $('.custom--cookie--popup').removeClass('cookie--activate');
    } else {
        if ($.cookie('user-agreement') === 'true') {
            $('.custom--cookie--popup').addClass('cookie--activate');
        }
    }

    $("body").on('click', '.saveAllCookiesSetting', function() {
        $(this).text('Saving...');
        saveAllCookies('save');
    });

    $("body").on('click', '.close-popup', function() {
        saveAllCookies('close');
    });

    $("body").on('click', '.rejectAllCookies', function() {
        $(this).text('Rejecting...');
        $(".functionalCookie").prop('checked', false);
        $(".performanceCookie").prop('checked', false);
        $(".targetingCookie").prop('checked', false);
        saveAllCookies('reject');
    });

    /* if Targeting Cookies is enabled, then enable impact on the webiste store browswer info for future*/
    function targetCookieInfoGetUserDeviceDetails() {
        let targetData = {
            userAgent: navigator.userAgent,
            language: navigator.language,
            platform: navigator.platform,
            screenWidth: window.screen.width,
            screenHeight: window.screen.height,
        };
        return targetData;
    }

    /* if functionalCookie Cookies is enabled, then enable impact on the webiste store browswer info for future*/
    function functionalCookieInfoGetUserDeviceDetails() {
        let functionalData = {
            language: navigator.language || "en",
            theme: "dark",
            lastVisitedPage: window.location.pathname,
            conciergeEnabled: true
        };
        return functionalData;
    }

    /* if performanceCookie Cookies is enabled, then enable impact on the webiste store browswer info for future*/
    function performanceCookieInfoGetUserDeviceDetails() {
        let performanceData = {
            sessionId: crypto.randomUUID(),
            visitCount: (parseInt(localStorage.getItem("visitCount") || 0) + 1),
            lastVisitedPage: document.referrer || null,
            currentPage: window.location.pathname,
            timeStamp: new Date().toISOString()
        };

        return performanceData;
    }

    function saveAllCookies(savingType) {

        $.cookie('onloadpopup', 'cooki-policy', {
            expires: 5
        });

        if ($('.performanceCookie').is(":checked")) {
            $.cookie('Performance-Cookies', 'on', {
                expires: 5
            });

            // save user browser details to cookies on browser if Performance cookies is allowed
            $.cookie('Performance-Cookies-info', JSON.stringify(performanceCookieInfoGetUserDeviceDetails()), {
                expires: 5
            });

        } else {

            $.cookie('Performance-Cookies', 'off', {
                expires: 5
            });

            $.cookie('Performance-Cookies-info', 'empty', {
                expires: 5
            });
        }

        if ($('.functionalCookie').is(":checked")) {
            $.cookie('Functional-Cookies', 'on', {
                expires: 5
            });

            // save user browser details to cookies on browser if functional Cookie is allowed
            $.cookie('Functional-Cookies-info', JSON.stringify(functionalCookieInfoGetUserDeviceDetails()), {
                expires: 5
            });

        } else {
            $.cookie('Functional-Cookies', 'off', {
                expires: 5
            });

            $.cookie('Functional-Cookies-info', 'empty', {
                expires: 5
            });
        }

        if ($('.targetingCookie').is(":checked")) {
            $.cookie('Targeting-Cookies', 'on', {
                expires: 5
            });

            // save user browser details to cookies on browser if targeting cookies is allowed
            $.cookie('Targeting-Cookies-info', JSON.stringify(targetCookieInfoGetUserDeviceDetails()), {
                expires: 5
            });

        } else {
            $.cookie('Targeting-Cookies', 'off', {
                expires: 5
            });

            $.cookie('Targeting-Cookies-info', 'empty', {
                expires: 5
            });
        }

        if (savingType != 'allow') {
            setTimeout(function() {
                $('.custom--cookie--popup').removeClass('cookie--activate');
                if (savingType == 'save') {
                    $('.saveAllCookiesSetting').text('Confirm My Choices');
                }

                if (savingType == 'reject') {
                    $('.rejectAllCookies').text('Reject All');
                }
            }, 500);
        }


    }

    $(".accordion-header").on("click", function() {
        const $parent = $(this).parent();

        // Toggle only if it has content (i.e. not Strictly Necessary which is always active)
        if ($parent.find(".accordion-content").length) {
            $parent.toggleClass("active");
        }
    });

    jQuery(document).ready(function() {
        jQuery('.cstm-closeloadbutton').click(function() {
            jQuery('.onload--cookiepopup').addClass('remove--popup');
            jQuery('.modal-backdrop').addClass('remove--popup');
        });
    });
</script>



@stack('scripts')
</body>

</html>
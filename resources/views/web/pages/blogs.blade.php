@extends('layouts.web')
@section('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        
            .ui-datepicker table {
                display: none !important;
            }
            
            .ui-state-default.ui-state-highlight {
                background-color: var(--peach) !important;
                border-color: #ccc !important;
            }
            
            .ui-state-default.ui-state-active {
                background-color: var(--blue--text) !important;
                border-color: var(--blue--text) !important;
            }
            
            .filter-date:focus {
                outline: none;
                border: 2px solid var(--peach);
            }
            /* Header background */
            
            .ui-widget.ui-widget-content {
                width: 290px !important;
                width: 100%;
                border-radius: 5px;
                border: none !important;
            }
            
            .ui-datepicker .ui-datepicker-title {
                margin: 0 2.3em;
                line-height: 1.8em;
                text-align: center;
                display: flex;
                gap: 10px;
                justify-content: center;
            }
            
            .ui-datepicker {
                background: #ffffff;
                border-radius: 10px;
                border: 1px solid #ccc;
            }
            
            .ui-datepicker-header {
                background: #fff;
                color: #fff;
                border: none;
            }
            /* Month & Year dropdown */
            
            .ui-datepicker select {
                background: #022c3d;
                color: #fff;
                border: none;
                padding: 5px;
                border-radius: 5px;
            }
    </style>
@endsection
@section('content')
    <section class="padding_bottom_eight_px myblog-design details-card">
        <div class="blog-hero-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h1 class="blog-title text-uppercase mb-2">The Organised Private Escort</h1>
                        <h4 class="blog-subtitle text-uppercase">Welcome to the E4U Blog</h4>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/app/img/blog-13.png') }}" alt="Featured Image"
                            class="img-fluid blog-featured-image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-hero-section">
        <div class="container pb-5 our_blogs">
            <div class="row">
                <div class="col-sm-12 blog_tab">
                    <div class="blog_search_tab">
                        <form accept="" method="">
                            <div class="blog_form_field">
                                <input type="search" placeholder="Search by blog title" class="">
                                <button type="submit">Search</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {{-- Our Blogs --}}
                        <div class="col-lg-8 col-sm-12">
                            <div class="single-blog-item">
                                <h2 class="blog_head">Our Latest Blogs</h2>
                                <div class="our_latest_blog">
                                    {{-- blog card --}}
                                    <div class="card-content">
                                        <div class="card-img">
                                            <img src="{{ asset('assets/app/img/blogs/b1.jpg') }}">
                                            <small>30 jan 2026</small>
                                        </div>
                                        <div class="card-desc p-3 mb-3">
                                            <h3>Edging Tips For Better Orgasms</h3>

                                            <p class="pb-1 text-justify">Hi everyone, I am Melani and I am here in Perth for
                                                all those guys who enjoy the thrill of being with that quite little girl who
                                                secretely really is that office slut</p>
                                            <a href="{{ route('blogs.single') }}">Read More <svg fill="#ff3c5f"
                                                    width="10px" height="10px" viewBox="0 0 1920 1920"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g fill-rule="evenodd">
                                                            <path
                                                                d="M0 92.168 92.299 0l959.931 959.935L92.299 1920 0 1827.57l867.636-867.635L0 92.168Z">
                                                            </path>
                                                            <path
                                                                d="M868 92.168 960.299 0l959.931 959.935L960.299 1920 868 1827.57l867.64-867.635L868 92.168Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg></a>
                                        </div>
                                    </div>
                                    {{-- end --}}

                                    {{-- blog card --}}
                                    <div class="card-content">
                                        <div class="card-img">
                                            <img src="{{ asset('assets/app/img/blogs/b2.jpg') }}">
                                            <small>30 jan 2026</small>
                                        </div>
                                        <div class="card-desc p-3 mb-3">
                                            <h3>Deep Throat Tips You Should Know</h3>

                                            <p class="pb-1 text-justify">Hi everyone, I am Melani and I am here in Perth for
                                                all those guys who enjoy the thrill of being with that quite little girl who
                                                secretely really is that office slut</p>
                                            <a href="{{ route('blogs.single') }}">Read More <svg fill="#ff3c5f"
                                                    width="10px" height="10px" viewBox="0 0 1920 1920"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g fill-rule="evenodd">
                                                            <path
                                                                d="M0 92.168 92.299 0l959.931 959.935L92.299 1920 0 1827.57l867.636-867.635L0 92.168Z">
                                                            </path>
                                                            <path
                                                                d="M868 92.168 960.299 0l959.931 959.935L960.299 1920 868 1827.57l867.64-867.635L868 92.168Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg></a>
                                        </div>
                                    </div>
                                    {{-- end --}}


                                    {{-- blog card --}}
                                    <div class="card-content">
                                        <div class="card-img">
                                            <img src="{{ asset('assets/app/img/blogs/b3.jpg') }}">
                                            <small>30 jan 2026</small>
                                        </div>
                                        <div class="card-desc p-3 mb-3">
                                            <h3>How To Have Kinky Dreams</h3>

                                            <p class="pb-1 text-justify">Hi everyone, I am Melani and I am here in Perth for
                                                all those guys who enjoy the thrill of being with that quite little girl who
                                                secretely really is that office slut</p>
                                            <a href="{{ route('blogs.single') }}">Read More <svg fill="#ff3c5f"
                                                    width="10px" height="10px" viewBox="0 0 1920 1920"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g fill-rule="evenodd">
                                                            <path
                                                                d="M0 92.168 92.299 0l959.931 959.935L92.299 1920 0 1827.57l867.636-867.635L0 92.168Z">
                                                            </path>
                                                            <path
                                                                d="M868 92.168 960.299 0l959.931 959.935L960.299 1920 868 1827.57l867.64-867.635L868 92.168Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg></a>
                                        </div>
                                    </div>
                                    {{-- end --}}
                                </div>
                            </div>
                        </div>
                        {{-- Blog Archive --}}
                        <div class="col-lg-4 mb-5">
                            <div class="single-blog-item">
                                <h2 class="blog_head">Blog Archive</h2>

                                <div class="arc_blog_list">

                                    <!-- Search Form -->
                                    <form class="archive-form">
                                        <label for="archive-date">Search By Year & Month</label>
                                         <input type="text" class="filter-date" placeholder="Select Month and Year">
                                    </form>

                                    


                                    <!-- Archive List -->
                                    <div class="archive-list">

                                        <ul>
                                            <li><a href="#"> Deep Throat Tips You Should Know</a></li>
                                            <li><a href="#"> Edging Tips For Better Orgasms</a></li>
                                            <li><a href="#"> Keeping Your Sanity - Tips For Escorts</a></li>
                                            <li><a href="#"> How To Have Kinky Dreams</a></li>
                                            <li><a href="#"> How To Pick An Outfit For Sex Work</a></li>
                                            <li><a href="#"> Learn How To Master Conversation With An Escort</a></li>
                                            <li><a href="#"> Tips On Avoiding Nausea After Sex</a></li>
                                            <li><a href="#"> Summer Date Ideas With Your Elite Escort</a></li>
                                            <li><a href="#"> Difference Between PSE and GFE You Should Know</a></li>
                                            <li><a href="#"> Top Nightspots in Launceston To Take Your Escort</a>
                                            </li>
                                            <li><a href="#"> Tips for Giving an Unforgettable Massage</a></li>
                                            <li><a href="#"> The Art of Teasing and Denial</a></li>
                                            <li><a href="#"> Tips on Talking Dirty to Your Clients</a></li>
                                        </ul>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <nav aria-label="Page navigation" class="custom-pagination">

                        <ul class="list-unstyled d-flex justify-content-center align-items-center">

                            <!-- First -->
                            <li class="mx-1 disabled">
                                <a href="#" style="pointer-events:none; opacity:0.5;">
                                    <i class="fa fa-angle-double-left"></i> First
                                </a>
                            </li>

                            <!-- Previous -->
                            <li class="mx-1 disabled">
                                <a href="#" style="pointer-events:none; opacity:0.5;">
                                    <i class="fa fa-angle-left"></i> Previous
                                </a>
                            </li>

                            <!-- Ellipsis -->
                            {{-- <li class="mx-1">
                  <a href="#">...</a>
                  </li> --}}

                            <!-- Page Numbers -->
                            {{-- <li class="mx-1">
                  <a href="#" style="background:#0C223d; color:#fff;">3</a>
                  </li> --}}

                            <li class="mx-1">
                                <a href="#" style="background:#F2F2F2; color:#ff3c5f; font-weight:bold;">1</a>
                            </li>

                            <li class="mx-1">
                                <a href="#" style="background:#0C223d; color:#fff;">2</a>
                            </li>

                            <!-- Ellipsis -->
                            {{-- <li class="mx-1">
                  <a href="#">...</a>
                  </li> --}}

                            <!-- Next -->
                            <li class="mx-1">
                                <a href="#">
                                    Next <i class="fa fa-angle-right"></i>
                                </a>
                            </li>

                            <!-- Last -->
                            <li class="mx-1">
                                <a href="#">
                                    Last <i class="fa fa-angle-double-right"></i>
                                </a>
                            </li>

                        </ul>

                        <!-- Page Info -->
                        <div class="text-center mt-2 mb-5 col-sm-12" style="color:#ff3c5f; font-weight:400;">
                            Page 1 of 1 | Showing 3 to 3 of 3 Listings
                        </div>

                    </nav>
                </div>

            </div>
        </div>

    </section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
     <script>
        $(function(){

    $(".filter-date").datepicker({
        dateFormat: "MM yy",   // Example: February 2026
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        beforeShow: function(input, inst) {
            $(".ui-datepicker-calendar").hide();
        },

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

});
    </script>
@endpush

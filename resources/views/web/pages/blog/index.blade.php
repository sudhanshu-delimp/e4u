@extends('layouts.web')
@section('style')
    <style>
        .loader {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            z-index: 9999;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #888;
        }

        @media (max-width: 768px) {
            .blogs-layout {
                flex-direction: column;
            }
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
                        <div class="blog_form_field">
                            <input type="search" placeholder="Search by blog title" class="search-text">
                            <button id="searchBtn">
                                <span class="search-text">Search</span>
                                <span class="loader-sm d-none">⏳</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        {{-- Our Blogs --}}
                        <div class="col-lg-8 col-sm-12">
                            <div class="single-blog-item">
                                <h2 class="blog_head">Our Latest Bolgs</h2>
                                <div id="blogsLoader" class="loader"></div>
                                <div class="our_latest_blog blog-grid" id="blogsGrid">



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
                                        <input type="month" name="month" id="archive-date">
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
        </div>
    </section>
    <div id="base-url" data-blog-list="{{ route('blogs.list') }}"></div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            const LOADER = $('#blogsLoader');
            const GRID = $('#blogsGrid');
            let currentParams = {
                month: getCurrentMonth()
            };

            //Show Loader
            function showLoader() {
                LOADER.show();
                // $('.search-text').addClass('d-none');
                $('.loader-sm').removeClass('d-none');

            }
            //hide loader
            function hideLoader() {
                LOADER.hide();
                // $('.search-text').removeClass('d-none');
                $('.loader-sm').addClass('d-none');

            }


            // Load blogs
            function loadBlogs(params = {}) {
                showLoader();
                $.ajax({
                    url: $('#base-url').data('blog-list'),
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: params,
                    success: function(response) {
                        GRID.html(response.data.card);
                        hideLoader();
                    }
                });
            }

            //Initial Load
              const params = {
                    month:  getCurrentMonth()
                };
              
            loadBlogs(params);

            //On change Month

            $('#archive-date').on('change', function() {
                const params = {
                    month: $(this).val() || getCurrentMonth()
                };
                loadBlogs(params);
            });

            //search using titlt
            $('#searchBtn').click(debounce(function() {
                const params = {
                    search: $('.search-text').val(),
                   // month: $('#archive-date').val() || getCurrentMonth(),
                }
              
                loadBlogs(params);
            }, 300));

            function getCurrentMonth() {
                return new Date().toISOString().slice(0, 7); // 2026-02
            }

            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    }
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                }
            }


        });


        const monthInput = document.getElementById("archive-date");
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');

        monthInput.value = `${year}-${month}`;
    </script>
@endpush

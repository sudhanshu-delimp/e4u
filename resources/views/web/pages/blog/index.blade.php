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

    <style>
        .loader {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid #f3f3f3;
            border-top: 4px solid #ff3c5f;
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
                                    <div class="archive-form">
                                        <label for="archive-date">Search By Year & Month</label>
                                        <input type="text" class="filter-date" name="month" id="archive-date">
                                    </div>

                                    <!-- Archive List -->
                                    <div class="archive-list" id="archive-list">

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            const LOADER = $('#blogsLoader');
            const GRID = $('#blogsGrid');
            const ARCHIVELIST = $('#archive-list');
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
                        ARCHIVELIST.html(response.data.archive)
                        hideLoader();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        hideLoader();
                    }
                });
            }

            //Initial Load
            const params = {
                month: getCurrentMonth()
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


            function initDatePicker() {
                $(".filter-date").datepicker({
                    dateFormat: "MM yy", // Example: February 2026
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,

                    beforeShow: function(input, inst) {
                        $(".ui-datepicker-calendar").hide();
                    },

                    onClose: function(dateText, inst) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        var mon = `${year}-${month}`;
                        var params = {
                            month: mon ?? getCurrentMonth()
                        };
                        loadBlogs(params);
                        // call here ajax function not ajax
                        $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
                    }
                });
            }
            initDatePicker();


        });
    </script>
@endpush

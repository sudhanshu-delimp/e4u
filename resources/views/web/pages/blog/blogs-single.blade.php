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
    <section class="section blog-wrap bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb">
                        <a href="{{ route('blogs.index') }}">Blog <svg fill="#ff3c5f" width="10px" height="10px"
                                viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
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
                        <span> {{ $blogDetail['title'] ?? '' }} </span>
                    </div>


                </div>

                <div class="col-lg-8 mb-5">
                    <div class="single-blog-item">
                        <img src="{{ $blogDetail->blog_image ?? '' }}" alt="" class="img-fluid rounded">
                        <div class="blog-item-content mt-5">
                            <h2>{{ $blogDetail['title'] ?? '' }}</h2>
                            <div class="blog-item-meta bg-gray mb-4">
                                <span class="text-black text-capitalize mr-3">Posted:</span>
                                <span
                                    class="text-black text-capitalize mr-3">{{ $blogDetail['created_at']->format('d M Y') }}</span>
                            </div>
                            <hr>

                            {!! $blogDetail['description'] !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="single-blog-item">
                        <h2 class="blog_head">Blog Archive</h2>

                        <div class="arc_blog_list">

                            <!-- Search Form -->
                            <div class="archive-form">
                                <label for="archive-date">Search By Year & Month</label>
                                <input type="text" class="filter-date" name="month" id="archive-date"
                                    placeholder="Select Month and Year">
                            </div>

                            <div id="blogsLoader" class="loader"></div>
                            <!-- Archive List -->
                            <div class="archive-list" id="archive-list">

                            </div>

                        </div>
                    </div>
                </div>
                @if (!empty($previousBlog) || !empty($nextBlog))
                    <div class="col-lg-12 mb-5">
                        <div class="posts-nav bg-white p-5 d-lg-flex d-md-flex justify-content-between ">
                            @if ($previousBlog)
                                <a class="post-prev align-items-center"
                                    href="{{ route('blogs.detail', $previousBlog['slug']) }}">
                                    <div class="posts-prev-item mb-4 mb-lg-0">
                                        <span class="nav-posts-desc text-color">- Previous Post</span>
                                        <h6 class="nav-posts-title mt-1">
                                            {{ $previousBlog['title'] ?? '' }}
                                        </h6>
                                    </div>
                                </a>
                            @endif

                            @if (!empty($nextBlog))
                                <div class="border"></div>
                                <a class="posts-next" href="{{ route('blogs.detail', $nextBlog['slug']) }}">
                                    <div class="posts-next-item pt-4 pt-lg-0">
                                        <span class="nav-posts-desc text-lg-right text-md-right text-color d-block">- Next
                                            Post</span>
                                        <h6 class="nav-posts-title mt-1">
                                            {{ $nextBlog['title'] ?? '' }}
                                        </h6>
                                    </div>
                                </a>
                            @endif

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div id="base-url" data-blog-list="{{ route('blogs.list') }}"></div>
@endsection
@push('scripts')
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                const LOADER = $('#blogsLoader');
                const ARCHIVELIST = $('#archive-list');
                let currentParams = {
                    month: getCurrentMonth()
                };

                //Show Loader
                function showLoader() {
                    LOADER.show();
                }
                //hide loader
                function hideLoader() {
                    LOADER.hide();
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
                            ARCHIVELIST.html(response.data.archive)
                            hideLoader();
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            hideLoader();
                        }
                    });
                }


                function initDatePicker() {
                    loadBlogs({
                        month: getCurrentMonth()
                    });

                    $(".filter-date").datepicker({
                        dateFormat: "MM yy", // Example: February 2026
                        changeMonth: true,
                        changeYear: true,
                        showButtonPanel: true,

                        beforeShow: function(input, inst) {
                            $(".ui-datepicker-calendar").hide();
                        },
                        onClose: function(dateText, inst) {
                            let monthIndex = parseInt(
                                $("#ui-datepicker-div .ui-datepicker-month :selected").val(),
                                10
                            );
                            let year = parseInt(
                                $("#ui-datepicker-div .ui-datepicker-year :selected").val(),
                                10
                            );
                            let params = {
                                month: `${year}-${monthIndex + 1}`
                            };
                            console.log(params, 'params');
                            loadBlogs(params);

                            $(this).val(
                                $.datepicker.formatDate('MM yy', new Date(year, monthIndex, 1))
                            );
                        }
                    });
                }

                initDatePicker();

                function getCurrentMonth() {
                    return new Date().toISOString().slice(0, 7); // 2026-02
                }


            });
        </script>
    @endpush

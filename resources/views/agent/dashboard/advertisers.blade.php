@extends('layouts.agent')

@section('style')
<!-- Bootstrap Icons -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<style>
    /* SECTION */


    .common-grid-adv {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 22px;
    }

    .section-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .section-icon {
        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #fff1f4;
        color: #ff3c5f !important;

        font-size: 21px;
    }

    .section-icon i {
        color: #ff3c5f !important;
    }

    .section-title {
        margin: 0;

        font-size: 22px;
        font-weight: 700;

        color: #10233f;
    }




    /* ADVERTISER CARD */

    .advertiser-card {
        position: relative;

        min-width: 0;

        padding: 20px;

        border: 1px solid #e4eaf2;
        border-radius: 16px;

        background: #fff;

        box-shadow:
            0 5px 16px rgba(16, 35, 63, .06);

        overflow: hidden;

        transition:
            transform .25s ease,
            box-shadow .25s ease;
    }



    /* CARD TOP */

    .card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;
        border-bottom: 1px solid #e4eaf2;

        padding-bottom: 15px;
        margin-bottom: 17px;
    }

    .advertiser-info {
        display: flex;
        align-items: center;
        gap: 12px;

        min-width: 0;
    }

    .advertiser-avatar {
        width: 46px;
        height: 46px;

        flex: 0 0 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #fff0f4;
        color: #ff3c5f;

        font-weight: 750;
        font-size: 16px;
    }



    .advertiser-name {
        margin: 0 0 4px;

        font-size: 16px;
        font-weight: 700;

        color: #10233f;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .period {
        margin: 0;

        font-size: 13px;
        color: #7890ad;
    }


    /* GROWTH */

    .growth {

        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 7px;
        border-radius: 8px;
        background: #ffffff;
        color: #1da56a;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        border: 1px solid #e4eaf2;
    }

    .growth i {
        color: #1da56a;
    }

    /* CARD FILTER */

    .card-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .period-filter {
        position: relative;
    }

    .period-filter-btn {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #e4eaf2;
        border-radius: 8px;

        background: #fff;
        color: #ff3c5f;

        cursor: pointer;
        transition: all .2s ease;
    }

    .period-filter-btn:hover {
        background: #fff1f4;
        border-color: #ff3c5f;
    }

    .period-filter-btn i {
        font-size: 15px;
    }


    /* FILTER DROPDOWN */
    .period-filter-menu button {
        margin: .25rem 0 !important;
    }

    .period-filter-menu {
        position: absolute;

        top: calc(100% + 7px);
        right: 0;

        width: 120px;

        padding: 5px;

        background: #fff;

        border: 1px solid #e4eaf2;
        border-radius: 10px;

        box-shadow: 0 8px 25px rgba(16, 35, 63, .12);

        display: none;

        z-index: 1000;
    }

    .period-filter-menu.show {
        display: block;
    }


    /* OPTIONS */

    .period-option {
        width: 100%;

        padding: 8px 10px;

        border: 0;
        border-radius: 7px;

        background: transparent;

        text-align: left;

        font-size: 13px;
        font-weight: 600;

        color: #526982;

        cursor: pointer;
    }

    .period-option:hover {
        background: #fff1f4;
        color: #ff3c5f;
    }

    .period-option.active {
        background: #fff1f4;
        color: #ff3c5f;
    }

    /* METRICS */

    .card-main {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 10px;
    }

    .metrics {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        justify-content: space-between;
    }

    .metric-box {
        padding: 12px;

        border-radius: 9px;

        background: #f8fafc;
        width: max-content;
    }

    .metric-box.spend {
        background: #fff1f4;
        min-width: 120px;
        width: max-content;
    }

    .metric-box.commission {
        background: #f2f6fb;
        width: max-content;
    }

    .metric-label {
        display: flex;
        align-items: center;
        gap: 6px;

        margin-bottom: 5px;

        font-size: 12px;

        color: #778ca7;
    }

    .metric-box.spend .metric-label {
        color: #e53c5b;
    }

    .metric-value {
        font-size: 16px;
        font-weight: 750;

        color: #10233f;
    }


    /* ROI */

    .roi-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .roi-chart {
        position: relative;

        width: 84px;
        height: 84px;
    }

    .roi-chart canvas {
        width: 84px !important;
        height: 84px !important;
    }

    .roi-center {
        position: absolute;

        inset: 0;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        pointer-events: none;
    }

    .roi-percent {
        font-size: 15px;
        font-weight: 750;

        color: #10233f;
    }

    .roi-label {
        margin-top: 1px;

        font-size: 9px;
        font-weight: 650;

        color: #526982;
    }


    /* GRAPH */

    .graph-wrapper {
        position: relative;

        height: 105px;

        margin-top: 5px;
        margin-bottom: 8px;
    }

    .graph-wrapper canvas {
        width: 100% !important;
        height: 105px !important;
    }


    @media (max-width: 768px) {


        .page-title {
            font-size: 27px;
        }

        .page-icon {
            width: 48px;
            height: 48px;
        }

        .section-title {
            font-size: 19px;
        }


    }


    @media (max-width: 480px) {


        .page-title-wrapper {
            gap: 10px;
        }

        .page-title {
            font-size: 23px;
        }

        .advertiser-card {
            padding: 16px;
        }

        .card-main {
            grid-template-columns: 1fr;
        }

        .roi-wrapper {
            justify-content: flex-start;
        }

    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between col-md-12">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Top Advertisers</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>View your top Advertisers here.</li>
                        <li>To view any of these summaries in detail, go to the relevant page in the Side Bar Menu.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
    <div class="row">
        <div class="col-lg-12">
            <div class="advertiser-page">
                <!-- ESCORT -->
                <section class="common-card">
                    <div class="section-header">

                        <div class="section-title-wrapper">

                            <div class="section-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" class="icon_esc" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7Z" stroke="#ff3c5f" stroke-width="2"></path>
                                        <path d="M5 19.5C5 15.9101 7.91015 13 11.5 13H12.5C16.0899 13 19 15.9101 19 19.5V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V19.5Z" stroke="#ff3c5f" stroke-width="2"></path>
                                    </g>
                                </svg>
                            </div>

                            <h2 class="section-title">
                                Top Advertisers (Escort)
                            </h2>

                        </div>

                    </div>
                    <div class="common-grid-adv">
                        <!-- CARD 1 -->
                        <div class="advertiser-card first">

                            <div class="card-top">

                                <div class="advertiser-info">

                                    <div class="advertiser-avatar">
                                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 31.701 31.701" xml:space="preserve">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <polygon points="6.492,21.25 3.768,28.967 8.705,27.32 11.513,31.701 14.271,23.889 11.651,21.607 "></polygon>
                                                        <polygon points="25.21,21.25 20.052,21.607 17.431,23.889 20.188,31.701 22.996,27.32 27.934,28.967 "></polygon>
                                                        <path d="M23.957,19.572l0.32-4.617l3.039-3.489l-3.039-3.49l-0.32-4.617l-4.615-0.32L15.852,0l-3.491,3.039l-4.616,0.32 l-0.32,4.618l-3.038,3.49l3.038,3.489l0.32,4.616l4.617,0.319l3.491,3.037l3.49-3.037L23.957,19.572z M15.791,17.826 c-3.546,0-6.422-2.875-6.422-6.42s2.875-6.422,6.422-6.422c3.547,0,6.422,2.876,6.422,6.422 C22.213,14.952,19.337,17.826,15.791,17.826z"></path>
                                                        <polygon points="13.667,8.691 13.943,9.954 15.31,9.311 15.326,9.311 15.326,14.962 16.957,14.962 16.957,7.797 15.562,7.797 "></polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="advertiser-name">
                                            Carla Brasil
                                        </h3>

                                        <p class="period">
                                            Today
                                        </p>
                                    </div>

                                </div>
                                <div class="card-actions">
                                    <div class="growth">
                                        <i class="bi bi-arrow-up"></i>
                                        12%
                                    </div>

                                    <div class="period-filter">
                                        <button type="button"
                                            class="period-filter-btn"
                                            data-card="1">
                                            <i class="bi bi-funnel"></i>
                                        </button>

                                        <div class="period-filter-menu">
                                            <button type="button"
                                                class="period-option active"
                                                data-period="day">
                                                Day
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="month">
                                                Month
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="year">
                                                Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-main">

                                <div>

                                    <div class="metrics">

                                        <div class="metric-box spend">

                                            <div class="metric-label">
                                                <svg width="14px" height="14px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </svg>
                                                Spend
                                            </div>

                                            <div class="metric-value">
                                                $580.00
                                            </div>

                                        </div>


                                        <div class="metric-box commission">

                                            <div class="metric-label">
                                                <i class="bi bi-coin"></i>
                                                Commission
                                            </div>

                                            <div class="metric-value">
                                                $232.00
                                            </div>

                                        </div>

                                    </div>


                                    <div class="graph-wrapper">
                                        <canvas id="graph1"></canvas>
                                    </div>

                                </div>


                                <div class="roi-wrapper">

                                    <div class="roi-chart">

                                        <canvas id="roi1"></canvas>

                                        <div class="roi-center">
                                            <span class="roi-percent">40%</span>
                                            <span class="roi-label">ROI</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- CARD 2 -->
                        <div class="advertiser-card second">

                            <div class="card-top">

                                <div class="advertiser-info">

                                    <div class="advertiser-avatar">
                                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 31.701 31.701" xml:space="preserve">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <polygon points="6.492,21.25 3.768,28.967 8.705,27.32 11.513,31.701 14.271,23.889 11.651,21.607"></polygon>
                                                        <polygon points="25.21,21.25 20.052,21.607 17.431,23.889 20.188,31.701 22.996,27.32 27.934,28.967"></polygon>

                                                        <path d="M23.957,19.572l0.32-4.617l3.039-3.489l-3.039-3.49l-0.32-4.617l-4.615-0.32L15.852,0
                                                                l-3.491,3.039l-4.616,0.32l-0.32,4.618l-3.038,3.49l3.038,3.489l0.32,4.616l4.617,0.319
                                                                l3.491,3.037l3.49-3.037L23.957,19.572z
                                                                M15.791,17.826c-3.546,0-6.422-2.875-6.422-6.42
                                                                s2.875-6.422,6.422-6.422c3.547,0,6.422,2.876,6.422,6.422
                                                                C22.213,14.952,19.337,17.826,15.791,17.826z"></path>

                                                        <!-- NUMBER 2 -->
                                                        <path d="M13.4,9.2
                                                                    C13.8,8.3 14.6,7.7 15.6,7.7
                                                                    C17.0,7.7 17.8,8.5 17.8,9.6
                                                                    C17.8,10.6 17.2,11.3 16.2,12.1
                                                                    L14.8,13.3
                                                                    H17.9
                                                                    V15
                                                                    H13
                                                                    V13.6
                                                                    L15.3,11.5
                                                                    C15.8,11.1 16.1,10.7 16.1,10.2
                                                                    C16.1,9.7 15.8,9.4 15.4,9.4
                                                                    C14.9,9.4 14.6,9.8 14.5,10.3
                                                                    L13.4,9.2Z"></path>

                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="advertiser-name">
                                            Lin's Massage
                                        </h3>

                                        <p class="period">
                                            Today
                                        </p>
                                    </div>

                                </div>


                                <div class="card-actions">
                                    <div class="growth">
                                        <i class="bi bi-arrow-up"></i>
                                        12%
                                    </div>

                                    <div class="period-filter">
                                        <button type="button"
                                            class="period-filter-btn"
                                            data-card="2">
                                            <i class="bi bi-funnel"></i>
                                        </button>

                                        <div class="period-filter-menu">
                                            <button type="button"
                                                class="period-option active"
                                                data-period="day">
                                                Day
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="month">
                                                Month
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="year">
                                                Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-main">

                                <div>

                                    <div class="metrics">

                                        <div class="metric-box spend">

                                            <div class="metric-label">
                                                <svg width="14px" height="14px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </svg>
                                                Spend
                                            </div>

                                            <div class="metric-value">
                                                $580.00
                                            </div>

                                        </div>

                                        <div class="metric-box commission">

                                            <div class="metric-label">
                                                <i class="bi bi-coin"></i>
                                                Commission
                                            </div>

                                            <div class="metric-value">
                                                $232.00
                                            </div>

                                        </div>

                                    </div>


                                    <div class="graph-wrapper">
                                        <canvas id="graph2"></canvas>
                                    </div>

                                </div>


                                <div class="roi-wrapper">

                                    <div class="roi-chart">

                                        <canvas id="roi2"></canvas>

                                        <div class="roi-center">
                                            <span class="roi-percent">35%</span>
                                            <span class="roi-label">ROI</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- CARD 3 -->
                        <div class="advertiser-card third">

                            <div class="card-top">

                                <div class="advertiser-info">

                                    <div class="advertiser-avatar">
                                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 31.701 31.701" xml:space="preserve">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <polygon points="6.492,21.25 3.768,28.967 8.705,27.32 11.513,31.701 14.271,23.889 11.651,21.607"></polygon>
                                                        <polygon points="25.21,21.25 20.052,21.607 17.431,23.889 20.188,31.701 22.996,27.32 27.934,28.967"></polygon>

                                                        <path d="M23.957,19.572l0.32-4.617l3.039-3.489l-3.039-3.49l-0.32-4.617l-4.615-0.32L15.852,0
                                                            l-3.491,3.039l-4.616,0.32l-0.32,4.618l-3.038,3.49l3.038,3.489l0.32,4.616l4.617,0.319
                                                            l3.491,3.037l3.49-3.037L23.957,19.572z
                                                            M15.791,17.826c-3.546,0-6.422-2.875-6.422-6.42
                                                            s2.875-6.422,6.422-6.422c3.547,0,6.422,2.876,6.422,6.422
                                                            C22.213,14.952,19.337,17.826,15.791,17.826z"></path>

                                                        <!-- NUMBER 3 -->
                                                        <path d="M13.5,9.1
                                                                C13.9,8.2 14.7,7.7 15.7,7.7
                                                                C17.1,7.7 17.9,8.4 17.9,9.5
                                                                C17.9,10.2 17.5,10.7 16.9,11
                                                                C17.6,11.3 18,11.9 18,12.7
                                                                C18,14.1 17,15 15.6,15
                                                                C14.4,15 13.5,14.4 13.2,13.4
                                                                L14.5,12.7
                                                                C14.7,13.2 15.1,13.5 15.6,13.5
                                                                C16.1,13.5 16.4,13.2 16.4,12.7
                                                                C16.4,12.2 16.1,11.9 15.5,11.9
                                                                H15
                                                                V10.6
                                                                H15.5
                                                                C16,10.6 16.3,10.3 16.3,9.8
                                                                C16.3,9.4 16,9.2 15.6,9.2
                                                                C15.2,9.2 14.8,9.5 14.7,9.9
                                                                L13.5,9.1Z"></path>

                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="advertiser-name">
                                            Lin's Massage
                                        </h3>

                                        <p class="period">
                                            Today
                                        </p>
                                    </div>

                                </div>

                                <div class="card-actions">
                                    <div class="growth">
                                        <i class="bi bi-arrow-up"></i>
                                        12%
                                    </div>

                                    <div class="period-filter">
                                        <button type="button"
                                            class="period-filter-btn"
                                            data-card="3">
                                            <i class="bi bi-funnel"></i>
                                        </button>

                                        <div class="period-filter-menu">
                                            <button type="button"
                                                class="period-option active"
                                                data-period="day">
                                                Day
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="month">
                                                Month
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="year">
                                                Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-main">

                                <div>

                                    <div class="metrics">

                                        <div class="metric-box spend">

                                            <div class="metric-label">
                                                <svg width="14px" height="14px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </svg>
                                                Spend
                                            </div>

                                            <div class="metric-value">
                                                $580.00
                                            </div>

                                        </div>

                                        <div class="metric-box commission">

                                            <div class="metric-label">
                                                <i class="bi bi-coin"></i>
                                                Commission
                                            </div>

                                            <div class="metric-value">
                                                $232.00
                                            </div>

                                        </div>

                                    </div>


                                    <div class="graph-wrapper">
                                        <canvas id="graph3"></canvas>
                                    </div>

                                </div>


                                <div class="roi-wrapper">

                                    <div class="roi-chart">

                                        <canvas id="roi3"></canvas>

                                        <div class="roi-center">
                                            <span class="roi-percent">38%</span>
                                            <span class="roi-label">ROI</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </section>
                <!-- MASSAGE CENTER -->
                <section class="common-card my-4">
                    <div class="section-header">

                        <div class="section-title-wrapper">

                            <div class="section-icon">
                                <i class="bi bi-person-arms-up"></i>
                            </div>

                            <h2 class="section-title">
                                Top Advertisers (Massage Center)
                            </h2>

                        </div>

                    </div>
                    <div class="common-grid-adv">


                        <!-- CARD 4 -->

                        <div class="advertiser-card first">

                            <div class="card-top">

                                <div class="advertiser-info">

                                    <div class="advertiser-avatar">
                                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 31.701 31.701" xml:space="preserve">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <polygon points="6.492,21.25 3.768,28.967 8.705,27.32 11.513,31.701 14.271,23.889 11.651,21.607 "></polygon>
                                                        <polygon points="25.21,21.25 20.052,21.607 17.431,23.889 20.188,31.701 22.996,27.32 27.934,28.967 "></polygon>
                                                        <path d="M23.957,19.572l0.32-4.617l3.039-3.489l-3.039-3.49l-0.32-4.617l-4.615-0.32L15.852,0l-3.491,3.039l-4.616,0.32 l-0.32,4.618l-3.038,3.49l3.038,3.489l0.32,4.616l4.617,0.319l3.491,3.037l3.49-3.037L23.957,19.572z M15.791,17.826 c-3.546,0-6.422-2.875-6.422-6.42s2.875-6.422,6.422-6.422c3.547,0,6.422,2.876,6.422,6.422 C22.213,14.952,19.337,17.826,15.791,17.826z"></path>
                                                        <polygon points="13.667,8.691 13.943,9.954 15.31,9.311 15.326,9.311 15.326,14.962 16.957,14.962 16.957,7.797 15.562,7.797 "></polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="advertiser-name">
                                            Carla Brasil
                                        </h3>

                                        <p class="period">
                                            Today
                                        </p>
                                    </div>

                                </div>

                                <div class="card-actions">
                                    <div class="growth">
                                        <i class="bi bi-arrow-up"></i>
                                        12%
                                    </div>

                                    <div class="period-filter">
                                        <button type="button"
                                            class="period-filter-btn"
                                            data-card="4">
                                            <i class="bi bi-funnel"></i>
                                        </button>

                                        <div class="period-filter-menu">
                                            <button type="button"
                                                class="period-option active"
                                                data-period="day">
                                                Day
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="month">
                                                Month
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="year">
                                                Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-main">

                                <div>

                                    <div class="metrics">

                                        <div class="metric-box spend">

                                            <div class="metric-label">
                                                <svg width="14px" height="14px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </svg>
                                                Spend
                                            </div>

                                            <div class="metric-value">
                                                $580.00
                                            </div>

                                        </div>

                                        <div class="metric-box commission">

                                            <div class="metric-label">
                                                <i class="bi bi-coin"></i>
                                                Commission
                                            </div>

                                            <div class="metric-value">
                                                $232.00
                                            </div>

                                        </div>

                                    </div>

                                    <div class="graph-wrapper">
                                        <canvas id="graph4"></canvas>
                                    </div>

                                </div>


                                <div class="roi-wrapper">

                                    <div class="roi-chart">

                                        <canvas id="roi4"></canvas>

                                        <div class="roi-center">
                                            <span class="roi-percent">42%</span>
                                            <span class="roi-label">ROI</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- CARD 5 -->

                        <div class="advertiser-card second">

                            <div class="card-top">

                                <div class="advertiser-info">

                                    <div class="advertiser-avatar">
                                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 31.701 31.701" xml:space="preserve">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <polygon points="6.492,21.25 3.768,28.967 8.705,27.32 11.513,31.701 14.271,23.889 11.651,21.607"></polygon>
                                                        <polygon points="25.21,21.25 20.052,21.607 17.431,23.889 20.188,31.701 22.996,27.32 27.934,28.967"></polygon>

                                                        <path d="M23.957,19.572l0.32-4.617l3.039-3.489l-3.039-3.49l-0.32-4.617l-4.615-0.32L15.852,0
                                                                l-3.491,3.039l-4.616,0.32l-0.32,4.618l-3.038,3.49l3.038,3.489l0.32,4.616l4.617,0.319
                                                                l3.491,3.037l3.49-3.037L23.957,19.572z
                                                                M15.791,17.826c-3.546,0-6.422-2.875-6.422-6.42
                                                                s2.875-6.422,6.422-6.422c3.547,0,6.422,2.876,6.422,6.422
                                                                C22.213,14.952,19.337,17.826,15.791,17.826z"></path>

                                                        <!-- NUMBER 2 -->
                                                        <path d="M13.4,9.2
                                                                    C13.8,8.3 14.6,7.7 15.6,7.7
                                                                    C17.0,7.7 17.8,8.5 17.8,9.6
                                                                    C17.8,10.6 17.2,11.3 16.2,12.1
                                                                    L14.8,13.3
                                                                    H17.9
                                                                    V15
                                                                    H13
                                                                    V13.6
                                                                    L15.3,11.5
                                                                    C15.8,11.1 16.1,10.7 16.1,10.2
                                                                    C16.1,9.7 15.8,9.4 15.4,9.4
                                                                    C14.9,9.4 14.6,9.8 14.5,10.3
                                                                    L13.4,9.2Z"></path>

                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="advertiser-name">
                                            Lin's Massage
                                        </h3>

                                        <p class="period">
                                            Today
                                        </p>
                                    </div>

                                </div>

                                <div class="card-actions">
                                    <div class="growth">
                                        <i class="bi bi-arrow-up"></i>
                                        12%
                                    </div>

                                    <div class="period-filter">
                                        <button type="button"
                                            class="period-filter-btn"
                                            data-card="5">
                                            <i class="bi bi-funnel"></i>
                                        </button>

                                        <div class="period-filter-menu">
                                            <button type="button"
                                                class="period-option active"
                                                data-period="day">
                                                Day
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="month">
                                                Month
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="year">
                                                Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-main">

                                <div>

                                    <div class="metrics">

                                        <div class="metric-box spend">

                                            <div class="metric-label">
                                                <svg width="14px" height="14px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </svg>
                                                Spend
                                            </div>

                                            <div class="metric-value">
                                                $580.00
                                            </div>

                                        </div>

                                        <div class="metric-box commission">

                                            <div class="metric-label">
                                                <i class="bi bi-coin"></i>
                                                Commission
                                            </div>

                                            <div class="metric-value">
                                                $232.00
                                            </div>

                                        </div>

                                    </div>

                                    <div class="graph-wrapper">
                                        <canvas id="graph5"></canvas>
                                    </div>

                                </div>


                                <div class="roi-wrapper">

                                    <div class="roi-chart">

                                        <canvas id="roi5"></canvas>

                                        <div class="roi-center">
                                            <span class="roi-percent">37%</span>
                                            <span class="roi-label">ROI</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- CARD 6 -->

                        <div class="advertiser-card third">

                            <div class="card-top">

                                <div class="advertiser-info">

                                    <div class="advertiser-avatar">
                                        <svg fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 31.701 31.701" xml:space="preserve">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <g>
                                                        <polygon points="6.492,21.25 3.768,28.967 8.705,27.32 11.513,31.701 14.271,23.889 11.651,21.607"></polygon>
                                                        <polygon points="25.21,21.25 20.052,21.607 17.431,23.889 20.188,31.701 22.996,27.32 27.934,28.967"></polygon>

                                                        <path d="M23.957,19.572l0.32-4.617l3.039-3.489l-3.039-3.49l-0.32-4.617l-4.615-0.32L15.852,0
                                                            l-3.491,3.039l-4.616,0.32l-0.32,4.618l-3.038,3.49l3.038,3.489l0.32,4.616l4.617,0.319
                                                            l3.491,3.037l3.49-3.037L23.957,19.572z
                                                            M15.791,17.826c-3.546,0-6.422-2.875-6.422-6.42
                                                            s2.875-6.422,6.422-6.422c3.547,0,6.422,2.876,6.422,6.422
                                                            C22.213,14.952,19.337,17.826,15.791,17.826z"></path>

                                                        <!-- NUMBER 3 -->
                                                        <path d="M13.5,9.1
                                                                C13.9,8.2 14.7,7.7 15.7,7.7
                                                                C17.1,7.7 17.9,8.4 17.9,9.5
                                                                C17.9,10.2 17.5,10.7 16.9,11
                                                                C17.6,11.3 18,11.9 18,12.7
                                                                C18,14.1 17,15 15.6,15
                                                                C14.4,15 13.5,14.4 13.2,13.4
                                                                L14.5,12.7
                                                                C14.7,13.2 15.1,13.5 15.6,13.5
                                                                C16.1,13.5 16.4,13.2 16.4,12.7
                                                                C16.4,12.2 16.1,11.9 15.5,11.9
                                                                H15
                                                                V10.6
                                                                H15.5
                                                                C16,10.6 16.3,10.3 16.3,9.8
                                                                C16.3,9.4 16,9.2 15.6,9.2
                                                                C15.2,9.2 14.8,9.5 14.7,9.9
                                                                L13.5,9.1Z"></path>

                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="advertiser-name">
                                            Lin's Massage
                                        </h3>

                                        <p class="period">
                                            Today
                                        </p>
                                    </div>

                                </div>

                                <div class="card-actions">
                                    <div class="growth">
                                        <i class="bi bi-arrow-up"></i>
                                        12%
                                    </div>

                                    <div class="period-filter">
                                        <button type="button"
                                            class="period-filter-btn"
                                            data-card="6">
                                            <i class="bi bi-funnel"></i>
                                        </button>

                                        <div class="period-filter-menu">
                                            <button type="button"
                                                class="period-option active"
                                                data-period="day">
                                                Day
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="month">
                                                Month
                                            </button>

                                            <button type="button"
                                                class="period-option"
                                                data-period="year">
                                                Year
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-main">

                                <div>

                                    <div class="metrics">

                                        <div class="metric-box spend">

                                            <div class="metric-label">
                                                <svg width="14px" height="14px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </g>
                                                </svg>
                                                Spend
                                            </div>

                                            <div class="metric-value">
                                                $580.00
                                            </div>

                                        </div>

                                        <div class="metric-box commission">

                                            <div class="metric-label">
                                                <i class="bi bi-coin"></i>
                                                Commission
                                            </div>

                                            <div class="metric-value">
                                                $232.00
                                            </div>

                                        </div>

                                    </div>

                                    <div class="graph-wrapper">
                                        <canvas id="graph6"></canvas>
                                    </div>

                                </div>


                                <div class="roi-wrapper">

                                    <div class="roi-chart">

                                        <canvas id="roi6"></canvas>

                                        <div class="roi-center">
                                            <span class="roi-percent">45%</span>
                                            <span class="roi-label">ROI</span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="row d-none">
        <div class="col-md-12">
            <div class="common-grid-adv">
                <div class="common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 256 178" enable-background="new 0 0 256 178" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M183.882,38.248c0,8.995,7.292,16.287,16.287,16.287c8.995,0,16.287-7.292,16.287-16.287s-7.292-16.287-16.287-16.287 C191.174,21.961,183.882,29.253,183.882,38.248z M167.193,92.774v-12.72c0-11.179,9.126-20.349,20.349-20.349h26.642 c11.179,0,20.349,9.126,20.349,20.349v12.72H167.193z M95.721,2.416v23.543c-2.871,0-8.236,0.615-12.1,1.784 c-10.322,3.123-19.031,10.11-24.369,21.786L2,175.584h78.75l5.069-16.893c22.193-5.386,38.809-22.446,45.51-43.894l0.084,0.001 c0.167-0.748,0.389-1.483,0.627-2.214H254V2.416H95.721z M246.125,104.709H115.408c-2.957,15.124-14.146,28.884-29.224,35.043 c-0.487,0.199-0.992,0.293-1.488,0.293c-1.552,0-3.023-0.924-3.647-2.449c-0.822-2.013,0.143-4.311,2.156-5.134 c14.768-6.032,25.085-20.66,25.105-35.583v-3.981h40.386c5.966-0.001,10.803-4.837,10.803-10.803c0-5.962-4.83-10.797-10.793-10.802 l-70.91-0.053c-2.174,0-3.938-1.763-3.938-3.938s1.763-3.938,3.938-3.938h25.799V10.291h142.529V104.709z M115.408,25.959H159.5 v7.875h-44.092V25.959z M115.408,45.647H159.5v7.875h-44.092V45.647z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <div class="card-heading">
                            <h2>Escort Registrations </h2>
                        </div>
                    </div>
                    <div class="common-stars">
                        <div class="stats-detail">
                            <div class="stats-label">New today
                            </div>
                            <div class="stats-value">$ 280</div>
                        </div>

                        <div class="stats-detail">
                            <div class="stats-label">Week to Date


                            </div>
                            <div class="stats-value">$ 280</div>
                        </div>

                        <div class="stats-detail">
                            <div class="stats-label">Month to Date


                            </div>
                            <div class="stats-value">$ 580</div>
                        </div>
                    </div>
                </div>
                <div class="common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 256 178" enable-background="new 0 0 256 178" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M183.882,38.248c0,8.995,7.292,16.287,16.287,16.287c8.995,0,16.287-7.292,16.287-16.287s-7.292-16.287-16.287-16.287 C191.174,21.961,183.882,29.253,183.882,38.248z M167.193,92.774v-12.72c0-11.179,9.126-20.349,20.349-20.349h26.642 c11.179,0,20.349,9.126,20.349,20.349v12.72H167.193z M95.721,2.416v23.543c-2.871,0-8.236,0.615-12.1,1.784 c-10.322,3.123-19.031,10.11-24.369,21.786L2,175.584h78.75l5.069-16.893c22.193-5.386,38.809-22.446,45.51-43.894l0.084,0.001 c0.167-0.748,0.389-1.483,0.627-2.214H254V2.416H95.721z M246.125,104.709H115.408c-2.957,15.124-14.146,28.884-29.224,35.043 c-0.487,0.199-0.992,0.293-1.488,0.293c-1.552,0-3.023-0.924-3.647-2.449c-0.822-2.013,0.143-4.311,2.156-5.134 c14.768-6.032,25.085-20.66,25.105-35.583v-3.981h40.386c5.966-0.001,10.803-4.837,10.803-10.803c0-5.962-4.83-10.797-10.793-10.802 l-70.91-0.053c-2.174,0-3.938-1.763-3.938-3.938s1.763-3.938,3.938-3.938h25.799V10.291h142.529V104.709z M115.408,25.959H159.5 v7.875h-44.092V25.959z M115.408,45.647H159.5v7.875h-44.092V45.647z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <div class="card-heading">
                            <h2>Centre Registrations </h2>
                        </div>
                    </div>
                    <div class="common-stars">
                        <div class="stats-detail">
                            <div class="stats-label">Today
                            </div>
                            <div class="stats-value">$ 280</div>
                        </div>

                        <div class="stats-detail">
                            <div class="stats-label">Week to Date


                            </div>
                            <div class="stats-value">$ 280</div>
                        </div>

                        <div class="stats-detail">
                            <div class="stats-label">Month to Date


                            </div>
                            <div class="stats-value">$ 580</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    /*    CARD PERIOD DATA */

    const cardPeriodData = {

        1: {
            day: {
                spend: "$580.00",
                commission: "$232.00",
                roi: 40,
                growth: "12%",
                values: [80, 125, 180, 210, 290, 360, 430, 520]
            },

            month: {
                spend: "$1,850.00",
                commission: "$740.00",
                roi: 52,
                growth: "18%",
                values: [80, 180, 280, 390, 520, 650, 780]
            },

            year: {
                spend: "$18,500.00",
                commission: "$7,400.00",
                roi: 68,
                growth: "24%",
                values: [
                    120, 180, 250, 310,
                    390, 450, 520, 580,
                    650, 720, 780, 850
                ]
            }
        },


        2: {
            day: {
                spend: "$420.00",
                commission: "$168.00",
                roi: 35,
                growth: "10%",
                values: [70, 120, 165, 220, 280, 350, 420, 510]
            },

            month: {
                spend: "$1,600.00",
                commission: "$640.00",
                roi: 48,
                growth: "16%",
                values: [100, 180, 260, 350, 450, 560, 680]
            },

            year: {
                spend: "$16,000.00",
                commission: "$6,400.00",
                roi: 62,
                growth: "21%",
                values: [
                    120, 200, 280, 360,
                    450, 540, 630, 720,
                    810, 900, 1000, 1100
                ]
            }
        },


        3: {
            day: {
                spend: "$500.00",
                commission: "$200.00",
                roi: 38,
                growth: "11%",
                values: [80, 130, 180, 240, 300, 370, 450, 540]
            },

            month: {
                spend: "$1,900.00",
                commission: "$760.00",
                roi: 55,
                growth: "19%",
                values: [90, 180, 280, 390, 510, 650, 800]
            },

            year: {
                spend: "$19,000.00",
                commission: "$7,600.00",
                roi: 70,
                growth: "27%",
                values: [
                    130, 220, 320, 430,
                    550, 680, 810, 950,
                    1080, 1200, 1350, 1500
                ]
            }
        },


        4: {
            day: {
                spend: "$450.00",
                commission: "$180.00",
                roi: 42,
                growth: "13%",
                values: [70, 120, 165, 220, 280, 350, 420, 510]
            },

            month: {
                spend: "$1,700.00",
                commission: "$680.00",
                roi: 53,
                growth: "17%",
                values: [90, 170, 260, 360, 470, 590, 720]
            },

            year: {
                spend: "$17,000.00",
                commission: "$6,800.00",
                roi: 65,
                growth: "23%",
                values: [
                    120, 200, 290, 390,
                    500, 620, 750, 880,
                    1010, 1150, 1300, 1450
                ]
            }
        },


        5: {
            day: {
                spend: "$400.00",
                commission: "$160.00",
                roi: 37,
                growth: "9%",
                values: [100, 150, 210, 270, 330, 400, 470, 550]
            },

            month: {
                spend: "$1,500.00",
                commission: "$600.00",
                roi: 50,
                growth: "15%",
                values: [100, 190, 290, 400, 520, 640, 760]
            },

            year: {
                spend: "$15,000.00",
                commission: "$6,000.00",
                roi: 60,
                growth: "20%",
                values: [
                    110, 190, 280, 380,
                    490, 600, 720, 840,
                    960, 1080, 1200, 1350
                ]
            }
        },


        6: {
            day: {
                spend: "$480.00",
                commission: "$192.00",
                roi: 45,
                growth: "14%",
                values: [90, 140, 200, 270, 340, 420, 500, 590]
            },

            month: {
                spend: "$1,800.00",
                commission: "$720.00",
                roi: 57,
                growth: "20%",
                values: [90, 180, 280, 390, 510, 640, 780]
            },

            year: {
                spend: "$18,000.00",
                commission: "$7,200.00",
                roi: 72,
                growth: "28%",
                values: [
                    130, 220, 330, 450,
                    580, 710, 850, 990,
                    1140, 1300, 1460, 1650
                ]
            }
        }

    };


    /* COMMON COLOR */

    const COLORS = {
        primary: "#ff3c5f",
        remaining: "#e5ebf2",
        text: "#7c90a9",
        tooltip: "#10233f"
    };


    /* GET LABELS */

    function getLabels(period, totalValues = 0) {

        /* DAY */

        if (period === "day") {

            return [
                "9 AM",
                "10 AM",
                "11 AM",
                "12 PM",
                "1 PM",
                "2 PM",
                "3 PM",
                "4 PM"
            ].slice(0, totalValues);

        }


        /* MONTH */

        if (period === "month") {

            const labels = [];

            for (let i = 1; i <= totalValues; i++) {
                labels.push(i.toString());
            }

            return labels;

        }


        /* YEAR */

        if (period === "year") {

            return [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ].slice(0, totalValues);

        }


        return [];

    }


    /* CREATE GRAPH */

    function createGraph(
        id,
        values,
        period,
        themeColor = COLORS.primary
    ) {

        const canvas = document.getElementById(id);

        if (!canvas) {
            return;
        }


  

        const oldChart = Chart.getChart(canvas);

        if (oldChart) {
            oldChart.destroy();
        }


        const ctx = canvas.getContext("2d");


        /* Gradient */

        const gradient = ctx.createLinearGradient(
            0,
            0,
            0,
            110
        );


        gradient.addColorStop(
            0,
            "rgba(255, 60, 95, 0.22)"
        );


        gradient.addColorStop(
            1,
            "rgba(255, 60, 95, 0)"
        );


        /* Labels */

        const labels = getLabels(
            period,
            values.length
        );


        /* Chart */

        new Chart(ctx, {

            type: "line",

            data: {

                labels: labels,

                datasets: [

                    {

                        data: values,

                        borderColor: themeColor,

                        backgroundColor: gradient,

                        borderWidth: 2,

                        fill: true,

                        tension: 0.4,

                        pointRadius: 2.5,

                        pointHoverRadius: 5,

                        pointBackgroundColor: themeColor,

                        pointBorderWidth: 0

                    }

                ]

            },


            options: {

                responsive: true,

                maintainAspectRatio: false,


                interaction: {

                    intersect: false,

                    mode: "index"

                },


                plugins: {

                    legend: {

                        display: false

                    },


                    tooltip: {

                        displayColors: false,

                        backgroundColor: COLORS.tooltip,

                        padding: 10,


                        titleFont: {

                            size: 11

                        },


                        bodyFont: {

                            size: 12

                        },


                        callbacks: {

                            label: function(context) {

                                return "$" +
                                    Number(
                                        context.parsed.y
                                    ).toLocaleString();

                            }

                        }

                    }

                },


                scales: {

                    x: {

                        grid: {

                            display: false

                        },


                        border: {

                            display: false

                        },


                        ticks: {

                            color: COLORS.text,

                            font: {

                                size: 9

                            },

                            maxRotation: 0,

                            autoSkip: true,

                            maxTicksLimit: period === "day" ?
                                4 : period === "month" ?
                                6 : 12

                        }

                    },


                    y: {

                        beginAtZero: true,


                        grid: {

                            color: "rgba(120, 140, 165, .10)",

                            drawTicks: false

                        },


                        border: {

                            display: false

                        },


                        ticks: {

                            color: COLORS.text,

                            font: {

                                size: 9

                            },

                            maxTicksLimit: 3,


                            callback: function(value) {

                                return "$" + value;

                            }

                        }

                    }

                }

            }

        });

    }


    /* CREATE ROI DONUT */

    function createROI(
        id,
        percentage,
        themeColor = COLORS.primary
    ) {

        const canvas =
            document.getElementById(id);


        if (!canvas) {
            return;
        }


        /* Destroy old chart */

        const oldChart = Chart.getChart(canvas);

        if (oldChart) {
            oldChart.destroy();
        }


        const ctx =
            canvas.getContext("2d");


        new Chart(ctx, {

            type: "doughnut",


            data: {

                datasets: [

                    {

                        data: [

                            percentage,

                            100 - percentage

                        ],


                        backgroundColor: [

                            themeColor,

                            COLORS.remaining

                        ],


                        borderWidth: 0,

                        borderRadius: 8,

                        spacing: 1

                    }

                ]

            },


            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: "72%",


                plugins: {

                    legend: {

                        display: false

                    },


                    tooltip: {

                        enabled: false

                    }

                }

            }

        });

    }


    /* UPDATE CARD */

    function updateCardPeriod(
        cardId,
        period
    ) {

        const cardData =
            cardPeriodData[cardId];


        if (!cardData) {
            return;
        }


        const data =
            cardData[period];


        if (!data) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | FIND EXACT CARD
        |--------------------------------------------------------------------------
        */

        const filterButton =
            document.querySelector(
                `.period-filter-btn[data-card="${cardId}"]`
            );


        if (!filterButton) {
            console.warn(
                "Filter button not found for card:",
                cardId
            );

            return;
        }


        const card =
            filterButton.closest(
                ".advertiser-card"
            );


        if (!card) {
            console.warn(
                "Advertiser card not found:",
                cardId
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | PERIOD TEXT
        |--------------------------------------------------------------------------
        */

        const periodElement =
            card.querySelector(".period");


        if (periodElement) {

            if (period === "day") {

                periodElement.textContent =
                    "Today";

            } else if (period === "month") {

                periodElement.textContent =
                    "Month to Date";

            } else if (period === "year") {

                periodElement.textContent =
                    "Year to Date";

            }

        }


        /*
        |--------------------------------------------------------------------------
        | GROWTH
        |--------------------------------------------------------------------------
        */

        const growthElement =
            card.querySelector(".growth");


        if (growthElement) {

            growthElement.innerHTML = `

            <i class="bi bi-arrow-up"></i>

            <span class="growth-value">
                ${data.growth}
            </span>

        `;

        }


        /*
        |--------------------------------------------------------------------------
        | SPEND + COMMISSION
        |--------------------------------------------------------------------------
        */

        const metricBoxes =
            card.querySelectorAll(
                ".metric-box"
            );


        metricBoxes.forEach(
            function(box) {

                const labelElement =
                    box.querySelector(
                        ".metric-label"
                    );


                const valueElement =
                    box.querySelector(
                        ".metric-value"
                    );


                if (!labelElement || !valueElement) {
                    return;
                }


                const label =
                    labelElement.textContent
                    .trim()
                    .toLowerCase();


                if (label.includes("spend")) {

                    valueElement.textContent =
                        data.spend;

                }


                if (
                    label.includes("commission")
                ) {

                    valueElement.textContent =
                        data.commission;

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | ROI TEXT
        |--------------------------------------------------------------------------
        */

        const roiPercent =
            card.querySelector(
                ".roi-percent"
            );


        if (roiPercent) {

            roiPercent.textContent =
                data.roi + "%";

        }


        /*
        |--------------------------------------------------------------------------
        | ROI CHART
        |--------------------------------------------------------------------------
        */

        const roiCanvas =
            card.querySelector(
                "canvas[id^='roi']"
            );


        if (roiCanvas) {

            const roiChart =
                Chart.getChart(
                    roiCanvas
                );


            if (roiChart) {

                roiChart.data.datasets[0].data = [

                    data.roi,

                    100 - data.roi

                ];


                roiChart.update();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | GRAPH
        |--------------------------------------------------------------------------
        */

        const graphCanvas =
            card.querySelector(
                "canvas[id^='graph']"
            );


        if (graphCanvas) {

            const graphChart =
                Chart.getChart(
                    graphCanvas
                );


            if (graphChart) {

                /*
                 * Update labels
                 */

                graphChart.data.labels =
                    getLabels(
                        period,
                        data.values.length
                    );


                /*
                 * Update graph values
                 */

                graphChart.data.datasets[0].data =
                    data.values;


                /*
                 * Update same color
                 */

                graphChart.data.datasets[0].borderColor =
                    COLORS.primary;


                graphChart.data.datasets[0].pointBackgroundColor =
                    COLORS.primary;


                /*
                 * Update chart
                 */

                graphChart.update();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SAVE CURRENT PERIOD
        |--------------------------------------------------------------------------
        */

        filterButton.dataset.period =
            period;

    }


    /* INITIALIZE ALL 6 CARDS DEFAULT = DAY */

    for (
        let cardId = 1; cardId <= 6; cardId++
    ) {

        const dayData =
            cardPeriodData[cardId].day;


        /*
        |--------------------------------------------------------------------------
        | GRAPH
        |--------------------------------------------------------------------------
        */

        createGraph(
            "graph" + cardId,
            dayData.values,
            "day",
            COLORS.primary
        );


        /*
        |--------------------------------------------------------------------------
        | ROI
        |--------------------------------------------------------------------------
        */

        createROI(
            "roi" + cardId,
            dayData.roi,
            COLORS.primary
        );


        /*
        |--------------------------------------------------------------------------
        | INITIAL CARD DATA
        |--------------------------------------------------------------------------
        */

        updateCardPeriod(
            cardId,
            "day"
        );

    }


    /*  FILTER BUTTON CLICK   */

    document
        .querySelectorAll(
            ".period-filter-btn"
        )
        .forEach(
            function(button) {

                button.addEventListener(
                    "click",
                    function(e) {

                        e.preventDefault();

                        e.stopPropagation();


                        const menu =
                            this.nextElementSibling;


                        if (!menu) {
                            return;
                        }


                        /*
                         * Close all other menus
                         */

                        document
                            .querySelectorAll(
                                ".period-filter-menu"
                            )
                            .forEach(
                                function(item) {

                                    if (
                                        item !== menu
                                    ) {

                                        item.classList
                                            .remove(
                                                "show"
                                            );

                                    }

                                }
                            );


                        /*
                         * Open current menu
                         */

                        menu.classList.toggle(
                            "show"
                        );

                    }
                );

            }
        );


    /*   DAY / MONTH / YEAR CLICK  */

    document
        .querySelectorAll(
            ".period-option"
        )
        .forEach(
            function(option) {

                option.addEventListener(
                    "click",
                    function(e) {

                        e.preventDefault();

                        e.stopPropagation();


                        /*
                         * Current menu
                         */

                        const menu =
                            this.closest(
                                ".period-filter-menu"
                            );


                        if (!menu) {
                            return;
                        }


                        /*
                         * Current filter
                         */

                        const filter =
                            this.closest(
                                ".period-filter"
                            );


                        if (!filter) {
                            return;
                        }


                        /*
                         * Current card ID
                         */

                        const button =
                            filter.querySelector(
                                ".period-filter-btn"
                            );


                        if (!button) {
                            return;
                        }


                        const cardId =
                            button.dataset.card;


                        /*
                         * Selected period
                         */

                        const period =
                            this.dataset.period;


                        if (
                            !cardId ||
                            !period
                        ) {
                            return;
                        }


                        /*
                         * Remove active
                         */

                        menu
                            .querySelectorAll(
                                ".period-option"
                            )
                            .forEach(
                                function(item) {

                                    item.classList
                                        .remove(
                                            "active"
                                        );

                                }
                            );


                        /*
                         * Set selected active
                         */

                        this.classList.add(
                            "active"
                        );


                        /*
                         * Close menu
                         */

                        menu.classList.remove(
                            "show"
                        );


                        /*
                         * Update ONLY this card
                         */

                        updateCardPeriod(
                            cardId,
                            period
                        );

                    }
                );

            }
        );


    /*  CLOSE FILTER WHEN CLICK OUTSIDE  */

    document.addEventListener(
        "click",
        function() {

            document
                .querySelectorAll(
                    ".period-filter-menu"
                )
                .forEach(
                    function(menu) {

                        menu.classList.remove(
                            "show"
                        );

                    }
                );

        }
    );


    /* STOP MENU CLICK FROM CLOSING IT EARLY */

    document
        .querySelectorAll(
            ".period-filter-menu"
        )
        .forEach(
            function(menu) {

                menu.addEventListener(
                    "click",
                    function(e) {

                        e.stopPropagation();

                    }
                );

            }
        );
</script>
@endsection
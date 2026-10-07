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

        padding: 6px 9px;

        border-radius: 8px;

        background: #eafaf2;
        color: #1da56a;

        font-size: 12px;
        font-weight: 700;

        white-space: nowrap;
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

    /* =========================================
   TOP 3 ADVERTISER CARD COLORS
   ========================================= */

    :root {
        /* CARD 1 - ORANGE / GOLD */
        --advertiser-orange: #ff3c5f;
        --advertiser-orange-light: #fff0cf;
        --advertiser-orange-bg: #fff1d6;
        --advertiser-orange-avatar: #fff0c7;
        --advertiser-orange-avatar-end: #ffe1a1;
        --advertiser-orange-border: #ff3c5f;
        --advertiser-orange-divider: #f3d99e;
        --advertiser-orange-text: #ff3c5f;
        --advertiser-orange-growth: #ff3c5f;

        /* CARD 2 - GREEN */
        --advertiser-green: #22a45a;
        --advertiser-green-light: #ddf5e6;
        --advertiser-green-bg: #e4f7ea;
        --advertiser-green-avatar: #dff7e7;
        --advertiser-green-avatar-end: #bdebcf;
        --advertiser-green-border: #9bd5ae;
        --advertiser-green-divider: #b8dfc4;
        --advertiser-green-text: #168a4a;

        /* CARD 3 - LIGHT BLUE */
        --advertiser-blue: #3b9ed8;
        --advertiser-blue-light: #e1f3ff;
        --advertiser-blue-bg: #e5f4ff;
        --advertiser-blue-avatar: #dff2ff;
        --advertiser-blue-avatar-end: #c5e7fa;
        --advertiser-blue-border: #b8dcf5;
        --advertiser-blue-divider: #c9e4f5;
        --advertiser-blue-text: #1e62c7;
    }


   /* =========================================
   CARD 1 - #FF3C5F SHADE
   ========================================= */

:root {
    --advertiser-orange: #ff3c5f;
    --advertiser-orange-light: #fff0f3;
    --advertiser-orange-bg: #ffe8ed;
    --advertiser-orange-avatar: #ffd9e1;
    --advertiser-orange-avatar-end: #ffc1ce;
    --advertiser-orange-border: #ff3c5f;
    --advertiser-orange-divider: #ffc4cf;
    --advertiser-orange-text: #ff3c5f;
    --advertiser-orange-growth: #ff3c5f;
}


/* =========================================
   CARD 1 : #FF3C5F
   ========================================= */

.advertiser-card.first {
    background: linear-gradient(
        145deg,
        #ffffff 0%,
        #fff0f3 100%
    );

    border: 1px solid var(--advertiser-orange-border);

    box-shadow:
        0 8px 24px rgba(255, 60, 95, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
}


.advertiser-card.first .advertiser-avatar {
    background: linear-gradient(
        135deg,
        var(--advertiser-orange-avatar),
        var(--advertiser-orange-avatar-end)
    );

    color: var(--advertiser-orange-text);
}


.advertiser-card.first .card-top {
    border-bottom-color: var(--advertiser-orange-divider);
}


.advertiser-card.first .growth {
    background: var(--advertiser-orange-light);
    color: var(--advertiser-orange-growth);
}


.advertiser-card.first .metric-box.spend {
    background: var(--advertiser-orange-bg);
}


.advertiser-card.first .metric-box.spend .metric-label {
    color: var(--advertiser-orange-text);
}


.advertiser-card.first .metric-box.commission {
    background: #fff;
}
    /* =========================================
   CARD 2 : GREEN
   ========================================= */

    .advertiser-card.second {
        background: linear-gradient(145deg,
                #fbfffc 0%,
                #eaf8ef 100%);

        border: 1px solid var(--advertiser-green-border);

        box-shadow:
            0 8px 24px rgba(35, 150, 75, 0.11),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .advertiser-card.second .advertiser-avatar {
        background: linear-gradient(135deg,
                var(--advertiser-green-avatar),
                var(--advertiser-green-avatar-end));

        color: var(--advertiser-green-text);
    }

    .advertiser-card.second .card-top {
        border-bottom-color: var(--advertiser-green-divider);
    }

    .advertiser-card.second .growth {
        background: var(--advertiser-green-light);
        color: var(--advertiser-green-text);
    }

    .advertiser-card.second .metric-box.spend {
        background: var(--advertiser-green-bg);
    }

    .advertiser-card.second .metric-box.spend .metric-label {
        color: var(--advertiser-green-text);
    }

    .advertiser-card.second .metric-box.commission {
        background: #fff;
    }


    /* =========================================
   CARD 3 : LIGHT BLUE
   ========================================= */

    .advertiser-card.third {
        background: linear-gradient(145deg,
                #ffffff 0%,
                #eaf6ff 100%);

        border: 1px solid var(--advertiser-blue-border);

        box-shadow:
            0 8px 24px rgba(55, 155, 220, 0.12),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
    }

    .advertiser-card.third .advertiser-avatar {
        background: linear-gradient(135deg,
                var(--advertiser-blue-avatar),
                var(--advertiser-blue-avatar-end));

        color: var(--advertiser-blue-text);
    }

    .advertiser-card.third .card-top {
        border-bottom-color: var(--advertiser-blue-divider);
    }

    .advertiser-card.third .growth {
        background: var(--advertiser-blue-light);
        color: var(--advertiser-blue-text);
    }

    .advertiser-card.third .metric-box.spend {
        background: var(--advertiser-blue-bg);
    }

    .advertiser-card.third .metric-box.spend .metric-label {
        color: var(--advertiser-blue-text);
    }

    .advertiser-card.third .metric-box.commission {
        background: #fff;
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

                                <div class="growth">
                                    <i class="bi bi-arrow-up"></i>
                                    12%
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
                                        <svg fill="#168a4a" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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
                                            Week to Date
                                        </p>
                                    </div>

                                </div>

                                <div class="growth">
                                    <i class="bi bi-arrow-up"></i>
                                    18%
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
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#168a4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                        <svg fill="#1e62c7" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
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
                                            Month to Date
                                        </p>
                                    </div>

                                </div>

                                <div class="growth">
                                    <i class="bi bi-arrow-up"></i>
                                    25%
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
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#1e62c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

                                <div class="growth">
                                    <i class="bi bi-arrow-up"></i>
                                    10%
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
                                        <svg fill="#168a4a" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 31.701 31.701" xml:space="preserve">

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
                                            Week to Date
                                        </p>
                                    </div>

                                </div>

                                <div class="growth">
                                    <i class="bi bi-arrow-up"></i>
                                    16%
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
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#168a4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                        <svg fill="#1e62c7" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 31.701 31.701" xml:space="preserve">

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
                                            Month to Date
                                        </p>
                                    </div>

                                </div>

                                <div class="growth">
                                    <i class="bi bi-arrow-up"></i>
                                    22%
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
                                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#1e62c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
    /* GRAPH CONFIG */

    const graphData = [

        /* CARD 1 - ORANGE / GOLD */

        /* TODAY */
        {
            id: "graph1",
            period: "today",
            values: [
                80, 125, 180, 210,
                290, 360, 430, 520
            ]
        },

        /* WEEK TO DATE */
        {
            id: "graph2",
            period: "week",
            values: [
                120, 220, 260,
                320, 380, 450, 580
            ]
        },

        /* MONTH TO DATE */
        {
            id: "graph3",
            period: "month",
            values: [
                80, 110, 145, 180, 210,
                250, 280, 310, 340, 360,
                390, 410, 430, 455, 480,
                500, 520, 540, 560, 580,
                600, 620, 640, 660, 680,
                700, 720, 740, 760, 780
            ]
        },


        /* CARD 2 - GREEN */

        /* TODAY */
        {
            id: "graph4",
            period: "today",
            values: [
                70, 120, 165, 220,
                280, 350, 420, 510
            ]
        },

        /* WEEK TO DATE */
        {
            id: "graph5",
            period: "week",
            values: [
                100, 210, 230,
                310, 370, 450, 580
            ]
        },

        /* MONTH TO DATE */
        {
            id: "graph6",
            period: "month",
            values: [
                90, 120, 160, 200, 240,
                270, 300, 330, 360, 390,
                420, 450, 470, 490, 510,
                530, 550, 570, 580, 590,
                600, 610, 620, 630, 640,
                650, 660, 670, 680, 690
            ]
        }

    ];


    /* GET LABELS ACCORDING TO PERIOD */

    function getLabels(period) {

        /* TODAY */

        if (period === "today") {

            return [
                "9 AM",
                "10 AM",
                "11 AM",
                "12 PM",
                "1 PM",
                "2 PM",
                "3 PM",
                "4 PM"
            ];

        }


        /* WEEK TO DATE */

        if (period === "week") {

            return [
                "Mon",
                "Tue",
                "Wed",
                "Thu",
                "Fri",
                "Sat",
                "Sun"
            ];

        }


        /* MONTH TO DATE */

        if (period === "month") {

            return [
                "1",
                "2",
                "3",
                "4",
                "5",
                "6",
                "7",
                "8",
                "9",
                "10",
                "11",
                "12",
                "13",
                "14",
                "15",
                "16",
                "17",
                "18",
                "19",
                "20",
                "21",
                "22",
                "23",
                "24",
                "25",
                "26",
                "27",
                "28",
                "29",
                "30"
            ];

        }


        return [];

    }


    /* CREATE LINE GRAPH */

    function createGraph(id, values, period, themeColor) {

        const canvas = document.getElementById(id);

        if (!canvas) return;


        const ctx = canvas.getContext("2d");


        /* =====================================================
           GRADIENT
        ===================================================== */

        const gradient = ctx.createLinearGradient(
            0,
            0,
            0,
            110
        );


        /*
         * Convert HEX color to RGB for transparent gradient
         */

        function hexToRgba(hex, alpha) {

            hex = hex.replace("#", "");

            const r = parseInt(
                hex.substring(0, 2),
                16
            );

            const g = parseInt(
                hex.substring(2, 4),
                16
            );

            const b = parseInt(
                hex.substring(4, 6),
                16
            );

            return `rgba(${r}, ${g}, ${b}, ${alpha})`;

        }


        gradient.addColorStop(
            0,
            hexToRgba(themeColor, 0.22)
        );

        gradient.addColorStop(
            1,
            hexToRgba(themeColor, 0)
        );


        /* =====================================================
           LABELS
        ===================================================== */

        const labels = getLabels(period);


        /* =====================================================
           CHART
        ===================================================== */

        new Chart(ctx, {

            type: "line",

            data: {

                labels: labels,

                datasets: [

                    {

                        data: values,

                        /* LINE COLOR */
                        borderColor: themeColor,

                        /* AREA COLOR */
                        backgroundColor: gradient,

                        borderWidth: 2,

                        fill: true,

                        tension: 0.4,

                        /* POINTS */
                        pointRadius: 2.5,

                        pointHoverRadius: 5,

                        pointBackgroundColor: themeColor,

                        pointBorderWidth: 0

                    }

                ]

            },


            /* OPTIONS */

            options: {

                responsive: true,

                maintainAspectRatio: false,


                interaction: {

                    intersect: false,

                    mode: "index"

                },


                plugins: {

                    /* LEGEND */

                    legend: {

                        display: false

                    },


                    /* TOOLTIP */

                    tooltip: {

                        displayColors: false,

                        backgroundColor: "#10233f",

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
                                    context.parsed.y
                                    .toLocaleString();

                            }

                        }

                    }

                },


                /* =================================================
                   SCALES
                ================================================= */

                scales: {


                    /* =========================
                       X AXIS
                    ========================= */

                    x: {

                        grid: {

                            display: false

                        },

                        border: {

                            display: false

                        },

                        ticks: {

                            color: "#7c90a9",

                            font: {

                                size: 9

                            },

                            maxRotation: 0,

                            autoSkip: true,


                            /*
                             * Today = 4 labels
                             * Week = 7 labels
                             * Month = around 6 labels
                             */

                            maxTicksLimit:

                                period === "today"

                                ?
                                4

                                :
                                period === "week"

                                ?
                                7

                                :
                                6

                        }

                    },


                    /* =========================
                       Y AXIS
                    ========================= */

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

                            color: "#7c90a9",

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
        themeColor
    ) {

        const canvas =
            document.getElementById(id);

        if (!canvas) return;


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

                            /* ACTIVE */
                            themeColor,

                            /* REMAINING */
                            "#e5ebf2"

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

    /* =========================================================
       THEME COLORS
    ========================================================= */

    const COLORS = {
        orange: "#ff3c5f",
        green: "#22a45a",
        lightBlue: "#1e62c7"
    };


    /* INITIALIZE GRAPHS */

    /*
        ESCORT CARDS

        Card 1 → graph1 → Orange
        Card 2 → graph2 → Green
        Card 3 → graph3 → Light Blue
    */

    const graphColors = {
        graph1: COLORS.orange,
        graph2: COLORS.green,
        graph3: COLORS.lightBlue,

        graph4: COLORS.orange,
        graph5: COLORS.green,
        graph6: COLORS.lightBlue
    };


    graphData.forEach(function(item) {

        createGraph(
            item.id,
            item.values,
            item.period,
            graphColors[item.id] || "#ff3c5f"
        );

    });


    /* =========================================================
       INITIALIZE ROI
    ========================================================= */

    /* CARD 1 → ORANGE */
    createROI(
        "roi1",
        40,
        COLORS.orange
    );


    /* CARD 2 → GREEN */
    createROI(
        "roi2",
        35,
        COLORS.green
    );


    /* CARD 3 → LIGHT BLUE */
    createROI(
        "roi3",
        38,
        COLORS.lightBlue
    );


    /* =========================================================
       MASSAGE CENTER
       Keep original pink color
    ========================================================= */

    createROI(
        "roi4",
        42,
        COLORS.orange
    );

    createROI(
        "roi5",
        37,
        COLORS.green
    );

    createROI(
        "roi6",
        45,
        COLORS.lightBlue
    );
</script>
@endsection
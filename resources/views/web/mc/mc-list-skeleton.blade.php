<style>
    .profile-skeleton {
        display: flex;
        gap: 14px;
        background: #fff;
        overflow: hidden;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 16px;
        margin: 30px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* =========================
       LEFT PROFILE IMAGE
    ========================= */

    .sk-profile-image {
        width: 300px;
        height: 420px;
        flex: 0 0 300px;
        border-radius: 10px;
    }

    /* =========================
       RIGHT CONTENT
    ========================= */

    .sk-profile-content {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        border: 1px solid #e5e5e5;
        border-radius: 10px;
        overflow: hidden;
    }

    /* =========================
       TABS HEADER
    ========================= */

    .sk-tabs-header {
        min-height: 65px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: #fff1f4;
        border-bottom: 1px solid #eeeeee;
    }

    .sk-tab {
        width: 140px;
        height: 46px;
        border-radius: 3px;
    }

    .sk-tab.short {
        width: 130px;
        margin-left: auto;
    }

    /* =========================
       PROFILE HEADER
    ========================= */

    .sk-profile-header {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eeeeee;
    }

    .sk-profile-name {
        width: 100px;
        height: 22px;
        border-radius: 4px;
        margin-bottom: 7px;
    }

    .sk-profile-rating {
        width: 135px;
        height: 12px;
        border-radius: 4px;
    }

    .sk-social-icons {
        display: flex;
        gap: 10px;
        margin-left: auto;
    }

    .sk-social-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
    }

    /* =========================
       DETAILS GRID
       3 CARDS PER ROW
    ========================= */

    .sk-details-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
        padding: 10px;
        border-bottom: 1px solid #eeeeee;
    }

    .sk-detail-card {
        height: 58px;
        border: 1px solid #e5e5e5;
        border-radius: 6px;
        padding: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fff;
    }

    .sk-detail-icon {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sk-detail-text {
        flex: 1;
    }

    .sk-detail-title {
        width: 70px;
        height: 12px;
        border-radius: 4px;
        margin-bottom: 6px;
    }

    .sk-detail-value {
        width: 45px;
        height: 9px;
        border-radius: 4px;
    }

    /* =========================
       ABOUT US
    ========================= */

    .sk-about {
        padding: 10px;
        border-bottom: 1px solid #eeeeee;
    }

    .sk-about-title {
        width: 80px;
        height: 17px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .sk-about-line {
        width: 100%;
        height: 10px;
        border-radius: 4px;
        margin-bottom: 6px;
    }

    .sk-about-line.short {
        width: 80%;
    }

    /* =========================
       ADDRESS
    ========================= */

    .sk-address {
        min-height: 52px;
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 8px 10px;
    }

    .sk-address-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sk-address-text {
        width: 200px;
        height: 13px;
        border-radius: 4px;
    }

    /* =========================
       OPEN TIMES TAB SKELETON
       Original shaded style
    ========================= */

    .sk-open-times {
        padding: 14px;
        background: #f3f3f3;
    }

    .sk-open-times-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .sk-time-card {
        height: 45px;
        border-radius: 6px;
        background: #fff;
    }

    /* =========================
       SHIMMER
    ========================= */

    .shimmer {
        position: relative;
        overflow: hidden;
        background: #ececec;
    }

    .shimmer::after {
        content: "";
        position: absolute;
        top: 0;
        left: -150%;
        width: 150%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.7),
            transparent
        );
        animation: loading 1.3s infinite;
    }

    @keyframes loading {
        100% {
            left: 150%;
        }
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 992px) {

        .profile-skeleton {
            flex-direction: column;
        }

        .sk-profile-image {
            width: 100%;
            height: 350px;
            flex: none;
        }

        .sk-details-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {

        .profile-skeleton {
            padding: 10px;
        }

        .sk-tabs-header {
            flex-wrap: wrap;
        }

        .sk-tab {
            width: calc(50% - 5px);
        }

        .sk-tab.short {
            width: 100%;
            margin-left: 0;
        }

        .sk-details-grid {
            grid-template-columns: 1fr;
        }

        .sk-open-times-row {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="container">
    <div class="row">
        <div class="col-sm-12" id="list-skeleton">

            @for($i = 0; $i < 3; $i++)

                <div class="profile-skeleton">

                    <!-- =========================
                         LEFT PROFILE IMAGE
                    ========================== -->

                    <div class="sk-profile-image shimmer"></div>


                    <!-- =========================
                         RIGHT PROFILE CONTENT
                    ========================== -->

                    <div class="sk-profile-content">

                        <!-- Tabs -->
                        <div class="sk-tabs-header">

                            <div class="shimmer sk-tab"></div>

                            <div class="shimmer sk-tab"></div>

                            <div class="shimmer sk-tab"></div>

                            <div class="shimmer sk-tab short"></div>

                        </div>


                        <!-- Profile Name / Rating / Social -->
                        <div class="sk-profile-header">

                            <div>
                                <div class="shimmer sk-profile-name"></div>

                                <div class="shimmer sk-profile-rating"></div>
                            </div>

                            <div class="sk-social-icons">

                                <div class="shimmer sk-social-icon"></div>

                                <div class="shimmer sk-social-icon"></div>

                                <div class="shimmer sk-social-icon"></div>

                            </div>

                        </div>


                        <!-- =========================
                             PROFILE DETAILS
                             3 CARDS PER ROW
                        ========================== -->

                        <div class="sk-details-grid">

                            <!-- Card 1 -->
                            <div class="sk-detail-card">

                                <div class="shimmer sk-detail-icon"></div>

                                <div class="sk-detail-text">
                                    <div class="shimmer sk-detail-title"></div>
                                    <div class="shimmer sk-detail-value"></div>
                                </div>

                            </div>


                            <!-- Card 2 -->
                            <div class="sk-detail-card">

                                <div class="shimmer sk-detail-icon"></div>

                                <div class="sk-detail-text">
                                    <div class="shimmer sk-detail-title"></div>
                                    <div class="shimmer sk-detail-value"></div>
                                </div>

                            </div>


                            <!-- Card 3 -->
                            <div class="sk-detail-card">

                                <div class="shimmer sk-detail-icon"></div>

                                <div class="sk-detail-text">
                                    <div class="shimmer sk-detail-title"></div>
                                    <div class="shimmer sk-detail-value"></div>
                                </div>

                            </div>


                            <!-- Card 4 -->
                            <div class="sk-detail-card">

                                <div class="shimmer sk-detail-icon"></div>

                                <div class="sk-detail-text">
                                    <div class="shimmer sk-detail-title"></div>
                                    <div class="shimmer sk-detail-value"></div>
                                </div>

                            </div>


                            <!-- Card 5 -->
                            <div class="sk-detail-card">

                                <div class="shimmer sk-detail-icon"></div>

                                <div class="sk-detail-text">
                                    <div class="shimmer sk-detail-title"></div>
                                    <div class="shimmer sk-detail-value"></div>
                                </div>

                            </div>


                            <!-- Card 6 -->
                            <div class="sk-detail-card">

                                <div class="shimmer sk-detail-icon"></div>

                                <div class="sk-detail-text">
                                    <div class="shimmer sk-detail-title"></div>
                                    <div class="shimmer sk-detail-value"></div>
                                </div>

                            </div>

                        </div>


                        <!-- =========================
                             ABOUT US
                        ========================== -->

                        <div class="sk-about">

                            <div class="shimmer sk-about-title"></div>

                            <div class="shimmer sk-about-line"></div>

                            <div class="shimmer sk-about-line"></div>

                            <div class="shimmer sk-about-line short"></div>

                        </div>


                        <!-- =========================
                             ADDRESS
                        ========================== -->

                        <div class="sk-address">

                            <div class="shimmer sk-address-icon"></div>

                            <div class="shimmer sk-address-text"></div>

                        </div>

                    </div>

                </div>

            @endfor

        </div>
    </div>
</div>
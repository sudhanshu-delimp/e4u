<style>
    /* ================================
       PROFILE LIST SKELETON
    ================================= */

    .profile-skeleton {
        display: flex;
        gap: 14px;
        width: 100%;
        min-height: 480px;
        padding: 14px;
        margin: 20px 0;
        background: #fff;
        border: 1px solid #e1e5ea;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* ================================
       LEFT IMAGE
    ================================= */

    .sk-list-image {
        width: 300px;
        min-width: 300px;
        height: 465px;
        border-radius: 9px;
        flex-shrink: 0;
    }

    /* ================================
       RIGHT CONTENT
    ================================= */

    .sk-list-content {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        border: 1px solid #e1e5ea;
        border-radius: 10px;
        overflow: hidden;
    }

    /* ================================
       TOP TABS / SHORTLIST
    ================================= */

    .sk-list-top {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 64px;
        padding: 10px;
        background: #fff;
        border-bottom: 1px solid #e1e5ea;
    }

    .sk-tab {
        width: 140px;
        height: 46px;
        border-radius: 3px;
    }

    .sk-tab.services {
        width: 100px;
    }

    .sk-shortlist {
        width: 160px;
        height: 46px;
        margin-left: auto;
        border-radius: 5px;
    }

    /* ================================
       NAME / RATING
    ================================= */

    .sk-profile-heading {
        padding: 14px 10px 10px;
        border-bottom: 1px solid #e1e5ea;
    }

    .sk-profile-name {
        width: 90px;
        height: 23px;
        margin-bottom: 9px;
        border-radius: 4px;
    }

    .sk-rating {
        width: 230px;
        height: 13px;
        border-radius: 4px;
    }

    /* ================================
       INFO CARDS
    ================================= */

    .sk-list-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        padding: 10px;
        border-bottom: 1px solid #e1e5ea;
    }

    .sk-info-card {
        height: 58px;
        border: 1px solid #e1e5ea;
        border-radius: 6px;
        padding: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sk-info-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sk-info-text {
        flex: 1;
    }

    .sk-info-title {
        width: 70px;
        height: 11px;
        margin-bottom: 6px;
        border-radius: 3px;
    }

    .sk-info-value {
        width: 55px;
        height: 9px;
        border-radius: 3px;
    }

    /* ================================
       ABOUT ME
    ================================= */

    .sk-list-about {
        padding: 10px;
        border-bottom: 1px solid #e1e5ea;
    }

    .sk-list-about-title {
        width: 85px;
        height: 17px;
        margin-bottom: 9px;
        border-radius: 4px;
    }

    .sk-about-line {
        width: 95%;
        height: 10px;
        margin-bottom: 7px;
        border-radius: 3px;
    }

    .sk-about-line.medium {
        width: 80%;
    }

    .sk-about-line.short {
        width: 55%;
    }

    /* ================================
       BOTTOM ACTIONS
    ================================= */

    .sk-list-bottom {
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 62px;
        padding: 10px;
        margin-top: auto;
    }

    .sk-list-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sk-list-profile-btn {
        width: 110px;
        height: 40px;
        margin-left: auto;
        border-radius: 5px;
    }

    /* ================================
       SHIMMER
    ================================= */

    .shimmer {
        position: relative;
        overflow: hidden;
        background: #e5e5e5;
    }

    .shimmer::after {
        content: "";
        position: absolute;
        inset: 0;
        transform: translateX(-100%);
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .85), transparent);
        animation: loader 1.2s infinite;
    }

    
    @keyframes loader {
        100% {
            transform: translateX(100%);
        }
    }

    /* ================================
       TABLET
    ================================= */

    @media (max-width: 992px) {

        .profile-skeleton {
            min-height: auto;
        }

        .sk-list-image {
            width: 250px;
            min-width: 250px;
            height: 400px;
        }

        .sk-list-info {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 767px) {

        .profile-skeleton {
            flex-direction: column;
            padding: 10px;
        }

        .sk-list-image {
            width: 100%;
            min-width: 100%;
            height: 350px;
        }

        .sk-list-info {
            grid-template-columns: 1fr;
        }

        .sk-list-top {
            flex-wrap: wrap;
        }

        .sk-shortlist {
            width: 100%;
            margin-left: 0;
        }

        .sk-list-content {
            width: 100%;
        }
    }
</style>


<div class="container">

    <div class="row">

        <div class="col-sm-12" id="list-skeleton">

            @for($i = 0; $i < 3; $i++)

                <div class="profile-skeleton">

                    <!-- ==========================
                         LEFT PROFILE IMAGE
                    =========================== -->

                    <div class="sk-list-image shimmer"></div>


                    <!-- ==========================
                         RIGHT PROFILE CONTENT
                    =========================== -->

                    <div class="sk-list-content">


                        <!-- TOP TABS -->

                        <div class="sk-list-top">

                            <div class="sk-tab shimmer"></div>

                            <div class="sk-tab services shimmer"></div>

                            <div class="sk-shortlist shimmer"></div>

                        </div>


                        <!-- PROFILE NAME / RATING -->

                        <div class="sk-profile-heading">

                            <div class="sk-profile-name shimmer"></div>

                            <div class="sk-rating shimmer"></div>

                        </div>


                        <!-- INFO CARDS -->

                        <div class="sk-list-info">


                            <!-- Gender -->

                            <div class="sk-info-card">

                                <div class="sk-info-icon shimmer"></div>

                                <div class="sk-info-text">

                                    <div class="sk-info-title shimmer"></div>

                                    <div class="sk-info-value shimmer"></div>

                                </div>

                            </div>


                            <!-- Location -->

                            <div class="sk-info-card">

                                <div class="sk-info-icon shimmer"></div>

                                <div class="sk-info-text">

                                    <div class="sk-info-title shimmer"></div>

                                    <div class="sk-info-value shimmer"></div>

                                </div>

                            </div>


                            <!-- Available -->

                            <div class="sk-info-card">

                                <div class="sk-info-icon shimmer"></div>

                                <div class="sk-info-text">

                                    <div class="sk-info-title shimmer"></div>

                                    <div class="sk-info-value shimmer"></div>

                                </div>

                            </div>


                            <!-- Massage -->

                            <div class="sk-info-card">

                                <div class="sk-info-icon shimmer"></div>

                                <div class="sk-info-text">

                                    <div class="sk-info-title shimmer"></div>

                                    <div class="sk-info-value shimmer"></div>

                                </div>

                            </div>


                            <!-- Incalls -->

                            <div class="sk-info-card">

                                <div class="sk-info-icon shimmer"></div>

                                <div class="sk-info-text">

                                    <div class="sk-info-title shimmer"></div>

                                    <div class="sk-info-value shimmer"></div>

                                </div>

                            </div>


                            <!-- Outcalls -->

                            <div class="sk-info-card">

                                <div class="sk-info-icon shimmer"></div>

                                <div class="sk-info-text">

                                    <div class="sk-info-title shimmer"></div>

                                    <div class="sk-info-value shimmer"></div>

                                </div>

                            </div>

                        </div>


                        <!-- ABOUT ME -->

                        <div class="sk-list-about">

                            <div class="sk-list-about-title shimmer"></div>

                            <div class="sk-about-line shimmer"></div>

                            <div class="sk-about-line shimmer"></div>

                            <div class="sk-about-line medium shimmer"></div>
                            <div class="sk-about-line short shimmer"></div>

                        </div>


                        <!-- BOTTOM ACTIONS -->

                        <div class="sk-list-bottom">

                            <div class="sk-list-circle shimmer"></div>

                            <div class="sk-list-circle shimmer"></div>
                            <div class="sk-list-circle shimmer"></div>
                            <div class="sk-list-circle shimmer"></div>

                            <div class="sk-list-profile-btn shimmer"></div>

                        </div>

                    </div>

                </div>

            @endfor

        </div>

    </div>

</div>
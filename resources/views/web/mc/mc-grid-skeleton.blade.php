<style>
    .skl_wrapper {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 50px 0px
    }

    .skl-card {
        width: 200px;
        background: #fff;
        border: 1px solid #ddd;
        overflow: hidden;
    }

    /* Skeleton */

    .skeleton {
        position: relative;
        overflow: hidden;
        background: #e5e5e5;
        border-radius: 4px;
    }

    .skeleton::after {
        content: "";
        position: absolute;
        inset: 0;
        transform: translateX(-100%);
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .85), transparent);
        animation: shimmer 1.2s infinite;
    }

    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }

    /* Top */

    .skl-top {
        padding: 10px;
        background: #dddddd;
    }

    .skl-title {
        width: 100%;
        height: 14px;
        background: #c9c9c9;
    }

    /* Image */

    .skl-image-wrapper {
        position: relative;
    }

    .skl-image {
        width: 100%;
        height: 250px;
        border-radius: 0;
    }

    /* skl-Overlay */

    .skl-overlay {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 10px;
        background: linear-gradient(to skl-top, rgba(0, 0, 0, .55), rgba(0, 0, 0, .15), transparent);
    }

    .skl-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .skl-box:last-child {
        margin-bottom: 0;
    }

    .skl-location {
        width: 75px;
        height: 14px;
        background: #c9c9c9;
    }

    .skl-flag {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #c9c9c9;
    }

    .skl-rating {
        width: 65px;
        height: 14px;
        background: #c9c9c9;
    }

    /* skl-Footer */

    .skl-footer {
        background: #dddddd;
        padding: 15px 10px;
    }

    .skl-button {
        width: 100%;
        height: 14px;
        background: #c9c9c9;

    }
     @media (max-width: 425px) {
            .skl_wrapper {
                justify-content: center;
            }
            .skl-card {
                width: 100%;
                max-width: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .skl_wrapper {
                justify-content: center;
            }
            .skl-card {
                width: 100%;
                max-width: 300px;
            }
        }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="skl_wrapper hidden" id="grid-skeleton">
                @for($i = 1; $i <= 10; $i++)
                <div class="skl-card">
                    <!-- skl-Top skl-Title -->
                    <div class="skl-top">
                        <div class="skl-box">
                            <div class="skl-flag skeleton"></div>
                            <div class="skl-location skeleton"></div>
                            <div class="skl-flag skeleton"></div>
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="skl-image-wrapper">
                        <div class="skl-image skeleton"></div>
                        <!-- skl-Overlay Details -->
                        <div class="skl-overlay">
                            <div class="skl-box">
                                <div class="skl-location skeleton"></div>
                                <div class="skl-flag skeleton"></div>
                                <div class="skl-rating skeleton"></div>
                            </div>
                            <div class="skl-box">
                                <div class="skl-title skeleton"></div>
                            </div>
                            <div class="skl-box">
                                <div class="skl-title skeleton"></div>
                            </div>
                            <div class="skl-box">
                                <div class="skl-title skeleton"></div>
                            </div>
                        </div>
                    </div>
                    <!-- skl-Footer -->
                    <div class="skl-footer">
                        <div class="skl-button skeleton"></div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

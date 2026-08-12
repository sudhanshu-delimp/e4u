<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="{{ asset('assets/app/img/favicon.ico') }}" />
    <title>404 - Page Not Found</title>

    <style>
         :root {
            --pink: #ff3c5f;
            --navy: #0c223d;
            --navy-light: #112f53;
            --white: #ffffff;
            --muted: #b9c7d8;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--navy);
            color: var(--white);
            overflow-x: hidden;
        }
        
        .error-page {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background: radial-gradient( circle at 50% 38%, rgba(255, 60, 245, 0.10), transparent 30%), linear-gradient( 180deg, #081b32 0%, var(--navy) 65%, #091d36 100%);
        }
        /* =========================
           STARS
        ========================= */
        
        .stars,
        .stars::before,
        .stars::after {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
        
        .stars {
            background-image: radial-gradient(circle, rgba(255, 255, 255, .8) 1px, transparent 1.5px), radial-gradient(circle, rgba(255, 60, 118, 0.8) 1px, transparent 1.5px);
            background-size: 90px 90px, 150px 150px;
            background-position: 10px 20px, 40px 80px;
            opacity: .35;
        }
        /* =========================
           HEADER
        ========================= */
        
        .error-header {
            width: min(1180px, calc(100% - 50px));
            margin: auto;
            padding: 32px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 5;
        }
        
        
        .home-top-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 13px 22px;
            border: 1px solid var(--pink);
            border-radius: 50px;
            color: var(--white);
            text-decoration: none;
            font-size: 15px;
            transition: .3s ease;
        }
        
        .home-top-btn svg {
            width: 18px;
            height: 18px;
        }
        
        .home-top-btn:hover {
            background: var(--pink);
            color: var(--navy);
            box-shadow: 0 0 25px rgba(255, 60, 245, .35);
            color: #fff;
        }
        /* =========================
           MAIN
        ========================= */
        
        .error-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: min(950px, calc(100% - 30px));
            margin: 20px auto 0;
        }
        /* Decorative planets */
        
        .planet {
            position: absolute;
            border: 2px solid var(--pink);
            border-radius: 50%;
            opacity: .8;
        }
        
        .planet-one {
            width: 60px;
            height: 60px;
            left: 5%;
            top: 130px;
        }
        
        .planet-one::after {
            content: "";
            position: absolute;
            width: 80px;
            height: 22px;
            border: 2px solid var(--pink);
            border-radius: 50%;
            left: -12px;
            top: 17px;
            transform: rotate(-25deg);
        }
        
        .planet-two {
            width: 15px;
            height: 15px;
            right: 10%;
            top: 210px;
            background: rgba(255, 60, 245, .3);
            box-shadow: 0 0 20px rgba(255, 60, 245, .5);
        }
        /* =========================
           404 NUMBER
        ========================= */
        
        .error-number {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 35px;
            position: relative;
        }
        
        .number-four {
            font-size: clamp(80px, 20vw, 150px);
            line-height: .8;
            font-weight: 900;
            color: var(--pink);
            text-shadow: 0 0 15px rgb(255 60 123 / 35%), 0 0 50px rgb(255 60 157 / 15%);
        }
        
        .number-zero {
            width: clamp(100px, 20vw, 180px);
            height: clamp(130px, 23vw, 190px);
            border: clamp(15px, 2vw, 28px) solid var(--pink);
            border-radius: 50%;
            position: relative;
            text-shadow: 0 0 15px rgb(255 60 123 / 35%), 0 0 50px rgb(255 60 157 / 15%);
        }
        /* Astronaut */
        
        .astronaut {
    position: absolute;
    width: 125px;
    height: 175px;
    left: 50%;
    top: 53%;
    transform: translate(-50%, -50%) scale(0.6);
    transform-origin: center center;
    z-index: 3;
}

/* =========================
   ASTRONAUT HEAD
========================= */

.astronaut-head {
    width: 72px;
    height: 72px;
    margin: auto;
    border-radius: 50%;
    background: #f8faff;
    border: 5px solid #dfe8f4;
    position: relative;
}

/* =========================
   ASTRONAUT GLASS
========================= */

.astronaut-glass {
    position: absolute;
    width: 54px;
    height: 50px;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background: #08182c;
    border-radius: 48%;
    border: 3px solid #cfd9e8;
    box-shadow: inset 0 0 12px rgba(255, 60, 245, 0.3);
}

.astronaut-glass::after {
    content: "";
    position: absolute;
    width: 12px;
    height: 6px;
    border-radius: 50%;
    background: #ffffff;
    left: 12px;
    top: 10px;
    opacity: 0.8;
}

/* =========================
   ASTRONAUT BODY
========================= */

.astronaut-body {
    width: 68px;
    height: 72px;
    margin: -4px auto 0;
    border-radius: 25px 25px 20px 20px;
    background: #f8faff;
    border: 4px solid #dce6f1;
    position: relative;
}

/* E4U Logo */

.astronaut-body::before {
    content: "E4U";
    position: absolute;
    left: 50%;
    top: 27px;
    transform: translateX(-50%);
    padding: 4px 7px;
    border-radius: 5px;
    background: var(--pink);
    color: #ffffff;
    font-size: 7px;
    font-weight: bold;
}

/* =========================
   ASTRONAUT LEGS
========================= */

.astronaut-leg {
    position: absolute;
    bottom: -35px;
    width: 28px;
    height: 48px;
    background: #f8faff;
    border: 4px solid #dce6f1;
    border-radius: 15px;
}

.leg-left {
    left: 8px;
    transform: rotate(10deg);
}

.leg-right {
    right: 8px;
    transform: rotate(-15deg);
}

/* =========================
   ASTRONAUT ARMS
========================= */

.astronaut-arm {
    position: absolute;
    width: 22px;
    height: 53px;
    top: 6px;
    background: #f8faff;
    border: 4px solid #dce6f1;
    border-radius: 15px;
}

.arm-left {
    left: -22px;
    transform: rotate(35deg);
}

.arm-right {
    right: -22px;
    transform: rotate(-35deg);
}

/* =========================
   ASTRONAUT HAND
========================= */

.hand {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #ffffff;
    border: 3px solid #dce6f1;
    right: -10px;
    top: -9px;
}

        /* =========================
           TEXT
        ========================= */
        
        .error-title {
            margin-top: 30px;
            font-size: clamp(30px, 4vw, 48px);
            font-weight: 800;
        }
        
        .error-title span {
            color: var(--pink);
        }
        
        .error-description {
            max-width: 620px;
            margin: 15px auto 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
        }
        /* =========================
           PAPER PLANE
        ========================= */
        
        .flight-path {
            width: 430px;
            max-width: 80%;
            height: 80px;
            margin: 10px auto 0;
            position: relative;
        }
        
        .flight-path svg {
            width: 100%;
            height: 100%;
        }
        /* =========================
           BUTTONS
        ========================= */
        
        .error-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-top: 0;
            flex-wrap: wrap;
        }
        
        .error-btn {
            min-width: 210px;
            height: 55px;
            padding: 0 25px;
            border-radius: 100px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: .3s ease;
        }
        
        .error-btn svg {
            width: 20px;
            height: 20px;
        }
        
        .btn-primary {
            background: var(--pink);
            color: var(--white);
            box-shadow: 0 8px 30px rgba(255, 60, 118, 0.25);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
        }
        
        .btn-outline {
            color: var(--white);
            border: 1px solid var(--pink);
            background: transparent;
        }
        
        .btn-outline:hover {
            background: rgba(255, 60, 245, .1);
            transform: translateY(-3px);
        }
        /* =========================
           FOOTER
        ========================= */
        
        .error-footer {
            text-align: center;
            padding: 30px 20px;
        }
        
        
        .support-icon {
            position: relative;
            z-index: 2;
            width: 58px;
            height: 58px;
            margin: -50px auto 12px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--navy);
            border: 2px solid #1d426d;
            color: var(--pink);
            box-shadow: 0 0 0 7px rgba(12, 34, 61, .25);
        }
        
        .support-icon svg {
            width: 27px;
        }
        
        .support-title {
            position: relative;
            z-index: 2;
            font-size: 18px;
            font-weight: 700;
        }
        
        .support-text {
            position: relative;
            z-index: 2;
            color: var(--muted);
            margin-top: 5px;
            font-size: 14px;
        }
        
        .support-email {
            position: relative;
            z-index: 2;
            margin-top: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #b9c7d8;
            text-decoration: none;
            font-size: 14px;
        }
        
        .support-email svg {
            color: var(--pink);
            width: 19px;
        }
        /* =========================
           RESPONSIVE
        ========================= */
        
        @media (max-width: 700px) {
            .error-header {
                width: calc(100% - 30px);
                padding: 20px 0;
            }
            .brand-name img{
                height: 30px !important;
            }
            .home-top-btn {
                padding: 10px 14px;
                font-size: 13px;
            }
            .error-content {
                margin-top: 30px;
            }
            .error-number {
                gap: 0;
                margin-top: 50px;
            }
            .number-four {
                font-size: 125px;
            }
            .number-zero {
                width: 120px;
                height: 155px;
                border-width: 14px;
            }
            .astronaut {
                transform: translate(-50%, -50%) scale(.72);
            }
            .planet-one {
                left: -30px;
            }
            .planet-two {
                right: 5%;
            }
            .error-title {
                margin-top: 35px;
                font-size: 29px;
            }
            .error-description {
                font-size: 14px;
                line-height: 1.6;
                padding: 0 10px;
            }
            .flight-path {
                height: 65px;
            }
            .error-actions {
                flex-direction: column;
                align-items: center;
            }
            .error-btn {
                width: min(100%, 320px);
            }
            .error-footer {
                margin-top: 25px;
            }
        }
        
        @media (max-width: 420px) {
            .home-top-btn span {
                display: none;
            }
            .home-top-btn {
                width: 42px;
                height: 42px;
                padding: 0;
                justify-content: center;
            }
            .number-four {
                font-size: 100px;
            }
            .number-zero {
                width: 100px;
                height: 110px;
                border-width: 12px;
            }
            .astronaut {
                transform: translate(-50%, -50%) scale(.58);
            }
            .error-title {
                font-size: 26px;
            }
        }
        
/* =========================
   MOBILE
========================= */

@media (max-width: 700px) {
    .astronaut {
        transform: translate(-50%, -50%) scale(0.5);
    }
}

@media (max-width: 420px) {
    .astronaut {
        transform: translate(-50%, -50%) scale(0.42);
    }
}
    </style>
</head>

<body>

    <div class="error-page">

        <div class="stars"></div>

        <!-- HEADER -->
        <header class="error-header">

            <a href="/" class="brand">
                <div>
                    <div class="brand-name">
                        <img src="{{ asset('assets/app/img/logo.png') }}" alt="Logo" style="height: 50px;">
                    </div>

                </div>

            </a>

            <a href="{{ url('/') }}" class="home-top-btn">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 11.5 12 4l9 7.5"></path>
                <path d="M5 10v10h14V10"></path>
                <path d="M9 20v-6h6v6"></path>
            </svg>

                <span>Back to Home</span>

            </a>

        </header>


        <!-- MAIN CONTENT -->
        <main class="error-content">

            <div class="planet planet-one"></div>
            <div class="planet planet-two"></div>

            <!-- 404 -->
            <div class="error-number">

                <div class="number-four">4</div>

                <div class="number-zero">

                    <!-- Astronaut -->
                    <div class="astronaut">

                        <div class="astronaut-head">
                            <div class="astronaut-glass"></div>
                        </div>

                        <div class="astronaut-body">

                            <div class="astronaut-arm arm-left"></div>

                            <div class="astronaut-arm arm-right">
                                <div class="hand"></div>
                            </div>

                            <div class="astronaut-leg leg-left"></div>
                            <div class="astronaut-leg leg-right"></div>

                        </div>

                    </div>

                </div>

                <div class="number-four">4</div>

            </div>


            <!-- TEXT -->
            <h1 class="error-title">
                <span>Oops!</span> Page Not Found
            </h1>

            <p class="error-description">
                The page you’re looking for doesn’t exist or has been moved. Let’s get you back on track.
            </p>


            <!-- FLIGHT PATH -->
            <div class="flight-path">

                <svg viewBox="0 0 500 100" fill="none">

                <path
                    d="M20 70
                       C100 5, 160 5, 220 55
                       C280 105, 360 90, 420 45"
                    stroke="#ff3c5f"
                    stroke-width="2"
                    stroke-dasharray="7 8"
                />

                <path
                    d="M405 43L450 25L430 68L421 51L405 43Z"
                    stroke="#ff3c5f"
                    stroke-width="2"
                    fill="none"
                />

                <path
                    d="M421 51L449 25"
                    stroke="#ff3c5f"
                    stroke-width="2"
                />

            </svg>

            </div>


            <!-- BUTTONS -->
            <div class="error-actions">

                <a href="{{ url('/') }}" class="error-btn btn-primary">

                    <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 3 3 10v10h6v-6h6v6h6V10l-9-7Z"/>
                </svg> Go Back Home

                </a>


                <a href="{{ route('public.web.escort.listing') }}" class="error-btn btn-outline">

                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" class="icon_esc" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7Z" stroke="#ffffff" stroke-width="2"></path>
                                        <path d="M5 19.5C5 15.9101 7.91015 13 11.5 13H12.5C16.0899 13 19 15.9101 19 19.5V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V19.5Z" stroke="#ffffff" stroke-width="2"></path>
                                    </g>
                                </svg> View Escorts

                </a>

            </div>

        </main>


        <!-- FOOTER -->
        <footer class="error-footer">           

            <h3 class="support-title">
                Need Help?
            </h3>

            <a href="mailto:support@escorts4u.com.au" class="support-email">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                <path d="m3 7 9 6 9-6"></path>

            </svg> support@escorts4u.com.au

            </a>

        </footer>

    </div>

</body>

</html>
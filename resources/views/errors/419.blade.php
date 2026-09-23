<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/app/img/favicon.ico') }}" />
    <title>419 - Page Expired</title>

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
            background: radial-gradient(circle at 50% 38%, rgba(255, 60, 245, 0.10), transparent 30%), linear-gradient(180deg, #081b32 0%, var(--navy) 65%, #091d36 100%);
        }

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

       


        .error-title {
            margin-top: 30px;
            font-size: clamp(30px, 4vw, 48px);
            font-weight: 800;
        }

        .error-title span {
            color: var(--pink);
        }

        .error-description {
            max-width: 665px;
            margin: 15px auto 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
        }


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


        @media (max-width: 700px) {
            .error-header {
                width: calc(100% - 30px);
                padding: 20px 0;
            }

            .brand-name img {
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


            .astronaut {
                transform: translate(-50%, -50%) scale(.58);
            }

            .error-title {
                font-size: 26px;
            }
        }


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
                <div class="number-four">1</div>

              

                <div class="number-four">9</div>

            </div>


            <!-- TEXT -->
            <h1 class="error-title">
                <span>Oops!</span> Page Expired
            </h1>

            <p class="error-description">
                Your session has expired due to inactivity. Please refresh the page and try again to continue.
            </p>


            <!-- FLIGHT PATH -->
            <div class="flight-path">

                <svg viewBox="0 0 500 100" fill="none">

                    <path d="M20 70
                       C100 5, 160 5, 220 55
                       C280 105, 360 90, 420 45" stroke="#ff3c5f" stroke-width="2" stroke-dasharray="7 8" />

                    <path d="M405 43L450 25L430 68L421 51L405 43Z" stroke="#ff3c5f" stroke-width="2" fill="none" />

                    <path d="M421 51L449 25" stroke="#ff3c5f" stroke-width="2" />

                </svg>

            </div>


            <!-- BUTTONS -->
            <div class="error-actions">   

                <a href="javascript:location.reload();" class="error-btn btn-outline">

                   <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">

                        <path d="M20 11a8.1 8.1 0 0 0-15.5-2"></path>

                        <path d="M4 5v4h4"></path>

                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2"></path>

                        <path d="M20 19v-4h-4"></path>

                    </svg> Refresh Page

                </a>
                 <a href="{{ route('home') }}" class="error-btn btn-primary">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">

                        <path d="M3 11.5 12 4l9 7.5"></path>
                        <path d="M5 10v10h14V10"></path>
                        <path d="M9 20v-6h6v6"></path>

                    </svg> Back to Home

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

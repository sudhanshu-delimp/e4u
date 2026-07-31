
    <style>
        .profile-skeleton {
            display: flex;
            gap: 18px;
            background: #fff;
            overflow: hidden;
            border: 1px solid #ececec;
            margin: 50px 0px;
        }
        
        .sk-list-image {
            width: 300px;
            height: 400px;
            flex-shrink: 0;
        }
        
        .sk-list-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .sk-list-top {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .sk-list-title {
            width: 180px;
            height: 32px;
            border-radius: 5px;
        }
        
        .sk-list-age {
            width: 70px;
            height: 32px;
            margin-left: auto;
            border-radius: 5px;
        }
        
        .sk-list-btn {
            width: 180px;
            height: 32px;
            border-radius: 5px;
        }
        
        .sk-list-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .sk-list-line {
            height: 12px;
            border-radius: 5px;
        }
        
        .sk-list-line.small {
            width: 150px;
        }
        
        .sk-list-services {
            display: flex;
            gap: 18px;
            margin-bottom: 35px;
        }
        
        .service-card {
            width: 160px;
            height: 55px;
            border-radius: 12px;
        }
        
        .sk-list-about-title {
            width: 120px;
            height: 22px;
            margin-bottom: 18px;
            border-radius: 5px;
        }
        
        .sk-list-about {
            height: 12px;
            margin-bottom: 12px;
            border-radius: 4px;
        }
        
        .sk-list-about.short {
            width: 70%;
        }
        
        .sk-list-bottom {
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 18px;
        }
        
        .sk-list-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
        }
        
        .sk-list-profile-btn {
            width: 140px;
            height: 40px;
            margin-left: auto;
            border-radius: 8px;
        }
        
        .sk-list-table {
            width: 300px;
            border: 1px solid #e8e8e8;
            overflow: hidden;
        }
        
        .table-head,
        .table-row {
            display: grid;
            grid-template-columns: 1.3fr 1fr 1fr;
        }
        
        .th {
            height: 48px;
            margin: 8px;
            border-radius: 5px;
        }
        
        .td {
            height: 22px;
            margin: 11px 8px;
            border-radius: 5px;
        }
        
        .td.small {
            width: 50px;
        }
        
        .table-footer {
            height: 45px;
            margin: 10px;
            border-radius: 5px;
        }
        /* Shimmer Animation */
        
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .7), transparent);
            animation: loading 1.3s infinite;
        }
        
        @keyframes loading {
            100% {
                left: 150%;
            }
        }
        
        @media(max-width:992px) {
            .profile-skeleton {
                flex-direction: column;
            }
            .sk-list-image,
            .sk-list-table {
                width: 100%;
            }
            .sk-list-services {
                flex-wrap: wrap;
            }
            .sk-list-info {
                grid-template-columns: 1fr;
            }
        }
    </style>


<div class="container">
    <div class="row">
        <div class="col-sm-12" id="list-skeleton">
            @for($i = 0; $i < 3; $i++)
            <div class="profile-skeleton" >
                <!-- Left Image -->
                <div class="sk-list-image shimmer"></div>
                <!-- Center Content -->
                <div class="sk-list-content">

                    <div class="sk-list-top">
                        <div class="shimmer sk-list-title"></div>
                        <div class="shimmer sk-list-age"></div>
                        <div class="shimmer sk-list-btn"></div>
                    </div>

                    <div class="sk-list-info">
                        <div class="shimmer sk-list-line"></div>
                        <div class="shimmer sk-list-line"></div>
                        <div class="shimmer sk-list-line"></div>
                        <div class="shimmer sk-list-line small"></div>
                    </div>

                    <div class="sk-list-services">
                        <div class="service-card shimmer"></div>
                        <div class="service-card shimmer"></div>
                        <div class="service-card shimmer"></div>
                    </div>

                    <div class="shimmer sk-list-about-title"></div>

                    <div class="shimmer sk-list-about"></div>
                    <div class="shimmer sk-list-about"></div>
                    <div class="shimmer sk-list-about short"></div>

                    <div class="sk-list-bottom">
                        <div class="sk-list-circle shimmer"></div>
                        <div class="sk-list-circle shimmer"></div>
                        <div class="sk-list-circle shimmer"></div>
                        <div class="sk-list-circle shimmer"></div>
                        <div class="shimmer sk-list-profile-btn"></div>
                    </div>

                </div>
                <!-- Right Table -->
                <div class="sk-list-table">

                    <div class="table-head">
                        <div class="shimmer th"></div>
                        <div class="shimmer th"></div>
                        <div class="shimmer th"></div>
                    </div>

                    <div class="table-row">
                        <div class="shimmer td"></div>
                        <div class="shimmer td small"></div>
                        <div class="shimmer td small"></div>
                    </div>

                    <div class="table-row">
                        <div class="shimmer td"></div>
                        <div class="shimmer td small"></div>
                        <div class="shimmer td small"></div>
                    </div>

                    <div class="table-row">
                        <div class="shimmer td"></div>
                        <div class="shimmer td small"></div>
                        <div class="shimmer td small"></div>
                    </div>

                    <div class="table-row">
                        <div class="shimmer td"></div>
                        <div class="shimmer td small"></div>
                        <div class="shimmer td small"></div>
                    </div>

                    <div class="table-row">
                        <div class="shimmer td"></div>
                        <div class="shimmer td small"></div>
                        <div class="shimmer td small"></div>
                    </div>


                    <div class="table-row">
                        <div class="shimmer td"></div>
                        <div class="shimmer td small"></div>
                        <div class="shimmer td small"></div>
                    </div>


                    <div class="table-footer shimmer"></div>

                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

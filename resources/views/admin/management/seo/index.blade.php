@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /*  HEADER  */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-bottom: 28px;
        }

        .reset-btn,
        .save-btn {
            height: 44px;

            padding: 0 20px;

            border-radius: 8px;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
        }

        .reset-btn {
            background: white;
            border: 1px solid #e7e9ee;
            color: #0c223d;
        }

        .save-btn {
            background: #ff3c5f;
            color: white;
            border: none;

            box-shadow: 0 5px 15px rgba(247, 37, 95, 0.2);
        }


        /*  MAIN GRID  */

        .seo-layout {
            display: grid;

            grid-template-columns:
                295px minmax(500px, 1fr) 350px;

            gap: 20px;

            align-items: start;
        }


        /*  SEARCH PANEL  */

        .search-panel {
            background: white;

            border: 1px solid #e7e9ee;

            border-radius: 14px;

            padding: 18px;

            min-height: 850px;

            box-shadow: 0 4px 20px rgba(16, 39, 70, 0.06);
        }



        /*  CARDS  */

        .seo-card,
        .side-card,
        .tip-card {
            background: white;

            border: 1px solid #e7e9ee;

            border-radius: 14px;

            box-shadow: 0 4px 20px rgba(16, 39, 70, 0.06);

            padding: 28px;

            margin-bottom: 20px;
        }


        /*  SECTION HEADING  */

        .section-heading {
            display: flex;
            align-items: center;

            gap: 12px;

            margin-bottom: 25px;
        }

        .section-heading h2,
        .side-heading h2 {
            font-size: 17px;
            font-weight: 700;
            color: #0c223d;
        }

        .section-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #fff0f4;

            color: #ff3c5f;

            font-size: 14px;
        }

        .section-icon i {
            color: #ff3c5f;
        }

        /*  FORM  */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label,
        .priority-section label {
            display: block;

            margin-bottom: 8px;

            font-size: 13px;
            font-weight: 600;

            color: #0c223d;
        }

        .form-group input,
        .form-group textarea,
        .form-group select,
        .og-fields input,
        .schema-heading select {
            width: 100%;

            border: 1px solid #e7e9ee;

            background: white;

            border-radius: 8px;

            padding: 13px 14px;

            font-family: inherit;

            font-size: 14px;

            color: #0c223d;

            outline: none;

            transition: .2s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .og-fields input:focus,
        .schema-heading select:focus {
            border-color: #0c223d;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 95px;
        }


        /*  COUNTER  */

        .input-counter,
        .textarea-counter {
            position: relative;
        }

        .counter {
            position: absolute;

            right: 8px;
            bottom: 8px;

            padding: 4px 8px;

            border-radius: 10px;

            font-size: 11px;
            font-weight: 600;
        }

        .counter.good {
            background: #dcfce7;
            color: #159447;
        }

        .counter.warning {
            background: #fff4d6;
            color: #c68100;
        }

        .counter.danger {
            background: #ffe2e8;
            color: #d7194d;
        }


        /*  GOOGLE PREVIEW  */

        .google-preview {
            border: 1px solid #e2e7ee;

            border-radius: 9px;

            padding: 18px;

            background: #fff;
        }

        .preview-label {
            color: #7c8798;

            font-size: 12px;

            margin-bottom: 12px;
        }

        .preview-url {
            font-size: 12px;
            color: #5d6878;

            margin-bottom: 7px;
        }

        .preview-title {
            font-size: 17px;

            color: #1a0dab;

            margin-bottom: 6px;
        }

        .preview-description {
            font-size: 13px;

            line-height: 1.5;

            color: #4d5664;
        }


        /*  OG  */

        .og-layout {
            display: grid;

            grid-template-columns: 145px 1fr;

            gap: 20px;

            align-items: start;
        }

        .image-upload {
            height: 145px;

            border: 1px dashed #ffb6c8;

            border-radius: 9px;

            background: #fff9fb;
        }

        .image-upload label {
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-direction: column;

            gap: 12px;

            cursor: pointer;

            color: #ff3c5f;
        }

        .image-upload i {
            font-size: 27px;
        }

        .image-upload span {
            font-size: 12px;
        }


        /*  SCHEMA  */

        .schema-heading {
            display: grid;

            grid-template-columns: 190px 1fr;

            gap: 15px;

            align-items: center;

            margin-bottom: 15px;
        }

        .schema-heading .section-heading {
            margin-bottom: 0;
        }

        .schema-code {
            background: #f8f9fb;

            border: 1px solid #edf0f4;

            border-radius: 9px;

            padding: 18px;

            color: #334155;

            font-size: 12px;

            line-height: 1.7;

            overflow-x: auto;
        }

        .schema-help {
            margin-top: 10px;

            font-size: 11px;

            color: #8a95a5;
        }


        /*  RIGHT PANEL  */

        .side-heading {
            display: flex;
            align-items: center;

            gap: 12px;

            margin-bottom: 24px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;

            gap: 10px;

            font-size: 13px;

            margin-bottom: 25px;

            cursor: pointer;
        }

        .checkbox-row input {
            display: none;
        }

        .custom-checkbox {
            width: 19px;
            height: 19px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #ccd4df;

            border-radius: 4px;

            color: white;

            font-size: 11px;
        }

        .checkbox-row input:checked+.custom-checkbox {
            background: #ff3c5f;
            border-color: #ff3c5f;
        }


        /*  PRIORITY  */

        .priority-section {
            margin-bottom: 25px;
        }

        .priority-row {
            display: grid;

            grid-template-columns: 1fr 65px;

            gap: 15px;

            align-items: center;
        }

        .priority-row input[type="range"] {
            width: 100%;

            accent-color: #ff3c5f;
        }

        .priority-row input[type="text"] {
            width: 65px;

            height: 42px;

            text-align: center;

            border: 1px solid #ffc5d3;

            border-radius: 7px;

            color: #ff3c5f;

            font-weight: 600;

            outline: none;
        }


        /*  REGENERATE  */

        .regenerate-card {
            display: grid;

            grid-template-columns: 40px 1fr;

            gap: 12px;
        }

        .generated-icon {
            width: 45px;
            height: 45px;

            border-radius: 50%;

            background: #fff0f4;

            color: #ff3c5f;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .generated-content {
            display: flex;
            flex-direction: column;

            gap: 5px;
        }

        .generated-content strong {
            font-size: 13px;
        }

        .generated-content span {
            color: #687994;
            font-size: 12px;
        }

        .regenerate-btn {
            grid-column: 1 / -1;

            border: none;

            background: #fff0f4;

            color: #ff3c5f;

            height: 42px;

            border-radius: 7px;

            font-weight: 600;

            cursor: pointer;
        }


        /*  TIP  */

        .tip-card {
            display: flex;

            gap: 12px;

            background: #fff;

            border-color: #e7e9ee;

            color: #8f9ebd;
        }

        .tip-icon {
            min-width: 23px;
            height: 23px;
            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 11px;
        }

        .tip-card p {
            font-size: 12px;

            line-height: 1.7;
        }


        /*  SAVE STATUS  */

        .save-status {
            text-align: center;

            padding: 18px;

            color: #7a8698;

            font-size: 12px;
        }

        .save-status strong {
            color: #0c223d;
        }

        /*  PAGE LIST  */

        .page-list {
            margin-top: 10px;

            display: flex;
            flex-direction: column;

            gap: 5px;
        }


        /* Page Item */

        .page-item {
            width: 100%;

            display: flex;
            align-items: center;

            gap: 11px;

            padding: 12px 13px;

            border: none;

            border-radius: 9px;

            background: transparent;

            color: #687994;

            font-family: inherit;

            font-size: 14px;

            text-align: left;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        /* Icon */

        .page-icon {
            width: 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #687994;

            font-size: 13px;
        }


        /* Hover */

        .page-item:hover {
            background: #f8f9fb;

            color: #102746;
        }


        /* Active */

        .page-item.active {
            background: #fff0f4;

            color: #ff3c5f;

            font-weight: 600;
        }

        .page-item.active .page-icon {
            color: #ff3c5f;
        }


        /* Page Name */

        .page-name {
            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }





        /*  RESPONSIVE  */

        @media (max-width: 1200px) {

            .seo-layout {
                grid-template-columns:
                    240px minmax(450px, 1fr);
            }

            .right-panel {
                grid-column: 2;
            }

        }


        @media (max-width: 900px) {

            .seo-wrapper {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .seo-layout {
                grid-template-columns: 1fr;
            }

            .search-panel {
                min-height: auto;
            }

            .right-panel {
                grid-column: auto;
            }

        }


        @media (max-width: 600px) { 
            .header-actions {
                width: 100%;
            }

            .reset-btn,
            .save-btn {
                flex: 1;
            }

            .og-layout,
            .schema-heading {
                grid-template-columns: 1fr;
            }

            .image-upload {
                height: 130px;
            }

        }
    </style>
@stop
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">SEO Settings</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Optimize your page for search engines and social sharing.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="seo-wrapper">

                            <!--  HEADER  -->
                            <div class="page-header">

                                <div class="header-actions">

                                    <button class="reset-btn">
                                        <svg width="15px" height="15px" viewBox="0 0 21 21"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000"
                                            stroke-width="2.1">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g fill="none" fill-rule="evenodd" stroke="#000000"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    transform="matrix(0 1 1 0 2.5 2.5)">
                                                    <path
                                                        d="m3.98652376 1.07807068c-2.38377179 1.38514556-3.98652376 3.96636605-3.98652376 6.92192932 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8">
                                                    </path>
                                                    <path d="m4 1v4h-4" transform="matrix(1 0 0 -1 0 6)"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        Reset
                                    </button>

                                    <button class="save-btn">
                                        <svg width="15px" height="15px" viewBox="0 0 16 16"
                                            xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill="#ffffff" fill-rule="evenodd"
                                                    d="M1 3.25A2.25 2.25 0 013.25 1h6.879a2.25 2.25 0 011.59.659l2.622 2.621c.422.422.659.995.659 1.591v6.879A2.25 2.25 0 0112.75 15h-9.5A2.25 2.25 0 011 12.75v-9.5zm2.25-.75a.75.75 0 00-.75.75v9.5c0 .414.336.75.75.75h.8V9.25a1.2 1.2 0 011.2-1.2h5.5a1.2 1.2 0 011.2 1.2v4.25h.8a.75.75 0 00.75-.75V5.871a.75.75 0 00-.22-.53L10.66 2.72a.75.75 0 00-.53-.22H5.45v2.05h3.8a.7.7 0 010 1.4h-4a1.2 1.2 0 01-1.2-1.2V2.5h-.8zm7.3 11h-5.1V9.45h5.1v4.05z"
                                                    clip-rule="evenodd"></path>
                                            </g>
                                        </svg>
                                        Save
                                    </button>

                                </div>

                            </div>


                            <!--  MAIN LAYOUT  -->
                            <div class="seo-layout">


                                <!-- SEARCH -->
                                <aside class="search-panel">


                                    <!-- Page List -->
                                    <div class="page-list" id="pageList">

                                        <button type="button" class="page-item active">
                                            <span class="page-name">
                                                Home
                                            </span>
                                        </button>


                                        <button type="button" class="page-item">
                                            <span class="page-name">
                                                About Us
                                            </span>

                                        </button>


                                        <button type="button" class="page-item">

                                            <span class="page-name">
                                                Products
                                            </span>

                                        </button>


                                        <button type="button" class="page-item">

                                            <span class="page-name">
                                                Blog / Post
                                            </span>

                                        </button>


                                        <button type="button" class="page-item">

                                            <span class="page-name">
                                                Contact
                                            </span>

                                        </button>

                                    </div>


                                </aside>

                                <!--  CONTENT  -->
                                <main class="content-panel">


                                    <!--  META TAGS  -->
                                    <section class="seo-card">

                                        <div class="section-heading">

                                            <div class="section-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M12.32 19.98C11.74 19.98 11.16 19.76 10.72 19.32L4.24 12.85C4.1 12.71 4.02 12.52 4.02 12.32V4.77002C4.02 4.36002 4.36 4.02002 4.77 4.02002H12.31C12.51 4.02002 12.7 4.10002 12.84 4.24002L19.32 10.72C20.19 11.6 20.19 13.03 19.32 13.91L13.91 19.32C13.47 19.76 12.89 19.98 12.31 19.98H12.32ZM5.52 12.01L11.78 18.26C12.08 18.55 12.56 18.55 12.85 18.26L18.26 12.85C18.55 12.56 18.55 12.08 18.26 11.78L12 5.52002H5.52V12V12.01ZM8.5 9.75002C7.81 9.75002 7.25 9.19002 7.25 8.50002C7.25 7.81002 7.81 7.25002 8.5 7.25002C9.19 7.25002 9.75 7.81002 9.75 8.50002C9.75 9.19002 9.19 9.75002 8.5 9.75002Z"
                                                            fill="#ff3c5f"></path>
                                                    </g>
                                                </svg>
                                            </div>

                                            <h2>Meta Tags</h2>

                                        </div>


                                        <!-- Meta Title -->
                                        <div class="form-group">

                                            <label for="metaTitle">
                                                Meta Title
                                            </label>

                                            <div class="input-counter">

                                                <input type="text" id="metaTitle" maxlength="60"
                                                    value="Buy handmade leather bags online | Acme Co.">

                                                <span id="titleCount" class="counter good">
                                                    44 / 60
                                                </span>

                                            </div>

                                        </div>


                                        <!-- Meta Description -->
                                        <div class="form-group">

                                            <label for="metaDescription">
                                                Meta Description
                                            </label>

                                            <div class="textarea-counter">

                                                <textarea id="metaDescription" maxlength="160" rows="3">Shop handcrafted leather bags made in small batches. Free shipping over $50 and a 30-day return policy.</textarea>

                                                <span id="descriptionCount" class="counter good">
                                                    108 / 160
                                                </span>

                                            </div>

                                        </div>


                                        <!-- Google Preview -->
                                        <div class="google-preview">

                                            <div class="preview-label">
                                                Google Preview
                                            </div>

                                            <div class="preview-url">
                                                acmeco.com &gt; ...
                                            </div>

                                            <div class="preview-title" id="googleTitle">
                                                Buy handmade leather bags online | Acme Co.
                                            </div>

                                            <div class="preview-description" id="googleDescription">
                                                Shop handcrafted leather bags made in small batches.
                                                Free shipping over $50 and a 30-day return policy.
                                            </div>

                                        </div>

                                    </section>


                                    <!--  OPEN GRAPH  -->
                                    <section class="seo-card">

                                        <div class="section-heading">

                                            <div class="section-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M23 5.5C23 7.98528 20.9853 10 18.5 10C17.0993 10 15.8481 9.36007 15.0228 8.35663L9.87308 10.9315C9.95603 11.2731 10 11.63 10 11.9971C10 12.3661 9.9556 12.7247 9.87184 13.0678L15.0228 15.6433C15.8482 14.6399 17.0993 14 18.5 14C20.9853 14 23 16.0147 23 18.5C23 20.9853 20.9853 23 18.5 23C16.0147 23 14 20.9853 14 18.5C14 18.1319 14.0442 17.7742 14.1276 17.4318L8.97554 14.8558C8.1502 15.8581 6.89973 16.4971 5.5 16.4971C3.01472 16.4971 1 14.4824 1 11.9971C1 9.51185 3.01472 7.49713 5.5 7.49713C6.90161 7.49713 8.15356 8.13793 8.97886 9.14254L14.1275 6.5682C14.0442 6.2258 14 5.86806 14 5.5C14 3.01472 16.0147 1 18.5 1C20.9853 1 23 3.01472 23 5.5ZM16.0029 5.5C16.0029 6.87913 17.1209 7.99713 18.5 7.99713C19.8791 7.99713 20.9971 6.87913 20.9971 5.5C20.9971 4.12087 19.8791 3.00287 18.5 3.00287C17.1209 3.00287 16.0029 4.12087 16.0029 5.5ZM16.0029 18.5C16.0029 19.8791 17.1209 20.9971 18.5 20.9971C19.8791 20.9971 20.9971 19.8791 20.9971 18.5C20.9971 17.1209 19.8791 16.0029 18.5 16.0029C17.1209 16.0029 16.0029 17.1209 16.0029 18.5ZM5.5 14.4943C4.12087 14.4943 3.00287 13.3763 3.00287 11.9971C3.00287 10.618 4.12087 9.5 5.5 9.5C6.87913 9.5 7.99713 10.618 7.99713 11.9971C7.99713 13.3763 6.87913 14.4943 5.5 14.4943Z"
                                                            fill="#ff3c5f"></path>
                                                    </g>
                                                </svg>
                                            </div>

                                            <h2>Open Graph / Social</h2>

                                        </div>


                                        <div class="og-layout">

                                            <!-- Upload -->
                                            <div class="image-upload">

                                                <input type="file" id="ogImage" accept="image/*" hidden>

                                                <label for="ogImage">

                                                    <i class="fa-regular fa-image"></i>

                                                    <span>Upload Image</span>

                                                </label>

                                            </div>


                                            <!-- OG Fields -->
                                            <div class="og-fields">

                                                <div class="form-group">

                                                    <label for="ogTitle">
                                                        OG Title
                                                    </label>

                                                    <input type="text" id="ogTitle"
                                                        value="Handmade leather bags | Acme Co.">

                                                </div>


                                                <div class="form-group">

                                                    <label for="ogUrl">
                                                        OG Image URL
                                                    </label>

                                                    <input type="text" id="ogUrl"
                                                        value="/uploads/og/home-cover.jpg">

                                                </div>

                                            </div>

                                        </div>

                                    </section>


                                    <!--  SCHEMA  -->
                                    <section class="seo-card">

                                        <div class="schema-heading">

                                            <div class="section-heading">

                                                <div class="section-icon">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M7 8L3 11.6923L7 16M17 8L21 11.6923L17 16M14 4L10 20"
                                                                stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                </div>

                                                <h2>Schema Markup</h2>

                                            </div>


                                            <select id="schemaType">

                                                <option value="Organization">
                                                    Organization
                                                </option>

                                                <option value="Article">
                                                    Article
                                                </option>

                                                <option value="Product">
                                                    Product
                                                </option>

                                                <option value="LocalBusiness">
                                                    Local Business
                                                </option>

                                            </select>

                                        </div>


                                        <pre class="schema-code"><code>{
    "@type": "Organization",
    "name": "Acme Co.",
    "url": "https://acmeco.com"
}</code></pre>

                                        <p class="schema-help">
                                            Fields above generate this automatically.
                                            No JSON editing needed.
                                        </p>

                                    </section>


                                </main>


                                <!--  RIGHT SIDEBAR  -->
                                <aside class="right-panel">


                                    <!-- Sitemap -->
                                    <section class="side-card">

                                        <div class="side-heading">

                                            <div class="section-icon">
                                                <svg width="24px" height="24px" viewBox="0 0 512 512"
                                                    xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path fill="var(--ci-primary-color, #ff3c5f)"
                                                            d="M472,328H448V264a24.027,24.027,0,0,0-24-24H272V176h32a24.028,24.028,0,0,0,24-24V80a24.028,24.028,0,0,0-24-24H208a24.028,24.028,0,0,0-24,24v72a24.028,24.028,0,0,0,24,24h32v64H88a24.027,24.027,0,0,0-24,24v64H40a24.028,24.028,0,0,0-24,24v72a24.028,24.028,0,0,0,24,24h80a24.028,24.028,0,0,0,24-24V352a24.028,24.028,0,0,0-24-24H96V272H240v56H216a24.028,24.028,0,0,0-24,24v72a24.028,24.028,0,0,0,24,24h80a24.028,24.028,0,0,0,24-24V352a24.028,24.028,0,0,0-24-24H272V272H416v56H392a24.028,24.028,0,0,0-24,24v72a24.028,24.028,0,0,0,24,24h80a24.028,24.028,0,0,0,24-24V352A24.028,24.028,0,0,0,472,328ZM216,88h80v56H216ZM112,360v56H48V360Zm176,0v56H224V360Zm176,56H400V360h64Z"
                                                            class="ci-primary"></path>
                                                    </g>
                                                </svg>
                                            </div>

                                            <h2>Sitemap.xml</h2>

                                        </div>


                                        <!-- Checkbox -->
                                        <label class="checkbox-row">

                                            <input type="checkbox" checked>

                                            <span class="custom-checkbox">
                                                <i class="fa-solid fa-check"></i>
                                            </span>

                                            <span>
                                                Include this page
                                            </span>

                                        </label>
                                    </section>


                                    <!-- Regenerate -->
                                    <section class="side-card regenerate-card">

                                        <div class="generated-icon">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM3.00683 12C3.00683 16.9668 7.03321 20.9932 12 20.9932C16.9668 20.9932 20.9932 16.9668 20.9932 12C20.9932 7.03321 16.9668 3.00683 12 3.00683C7.03321 3.00683 3.00683 7.03321 3.00683 12Z"
                                                        fill="#ff3c5f"></path>
                                                    <path
                                                        d="M12 5C11.4477 5 11 5.44771 11 6V12.4667C11 12.4667 11 12.7274 11.1267 12.9235C11.2115 13.0898 11.3437 13.2343 11.5174 13.3346L16.1372 16.0019C16.6155 16.278 17.2271 16.1141 17.5032 15.6358C17.7793 15.1575 17.6155 14.5459 17.1372 14.2698L13 11.8812V6C13 5.44772 12.5523 5 12 5Z"
                                                        fill="#ff3c5f"></path>
                                                </g>
                                            </svg>
                                        </div>

                                        <div class="generated-content">

                                            <strong>Last Generated</strong>

                                            <span>2 hours ago</span>

                                        </div>

                                        <button class="regenerate-btn">

                                            <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M4.06189 13C4.02104 12.6724 4 12.3387 4 12C4 7.58172 7.58172 4 12 4C14.5006 4 16.7332 5.14727 18.2002 6.94416M19.9381 11C19.979 11.3276 20 11.6613 20 12C20 16.4183 16.4183 20 12 20C9.61061 20 7.46589 18.9525 6 17.2916M9 17H6V17.2916M18.2002 4V6.94416M18.2002 6.94416V6.99993L15.2002 7M6 20V17.2916"
                                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>

                                            Regenerate Sitemap

                                        </button>

                                    </section>


                                    <!-- SEO Tip -->
                                    <section class="tip-card">

                                        <div class="tip-icon">
                                            <svg width="24px" height="24px" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill="#ff3c5f" fill-rule="evenodd"
                                                        d="M10 3a7 7 0 100 14 7 7 0 000-14zm-9 7a9 9 0 1118 0 9 9 0 01-18 0zm8-4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm.01 8a1 1 0 102 0V9a1 1 0 10-2 0v5z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>

                                        <p>
                                            Make sure your meta title and description
                                            are unique and relevant to get better
                                            visibility on search engines.
                                        </p>

                                    </section>


                                </aside>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const metaTitle = document.getElementById("metaTitle");
            const metaDescription = document.getElementById("metaDescription");

            const titleCount = document.getElementById("titleCount");
            const descriptionCount = document.getElementById("descriptionCount");

            const googleTitle = document.getElementById("googleTitle");
            const googleDescription = document.getElementById("googleDescription");

            /*  TITLE COUNT  */

            function updateTitle() {

                const length = metaTitle.value.length;

                titleCount.textContent = `${length} / 60`;

                googleTitle.textContent =
                    metaTitle.value || "Your page title";

                updateCounterClass(
                    titleCount,
                    length,
                    60
                );
            }


            /*  DESCRIPTION COUNT  */

            function updateDescription() {

                const length = metaDescription.value.length;

                descriptionCount.textContent =
                    `${length} / 160`;

                googleDescription.textContent =
                    metaDescription.value ||
                    "Your meta description will appear here.";

                updateCounterClass(
                    descriptionCount,
                    length,
                    160
                );
            }


            /*  COUNTER COLOR  */

            function updateCounterClass(
                element,
                length,
                maximum
            ) {

                element.classList.remove(
                    "good",
                    "warning",
                    "danger"
                );

                const percentage =
                    (length / maximum) * 100;

                if (percentage >= 95) {

                    element.classList.add("danger");

                } else if (percentage >= 80) {

                    element.classList.add("warning");

                } else {

                    element.classList.add("good");

                }
            }




            /*  EVENTS  */

            metaTitle.addEventListener(
                "input",
                updateTitle
            );

            metaDescription.addEventListener(
                "input",
                updateDescription
            );


            /*  IMAGE PREVIEW  */

            const imageInput =
                document.getElementById("ogImage");

            const uploadBox =
                document.querySelector(".image-upload");

            imageInput.addEventListener(
                "change",
                function(event) {

                    const file =
                        event.target.files[0];

                    if (!file) return;

                    const reader =
                        new FileReader();

                    reader.onload = function(e) {

                        uploadBox.style.backgroundImage =
                            `url(${e.target.result})`;

                        uploadBox.style.backgroundSize =
                            "cover";

                        uploadBox.style.backgroundPosition =
                            "center";

                        uploadBox.querySelector("label").style
                            .opacity = "0";
                    };

                    reader.readAsDataURL(file);
                }
            );

            /*  INITIAL  */

            updateTitle();
            updateDescription();

        });
    </script>
@endpush

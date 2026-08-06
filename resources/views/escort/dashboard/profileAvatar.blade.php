@extends('layouts.escort')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        label.cabinet {
            display: block;
            cursor: pointer;
        }

        label.cabinet input.file {
            position: relative;
            height: 100%;
            width: auto;
            opacity: 0;
            -moz-opacity: 0;
            filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
            margin-top: -30px;
        }

        #upload-demo {
            width: 250px;
            height: 250px;
            padding-bottom: 25px;
        }



        .file-types-box {
            display: flex;
            align-items: flex-start;
            gap: 22px;
            padding: 27px 25px;
            border: 1px solid #ffd8e1;
            border-radius: 15px;
            background: linear-gradient(135deg, #fffafd, #fff);
            margin-bottom: 30px;
            box-shadow: 0px 0px 6px -2px #ccc;
        }

        .file-types-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #f52f5b;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .file-types-content {
            width: 100%;
        }

        .file-types-content h2 {
            margin: 0 0 4px;
            color: #f52f5b;
            font-size: 22px;
            font-weight: 700;
        }

        .file-types-content>p {
            margin: 0 0 20px;
            color: #303c4d;
            font-size: 15px;
        }

        .file-rules {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .file-rule {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #263342;
            font-size: 14px;
            line-height: 1.5;
        }

        .file-rule i {
            color: #f52f5b;
            font-size: 17px;
            margin-top: 1px;
            flex-shrink: 0;
        }


        .avatar-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }

        .avatar-card {
            background: #fff;
            border: 1px solid #e8edf2;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(20, 45, 70, 0.07);
            min-height: 470px;
            box-sizing: border-box;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 22px;
        }

        .card-icon {
            width: 62px;
            height: 62px;
            background: #fff0f4;
            color: #f52f5b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .card-heading h3 {
            margin: 0 0 4px;
            color: #102d4d;
            font-size: 22px;
            font-weight: 700;
        }

        .card-heading p {
            margin: 0;
            color: #68778b;
            font-size: 14px;
        }

        .upload-area {
            min-height: 300px;
            border: 2px dashed #ffb9c9;
            border-radius: 13px;
            background: #fffafd;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .upload-area:hover {
            background: #fff4f7;
            border-color: #f52f5b;
        }

        .upload-icon {
            width: 65px;
            height: 65px;
            background: #ffedf2;
            color: #f52f5b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 17px;
        }

        .upload-area strong {
            font-size: 17px;
            color: #152c48;
        }

        .upload-area>span {
            margin: 8px 0;
            color: #a37d88;
            font-size: 14px;
        }

        .choose-file-btn {
            background: #f52f5b;
            color: #fff;
            padding: 11px 26px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .upload-area:hover .choose-file-btn {
            background: #dc204a;
        }

        .upload-info {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-top: 22px;
        }

        .upload-info-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #fff0f4;
            color: #f52f5b;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .upload-info p {
            margin: 2px 0;
            color: #304258;
            font-size: 13px;
        }

        .current-avatar-card {
            display: flex;
            flex-direction: column;
        }

        .current-avatar-image {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0 20px;
        }

        .current-avatar-image img {
            width: 275px;
            height: 275px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #ffe0e8;
            padding: 8px;
            box-sizing: border-box;
            background: #fff;
        }

        .avatar-actions {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: auto;
        }

        .change-avatar-btn,
        .remove-avatar-btn {
            height: 48px;
            padding: 0 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: all 0.25s ease;
        }

        .change-avatar-btn {
            background: #fff;
            color: #f52f5b;
            border: 1px solid #f52f5b;
        }

        .change-avatar-btn:hover {
            background: #fff0f4;
        }

        .remove-avatar-btn {
            background: #f52f5b;
            color: #fff;
            border: 1px solid #f52f5b;
        }

        .remove-avatar-btn:hover {
            background: #d92049;
        }

        .avatar-section {
            width: 100%;
            padding: 35px 30px 50px;
            box-sizing: border-box;
            font-family: "Poppins", Arial, sans-serif;
            color: #102d4d;
        }



        .avatar-header {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 35px;
        }

        .avatar-header-icon {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: #fff0f4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f52f5b;
            font-size: 34px;
            flex-shrink: 0;
        }

        .avatar-header-content {
            flex: 1;
        }

        .avatar-title-row {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .avatar-title-row h1 {
            margin: 0;
            font-size: 42px;
            line-height: 1.15;
            font-weight: 700;
            color: #092d51;
        }

        .avatar-header-content>p {
            margin: 8px 0 0;
            color: #66768b;
            font-size: 16px;
        }

        .help-btn {
            color: #f52f5b;
            padding: 9px 16px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .help-btn i {
            margin-right: 6px;
        }

        /* .help-btn:hover {
                        background: #f52f5b;
                        color: #fff;
                        border-color: #f52f5b;
                    } */

        .file-types-box {
            display: flex;
            align-items: flex-start;
            gap: 22px;
            padding: 27px 25px;
            border: 1px solid #ffd8e1;
            border-radius: 15px;
            background: linear-gradient(135deg, #fffafd, #fff);
            margin-bottom: 30px;
        }

        .file-types-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #f52f5b;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .file-types-content {
            width: 100%;
        }

        .file-types-content h2 {
            margin: 0 0 4px;
            color: #f52f5b;
            font-size: 22px;
            font-weight: 700;
        }

        .file-types-content>p {
            margin: 0 0 20px;
            color: #303c4d;
            font-size: 15px;
        }

        .file-rules {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .file-rule {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #263342;
            font-size: 14px;
            line-height: 1.5;
        }

        .file-rule i {
            color: #f52f5b;
            font-size: 17px;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .avatar-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }

        .avatar-card {
            background: #fff;
            border: 1px solid #e8edf2;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(20, 45, 70, 0.07);
            min-height: 470px;
            box-sizing: border-box;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 22px;
        }

        .card-icon {
            width: 62px;
            height: 62px;
            background: #fff0f4;
            color: #f52f5b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .card-heading h3 {
            margin: 0 0 4px;
            color: #102d4d;
            font-size: 22px;
            font-weight: 700;
        }

        .card-heading p {
            margin: 0;
            color: #68778b;
            font-size: 14px;
        }

        .upload-area {
            min-height: 300px;
            border: 2px dashed #ffb9c9;
            border-radius: 13px;
            background: #fffafd;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .upload-area:hover {
            background: #fff4f7;
            border-color: #f52f5b;
        }

        .upload-icon {
            width: 65px;
            height: 65px;
            background: #ffedf2;
            color: #f52f5b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 17px;
        }

        .upload-area strong {
            font-size: 17px;
            color: #152c48;
        }

        .upload-area>span {
            margin: 8px 0;
            color: #a37d88;
            font-size: 14px;
        }

        .choose-file-btn {
            background: #f52f5b;
            color: #fff;
            padding: 11px 26px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .upload-area:hover .choose-file-btn {
            background: #dc204a;
        }

        .upload-info {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-top: 22px;
        }

        .upload-info-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #fff0f4;
            color: #f52f5b;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .upload-info p {
            margin: 2px 0;
            color: #304258;
            font-size: 13px;
        }

        .current-avatar-card {
            display: flex;
            flex-direction: column;
        }

        .current-avatar-image {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0 20px;
        }

        .current-avatar-image img {
            width: 275px;
            height: 275px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #ffe0e8;
            padding: 8px;
            box-sizing: border-box;
            background: #fff;
        }

        .avatar-actions {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: auto;
        }

        .change-avatar-btn,
        .remove-avatar-btn {
            height: 48px;
            padding: 0 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: all 0.25s ease;
        }

        .change-avatar-btn {
            background: #fff;
            color: #f52f5b;
            border: 1px solid #f52f5b;
        }

        .change-avatar-btn:hover {
            background: #fff0f4;
        }

        .remove-avatar-btn {
            background: #f52f5b;
            color: #fff;
            border: 1px solid #f52f5b;
        }

        .remove-avatar-btn:hover {
            background: #d92049;
        }

        .additional-info {
            margin-top: 30px;
            border: 1px solid #e5eaf0;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 7px 20px rgba(20, 45, 70, 0.05);
            overflow: hidden;
        }

        .additional-info-header {
            width: 100%;
            border: 0;
            background: transparent;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            color: #102d4d;
            text-align: left;
        }

        .additional-info-left {
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .additional-info-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #fff0f4;
            color: #f52f5b;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .additional-info-header h3 {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
        }

        .additional-info-header p {
            margin: 3px 0 0;
            color: #6c7b8e;
            font-size: 13px;
        }

        .additional-info-header>i {
            color: #526b84;
            transition: transform 0.25s ease;
        }

        .additional-info-content {
            display: none;
            padding: 0 30px 25px 87px;
            color: #526174;
            font-size: 14px;
        }

        .additional-info-content p {
            margin-top: 0;
        }

        .additional-info-content li {
            margin-bottom: 6px;
        }

        .additional-info.open .additional-info-content {
            display: block;
        }

        .additional-info.open #avatar-info-arrow {
            transform: rotate(180deg);
        }


        .common-modal .common-modal-dialog {
            max-width: 560px;
            width: calc(100% - 30px);
        }

        .common-modal .common-modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 20px 60px rgba(16, 45, 77, 0.18);
        }



        .common-modal .common-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0f4;
            background: #ffffff;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .common-modal .common-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .common-modal .common-modal-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: #fff0f4;
            color: #f52f5b;

            font-size: 20px;
            flex-shrink: 0;
        }

        .common-modal .common-modal-title {
            margin: 0;
            color: #102d4d;

            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
        }

        .common-modal .common-modal-subtitle {
            margin: 3px 0 0;

            color: #718096;
            font-size: 13px;
            line-height: 1.4;
        }



        .common-modal .common-modal-close {
            width: 38px;
            height: 38px;

            padding: 0;
            border: 1px solid #edf0f4;
            border-radius: 50%;

            background: #f8fafc;
            color: #66768b;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;
            transition: all 0.25s ease;
        }

        .common-modal .common-modal-close:hover {
            background: #fff0f4;
            border-color: #ffd0dc;
            color: #f52f5b;
        }



        .common-modal .common-modal-body {
            padding: 24px;
            background: #ffffff;
        }

        .common-modal .common-modal-crop-wrapper {
            width: 100%;
            min-height: 300px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 18px;

            border: 2px dashed #ffb9c9;
            border-radius: 14px;

            background: #fffafd;
            box-sizing: border-box;
        }

        .common-modal .common-modal-crop-area {
            width: 100%;
        }



        .common-modal .common-modal-crop-area .cr-boundary {
            max-width: 100%;
            margin: auto;

            border-radius: 10px;
        }

        .common-modal .common-modal-crop-area .cr-viewport {
            border-color: #f52f5b;
        }



        .common-modal .common-modal-hint {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-top: 16px;
            padding: 11px 14px;

            border-radius: 9px;
            background: #fff5f7;

            color: #66768b;
            font-size: 13px;
            line-height: 1.45;
        }

        .common-modal .common-modal-hint i {
            color: #f52f5b;
            font-size: 15px;
            flex-shrink: 0;
        }


        .common-modal .common-modal-footer {
            padding: 16px 24px 22px;

            border-top: 0;
            background: #ffffff;

            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }


        .common-modal .common-modal-btn {
            min-height: 44px;

            padding: 0 20px;

            border-radius: 8px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            font-family: inherit;
            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
            transition: all 0.25s ease;
        }


        /* Secondary */

        .common-modal .common-modal-btn-secondary {
            border: 1px solid #e1e7ee;
            background: #ffffff;
            color: #526174;
        }

        .common-modal .common-modal-btn-secondary:hover {
            background: #f7f9fb;
            border-color: #ccd5df;
        }


        /* Primary */

        .common-modal .common-modal-btn-primary {
            border: 1px solid #f52f5b;
            background: #f52f5b;
            color: #ffffff;
        }

        .common-modal .common-modal-btn-primary:hover {
            background: #dc204a;
            border-color: #dc204a;
            box-shadow: 0 5px 14px rgba(245, 47, 91, 0.22);
        }

        /* =========================================================
   Common Modal - Success Content
   ========================================================= */

.common-modal .common-modal-success-content {
    text-align: center;
    padding: 8px 10px 4px;
}

.common-modal .common-modal-success-icon {
    width: 54px;
    height: 54px;

    margin: 0 auto 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #fff0f4;
    color: #ff3c5f;

    font-size: 22px;
}

.common-modal .common-modal-success-content h4 {
    margin: 0;

    color: #102d4d;

    font-size: 18px;
    font-weight: 600;
    line-height: 1.5;
}


/* Center footer for simple confirmation modals */

.common-modal .common-modal-footer-center {
    justify-content: center;
    padding-top: 4px;
    padding-bottom: 24px;
}
/* =========================================================
   Common Modal - Confirmation
   ========================================================= */

.common-modal .common-modal-confirm-content {
    text-align: center;
    padding: 8px 10px 4px;
}

.common-modal .common-modal-confirm-icon {
    width: 56px;
    height: 56px;

    margin: 0 auto 16px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #fff0f4;
    color: #ff3c5f;

    font-size: 21px;
}

.common-modal .common-modal-confirm-content h4 {
    margin: 0;

    color: #102d4d;

    font-size: 17px;
    font-weight: 600;
    line-height: 1.5;
}

.common-modal .common-modal-confirm-content p {
    margin: 7px 0 0;

    color: #7b8798;

    font-size: 13px;
    line-height: 1.5;
}


        @media (max-width: 600px) {

            .common-modal .common-modal-dialog {
                width: calc(100% - 20px);
                margin: 10px auto;
            }

            .common-modal .common-modal-header {
                padding: 16px;
            }

            .common-modal .common-modal-body {
                padding: 16px;
            }

            .common-modal .common-modal-footer {
                padding: 14px 16px 18px;

                flex-direction: column-reverse;
            }

            .common-modal .common-modal-btn {
                width: 100%;
            }

            .common-modal .common-modal-crop-wrapper {
                min-height: 250px;
                padding: 10px;
            }

            .common-modal .common-modal-title {
                font-size: 18px;
            }

            .common-modal .common-modal-icon {
                width: 42px;
                height: 42px;
                font-size: 17px;
            }
        }

        @media (max-width: 992px) {
            .file-rules {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .avatar-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .avatar-section {
                padding: 25px 15px 40px;
            }

            .avatar-header {
                align-items: flex-start;
                gap: 15px;
            }

            .avatar-header-icon {
                width: 55px;
                height: 55px;
                font-size: 24px;
            }

            .avatar-title-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            .avatar-title-row h1 {
                font-size: 28px;
            }

            .file-types-box {
                padding: 20px;
            }

            .file-types-icon {
                width: 45px;
                height: 45px;
            }

            .avatar-card {
                padding: 18px;
                min-height: auto;
            }

            .upload-area {
                min-height: 240px;
            }

            .current-avatar-image img {
                width: 210px;
                height: 210px;
            }

            .avatar-actions {
                flex-direction: column;
                gap: 10px;
            }

            .change-avatar-btn,
            .remove-avatar-btn {
                width: 100%;
            }

            .additional-info-content {
                padding-left: 25px;
            }
        }

        .avatar-upload-submit {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 18px;
        }

        .avatar-upload-submit .change-avatar-btn,
        .avatar-upload-submit .remove-avatar-btn {
            min-width: 145px;
        }

        .file-upload-content img {
            display: block;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin: 15px auto 0;
            border: 4px solid #ffe0e8;
        }

        .help-btn {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .current-avatar-card .delete_avatar {
            border: 0;
        }

        @media (max-width: 600px) {
            .avatar-upload-submit {
                flex-direction: column;
            }

            .avatar-upload-submit button {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <section class="avatar-section">

        <!-- Header -->
        <div class="avatar-header">

            <div class="avatar-header-content">
                <div class="avatar-title-row">
                    <h1>Upload Your Avatar</h1>
                    <span class="help-btn" data-toggle="collapse" data-target="#notes" role="button"><i
                            class="fa-regular fa-circle-question"></i> Help?</span>
                </div>

                <p>Add a profile picture that represents you.</p>
                <div class="card collapse mt-3" id="notes">
                    <div class="card-body">
                        <ol class="mb-0">
                            <li>You don't have to have an avatar, it is entirely up to you.</li>
                            <li>Your avatar will not be displayed publicly.</li>
                            <li>You can remove or change your avatar anytime.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <!-- File Types -->
        <div class="file-types-box">

            <div class="file-types-icon">
                <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M9 17H15M9 13H15M9 9H10M13 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.0799 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V9M13 3L19 9M13 3V7.4C13 7.96005 13 8.24008 13.109 8.45399C13.2049 8.64215 13.3578 8.79513 13.546 8.89101C13.7599 9 14.0399 9 14.6 9H19"
                            stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>

            <div class="file-types-content">
                <h2>File types</h2>

                <p>
                    When selecting your avatar, please be mindful of the following:
                </p>

                <div class="file-rules">

                    <div class="file-rule">
                        <svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#ff3c5f" fill-rule="evenodd"
                                    d="M8,16 C12.4183,16 16,12.4183 16,8 C16,3.58172 12.4183,0 8,0 C3.58172,0 0,3.58172 0,8 C0,12.4183 3.58172,16 8,16 Z M11.7071,6.70711 C12.0976,6.31658 12.0976,5.68342 11.7071,5.29289 C11.3166,4.90237 10.6834,4.90237 10.2929,5.29289 L7,8.58579 L5.70711,7.29289 C5.31658,6.90237 4.68342,6.90237 4.29289,7.29289 C3.90237,7.68342 3.90237,8.31658 4.29289,8.70711 L6.29289,10.7071 C6.68342,11.0976 7.31658,11.0976 7.70711,10.7071 L11.7071,6.70711 Z">
                                </path>
                            </g>
                        </svg>
                        <span>
                            Yes, you can use a photo, but we do not recommend it.
                        </span>
                    </div>

                    <div class="file-rule">
                        <svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#ff3c5f" fill-rule="evenodd"
                                    d="M8,16 C12.4183,16 16,12.4183 16,8 C16,3.58172 12.4183,0 8,0 C3.58172,0 0,3.58172 0,8 C0,12.4183 3.58172,16 8,16 Z M11.7071,6.70711 C12.0976,6.31658 12.0976,5.68342 11.7071,5.29289 C11.3166,4.90237 10.6834,4.90237 10.2929,5.29289 L7,8.58579 L5.70711,7.29289 C5.31658,6.90237 4.68342,6.90237 4.29289,7.29289 C3.90237,7.68342 3.90237,8.31658 4.29289,8.70711 L6.29289,10.7071 C6.68342,11.0976 7.31658,11.0976 7.70711,10.7071 L11.7071,6.70711 Z">
                                </path>
                            </g>
                        </svg>
                        <span>
                            Acceptable formats include: .jpg, .gif or .png.
                        </span>
                    </div>

                    <div class="file-rule">
                        <svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#ff3c5f" fill-rule="evenodd"
                                    d="M8,16 C12.4183,16 16,12.4183 16,8 C16,3.58172 12.4183,0 8,0 C3.58172,0 0,3.58172 0,8 C0,12.4183 3.58172,16 8,16 Z M11.7071,6.70711 C12.0976,6.31658 12.0976,5.68342 11.7071,5.29289 C11.3166,4.90237 10.6834,4.90237 10.2929,5.29289 L7,8.58579 L5.70711,7.29289 C5.31658,6.90237 4.68342,6.90237 4.29289,7.29289 C3.90237,7.68342 3.90237,8.31658 4.29289,8.70711 L6.29289,10.7071 C6.68342,11.0976 7.31658,11.0976 7.70711,10.7071 L11.7071,6.70711 Z">
                                </path>
                            </g>
                        </svg>
                        <span>
                            .pdf, .psd, .tif, and .doc files are not compatible.
                        </span>
                    </div>

                </div>
            </div>

        </div>


        <!-- Upload / Current Avatar -->
        <div class="avatar-grid">

            <!-- Upload Card -->
            <div class="avatar-card">

                <form id="my_avatar" action="{{ route('escort.save.avatar', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="card-heading">
                        <div class="card-icon">
                            <svg width="40px" height="40px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill="#ff3c5f" fill-rule="evenodd"
                                        d="M14,9.41421 C14.5523,9.41421 15,9.86192 15,10.41418 L15,13.41418 C15,14.51878 14.1046,15.41418 13,15.41418 L3,15.41418 C1.89543,15.41418 1,14.51878 1,13.41418 L1,10.41418 C1,9.86192 1.44772,9.41421 2,9.41421 C2.55228,9.41421 3,9.86192 3,10.41418 L3,13.41418 L13,13.41418 L13,10.41418 C13,9.86192 13.4477,9.41421 14,9.41421 Z M8,2 L11.7071,5.7071 C12.0976,6.09763 12.0976,6.73079 11.7071,7.12132 C11.3166,7.51184 10.6834,7.51184 10.2929,7.12132 L9,5.82842 L9,10.41418 C9,10.96648 8.55228,11.41418 8,11.41418 C7.44772,11.41418 7,10.96648 7,10.41418 L7,5.82842 L5.70711,7.12132 C5.31658,7.51184 4.68342,7.51184 4.29289,7.12132 C3.90237,6.73079 3.90237,6.09763 4.29289,5.7071 L8,2 Z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <div>
                            <h3>Upload your avatar</h3>
                            <p>Drag & drop a file here or click to browse</p>
                        </div>
                    </div>


                    <!-- Upload Area -->
                    <label for="avatar-upload" class="upload-area">

                        <div class="upload-icon">
                            <svg width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                fill="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 10v9m0-9l3 3m-3-3l-3 3m8.5 2c1.519 0 2.5-1.231 2.5-2.75 0-1.264-.854-2.33-2.016-2.65A5 5 0 008.37 8.108a3.5 3.5 0 00-1.87 6.746">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <strong>Drag & drop your file here</strong>

                        <span>or</span>

                        <div class="choose-file-btn">
                            Choose File
                        </div>

                        <input type="file" id="avatar-upload" class="file-upload-input gambar item-img"
                            name="avatar_img" accept=".jpg,.jpeg,.gif,.png" onchange="readURL(this);" hidden>

                    </label>


                    <!-- Upload Info -->
                    <div class="upload-info">

                        <div class="upload-info-icon">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M9 12L11 14L15 9.99999M20 12C20 16.4611 14.54 19.6937 12.6414 20.683C12.4361 20.79 12.3334 20.8435 12.191 20.8712C12.08 20.8928 11.92 20.8928 11.809 20.8712C11.6666 20.8435 11.5639 20.79 11.3586 20.683C9.45996 19.6937 4 16.4611 4 12V8.21759C4 7.41808 4 7.01833 4.13076 6.6747C4.24627 6.37113 4.43398 6.10027 4.67766 5.88552C4.9535 5.64243 5.3278 5.50207 6.0764 5.22134L11.4382 3.21067C11.6461 3.13271 11.75 3.09373 11.857 3.07827C11.9518 3.06457 12.0482 3.06457 12.143 3.07827C12.25 3.09373 12.3539 3.13271 12.5618 3.21067L17.9236 5.22134C18.6722 5.50207 19.0465 5.64243 19.3223 5.88552C19.566 6.10027 19.7537 6.37113 19.8692 6.6747C20 7.01833 20 7.41808 20 8.21759V12Z"
                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </div>

                        <div>
                            <p>We only support JPG, GIF and PNG files.</p>
                            <p>Max file size: 10MB</p>
                        </div>

                    </div>

                    <div class="file-upload-content" style="display:none;">
                        <img class="file-upload-image item-img" src="#" alt="Uploaded avatar"
                            id="item-img-output">
                    </div>

                    <div class="avatar-upload-submit">
                        <button type="button" onclick="removeUpload()" class="change-avatar-btn">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.23706 2.0007C6.78897 2.02117 7.21978 2.48517 7.19931 3.03708L7.10148 5.67483C8.45455 4.62548 10.154 4.00001 12 4.00001C16.4183 4.00001 20 7.58174 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 11.4477 4.44772 11 5 11C5.55228 11 6 11.4477 6 12C6 15.3137 8.68629 18 12 18C15.3137 18 18 15.3137 18 12C18 8.68631 15.3137 6.00001 12 6.00001C10.4206 6.00001 8.98317 6.60994 7.91098 7.60891L11.3161 8.00677C11.8646 8.07087 12.2573 8.56751 12.1932 9.11607C12.1291 9.66462 11.6325 10.0574 11.0839 9.99326L5.88395 9.38567C5.36588 9.32514 4.98136 8.87659 5.00069 8.35536L5.20069 2.96295C5.22116 2.41104 5.68516 1.98023 6.23706 2.0007Z"
                                        fill="#ff3c5f"></path>
                                </g>
                            </svg>
                            Reset
                        </button>
                        <button type="submit" class="remove-avatar-btn crop_image">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                fill="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 10v9m0-9l3 3m-3-3l-3 3m8.5 2c1.519 0 2.5-1.231 2.5-2.75 0-1.264-.854-2.33-2.016-2.65A5 5 0 008.37 8.108a3.5 3.5 0 00-1.87 6.746">
                                    </path>
                                </g>
                            </svg>
                            Save Avatar
                        </button>
                    </div>
                </form>
            </div>


            <!-- Current Avatar Card -->
            <div class="avatar-card current-avatar-card">

                <div class="card-heading">

                    <div class="card-icon">
                        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                    stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#ff3c5f"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>

                    <div>
                        <h3>Current Avatar</h3>
                        <p>This is your currently uploaded avatar.</p>
                    </div>

                </div>


                <!-- Current Image -->
                <div class="current-avatar-image">
                    <img src="{{ asset(auth()->user()->avatar_url) }}" alt="Current Avatar"
                        class="img-rounded avatarName">
                </div>


                <!-- Actions -->
                <div class="avatar-actions">

                    <button type="button" class="change-avatar-btn" onclick="$('#avatar-upload').trigger('click');">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M15.4998 5.49994L18.3282 8.32837M3 20.9997L3.04745 20.6675C3.21536 19.4922 3.29932 18.9045 3.49029 18.3558C3.65975 17.8689 3.89124 17.4059 4.17906 16.9783C4.50341 16.4963 4.92319 16.0765 5.76274 15.237L17.4107 3.58896C18.1918 2.80791 19.4581 2.80791 20.2392 3.58896C21.0202 4.37001 21.0202 5.63634 20.2392 6.41739L8.37744 18.2791C7.61579 19.0408 7.23497 19.4216 6.8012 19.7244C6.41618 19.9932 6.00093 20.2159 5.56398 20.3879C5.07171 20.5817 4.54375 20.6882 3.48793 20.9012L3 20.9997Z"
                                    stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                        Change Avatar
                    </button>

                    @if (auth()->user()->hasUploadedAvatar())
                        <button type="button" class="remove-avatar-btn delete_avatar">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            Remove
                        </button>
                    @endif

                </div>

            </div>

        </div>


        <!-- Additional Information -->
        <div class="additional-info">

            <button type="button" class="additional-info-header" onclick="toggleAvatarInfo()">

                <div class="additional-info-left">

                    <div class="additional-info-icon">
                        <svg width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            fill="none">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="#ff3c5f" fill-rule="evenodd"
                                    d="M10 3a7 7 0 100 14 7 7 0 000-14zm-9 7a9 9 0 1118 0 9 9 0 01-18 0zm8-4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm.01 8a1 1 0 102 0V9a1 1 0 10-2 0v5z">
                                </path>
                            </g>
                        </svg>
                    </div>

                    <div>
                        <h3>Additional Upload Information</h3>
                        <p>Click to view more details and guidelines</p>
                    </div>

                </div>
                <svg fill="#000000" width="14px" height="14px" viewBox="0 0 32 32" id="avatar-info-arrow"
                    version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M0.256 8.606c0-0.269 0.106-0.544 0.313-0.75 0.412-0.412 1.087-0.412 1.5 0l14.119 14.119 13.913-13.912c0.413-0.412 1.087-0.412 1.5 0s0.413 1.088 0 1.5l-14.663 14.669c-0.413 0.413-1.088 0.413-1.5 0l-14.869-14.869c-0.213-0.213-0.313-0.481-0.313-0.756z">
                        </path>
                    </g>
                </svg>


            </button>


            <div id="avatar-info-content" class="additional-info-content">
                <p><b>File name</b></p>
                <p>Only use letters, numbers, underscores, and hyphens in file names.</p>
                <p><b>File size</b></p>
                <p>We recommend using image files of less than 500 KB for best results, though the limit for
                    an individual image upload is 2 MB.</p>
                <p><b>Resolution</b></p>
                <p>There is an image resolution limit of 60 MP (megapixels).</p>
                <p><b>Colour mode</b></p>
                <p>Save images in RGB color mode. Print mode (CMYK) won't render in most browsers.</p>
                <p><b>Colour profile</b></p>
                <p>Save images in the sRGB color profile. If images don't look right on mobile devices, it's
                    probably because they don't have an sRGB color profile.</p>
            </div>
        </div>
    </section>

    {{-- <!-- Crop modal: original functionality retained -->
    <div class="modal fade upload-modal" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/crop-image.png') }}" class="custompopicon">
                        Crop Photo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="upload-demo" class="center-block"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                    <button type="button" id="cropImageBtn" class="btn main_bg_color site_btn_primary">Crop</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Common Crop Image Modal -->

    <div class="modal fade common-modal" id="cropImagePop" tabindex="-1" role="dialog"
        aria-labelledby="cropImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered common-modal-dialog">
            <div class="modal-content common-modal-content"> <!-- Header -->
                <div class="modal-header common-modal-header">
                    <div class="common-modal-title-wrap">
                        <div class="common-modal-icon">
                            <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                                width="20px" height="20px" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                        }

                                        .st1 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                        }

                                        .st2 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-dasharray: 6, 6;
                                        }

                                        .st3 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-dasharray: 4, 4;
                                        }

                                        .st4 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                        }

                                        .st5 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-dasharray: 3.1081, 3.1081;
                                        }

                                        .st6 {
                                            fill: none;
                                            stroke: #ff3c5f;
                                            stroke-width: 2;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                            stroke-dasharray: 4, 3;
                                        }
                                    </style>
                                    <circle class="st0" cx="13" cy="13" r="1"></circle>
                                    <polyline class="st0" points="7,21 16,16 20,19 25,16 "></polyline>
                                    <polyline class="st0" points="30,25 7,25 7,2 "></polyline>
                                    <polyline class="st0" points="7,7 25,7 25,25 "></polyline>
                                    <line class="st0" x1="7" y1="7" x2="2" y2="7">
                                    </line>
                                    <line class="st0" x1="25" y1="30" x2="25" y2="25">
                                    </line>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <h5 class="common-modal-title" id="cropImageModalLabel"> Crop Photo </h5>
                            <p class="common-modal-subtitle"> Adjust your image before uploading </p>
                        </div>
                    </div> <button type="button" class="common-modal-close" data-dismiss="modal" aria-label="Close">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#ff3c5f" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg> </button>
                </div> <!-- Body -->
                <div class="modal-body common-modal-body">
                    <div class="common-modal-crop-wrapper">
                        <div id="upload-demo" class="common-modal-crop-area center-block"></div>
                    </div>
                    <div class="common-modal-hint"> <i class="fa-regular fa-circle-info"></i> <span> Drag, zoom or
                            reposition the image to get the perfect crop. </span> </div>
                </div> <!-- Footer -->
                <div class="modal-footer common-modal-footer"> <button type="button"
                        class="common-modal-btn common-modal-btn-secondary" data-dismiss="modal">Cancel </button> <button type="button" id="cropImageBtn"
                        class="common-modal-btn common-modal-btn-primary"> <svg width="16px" height="16px"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5 1.25C5.41421 1.25 5.75 1.58579 5.75 2V11C5.75 12.9068 5.75159 14.2615 5.88976 15.2892C6.02502 16.2952 6.27869 16.8749 6.7019 17.2981C7.12511 17.7213 7.70476 17.975 8.71085 18.1102C9.73851 18.2484 11.0932 18.25 13 18.25H22C22.4142 18.25 22.75 18.5858 22.75 19C22.75 19.4142 22.4142 19.75 22 19.75H19.75V22C19.75 22.4142 19.4142 22.75 19 22.75C18.5858 22.75 18.25 22.4142 18.25 22V19.75H12.9436C11.1058 19.75 9.65019 19.75 8.51098 19.5969C7.33855 19.4392 6.38961 19.1071 5.64124 18.3588C4.89288 17.6104 4.56076 16.6614 4.40313 15.489C4.24997 14.3498 4.24998 12.8942 4.25 11.0564L4.25 5.75H2C1.58579 5.75 1.25 5.41421 1.25 5C1.25 4.58579 1.58579 4.25 2 4.25H4.25V2C4.25 1.58579 4.58579 1.25 5 1.25ZM15.2892 5.88976C14.2615 5.75159 12.9068 5.75 11 5.75H8C7.58579 5.75 7.25 5.41421 7.25 5C7.25 4.58579 7.58579 4.25 8 4.25L11.0564 4.25C12.8942 4.24998 14.3498 4.24997 15.489 4.40313C16.6614 4.56076 17.6104 4.89288 18.3588 5.64124C19.1071 6.38961 19.4392 7.33855 19.5969 8.51098C19.75 9.65019 19.75 11.1058 19.75 12.9436V16C19.75 16.4142 19.4142 16.75 19 16.75C18.5858 16.75 18.25 16.4142 18.25 16V13C18.25 11.0932 18.2484 9.73851 18.1102 8.71085C17.975 7.70476 17.7213 7.12511 17.2981 6.7019C16.8749 6.27869 16.2952 6.02502 15.2892 5.88976Z"
                                    fill="#ffffff"></path>
                            </g>
                        </svg> Crop &
                        Continue </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Avatar Upload Success Modal -->
    <div class="modal fade common-modal" id="avatarSuccessModal" tabindex="-1" role="dialog"
        aria-labelledby="avatarSuccessModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered common-modal-dialog">
            <div class="modal-content common-modal-content">

                <!-- Header -->
                <div class="modal-header common-modal-header">

                    <div class="common-modal-title-wrap">

                        <div class="common-modal-icon">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2639 15.9375L12.5958 14.2834C11.7909 13.4851 11.3884 13.086 10.9266 12.9401C10.5204 12.8118 10.0838 12.8165 9.68048 12.9536C9.22188 13.1095 8.82814 13.5172 8.04068 14.3326L4.04409 18.2801M14.2639 15.9375L14.6053 15.599C15.4112 14.7998 15.8141 14.4002 16.2765 14.2543C16.6831 14.126 17.12 14.1311 17.5236 14.2687C17.9824 14.4251 18.3761 14.8339 19.1634 15.6514L20 16.4934M14.2639 15.9375L18.275 19.9565M18.275 19.9565C17.9176 20 17.4543 20 16.8 20H7.2C6.07989 20 5.51984 20 5.09202 19.782C4.71569 19.5903 4.40973 19.2843 4.21799 18.908C4.12796 18.7313 4.07512 18.5321 4.04409 18.2801M18.275 19.9565C18.5293 19.9256 18.7301 19.8727 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V16.4934M4.04409 18.2801C4 17.9221 4 17.4575 4 16.8V7.2C4 6.0799 4 5.51984 4.21799 5.09202C4.40973 4.71569 4.71569 4.40973 5.09202 4.21799C5.51984 4 6.07989 4 7.2 4H16.8C17.9201 4 18.4802 4 18.908 4.21799C19.2843 4.40973 19.5903 4.71569 19.782 5.09202C20 5.51984 20 6.0799 20 7.2V16.4934M17 8.99989C17 10.1045 16.1046 10.9999 15 10.9999C13.8954 10.9999 13 10.1045 13 8.99989C13 7.89532 13.8954 6.99989 15 6.99989C16.1046 6.99989 17 7.89532 17 8.99989Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </div>

                        <div>
                            <h5 class="common-modal-title" id="avatarSuccessModalLabel">
                                Upload Successful
                            </h5>
                        </div>

                    </div>

                    <button type="button" class="common-modal-close" data-dismiss="modal" aria-label="Close">

                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#ff3c5f" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />

                        </svg>

                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body common-modal-body">

                    <div class="common-modal-success-content">

                        <h4>
                            Avatar uploaded successfully!
                        </h4>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer common-modal-footer common-modal-footer-center">

                    <button type="button" class="common-modal-btn common-modal-btn-primary" data-dismiss="modal">

                        Ok

                    </button>

                </div>

            </div>
        </div>
    </div>

    <!-- Existing confirmation modal -->
    <!-- Common Confirmation Modal -->
<div class="modal fade common-modal"
    id="conformation_modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="confirmationModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered common-modal-dialog">
        <div class="modal-content common-modal-content">

            <!-- Header -->
            <div class="modal-header common-modal-header">

                <div class="common-modal-title-wrap">

                    <div class="common-modal-icon">
                       <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2639 15.9375L12.5958 14.2834C11.7909 13.4851 11.3884 13.086 10.9266 12.9401C10.5204 12.8118 10.0838 12.8165 9.68048 12.9536C9.22188 13.1095 8.82814 13.5172 8.04068 14.3326L4.04409 18.2801M14.2639 15.9375L14.6053 15.599C15.4112 14.7998 15.8141 14.4002 16.2765 14.2543C16.6831 14.126 17.12 14.1311 17.5236 14.2687C17.9824 14.4251 18.3761 14.8339 19.1634 15.6514L20 16.4934M14.2639 15.9375L18.275 19.9565M18.275 19.9565C17.9176 20 17.4543 20 16.8 20H7.2C6.07989 20 5.51984 20 5.09202 19.782C4.71569 19.5903 4.40973 19.2843 4.21799 18.908C4.12796 18.7313 4.07512 18.5321 4.04409 18.2801M18.275 19.9565C18.5293 19.9256 18.7301 19.8727 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V16.4934M4.04409 18.2801C4 17.9221 4 17.4575 4 16.8V7.2C4 6.0799 4 5.51984 4.21799 5.09202C4.40973 4.71569 4.71569 4.40973 5.09202 4.21799C5.51984 4 6.07989 4 7.2 4H16.8C17.9201 4 18.4802 4 18.908 4.21799C19.2843 4.40973 19.5903 4.71569 19.782 5.09202C20 5.51984 20 6.0799 20 7.2V16.4934M17 8.99989C17 10.1045 16.1046 10.9999 15 10.9999C13.8954 10.9999 13 10.1045 13 8.99989C13 7.89532 13.8954 6.99989 15 6.99989C16.1046 6.99989 17 7.89532 17 8.99989Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>

                    <div>
                        <h5 class="common-modal-title"
                            id="confirmationModalLabel">

                            <span id="modal-title">
                                Remove Avatar
                            </span>

                        </h5>
                    </div>

                </div>

                <button type="button"
                    class="common-modal-close"
                    data-dismiss="modal"
                    aria-label="Close">

                    <svg width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <path d="M19 5L4.99998 19M5.00001 5L19 19"
                            stroke="#ff3c5f"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round" />

                    </svg>

                </button>

            </div>

            <!-- Body -->
            <div class="modal-body common-modal-body">

                <div class="common-modal-confirm-content">
                    <h4 id="comman_str">
                        Are you sure you want to delete your avatar?
                    </h4>

                    <p>
                        This action cannot be undone.
                    </p>

                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer common-modal-footer common-modal-footer-center">

                <button type="button"
                    class="common-modal-btn common-modal-btn-secondary"
                    id="cancelDelete"
                    data-dismiss="modal">

                    Cancel

                </button>

                <button type="button"
                    class="common-modal-btn common-modal-btn-primary"
                    id="confirmDelete"
                    data-dismiss="modal">

                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                    Yes, Remove

                </button>

            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->


    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>

    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript">
        $('#userProfile').parsley({

        });



        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            if (form.parsley().isValid()) {

                var url = form.attr('action');
                var data = new FormData(form[0]);
                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (!data.error) {
                            $.toast({
                                heading: 'Success',
                                text: 'Details successfully saved',
                                icon: 'success',
                                loader: true,
                                position: 'top-right', // Change it to false to disable loader
                                loaderBg: '#9EC600' // To change the background
                            });

                        } else {
                            $.toast({
                                heading: 'Error',
                                text: 'Records Not update',
                                icon: 'error',
                                loader: true,
                                position: 'top-right', // Change it to false to disable loader
                                loaderBg: '#9EC600' // To change the background
                            });

                        }
                    },

                });
            }
        });
        $('#city').select2({
            allowClear: true,
            placeholder: 'Select City',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('city.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        state_id: $('#state').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#state').select2({
            allowClear: true,
            placeholder: 'Select State',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('state.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        country_id: $('#country').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });


        $('#country').on('change', function(e) {
            if ($(this).val()) {
                $('#state').prop('disabled', false);
                $('#state').select2('open');
            } else {
                $('#state').prop('disabled', true);
            }
        });

        $('#state').on('change', function(e) {
            if ($(this).val()) {
                $('#city').prop('disabled', false);
                $('#city').select2('open');
            } else {
                $('#city').prop('disabled', true);
            }
        });
    </script>
    <script>
        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }

        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
        $(".gambar").attr("src");
        var $uploadCrop,
            tempFilename,
            rawImg,
            imageId;

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'circle',
            },
            enforceBoundary: false,
            enableExif: true
        });

        $('#cropImagePop').on('shown.bs.modal', function() {
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function() {
                console.log('1jQuery bind complete');
            });
        });

        $('#cropImageBtn').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 150,
                    height: 200
                }
            }).then(function(resp) {
                $('.file-upload-content').show();
                $('#item-img-output').attr('src', resp);
                $('#cropImagePop').modal('hide');
            });
        });

        function getBase64SizeBytes(base64) {
            try {
                if (!base64 || base64.indexOf(',') === -1) return 0;
                var b64 = base64.split(',')[1];
                var padding = (b64.match(/=+$/) || [''])[0].length;
                return Math.floor((b64.length * 3) / 4) - padding;
            } catch (e) {
                return 0;
            }
        }



        $("#my_avatar").on('submit', function(e) {

            e.preventDefault();
            var form = $(this);
            $("#modal-title").text("Upload Your Avatar");
            $("#modal-icon").attr("src", "/assets/dashboard/img/upload-photos.png");
            var src = $("#item-img-output").attr('src');
            // Client-side 2MB check before sending AJAX
            var maxBytes = 10 * 1024 * 1024;
            var inputEl = $('.file-upload-input')[0];
            var oversize = false;
            if (inputEl && inputEl.files && inputEl.files[0]) {
                oversize = inputEl.files[0].size > maxBytes;
            } else if (src && src.indexOf('data:image/') === 0) {
                oversize = getBase64SizeBytes(src) > maxBytes;
            }
            if (oversize) {
                $('.comman_msg').text('Image must be 10MB or less.');
                $("#avatarSuccessModal").modal('show');
                try {
                    removeUpload();
                } catch (e) {}
                return false;
            }
            swal_waiting_popup({
                'title': 'Your avatar is being uploaded...'
            });
            var url = form.attr('action');
            var data = new FormData($('#my_avatar')[0]);
            data.append('src', src);
            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.close();
                    if (data.type == 0) {
                        var msg = "Avatar uploaded successfully!";
                        var url = "{{ asset('avatars/name') }}";
                        url = url.replace('name', data.avatarName);
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        $("#avatarSuccessModal").modal('show');
                        $(".avatarName").attr('src', url);
                        $(".file-upload-content").hide();

                        // Show the delete button since avatar is now uploaded
                        if ($(".delete_avatar").length === 0) {
                            $(".current-avatar h2").after(
                                `<button type="button" class="avatar close delete_avatar" aria-label="Close"><span aria-hidden="true">×</span></button>`
                            );
                        } else {
                            $(".delete_avatar").show();
                        }
                    } else {
                        errorModuleShow(data);
                    }
                },
                error: function(data) {
                    Swal.close();
                    errorModuleShow(data);
                }
            });
        });


        function errorModuleShow(data = null) {
            var msg = "Something went wrong. Please try again.";
            try {
                var resp = data && data.responseJSON ? data.responseJSON : data;
                if (resp) {
                    if (resp.message) {
                        msg = resp.message;
                    } else if (resp.errors) {
                        // Prefer src (base64 image) or avatar_img errors
                        var err = resp.errors.src || resp.errors.avatar_img || resp.errors.file || null;
                        if (Array.isArray(err) && err.length) {
                            msg = err[0];
                        } else if (typeof err === 'string') {
                            msg = err;
                        }
                    }
                }
            } catch (e) {}

            $('.comman_msg').text(msg);
            $("#avatarSuccessModal").modal('show');
            $(".delete_avatar").hide();
        }


        $('#confirmDelete').on('click', function(e) {
            e.preventDefault();

            try {
                // Show loading state on delete button
                var deleteBtn = $(".delete_avatar");
                var originalText = deleteBtn.html();
                deleteBtn.html('<i class="fas fa-spinner fa-spin"></i>');
                deleteBtn.prop('disabled', true);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('escort.avatar.remove') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        try {
                            if (data.type == 0) {

                                // Update avatar image to default
                                $(".avatarName").attr('src', data.img);

                                // Hide delete button
                                $(".delete_avatar").hide();
                            } else {
                                // Error - show error message
                                showErrorMessage(data.message ||
                                    "Something went wrong. Please try again.");
                            }
                        } catch (error) {
                            showErrorMessage("Error processing server response. Please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMsg = "Error occurred while removing avatar.";
                        showErrorMessage(errorMsg);
                    },
                    complete: function() {
                        try {
                            // Reset button state
                            deleteBtn.html(originalText);
                            deleteBtn.prop('disabled', false);
                        } catch (error) {
                            console.error('Error resetting button state:', error);
                        }
                    }
                });
            } catch (error) {
                console.error('Error in confirmDelete click handler:', error);
                showErrorMessage("An unexpected error occurred. Please try again.");

                // Reset button state
                var deleteBtn = $(".delete_avatar");
                deleteBtn.html('×');
                deleteBtn.prop('disabled', false);
            }
        });

        $('#cancelDelete').on('click', function() {
            // Just close the modal - no action needed
            $("#conformation_modal").modal('hide');
        });

        // Function to show error message
        function errorModuleShow(data = null) {
            var msg = "";
            try {
                var resp = null;
                if (data && data.responseJSON) {
                    resp = data.responseJSON;
                } else if (data && data.responseText) {
                    try {
                        resp = JSON.parse(data.responseText);
                    } catch (e) {}
                } else {
                    resp = data;
                }

                if (resp) {
                    if (typeof resp === 'string') {
                        msg = resp;
                    } else if (resp.message) {
                        msg = resp.message;
                    } else if (resp.errors) {
                        var errors = resp.errors;
                        var first = null;
                        if (Array.isArray(errors)) {
                            first = errors[0];
                        } else if (errors.src) {
                            first = Array.isArray(errors.src) ? errors.src[0] : errors.src;
                        } else if (errors.avatar_img) {
                            first = Array.isArray(errors.avatar_img) ? errors.avatar_img[0] : errors.avatar_img;
                        } else if (errors.file) {
                            first = Array.isArray(errors.file) ? errors.file[0] : errors.file;
                        }
                        if (first) msg = first;
                    }
                }
            } catch (e) {}

            $('.comman_msg').text(msg);
            $("#avatarSuccessModal").modal('show');
            $(".delete_avatar").hide();
        }


        // Bind delete avatar event to show confirmation modal
        $(document).on('click', '.delete_avatar', function() {
            $("#conformation_modal").modal('show');
        });

        function toggleAvatarInfo() {
            const box = document.querySelector('.additional-info');
            if (box) {
                box.classList.toggle('open');
            }
        }
    </script>
@endpush

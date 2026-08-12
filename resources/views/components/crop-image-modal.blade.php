@props([
    'title' => 'Crop Photo',
    'subtitle' => 'Adjust your image before uploading',
    'buttonText' => 'Crop & Continue',
])

<div class="modal fade common-modal"
     id="cropImagePop"
     tabindex="-1"
     role="dialog"
     aria-labelledby="cropImageModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered common-modal-dialog">
        <div class="modal-content common-modal-content">

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
                        <h5 class="common-modal-title" id="cropImageModalLabel">
                            {{ $title }}
                        </h5>

                        <p class="common-modal-subtitle">
                            {{ $subtitle }}
                        </p>
                    </div>

                </div>

                <button type="button"
                        class="common-modal-close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#ff3c5f" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>

                </button>

            </div>

            <div class="modal-body common-modal-body">

                <div class="common-modal-crop-wrapper">
                    <div id="upload-demo"
                         class="common-modal-crop-area center-block">
                    </div>
                </div>

                <div class="common-modal-hint">
                    <i class="fa-regular fa-circle-info"></i>

                    <span>
                        Drag, zoom or reposition the image to get the perfect crop.
                    </span>
                </div>

            </div>

            <div class="modal-footer common-modal-footer">

                <button type="button"
                        class="common-modal-btn common-modal-btn-secondary"
                        data-dismiss="modal">
                    Cancel
                </button>

                <button type="button"
                        id="cropImageBtn"
                        class="common-modal-btn common-modal-btn-primary">

                  <svg
                            width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5 1.25C5.41421 1.25 5.75 1.58579 5.75 2V11C5.75 12.9068 5.75159 14.2615 5.88976 15.2892C6.02502 16.2952 6.27869 16.8749 6.7019 17.2981C7.12511 17.7213 7.70476 17.975 8.71085 18.1102C9.73851 18.2484 11.0932 18.25 13 18.25H22C22.4142 18.25 22.75 18.5858 22.75 19C22.75 19.4142 22.4142 19.75 22 19.75H19.75V22C19.75 22.4142 19.4142 22.75 19 22.75C18.5858 22.75 18.25 22.4142 18.25 22V19.75H12.9436C11.1058 19.75 9.65019 19.75 8.51098 19.5969C7.33855 19.4392 6.38961 19.1071 5.64124 18.3588C4.89288 17.6104 4.56076 16.6614 4.40313 15.489C4.24997 14.3498 4.24998 12.8942 4.25 11.0564L4.25 5.75H2C1.58579 5.75 1.25 5.41421 1.25 5C1.25 4.58579 1.58579 4.25 2 4.25H4.25V2C4.25 1.58579 4.58579 1.25 5 1.25ZM15.2892 5.88976C14.2615 5.75159 12.9068 5.75 11 5.75H8C7.58579 5.75 7.25 5.41421 7.25 5C7.25 4.58579 7.58579 4.25 8 4.25L11.0564 4.25C12.8942 4.24998 14.3498 4.24997 15.489 4.40313C16.6614 4.56076 17.6104 4.89288 18.3588 5.64124C19.1071 6.38961 19.4392 7.33855 19.5969 8.51098C19.75 9.65019 19.75 11.1058 19.75 12.9436V16C19.75 16.4142 19.4142 16.75 19 16.75C18.5858 16.75 18.25 16.4142 18.25 16V13C18.25 11.0932 18.2484 9.73851 18.1102 8.71085C17.975 7.70476 17.7213 7.12511 17.2981 6.7019C16.8749 6.27869 16.2952 6.02502 15.2892 5.88976Z"
                                    fill="#ffffff"></path>
                            </g>
                        </svg>

                    {{ $buttonText }}

                </button>

            </div>

        </div>
    </div>
</div>
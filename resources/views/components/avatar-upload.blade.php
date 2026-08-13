
@props([
    'formAction',
])

<!-- Upload / Current Avatar -->
<div class="avatar-grid">

    <!-- Upload Card -->
    <div class="avatar-card">

        <form id="my_avatar"
              action="{{ $formAction }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="card-heading">

                <div class="card-icon">
                    <svg width="40px" height="40px" viewBox="0 0 16 16"
                         xmlns="http://www.w3.org/2000/svg" fill="#000000">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path fill="#ff3c5f"
                                  fill-rule="evenodd"
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
                    <svg width="25px" height="25px" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg" fill="none">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path stroke="#ff3c5f"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
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

                <input type="file"
                       id="avatar-upload"
                       class="file-upload-input gambar item-img"
                       name="avatar_img"
                       accept=".jpg,.jpeg,.gif,.png"
                       onchange="readURL(this);"
                       hidden>

            </label>


            <!-- Upload Info -->
            <div class="upload-info">

                <div class="upload-info-icon">
                    <svg width="20px" height="20px" viewBox="0 0 24 24"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M9 12L11 14L15 9.99999M20 12C20 16.4611 14.54 19.6937 12.6414 20.683C12.4361 20.79 12.3334 20.8435 12.191 20.8712C12.08 20.8928 11.92 20.8928 11.809 20.8712C11.6666 20.8435 11.5639 20.79 11.3586 20.683C9.45996 19.6937 4 16.4611 4 12V8.21759C4 7.41808 4 7.01833 4.13076 6.6747C4.24627 6.37113 4.43398 6.10027 4.67766 5.88552C4.9535 5.64243 5.3278 5.50207 6.0764 5.22134L11.4382 3.21067C11.6461 3.13271 11.75 3.09373 11.857 3.07827C11.9518 3.06457 12.0482 3.06457 12.143 3.07827C12.25 3.09373 12.3539 3.13271 12.5618 3.21067L17.9236 5.22134C18.6722 5.50207 19.0465 5.64233 19.3223 5.88552C19.566 6.10027 19.7537 6.37113 19.8692 6.6747C20 7.01833 20 7.41808 20 8.21759V12Z"
                                stroke="#ff3c5f"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                        </g>

                    </svg>
                </div>

                <div>
                    <p>We only support JPG, GIF and PNG files.</p>
                    <p>Max file size: 2MB</p>
                </div>

            </div>


            <!-- Preview -->
            <div class="file-upload-content" style="display:none;">

                <img class="file-upload-image item-img"
                     src="#"
                     alt="Uploaded avatar"
                     id="item-img-output">

            </div>


            <!-- Upload Actions -->
            <div class="avatar-upload-submit" style="display: none">

                <!-- Reset -->
                <button type="button"
                        onclick="removeUpload()"
                        class="change-avatar-btn">

                    <svg width="20px"
                         height="20px"
                         viewBox="0 0 24 24"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M6.23706 2.0007C6.78897 2.02117 7.21978 2.48517 7.19931 3.03708L7.10148 5.67483C8.45455 4.62548 10.154 4.00001 12 4.00001C16.4183 4.00001 20 7.58174 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 11.4477 4.44772 11 5 11C5.55228 11 6 11.4477 6 12C6 15.3137 8.68629 18 12 18C15.3137 18 18 15.3137 18 12C18 8.68631 15.3137 6.00001 12 6.00001C10.4206 6.00001 8.98317 6.60994 7.91098 7.60891L11.3161 8.00677C11.8646 8.07087 12.2573 8.56751 12.1932 9.11607C12.1291 9.66462 11.6325 10.0574 11.0839 9.99326L5.88395 9.38567C5.36588 9.32514 4.98136 8.87659 5.00069 8.35536L5.20069 2.96295C5.22117 2.41104 5.68516 1.98023 6.23706 2.0007Z"
                                  fill="#ff3c5f">
                            </path>
                        </g>

                    </svg>

                    Reset
                </button>


                <!-- Save -->
                <button type="submit"
                        class="remove-avatar-btn crop_image">

                    <svg width="20px"
                         height="20px"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">
                            <path stroke="#ffffff"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
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

                <svg width="40px"
                     height="40px"
                     viewBox="0 0 24 24"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">

                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier"
                       stroke-linecap="round"
                       stroke-linejoin="round"></g>

                    <g id="SVGRepo_iconCarrier">

                        <path
                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                            stroke="#ff3c5f"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                        <path
                            d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                            stroke="#ff3c5f"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

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

            <img src="{{ asset(auth()->user()->avatar_url) }}"
                 alt="Current Avatar"
                 class="img-rounded avatarName">

        </div>


        <!-- Actions -->
        <div class="avatar-actions">

            <!-- Change Avatar -->
            <button type="button"
                    class="change-avatar-btn"
                    onclick="$('#avatar-upload').trigger('click');">

                <svg width="20px"
                     height="20px"
                     viewBox="0 0 24 24"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">

                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier"
                       stroke-linecap="round"
                       stroke-linejoin="round"></g>

                    <g id="SVGRepo_iconCarrier">

                        <path
                            d="M15.4998 5.49994L18.3282 8.32837M3 20.9997L3.04745 20.6675C3.21536 19.4922 3.29932 18.9045 3.49029 18.3558C3.65975 19.8689 3.89124 17.4059 4.17906 16.9783C4.50341 16.4965 4.92319 16.0765 5.76274 15.237L17.4107 3.58896C18.1918 2.80791 19.4581 2.80791 20.2392 3.58896C21.0203 4.37001 21.0203 5.63634 20.2392 6.41739L8.37744 18.2791C7.61579 19.0408 7.23497 19.4216 6.8012 19.7244C6.41618 19.9932 6.00093 20.2159 5.56398 20.3879C5.07171 20.5817 4.54375 20.6882 3.48793 20.9012L3 20.9997Z"
                            stroke="#ff3c5f"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                    </g>

                </svg>

                Change Avatar

            </button>


            <!-- Remove Avatar -->
            @if (auth()->user()->hasUploadedAvatar())

                <button type="button"
                        class="remove-avatar-btn delete_avatar">

                    <svg width="20px"
                         height="20px"
                         viewBox="0 0 24 24"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier"
                           stroke-linecap="round"
                           stroke-linejoin="round"></g>

                        <g id="SVGRepo_iconCarrier">

                            <path
                                d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3411 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7291 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                stroke="#ffffff"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>

                        </g>

                    </svg>

                    Remove

                </button>

            @endif

        </div>

    </div>

</div>

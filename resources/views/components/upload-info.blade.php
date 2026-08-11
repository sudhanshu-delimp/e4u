<div class="row">
    <div class="col-lg-12">
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
    </div>
</div>
<script>
    function toggleAvatarInfo() {
        const box = document.querySelector('.additional-info');
        if (box) {
            box.classList.toggle('open');
        }
    }
</script>

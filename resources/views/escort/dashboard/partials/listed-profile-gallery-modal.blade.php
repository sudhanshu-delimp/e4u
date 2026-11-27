@if(empty($escort))
<div class="modal fade upload-modal " id="viewThumbnail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">
                    <img src="{{asset('assets/dashboard/img/view-img.png')}}" class="custompopicon">
                    My Photos
                </h5>
                </ul>
                <button type="button" class="p-0" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>
            <div class="modal-body">
                <div id="gallery" class="photos-grid-container gallery">
                    @endif
                    <div class="main-photo img-box">
                        @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(1);
                                 $media_status = getMediaVerificationDataBigIcon($media->varified ?? 0);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                            <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                            <span>Click me!</span>
                            </div>
                            <div class="verify_icon imgStatus" data-tooltip="{{ $media_status['label'] }}">
                            <img src="{{ $media_status['icon'] }}">                            
                            </div>
                        @endif
                    </div>
                    <div class="sub">
                        <div class="img-box">
                            @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(2);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                                    <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                                <span>Click me!</span>
                            </div>
                            <div class="verify_icon_sm imgStatus2" data-tooltip="{{ $media_status['label'] }}">
                                <img src="{{ $media_status['icon'] }}">                                
                            </div>
                            @endif
                        </div>
                        <div class="img-box">
                            @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(3);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                                    <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                                <span>Click me!</span>
                            </div>
                            <div class="verify_icon_sm imgStatus2" data-tooltip="{{ $media_status['label'] }}">
                                <img src="{{ $media_status['icon'] }}">
                            </div>
                            @endif
                        </div>
                        <div class="img-box">
                            @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(4);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                                    <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                                <span>Click me!</span>
                            </div>
                            <div class="verify_icon_sm imgStatus2" data-tooltip="{{ $media_status['label'] }}">
                                <img src="{{ $media_status['icon'] }}">
                            </div>
                            @endif
                        </div>
                        <div class="img-box">
                            @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(5);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                                    <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                                <span>Click me!</span>
                            </div>
                            <div class="verify_icon_sm imgStatus2" data-tooltip="{{ $media_status['label'] }}">
                                <img src="{{ $media_status['icon'] }}">
                            </div>
                            @endif
                        </div>
                        <div class="img-box">
                            @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(6);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                                    <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                                <span>Click me!</span>
                            </div>
                            <div class="verify_icon_sm imgStatus2" data-tooltip="{{ $media_status['label'] }}">
                               <img src="{{ $media_status['icon'] }}">
                            </div>
                            @endif
                        </div>
                        <div class="img-box">
                            @if(isset($escort))
                            @php
                                 $media = $escort->gallerymediaPositionDetail(7);
                                 $media_status = getMediaVerificationDataSmallIcon($media->varified ?? 0);
                            @endphp
                            <a href="{{ asset($media->path) }}" class="glightbox image-wrapper" data-gallery="escort-gallery">
                                    <img src="{{ asset($media->path) }}" alt="thumbnail">
                            </a>
                            <div class="hover-overlay">
                                <span>Click me!</span>
                            </div>
                            <div class="verify_icon_sm imgStatus2" data-tooltip="{{ $media_status['label'] }}">
                                <img src="{{ $media_status['icon'] }}">
                            </div>
                            @endif
                        </div>
                    </div>
                    @if(empty($escort))
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@prepend('script')
<script>
    $('#viewThumbnail').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget);
        let escortId = button.data('escort-id');
        let modal = $(this);
        modal.find('#listingModalContent').html(`<div class="text-center p-3">Loading...</div>`);
        $.ajax({
            url: `{{ route('common.get_profile_gallery', ['escort'=>'__ESCORT__']) }}`.replace('__ESCORT__',escortId),
            type: 'GET',
            before: function(){
                showLoadingPopup();
            },
            success: function(response, textStatus, xhr) {
                modal.find('#gallery').html(response.html);
                Swal.close();
            },
            error: function(xhr, status, error) {
                displaySwal(xhr);
            }
        });

    });
</script>
@endprepend
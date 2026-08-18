<div class="photo-top-header">
    <div class="photo-top-header">
        <div class="pm-filter-row">
            <div class="pm-status-tabs">
                <ul class="nav nav-tabs border-0" id="escort_profile_media_filter_type">
                    <li class="nav-item">
                        <a class="nav-link pm-status-tab  {{ $currentStatus == 'all' ? 'active' : '' }}" id="menu_all" data-filter-type="all" data-toggle="tab" href="#home">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pm-status-tab {{ $currentStatus == 'verified' ? 'active' : '' }}" id="menu_varified" data-filter-type="verified" data-toggle="tab" href="#menu1"> 
                            <svg width="20px" height="20px" class="icons" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 12L10.5 15L16.5 9M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>Verified</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pm-status-tab {{ $currentStatus == 'unverified' ? 'active' : '' }} " id="menu_unverified" data-filter-type="unverified" data-toggle="tab" href="#menu2">
                            <svg width="20px" height="20px"  class="icons" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#ff3c5f" stroke-width="2" d="M5.5 5.5L18.5 18.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"></path> </g></svg>
                            Unverified</a>
                    </li>
                </ul>
            </div>
            <div class="pm-storage">
                <div class="pm-storage-label">
                    <span><strong>{{ $media->count() }}/30</strong> Photos Used</span>
                    <input type="hidden" name="media_count" value="{{$mediaCategory->count()}}">
                </div>
                
                <div class="pm-storage-bar">
                    <div class="pm-storage-progress" role="progressbar" style="width: {{$media->count() * 3.3}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    {{-- <div class="custom-img-filter-header"> --}}
        <div class="pm-category-tabs">
            <ul class="nav nav-tabs border-0 js_gallery_category">
                
                <li>
                    <a class="nav-link pm-category {{$category=='gallery'?'active':''}}" data-type="gallery" data-toggle="tab" href="#Gallery">
                        <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                    <circle cx="8" cy="9" r="1.5"></circle>
                                    <path d="m4 17 5-5 3 3 2-2 6 5"></path>
                                </svg> 
                        Gallery</a>
                </li>
                <li>
                    <a class="nav-link pm-category {{$category=='banner'?'active':''}} " data-type="banner" data-toggle="tab" href="#Banner">
                         <svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                        <path d="M3 15h18"></path>
                                        <path d="M8 20v-5"></path>
                                        <path d="M16 20v-5"></path>
                                    </svg>
                        Banner</a>
                </li>
                <li>
                    <a class="nav-link pm-category {{$category=='pinup'?'active':''}}" data-type="pinup" data-toggle="tab" href="#Pinup">
                        <svg viewBox="0 0 24 24">
                                        <path d="M12 3v18"></path>
                                        <path d="M7 7h10"></path>
                                        <path d="M5 11h14"></path>
                                        <path d="M8 15h8"></path>
                                        <path d="M9 19h6"></path>
                                    </svg>
                        Pin Up</a>
                </li>
                
            </ul>
        </div>
    {{-- </div> --}}
</div>
<div class="archive-photo-sec">
    <div class="row">
        <div class="col-md-12">
            <div id="pagination-container"></div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-wrap="false" data-bs-ride="carousel">
                <ul class="pagination ml-2 pl-1">
                <li class="page-item preview">
                <a class="page-link" href="#carouselExampleIndicators" id="preId">‹‹</a>

                </li>
                @for($i = 0; $i < ceil(count($mediaCategory)/10); $i++ )
                <li class="page-item" id="pageItem_{{$i}}" data-id="{{$i}}">
                    <a data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="page-link" href="#">{{$i + 1}}</a>
                </li>
                @endfor
                <li class="page-item nextOne">
                <a class="page-link" href="#carouselExampleIndicators" id="nextId">››</a>
                </li>
                </ul>
                <div class="container pt-2" style="padding-left: 0.75rem;padding-right: 0.75rem;">
                <div class="carousel-inner" id="view_all">
                @foreach($mediaCategory->chunk(10)  as $keyId => $images)
                    <div class="carousel-item" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                        <div class="grid-container" id="dvSource">  
                        @foreach($images as $image)    
                        @if(!in_array($image->position, [8]))                                               
                            <div class="item4" id="dm_{{$image->id}}">
                                <img class="img-thumbnail defult-image ui-draggable" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
                                <i class="fa fa-trash deleteimg" data-id="{{$image->id}}" title="Remove this media"></i>                                        
                                @switch($image->position)
                                    @case(9)
                                        <span class="badge badge-red">Banner</span>
                                    @break
                                    @case(10)
                                        <span class="badge badge-red">Pin Up</span>
                                    @break
                                    @default
                                        <span class="badge badge-red">Gallery</span>
                                @endswitch
                                @switch($image->varified)
                                    @case(0) {{-- Pending --}}
                                        <div class="verify_icon">
                                            <img src="{{ asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png') }}">
                                            <span class="mc_media_tooltip">Media Pending</span>
                                        </div>
                                        @break

                                    @case(1) {{-- Verified --}}
                                        <div class="verify_icon">
                                            <img src="{{ asset('assets/app/img/verify/verified_icon.png') }}">
                                            <span class="mc_media_tooltip">Media Verified</span>
                                        </div>
                                        @break

                                    @case(2) {{-- Unverified --}}
                                        <div class="verify_icon">
                                            <img src="{{ asset('assets/app/img/verify/unverified_icon.png') }}">
                                            <span class="mc_media_tooltip">Media Unverified</span>
                                        </div>
                                        @break

                                    @default
                                        <div class="verify_icon">
                                            <img src="{{ asset('assets/app/img/verify/unverified_icon.png') }}">
                                            <span class="mc_media_tooltip">Media Unverified</span>
                                        </div>

                                @endswitch
                                @php $status = $image->varified ?? "2"; @endphp
                                <div class="upload_date">
                                    @if($status == "0")
                                        Uploaded: <span>{{ showDateWithFormat($image->created_at) }}</span>
                                    @elseif($status == "1")
                                        Approved: <span>{{ showDateWithFormat($image->updated_at) }}</span>
                                    @else
                                        Rejected: <span>{{ showDateWithFormat($image->updated_at) }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif    
                        @endforeach   
                        </div>
                    </div>
                @endforeach                     
                </div>
            </div>
        </div>
    </div>
</div>
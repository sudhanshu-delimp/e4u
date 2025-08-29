<div class="photo-top-header">
    <div class="photo-header border-0">
        <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
            <div class="row">
                <div class="col-md-8">
                    <ul class="nav nav-tabs border-0">
                        <li class="nav-item">
                            <a class="nav-link show" id="menu_all" data-toggle="tab" href="#home">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="menu_varified" data-toggle="tab" href="#menu1">Verified</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="menu_unverified" data-toggle="tab" href="#menu2">Unverified</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 pt-1">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$media->count() * 3.3}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div style="display: flex;gap: 15px;">
                        <p>{{ $media->count() }}/30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                @for($i = 0; $i < ceil(count($media)/10); $i++ )
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
                @foreach($media->chunk(10)  as $keyId => $images)
                    <div class="carousel-item" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                        <div class="grid-container" id="dvSource">  
                        @foreach($images as $image)    
                        @if(!in_array($image->position, [8])/*$image->position != 8*/)                                               
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
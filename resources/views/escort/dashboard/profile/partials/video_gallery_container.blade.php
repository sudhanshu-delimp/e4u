<div id="blogCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        
    <ul class="pagination ml-2 pl-1">
        @for($i = 0; $i < ceil(count($media)/3); $i++ )
        <li class="page-item " id="pageItemVideo_{{$i}}" data-id="{{$i}}">
           <a data-target="#blogCarousel" data-slide-to="{{$i}}"  class="page-link" href="#">{{$i + 1}}</a>
        </li>
        @endfor
     </ul>
    <!-- Carousel items -->
    <div class="carousel-inner">
        @foreach($media->chunk(3)  as $keyId => $medias)
        <div class="carousel-item custom-padding" id="cItemVideo_{{$loop->index}}" data-id="{{$loop->index}}">
            <div class="row" id="dvSource">
                @foreach($medias as $key => $video)
                    <div class="col-md-4 videoDraggable delete_video_icon" id="videoDraggable_{{$key+1}}">
                        <a href="#" class="remove-video-icon">
                            <video style="z-index: 1" controls="" data-id="{{$video->id}}" data-position="{{$video->position ? $video->position : ''}}" id="videoId_{{$video->id}}" src="{{ asset($video->path)}}" >
                                <source src="{{ asset($video->path)}}" type="video/mp4" >
                            </video>
                            <div class="drag-bar">
                                <i class="fa fa-arrows-alt"></i> Drag Video
                            </div>
                        </a>
                        <i class="fa fa-trash deleteimg " data-id="{{$video->id}}"></i>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
        <!--.item-->
    </div>
    <!--.carousel-inner-->
</div>
<style>
    .drag-bar {
    background: #0C223D;
    color: #fff;
    padding: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: move;
    transition: all 0.2s;
    text-align: center;
}

.drag-bar i {
    margin-right: 6px;
    color: #fff;
}

.drag-bar:hover {
    background: #e2e6ea;
    color: #000;
}
</style>
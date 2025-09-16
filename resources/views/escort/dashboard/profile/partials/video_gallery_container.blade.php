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
                    <div class="col-md-4 videoDraggable" id="videoDraggable_{{$key+1}}">
                        <a href="#" class="remove-video-icon">
                            <video style="z-index: 1" controls="" data-id="{{$video->id}}" data-position="{{$video->position ? $video->position : ''}}" id="videoId_{{$video->id}}" src="{{ asset($video->path)}}" >
                                <source src="{{ asset($video->path)}}" type="video/mp4" >
                            </video>
                            <i class="fa fa-trash deleteimg" data-id="{{$video->id}}"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
        <!--.item-->
    </div>
    <!--.carousel-inner-->
</div>
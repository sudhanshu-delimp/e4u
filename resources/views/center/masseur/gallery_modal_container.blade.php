@foreach($media  as $keyId => $image)
    @if(!in_array($image->position, [8, 9, 10])/*$image->position != 8*/)
        <div class="item4">
            <img class="img-thumbnail defult-image select_image" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
        </div>
    @endif
@endforeach
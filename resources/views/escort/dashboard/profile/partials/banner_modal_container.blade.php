@foreach($media  as $keyId => $image)
    @if(in_array($image->position, [9,10])/*$image->position != 8*/)
        <div class="item2">
            <img class="img-thumbnail defult-image select_image" style="height: 150px;" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
        </div>
    @endif
@endforeach
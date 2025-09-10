@foreach($media  as $keyId => $image)
    @if(!$image->template && in_array($image->position, [9]))
        <div class="item2">
            <img class="img-thumbnail defult-image select_image" style="" src="{{  asset($image->path) }}" alt=" " data-id="{{$image->id}}" data-position="{{$image->position ? $image->position : ''}}">
        </div>
    @endif
@endforeach
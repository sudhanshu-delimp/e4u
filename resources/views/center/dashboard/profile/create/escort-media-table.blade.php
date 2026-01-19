<!-- The table listing the files available for upload/download -->
<table role="presentation" class="table table-striped" id="escort-media-table">
    <tbody class="files">
        @foreach($profile->medias as $media)
        <tr class="template-download fade image in">
            <td>
                <span class="preview">
                    <a href="{{ url($media->path ?? '') }}" data-gallery="">
                        @if($media->type == 1)
                        <video width="200" height="150" controls="">
                            <source src="{{ url($media->path ?? '') }}" type="video/mp4">
                        </video>
                        @else
                        <img src="{{ url($media->thumbnail ?? '') }}">
                        @endif
                    </a>
                </span>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <button class="btn btn-danger delete" data-type="DELETE" data-url="{{ route('center.delete.media', $media->id) }}">
                <i class="glyphicon glyphicon-trash"></i>
                <span>Delete</span>
                </button>
                @if($media->type == 0)
                    @if($media->default)
                    <button type="button" class="btn btn-primary mark-default" data-id="{{ $media->id }}" data-toggle="tooltip" data-placement="top" title="This is marked as default image" disabled>
                        <i class="fa fa-check"></i>Default
                    </button>
                    @else
                    <button type="button" class="btn btn-primary mark-default" data-id="{{ $media->id }}" data-url="{{ route('escort.media.mark.default', $media->id) }}" data-toggle="tooltip" data-placement="top" title="Mark this as default image">
                        Default
                    </button>
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
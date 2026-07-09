@if($type == 'one')
<option value="">Fun Stuff - On Viewer</option>
@elseif($type == 'two')
<option value="">Kinky Stuff - On Viewer</option>
@else
<option value="">Fun Stuff - On Escort</option>
@endif

@foreach ($services as $key => $service)
    <option id="{{ $service->name }}" value="{{ $service->id }}" >
        {{ $service->name }}
    </option>
@endforeach

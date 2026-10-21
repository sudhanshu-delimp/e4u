<option value="" selected>{{ $placeholder }}</option>

@foreach ($options as $option)
    <option value="{{ data_get($option, $valueField) }}">
        {{ data_get($option, $textField) }}
    </option>
@endforeach
@if($addNewLabel)
<option value="new">{{ $addNewLabel }}</option>
@endif
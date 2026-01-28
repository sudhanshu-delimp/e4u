@if ($locations->count() > 0)
    @foreach ($locations as $location)
        <tr>
            <td>{{$location->state->name}}</td>
            <td>{{$location->days_number}}</td>
            <td>{{$location->start_date_formatted}}</td>
            <td>{{$location->end_date_formatted}}</td>
            <td>{{$location->status}}</td>
            <td>{!! $location->action !!}</td>
        </tr>  
    @endforeach
@endif
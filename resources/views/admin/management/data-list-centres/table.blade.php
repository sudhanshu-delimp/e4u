@foreach ($agents as $agent)
<tr>
    <td>{{basicDateFormat($agent['created_at'])}}</td>
    <td>{{$agent['business_name'] ?? ''}}</td>
    <td>{{$agent['member_id'] ?? ''}}</td>
    <td><span class="custom_badge {{getStatusBadgeClass($agent['status'])}}">{{$agent['status']}}</span></td>
</tr>
@endforeach

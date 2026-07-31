@php
use Illuminate\Support\Carbon;
@endphp
@if ($queryData->count() > 0)
    <table class="table table-bordered mb-0">
        <thead class="table-bg modal-thaed">
            <tr>
                <th>Query</th>
                <th>Date</th>
            </tr>
             </thead>
             @foreach ($queryData as $query)
            <tr>
                <td>{{$query->notes}}</td>
                <td>{{Carbon::parse($query->report_date)->format('d-m-Y')}}</td>
            </tr>
            @endforeach
       
    </table>
@endif



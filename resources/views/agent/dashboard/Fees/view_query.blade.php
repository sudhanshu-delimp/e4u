
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
                <td>{{basicDateFormat($query->report_date)}}</td>
            </tr>
            @endforeach
       
    </table>
@endif



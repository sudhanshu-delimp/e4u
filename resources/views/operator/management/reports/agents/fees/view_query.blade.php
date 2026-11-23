
@if ($queryData->count() > 0)
    <table class="table table-bordered mb-0">
        <thead class="table-bg modal-thaed">
            <tr style="background-color: #003c3e;">
                <th>Query</th>
                <th>Date</th>
                 <th>Submitted By</th>
            </tr>
             </thead>
             @foreach ($queryData as $query)
            <tr>
                <td>{{$query->notes}}</td>
                <td>{{basicDateFormat($query->report_date)}}</td>
                 <td>{{$query->submittedBy?->member_id ?? ""}}</td>
            </tr>
            @endforeach
       
    </table>
@endif



<div class="dropdown no-arrow">
    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i
            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">
        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center report-action" href="#" data-report-action="Merge" data-report-id="{{$report->id}}" >
            <i class="fa fa-bezier-curve"></i> Merge</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center report-action" href="#" data-report-action="Print" data-report-id="{{$report->id}}" ><i class="fa fa-print">
            </i> Print</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center report-action" data-report-action="View" href="#" data-report-id="{{$report->id}}" >
            <i class="fa fa-eye"></i> View</a>
    </div>
</div>

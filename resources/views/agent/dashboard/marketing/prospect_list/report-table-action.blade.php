<div class="dropdown no-arrow">
    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i
            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">
        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center report-action" href="#"
            data-report-id="{{$report->id}}" data-action="merge" data-target="#mergeType" data-toggle="modal"><i
                class="fa fa-bezier-curve"></i> Merge</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center report-action" href="#"
            data-report-id="{{$report->id}}" data-action="print"><i class="fa fa-print"></i> Print</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center report-action" href="#"
            data-report-id="{{$report->id}}" data-action="view" data-target="#view_list" data-toggle="modal"><i
                class="fa fa-eye"></i> View</a>
    </div>
</div>

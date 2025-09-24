<div class="dropdown no-arrow text-center">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink_{{ $appointment->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    </a>
    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink_{{ $appointment->id }}">
        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" data-target="#edit_appointment" data-toggle="modal" data-id="{{ $appointment->id }}">
            <i class="fa fa-pen"></i>Edit Appointment</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" data-target="#reschedule_appointment" data-toggle="modal" data-id="{{ $appointment->id }}">
            <i class="fa fa-calendar"></i>Reschedule Appointment</a>
        <div class="dropdown-divider"></div>
        @if($appointment->status != 'completed')
        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" data-target="#complete_appointment" data-toggle="modal" data-id="{{ $appointment->id }}">
            <i class="fa fa-check-circle"></i>Completed Appointment</a>
            <div class="dropdown-divider"></div>
        @endif
        
        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" data-target="#view_appointment" data-toggle="modal" data-id="{{ $appointment->id }}">
            <i class="fa fa-eye"></i>View Appointment</a>
    </div>
</div>


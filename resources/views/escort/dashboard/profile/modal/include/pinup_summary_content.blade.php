<div class="modal-content basic-modal">
    <!-- Modal Header -->
    <div class="modal-header">
        <h5 class="modal-title" id="removePlaymateModalLabel">
            <a href="{{route('home')}}"><img src="{{ asset('assets/dashboard/img/summary.png') }}" style="width:45px; padding-right:10px;"><span class="text-white">Summary of your current Pin Up</span></a>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
            </span>
        </button>
    </div>
    <!-- Modal Body with Static Table -->
    <div class="modal-body px-4">
        <div class="d-flex align-items-center justify-content-between gap-10 flex-wrap">
        <div class="d-flex align-items-center justify-content-between gap-10 my-2"><strong>Location:</strong> <span>{{!empty($escort->profile_name)?$escort->profile_name:''}}</span></div>
        <div class="d-flex align-items-center justify-content-between gap-10 my-2"><strong>Profile:</strong> <span>{{!empty($escort->profile_name)?$escort->state->name:''}}</span></div>
        </div>
        <div class="d-flex align-items-center justify-content-between gap-10 flex-wrap">
        <div class="d-flex align-items-center justify-content-between gap-10 my-2"><strong>Start Date::</strong> <span>{{!empty($escort->profile_name)?$escort->latestActivePinup->start_date:''}}</span></div>
        <div class="d-flex align-items-center justify-content-between gap-10 my-2"><strong>End date: </strong> <span>{{!empty($escort->profile_name)?$escort->latestActivePinup->end_date:''}}</span></div>
    </div>
    <div class="text-center my-2">
        <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close">Close</button> 
    </div>
    <div>
        <hr style="background-color: #0C223D" class="mt-4">
        <p class="mb-1"><b>Notes:</b></p>
        <ol class="pl-4">
            <li>The standard Fee for a Pin Up has ben applied.</li>
            <li>You Pin Up listing will be automatically removed if you Suspend or Cancel the
                Profile listing.</li>
        </ol>
    </div>
</div>
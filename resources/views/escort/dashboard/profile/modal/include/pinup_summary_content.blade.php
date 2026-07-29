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
        <table class="table w-100 ">
            <tr>
                <th><strong>Profile:</strong> </th>
                <td style="border:none"><span>{{!empty($escort->profile_name)?$escort->state->name:''}}</span></td>
                <th><strong>Location:</strong> </th>
                <td style="border:none"><span>{{!empty($escort->profile_name)?$escort->profile_name:''}}</span></td>
            </tr>

            <tr>
                <th><strong>Start Date:</strong> </th>
                <td style="border:none"><span>{{!empty($escort->latestActivePinup)?\Carbon\Carbon::parse($escort->latestActivePinup->start_date)->format('d-m-Y'):''}}</span></td>
                <th><strong>End date:</strong> </th>
                <td style="border:none"><span>{{!empty($escort->latestActivePinup)?\Carbon\Carbon::parse($escort->latestActivePinup->end_date)->format('d-m-Y'):''}}</span></td>
            </tr>
        </table>
    </div>
        <div class="text-center my-2">
            <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close">Close</button> 
        </div>
        <div class="px-4">
            <hr style="background-color: #0C223D" class="mt-4">
            <p class="mb-1"><b>Notes:</b></p>
            <ol class="pl-4">
                <li>The standard Fee for a Pin Up has been applied.</li>
                <li>Your Pin Up listing will be automatically removed if you Suspend or Cancel the
                    Profile listing.</li>
            </ol>
        </div>
</div>
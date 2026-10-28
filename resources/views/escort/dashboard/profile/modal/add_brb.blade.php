<div class="modal fade upload-modal modal-form-brb" id="add_brb" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=""><img src="/assets/app/img/brb.png" class="custompopicon" alt="cross"> Add BRB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img id="modal_close" src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="container p-0">
                                
                                <form id="brb_form" action="{{route('escort.brb.add')}}"  method="POST">
                                    <div class="form-group row">
                                        <label class="col-sm-4" for=""> Profile:</label>
                                        <div class="col-sm-8">
                                            <select
                                                class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                id="profile_id" name="profile_id"
                                                data-parsley-errors-container="#profile-errors" required
                                                data-parsley-required-message="Select Profile">
                                                <option value="">Select Profile</option>
                                                @foreach ($active_escorts as $profile)
                                                    <option value="{{ $profile['id'] }}"
                                                        profile_name="{{ $profile['profile_name'] }}">
                                                        {{ $profile['id'] }} - {{ $profile['name'] }} @if (isset($profile['state']['name']))
                                                            - {{ $profile['state']['name'] }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span id="profile-errors"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4" for=""> BRB Date & Time:</label>
                                        
                                        <div class="col-sm-8">
                                            <input type="text" required 
                                                class="form-control form-control-sm removebox_shdow" name="brb_date" id="datetimepicker_brb"  placeholder="Select date and time"  autocomplete="off">
                                            <span id="brb-time-errors"></span>
                                        </div>
                                        
                                       
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4" for=""> BRB Note:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="brb_note" id="brb_note" required></textarea>
                                        </div>
                                        
                                    </div> 
                                     <div class="modal-footer" style="text-align: right; display: block;">
                                        <button type="submit" class="btn-success-modal" id="save_brb">Do you want to Post?</button>
                                        <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                                    </div>                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
    </div>
</div>
@prepend('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script>
   
    $(function () {
        $("#datetimepicker_brb").datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: "hh:mm tt",
            minDate: 0,
            controlType: "select",
            changeMonth: true,
            changeYear: true
        });
    });

    let brbFrom = $(".modal-form-brb form");
    let brbFromButton = brbFrom.find('.modal-footer button[type="submit"]');
   
    brbFrom.on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: brbFrom.attr('action'),
        method: brbFrom.attr('method'),
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: brbFrom.serialize(),
        beforeSend: function () {
            showLoadingPopup();
            brbFromButton.prop('disabled', true);
        },
        success: function (response, textStatus, xhr) {
            Swal.close();
            if (response.success) {
                table.draw();
                brbFrom.closest('.modal').modal('hide');
                brbFrom[0].reset();
                displaySwal(xhr);
            }
            
        },
        error: function (xhr) {
            Swal.close();
            displaySwal(xhr);
        },
        complete: function () {
            brbFromButton.prop('disabled', false);
        }
    });
});

</script>
@endprepend
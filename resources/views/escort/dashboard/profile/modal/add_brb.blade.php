<div class="modal fade upload-modal" id="add_brb" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="brb_form">
            <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><img src="/assets/app/img/brb.png" class="custompopicon" alt="cross" style="margin-right:10px"> Add BRB</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img id="modal_close" src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Profile:</label>
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
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> BRB Date & Time:</label>
                                        <div class="col-sm-4">
                                            <input type="date" required min="{{ date('Y-m-d') }}"
                                                class="form-control form-control-sm removebox_shdow" name="brb_date"
                                                data-parsley-type="" data-parsley-type-message="">
                                            <span id="brb-time-errors"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="time" class="form-control form-control-sm removebox_shdow"
                                                name="brb_time" required data-parsley-time required>
                                            <span id="brb-time-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> BRB Note:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control form-control-sm" name="brb_note" id="brb_note" required></textarea>
                                        </div>
                                        <div class="col-sm-2=1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center; display: block;">
                        <button type="submit" class="btn-success-modal" id="save_brb">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
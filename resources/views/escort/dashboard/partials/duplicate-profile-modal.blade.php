
<div class="modal fade upload-modal" id="duplicate-profile-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="duplicate_profile_form" data-parsley-validate>
            <input type="hidden" name="duplicate_profile" value="duplicate" />
            <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><img src="/assets/app/img/dublicate-profile.png" class="custompopicon" alt="cross"> Duplicate Profile</h5>
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
                                        <label class="col-sm-3" for="">
                                            Profile Name:
                                            <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                                data-toggle="tooltip" data-html="true" data-placement="top"
                                                title="Be consistent when naming your Profiles, like Sydney01, Sydney 02, Perth01, Perth02 etc."
                                                data-boundary="window">
                                            <span style='color:red'>*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" required class="form-control form-control-sm removebox_shdow" name="profile_name"
                                            required
                                            data-parsley-group="group_one" 
                                            data-parsley-required-message="Enter profile name."
                                            data-parsley-remote="{{route('escort.checkProfileName')}}"
                                            data-parsley-remote-message="This profile name already exists." 
                                            data-parsley-trigger="blur"
                                            data-parsley-errors-container="#profile_name-errors"
                                         >
                                            <span id="profile-errors"></span>
                                            <span id="profile_name-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for="">
                                            Stage Name:
                                            <span style='color:red'>*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select onclick="stageNameInput(this)" style="display: block"
                                                class=" change_default_select form-control form-control-sm select_tag_remove_box_sadow"
                                                title="(for public display)" id="stageName" name="name"
                                                required="required" data-parsley-required-message="Select stage name"
                                                data-parsley-group="goup_one"
                                                data-parsley-errors-container="#stageName-errors">
                                                <option value="" selected>-Choose Your Stage Name-</option>
                                                @if (!empty(auth()->user()->escorts_names))
                                                    @foreach (auth()->user()->escorts_names as $key => $name)
                                                        <option value='{{ $name }}'>{{ $name }}</option>
                                                    @endforeach
                                                @endif
                                                <option value="new">Add a new Stage Name</option>
                                            </select>
                                            <input type="hidden" id="stageNameInp" required="required" name=""
                                                title="(for public display)"
                                                class="change_default form-control form-control-sm select_tag_remove_box_sadow"
                                                data-parsley-required-message="Enter stage name"
                                                data-parsley-group="goup_one"
                                                placeholder="Choose your Stage Name (for public display)"
                                                data-parsley-errors-container="#stageName-errors">
                                            <div class="form-check form-check-inline update_stage_name d-none">
                                                <input class="form-check-input" type="checkbox" id="update_stage_name"
                                                    name="update_stage_name">
                                                <label class="form-check-label" for="update_stage_name">Update in your
                                                    My Information page for future Profiles</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for="">
                                            Location:
                                            <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                                data-toggle="tooltip" data-html="true" data-placement="top"
                                                title="This is the Location you want the Profile to be saved to, like Western Australia, Victoria etc. Make sure the Profile Name matches up."
                                                data-boundary="window">
                                        </label>
                                        <div class="col-sm-8">
                                            <select
                                                class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                id="profile_state_id" name="state_id"
                                                data-parsley-errors-container="#locationState-errors" required
                                                data-parsley-required-message="-select location-">
                                                <option value="" selected="">-- Select States--</option>
                                                @foreach (config('escorts.profile.states') as $key => $state)
                                                    <option style="font-weight: 500;" value="{{ $key }}">
                                                        {{ $state['stateName'] }} </option>
                                                @endforeach
                                            </select>
                                            <span id="profile-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center; display: block;">
                        <input type="hidden" name="escort_id">
                        <input type="hidden" id="profile_city_id" name="city_id">
                        <button type="submit" class="btn-success-modal" id="save_brb">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

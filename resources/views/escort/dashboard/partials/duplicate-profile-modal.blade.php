<div class="modal fade upload-modal" id="duplicate-profile-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="duplicate_profile_form">
            <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Duplicate Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img id="modal_close" src="{{ asset('assets/app/img/cross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="form-group row">
                                        <label class="col-sm-3" for="">
                                        Profile Name:
                                        <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="Be consistent when naming your Profiles, like Sydney01, Sydney 02, Perth01, Perth02 etc." data-boundary="window">
                                        <span style='color:red'>*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" required class="form-control form-control-sm removebox_shdow" name="profile_name" data-parsley-type="" data-parsley-type-message="">
                                            <span id="profile-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for="">
                                            Location:
                                            <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="This is the Location you want the Profile to be saved to, like Western Australia, Victoria etc. Make sure the Profile Name matches up." data-boundary="window">
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="profile_state_id" name="state_id" data-parsley-errors-container="#profile-errors" required data-parsley-required-message="Select Profile">
                                            <option value="" selected="">-- Select States--</option>
                                            @foreach(config('escorts.profile.states') as $key => $state)
                                                <option style="font-weight: 500;" value="{{$key}}"> {{$state['stateName']}} </option>
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
                        <input type="text" name="escort_id">
                        <button type="submit" class="btn btn-primary" id="save_brb">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
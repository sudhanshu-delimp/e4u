<style type="text/css">
    .stage .select2-search__field {
        margin-top: -2.2rem !important;
        position: absolute !important;
        margin-left: -0.3rem !important;
    }

    .parsley-errors-list li {
        list-style: none !important;
        margin-left: -2.3rem;
    }

    .parsley-min {
        color: #e5365a;
    }


    .emoji-input-wrapper {
        position: relative;
    }

    .emoji-btn {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-40%);
        font-size: 16px;
        cursor: pointer;
        z-index: 9;

        width: 28px;
        height: 28px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        transition: 0.3s ease;
    }

    .emoji-btn.is-invalid {
        position: absolute;
        left: 12px;
        top: 30%;
    }

    .emoji-btn:hover {
        background: #f2f2f2;
        transform: translateY(-50%) scale(1.5);
    }

    #who_title {
        padding-left: 45px !important;
    }

    #emojiPicker {
        position: absolute;
        top: 45px;
        left: 0;
        z-index: 9999;
        display: none;
    }

    .make_default {
        position: absolute;
        bottom: -6px;
        font-size: 10px;
        line-height: 30px;
        color:#fff;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 4px;
    }
</style>

<div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
    <form id="update_about_me" class="common-form" action="#" method="POST" enctype="multipart/form-data">

        <!-- upload video  -->
        <div class="about_me_drop_down_info ">

            <!-- stage name -->
            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 18.5C12.5523 18.5 13 18.0523 13 17.5L13 10.5C13 9.94772 12.5523 9.5 12 9.5C11.4477 9.5 11 9.94772 11 10.5L11 17.5C11 18.0523 11.4477 18.5 12 18.5Z" fill="#ff3c5f"></path> <path d="M12 8.5C12.8284 8.5 13.5 7.82843 13.5 7C13.5 6.17157 12.8284 5.5 12 5.5C11.1716 5.5 10.5 6.17157 10.5 7C10.5 7.82843 11.1716 8.5 12 8.5Z" fill="#ff3c5f"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M1 12C1 18.0751 5.92487 23 12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1C5.92487 1 1 5.92487 1 12ZM12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z" fill="#ff3c5f"></path> </g></svg>
                        </div>
                        <div class="card-heading">
                            <h2>Stage Names <span class="custom--help"><b>Help?</b></span></h2>
                        </div>
                    </div>

                    <div class="custom-note-section">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol class=" mb-0">
                                    <li>By completing these settings, the Additional Information will by default appear in the
                                        Profile creator.</li>
                                    <li>You can also update these settings from within the Profile creator.</li>
                                    <li>These Additional Information settings are optional, and are available to your Profile
                                        Creator to help assemble your Profiles more quickly.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 ">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label class="small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1">
                                Stage Names
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top"
                                    title="You can create as many as you like. Select your Stage Name from the drop down list that will appear in the Profile creator."
                                    data-boundary="window">

                            </label>
                            <div class="stageListParent">
                                    <input type="text" class="form-control form-control-sm" id="stage_name"
                                        placeholder="Enter stage name">
                                    <div class="invalid-feedback error-message"></div>
                           
                                <div class="cp-hint mt-1">
                                    <b>Note : </b> <i>Save your new Stage Names before you apply the Sort
                                        feature.</i>
                                </div>

                                <div style="display: ruby; padding-left: 0px;">
                                    <label>Sort By : </label>
                                    <div class="pt-4 pb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortedByStageNames"
                                                id="stageNameAlphabetically" value="alphabetically" checked>

                                            <label class="form-check-label" for="stageNameAlphabetically">
                                                Alphabetical (A–Z)
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortedByStageNames"
                                                id="stageNameRandom" value="random">

                                            <label class="form-check-label" for="stageNameRandom">
                                                Random
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable mt-0">
                                        <ul class="results" id="stageNameList">
                                            
                                        </ul>
                                    </div>
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>

                </div>
                <div class="col-md-12 text-right common-footer">
                    <button id="read-more" type="button"
                        class="save_stage_name_button common-save-btn">Save</button>
                </div>
                <div class="col-lg-12 mt-4">
                    <hr>
                </div>
                <!-- stage address -->
                <div class="col-lg-12 ">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label class="small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1">
                                Street Address
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top"
                                    title="You can create as many as you like. Ideally, if you Tour, create the
                                        addresses for the apartments / hotels you stay at in each Location."
                                    data-boundary="window">

                            </label>

                            <div class="stageListParent">
                                    <input type="text" class="form-control form-control-sm" id="st_address"
                                        placeholder="Enter street address">
                                    <div class="invalid-feedback error-message"></div>
                            
                                <div class="cp-hint mt-1"><b>Note:</b> <i>Save your Addresses before you apply the Sort
                                            feature.</i></div>
                                            
                                <div style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{ $escort->covidreport }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="sortedByStageAddress"
                                                id="addressAlphabetically" value="alphabetically" checked>
                                            <label class="form-check-label" for="addressAlphabetically">Location
                                                (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio"
                                                name="sortedByStageAddress" id="addressRandom" value="random">
                                            <label class="form-check-label" for="addressRandom">Random</label>
                                        </div>
                                    </div>

                                </div>
                                <!-- append cards -->
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageAddress">                                          

                                        </ul>
                                    </div>
                                </div>
                                <!-- end -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right common-footer">
                    <button type="button" class="save_address_button common-save-btn">Save</button>
                </div>
                <!-- end -->
                
                <div class="col-lg-12 mt-4">
                    <hr>
                </div>
                 <!-- Who Am I (Tittle) -->
                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label class="small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1">
                                Who Am I (Tittle)
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                    data-toggle="tooltip" data-html="true" data-placement="top"
                                    title="You can create as many Tittle as you like." data-boundary="window">

                            </label>

                            <div class="stageListParent">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend emoji-input-wrapper">
                                        <span class=" emoji-btn" id="emojiBtn">😊</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id="who_title" placeholder="Enter tittle">
                                    <div class="invalid-feedback error-message"></div>
                                    <emoji-picker id="emojiPicker"></emoji-picker>
                                </div>


                                <div class="cp-hint -mt-1"> <b>Note:</b> <i>Save your Tittle before you apply the Sort
                                            feature.</i></div>
                                <div style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{ $escort->covidreport }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="sortedByStageTitle"
                                                id="titleAlphabetically" value="alphabetically" checked>
                                            <label class="form-check-label" for="titleAlphabetically">Alphabetical
                                                (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="sortedByStageTitle"
                                                id="titleRandom" value="random">
                                            <label class="form-check-label" for="titleRandom">Random</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- append cards -->
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageTitleList">
                                            <!-- js append here -->

                                        </ul>
                                    </div>
                                </div>
                                <!-- end -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 text-right common-footer">
                    <button type="button" class="save_title_button common-save-btn">Save</button>
                </div>
                <!-- end -->
                    
                <div class="col-lg-12 mt-4">
                    <hr>
                </div>
                <!-- Who Am I (Narration) -->
                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label class="small-icon custom--stathead  custom--stathead--flex mb-1"
                                for="exampleFormControlSelect1">
                                Who Am I (Narration)
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                    data-toggle="tooltip" data-html="true" data-placement="top"
                                    title="You can create as many Narrations as you like." data-boundary="window">
                            </label>
                            <div class="stageListParent">
                               
                                    <textarea class="form-control mt-2 h-100" id="who_narration_textarea" name="narration"
                                        placeholder="Maximum limit of 2,500 characters."></textarea>
                                    <div id="who_narration_textarea-error" class="error-message"></div>

                               

                                <div class="cp-hint mt-1"> <b>Note : </b> <i>Save your Narrations before you apply the Sort feature.
                                        </i></div>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{ $escort->covidreport }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="sortedByNarration"
                                                id="narrationAlphabetically" value="alphabetically" checked>
                                            <label class="form-check-label" for="narrationAlphabetically">Alphabetical
                                                (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input " type="radio" name="sortedByNarration"
                                                id="narrationRandom" value="random">
                                            <label class="form-check-label" for="narrationRandom">Random</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- append cards -->
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageNarration">
                                            <!-- js append here -->

                                        </ul>
                                    </div>
                                </div>
                                <!-- end -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right common-footer">
                    <button type="button" class="save_narration_button common-save-btn">Save</button>
                </div>
                <!-- end -->
            </div>
            <!-- end -->


            


           


        </div>
    </form>
</div>


<div id="manage-route" data-csrf-token="{{ csrf_token() }}"
    data-success-info="{{ asset('assets/dashboard/img/info.png') }}"
    data-error-warning="{{ asset('assets/dashboard/img/warning.png') }}"
    data-stagename-store="{{ route('escort.stagename.store') }}"
    data-stagename-delete="{{ route('escort.stagename.delete') }}"
    data-stage-names="{{ json_encode($stage_names ?? []) }}"
    data-additional-store="{{ route('escort.additional.store') }}"
    data-additional-delete="{{ route('escort.additional.delete') }}" data-address="{{ json_encode($address) }}"
    data-title="{{ json_encode($title) }}" data-narrations="{{ json_encode($narration) }}"
    data-update-default-additional="{{ route('escort.additional.update_default') }}"></div>
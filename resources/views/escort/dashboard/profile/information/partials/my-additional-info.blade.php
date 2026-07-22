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
        transform: translateY(-50%);
        font-size: 18px;
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
        height: 38px;
        border-radius: 8px;
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
    <form id="update_about_me" action="#" method="POST" enctype="multipart/form-data">

        <!-- upload video  -->
        <div class="about_me_drop_down_info ">


            <div
                class="about_me_heading_in_first_tab fill_profile_headings_global custom--headingbod custom--social-head">
                <h2>My Additional Information</h2>
                <span class="custom--help"><b>Help?</b></span>
            </div>
            <div class="custom-note-section">
                <div class="card" style="">
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
            <div class="padding_20_all_side pb-0 custom-removemargin">

                {{-- stage name --}}
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1" style="font-size: 18px;">
                                <h2>Stage Names</h2>
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top"
                                    title="You can create as many as you like. Select your Stage Name from the drop down list that will appear in the Profile creator."
                                    data-boundary="window">

                            </label>
                            <div class="col-sm-12 stageListParent pl-1">
                                <div class="col-sm-12 pl-0">
                                    <input type="text" class="form-control form-control-sm" id="stage_name"
                                        placeholder="Enter stage name">
                                    <div class="invalid-feedback error-message"></div>
                                </div>
                                <div><span><b>Note:</b> <i>Save your new Stage Names before you apply the Sort
                                            feature.</i></span></div>

                                <div class="col-sm-12" style="display: ruby; padding-left: 0px;">
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
                                            {{-- JS se dynamically render hoga --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button id="read-more" type="button"
                                            class="save_stage_name_button">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}


                {{-- stage address --}}
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1" style="font-size: 18px;">
                                <h2>Street Address</h2>
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}" data-toggle="tooltip"
                                    data-html="true" data-placement="top"
                                    title="You can create as many as you like. Ideally, if you Tour, create the
                                    addresses for the apartments / hotels you stay at in each Location."
                                    data-boundary="window">

                            </label>

                            <div class="col-sm-12 stageListParent pl-1">
                                <div class="col-sm-12 pl-0">
                                    <input type="text" class="form-control form-control-sm" id="st_address"
                                        placeholder="Enter street address">
                                    <div class="invalid-feedback error-message"></div>
                                </div>
                                <div> <span><b>Note:</b> <i>Save your Addresses before you apply the Sort
                                            feature.</i></span></div>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
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
                                {{-- append cards --}}
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageAddress">
                                            {{-- Js append here --}}

                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="save_address_button">Save</button>
                                    </div>
                                </div>
                                {{-- end --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}


                {{-- Who Am I (Tittle) --}}
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1" style="font-size: 18px;">
                                <h2>Who Am I (Tittle)</h2>
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                    data-toggle="tooltip" data-html="true" data-placement="top"
                                    title="You can create as many Titles as you like." data-boundary="window">

                            </label>

                            <div class="col-sm-12 stageListParent pl-1">
                                <div class="input-group mb-3">  
                                    <div class="input-group-prepend pl-0 emoji-input-wrapper">    
                                        <span class=" emoji-btn" id="emojiBtn">😊</span>  
                                    </div>  
                                        <input type="text" class="form-control form-control-sm" id="who_title" placeholder="Enter title">
                                         <div class="invalid-feedback error-message"></div>
                                        <emoji-picker id="emojiPicker"></emoji-picker>
                                </div>


                                <div> <span><b>Note:</b> <i>Save your Titles before you apply the Sort
                                            feature.</i></span></div>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
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
                                {{-- append cards --}}
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageTitleList">
                                            {{-- js append here --}}

                                        </ul>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="save_title_button">Save</button>
                                    </div>
                                </div>
                                {{-- end --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}


                {{-- Who Am I (Narration) --}}
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1" style="font-size: 18px;">
                                <h2>Who Am I (Narration)</h2>
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                    data-toggle="tooltip" data-html="true" data-placement="top"
                                    title="You can create as many Narrations as you like." data-boundary="window">
                            </label>
                            <div class="col-sm-12 stageListParent pl-1">
                                <div class="col-sm-12 pl-0">
                                    <textarea class="form-control mt-2 h-100" id="who_narration_textarea" name="narration"
                                        placeholder="Maximum limit of 2,500 characters."></textarea>
                                    <div id="who_narration_textarea-error" class="error-message"></div>

                                </div>

                                <div> <span><b>Note:</b> <i>Save your Narrations before you apply the Sort feature.
                                        </i></span></div>
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
                                {{-- append cards --}}
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageNarration">
                                            {{-- js append here --}}

                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="save_narration_button">Save</button>
                                    </div>
                                </div>
                                {{-- end --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}

            </div>
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

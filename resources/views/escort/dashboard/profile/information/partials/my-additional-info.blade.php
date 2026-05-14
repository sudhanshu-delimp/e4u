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
                                </div>
                                <div><span><b>Note:</b> <i>Save your new Stage Names before you apply the Sort
                                            feature.</i></span></div>

                                <div class="col-sm-12" style="display: ruby; padding-left: 0px;">
                                    <label>Sort By : </label>
                                    <div class="pt-4 pb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortedByStageName"
                                                id="stageNameAlphabetically" value="alphabetically" checked>

                                            <label class="form-check-label" for="stageNameAlphabetically">
                                                Alphabetical (A–Z)
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sortedByStageName"
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
                                </div>
                                <div> <span><b>Note:</b> <i>Save your Addresses before you apply the Sort
                                            feature.</i></span></div>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{ $escort->covidreport }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByStageAddress" type="radio"
                                                name="sortedByStageAddress" id="addressAlphabetically" value="alphabetically"
                                                checked>
                                            <label class="form-check-label" for="addressAlphabetically">Location
                                                (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByStageAddress" type="radio"
                                                name="sortedByStageAddress" id="addressRandom" value="random">
                                            <label class="form-check-label" for="addressRandom">Random</label>
                                        </div>
                                    </div>

                                </div>
                                {{-- append cards --}}
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageAddress">
                                            <li style="font-size: 14px; background:#0C223D !important;"
                                                class="show_details"> <a href="#">Sydney</a>
                                                <div class="close ml-2 text-white stage-close" aria-label="Close">
                                                    <span aria-hidden="true" class="delete_stname"
                                                        id="Sydney">×</span>
                                                    <small class="mytool-tip">Remove</small>
                                                </div>
                                                <input type="hidden" name="name[]" value="Sydney">
                                                <div class="details_tooltip">
                                                    123, ABC Street, New South Wales, 2000
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                {{-- end --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}


                {{-- Who Am I (Title) --}}
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group row tab-about-me-row-padding">
                            <label class="col-sm-3 font-weight-500 small-icon custom--stathead  custom--stathead--flex"
                                for="exampleFormControlSelect1" style="font-size: 18px;">
                                <h2>Who Am I (Title)</h2>
                                <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"
                                    data-toggle="tooltip" data-html="true" data-placement="top"
                                    title="You can create as many Titles as you like." data-boundary="window">

                            </label>

                            <div class="col-sm-12 stageListParent pl-1">
                                <div class="col-sm-12 pl-0">
                                    <input type="text" class="form-control form-control-sm" id="who_title"
                                        placeholder="Enter title">
                                </div>
                                <div> <span><b>Note:</b> <i>Save your Titles before you apply the Sort
                                            feature.</i></span></div>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{ $escort->covidreport }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByStageTitle" type="radio"
                                                name="sortedByStageTitle" id="stageNameAlphabetically" value="alphabetically"
                                                checked>
                                            <label class="form-check-label" for="stageNameAlphabetically">Alphabetical
                                                (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByStageTitle" type="radio"
                                                name="sortedByStageTitle" id="stageNameRandom" value="random">
                                            <label class="form-check-label" for="stageNameRandom">Random</label>
                                        </div>
                                    </div>



                                </div>


                                {{-- append cards --}}
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageTitleList">
                                            <li style="font-size: 14px; background:#0C223D !important;"
                                                class="show_details">
                                                <a href="#" class="two_words">Sebastian Christopher Alexander
                                                    Montgomery</a>
                                                <div class="close ml-2 text-white stage-close" aria-label="Close">
                                                    <span aria-hidden="true" class="delete_stname"
                                                        id="Sydney">×</span>
                                                    <small class="mytool-tip">Remove</small>
                                                </div>
                                                <input type="hidden" name="name[]" value="Sydney">
                                                <div class="details_tooltip">
                                                    Sebastian Christopher Alexander Montgomery
                                                </div>
                                            </li>

                                        </ul>
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
                                    <textarea class="form-control mt-2 h-100" id="who_narration_textarea2"
                                        placeholder="Maximum limit of 2,500 characters."></textarea>


                                </div>
                                 


                                <div> <span><b>Note:</b> <i>Save your Narrations before you apply the Sort feature.
                                        </i></span></div>
                                <div class="col-sm-12 " style="display: ruby; padding-left: 0px;">
                                    <label for="">Sort By : </label>
                                    <div class="pt-4 pb-3" data-i="{{ $escort->covidreport }}">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByNarration" type="radio"
                                                name="sortedByNarration" id="narrationAlphabetically" value="alphabetically"
                                                checked>
                                            <label class="form-check-label" for="narrationAlphabetically">Alphabetical
                                                (A–Z)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input sortedByNarration" type="radio"
                                                name="sortedByNarration" id="narrationRandom" value="random">
                                            <label class="form-check-label" for="narrationRandom">Random</label>
                                        </div>
                                    </div>

                                </div>

                                {{-- append cards --}}
                                <div class="card-body active-play border-0 pt-0 pl-0 mt-1 pb-0 mb-0">
                                    <div class="at-lable  mt-0">
                                        <ul class="results" id="stageNarration">
                                            <li style="font-size: 14px; background:#0C223D !important;"
                                                class="show_details">
                                                <a href="#" class="two_words">I don’t put everything out here..
                                                    💋 my private link is where I get a lot more personal.</a>
                                                <div class="close ml-2 text-white stage-close" aria-label="Close">
                                                    <span aria-hidden="true" class="delete_stname"
                                                        id="Sydney">×</span>
                                                    <small class="mytool-tip">Remove</small>
                                                </div>
                                                <input type="hidden" name="name[]" value="Sydney">
                                                <div class="details_tooltip">
                                                    <span class="seven_words ">I don’t put everything out here.. 💋 my
                                                        private link is where I get a lot more personal.</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                {{-- end --}}


                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}


                {{-- <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="read-more" type="submit" class="save_profile_btn">Save</button>
                    </div>
                </div> --}}
            </div>
        </div>
    </form>
</div>


<div id="manage-route" data-csrf-token="{{ csrf_token() }}"
    data-success-info="{{ asset('assets/dashboard/img/info.png') }}"
    data-error-warning="{{ asset('assets/dashboard/img/warning.png') }}"
    data-stagename-store="{{ route('escort.stagename.store') }}"
    data-stagename-delete="{{ route('escort.stagename.delete') }}"
    data-stage-names="{{ json_encode($user['escorts_names'] ?? []) }}"></div>


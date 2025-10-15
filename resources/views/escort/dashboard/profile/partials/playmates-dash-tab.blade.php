
<div class="tab-pane fade {{$activeTab=='my-playmates'?'show active':''}}" id="playmates" role="tabpanel" aria-labelledby="my-playmates">
    <div class="col-lg-12">
        <div class="member-id pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z"
                    fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{ $loginAccount->member_id }}</span>
        </div>
    </div>
    <div class="about_me_drop_down_info profile-sec playmates-tab">
        @if ($editMode)
            @if($loginAccount->available_playmate==1)
                @if (!$escort->enabled)
                    <div class="row alert alert-info">Access to Playmate features requires a listed Escort Profile.</div>
                @else
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="mt-3 mb-0">My Playmates</h2>
                            <div class="form-group">
                                <label for="profileSearch"></label>
                                    <input type="text" class="form-control" id="profileSearch"
                                        placeholder="Search Member ID to add Playmate to the Profile...">
                            </div>
                        </div>
                    </div>  
                    <div class="row">  
                        <div class="col-lg-12 my-3">
                        @if ($editMode)
                            <form class="my-availability-mon-sun" id="myplaymates"
                                action="{{ route('escort.store.playmates', [$escort->id]) }}" method="Post">
                                @csrf
                        @endif
                            
                                <div class="playmates-card-grid">
                                        
                                </div>
                        @if ($editMode)
                            <div class="row pt-3">
                                <div class="col-md-12 text-right" style="padding-right: 1.8rem;">
                                    <button id="my_playmates" type="submit" class="save_profile_btn">Update</button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                        @endif    
                    </div>
                @endif
            @else
                <div class="row alert alert-info">You are not presently available as a Playmate.<a href="{{route('escort.profile.information')}}">Go to My Playmate settings</a>&nbsp;to enable.</div> 
            @endif
        @else
            <div class="row alert alert-info">Access to Playmate features requires a listed Escort Profile.</div>
        @endif 
    </div>
    
<!-- check out btns -->

<div class="tab_btm_btns_preview_and_next">
    <div class="row pt-3 pb-3">
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 a_text_white_hover previous_bt_center_in_sm">
            <a class="nex_sterp_btn btn_width_hundred" id="contact-tab" data-toggle="tab" href="#available"
                role="tab" aria-controls="contact" aria-selected="true">
                <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
            @if ($editMode)
                <a data-toggle="modal" data-id="{{ $escort->id }}" data-target="#view-listing"
                    class="save_profile_btn preview-profile" href="#">Preview</a>
            @else
            <button id="show_draft-2" name="save" type="submit" class="nex_sterp_btn">Save Profile</button>
            @endif
        </div>
    </div>
</div>
<!-- check out btns -->
</div>

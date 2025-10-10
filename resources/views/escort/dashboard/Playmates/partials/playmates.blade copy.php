<style type="text/css">
    .parsley-errors-list {
        list-style: none;
    }

    .at-sec {
        position: relative;
        width: 450px;
    }

    .at-lable {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .at-lable label {
        width: 70%;
        font-size: 16px;
        font-weight: 400;
        margin: 0;
    }

    .at-sec input {
        height: 36px;
        width: 100%;
        padding: 0px 10px 0px 30px;
        background: white url({{asset('avatars/Vector-24.svg')}}) 8px 8px no-repeat;
        border-radius: 3px;
        border: 1.8px solid #d1d3e2;
        font-size: 13px;
        font-weight: 400;
        color: #d1d3e2;
    }

    .at-sec input:focus {
        outline: none;
        border-color: #d1d3e2;
    }

    .at-sec li:focus + .results {
        display: block
    }

    .at-sec .results {
        display: none;
        position: absolute;
        top: 40px;
        left: 0;
        right: 0;
        z-index: 10;
        padding: 0;
        margin: 0;
        padding-left: 11.2rem;
        border-radius: 0.5px solid #C4C4C4;
    }

    .at-sec div.myacording-design .card .card-body ol li, div.myacording-design .card .card-body ul li, div.myacording-design .card .card-body p {
        margin-bottom: 0;
        background: #fff;
        box-shadow: 0px 4px 4px rgb(0 0 0 / 25%);
    }

    .at-sec .results li {
        display: block;
        width: 270px;
    }

    /*.at-sec .results li:first-child { margin-top: -1px }*/
    .at-sec .results li:first-child:before, .search .results li:first-child:after {
        display: block;
        content: '';
        width: 0;
        height: 0;
        position: absolute;
        left: 50%;
        margin-left: -5px;
        border: 5px outset transparent;
    }

    .at-sec .results li:first-child:after {
        border-bottom: 5px solid #fdfdfd;
        top: -10px;
    }

    .at-sec .results li:first-child:hover:before, .search .results li:first-child:hover:after {
        display: none
    }

    .at-sec .results li:last-child {
        margin-bottom: -1px
    }

    .at-sec .results a {
        display: block;
        position: relative;
        padding: 10px 40px 10px 10px;
        color: #000;
        font-weight: 500;
        font-size: 14px;
    }

    .at-sec .results a:hover {
        text-decoration: none;
        color: #fff;
        text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
        border-color: #0C223D;
        background-color: #0C223D;
    }

    .active-play .at-lable {
        display: block;
    }

    .active-play ul {
        display: flex;
        padding: 0px;
        top: 0;
        position: relative;
        list-style: none;
        gap: 10px;
    }

    .active-play li {
        padding: 10px;
        border-radius: 3px;
        background: #0C223D !important;
    }

    .active-play a {
        color: #fff;
        display: flex;
        gap: 10px;
    }

</style>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-md-12  fill_profile_headings_global custom--social-head">
            <h2>My Playmates</h2>
            <span class="custom--help"><b>Help?</b></span>
        </div>
        <div class="custom-note-section">
            <div class="card" style="">
                <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                    <ol class=" mb-0">
                        <li>
                            By activating this feature:
                            <ol type="a" class="ol_lower_alpha_bracket">
                                <li>your Profiles can be searched for by other Escorts; and</li>
                                <li>the Playmates listed under My Active Playmates will by default appear in your
                                    Profile creator. You should check with the Escort they are still available as a
                                    Playmate before creating a Profile. A Viewer will be able to view the Playmate’s
                                    Profile from your Profile.</li>
                            </ol>
                        </li>
                        <li>You can over ride these settings when creating a Profile, provided you
                            have enabled the feature (see My Account - Profile & Tour options).
                        </li>
                        <li>
                            You can search for other Escorts to link up as your Playmate by searching
                            either their Account Name or Membership ID. We recommend you search
                            by Membership ID which always appears at the top of any of the Escort's
                            Profiles.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            {{--<div class="card collapse" id="notes">
                <div class="card-body">
                    <h2 class="primery_color normal_heading"><b>Notes:</b></h2>
                    <ol class="mb-0">

                    </ol>
                </div>
            </div>--}}
            <div class="card-body border-0 pt-0 mt-0 p-0">
                <div class="mb-1">
                    @php
                        $playmate = auth()->user()->available_playmate
                    @endphp
                    <input type="checkbox" class="form-controll" value="Y" id="playmate"
                           name="available_playmate" {{(($playmate) ? "checked" : '' )}}/> <label for="playmate"
                                                                                                  style="display: inline;">I
                        am available as a Playmate</label>
                </div>
                <div class="col-lg-12 my-3">
                    <h2 class="custom-head py-3">My Active Playmates</h2>
                    <form>
                        <!-- Playmate Card -->
                        <div class="playmates-card-grid">
                            <div class="card shadow-sm border-0 p-0">
                                <img src="{{ asset('assets/dashboard/img/girl.jpg') }}" class="card-img-top" alt="Playmate 1">
                                <div class="card-body border-0 mt-0 px-2 py-3">
                                    <h3>My Playmates</h3>
                                    <div class="form-check-inline">
                                        <input class="form-check-input"
                                            type="checkbox" id="playmate{{$escort->id}}" name="playmate[]" value="{{$escort->id}}" {{($escort->is_playmate)?'checked':''}}>
                                            <label class="form-check-label ml-2" for="playmate{{$escort->id}}">Add as playmate</label> 
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-end my-3">
                            <button type="submit" class="save_profile_btn">Save</button>
                        </div>
                        
                            
                    </form>
                </div>
            </div>
            <hr style="background-color: #0C223D">
            <div class="card-body active-play border-0 pt-0 mt-1 p-0">
                <div class="mt-0">
                    <ul class="results  mt-2 activePlaymate">
                        @if(!is_null(auth()->user()->playmates))
                            @foreach(auth()->user()->playmates as $playmate)
                                <li id="rmlist_{{$playmate->id}}" class="d_my_tooltip"><a
                                        href="{{ route('profile.description',$playmate->id)}}" target="_blank">
                                        <img
                                            src="{{ $playmate->DefaultImage ? asset($playmate->DefaultImage) : asset('assets/app/img/icons-profile.png') }}"
                                            class="img-profile rounded-circle playmats-img">{{$playmate->user->member_id . ' - ' .$playmate->name}}
                                    </a>
                                    <span class="playmates_rmid" value="{{$playmate->id}}">×</span>
                                    <small class="mytool-tip">Remove</small>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    
                    <div class="col-lg-12 my-3">
                        <h2 class="custom-head py-3">Me as a Playmate Added By Others</h2>
                        <form>
                            <!-- Playmate Card -->
                            <div class="playmates-card-grid">
                                <div class="card shadow-sm border-0 p-0">
                                    <img src="{{ asset('assets/dashboard/img/girl.jpg') }}" class="card-img-top" alt="Playmate 1">
                                    <div class="card-body border-0 mt-0 px-2 py-3">
                                        <h3>My Playmates</h3>
                                        <div class="form-check-inline">
                                            <input class="form-check-input"
                                                type="checkbox" id="playmate{{$escort->id}}" name="playmate[]" value="{{$escort->id}}" {{($escort->is_playmate)?'checked':''}}>
                                                <label class="form-check-label ml-2" for="playmate{{$escort->id}}">Included as a playmate</label> 
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="save_profile_btn">Save</button>
                            </div>
                            
                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
   
@push('script')

<script>
    $("#playmate").on('click', function(e) {
        let isAvailable = $(this).is(':checked')?1:0;
        var url = "{{route('user.update.playmate')}}";
        $.ajax({
            method: "GET",
            url: url,
            data:{'available_playmate': isAvailable},
            success: function (data) {
            }
        });
    });
</script>
@endpush

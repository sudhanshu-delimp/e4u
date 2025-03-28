@if($escort->playmates->count() == 0)
<div class="card text-center">
    <div class="card-body">
        <h5 class="card-title">This profile has no playmate</h5>
    </div>
</div>
@else
<div class="box_shadow manage_padding_margin_bg_color">
    <div class="padding_20_tob_btm_side">
        <div class="text-center text-muted well well-sm no-shadow">
            <h5> Playmates</h5>
        </div>
        <div class="row">
            
            @foreach($escort->playmates as $playmate)
            <div class="col-md-6 col-sm-6 mb-4">
                <div class="d-flex align-items-center gap_between_text_and_img">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="{{ $playmate->default_image }}" alt="User profile picture">
                    </div>
                    <div class="profile-username text-center">
                        <p class="suggase_profile_name">{{ $playmate->name }}</p>
                    </div>
                    <p>{{ $playmate->member_id }}</p>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> 
                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <a class="dropdown-item" href="{{ route('profile.description', $playmate->id) }}" data-id="3">View</a> 
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item remove-playmate" href="#" data-escort_id="{{ $escort->id }}" data-playmate_id="{{ $playmate->id }}" data-name="Floater Cruise" data-category="3">Remove</a> 
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
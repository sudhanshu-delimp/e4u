@if ($escorts->count() > 0)
    @foreach ($escorts as $escort)
        @php  
        $image = $escort->gallary()->wherePivot('position', 1)->first();
        @endphp
        <div class="card shadow-sm">
           <a href="{{ route('profile.description',$escort->id)}}" target="_blank">
            <img src="{{ asset($image->path) }}" class="card-img-top" alt="Playmate 1">
            <span class="playmate-badge">{{$escort->user->member_id}}</span>
           </a>
            <div class="card-body">
                <h3>{{$escort->name}}</h3>
                <div class="form-check-inline">
                    <input class="form-check-input"
                        type="checkbox" id="playmate{{$escort->id}}" name="{{$searchValue?'add_playmate[]':'update_playmate[]'}}" value="{{$escort->id}}" {{($escort->is_playmate)?'checked':''}}>
                        <label class="form-check-label ml-2" for="playmate{{$escort->id}}">{{($escort->is_playmate)?'Included as Playmate':'Add as Playmate'}}</label> 
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-info">The Member ID you have searched is not available.  Please check the Member ID is correct and they have a current Listed Profile.</div>
@endif

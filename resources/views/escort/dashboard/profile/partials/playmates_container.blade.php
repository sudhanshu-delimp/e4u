@if ($escorts->count() > 0)
    @foreach ($escorts as $escort)
        @php  
        $image = $escort->gallary()->wherePivot('position', 1)->first();
        @endphp
        <div class="card shadow-sm">
            <img src="{{ asset($image->path) }}" class="card-img-top" alt="Playmate 1">
            <div class="card-body">
                <h3>{{$escort->name}}</h3>
                <div class="form-check-inline">
                    <input class="form-check-input"
                        type="checkbox" id="playmate{{$escort->id}}" name="playmate[]" value="{{$escort->id}}" {{($escort->is_playmate)?'checked':''}}>
                        <label class="form-check-label ml-2" for="playmate{{$escort->id}}">{{($escort->is_playmate)?'Included as Playmate':'Add as Playmate'}}</label> 
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-info">You do not presently have any Playmates.</div>
@endif

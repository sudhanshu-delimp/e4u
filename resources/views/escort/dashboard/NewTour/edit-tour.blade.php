@extends('layouts.escort')
@section('style')

@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">Create New </div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4 custom--tourdash" id="profile_and_tour_options">
            <div class="row collapse" id="notes">
                <div class="col-md-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to create a new Tour. The Tour creator is fully automated and will remember your Profile and Location selections.</li>
                              <li>Make sure you have <a href="/escort-dashboard/view-archives">created</a> all the Profiles you want to use on this Tour before you start. You can add more than one Profile per Location. A Profile will be posted and removed at midnight.</li>
                              <li>If you want your Profile to appear one day before you arrive at the Location, make sure you have that <a href="/escort-dashboard/update-account">feature</a> enabled.</li>
                              <li>If you change your schedule and will be staying longer or leaving sooner than the scheduled dates in your Tour, remember to <a href="/escort-dashboard/edit-tour">update</a> your Tour to reflect the new dates.</li>
                          </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center tour-dashrow">
                <div class="col-md-8 tour-dashcol">
                <div class="card shadow-sm">
    <div class="card-body">
        <form id="locationForm">
            <!-- Tour Name Input -->
            <div class="mb-3">
                <label for="tourName" class="form-label fw-bold">Tour Name</label>
                <input type="text" id="tourName" name="tour_name" class="form-control" value="{{$tour->name}}"  placeholder="Enter Tour Name">
            </div>

            <div id="locationsContainer" class="mb-3">
                @foreach($tourLocations as $tourLocation)
                <div class="location-group">
                    <div class="card p-3 mb-3 shadow-sm">
                        <h5 class="card-title">Location</h5>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="location[]" class="form-select location-dropdown" disabled="">
                                    @foreach($userLocations as $userLocation)
                                        <option value="{{$userLocation['id']}}" {{($tourLocation->state_id==$userLocation['id'])?'selected':''}}>{{$userLocation['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                            <input type="date" name="start_date[]" class="form-control start-date" value="{{$tourLocation->start_date}}" min="" disabled="">
                            </div>
                            <div class="col-md-3">
                            <input type="date" name="end_date[]" class="form-control end-date" value="{{$tourLocation->end_date}}" min="{{$tourLocation->start_date}}" disabled="">
                            </div>
                            <div class="col-md-2 d-flex gap-2">
                            <button type="button" class="btn btn-primary addProfile">Add Profile</button>
                            <button type="button" class="btn btn-danger removeLocation">Remove</button>
                            </div>
                        </div>
                        <div class="profiles mt-3">
                            @if(!empty($tourLocation->profiles->toArray()))
                                @foreach($tourLocation->profiles as $profile)
                                    <div class="profile">
                                        <div class="d-flex align-items-center gap-2 p-2 border rounded bg-light">
                                            <select name="profile[][]" class="form-select profile-dropdown w-25">
                                                <option value="{{$profile['escort_id']}}" selected>{{$profile->escort->name}}</option>
                                            </select>
                                            <select name="tour_plan[][]" class="form-select tour-plan-dropdown w-25">
                                                <option value="1" {{($profile['tour_plan']=='1'?'selected':'')}}>Platinum</option>
                                                <option value="2" {{($profile['tour_plan']=='2'?'selected':'')}}>Gold</option>
                                                <option value="3" {{($profile['tour_plan']=='3'?'selected':'')}}>Silver</option>
                                                <option value="4" {{($profile['tour_plan']=='4'?'selected':'')}}>Free</option>
                                            </select>
                                            <span class="profile-dates text-muted">Start: {{$tourLocation->start_date}}, End: {{$tourLocation->end_date}}</span>
                                            <button type="button" class="btn btn-sm btn-danger removeProfile">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>

    <!-- Card Footer with Buttons -->
    <div class="card-footer bg-white d-flex gap-3 justify-content-end">
        <button type="button" id="addLocation" class="btn btn-primary px-4 py-2 rounded">
            <i class="fas fa-map-marker-alt"></i> Add Location
        </button>
        <button type="submit" id="saveButton" class="btn btn-success px-4 py-2 rounded" {{count($tourLocations)<2?'disabled':''}}>
            <i class="fas fa-save"></i> Save
        </button>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    const account_locations_route = "{{ route('account.locations') }}";
    const account_location_profiles_route = "{{ route('account.location_profiles') }}";
    const account_save_tour_route = "{{ route('account.update_tour', ['id' => $tour->id]) }}";
</script>
<script src="{{ asset('js/escort/add_edit_tour.js') }}"></script>
@endpush

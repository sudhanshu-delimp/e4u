@extends('layouts.escort')
@section('style')

@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">Create New Tour</div>
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
                              <li>Make sure you have <a href="/escort-dashboard/view-archives" class="custom_links_design">created</a> all the Profiles you want to use on this Tour before you start. You can add more than one Profile per Location. A Profile will be posted and removed at midnight.</li>
                              <li>If you want your Profile to appear one day before you arrive at the Location, make sure you have that <a href="/escort-dashboard/update-account" class="custom_links_design">feature</a> enabled.</li>
                              <li>If you change your schedule and will be staying longer or leaving sooner than the scheduled dates in your Tour, remember to <a href="/escort-dashboard/edit-tour" class="custom_links_design">update</a> your Tour to reflect the new dates.</li>
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
                <input type="text" id="tourName" name="tour_name" class="form-control"  placeholder="Enter Tour Name">
            </div>

            <div id="locationsContainer" class="mb-3">
            
            </div>
        </form>
    </div>

    <!-- Card Footer with Buttons -->
    <div class="card-footer bg-white d-flex gap-3 justify-content-end">
        <button type="button" id="addLocation" class="btn btn-primary px-4 py-2 rounded">
            <i class="fas fa-map-marker-alt"></i> Add Location
        </button>
        <button type="submit" id="saveButton" class="btn btn-success px-4 py-2 rounded" disabled>
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
    const account_save_tour_route = "{{ route('account.save_tour') }}";
</script>
<script src="{{ asset('js/escort/add_edit_tour.js') }}"></script>
@endpush

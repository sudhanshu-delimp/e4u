@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">Create New Tour</div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" id="profile_and_tour_options">
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form id="locationForm" class="container mt-4 p-3 border rounded shadow-sm bg-light">
                        <div id="locationsContainer" class="mb-3"></div>

                        <div class="d-flex gap-2">
                            <button type="button" id="addLocation" class="btn btn-primary">Add Location</button>
                            <button type="submit" id="saveButton" class="btn btn-success" disabled>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<!-- <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", async function () {
    let locationsContainer = document.getElementById("locationsContainer");
    let addLocationButton = document.getElementById("addLocation");
    let saveButton = document.getElementById("saveButton");

    let locationOptions = await fetchLocations(); // Fetch locations dynamically
    let profileOptions = {}; // Store profiles dynamically per location

    addLocationButton.addEventListener("click", function () {
        let previousLocations = document.querySelectorAll(".location-group");
        let lastEndDate = previousLocations.length ? previousLocations[previousLocations.length - 1].querySelector(".end-date").value : null;

        let availableLocations = getAvailableLocations();
        if (availableLocations.length === 0) {
            alert("No more locations available.");
            return;
        }

        let newLocation = document.createElement("div");
        newLocation.classList.add("location-group");

        let nextStartDate = lastEndDate ? getNextDate(lastEndDate) : "";

        newLocation.innerHTML = `
    <div class="card p-3 mb-3 shadow-sm">
        <h5 class="card-title">Location</h5>
        <div class="row g-2">
            <div class="col-md-4">
                <select name="location[]" class="form-select location-dropdown">
                    ${availableLocations.map(loc => `<option value="${loc.id}">${loc.name}</option>`).join("")}
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="start_date[]" class="form-control start-date" value="${nextStartDate}" min="${nextStartDate}">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date[]" class="form-control end-date">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="button" class="btn btn-primary addProfile">Add Profile</button>
                <button type="button" class="btn btn-danger removeLocation">Remove</button>
            </div>
        </div>
        <div class="profiles mt-3"></div>
    </div>
`;

        locationsContainer.appendChild(newLocation);
        updateSaveButton();
        updateAllEndDatesMin();
        updateProfileButtonState(newLocation);
    });

    locationsContainer.addEventListener("click", async function (event) {
        let target = event.target;

        if (target.classList.contains("addProfile")) {
            let locationGroup = target.closest(".location-group");
            let profilesContainer = locationGroup.querySelector(".profiles");
            let startDate = locationGroup.querySelector(".start-date").value;
            let endDate = locationGroup.querySelector(".end-date").value;
            let selectedLocation = locationGroup.querySelector(".location-dropdown").value;

            if (!profileOptions[selectedLocation]) {
                profileOptions[selectedLocation] = await fetchProfiles(selectedLocation);
            }

            let availableProfiles = getAvailableProfiles(profilesContainer, profileOptions[selectedLocation]);

            if (availableProfiles.length === 0) {
                alert("No more profiles available for this location.");
                return;
            }

            let profileRow = document.createElement("div");
            profileRow.classList.add("profile");
            profileRow.innerHTML = `
            <div class="d-flex align-items-center gap-2 p-2 border rounded bg-light">
    <select name="profile[][]" class="form-select profile-dropdown w-25">
        ${availableProfiles.map(profile => `<option value="${profile.id}">${profile.name}</option>`).join("")}
    </select>
    
    <select name="tour_plan[][]" class="form-select tour-plan-dropdown w-25">
        <option value="">Select Tour Plan</option>
        <option value="standard">Standard</option>
        <option value="premium">Premium</option>
        <option value="custom">Custom</option>
    </select>

    <span class="profile-dates text-muted">Start: ${startDate}, End: ${endDate}</span>
    
    <button type="button" class="btn btn-sm btn-danger removeProfile">Remove</button>
</div>
`;

            profilesContainer.appendChild(profileRow);
            updateSaveButton();
            lockLocationFields(locationGroup, true);
            updateProfileDropdowns(locationGroup);
        }

        if (target.classList.contains("removeProfile")) {
            let locationGroup = target.closest(".location-group");
            target.closest(".profile").remove();

            if (locationGroup.querySelectorAll(".profile").length === 0) {
                lockLocationFields(locationGroup, false);
            }
            updateSaveButton();
            updateProfileDropdowns(locationGroup);
        }

        if (target.classList.contains("removeLocation")) {
            target.closest(".location-group").remove();
            updateSaveButton();
            updateLocationDropdowns();
        }
    });

    locationsContainer.addEventListener("change", async function (event) {
        let target = event.target;
        let locationGroup = target.closest(".location-group");
        
        if (target.classList.contains("start-date") || target.classList.contains("end-date")) {
            let newStartDate = locationGroup.querySelector(".start-date").value;
            let newEndDate = locationGroup.querySelector(".end-date").value;
            locationGroup.querySelectorAll(".profile-dates").forEach(span => {
                span.innerText = `Start: ${newStartDate}, End: ${newEndDate}`;
            });
            updateProfileButtonState(locationGroup);
        }

        if (target.classList.contains("location-dropdown")) {
            let selectedLocation = target.value;
            profileOptions[selectedLocation] = await fetchProfiles(selectedLocation);
            updateProfileDropdowns(locationGroup);
        }

        if (target.classList.contains("profile-dropdown")) {
            updateProfileDropdowns(locationGroup);
        }
    });

    async function fetchLocations() {
        try {
            let response = await fetch(`{{route('account.locations')}}`);
            let data = await response.json();
            return data || [];
        } catch (error) {
            console.error("Error fetching locations:", error);
            return [];
        }
    }

    async function fetchProfiles(location) {
        try {
            let response = await fetch(`{{ route('account.location_profiles') }}?state_id=${encodeURIComponent(location)}`);
            let data = await response.json();
            return data || [];
        } catch (error) {
            console.error("Error fetching profiles:", error);
            return [];
        }
    }

    function getAvailableLocations() {
        let selectedLocations = Array.from(document.querySelectorAll(".location-dropdown"))
            .map(select => select.value);
        return locationOptions.filter(loc => !selectedLocations.includes(loc.id));
    }

    function getAvailableProfiles(profilesContainer, allProfiles) {
        let selectedProfiles = new Set(
            Array.from(profilesContainer.querySelectorAll(".profile-dropdown"))
                .map(select => select.value)
        );

        return allProfiles.filter(profile => !selectedProfiles.has(String(profile.id)));
    }

    function getNextDate(date) {
        let nextDate = new Date(date);
        nextDate.setDate(nextDate.getDate() + 1);
        return nextDate.toISOString().split("T")[0];
    }

    function lockLocationFields(locationGroup, lock) {
        locationGroup.querySelector(".location-dropdown").disabled = lock;
        locationGroup.querySelector(".start-date").disabled = lock;
        locationGroup.querySelector(".end-date").disabled = lock;
    }

    function updateSaveButton() {
    let locationGroups = document.querySelectorAll(".location-group");

    // The button should be disabled if less than 2 locations exist
    if (locationGroups.length < 2) {
        saveButton.disabled = true;
        return;
    }

    // Check if every location has at least one profile
    for (let location of locationGroups) {
        let profiles = location.querySelectorAll(".profile-dropdown");
        if (profiles.length === 0) {
            saveButton.disabled = true;
            return;
        }
    }

    // Enable the save button if both conditions are met
    saveButton.disabled = false;
}

    function updateProfileDropdowns(locationGroup) {
        let profilesContainer = locationGroup.querySelector(".profiles");
        let allProfiles = profileOptions[locationGroup.querySelector(".location-dropdown").value] || [];

        let selectedProfiles = new Set(
            Array.from(profilesContainer.querySelectorAll(".profile-dropdown"))
                .map(select => select.value)
        );

        profilesContainer.querySelectorAll(".profile-dropdown").forEach(dropdown => {
            let selectedValue = dropdown.value;

            let filteredProfiles = allProfiles.filter(profile => 
                !selectedProfiles.has(String(profile.id)) || profile.id == selectedValue
            );

            dropdown.innerHTML = filteredProfiles
                .map(profile => `<option value="${profile.id}" ${profile.id == selectedValue ? "selected" : ""}>${profile.name}</option>`)
                .join("");
        });
    }

    function updateAllEndDatesMin() {
    document.querySelectorAll(".location-group").forEach(locationGroup => {
        let startDateInput = locationGroup.querySelector(".start-date");
        let endDateInput = locationGroup.querySelector(".end-date");

        if (startDateInput && endDateInput) {
            endDateInput.min = startDateInput.value;

            // If the end date is before the start date, reset it
            if (endDateInput.value < startDateInput.value) {
                endDateInput.value = startDateInput.value;
            }
        }
    });
}

function updateProfileButtonState(locationGroup) {
    let startDate = locationGroup.querySelector(".start-date").value;
    let endDate = locationGroup.querySelector(".end-date").value;
    let addProfileButton = locationGroup.querySelector(".addProfile");

    addProfileButton.disabled = !(startDate && endDate);
}
});

</script>
@endpush

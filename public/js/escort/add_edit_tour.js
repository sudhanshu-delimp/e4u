document.addEventListener("DOMContentLoaded", async function() {
            let locationsContainer = document.getElementById("locationsContainer");
            let addLocationButton = document.getElementById("addLocation");
            let saveButton = document.getElementById("saveButton");

            let locationOptions = await fetchLocations(); // Fetch locations dynamically
            let profileOptions = {}; // Store profiles dynamically per location

            addLocationButton.addEventListener("click", function() {
                        let previousLocations = document.querySelectorAll(".location-group");
                        let lastEndDate = previousLocations.length ? previousLocations[previousLocations.length - 1].querySelector(".end-date").value : null;
                        
                        let availableLocations = getAvailableLocations();
                        if (availableLocations.length === 0) {
                            Swal.fire({
                                title: 'Tour',
                                text: `No more locations available.`,
                                icon: 'warning'
                            });
                            return;
                        }

                        let newLocation = document.createElement("div");
                        newLocation.classList.add("location-group");

                        let nextStartDate = lastEndDate ? getNextDate(lastEndDate) : "";
                        newLocation.innerHTML = `
        <div class="card p-3 mb-3 shadow-sm">
        <!--- <h5 class="card-title">Location</h5>-->
        <div class="listing-row">
            <div class="listing-field">
             <label for="location">Location:</label>
                <select name="location[]" class="form-select form-control location-dropdown">
                    ${availableLocations.map(loc => `<option value="${loc.id}">${loc.name}</option>`).join("")}
                </select>
            </div>
            <div class="listing-field">
                <label for="start-date">Start Date:</label>
                <input type="text" name="start_date[]" class="form-control start-date js_datepicker" value="${nextStartDate}">
            </div>
            <div class="listing-field">            
                <label for="end-date">End Date:</label>
                <input type="text" name="end_date[]" class="form-control end-date js_datepicker" value="${nextStartDate}">
            </div>
            <div class="d-flex align-items-end justify-content-end gap-10">
                <button type="button" class="btn-success-modal addProfile" style="padding:6px 10px;">Add Profile</button>
                <button type="button" class="btn-cancel-modal removeLocation" style="padding:6px 10px;">Remove</button>
            </div>
        </div>
        <div class="profiles mt-3"></div>
        </div>
        `;

        locationsContainer.appendChild(newLocation);
        initJsDatePicker();
        updateSaveButton();
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

           // if (!profileOptions[selectedLocation]) {
                profileOptions[selectedLocation] = await fetchProfiles(selectedLocation, startDate, endDate);
           // }

            let availableProfiles = getAvailableProfiles(profilesContainer, profileOptions[selectedLocation]);

            if (availableProfiles.length === 0) {
                Swal.fire({
                    title: 'Tour',
                    text: `No more profiles available for this location.`,
                    icon: 'warning'
                });
                return;
            }

            let profileRow = document.createElement("div");
            profileRow.classList.add("profile");
            profileRow.innerHTML = `
            <div class="d-flex align-items-center gap-2 p-2 border rounded bg-light my-2">
            <select name="profile[][]" class="form-select profile-dropdown-inprocess w-25">
            ${availableProfiles.map(profile => `<option value="${profile.id}">${profile.name}</option>`).join("")}
            </select>

            <select name="tour_plan[][]" class="form-select tour-plan-dropdown w-25">
            <option value="1" >Platinum</option>
            <option value="2">Gold</option>
            <option value="3" >Silver</option>
            <option value="4">Free</option>
            </select>

            <span class="profile-dates text-muted">Start: ${startDate}, End: ${endDate}</span>

            <button type="button" class="btn btn-sm btn-danger removeProfile">Remove</button>
            </div>
            `;

            profilesContainer.appendChild(profileRow);
            initJsDatePicker();
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
            getAvailableLocations();
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
            profileOptions[selectedLocation] = await fetchProfiles(selectedLocation,newStartDate,newEndDate);
            updateProfileDropdowns(locationGroup);
        }

        if (target.classList.contains("profile-dropdown-inprocess")) {
            updateProfileDropdowns(locationGroup);
        }
    });

    async function fetchLocations() {
        try {
            let response = await fetch(`${account_locations_route}`);
            let data = await response.json();
            return data || [];
        } catch (error) {
            console.error("Error fetching locations:", error);
            return [];
        }
    }

    async function fetchProfiles(location, startDate, endDate) {
        try {
            let response = await fetch(`${account_location_profiles_route}?state_id=${encodeURIComponent(location)}&start_date=${startDate}&end_date=${endDate}`);
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
            Array.from(profilesContainer.querySelectorAll(".profile-dropdown-inprocess"))
                .map(select => select.value)
        );

        return allProfiles.filter(profile => !selectedProfiles.has(String(profile.id)));
    }

    function getNextDate(dateStr) {
        let [day, month, year] = dateStr.split('-');
        let date = new Date(year, month - 1, day);
        date.setDate(date.getDate() + 1);
        return `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
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
        let profiles = location.querySelectorAll(".profile-dropdown-inprocess, .profile-dropdown");
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
        
        if(allProfiles.length==0){
            return false;
        }

        let selectedProfiles = new Set(
            Array.from(profilesContainer.querySelectorAll(".profile-dropdown-inprocess"))
                .map(select => select.value)
        );

        profilesContainer.querySelectorAll(".profile-dropdown-inprocess").forEach(dropdown => {
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
    let startDate = $(locationGroup).find(".start-date");
    let endDate = $(locationGroup).find(".end-date");
    let addProfileButton = locationGroup.querySelector(".addProfile");
    if(startDate.val()){
        startDate.datepicker('option', 'minDate', startDate.val());
        endDate.datepicker('option', 'minDate', startDate.val());
    }
    addProfileButton.disabled = !(startDate.val() && endDate.val());
}

    saveButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent form submission
        
        let formData = collectFormData();
        if (!formData) {
            Swal.fire({
                title: 'Tour',
                text: `Please fill in all required fields before saving.`,
                icon: 'warning'
            });
            return;
        }
        // return false;
        // Example: Submit via AJAX
        fetch(`${account_save_tour_route}`, {
            method: "POST",
            headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Tour',
                html: `${data.message}`,
                icon: 'success',
                confirmButtonText: "OK"
            }).then(() => {
                location.assign(`${window.App.baseUrl}escort-dashboard/list-tour/current`);
            });
        } else {
            Swal.fire({
                title: 'Tour',
                text: `Error saving tour: ${data.message}`,
                icon: 'error'
            });
        }
        })
        .catch(error => console.error("Error:", error));
    });

    function collectFormData() {
        let tourName = document.getElementById("tourName").value.trim();
        if (!tourName) {
            Swal.fire({
                title: 'Tour',
                text: `Please enter a Tour Name.`,
                icon: 'warnning'
            });
            return null;
        }

        let locations = [];
        document.querySelectorAll(".location-group").forEach(locationGroup => {
            let locationId = locationGroup.querySelector(".location-dropdown").value;
            let startDate = locationGroup.querySelector(".start-date").value;
            let endDate = locationGroup.querySelector(".end-date").value;
            let tour_location_id = locationGroup.querySelector('input[name="tour_location_id"]')?locationGroup.querySelector('input[name="tour_location_id"]').value:null;

            if (!locationId || !startDate || !endDate) {
                Swal.fire({
                    title: 'Tour',
                    text: `Please fill in all location details.`,
                    icon: 'warnning'
                });
                return null;
            }

            let profiles = [];
            locationGroup.querySelectorAll(".profile").forEach(profileDiv => {
                let profileId = profileDiv.querySelector(".profile-dropdown-inprocess,.profile-dropdown").value;
                let tourPlan = profileDiv.querySelector(".tour-plan-dropdown").value;
                let tour_profile_id = profileDiv.querySelector('input[name="tour_profile_id"]')?profileDiv.querySelector('input[name="tour_profile_id"]').value:null;
                if (!profileId || !tourPlan) {
                    Swal.fire({
                        title: 'Tour',
                        text: `Please select a profile and tour plan.`,
                        icon: 'warnning'
                    });
                    return null;
                }

                profiles.push({
                    id:tour_profile_id,
                    profile_id: profileId,
                    tour_plan: tourPlan
                });
            });
            
            if (profiles.length === 0) {
                Swal.fire({
                    title: 'Tour',
                    text: `Each location must have at least one profile.`,
                    icon: 'warnning'
                });
                return null;
            }

            locations.push({
                id:tour_location_id,
                location_id: locationId,
                start_date: startDate,
                end_date: endDate,
                profiles: profiles
            });
        });

        if (locations.length < 2) {
            Swal.fire({
                title: 'Tour',
                text: `You must add at least two locations.`,
                icon: 'warnning'
            });
            return null;
        }

        console.log({
            tour_name: tourName,
            locations: locations
        });
        //return false;
        return {
            tour_name: tourName,
            locations: locations
        };
    }

    $(document).on('change', 'input[name="start_date[]"]', function() {
        let $row = $(this).closest('.listing-row');
        let startDate = $(this).val();
        let endDate = $row.find('input[name="end_date[]"]');
        endDate.datepicker('option', 'minDate', startDate);
    });
});
let savePinupButton = document.getElementById("savePinupButton");
savePinupButton.disabled = true;
$(document).on('change','#pinup_profile_id', function(){
    let weekSelect = document.getElementById('pinup_week');
    let escortId = $(this).val();
    $.ajax({
        url: '/escort-dashboard/pinup-available-weeks/' + escortId,
        type: 'GET',
        success: function(weeks) {
            weekSelect.innerHTML = '<option value="">Select a week</option>';
            if(weeks.length>0){
                weeks.forEach(week => {
                    let label = `${week.start} (Mon)  -To-  ${week.end} (Sun)`;
                    let value = `${week.start}|${week.end}`;

                    let option = document.createElement('option');
                    option.value = value;
                    option.textContent = label;
                    weekSelect.appendChild(option);
                });
                savePinupButton.disabled = false;
            }
            else{
                weekSelect.innerHTML = '<option value="">Sorry, no weeks are available</option>';
                savePinupButton.disabled = true;
            }
        },
        error: function() {
            weekSelect.innerHTML = '<option value="">Error fetching weeks.</option>';
            savePinupButton.disabled = true;
        }
    });
});

savePinupButton.addEventListener("click", function (e) {
    e.preventDefault(); // Prevent form submission
    
    const button = e.target
    const form = button.closest('form');
    if (!form) {
        console.error("Form not found!");
        return;
    }
    const action = form.action;
    const method = form.method;
    const formData = new FormData(form);
    fetch(action, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.log('Submission error:', error);
    });
});
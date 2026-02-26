$(document).ready(function () {
    $(document).on('input', 'input[name="escort_mobile"]', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    $("#add_report_form").validate({
        rules: {
            incident_date: {
                required: true,
                date: true
            },
            incident_state: {
                required: true
            },
            incident_location: {
                required: true,
                minlength: 3
            },
            escort_mobile: {
                required: true,
                digits: true,
                maxlength: 10
            },
            escort_email: {
                email: true
            },
            incident_nature: {
                required: true
            },
            what_happened: {
                required: true,
            },
            rating: {
                required: true
            }
        },

        messages: {
            incident_date: "Please select incident date",
            incident_state: "Please select state",
            incident_location: {
                required: "Location is required",
                minlength: "Minimum 3 characters required"
            },
            escort_mobile: {
                required: "Mobile number required",
                digits: "Only numbers allowed",
                maxlength: "Maximum 10 digits"
            },
            escort_email: "Enter valid email",
            incident_nature: "Please select incident type",
            what_happened: {
                required: "Please describe incident",
            },
            rating: "Please select rating"
        },

        errorElement: "small",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        submitHandler: function (form) {
            let formData = $(form).serialize();
            $.ajax({
                url: $(form).attr("action"),
                type: "POST",
                data: formData,
                beforeSend: function () {
                    $(".save_profile_btn").prop("disabled", true).text("Saving...");
                },
                success: function (response) {

                    $(".save_profile_btn").prop("disabled", false).text("Add Report");
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Punterbox Report Submitted',
                            html: `
                                    <p>Your report has been successfully submitted.</p>
                                `,
                            confirmButtonText: 'Go to My Reports'
                        }).then(() => {
                            window.location.href = "/user-dashboard/punterbox/my-report";
                        });
                    }

                    // Reset form
                    $("#add_report_form")[0].reset();

                },
                error: function (xhr) {

                    $(".save_profile_btn").prop("disabled", false).text("Add Report");

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (key, value) {
                            let input = $('[name="' + key + '"]');
                            input.addClass("is-invalid");
                            input.after('<small class="text-danger">' + value[0] + '</small>');
                        });
                    }
                }
            });

            return false;
        }

    });
});